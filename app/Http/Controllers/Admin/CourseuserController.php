<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Module;
use App\User;
use App\Video;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CourseuserController extends Controller
{
    public function userList($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('admin.course.enrolledUser', compact('course'));
    }

    // remove an user from a course
    public function removeUserFromCourse($course_id, $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->courses()->detach($course_id);

        // remove user video seen list
        $modules = Module::select('id')->where('course_id', $course_id)->get();
        $videos = Video::select('id')->whereIn('module_id', $modules)->get();

        $user->videos()->detach($videos);

        Toastr::success('Removed', 'User removed from the Course');
        return back();
    }

    // send message to all
    public function sendMessageToAll(Request $request)
    {
        $request->validate([
            'course_id' => 'required'
        ]);
        $course = Course::findOrFail($request->course_id);
        $numbers = '';

        foreach ($course->users as $single_user){
            $numbers .= $single_user->phone . ', ';
        }

        sendSms($numbers, $request->message);

        Toastr::success('Success', 'A message has sent to all user of this course');
        return back();
    }
}



