<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class VideoController extends Controller
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
           'module_id' => 'required',
           'title' => 'required',
           'link' => 'required',
           'type' => 'required',
        ]);
        $preview = 2;
        if ($request->preview){
            $preview = 1;
        }

        $video = new Video();
        $video->module_id = $request->module_id;
        $video->title = $request->title;
        $video->link = $request->link;
        $video->type = $request->type;
        $video->preview = $preview;
        $video->save();

        Toastr::success('Video Added', 'Success');
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
            'link' => 'required',
            'type' => 'required',
        ]);
        $video = Video::find($id);

        if ($request->preview){
            $preview = 1;
        }else{
            $preview = 2;
        }
        $video->title = $request->title;
        $video->link = $request->link;
        $video->type = $request->type;
        $video->preview = $preview;
        $video->save();

        Toastr::success('Video Updated', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->users()->detach();
        $video->delete();

        Toastr::success('Video Deleted', 'Success');
        return back();
    }
}
