@extends('layouts.frontend_inner_page')

@section('page_title') আমার কোর্স সমূহ @endsection

@section('css')
    <style>
        .review_button{
            background-color: green;
            border-color: red;
        }
        .review_button:hover{
            background-color: transparent;
            color: red;
            border-color: red !important;
        }
        .ratings_input{
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .ratings_input i{
            color: #ff7200;
            position: relative;
            z-index: 0;
            font-size: 30px;
            transition: .2s;
        }
        .ratings_input i::after {
            position: absolute;
            content: '\f005';
            font-weight: 900;
            font-family: 'Font Awesome 5 Free';
            top: 0;
            left: 0;
            font-size: 30px;
            color: transparent;
        }
        .ratings_input:hover i::after{
            color: #ff7200;
        }
        .ratings_input input{
            position: absolute;
            cursor: pointer;
            z-index: 2;
            top: 50%;
            left: 50%;
            height: 30px;
            width: 30px;
            transform: translate(-50%,-50%);
            opacity: 0;
        }
    </style>
    <script src="{{ asset('frontend') }}/js/jquery-3.5.1.slim.min.js"></script>
@endsection

@section('main_content_inner')
    <!-- Start Popular Courses Area -->
    <section class="courses-area-style ptb-100">
        <div class="container">
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
                                <div class="d-flex justify-content-between">
                                    <!-- review modal trigger button -->
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#review{{ $course->id }}" class="default-btn review_button">রিভিউ দিন</a>
                                    <a href="{{ route('courseVideos', $course->slug) }}" class="default-btn">কোর্স ভিডিও</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Review Modal -->
                    <div class="modal fade" id="review{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="review{{ $course->id }}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">রিভিউ দিন</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('review.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <div class="modal-body">
                                        <div class="form-group d-flex justify-content-center">
                                            <div class="ratings_input" id="rat_1{{ $course->id }}">
                                                <input type="radio" class="ratings" name="rating" value="1">
                                                <i class="far fa-star"></i>
                                            </div>
                                            <div class="ratings_input" id="rat_2{{ $course->id }}">
                                                <input type="radio" class="ratings" name="rating" value="2">
                                                <i class="far fa-star"></i>
                                            </div>
                                            <div class="ratings_input" id="rat_3{{ $course->id }}">
                                                <input type="radio" class="ratings" name="rating" value="3">
                                                <i class="far fa-star"></i>
                                            </div>
                                            <div class="ratings_input" id="rat_4{{ $course->id }}">
                                                <input type="radio" class="ratings" name="rating" value="4">
                                                <i class="far fa-star"></i>
                                            </div>
                                            <div class="ratings_input" id="rat_5{{ $course->id }}">
                                                <input type="radio" class="ratings" name="rating" value="5">
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <textarea name="review" style="height: 100px" placeholder="কোর্স সম্পর্কে আপনার মতামত দিন..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer pb-3">
                                        <button type="button" class="default-btn review_button" data-dismiss="modal">এখন না</button>
                                        <button type="submit" class="default-btn">সাবমিট করুন</button>
                                    </div>
                                </form>
                                <script>
                                    $(function () {
                                        // ratings 1
                                        $("#rat_1{{$course->id}}").click(function(){
                                            // remove class
                                            $('#rat_1{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_2{{$course->id}}').find('i').removeClass('fas');
                                            $('#rat_3{{$course->id}}').find('i').removeClass('fas');
                                            $('#rat_4{{$course->id}}').find('i').removeClass('fas');
                                            $('#rat_5{{$course->id}}').find('i').removeClass('fas');
                                            // add class
                                            $('#rat_1{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_2{{$course->id}}').find('i').addClass('far');
                                            $('#rat_3{{$course->id}}').find('i').addClass('far');
                                            $('#rat_4{{$course->id}}').find('i').addClass('far');
                                            $('#rat_5{{$course->id}}').find('i').addClass('far');
                                        });
                                        // ratings 2
                                        $("#rat_2{{$course->id}}").click(function(){
                                            // remove class
                                            $('#rat_1{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_2{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_3{{$course->id}}').find('i').removeClass('fas');
                                            $('#rat_4{{$course->id}}').find('i').removeClass('fas');
                                            $('#rat_5{{$course->id}}').find('i').removeClass('fas');
                                            // add class
                                            $('#rat_1{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_2{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_3{{$course->id}}').find('i').addClass('far');
                                            $('#rat_4{{$course->id}}').find('i').addClass('far');
                                            $('#rat_5{{$course->id}}').find('i').addClass('far');
                                        });
                                        // ratings 3
                                        $("#rat_3{{$course->id}}").click(function(){
                                            // remove class
                                            $('#rat_1{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_2{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_3{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_4{{$course->id}}').find('i').removeClass('fas');
                                            $('#rat_5{{$course->id}}').find('i').removeClass('fas');
                                            // add class
                                            $('#rat_1{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_2{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_3{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_4{{$course->id}}').find('i').addClass('far');
                                            $('#rat_5{{$course->id}}').find('i').addClass('far');
                                        });
                                        // ratings 4
                                        $("#rat_4{{$course->id}}").click(function(){
                                            // remove class
                                            $('#rat_1{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_2{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_3{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_4{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_5{{$course->id}}').find('i').removeClass('fas');
                                            // add class
                                            $('#rat_1{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_2{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_3{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_4{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_5{{$course->id}}').find('i').addClass('far');
                                        });
                                        // ratings 5
                                        $("#rat_5{{$course->id}}").click(function(){
                                            // remove class
                                            $('#rat_1{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_2{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_3{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_4{{$course->id}}').find('i').removeClass('far');
                                            $('#rat_5{{$course->id}}').find('i').removeClass('far');
                                            // add class
                                            $('#rat_1{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_2{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_3{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_4{{$course->id}}').find('i').addClass('fas');
                                            $('#rat_5{{$course->id}}').find('i').addClass('fas');
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center">
                        <h2 class="text-center mb-4">
                            দুঃখিত! আপনি কোন কোর্সে এনরোল করেন নি
                        </h2>
                        <a href="{{ route('allCourse') }}" class="default-btn">কোর্স ভিজিট করুন</a>
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

@section('script')
    <!-- javascript (note that jquery required) -->

@endsection
