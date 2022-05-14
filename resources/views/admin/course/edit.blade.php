@extends('layouts.admin_layout')

@section('page_title')
    Update Course
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning p-0">
                    <h5 class="card-title pl-3">Update Course Info</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course_info->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Course Title</label>
                                    <input type="text" value="{{ $course_info->title }}" name="title" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Promo Video</label>
                                    <input type="text" value="{{ $course_info->promo }}" name="promo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Starting Date</label>
                                    <input type="date" value="{{ $course_info->starting_date }}" name="starting_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Course Fee</label>
                                    <input type="number" value="{{ $course_info->fee }}" name="fee" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="">Short Description</label>
                                    <textarea name="short_description" class="form-control">{{ $course_info->short_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Course Banner (1280x814)</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage') }}/{{ $course_info->banner }}" width="100%" alt="">
                                    </div>
                                    <input type="file" name="banner" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Update Course</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="">Course Overview</label>
                                <textarea id="course_overview" name="overview">{{ $course_info->overview }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.2/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: '#course_overview',
            plugins: "lists",
            menubar:false,
            height : "600"
        });
    </script>
@endsection
