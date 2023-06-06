<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editProfile (Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email|unique:users,email,' . Auth::id(),
                'phone' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'fax' => 'required',
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

            $user->update($req);

            return redirect()->route('user.profile')->with('success', 'Profile Updated.');
        } else {
            return view('dashboard.edit-profile');
        }
    }
    public function profile (Request $request)
    {
        return view('dashboard.profile');
    }
}
