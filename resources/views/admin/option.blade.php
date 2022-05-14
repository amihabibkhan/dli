@extends('layouts.admin_layout')

@section('page_title')
    Option
@endsection

@section('css')
    <style>
        form.option_form .form-group input[type="file"]{
            position: relative !important;
            opacity: 1 !important;
        }
    </style>
@endsection
@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="header-title">Theme Options</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('options.update', 'Nothing') }}" class="option_form" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Site title</label>
                                    <input type="text" class="form-control" value="{{ option('site_title') }}" name="site_title">
                                </div>
                                <div class="form-group">
                                    <label for="">Slogan</label>
                                    <input type="text" class="form-control" value="{{ option('slogan') }}" name="slogan">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number 1</label>
                                    <input type="text" class="form-control" value="{{ option('phone_1') }}" name="phone_1">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number 2</label>
                                    <input type="text" class="form-control" value="{{ option('phone_2') }}" name="phone_2">
                                </div>
                                <div class="form-group">
                                    <label for="">Email 1</label>
                                    <input type="email" class="form-control" value="{{ option('email_1') }}" name="email_1">
                                </div>
                                <div class="form-group">
                                    <label for="">Email 2</label>
                                    <input type="email" class="form-control" value="{{ option('email_2') }}" name="email_2">
                                </div>
                                <div class="form-group">
                                    <label for="">Office Address</label>
                                    <input type="text" class="form-control" value="{{ option('address') }}" name="address">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control">{{ option('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Site Icon</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage') }}/{{ option('icon') }}" style="max-height: 50px" alt="">
                                    </div>
                                    <input type="file" class="form-control" name="icon">
                                </div>
                                <div class="form-group">
                                    <label for="">Logo</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage') }}/{{ option('logo') }}" style="max-height: 100px" alt="">
                                    </div>
                                    <input type="file" class="form-control" name="logo">
                                </div>
                                <div class="form-group">
                                    <label for="">Banner (940x788)</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage') }}/{{ option('banner') }}" style="max-height: 200px" alt="">
                                    </div>
                                    <input type="file" class="form-control" name="banner">
                                </div>
                                <input type="submit" class="btn btn-success" value="Update Options">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
