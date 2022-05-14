@extends('layouts.frontend_inner_page')

@section('page_title') কোর্স তালিকা @endsection


@section('main_content_inner')
    <!-- Start Popular Courses Area -->
    <section class="courses-area-style ptb-100">
        <div class="container">
            <div class="showing-result">
                <div class="row justify-content-end">

                    <div class="col-lg-3 col-md-4">
                        <form class="search-form">
                            <input class="form-control" name="search" placeholder="কোর্স খুজুন" type="text">
                            <button class="search-btn" type="submit">
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

                <style>
                    .pagination-area .pagination{
                        display: block;
                    }
                    .pagination-area .page-item {
                        width: 40px;
                        height: 40px;
                        line-height: 40px;
                        color: var(--heading-color);
                        text-align: center;
                        display: inline-block;
                        position: relative;
                        margin-left: 5px;
                        margin-right: 5px;
                        font-size: 18px;
                        background-color: #f5f6fa;
                        border: 0;
                    }
                    .pagination-area .page-item.active .page-link {
                        z-index: 3;
                        color: #fff;
                        background-color: #ffb607;
                        border-color: #ffb607;
                    }
                </style>
                <div class="col-lg-12 col-md-12">
                    <div class="pagination-area">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Popular Courses Area -->
@endsection
