@extends('layouts.admin_layout')

@section('page_title')
    Course Instructor
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">Instructor List of {{ $course->title }}</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add">
                                Add New
                            </button>
                            <a href="{{ route('courses.index') }}" class="btn btn-success">Back</a>

                            <!-- Modal -->
                            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add a new Instructor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('add_course_instructor') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $course->id }}" name="course_id">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Select an Instructor</label>
                                                    <select name="instructor_id" class="form-control">
                                                        @foreach($instructor_list as $single_instructor)
                                                            <option value="{{ $single_instructor->id }}">{{ $single_instructor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success mr-2">Add Instructor</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Profile Pic</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse($course->instructors as $instructor)
                            <tr>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->designation }}</td>
                                <td><img src="{{ asset('storage') }}/{{ $instructor->square_image }}" height="70" alt=""></td>
                                <td class="text-center" style="white-space: nowrap">
                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $instructor->id }}">
                                        Remove
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $instructor->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Remove Instructor</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h5>Are you sure to Remove this instructor?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('remove_course_instructor') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $instructor->id }}" name="instructor_id">
                                                        <input type="hidden" value="{{ $course->id }}" name="course_id">
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Instructor Found For this course</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
