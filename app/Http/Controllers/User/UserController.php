<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Service;
use App\Models\Sessions;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function editProfile(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email|unique:users,email,' . Auth::id(),
                'phone' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'address' => 'required',
                'bio' => 'required',
            ]);
            $user = User::find(Auth::id());
            $req = $request->all();

//            //change password
//            if(isset($request->password)) {
//                $req['password'] = Hash::make($req['password']);
//            } else {
//                unset($req['password']);
//            }

//            //profile picure
//            if($request->has('profile_picture')) {
//                $user->clearMediaCollection('user_profile_pictures');
//                $user->addMediaFromRequest('profile_picture')->toMediaCollection('user_profile_pictures');

//dd($request->all());

            if ($request->hasFile('user_profile_pictures')) {
                $mediaId = $user->getMedia('user_profile_pictures');
                if (count($mediaId) != 0) {

                    $media = $user->getMedia('user_profile_pictures')->find($mediaId[0]->id);
                    if ($media) {
                        $media->delete();
                        $user->addMediaFromRequest('user_profile_pictures')->toMediaCollection('user_profile_pictures');
                    }

                } else {
                    $user->addMediaFromRequest('user_profile_pictures')->toMediaCollection('user_profile_pictures');

                }
            }

            $user->update($req);

            return redirect()->route('user.profile')->with('success', 'Profile Updated.');
        } else {
            return view('dashboard.edit-profile');
        }
    }

    public function profile(Request $request)
    {
        return view('dashboard.profile');
    }


    public function editPassword()
    {
        return view('dashboard.edit-password');
    }


    public function sessions()
    {
        return view('dashboard.all-sessions');
    }

    public function bookSession()
    {

        return view('dashboard.book-session');
    }

    public function booking()
    {
        $data['sessions'] = Sessions::all();
        $data['services'] = Service::all();
        return view('dashboard.booking' , compact('data'));
    }

    public function notifications()
    {
        return view('dashboard.notification');
    }


    public function sessionBooking(Request $request){

        return view('dashboard.payment');
    }

}
