<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Providers\RouteServiceProvider;
use App\Traits\PHPCustomMail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use PHPCustomMail;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role_id == 1) {// do your magic here
            return redirect()->route('dashboard');
        }

        if ($user->role_id == 2) {// do your magic here

            if ($user->id && $user->email) {

                event(new \App\Events\NotificationEvent($user->id, "Login successful"));

                $noti = new Notification([
                    'notify_id' => $user->id,
                    'notification' => "Login successful",
                ]);
                $noti->save();

                $to = $user->email;
                $from = "noreplay@health-and-wellness.com";
                $subject = "Mail Submitted";
                $message = "Login successful";

                $this->customMail($from, $to, $subject, $message);

                return redirect()->route('user.dashboard');

            }

            return redirect()->route('user.dashboard');
        }

        return redirect('/home');
    }
}
