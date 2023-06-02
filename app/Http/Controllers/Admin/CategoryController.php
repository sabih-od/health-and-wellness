<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Category::get())
                    ->addIndexColumn()
                    ->addColumn('image', function($data) {
                        return $data->getMedia('category_images')->first() ? $data->getMedia('category_images')->first()->getUrl() : asset('front/images/logo.png');
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="category-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="category-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.category.list');
    }

    public function addCategory(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'main_category' => 'required',
            ));

            $category = Category::create([
                'name' => $request->input('name'),
                'main_category' => $request->input('main_category'),
            ]);

            if($request->has('image')) {
                $category->addMediaFromRequest('image')->toMediaCollection('category_images');
            }

            if ($category) {
                return redirect()->route('category')->with(['success' => 'Category Added Successfully']);
            }
        }

        return view('admin.category.add-category');
    }

    final public function show(int $id){
        $content= Category::find($id);
        return view('admin.category.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'main_category' => 'required',
            ));

            $category = Category::find($id);

            if($request->has('image')) {
                $category->clearMediaCollection('category_images');
                $category->addMediaFromRequest('image')->toMediaCollection('category_images');
            }

            $category->name = $request->input('name');
            $category->main_category = $request->input('main_category');

            if ($category->save()) {
                return redirect()->route('category')->with(['success' => 'Category Edit Successfully']);
            }
        }else {
            $content=Category::findOrFail($id);
            return view('admin.category.add-category', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=Category::find($id);
        $content->delete();
        echo 1;
    }
}
