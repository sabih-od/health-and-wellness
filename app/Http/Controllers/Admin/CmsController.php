<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\CmsPageSection;
use App\Models\Faqs;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Faqs::get())
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return $data->get_faq_picture();
                    })
//                    ->addColumn('slug', function ($data) {
//                        return $data->url_key;
//                    })
                    ->addColumn('action', function ($data) {
                        return '<div>
                                <a title="edit" href="' . route('edit.faq', $data->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                &nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </div>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.cms.index');
    }


    public function editSection($id)
    {
        $cmsPage = CmsPageSection::where('cms_page_id', $id)->get();
        $section_inputs = [];
        foreach ($cmsPage as $section) {
            $this->inputs = [];
            $this->heading = [];
            $section_inputs[$section->slug] = $this->dataGet($section->content, $this->heading);
        }

        return view('admin.cms.edit')
            ->with('content', $section_inputs);
    }

    public function dataGet($data, $headings = [])
    {
        foreach ($data as $key => $value) {
            $this->heading = $headings;
            $this->heading[] = $key;
            if (array_key_exists("type", $value)) {
                $this->inputs[] = [
                    'heading' => implode(' > ', $this->heading),
                    'type' => $value['type'],
                    'value' => $value['value']
                ];
            } else {
                $this->inputs = $this->dataGet($value, $this->heading);
            }
        }
        return $this->inputs;
    }


    public function updateSection(Request $request, $cmsPageSectionSlug)
    {
        try {
//            dd($request->all());
            $request_section = $request->section;
            $content = CmsPageSection::where('slug', $cmsPageSectionSlug)->first();
            $generateSection = $this->sectionDataCreate($request_section, $content->content, 'section', $request_section);
            CmsPageSection::where('slug', $cmsPageSectionSlug)->update([
                'content' => $generateSection
            ]);
            return redirect()->back()->with('success', "Section updated successfully!");
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    private function sectionDataCreate($data, $content, $parent_key, $request)
    {
        $input_name = str_replace('section.', '', $parent_key);
        foreach ($data as $key => $item) {
            if (is_array($item)) {
                $request = $this->sectionDataCreate($item, $content, $parent_key . "." . $key, $request);
            } elseif ($key == 'image_0') {
                $db_value = data_get($content, $input_name);
                $input_file_name = $parent_key . '.' . $key;
                if (request()->hasFile($input_file_name)) {
                    $folder = explode('/', $db_value);
                    array_pop($folder);
                    $folder = implode('/', $folder);
                    if (!File::exists(public_path($folder))) {
                        File::makeDirectory($folder, 0777, true);
                    }
                    $file = request()->file($input_file_name);
                    $file_name = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->move($folder, $file_name);
                    if (File::exists(public_path($db_value))) {
                        File::delete(public_path($db_value));
                    }
                    $db_value = $folder . '/' . $file_name;
                }
                data_set($request, $input_name, $db_value);
            }
        }
        return $request;
    }


    public function Faq()
    {
        return view('admin.cms.faqs.faqs');
    }

    public function createFaq()
    {
        return view('admin.cms.faqs.create-faq');

    }

    public function addFaq(Request $request)
    {

        $input = $request->validate([
            'question' => 'required',
            'answer' => 'required',
//            'image' => 'required',
        ]);

        $faq = new Faqs();

        $input['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $mediaId = $faq->getMedia('faq_image');
            if (count($mediaId) != 0) {

                $media = $faq->getMedia('faq_image')->find($mediaId[0]->id);
                if ($media) {
                    $media->delete();
                    $faq->addMediaFromRequest('image')->toMediaCollection('faq_image');
                }

            } else {
                $faq->addMediaFromRequest('image')->toMediaCollection('faq_image');

            }
        }

        $faq->fill($input)->save();

        return redirect()->route('faq')->with('success', 'Faq Created Successfully');
    }

    public function editFaq($id)
    {

        $content = Faqs::where('id', $id)->first();

        return view('admin.cms.faqs.edit-faq', compact('content'));

    }

    public function adminEditFaq(Request $request, $id)
    {
        $content = Faqs::where('id', $id)->first();

        $input = $request->all();

        if (!$content) {
            redirect()->back()->with('error', 'Faq not found');
        } else {

            if ($request->hasFile('image')) {
                $mediaId = $content->getMedia('faq_image');
                if (count($mediaId) != 0) {

                    $media = $content->getMedia('faq_image')->find($mediaId[0]->id);
                    if ($media) {
                        $media->delete();
                        $content->addMediaFromRequest('image')->toMediaCollection('faq_image');
                    }

                } else {
                    $content->addMediaFromRequest('image')->toMediaCollection('faq_image');

                }
            }

            $content->update($input);

            return redirect()->route('faq')->with('success', 'Faq Edit Successfully');

        }

    }

    public function adminDeleteFaq($id)
    {
        $content=Faqs::find($id);
        $content->delete();
        echo 1;
    }



    public function testimonials()
    {
        return view('admin.cms.testimonials.list');
    }

    public function testimonialsDatatables()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Testimonial::get())
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return $data->get_testimonial_picture();
                    })
//                    ->addColumn('slug', function ($data) {
//                        return $data->url_key;
//                    })
                    ->addColumn('action', function ($data) {
                        return '<div>
                                <a title="edit" href="' . route('edit.testimonial', $data->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                &nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </div>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.cms.index');
    }

    public function editTestimonial($id)
    {

        $content = Testimonial::where('id', $id)->first();

        return view('admin.cms.testimonials.edit', compact('content'));

    }

    public function createTestimonial()
    {
        return view('admin.cms.testimonials.create');

    }


    public function addTestimonials(Request $request)
    {

        $input = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'job_title' => 'required',
//            'image' => 'required',
        ]);

        $faq = new Testimonial();

        $input['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $mediaId = $faq->getMedia('testimonial_image');
            if (count($mediaId) != 0) {

                $media = $faq->getMedia('testimonial_image')->find($mediaId[0]->id);
                if ($media) {
                    $media->delete();
                    $faq->addMediaFromRequest('image')->toMediaCollection('testimonial_image');
                }

            } else {
                $faq->addMediaFromRequest('image')->toMediaCollection('testimonial_image');

            }
        }

        $faq->fill($input)->save();

        return redirect()->route('testimonials')->with('success', 'Testimonial Created Successfully');
    }

    public function adminEditTestimonial(Request $request, $id)
    {
        $content = Testimonial::where('id', $id)->first();

        $input = $request->all();

        if (!$content) {
            redirect()->back()->with('error', 'Testimonial not found');
        } else {

            if ($request->hasFile('image')) {
                $mediaId = $content->getMedia('testimonial_image');
                if (count($mediaId) != 0) {

                    $media = $content->getMedia('testimonial_image')->find($mediaId[0]->id);
                    if ($media) {
                        $media->delete();
                        $content->addMediaFromRequest('image')->toMediaCollection('testimonial_image');
                    }

                } else {
                    $content->addMediaFromRequest('image')->toMediaCollection('testimonial_image');

                }
            }

            $content->update($input);

            return redirect()->route('testimonials')->with('success', 'Testimonial Edit Successfully');

        }

    }

    public function adminDeleteTestimonial($id)
    {
        $content=Testimonial::find($id);
        $content->delete();
        echo 1;
    }







}
