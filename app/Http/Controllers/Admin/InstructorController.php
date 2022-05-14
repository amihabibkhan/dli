<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Instructor;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all instructor from database
        $instructors = Instructor::all();
        return view('admin.instructor.instructors', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create');
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
            'name' => 'required',
            'designation' => 'required',
            'about' => 'required',
            'profile_pic' => 'image',
            'square_image' => 'image',
        ]);

        // set default image
        $profile_pic = 'default.jpg';
        $square_image = 'default.jpg';

        if ($request->hasFile('profile_pic')){
            // upload images
            if ($request->hasFile('square_image')){
                $square_image = $request->file('square_image')->store('instructor_square');
            }else{
                $square_image = $request->file('profile_pic')->store('instructor_square');
            }
            $profile_pic = $request->file('profile_pic')->store('instructor');

            // create public path
            $public_path_profile_pic = public_path('storage/' . $profile_pic);
            $public_path_square_image = public_path('storage/' . $square_image);

            // get square image width
            $width = Image::make($public_path_square_image)->width();

            // resize and crop image
            Image::make($public_path_profile_pic)->resize(380,507)->save($public_path_profile_pic);
            Image::make($public_path_square_image)->crop($width, $width, 0,0)->resize(200,200)->save($public_path_square_image);
        }

        // create slug
        $slug = slug_maker($request->name);

        // upload to database
        $instructor = new Instructor();
        $instructor->name = $request->name;
        $instructor->designation = $request->designation;
        $instructor->about = $request->about;
        $instructor->profile_pic = $profile_pic;
        $instructor->square_image = $square_image;
        $instructor->fb = $request->fb;
        $instructor->twitter = $request->twitter;
        $instructor->freepik = $request->freepik;
        $instructor->website = $request->website;
        $instructor->instagram = $request->instagram;
        $instructor->github = $request->github;
        $instructor->save();

        // upload slug to database
        if (Instructor::where('slug', $slug)->exists()){
            $instructor->slug = $slug . '-' . $instructor->id;
        }else{
            $instructor->slug = $slug;
        }
        $instructor->save();

        Toastr::success('Instructor added!', 'Success');
        return redirect(route('instructors.index'));
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
        // get instructor's info
        $instructor_info = Instructor::findOrFail($id);
        return view('admin.instructor.edit', compact('instructor_info'));
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
            'name' => 'required',
            'designation' => 'required',
            'about' => 'required',
            'profile_pic' => 'image',
            'square_image' => 'image',
        ]);

        $instructor = Instructor::find($id);

        // set default image
        $profile_pic = $instructor->profile_pic;
        $square_image = $instructor->square_image;

        if ($request->hasFile('profile_pic')){
            // delete previous images
            Storage::delete($instructor->profile_pic);
            Storage::delete($instructor->square_image);

            // upload images
            if ($request->hasFile('square_image')){
                $square_image = $request->file('square_image')->store('instructor_square');
            }else{
                $square_image = $request->file('profile_pic')->store('instructor_square');
            }
            $profile_pic = $request->file('profile_pic')->store('instructor');

            // create public path
            $public_path_profile_pic = public_path('storage/' . $profile_pic);
            $public_path_square_image = public_path('storage/' . $square_image);

            // get square image width
            $width = Image::make($public_path_square_image)->width();

            // resize and crop image
            Image::make($public_path_profile_pic)->resize(380,507)->save($public_path_profile_pic);
            Image::make($public_path_square_image)->crop($width, $width, 0,0)->resize(200,200)->save($public_path_square_image);
        }

        // create slug
        $slug = slug_maker($request->name);

        // upload to database
        $instructor->name = $request->name;
        $instructor->designation = $request->designation;
        $instructor->about = $request->about;
        $instructor->profile_pic = $profile_pic;
        $instructor->square_image = $square_image;
        $instructor->fb = $request->fb;
        $instructor->twitter = $request->twitter;
        $instructor->freepik = $request->freepik;
        $instructor->website = $request->website;
        $instructor->instagram = $request->instagram;
        $instructor->github = $request->github;
        $instructor->slug = '';
        $instructor->save();

        // upload slug to database
        if (Instructor::where('slug', $slug)->exists()){
            $instructor->slug = $slug . '-' . $instructor->id;
        }else{
            $instructor->slug = $slug;
        }
        $instructor->save();

        Toastr::success('Instructor info updated!', 'Success');
        return redirect(route('instructors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        // others info related with this instructor will be deleted

        // image delete
        Storage::delete($instructor->profile_pic);
        Storage::delete($instructor->square_image);

        // delete instructor finally
        $instructor->delete();

        Toastr::success('Instructor Deleted', 'Success');
        return back();
    }

    // course instructor page view
    public function course_instructor($id)
    {
        $instructor_list = Instructor::all();
        $course = Course::findOrFail($id);
        return view('admin.course.courses_instructor', compact('course', 'instructor_list'));
    }

    // add course instructor
    public function add_course_instructor(Request $request)
    {
        $request->validate([
           'course_id' => 'required',
           'instructor_id' => 'required',
        ]);

        $course = Course::find($request->course_id);
        $course->instructors()->syncWithoutDetaching($request->instructor_id);

        Toastr::success('Instructor Added', 'Success');
        return back();
    }

    // remove course instructor
    public function remove_course_instructor(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'instructor_id' => 'required',
        ]);
        $course = Course::find($request->course_id);
        $course->instructors()->detach($request->instructor_id);

        Toastr::success('Instructor Removed', 'Success');
        return back();
    }
}
