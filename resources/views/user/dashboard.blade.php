@extends('layouts.frontend_inner_page')

@section('page_title')
    ডেশবোর্ড
@endsection

@section('main_content_inner')
    <!-- dashboard start  -->
    <div class="dashboard my-5">
        <div class="container">
            <div class="card">
                <h5 class="card-header">স্বাগতম {{ auth::user()->name }}</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @include('user.includes.dashboard_menu')
                        </div>
                        <div class="col-md-9 d-flex align-items-center my-3 my-md-0">
                            ডেশবোর্ডে আপনাকে স্বাগতম। আপনি আপনার ডেশবোর্ড এ আপনার এনরোল করা কোর্স গুলো দেখতে পাবেন। পাশাপাশি আপনার একাউন্ট সেটিংস, পাসওয়ার্ড চেইঞ্জ, লেনদেন গুলোও এখানে খুজে পাবেন।
                            <br>
                            <br> আমাদের সাথে থাকার জন্য ধন্যবাদ
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard end  -->
@endsection
