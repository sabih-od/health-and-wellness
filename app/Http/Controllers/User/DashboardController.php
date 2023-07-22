<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Sessions;
use App\Traits\PHPCustomMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    use PHPCustomMail;

    public function index(Request $request)
    {
        $authUser = Auth::id();

        $data['total_sessions'] = BookSession::where('user_id', $authUser)->get()->count();
        $data['pending_sessions'] = BookSession::where('user_id', $authUser)->where('status', 'pending')->get()->count();
        $data['complete_sessions'] = BookSession::where('user_id', $authUser)->where('status', 'completed')->get()->count();

        return view('dashboard.index', compact('data'));
    }

    public function datatables(Request $request)
    {


//        PREV CODE
//        Sessions::query()->with('sessionBookedTimings')->whereHas('sessionTimings')->whereHas('sessionTimings.authenticateTimingBookSession')->get()
        $authUser = Auth::id();
        if (request()->ajax()) {
            try {
                $remaingBtn = false;
                $startSession = false;

                return datatables()->of(BookSession::where('user_id', Auth::id())->with('session', 'sessionTiming')->get())
                    ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    return $data->session->get_session_picture();
                })
                    ->addColumn('session_name', function ($data) {
                        return $data->session->name;
                    })
                    ->addColumn('session_time', function ($data) {
                        return $data->sessionTiming->session_time;
                    })
                    ->addColumn('date', function ($data) {
                        return $data->session->date;
                    })
                    ->addColumn('time_remaining', function ($data) {

                        $firstTime = substr($data->sessionTiming->session_time, 0, 5);

                        $secondTime = substr($data->sessionTiming->session_time, 8, 10);

                        $currentDateTime = Carbon::now();
//dd($currentDateTime);
                        $givenDateTime = Carbon::parse($data->session->date . $firstTime);

                        $givenDateSecondTime = Carbon::parse($data->session->date . $secondTime);

                        if ($currentDateTime < $givenDateTime) {
                            $diffInDays = $givenDateTime->diffInDays($currentDateTime);
                            $diffInHours = $givenDateTime->diffInHours($currentDateTime) % 24;
                            $diffInMinutes = $givenDateTime->diffInMinutes($currentDateTime) % 60;
                        } elseif ($currentDateTime < $givenDateSecondTime) {

                            return '<span>Ready To Take Session</span>';

                        } else {
                            return '<span>Completed</span>';
                        }

                        return '<div style="display: flex ; flex-direction: column"><span style="font-size: 14px; font-weight: 400" id="renaming_time_' . $data->session->id . '">Remaining Time</span><span style="font-size:22px; font-weight: 500" data-days="' . $diffInDays . '" data-hours="' . $diffInHours . '" data-minutes="' . $diffInMinutes+1 . '" data-id="' . $data->session->id . '" class="countDown" id="count_down_' . $data->session->id . '"> </span><span style="font-size: 14px; font-weight: 400;" id="days_hrs_' . $data->session->id . '">Days Hrs Mins </span></div>';

                    })
                    ->addColumn('action', function ($data) use ($startSession, $remaingBtn) {

                        $firstTime = substr($data->sessionTiming->session_time, 0, 5);

                        $secondTime = substr($data->sessionTiming->session_time, 8, 10);


                        $currentDateTime = Carbon::now();

                        $givenDateTime = Carbon::parse($data->session->date . $firstTime);
                        $givenDateSecondTime = Carbon::parse($data->session->date . $secondTime);
                        if ($currentDateTime < $givenDateTime) {
                            return '<button id="action_btn_' . $data->session->id . '" class="themeBtn remain">Take A Session</button>';
//
                        } elseif ($currentDateTime < $givenDateSecondTime) {
                            return '<a href="stream/'.$data->session->id.'" id="action_btn_' . $data->session->id . '" class="themeBtn">Take A Session</a>';

                        } else {
                            return '<a id="action_btn_' . $data->session->id . '" href="service-detail/ ' . $data->id . '" class="themeBtn completed">View Detail</a>';

                        }
                    })
                    ->rawColumns(['action', 'time_remaining'])->make(true);
            } catch (\Exception $ex) {
                return response()->json([
                    'status' => false,
                    'message' => $ex->getMessage()
                ]);
            }
        }

//        return view('admin.session.list');


//        $data['sessions'] = BookSession::where('user_id' , $authUser)->with('service' , 'session')->get();

        return view('dashboard.index');
    }
}
