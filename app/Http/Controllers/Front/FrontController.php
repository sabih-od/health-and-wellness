<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faqs;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $data['testimonials'] = Testimonial::latest()->limit(3)->get();
        $data['faqs'] = Faqs::latest()->limit(3)->get();
        return view('front.index' , compact('data'));
    }

    public function services(Request $request)
    {
        $services = Service::all();
        return view('front.services', compact('services'));
    }

    public function serviceDetail(Request $request, $id)
    {
        $service = Service::find($id);
        return view('front.service-detail', compact('service'));
    }

    public function frontFaqs()
    {
        $faqs = Faqs::all();

        return view('front.faq' , compact('faqs'));
    }

}
