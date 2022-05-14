@extends('layouts.admin_layout')

@section('page_title')
    Instructor List
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">All Instructor List</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Button trigger modal -->
                            <a href="{{ route('instructors.create') }}" type="button" class="btn btn-primary">
                                Add New
                            </a>
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
                        @forelse($instructors as $instructor)
                            <tr>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->designation }}</td>
                                <td><img src="{{ asset('storage') }}/{{ $instructor->square_image }}" height="70" alt=""></td>
                                <td class="text-center" style="white-space: nowrap">
                                    <a href="{{ route('instructors.edit', $instructor->id) }}" class="btn btn-secondary mr-2">Edit</a>
                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $instructor->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $instructor->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Instructor</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Are you sure to delete?</h5>
                                                        <h6>NB: All Data will be deleted of this Instructor.</h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>

                                                        <form action="{{ route('instructors.destroy', $instructor->id) }}" method="post">
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
                                <td colspan="5" class="text-center">No Instructor Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
