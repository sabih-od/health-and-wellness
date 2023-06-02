<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Memoriam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemoriamController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Memoriam::all())
                    ->addIndexColumn()
                    ->editColumn('age', function($data){
                        return $data->age ?? '';
                    })
                    ->editColumn('death', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d', $data->death)->format('m-d-Y');
                        return $formatedDate;
                    })
                    ->addColumn('image', function($data) {
                        return $data->getMedia('memoriam_images')->first() ? $data->getMedia('memoriam_images')->first()->getUrl() : asset('front/images/logo.png');
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="edit" href="memoriam-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.memoriam.list');
    }

    public function addMemoriam(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required',
                'age' => 'required',
                'death' => 'required',
                'description' => 'required',
                'image' => 'required',
            ));

            //prep data
            $req = $request->all();

            $memoriam = Memoriam::create($req);

            if($request->has('image')) {
                $memoriam->addMediaFromRequest('image')->toMediaCollection('memoriam_images');
            }

            if ($memoriam) {
                return redirect()->route('memoriam')->with(['success' => 'Memoriam Added Successfully']);
            }
        }

        return view('admin.memoriam.add-memoriam');
    }

    final public function show(int $id){
        $content= Memoriam::find($id);
        return view('admin.memoriam.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required',
                'age' => 'required',
                'death' => 'required',
                'description' => 'required',
                'image' => 'nullable',
            ));

            $memoriam = Memoriam::find($id);

            if($request->has('image')) {
                $memoriam->clearMediaCollection('memoriam_images');
                $memoriam->addMediaFromRequest('image')->toMediaCollection('memoriam_images');
            }

            //prep data
            $req = $request->all();

//            dd($req);
            if ($memoriam->update($req)) {
                return redirect()->route('memoriam')->with(['success' => 'Memoriam Edit Successfully']);
            }
        } else {
            $content=Memoriam::findOrFail($id);

            return view('admin.memoriam.add-memoriam', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=Memoriam::find($id);
        $content->delete();
        echo 1;
    }
}
