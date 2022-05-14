<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.option');
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
        //
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
//        $request->validate([
//           'site_title' => 'required',
//           'slogan' => 'required',
//           'logo' => 'image',
//           'icon' => 'image',
//           'banner' => 'image',
//           'address' => 'required',
//           'email_1' => 'required',
//           'phone_1' => 'required'
//        ]);

        $options = Option::all();
        foreach ($options as $option){
            $make_field_name = $option->title;
            if ($make_field_name == 'logo' || $make_field_name == 'icon' || $make_field_name == 'banner'){
                if (empty($request->$make_field_name)){
                    continue;
                }
                Storage::delete($option->value);
                $path = $request->file($make_field_name)->store($make_field_name);

                // make public path
                $public_path = public_path('storage/' . $path);
                if ($make_field_name == 'logo'){
                    Image::make($public_path)->resize(null, 50, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($public_path);
                }
                if ($make_field_name == 'icon'){
                    Image::make($public_path)->resize(30, 30)->save($public_path);
                }
                if ($make_field_name == 'banner'){
                    Image::make($public_path)->resize(940, 788)->save($public_path);
                }
                // update path
                $option->value = $path;
                $option->save();

                // continue loop
                continue;
            }
            $option->value = $request->$make_field_name;
            $option->save();
        }
        Toastr::success('Option Updated');
        return back();
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
