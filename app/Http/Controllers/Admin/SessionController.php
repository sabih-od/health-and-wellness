<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Sessions;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function index()
    {
        try {

            if (request()->ajax()) {
                return datatables()->of(Sessions::get())
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return $data->get_session_picture();
                    })
                    ->addColumn('service', function ($data) {
//                        $service =  Service::where('id' , $data->service_id)->first();
                        return $data->service->name ?? '';
                    })
                    ->editColumn('status', function ($data) {
                        return $data->status == 1 ? '<button title="Activate" type="button" name="activate" id="' . $data->id . '" class="activate btn btn-success btn-sm">Activate</button>' : '<button title="Deactivate" type="button" name="deactivate" id="' . $data->id . '" class="deactivate btn btn-warning btn-sm">Deactivate</button>';
                    })
                    ->addColumn('action', function ($data) {
                        $joinCallButton = '';
                        if ($data->date == date('Y-m-d')) {
                            $joinCallButton = '<button title="Join Call" type="button" name="join_call" id="' . $data->id . '" class="joincall btn btn-success btn-sm">Join Call</button>&nbsp;';
                        }
                        return $joinCallButton . '<a title="edit" href="session-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
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
                'session_time' => $request->session_start_time . " - " . $request->session_end_time,
                'status' => 1,
            ]);

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
            $service->session_time = $request->input('session_start_time') . " - " . $request->input('session_end_time');


            if ($service->save()) {
                return redirect()->route('session')->with(['success' => 'Service Edit Successfully']);
            }
        } else {
            $content = Sessions::findOrFail($id);
            return view('admin.session.add-session', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content = Sessions::find($id);
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
        $sessions = Sessions::select('name')->where('service_id', $request->serviceId)->where('status', 1)->get();
        return response()->json($sessions);
    }

    public function fetchDateSessions(Request $request)
    {

//        Formate date For fetching

            $date = Carbon::createFromFormat('m/d/Y', $request->date);
        $formattedDate = $date->format('Y-m-d');
        $sessions = Sessions::where('date', $formattedDate)->with('service')->get();


        return response()->json($sessions);
    }


}
