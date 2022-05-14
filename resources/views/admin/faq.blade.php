@extends('layouts.admin_layout')

@section('page_title')
    FAQ
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title">All FAQ List</h5>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Add a New FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('faq.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Question </label>
                                                    <input type="text" class="form-control" placeholder="Write a question" name="question">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Answer </label>
                                                    <textarea name="answer" class="form-control" placeholder="Write a answer for the question "></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add FAQ</button>
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
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Last Update</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse($faqs as $single_faq)
                            <tr>
                                <td>{{ $single_faq->question }}</td>
                                <td>{{ $single_faq->answer }}</td>
                                <td style="white-space: nowrap">{{ $single_faq->updated_at->diffForHumans() }}</td>
                                <td class="text-center" style="white-space: nowrap">
{{--                                    <!-- view button -->--}}
{{--                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#view{{ $single_faq->id }}">--}}
{{--                                        View--}}
{{--                                    </button>--}}

{{--                                    <!-- Modal -->--}}
{{--                                    <div class="modal fade" id="view{{ $single_faq->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog" role="document">--}}
{{--                                            <div class="modal-content text-left">--}}
{{--                                                <div class="modal-header">--}}
{{--                                                    <h5 class="modal-title" id="exampleModalLabel">Faq Details</h5>--}}
{{--                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-body text-center">--}}
{{--                                                    <h5>{{ $single_faq->question }}</h5>--}}
{{--                                                    <p>{{ $single_faq->answer }}</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Close</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" data-target="#edit{{ $single_faq->id }}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="edit{{ $single_faq->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update FAQ</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('faq.update', $single_faq->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Question </label>
                                                            <input type="text" value="{{ $single_faq->question }}" class="form-control" placeholder="Write a question" name="question">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Answer </label>
                                                            <textarea name="answer" class="form-control" placeholder="Write a answer for the question ">{{ $single_faq->answer }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update FAQ</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $single_faq->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $single_faq->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete FAQ</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                    <div class="modal-body text-center">
                                                        <h5>Are you sure to delete?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>

                                                        <form action="{{ route('faq.destroy', $single_faq->id) }}" method="post">
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
                                <td colspan="5" class="text-center">No FAQ Found</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
