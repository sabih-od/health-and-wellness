<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Category;
use App\Models\Course;
use App\Models\Faqs;
use App\Models\Service;
use App\Models\Sessions;
use App\Models\Settings;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $data['testimonials'] = Testimonial::latest()->limit(3)->get();
        $data['faqs'] = Faqs::latest()->get();
        return view('front.index', compact('data'));
    }

    public function services(Request $request)
    {
        $services = Service::all();
        return view('front.services', compact('services'));
    }

    public function serviceDetail(Request $request, $id)
    {
        $session = BookSession::where('id', $id)->with('session', 'session.service', 'sessionTiming')->first();
        return view('front.service-detail', compact('session'));
    }

    public function frontServiceDetail(Request $request, $id)
    {
        $service = Service::where('id', $id)->first();
        return view('front.front-service-detail', compact('service'));
    }

    public function frontFaqs()
    {
        $faqs = Faqs::all();

        return view('front.faq', compact('faqs'));
    }

    public function frontContact(Request $request)
    {
        $setting = Settings::latest()->first();

        return view('front.contact', compact('setting'));
    }

    public function frontEducation()
    {

        $category = Category::where('category_slug', 'education')->first();

        $courses = Course::where('category_id', $category->id)->get();

        return view('front.education', compact('courses'));
    }

    public function frontHealth()
    {

        $category = Category::where('category_slug', 'health')->first();

        $courses = Course::where('category_id', $category->id)->get();

        return view('front.health', compact('courses'));
    }

    public function frontWellness()
    {

        $category = Category::where('category_slug', 'wellness')->first();

        $courses = Course::where('category_id', $category->id)->get();

        return view('front.wellness', compact('courses'));
    }

}
