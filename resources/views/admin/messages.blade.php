@extends('layouts.admin_layout')

@section('page_title')
    Message
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Message List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Message</th>
                            <th>Sender</th>
                            <th>Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse($messages as $single_message)
                            <tr>
                                <td>{{ $single_message->details }}</td>
                                <td>{{ $single_message->name }}</td>
                                <td style="white-space: nowrap">{{ $single_message->created_at->diffForHumans() }}</td>
                                <td class="text-center" style="white-space: nowrap">
                                    <!-- view button -->
                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#view{{ $single_message->id }}">
                                        View
                                    </button>

                                    <!-- Modal -->
                                    <div style="white-space: normal" class="modal fade" id="view{{ $single_message->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Message Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <p>Sender: <b>{{ $single_message->name }}</b></p>
                                                    <p>Sender E-mail: <b>{{ $single_message->email }}</b></p>
                                                    <p>Subject: <b>{{ $single_message->subject }}</b></p>
                                                    <hr>
                                                    <p>{{ $single_message->details }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <!-- Button trigger modal -->

                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $single_message->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $single_message->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h5>Are you sure to delete?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>

                                                    <form action="{{ route('messages.destroy', $single_message->id) }}" method="post">
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
                                <td colspan="5" class="text-center">No Message Found</td>
                            </tr>
                        @endforelse
                    </table>
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
