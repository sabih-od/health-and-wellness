<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('streaming-channel.{id}', function ($user, $session_id) {
    //
//    return ($user->role_id == 1) ? $user : (\App\Models\Sessions::where([
//        ['id', $id],
////        ['user_id', $user->id],
//    ])->exists() ? $user: null);

    return \App\Models\Sessions::where('id' , $session_id)->first();
});

Broadcast::channel('notifications.{userId}', function ($user, $userId) {
    return $user->id === (int) $userId;
});

