@extends('layouts.frontend_inner_page')

@section('page_title') {{ $instructor_info->name }} @endsection

@section('og_description') {{ $instructor_info->name }} আমাদের একজন পপুলার ইন্সট্রাটর। @endsection

@section('og_image') {{ asset('storage') }}/{{ $instructor_info->square_image }} @endsection

@section('css')
    <style>
        .course_overview ul{
            padding-left: 10px;
            margin-bottom: 15px;
            margin-top: 15px;
        }
        .course_overview ul li{
            position: relative;
            padding-left: 35px;
            margin-bottom: 15px;
        }
        .course_overview ul li:before {
            font-family: 'Font Awesome 5 Free';
            content: "\f00c";
            display: inline-block;
            padding-right: 15px;
            vertical-align: middle;
            font-weight: 900;
            color: #ffb607;
        }
        .course_overview blockquote {
            background: #f9f9f9;
            border-left: 10px solid #ccc;
            margin: 1.5em 10px;
            padding: 0.5em 10px;
            quotes: "\201C""\201D""\2018""\2019";
        }
        .course_overview blockquote:before {
            color: #ccc;
            content: open-quote;
            font-size: 4em;
            line-height: 0.1em;
            margin-right: 0.25em;
            vertical-align: -0.4em;
        }
        .course_overview blockquote p {
            display: inline;
        }
        .course_overview ol {
            list-style: none;
            counter-reset: item;
        }
        .course_overview ol li {
            counter-increment: item;
            margin-bottom: 15px;
        }
        .course_overview ol li:before {
            margin-right: 15px;
            content: counter(item);
            background: #ffb607;
            /*border-radius: 100%;*/
            color: white;
            width: 1.2em;
            text-align: center;
            display: inline-block;
            border-top-left-radius: 50%;
            border-bottom-right-radius: 50%;
        }
    </style>
@endsection

@section('main_content_inner')
    <!-- Start Single Event Area -->
    <section class="single-event-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-2 order-md-1">
                    <div class="course_overview">
                        <h2 class="text-center"><strong>{{ $instructor_info->name }} সম্পর্কে</strong></h2>
                        {!! $instructor_info->about !!}
                    </div>
                </div>

                <div class="col-lg-4 order-1 order-md-2">
                    <div class="single-teachers">
                        <img style="width: 100%" src="{{ asset('storage') }}/{{ $instructor_info->profile_pic }}" alt="Image">

                        <div class="teachers-content">
                                <ul>
                                    @if($instructor_info->fb)
                                        <li>
                                            <a href="{{ $instructor_info->fb }}" title="Facebook Profile Link" target="_blank"><i class="bx bxl-facebook"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor_info->instagram)
                                        <li>
                                            <a href="{{ $instructor_info->instagram }}" title="Instagram Profile Link" target="_blank"><i class="bx bxl-instagram"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor_info->twitter)
                                        <li>
                                            <a href="{{ $instructor_info->twitter }}" title="Twitter Profile Link" target="_blank"><i class="bx bxl-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor_info->freepik)
                                        <li>
                                            <a href="{{ $instructor_info->freepik }}" title="Freepik Profile Link" target="_blank"><img src="{{ asset('frontend/icons/freepik.svg') }}" style="width: 20px; margin-top: -8px" alt=""></a>
                                        </li>
                                    @endif
                                    @if($instructor_info->website)
                                        <li>
                                            <a href="{{ $instructor_info->website }}" title="Website Address Link" target="_blank"><i class="bx bx-globe"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor_info->github)
                                        <li>
                                            <a href="{{ $instructor_info->github }}" title="Github Link" target="_blank"><i class="bx bxl-github"></i></a>
                                        </li>
                                    @endif
                                </ul>

                                <h3>{{ $instructor_info->name }}</h3>
                                <span>{{ $instructor_info->designation }}</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Single Event Area -->

    <!-- Start Teachers Area -->
    <section class="courses-area pt-100 pb-70" style="background-color: #f7f7f7;">
        <div class="container">
            <div class="section-title">
                <h2>এই ট্রেইনারের কোর্স তালিকা</h2>
            </div>

            <div class="row">
                @forelse($instructor_info->courses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-course">
                            <a href="{{ route('course_details', $course->slug) }}">
                                <img src="{{ asset('storage') }}/{{ $course->thumbnail }}" alt="Image">
                            </a>

                            <div class="course-content">
                        <span class="price">
                            @if($course->fee == 0)
                                ফ্রি
                            @else
                                {{ $bangla_number->bnNum($course->fee) }}/-
                            @endif
                        </span>

                                <a href="{{ route('course_details', $course->slug) }}">
                                    <h3>{{ $course->title }}</h3>
                                </a>

                                <p class="course_short_details">
                                    {{ $course->short_description }}
                                </p>

                                <ul class="lessons">
                                    <li>{{ $bangla_number->BnNum(count($course->modules)) }} টি অধ্যায়</li>
                                    <li class="float">{{ $bangla_number->BnNum(count($course->users)) }} জন শিক্ষার্থী</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <h2 class="text-center">
                            কোন কোর্স খুজে পাওয়া যায় নি।
                        </h2>
                    </div>
                @endforelse
            </div>
            <!-- End Popular Courses Area -->

        </div>
    </section>
    <!-- End Teachers Area -->
@endsection
