@extends('layouts.frontend_layout')

@section('page_title')
    @yield('page_title')
@endsection

@section('main_content')
    <!-- Start Page Title Area -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>
                    @yield('page_title')
                </h2>
                <ul>
                    <li>
                        <a href="{{ route('index') }}">
                            হোম
                        </a>
                    </li>

                    <li class="active">
                        @yield('page_title')
                    </li>
                </ul>
                @yield('banner_button')
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    @yield('main_content_inner')
@endsection
