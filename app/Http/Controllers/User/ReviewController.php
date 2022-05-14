<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Review;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
           'course_id' => 'required',
           'rating' => 'required',
        ],[
            'rating.required' => 'রেটিং ছাড়া রিভিউ গ্রহণযোগ্য নয়'
        ]);
        if (empty($request->rating) && empty($request->review)){
            Toastr::error('রিভিউটি সম্পন্ন হয়নি', 'দুঃখিত!');
            return back();
        }
        Review::create([
           'course_id' => $request->course_id,
           'user_id' => Auth::id(),
           'rating' => $request->rating,
           'review' => $request->review
        ]);
        Toastr::success('আপনার রিভিউটি সাবমিট হয়েছে!', 'ধন্যবাদ');
        return back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
