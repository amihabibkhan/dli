@extends('layouts.admin_layout')

@section('page_title')
    Course List
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">All Course List</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Button trigger modal -->
                            <a href="{{ route('courses.create') }}" type="button" class="btn btn-primary">
                                Add New
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table text-center table-bordered table-striped table-hover">
                        <tr>
                            <th>Title</th>
                            <th>Starting Date</th>
                            <th>Total Enrolled</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse($courses as $single_course)
                            <tr>
                                <td>{{ $single_course->title }}</td>
                                <td>{{ date_maker($single_course->starting_date, 'd M, Y') }}</td>
                                <td>
                                    <a href="{{ route('courseUserList', $single_course->id) }}">
                                        {{ count($single_course->users) }}
                                    </a>
                                </td>

                                <td class="text-center" style="white-space: nowrap">
                                    <a href="{{ route('course_details', $single_course->slug) }}" class="btn btn-info mr-2" target="_blank">Preview</a>
                                    <a href="{{ route('modules.show', $single_course->id) }}" class="btn btn-warning mr-2">Module ({{ count($single_course->modules) }})</a>
                                    <a href="{{ route('courses.edit', $single_course->id) }}" class="btn btn-secondary mr-2">Edit</a>
                                    <a href="{{ route('course_instructor', $single_course->id) }}" class="btn btn-success mr-2">Instructor ({{ count($single_course->instructors) }})</a>
                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $single_course->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $single_course->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Course</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Are you sure to delete?</h5>
                                                        <h6>NB: All Data will be deleted of this course.</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>

                                                        <form action="{{ route('courses.destroy', $single_course->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Course Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
