<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteEventController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(SiteEvent::with('user')->get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                        return $formatedDate;
                    })
                    ->addColumn('author', function($data) {
                        return ($data->user->role_id == 1) ? 'Admin' : ($data->user->first_name . ' ' . $data->user->last_name);
                    })
                    ->addColumn('date', function($data) {
                        return getPresentableDate($data->date);
                    })
                    ->addColumn('time', function($data) {
                        return getPresentableTime($data->time);
                    })
                    ->addColumn('image', function($data) {
                        return $data->getMedia('site_event_images')->first() ? $data->getMedia('site_event_images')->first()->getUrl() : asset('front/images/logo.png');
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="site-event-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                            .
                            (is_null($data->is_approved) ?
                                '&nbsp;<a title="Approve" href="site-event-approve/' . $data->id . '" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                &nbsp;<a title="Reject" href="site-event-reject/' . $data->id . '" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></a>'
                                : '');
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.site-event.list');
    }

    final public function show(int $id){
        $content= SiteEvent::find($id);
        return view('admin.site-event.view',compact('content'));
    }

    final public function destroy(int $id)
    {
        $content=SiteEvent::find($id);
        $content->delete();
        echo 1;
    }

    public function approve(Request $request, $id)
    {
        $content = SiteEvent::find($id);
        $content->is_approved = 1;
        $content->save();
        return redirect()->route('site-event')->with(['success' => 'Event Approved Successfully']);
    }

    public function reject(Request $request, $id)
    {
        $content = SiteEvent::find($id);
        $content->is_approved = 0;
        $content->save();
        return redirect()->route('site-event')->with(['success' => 'Event Rejected Successfully']);
    }
}
