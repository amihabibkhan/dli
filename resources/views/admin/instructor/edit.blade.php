@extends('layouts.admin_layout')

@section('page_title')
    Update Info
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning p-0">
                    <h5 class="card-title pl-3">Update instructor's information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('instructors.update', $instructor_info->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Instructor Name</label>
                                    <input type="text" name="name" value="{{ $instructor_info->name }}" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Designation/Post</label>
                                    <input type="text" name="designation" value="{{ $instructor_info->designation }}" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="">Profile Image (277x370)</label>
                                    <div>
                                        <img src="{{ asset('storage') }}/{{ $instructor_info->profile_pic }}" class="pb-2" alt="">
                                    </div>
                                    <input type="file" name="profile_pic" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="">Square Size Profile Image (200x200)</label>
                                    <img src="{{ asset('storage') }}/{{ $instructor_info->square_image }}" class="pb-2" alt="">
                                    <input type="file" name="square_image" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Facebook Profile</label>
                                    <input type="text" name="fb" value="{{ $instructor_info->fb }}" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Website Address</label>
                                    <input type="text" name="website" class="form-control" value="{{ $instructor_info->website }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Github Link</label>
                                    <input type="text" name="github" class="form-control" value="{{ $instructor_info->github }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Twitter Profile</label>
                                    <input type="text" name="twitter" class="form-control" value="{{ $instructor_info->twitter }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Freepik Profile</label>
                                    <input type="text" name="freepik" class="form-control" value="{{ $instructor_info->freepik }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Instagram Profile</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ $instructor_info->instagram }}">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Update Info</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="">Description about instructor</label>
                                <textarea id="description" name="about">{{ $instructor_info->about }}</textarea>
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
            selector: '#description',
            plugins: "lists",
            menubar:false,
            height : "1250"
        });
    </script>
@endsection
