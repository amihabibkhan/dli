@extends('layouts.admin_layout')

@section('page_title')
    Create Course
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning p-0">
                    <h5 class="card-title pl-3">Create a New Course</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Course Title</label>
                                    <input type="text" name="title" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Starting Date</label>
                                    <input type="date" name="starting_date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Course Fee</label>
                                    <input type="number" name="fee" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="">Course Banner (1280x814)</label>
                                    <input type="file" name="banner" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="">Short Description</label>
                                    <textarea name="short_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Create Course</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="">Course Overview</label>
                                <textarea id="course_overview" name="overview"></textarea>
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
            height : "350"
        });
    </script>
@endsection
