<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Cities;
use App\Models\Service;
use App\Models\Sessions;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('dashboard.booking', compact('data'));
    }

    public function notifications()
    {
        return view('dashboard.notification');
    }


    public function sessionBooking(Request $request)
    {

        DB::beginTransaction();

        $input = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'detail' => 'required',
            'address' => 'required',
            'service_id' => 'required',
            'session_id' => 'required',
        ]);

        $check_user_have_session = BookSession::where('user_id' , Auth::id())->where('status' , 'pending')->first();

        if($check_user_have_session)
        {
            return redirect()->back()->with('error' , "Already Book Session");
        }

//        $session_checks = Session::where('session_date', )
//            ->whereHas('bookSession', function ($q) {
//                return $q->where('user_id', Auth::id());
//            })->get();
//        count($session_checks);
        $data = new BookSession();

        $input['user_id'] = Auth::id();
        $input['status'] = "pending";
        $input['payment_status'] = "pending";

        $data->fill($input)->save();

        $session = Sessions::where('id', $input['session_id'])->first();

        $service = Service::where('id', $input['service_id'])->first();

        $lineItems = [];


        $lineItems[] = [
            'quantity' => "1",
            'price_data' => [
                'currency' => 'usd',
                'unit_amount' => $session->fees * 100,
                'product_data' => [
                    'name' => $session->name,
                    'description' => $session->date . " / " . $session->session_time,
                ],
            ],
        ];

        $stripeSecret = env('STRIPE_SECRET');


        \Stripe\Stripe::setApiKey($stripeSecret);
        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('stripe.redirect', ['session_booked_id' => $data->id, 'status' => 'success']),
            'cancel_url' => route('stripe.redirect', ['session_booked_id' => $data->id, 'status' => 'cancel']),
        ]);

        $transactionId = $checkoutSession->payment_intent;

        $data->txnid = $transactionId;
        $data->save();

        DB::commit();

        return redirect($checkoutSession->url);

    }

    public function stripeRedirect($session_booked_id, $status)
    {
        $getBookSession = BookSession::where('id', $session_booked_id)->first();

        $session = Sessions::where('id', $getBookSession->session_id)->first();

        if ($status == "success") {

//            $getBookSession->status = "completed";
            $getBookSession->payment_status = "completed";

            $getBookSession->save();

//            $transaction = new Transactions([
//                'user_id' => Auth::id(),
//                'session_id' => $session->id,
//                'txn_id' => $session->id,
//                'amount' => $session->fees,
//                'method' => "stripe"
//            ]);
//            $transaction->save();

            return redirect()->route('user.sessions')->with('success', 'Session Booked Successfully');
        }

        if ($status == "cancel") {
            return redirect()->route('user.bookSession')->with('error', 'Payment process has been cancelled');
        }


    }

}
