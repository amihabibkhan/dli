<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all course from database
        $courses = Course::orderBy('id', 'desc')->paginate(10);
        return view('admin.course.courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'fee' => 'required',
           'starting_date' => 'required',
           'banner' => 'required|image',
        ]);

        $banner = 'default.jpg';
        $thumbnail = 'default.jpg';

        if ($request->hasFile('banner')){
            // upload image
            $banner = $request->file('banner')->store('course_banner');
            $thumbnail = $request->file('banner')->store('course_thumbnail');

            // create public path
            $public_path_banner = public_path('storage/' . $banner);
            $public_path_thumbnail = public_path('storage/' . $thumbnail);

            // resize image
            Image::make($public_path_banner)->resize(1280,814)->save($public_path_banner);
            Image::make($public_path_thumbnail)->resize(550,350)->save($public_path_thumbnail);
        }

        // create slug
        $slug = slug_maker($request->title);

        // upload to database
        $course = new Course();
        $course->title = $request->title;
        $course->fee = $request->fee;
        $course->overview = $request->overview;
        $course->short_description = $request->short_description;
        $course->starting_date = $request->starting_date;
        $course->banner = $banner;
        $course->thumbnail = $thumbnail;
        $course->save();

        // upload slug to database
        if (Course::where('slug', $slug)->exists()){
            $course->slug = $slug . '-' . $course->id;
        }else{
            $course->slug = $slug;
        }
        $course->save();

        Toastr::success('Course created!', 'Success');
        return redirect(route('courses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course_info = Course::findOrFail($id);
        return view('admin.course.edit', compact('course_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'fee' => 'required',
            'starting_date' => 'required',
            'banner' => 'image',
        ]);

        $course = Course::find($id);

        $banner = $course->banner;
        $thumbnail = $course->thumbnail;

        if ($request->hasFile('banner')){
            // delete previous images
            Storage::delete($course->thumbnail);
            Storage::delete($course->banner);

            // upload image
            $banner = $request->file('banner')->store('course_banner');
            $thumbnail = $request->file('banner')->store('course_thumbnail');

            // create public path
            $public_path_banner = public_path('storage/' . $banner);
            $public_path_thumbnail = public_path('storage/' . $thumbnail);

            // resize image
            Image::make($public_path_banner)->resize(1280,814)->save($public_path_banner);
            Image::make($public_path_thumbnail)->resize(550,350)->save($public_path_thumbnail);
        }

        // create slug
        $slug = slug_maker($request->title);

        // upload to database
        $course->title = $request->title;
        $course->fee = $request->fee;
        $course->overview = $request->overview;
        $course->promo = $request->promo;
        $course->short_description = $request->short_description;
        $course->starting_date = $request->starting_date;
        $course->banner = $banner;
        $course->thumbnail = $thumbnail;
        $course->slug = '';
        $course->save();

        // upload slug to database
        if (Course::where('slug', $slug)->exists()){
            $course->slug = $slug . '-' . $course->id;
        }else{
            $course->slug = $slug;
        }
        $course->save();

        Toastr::success('Course Updated!', 'Success');
        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        // have to delete all others data related with this course
        // like enrolls, payment, videos history etc

        // delete image of this course
        Storage::delete($course->thumbnail);
        Storage::delete($course->banner);

        // delete course
        $course->delete();

        Toastr::success('Course Deleted', 'Success');
        return back();
    }
}
