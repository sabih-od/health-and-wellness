<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Customers;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Service;
use App\Models\Sessions;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {

        $data['services'] = Service::all()->count();
        $data['sessions'] = Sessions::all()->count();
        $data['booked_sessions'] = BookSession::all()->count();
        $data['users'] = User::where('role_id' , 2)->latest('id')->limit(5)->get();


        return view('admin.dashboard' , compact('data'));
    }

}
