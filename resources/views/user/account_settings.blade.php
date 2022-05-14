@extends('layouts.frontend_inner_page')

@section('page_title')
    একাউন্ট সেটিংস
@endsection

@section('main_content_inner')
    <!-- dashboard start  -->
    <div class="dashboard my-5">
        <div class="container">
            <div class="card">
                <h5 class="card-header">একাউন্ট সেটিংস</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @include('user.includes.dashboard_menu')
                        </div>
                        <div class="col-md-9 my-3 my-md-0">
                            @if(session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            @if(session('error_message'))
                                <div class="alert alert-danger">{{ session('error_message') }}</div>
                            @endif
                            <form action="{{ route('updateAccount') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">নাম</label>
                                            <input type="text" name="name" class="form-control" value="{{ auth::user()->name }}">
                                            @error('name')
                                                <div style="padding-top: 5px">
                                                    <i style="color: red">{{ $message }}</i>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">ফোন নাম্বার</label>
                                            <input type="text" name="phone" class="form-control" value="{{ auth::user()->phone }}">
                                            @error('phone')
                                                <div style="padding-top: 5px">
                                                    <i style="color: red">{{ $message }}</i>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">পূরাতন পাসওয়ার্ড (ইমেইল এবং পাসওয়ার্ড পরিবর্তন করার ক্ষেত্রে পুরাতন পাসওয়ার্ডটি দিতে হবে)</label>
                                            <input type="password" name="old_password" class="form-control">
                                            @error('old_password')
                                                <div style="padding-top: 5px">
                                                    <i style="color: red">{{ $message }}</i>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">ই-মেইল</label>
                                            <input type="email" name="email" class="form-control" value="{{ auth::user()->email }}">
                                            @error('email')
                                                <div style="padding-top: 5px">
                                                    <i style="color: red">{{ $message }}</i>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">নতুন পাসওয়ার্ড</label>
                                            <input type="password" name="new_password" class="form-control">
                                            @error('new_password')
                                                <div style="padding-top: 5px">
                                                    <i style="color: red">{{ $message }}</i>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="default-btn mt-2">আপডেট করুন</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard end  -->
@endsection
