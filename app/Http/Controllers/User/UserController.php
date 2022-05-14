<?php

namespace App\Http\Controllers\User;

use App\Course;
use App\Http\Controllers\Controller;
use App\Module;
use App\Transaction;
use App\User;
use App\Video;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // user dashboard view
    public function dashboard()
    {
        return view('user.dashboard');
    }

    // account settings page view
    public function accountSettings()
    {
        return view('user.account_settings');
    }

    // update profile
    public function updateAccount(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|min:11',
        ],[
            'name.required' => 'নাম দিতে হবে',
            'name.string' => 'একটি সঠিক নাম দিন',
            'name.max' => 'নাম টি বড় হয়ে গেছে, একটি ছোট নাম দিন',

            'email.required' => 'ই-মেইল দেননি',
            'email.string' => 'ই-মেইল টি সঠিক নয়',
            'email.email' => 'ই-মেইল টি সঠিক নয়',
            'email.unique' => 'ই-মেইল টি আগে ব্যবহৃত হয়েছে',

            'password.required' => 'পাসওয়ার্ড দিন',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ ক্যারেক্টার হতে হবে',
            'password.confirmed' => 'পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মিলেনি',

            'phone.required' => 'আপনার ফোন নাম্বার দিন',
            'phone.min' => 'ফোন নাম্বার কমপক্ষে ১১ ডিজিটের হতে হবে',
        ]);
        if ($request->old_password){
            if (Hash::check($request->old_password, $user->password)){
                if ($request->new_password){
                    $request->validate([
                        'new_password' => 'min:8',
                    ],[
                        'new_password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ ক্যারেক্টার হতে হবে',
                    ]);
                    $user->password = Hash::make($request->new_password);
                }
                $user->email = $request->email;
            }else{
                return back()->with('error_message','আাপনার পুরাতন পাসওয়ার্ডটি মেলেনি!');
            }
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('message', 'তথ্যগুলো আপডেট হয়েছে।');
    }

    // user course list
    public function userCourseList()
    {
        // get all course from database of this user
        $courses = Auth::user()->courses()->paginate(9);
        return view('user.all_courses',compact('courses'));
    }

    // shopping history page
    public function shoppingHistory()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('user.shopping_history', compact('transactions'));
    }

    // course video
    public function courseVideos($slug, $video_id = null)
    {
        $course_info = Course::where('slug', $slug)->first();
        $modules = Module::where('course_id', $course_info->id)->get();
        if (count($modules) > 0){
            if (count($modules[0]->videos) > 0){
                if ($video_id == null){
                    $active_video = $modules[0]->videos[0];
                }else{
                    $active_video = Video::findOrFail($video_id);
                }
                $user = User::find(Auth::id());
                $user->videos()->syncWithoutDetaching($active_video->id);
                return view('user.course_videos', compact('course_info', 'modules', 'active_video'));
            }
        }
        Toastr::error('এই কোর্সে এখনো কোন ভিডিও আপলোড দেওয়া হয় নি!', 'দুঃখিত।');
        return redirect(route('userCourseList'));
    }
}
