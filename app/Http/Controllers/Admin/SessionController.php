<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Service;
use App\Models\Sessions;
use App\Models\SessionTiming;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    public function index()
    {
        try {

            if (request()->ajax()) {
                return datatables()->of(SessionTiming::with('session', 'session.service')->get())
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return $data->session->get_session_picture();
                    })
                    ->addColumn('session_name', function ($data) {
                        return $data->session->name;
                    })
                    ->addColumn('session_time', function ($data) {
                        return $data->session_time;
                    })
                    ->addColumn('fees', function ($data) {
                        return $data->session->fees;
                    })
                    ->addColumn('date', function ($data) {
                        return $data->session->date;
                    })
                    ->addColumn('service', function ($data) {
//                        $service =  Service::where('id' , $data->service_id)->first();
                        return $data->session->service->name ?? '';
                    })
                    ->editColumn('status', function ($data) {
                        return $data->session->status == 1 ? '<button title="Activate" type="button" name="activate" id="' . $data->id . '" class="activate btn btn-success btn-sm">Activate</button>' : '<button title="Deactivate" type="button" name="deactivate" id="' . $data->id . '" class="deactivate btn btn-warning btn-sm">Deactivate</button>';
                    })
                    ->addColumn('action', function ($data) {

                        $firstTime = substr($data->session_time, 0, 5);

                        $secondTime = substr($data->session_time, 8, 10);

                        $currentDateTime = Carbon::now();
                        $givenDateTime = Carbon::parse($data->session->date . $firstTime);
                        $givenDateSecondTime = Carbon::parse($data->session->date . $secondTime);

                        $joinCallButton = '';
                        if ($givenDateTime <= $currentDateTime && $givenDateSecondTime >= $currentDateTime) {
                            $joinCallButton = '<button title="Join Call" type="button" name="join_call" id="' . $data->id . '" class="joincall btn btn-success btn-sm">Join Call</button>&nbsp;';
                            return $joinCallButton . '<a title="View" href="session-view/' . $data->session->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="session-edit/' . $data->session->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                        }
                        return '<a title="View" href="session-view/' . $data->session->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="session-edit/' . $data->session->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';

                    })->rawColumns(['action', 'status'])->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.session.list');
    }

    public function addSessions(Request $request)
    {
        if ($request->method() == 'POST') {

            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'fees' => 'required',
                'service_id' => 'required',
                'session_date' => 'required',
                'session_start_time' => 'required',
                'session_end_time' => 'required',
            ));

            if ($request->session_date < Carbon::now()) {
                return back()->with(['error' => 'You cant create a session on previous date']);
            }

            if ($request->session_start_time > $request->session_end_time) {
                return back()->with(['error' => 'You cant select start time is greater then end time']);
            }

            $service = Sessions::create([
                'name' => $request->input('name'),
                'fees' => $request->input('fees'),
                'service_id' => $request->input('service_id'),
                'date' => $request->input('session_date'),
//                'session_time' => $request->session_start_time[0] . " - " . $request->session_end_time[0],
                'status' => 1,
            ]);


            if (count($request->session_start_time) > 0) {

                for ($i = 0; $i < count($request->session_start_time); $i++) {
                    $sessionTimings = SessionTiming::create([
                        'session_id' => $service->id,
                        'session_time' => $request->session_start_time[$i] . " - " . $request->session_end_time[$i],
                        'is_booked' => 0,
                    ]);

                    $sessionTimings->save();

                }


            }

            if ($request->has('image')) {
                $service->addMediaFromRequest('image')->toMediaCollection('session_images');
            }

            if ($service) {
                return redirect()->route('session')->with(['success' => 'Session Added Successfully']);
            }
        } else {
            $services = Service::all();
            return view('admin.session.add-session', compact('services'));

        }

    }

    public function edit(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'fees' => 'required',
                'service_id' => 'required',
                'session_date' => 'required',
                'session_start_time' => 'required',
                'session_end_time' => 'required',
            ));

//            dd($request->all());

            $service = Sessions::find($id);

            if ($request->hasFile('image')) {
                $mediaId = $service->getMedia('session_images');
                if (count($mediaId) != 0) {

                    $media = $service->getMedia('session_images')->find($mediaId[0]->id);
                    if ($media) {
                        $media->delete();
                        $service->addMediaFromRequest('image')->toMediaCollection('session_images');
                    }

                } else {
                    $service->addMediaFromRequest('image')->toMediaCollection('session_images');

                }
            }

            $service->name = $request->input('name');
            $service->fees = $request->input('fees');
            $service->service_id = $request->input('service_id');
            $service->date = $request->input('session_date');

          if(isset($request->session_start_time_cloned) && isset($request->session_end_time_cloned)){

              if (count($request->session_start_time_cloned) > 0) {

                  for ($i = 0; $i < count($request->session_start_time_cloned); $i++) {
                      $sessionTimings = SessionTiming::create([
                          'session_id' => $service->id,
                          'session_time' => $request->session_start_time_cloned[$i] . " - " . $request->session_end_time_cloned[$i],
                          'is_booked' => 0,
                      ]);

                      $sessionTimings->save();

                  }


              }

          }

