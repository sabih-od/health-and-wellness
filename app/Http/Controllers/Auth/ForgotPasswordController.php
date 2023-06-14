<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showForgetPasswordForm()
    {
        return view('dashboard.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.exists' => 'No user with provided email exists.'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $message = "<h1>Forget Password Email</h1>\r\n
                    You can reset password from bellow link:\r\n
                    <a href='".route('reset.password.get', $token)."'>Reset Password</a>";

        send_mail('admin@hnw.com', $request->email, 'Password Reset', $message);

//        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
//            $message->to($request->email);
//            $message->subject('Reset Password');
//        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) {
        $record = DB::table('password_resets')->where('token', $token)->orderBy('created_at', 'DESC')->first();
        $email = $record->email;
        return view('dashboard.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|confirmed',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect()->route('front.login')->with('success', 'Your password has been changed!');
    }

    public function editUserPassword(Request $request)
    {
//dd($request->all());
        $input = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($input['current_password'], $user->password)) {

            $user->update(['password' => Hash::make($input['password'])]);

            return back()->with('success' , 'Your password has been edited!');

        } else {
          return back()->with('error' , 'Current password is not valid');
        }


    }

}
