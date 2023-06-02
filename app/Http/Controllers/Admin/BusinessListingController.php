<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessListing;
use App\Models\BusinessState;
use App\Models\Category;
use App\Models\Cities;
use App\Models\Counties;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class BusinessListingController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(BusinessListing::with('category', 'user')->get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                        return $formatedDate;
                    })
                    ->addColumn('logo', function($data) {
                        return $data->getMedia('business_listing_logos')->first() ? $data->getMedia('business_listing_logos')->first()->getUrl() : asset('front/images/logo.png');
                    })
                    ->addColumn('is_approved', function ($data) {
                        if(is_null($data->is_approved)) {
                            return 'Pending';
                        } else {
                            return $data->is_approved == 1 ? 'Approved' : 'Rejected';
                        }
                    })
                    ->addColumn('author', function ($data) {
                        return is_null($data->user_id) ? 'Admin' : ($data->user->first_name . ' ' . $data->user->last_name);
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="business_listing-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="business_listing-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                            .
                            (is_null($data->is_approved) ?
                                '&nbsp;<a title="Approve" href="business_listing-approve/' . $data->id . '" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                &nbsp;<a title="Reject" href="business_listing-reject/' . $data->id . '" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></a>'
                                : '');
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.business_listing.list');
    }

    public function addBusinessListing(Request $request)
    {
//        'department_associated_with' => 'sometimes|required_if:is_advertising_business,1',
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'nullable|string|max:50',
                'main_category' => 'required|in:Hero 2 Hero,Friends Of Public Safety-Local,Friends Of Public Safety-National',
                'category_id' => 'nullable',
                'business_state_id' => 'nullable',
                'city_id' => 'nullable',
//                'zipcode' => 'nullable',
                'number' => 'nullable',
                'business_description' => 'nullable',
                'service_description' => 'nullable',
                'services_offered_to' => 'nullable',
                'affiliation_dropdown' => 'nullable',
                'id_needed' => 'nullable',
                'address' => 'nullable',
//                'logo' => 'required'
            ));

            //prep data
            $req = $request->all();
            $req['services_offered_to'] = json_encode($req['services_offered_to'] ?? []);
            $req['id_needed'] = json_encode($req['id_needed'] ?? []);
            $req['affiliation_dropdown'] = json_encode($req['affiliation_dropdown'] ?? []);
            $req['is_approved'] = 1;

            $business_listing = BusinessListing::create($req);

            if($request->has('logo')) {
                $business_listing->addMediaFromRequest('logo')->toMediaCollection('business_listing_logos');
            }

            if ($business_listing) {
                return redirect()->route('business_listing')->with(['success' => 'BusinessListing Added Successfully']);
            }
        }

        $categories = Category::all();
        $business_states = BusinessState::all();

        return view('admin.business_listing.add-business_listing', compact('categories', 'business_states'));
    }

    final public function show(int $id){
        $content= BusinessListing::find($id);
        return view('admin.business_listing.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'nullable|string|max:50',
                'main_category' => 'required|in:Hero 2 Hero,Friends Of Public Safety-Local,Friends Of Public Safety-National',
                'category_id' => 'nullable',
                'business_state_id' => 'nullable',
                'city_id' => 'nullable',
//                'zipcode' => 'nullable',
                'number' => 'nullable',
                'business_description' => 'nullable',
                'service_description' => 'nullable',
                'services_offered_to' => 'nullable',
                'affiliation_dropdown' => 'nullable',
                'id_needed' => 'nullable',
                'address' => 'nullable',
//                'logo' => 'required'
            ));

            $business_listing = BusinessListing::find($id);

            if($request->has('logo')) {
                $business_listing->clearMediaCollection('business_listing_logos');
                $business_listing->addMediaFromRequest('logo')->toMediaCollection('business_listing_logos');
            }
//            $business_listing->update($request->all());

            //prep data
            $req = $request->all();
            $req['services_offered_to'] = json_encode($req['services_offered_to'] ?? []);
            $req['id_needed'] = json_encode($req['id_needed'] ?? []);
            $req['affiliation_dropdown'] = json_encode($req['affiliation_dropdown'] ?? []);

//            dd($req);
            if ($business_listing->update($req)) {
                return redirect()->route('business_listing')->with(['success' => 'BusinessListing Edit Successfully']);
            }
        } else {
            $content=BusinessListing::findOrFail($id);
            $categories = Category::all();
            $business_states = BusinessState::all();

            return view('admin.business_listing.add-business_listing', compact('content', 'categories', 'business_states'));
        }
    }

    final public function destroy(int $id)
    {
        $content=BusinessListing::find($id);
        $content->delete();
        echo 1;
    }

    public function approve(Request $request, $id)
    {
        $content = BusinessListing::find($id);
        $content->is_approved = 1;
        $content->save();
        return redirect()->route('business_listing')->with(['success' => 'BusinessListing Approved Successfully']);
    }

    public function reject(Request $request, $id)
    {
        $content = BusinessListing::find($id);
        $content->is_approved = 0;
        $content->save();
        return redirect()->route('business_listing')->with(['success' => 'BusinessListing Rejected Successfully']);
    }

    public function getCityByStates(Request $request, $state_id)
    {
        return Cities::where('state_id', $state_id)->get();
    }

    public function getCountyByStates(Request $request, $state_id)
    {
        return Counties::where('state_id', $state_id)->get();
    }

    public function getCityByCounties(Request $request, $county_id)
    {
        return Cities::where('county_id', $county_id)->get();
    }
}
