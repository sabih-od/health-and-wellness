<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(ProductCategory::get())
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="product_category-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="product_category-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.product_category.list');
    }

    public function addCategory(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
            ));

            $product_category = ProductCategory::create([
                'name' => $request->input('name'),
            ]);

            if ($product_category) {
                return redirect()->route('product_category')->with(['success' => 'Product Category Added Successfully']);
            }
        }

        return view('admin.product_category.add-product_category');
    }

    final public function show(int $id){
        $content= ProductCategory::find($id);
        return view('admin.product_category.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
            ));

            $product_category = ProductCategory::find($id);

            $product_category->name = $request->input('name');

            if ($product_category->save()) {
                return redirect()->route('product_category')->with(['success' => 'Product Category Edit Successfully']);
            }
        }else {
            $content=ProductCategory::findOrFail($id);
            return view('admin.product_category.add-product_category', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=ProductCategory::find($id);
        $content->delete();
        echo 1;
    }
}
