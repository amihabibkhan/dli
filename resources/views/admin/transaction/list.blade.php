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
                        </tr>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ @$transaction->user->name }}</td>
                                <td>{{ $transaction->phone_number }}</td>
                                <td>{{ $transaction->transaction_id }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->coupon }}</td>
                                <td>
                                    @foreach($transaction->courses as $course)
                                        {{ $course->title }}{{ ($loop->index + 1 == count($transaction->courses)) ? '' : ',' }}
                                    @endforeach
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Transaction Found</td>
                            </tr>
                        @endforelse
                    </table>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
