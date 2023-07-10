<?php

namespace App\Http\Controllers\User;

use App\Events\UserJoined;
use App\Events\ViewerRaisedHand;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{

    public function stream(Request $request, $session_id)
    {
        $session = Sessions::find($session_id);

        event(new UserJoined(Auth::user(), $session_id));
        return view('dashboard.stream.peer', compact('session'));
    }

    public function raiseHand(Request $request, $batch_id)
    {
        return event(new ViewerRaisedHand(Auth::user(), $batch_id));
    }

    public function getUserProfilePicture (Request $request)
    {
        $user = User::find($request->user_id);
        return $user->get_profile_picture();
    }
}