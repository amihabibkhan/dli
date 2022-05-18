@extends('layouts.frontend_layout')

@section('page_title') হোম - ডেনিং ল@endsection

@section('main_content')

    <style>

    </style>

    <section class="custom_banner">
        <div class="container">
            <img src="{{ asset("frontend/img/banner_img.png") }}" alt="">
            <div class="row">
                <div class="col">
                    <h2>{{ option('slogan') }}</h2>
                    <h1>{{ option('site_title') }}</h1>
                    <a href="#our_course" class="banner_button">আমাদের কোর্স সমূহ</a>
                </div>
            </div>
        </div>
    </section>



    <!-- Start Achieve Area -->
    <section class="achieve-area f5f6fa-bg-color pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>আমাদের কোর্স গুলো</h2>
            </div>

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-achieve">
                        <div class="achieve-shape shape-1">
                            <img src="{{ asset('frontend') }}/img/achieve-shape/achieve-shape-1.png" alt="Image">
                        </div>

                        <h3>গুছালো</h3>
                        <p>আমাদের কোর্সগুলোতে আমরা চেষ্টা করেছি কোর্সের সকল কনটেন্ট গুলো গুছিয়ে রাখতে, যাতে প্রয়োজনের সময় যে কোন কিছু খুঁজে পাওয়া সহজ হয়</p>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="single-achieve">
                        <div class="achieve-shape shape-2">
                            <img src="{{ asset('frontend') }}/img/achieve-shape/achieve-shape-2.png" alt="Image">
                        </div>

                        <h3>সহজ</h3>
                        <p>শেখার বিষয় যদি সহজে বোঝাই না যায় তাহলে আর লাভ কি হল এত কষ্ট করে এসব বানিয়ে! এই কোর্স ম্যাটেরিয়ালগুলোও তাই সবার জন্য সহজ করে বানানো</p>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="single-achieve">
                        <div class="achieve-shape shape-3">
                            <img src="{{ asset('frontend') }}/img/achieve-shape/achieve-shape-3.png" alt="Image">
                        </div>

                        <h3>নট বোরিং</h3>
                        <p>আমাদের কোর্স ম্যাটেরিয়াল গুলো সাইজে ছোট, স্পেসিফিক, এবং ডিটেইল ওরিয়েন্টেড যেন প্রয়োজনীয় কিছু মিস না হয়, এবং শিখতে যেন বোরিং না লাগে</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Achieve Area -->


    <!-- Start Popular Courses Area -->
    <section class="courses-area pt-100 pb-70" id="our_course">
        <div class="container">
            <div class="section-title">
                <h2>পপুলার কোর্স সমূহ</h2>
            </div>

            <div class="row justify-content-center">
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
            </div>
        </div>
    </section>
    <!-- End Popular Courses Area -->


    <!-- Start Subscribe Area -->
    <section class="subscribe-area ebeef5-bg-color ptb-100">
        <div class="container">
            <div class="subscribe-wrap">
                <h2>সাবস্ক্রাইব করুন!</h2>
                <p>নিয়মিত আমাদের আপডেট পেতে সাবস্ক্রাইব করে রাখুন</p>

                <form class="newsletter-form" action="{{ route('subscriber.store') }}" method="post">
                    @csrf
                    <input type="email" class="form-control" placeholder="আপনার ই-মেইল" name="email" required>

                    <button class="default-btn" type="submit">
                        সাবস্ক্রাইব করুন
                    </button>

                    <div id="validator-newsletter" class="form-result"></div>
                </form>
                <div class="subscribe-img">
                    <img src="{{ asset('frontend') }}/img/subscribe-img.png" alt="Image">
                </div>
            </div>
        </div>
    </section>
    <!-- End Subscribe Area -->
@endsection
