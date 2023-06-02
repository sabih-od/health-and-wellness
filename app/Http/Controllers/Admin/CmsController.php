<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\CmsPageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(CmsPage::get())
                    ->addIndexColumn()
                    ->addColumn('page', function ($data) {
                        return $data->page_title;
                    })
                    ->addColumn('slug', function ($data) {
                        return $data->url_key;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="edit" href="' . route('admin.cms.edit', $data->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
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
}
