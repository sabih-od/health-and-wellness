<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class CourseController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Course::get())
                    ->addIndexColumn()
//                    ->addColumn('attachment', function ($data) {
//                        return $data->get_course_attachment();
//                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="course-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="course/edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.course.list');
    }

    public function addCourse(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'title' => 'required|string|max:50',
                'description' => 'required|string',
                'category_id' => 'required',
                'price' => 'required',
            ));


            $course = Course::create([
                'course_title' => $request->input('title'),
                'course_description' => $request->input('description'),
                'time_detail' => $request->input('time_detail'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
            ]);

            if ($request->has('attachment')) {
                $course->addMediaFromRequest('attachment')->toMediaCollection('course_attachment');
            }

            if ($course) {
                return redirect()->route('admin.courses')->with(['success' => 'Course Added Successfully']);
            }
        }

        $categories = Category::all();

        return view('admin.course.add-course', compact('categories'));
    }

    final public function show(int $id)
    {
        $content = Course::find($id);
        return view('admin.course.view', compact('content'));
    }

    final public function edit(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'title' => 'required|string|max:50',
                'description' => 'required|string',
                'category_id' => 'required',
                'price' => 'required',
            ));

            $course = Course::find($id);

            $course->course_title = $request->input('title');
            $course->course_description = $request->input('description');
            $course->time_detail = $request->input('time_detail');
            $course->price = $request->input('price');
            $course->category_id = $request->input('category_id');

            if ($request->has('attachment')) {
                $course->clearMediaCollection('course_attachment');
                $course->addMediaFromRequest('attachment')->toMediaCollection('course_attachment');
            }


            if ($course->save()) {
                return redirect()->route('admin.courses')->with(['success' => 'Course Edit Successfully']);
            }
        } else {
            $content = Course::findOrFail($id);
            $categories = Category::all();

            return view('admin.course.add-course', compact('content', 'categories'));
        }
    }

    final public function destroy(int $id)
    {
        $content = Course::find($id);
        $content->delete();
        echo 1;
    }


}
