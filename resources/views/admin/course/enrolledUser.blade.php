@extends('layouts.admin_layout')

@section('page_title')
    Enrolled User List
@endsection

@section('main_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Enrolled User List of {{ $course->title }}</h5>
                    <form action="{{ route('sendMessageToAll') }}" method="POST">
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <textarea name="message" class="form-control" placeholder="Send a Message to All User" style="padding: 15px"></textarea>
                            </div>
                            <div class="col-md-2">
                                <button onclick="return confirm('Are you sure to send?')" class="btn btn-dark form-control">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table text-center table-bordered table-striped table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @foreach($course->users()->paginate(30) as $single_user)
                            <tr>
                                <td>{{ $single_user->name }}</td>
                                <td>{{ $single_user->phone }}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure to remove this user?')" href="{{ route('removeUserFromCourse', [$course->id, $single_user->id]) }}">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $course->users()->paginate(30)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
