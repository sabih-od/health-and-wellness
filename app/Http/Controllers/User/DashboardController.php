<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Sessions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
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
//        dd("in");
        $authUser = Auth::id();

        if (request()->ajax()) {
            try {
                $remaingBtn = false;
                $startSession = false;
                return datatables()->of(Sessions::whereHas('bookSession', function ($q) {
                    $q->where('user_id', Auth::id());
                }))
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return $data->get_session_picture();
                    })
                    ->addColumn('time_remaining', function ($data) {

                        $firstTime = substr($data->session_time, 0, 5);
                        $secondTime = substr($data->session_time, 8, 10);


                        $currentDateTime = Carbon::now();

                        $givenDateTime = Carbon::parse($data->date . $firstTime);

                        $givenDateSecondTime = Carbon::parse($data->date . $secondTime);

                        if ($currentDateTime < $givenDateTime) {
                            $diffInDays = $givenDateTime->diffInDays($currentDateTime);
                            $diffInHours = $givenDateTime->diffInHours($currentDateTime) % 24;
                            $diffInMinutes = $givenDateTime->diffInMinutes($currentDateTime) % 60;
                        } elseif ($currentDateTime < $givenDateSecondTime) {

                            return '<span>Ready To Take Session</span>';

                        } else {
                            return '<span>Completed</span>';
                        }

                        return '<div style="display: flex ; flex-direction: column"><span style="font-size: 14px; font-weight: 400" id="renaming_time_' . $data->id . '">Remaining Time</span><span style="font-size:22px; font-weight: 500" data-days="' . $diffInDays . '" data-hours="' . $diffInHours . '" data-minutes="' . $diffInMinutes . '" data-id="' . $data->id . '" class="countDown" id="count_down_' . $data->id . '"> </span><span style="font-size: 14px; font-weight: 400;" id="days_hrs_' . $data->id . '">Days Hrs Mins </span></div>';

                    })
                    ->addColumn('action', function ($data) use ($startSession, $remaingBtn) {

                        $firstTime = substr($data->session_time, 0, 5);
                        $secondTime = substr($data->session_time, 8, 10);


                        $currentDateTime = Carbon::now();

                        $givenDateTime = Carbon::parse($data->date . $firstTime);

                        $givenDateSecondTime = Carbon::parse($data->date . $secondTime);

                        if ($currentDateTime < $givenDateTime) {
                            return '<button id="action_btn_' . $data->id . '" class="themeBtn remain">Take A Session</button>';

                        } elseif ($currentDateTime < $givenDateSecondTime) {

                            return '<button id="action_btn_' . $data->id . '" class="themeBtn">Take A Session</button>';

                        } else {
                            return '<button id="action_btn_' . $data->id . '" class="themeBtn completed">View Detail</button>';

                        }


                    })->rawColumns(['action', 'time_remaining'])->make(true);
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
