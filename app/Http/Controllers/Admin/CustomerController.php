<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(User::where('role_id', 2)->get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return
                            $data->is_active == 1 ?
                                '<button type="button" id="' . $data->id . '" title="Inactivate" href="customer-activate/' . $data->id . '" class="btn btn-danger btn-sm activate" data-activate="1"><i class="fas fa-stop"></i></button>&nbsp;<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                                : '<button type="button" id="' . $data->id . '" title="Activate" href="customer-activate/' . $data->id . '" class="btn btn-success btn-sm activate" data-activate="0"><i class="fas fa-stop"></i></button>&nbsp;<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
//                        return '<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.customer.list');
    }

    final public function show(int $id){
        $content= User::find($id);
        return view('admin.customer.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required',
                'address' => 'required',
                'zipcode' => 'required',
                'password' => 'sometimes',
            ));

            $customer = User::find($id);

            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->zipcode = $request->input('zipcode');
            if($request->has('password')) {
                $customer->password = Hash::make($request->input('password'));
            }

            if ($customer->save()) {
                return redirect()->route('customer')->with(['success' => 'Customer Edit Successfully']);
            }
        }else {
            $content=User::findOrFail($id);
            return view('admin.customer.add-customer', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=User::find($id);
        $content->delete();
        echo 1;
    }

    final public function activate(int $id)
    {
        $content=User::find($id);
        $content->is_active = $content->is_active == 0 ? 1 : 0;
        $content->save();
        echo 1;
    }
}