//            $service->session_time = $request->input('session_start_time') . " - " . $request->input('session_end_time');

//            $sessionTiming = SessionTiming::where('session_id', $id)->get();
//
//            if (count($request->session_start_time) > 0) {
//
//                for ($i = 0; $i < count($request->session_start_time); $i++) {
//
//                    $sessionTimings = SessionTiming::create([
//                        'session_id' => $service->id,
//                        'session_time' => $request->session_start_time[$i] . " - " . $request->session_end_time[$i],
//                        'is_booked' => 0,
//                    ]);
//
//                    $sessionTimings->save();
//
//                }
//
//            }
//
//            $sessionTiming->each->delete();


            if ($service->save()) {
                return redirect()->route('session')->with(['success' => 'Service Edit Successfully']);
            }
        } else {
            $content = Sessions::where('id', $id)->with('sessionTimings')->first();
            return view('admin.session.add-session', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content = SessionTiming::find($id);
        $content->delete();
        echo 1;
    }


    public function deactivateStatus($id)
    {
        $session = Sessions::where('id', $id)->first();

        $session->status = 0;

        $session->save();

        return redirect()->route('session')->with(['success' => 'Session Deactivate Successfully']);

    }

    public function activateStatus($id)
    {
        $session = Sessions::where('id', $id)->first();

        $session->status = 1;

        $session->save();

        return redirect()->route('session')->with(['success' => 'Session Activate Successfully']);

    }

    public function getSessionsByService(Request $request)
    {
///        $sessions = Sessions::where('service_id', $request->serviceId)->where('status', 1)->whereDoesntHave('bookSession')->get();
        $sessions = Sessions::where('service_id', $request->serviceId)->whereHas('sessionNotBookedTimings')->get();

        return response()->json($sessions);
    }

    public function getSessionsTimingBySession(Request $request)
    {
        $sessionTiming = SessionTiming::where('session_id', $request->sessionId)->where('is_booked', 0)->get();

        return response()->json($sessionTiming);
    }

    public function fetchDateSessions(Request $request)
    {

//        Formate date For fetching

        $date = Carbon::createFromFormat('m/d/Y', $request->date);
        $formattedDate = $date->format('Y-m-d');
        $sessions = Sessions::where('date', $formattedDate)->with('service')->get();


        return response()->json($sessions);
    }

    public function deleteSessionTiming(Request $request)
    {

        $sessionTime = SessionTiming::where('id', $request->sessionTimeId)->first();

        if ($sessionTime->is_booked == 1) {

            return response()->json(false);
        } else {
            $sessionTime->delete();

            return response()->json(true);
        }


    }

    public function updateSessionTime(Request $request)
    {

        $sessionTimeId = (int)preg_replace('/[^0-9]/', '', $request->sessionTimeId);

        $sessionTime = SessionTiming::where('id', $sessionTimeId)->first();

        if (!$sessionTime) {
            redirect()->back()->with('error', "Session Time Not Found");
        }

        list($startTime, $endTime) = explode(' - ', $sessionTime->session_time);

        if ($request->sessionTimeType == "session_start_time[]") {
            $startTime = $request->changeTime;
            $sessionTime->session_time = $startTime . ' - ' . $endTime;
            $sessionTime->save();

            return response()->json('true');
        } else if ($request->sessionTimeType == "session_end_time[]") {
            $endTime = $request->changeTime;
            $sessionTime->session_time = $startTime . ' - ' . $endTime;
            $sessionTime->save();

            return response()->json('true');
        } else {

        }

    }


    public function sessionView($id){

        $session = Sessions::where('id' , $id)->with('service' , 'bookSession' , 'sessionTimings')->first();

        return view('admin.session.view'  , compact('session'));

    }

    public function bookedSession(Request $request)
    {
            return view('admin.booked-session.list');

    }

    public function bookedSessionDatatables(Request $request)
    {
        if (request()->ajax()) {
            try {

                return datatables()->of(BookSession::with('session','session.service' , 'sessionTiming' , 'user')->get())
                    ->addIndexColumn()
                    ->addColumn('session_name', function ($data) {
                        return $data->session->name;
                    })
                    ->addColumn('booked_by', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('session_time', function ($data) {
                        return $data->sessionTiming->session_time;
                    })
                    ->addColumn('date', function ($data) {
                        return $data->session->date;
                    })
                    ->addColumn('service_name', function ($data) {
                        return $data->session->service->name;
                    })
                    ->addColumn('payment_status', function ($data) {
                        return $data->payment_status;
                    })
                    ->addColumn('action', function ($data) {
                        return
                                '<a title="View" href="view-booked-sessions/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })
                    ->rawColumns(['action', 'time_remaining'])->make(true);
            } catch (\Exception $ex) {
                return response()->json([
                    'status' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        }
    }

    public function bookSessionDestroy($id)
    {
        $content=BookSession::find($id);
        $content->delete();        echo 1;
    }

    public function viewBookedSession($id)
    {
        $bookSession = BookSession::where('id' , $id)->with('session','session.service' , 'sessionTiming' , 'user')->first();

        return view('admin.booked-session.view' , compact('bookSession'));
    }

}
