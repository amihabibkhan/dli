<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Course;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        $courses = Course::all();
        return view('admin.coupon', compact('coupons', 'courses'));
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
           'title' => 'required',
           'code' => 'required|unique:coupons',
           'percentage' => 'required|numeric|lte:100',
           'expire' => 'required|date',
           'course_id' => 'required',
        ]);

        Coupon::create($request->all());

        Toastr::success('Coupon Added', 'Success');
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
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupons,code,' . $id,
            'percentage' => 'required|numeric|lte:100',
            'expire' => 'required|date',
        ]);
        Coupon::find($id)->update($request->all());

        Toastr::success('Coupon Updated', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        Toastr::success('Coupon Deleted', 'Success');
        return back();
    }
}
