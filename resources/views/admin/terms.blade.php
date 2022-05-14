@extends('layouts.admin_layout')

@section('page_title')
    Terms
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">All Term List</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new">
                                Add New
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-left">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add a New Term</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('terms.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Term </label>
                                                    <textarea name="terms" class="form-control" placeholder="Write a Term"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Term</button>
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
                            <th>Term Details</th>
                            <th>Last Update</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse($terms as $single_term)
                            <tr>
                                <td>{{ $single_term->terms }}</td>
                                <td style="white-space: nowrap">{{ $single_term->updated_at->diffForHumans() }}</td>
                                <td class="text-center" style="white-space: nowrap">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" data-target="#edit{{ $single_term->id }}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit{{ $single_term->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Term</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('terms.update', $single_term->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Term </label>
                                                            <textarea name="terms" class="form-control" placeholder="Write a Term">{{ $single_term->terms }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Term</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $single_term->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $single_term->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Term</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Are you sure to delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>

                                                        <form action="{{ route('terms.destroy', $single_term->id) }}" method="post">
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
                                <td colspan="5" class="text-center">No Term Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
