<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Service::get())
                    ->addIndexColumn()
                    ->addColumn('image', function($data) {
                        return $data->get_service_picture();
                    })
                    ->addColumn('description', function($data) {
                        $htmlString = $data->description;

                        // Create a new instance of the HtmlString class with the HTML string
                        $html = new HtmlString($htmlString);

                        // Find all anchor tags in the HTML string
                        preg_match_all('/<a\s[^>]*href="([^"]*)"[^>]*>([^<]*)<\/a>/', $htmlString, $matches, PREG_SET_ORDER);

                        // Replace anchor tags with formatted clickable links
                        foreach ($matches as $match) {
                            $formattedLink = $match[2] . ': <a href="' . $match[1] . '">' . $match[1] . '</a>';
                            $html = Str::of($html)->replace($match[0], $formattedLink);
                        }

                        // Replace &nbsp; entities with regular spaces
                        $decodedHtml = str_replace('&nbsp;', ' ', $html);

                        // Strip HTML tags from the resulting string
                        $plainText = strip_tags($decodedHtml);

                        return $plainText;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="edit" href="service-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.service.list');
    }

    public function addService(Request $request)
    {
        if ($request->method() == 'POST') {

            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'description' => 'required',
                'pricing_detail' => 'required',
            ));

            $service = Service::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'pricing_detail' => $request->input('pricing_detail') ,
            ]);

            if($request->has('image')) {
                $service->addMediaFromRequest('image')->toMediaCollection('service_images');
            }

            if ($service) {
                return redirect()->route('service')->with(['success' => 'Service Added Successfully']);
            }
        }

        return view('admin.service.add-service');
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'description' => 'required',
                'pricing_detail' => 'required',
            ));

            $service = Service::find($id);

            if($request->has('image')) {
                $service->clearMediaCollection('service_images');
                $service->addMediaFromRequest('image')->toMediaCollection('service_images');
            }

            $service->name = $request->input('name');
            $service->description = $request->input('description');
            $service->pricing_detail = $request->input('pricing_detail');

            if ($service->save()) {
                return redirect()->route('service')->with(['success' => 'Service Edit Successfully']);
            }
        }else {
            $content=Service::findOrFail($id);
            return view('admin.service.add-service', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=Service::find($id);
        $content->delete();
        echo 1;
    }
}
