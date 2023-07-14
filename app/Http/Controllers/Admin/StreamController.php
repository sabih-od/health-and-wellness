<?php

namespace App\Http\Controllers\Admin;

use App\Events\AllowUserScreen;
use App\Events\RevertStream;
use App\Events\StopStreaming;
use App\Events\ViewerToggleBack;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BookSession;
use App\Models\Course;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function stream(Request $request, $session_timing_id)
    {
        $booked_session = BookSession::where('session_timing_id',$session_timing_id)->first();
        $session = Sessions::where('id' , $booked_session->session_id)->first();
        $session->is_streaming = true;
        $session->save();

        $booked_session_user = User::where('id' , $booked_session->user_id)->first();
        return view('admin.admin-peer', compact('session' , 'booked_session_user'));
    }

//    public function allowUserScreen(Request $request, $batch_id, $customer_id) {
//        return event(new AllowUserScreen($batch_id, $customer_id));
//    }
//
//    public function revertStream(Request $request, $batch_id, $customer_id) {
//        return event(new RevertStream($batch_id, $customer_id));
//    }
//
//    public function viewerToggleBack(Request $request, $batch_id, $customer_id) {
//        return event(new ViewerToggleBack($batch_id, $customer_id));
//    }
//
    public function stop(Request $request, $session_id) {
        $session_id = Sessions::find($session_id);

        $session_id->is_streaming = false;
        $session_id->save();
        event(new StopStreaming($session_id));
        return redirect()->route('session')->with('error' , 'Call Ended');
    }

//    public function getUserProfilePicture (Request $request)
//    {
//        $user = User::find($request->user_id);
//        return $user->get_profile_picture();
//    }
}
