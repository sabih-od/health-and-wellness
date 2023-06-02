<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumTopic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ForumTopicController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(ForumTopic::with('user', 'forum_category')->get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                        return $formatedDate;
                    })
                    ->addColumn('author', function($data) {
                        return ($data->user->role_id == 1) ? 'Admin' : ($data->user->first_name . ' ' . $data->user->last_name);
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="forum-topic-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.forum-topic.list');
    }

    final public function show(int $id){
        $content= ForumTopic::find($id);
        return view('admin.forum-topic.view',compact('content'));
    }

    final public function destroy(int $id)
    {
        $content=ForumTopic::find($id);
        $content->delete();
        echo 1;
    }
}
