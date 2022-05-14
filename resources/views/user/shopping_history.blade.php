@extends('layouts.frontend_inner_page')

@section('page_title')
    কেনাকাটার তালিকা
@endsection

@section('main_content_inner')
    <!-- dashboard start  -->
    <div class="dashboard my-5">
        <div class="container">
            <div class="card">
                <h5 class="card-header">আমার সব কেনাকাটা</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @include('user.includes.dashboard_menu')
                        </div>
                        <div class="col-md-9 my-3 my-md-0">
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-striped">
                                    <tr>
                                        <th>অর্ডার নাম্বার</th>
                                        <th>তারিখ</th>
                                        <th>মোট</th>
                                        <th>কোর্স</th>
                                        <th>অবস্থা</th>
                                    </tr>
                                    @forelse($transactions as $transaction)
                                        <tr>
                                            <td># {{ $bangla_number->BnNum(str_pad($transaction->id, 5, "0", STR_PAD_LEFT)) }}</td>
                                            <td>{{ bangla_date(strtotime($transaction->created_at),"en") }}</td>
                                            <td>{{ $bangla_number->BnNum($transaction->amount) }}/-</td>
                                            <td>
                                                @foreach($transaction->courses as $course)
                                                    {{ $course->title }}{{ ($loop->index + 1 == count($transaction->courses)) ? '' : ',' }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($transaction->status == 0)
                                                    <span style="color: red">পেন্ডিং</span>
                                                @else
                                                    <span style="color: green">গৃহীত</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4">এখনো কোন কেনাকাটা করা হয়নি।</td></tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard end  -->
@endsection
