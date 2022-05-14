<?php

namespace App\Http\Controllers\Frontend;

use App\Course;
use App\Faq;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Review;
use App\Term;
use Illuminate\Http\Request;

class AllviewController extends Controller
{
    public function index()
    {
        // get popular courses for home page
        $courses = Course::orderBy('id', 'desc')->get();
        return view('frontend.index', compact('courses'));
    }

    // about page view
    public function aboutUs()
    {
        // get instructor
        $instructors = Instructor::take(4)->get();
        return view('frontend.pages.single_page.about', compact('instructors'));
    }

    // contact page view
    public function contactUs()
    {
        return view('frontend.pages.single_page.contact');
    }

    // faq page view
    public function faq()
    {
        // get all faq
        $faqs = Faq::all();
        return view('frontend.pages.single_page.faq', compact('faqs'));
    }

    // terms page view
    public function terms()
    {
        // get all terms from database
        $terms = Term::all();
        return view('frontend.pages.single_page.terms', compact('terms'));
    }

    // course details page view
    public function course_details($slug)
    {
        // get course data from database
        if (Course::where('slug', $slug)->exists()){
            $course_info = Course::where('slug', $slug)->first();
        }else{
            return abort(404);
        }

        $total_review = Review::where([
            ['course_id', $course_info->id],
            ['rating', '!=', null]
        ])->count();
        $average_rating = rating_calculator($course_info->reviews->sum('rating'), $total_review);

        return view('frontend.pages.course.course_details', compact('course_info', 'average_rating', 'total_review'));
    }

    // course details page view
    public function singleInstructor($slug)
    {
        // get course data from database
        if (Instructor::where('slug', $slug)->exists()){
            $instructor_info = Instructor::where('slug', $slug)->first();
        }else{
            return abort(404);
        }

        return view('frontend.pages.instructor.single_instructor', compact('instructor_info'));
    }

    // all course view page
    public function allCourse()
    {
        $courses = Course::orderBy('id', 'desc')->paginate(9);
        return view('frontend.pages.course.all_courses', compact('courses'));
    }

    // all course view page
    public function allInstructor()
    {
        $instructors = Instructor::orderBy('id', 'desc')->paginate(8);
        return view('frontend.pages.instructor.all_instructor', compact('instructors'));
    }

    // search
    public function search(Request $request)
    {
        $courses = Course::where('title', 'like', '%' . $request->search . '%')->get();
        return view('frontend.pages.course.search_course', compact('courses'));
    }
}
