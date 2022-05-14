@extends('layouts.admin_layout')

@section('page_title')
    Create Instructor
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning p-0">
                    <h5 class="card-title pl-3">Create a New Instructor</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('instructors.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Instructor Name</label>
                                    <input type="text" name="name" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Designation/Post</label>
                                    <input type="text" name="designation" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="">Profile Image (380x507)</label>
                                    <input type="file" name="profile_pic" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label for="">Square Size Profile Image (200x200)</label>
                                    <input type="file" name="square_image" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Facebook Profile</label>
                                    <input type="text" name="fb" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Website Address</label>
                                    <input type="text" name="website" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Github Link</label>
                                    <input type="text" name="github" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Twitter Profile</label>
                                    <input type="text" name="twitter" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Freepik Profile</label>
                                    <input type="text" name="freepik" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Instagram Profile</label>
                                    <input type="text" name="instagram" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success">Create Instructor</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="">Description about instructor</label>
                                <textarea id="description" name="about"></textarea>
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
            height : "700"
        });
    </script>
@endsection
