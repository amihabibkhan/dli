@extends('layouts.frontend_inner_page')

@section('page_title') সার্চ @endsection

@section('css')
    <style>
        .course_search_button {
            position: absolute;
            right: 0;
            top: 0;
            height: 50px;
            background: var(--main-color);
            border: none;
            width: 50px;
            outline: 0;
            color: var(--white-color);
            -webkit-transition: var(--transition);
            transition: var(--transition);
            padding: 0;
        }
    </style>
@endsection

@section('main_content_inner')
    <!-- Start Popular Courses Area -->
    <section class="courses-area-style ptb-100">
        <div class="container">
            <div class="showing-result">
                <div class="row justify-content-end">

                    <div class="col-lg-3 col-md-4">
                        <form class="search-form" action="{{ route('search') }}" method="get">
                            <input class="form-control" name="search" placeholder="কোর্স খুজুন" type="text">
                            <button class="course_search_button" type="submit">
                                <i class="bx bx-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($courses as $course)
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

                                <p>
                                    {{ $course->short_description }}
                                </p>

                                <ul class="lessons">
                                    <li>১৫টি অধ্যায়</li>
                                    <li class="float">৪৪ জন শিক্ষার্থী</li>
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
        </div>
    </section>
    <!-- End Popular Courses Area -->
@endsection
