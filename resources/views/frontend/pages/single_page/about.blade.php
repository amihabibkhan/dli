@extends('layouts.frontend_inner_page')

@section('page_title') আমাদের সম্পর্কে @endsection

@section('og_description') ডেনিং ল ইনস্টিটিউট আইনজীবী এবং আইন শিক্ষার্থীদের পেশাগত দক্ষতা উন্নয়নের লক্ষ্যে গঠিত ভিন্নধর্মী একটি উদ্যোগ। আমরা অ্যাডভোকেটশিপ (বার কাউন্সিল এনরোলমেন্ট)পরীক্ষার প্রস্তুতি সহ আইনপেশার বিভিন্ন প্রায়োগিক বিষয়ে দীর্ঘমেয়াদী ও স্বল্পমেয়াদী প্রশিক্ষণ আয়োজন করে থাকি। @endsection

@section('main_content_inner')
    <!-- Start Education Area -->
    <section class="education-area-two ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="education-content">
                        <span class="top-title">সকলেই আইন শিখবে</span>
                        <h2>কেন আমাদের সাথে আইন <span>শিখবেন</span>?</h2>
                        <p>ডেনিং ল ইনস্টিটিউট আইনজীবী এবং আইন শিক্ষার্থীদের পেশাগত দক্ষতা উন্নয়নের লক্ষ্যে গঠিত ভিন্নধর্মী একটি উদ্যোগ। আমরা অ্যাডভোকেটশিপ (বার কাউন্সিল এনরোলমেন্ট)পরীক্ষার প্রস্তুতি সহ আইনপেশার বিভিন্ন প্রায়োগিক বিষয়ে দীর্ঘমেয়াদী ও স্বল্পমেয়াদী প্রশিক্ষণ আয়োজন করে থাকি।</p>

                        <div class="row">
                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <i class="bx bx-check"></i>
                                        লাইফটাইম এক্সেস
                                    </li>
                                    <li>
                                        <i class="bx bx-check"></i>
                                        অলটাইম সাপোর্ট
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <i class="bx bx-check"></i>
                                        রেগুলার আপডেট
                                    </li>
                                    <li>
                                        <i class="bx bx-check"></i>
                                        কোর্স মেটারিয়ালস
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <a href="{{ route('allCourse') }}" class="default-btn">
                            আমাদের কোর্সগুলো দেখুন
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="education-img-wrap">
                        <div class="education-img-2">
                            <img src="{{ asset('frontend') }}/img/education-img-2.jpg" alt="Image">
                        </div>

                        <div class="education-img-3">
                            <img src="{{ asset('frontend') }}/img/education-img-3.jpg" alt="Image">
                        </div>

                        <div class="education-img-4">
                            <img src="{{ asset('frontend') }}/img/education-img-4.jpg" alt="Image">
                        </div>

                        <div class="education-shape-1">
                            <img src="{{ asset('frontend') }}/img/education-shape-1.jpg" alt="Image">
                        </div>

                        <div class="education-shape-2">
                            <img src="{{ asset('frontend') }}/img/education-shape-2.png" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Education Area -->


    <!-- Start Teachers Area -->
    <section class="teachers-area-three pt-100 pb-70" style="background-color: #f7f7f7;">
        <div class="container">
            <div class="section-title">
                <span>শিক্ষক তালিকা</span>
                <h2>প্রফেশনাল ট্রেইনার</h2>
            </div>

            <div class="row justify-content-center">
                @forelse($instructors as $instructor)
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers">
                        <a href="{{ route('singleInstructor', $instructor->slug) }}">
                            <img src="{{ asset('storage') }}/{{ $instructor->profile_pic }}" alt="Image">

                            <div class="teachers-content">
                                <ul>
                                    @if($instructor->fb)
                                        <li>
                                            <a href="{{ $instructor->fb }}" title="Facebook Profile Link" target="_blank"><i class="bx bxl-facebook"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor->instagram)
                                        <li>
                                            <a href="{{ $instructor->instagram }}" title="Instagram Profile Link" target="_blank"><i class="bx bxl-instagram"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor->twitter)
                                        <li>
                                            <a href="{{ $instructor->twitter }}" title="Twitter Profile Link" target="_blank"><i class="bx bxl-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor->freepik)
                                        <li>
                                            <a href="{{ $instructor->freepik }}" title="Freepik Profile Link" target="_blank"><img src="{{ asset('frontend/icons/freepik.svg') }}" style="width: 20px; margin-top: -8px" alt=""></a>
                                        </li>
                                    @endif
                                    @if($instructor->website)
                                        <li>
                                            <a href="{{ $instructor->website }}" title="Website Address Link" target="_blank"><i class="bx bx-globe"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor->github)
                                        <li>
                                            <a href="{{ $instructor->github }}" title="Github Link" target="_blank"><i class="bx bxl-github"></i></a>
                                        </li>
                                    @endif
                                </ul>

                                <a href="{{ route('singleInstructor', $instructor->slug) }}">
                                    <h3>{{ $instructor->name }}</h3>
                                    <span>{{ $instructor->designation }}</span>
                                </a>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                    <h2 class="text-center">কোন ট্রেইনার খুজে পাওয়া যায় নাই</h2>
                @endforelse

            </div>
        </div>
    </section>
    <!-- End Teachers Area -->
@endsection
