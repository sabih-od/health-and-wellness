<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use Illuminate\Http\Request;

class ForumCategoryController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(ForumCategory::get())
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="forum-category-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="forum-category-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.forum-category.list');
    }

    public function addForumCategory(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
            ));

            $category = ForumCategory::create([
                'name' => $request->input('name'),
            ]);

            if ($category) {
                return redirect()->route('forum-category')->with(['success' => 'Forum Category Added Successfully']);
            }
        }

        return view('admin.forum-category.add-forum-category');
    }

    final public function show(int $id){
        $content= ForumCategory::find($id);
        return view('admin.forum-category.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
            ));

            $category = ForumCategory::find($id);

            $category->name = $request->input('name');

            if ($category->save()) {
                return redirect()->route('forum-category')->with(['success' => 'Forum Category Edit Successfully']);
            }
        }else {
            $content=ForumCategory::findOrFail($id);
            return view('admin.forum-category.add-forum-category', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=ForumCategory::find($id);
        $content->delete();
        echo 1;
    }
}
