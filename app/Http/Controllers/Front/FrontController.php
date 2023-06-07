<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home (Request $request)
    {
        return view('front.index');
    }

    public function services (Request $request)
    {
        $services = Service::all();
        return view('front.services', compact('services'));
    }

    public function serviceDetail (Request $request, $id)
    {
        $service = Service::find($id);
        return view('front.service-detail', compact('service'));
    }
}
