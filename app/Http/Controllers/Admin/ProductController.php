<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Product::get())
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return $data->get_first_image();
                    })
                    ->addColumn('seller', function ($data) {
                        return is_null($data->user_id) ? 'Admin' : ($data->user->first_name . ' ' . $data->user->last_name);
                    })
                    ->addColumn('category', function ($data) {
                        return $data->category->name;
                    })
                    ->addColumn('state', function ($data) {
                        return is_null($data->state_id) ? '' : $data->state->name;
                    })
                    ->addColumn('county', function ($data) {
                        return is_null($data->city_id) ? '' : $data->city->name;
                    })
                    ->editColumn('title', function($data){
                        $title = $data->title;
                        if($data->is_sold) {
                            $title .= "\r\n" . '<span class="badge badge-warning">Sold</span>';
                        }
                        return $title;
                    })
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="product-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                            .
                            (is_null($data->is_approved) ?
                                '&nbsp;<a title="Approve" href="product-approve/' . $data->id . '" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                &nbsp;<a title="Reject" href="product-reject/' . $data->id . '" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></a>'
                                : '');
                    })->rawColumns(['title', 'action'])->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.product.list');
    }

    public function addCategory(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
            ));

            $product = Product::create([
                'name' => $request->input('name'),
            ]);

            if ($product) {
                return redirect()->route('product')->with(['success' => 'Product Category Added Successfully']);
            }
        }

        return view('admin.product.add-product');
    }

    final public function show(int $id){
        $content= Product::find($id);
        return view('admin.product.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
            ));

            $product = Product::find($id);

            $product->name = $request->input('name');

            if ($product->save()) {
                return redirect()->route('product')->with(['success' => 'Product Category Edit Successfully']);
            }
        }else {
            $content=Product::findOrFail($id);
            return view('admin.product.add-product', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=Product::find($id);
        $content->delete();
        echo 1;
    }

    public function approve(Request $request, $id)
    {
        $content = Product::find($id);
        $content->is_approved = 1;
        $content->save();
        return redirect()->route('product')->with(['success' => 'Product Approved Successfully']);
    }

    public function reject(Request $request, $id)
    {
        $content = Product::find($id);
        $content->is_approved = 0;
        $content->save();
        return redirect()->route('product')->with(['success' => 'Product Rejected Successfully']);
    }
}
