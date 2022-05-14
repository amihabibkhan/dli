@extends('layouts.admin_layout')

@section('page_title')
    Transaction
@endsection

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Transaction List</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>User</th>
                            <th>From</th>
                            <th>TID</th>
                            <th>Amount</th>
                            <th>Coupon</th>
                            <th>Courses</th>
                            <th class="text-center">Action</th>
                        </tr>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->phone_number }}</td>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->coupon }}</td>
                                <td>
                                    @foreach($transaction->courses as $course)
                                        {{ $course->title }}{{ ($loop->index + 1 == count($transaction->courses)) ? '' : ',' }}
                                    @endforeach
                                </td>
                                <td class="text-center" style="white-space: nowrap">
                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#accept{{ $transaction->id }}">
                                        Accept
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="accept{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Accept Transaction</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h5>Are you sure to Accept this transaction?</h5>
                                                    <p>NB: All course will be activated for this user.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Cancel</button>

                                                    <a href="{{ route('acceptTransaction', $transaction->id) }}" class="btn btn-success">Accept</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $transaction->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Transaction</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h5>Are you sure to delete?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success mr-2" data-dismiss="modal">Cancel</button>

                                                    <form action="{{ route('transaction.destroy', $transaction->id) }}" method="post">
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
                                <td colspan="7" class="text-center">No Transaction Found</td>
                            </tr>
                        @endforelse
                    </table>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
