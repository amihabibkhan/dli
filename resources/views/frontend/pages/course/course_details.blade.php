@extends('layouts.frontend_inner_page')

@section('page_title') {{ $course_info->title }} @endsection

@section('og_description') {{ $course_info->short_description }}@endsection

@section('og_image') {{ asset('storage') }}/{{ $course_info->banner }} @endsection

@section('banner_button')
    @auth
         @if($course_info->users->contains(auth()->id()))
             <a href="{{ route('courseVideos', $course_info->slug) }}" class="default-btn mt-4" style="background-color: transparent; border-radius: 30px;">কোর্স ভিডিও</a>
         @else
             @if(is_array(session('cart')))
                 @if(in_array($course_info->id, session('cart')))
                     <a href="{{ route('viewCart') }}" class="default-btn mt-4" style="background-color: transparent; border-radius: 30px;">কার্ট দেখুন</a>
                 @else
                     <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn mt-4" style="background-color: transparent; border-radius: 30px;">এনরোল করুন</a>
                 @endif
             @else
                 <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn mt-4" style="background-color: transparent; border-radius: 30px;">এনরোল করুন</a>
             @endif
         @endif
    @else
        @if(is_array(session('cart')))
            @if(in_array($course_info->id, session('cart')))
                <a href="{{ route('viewCart') }}" class="default-btn mt-4" style="background-color: transparent; border-radius: 30px;">কার্ট দেখুন</a>
            @else
                <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn mt-4" style="background-color: transparent; border-radius: 30px;">এনরোল করুন</a>
            @endif
        @else
            <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn mt-4" style="background-color: transparent; border-radius: 30px;">এনরোল করুন</a>
        @endif
    @endauth
@endsection

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
    @if(session('message'))
        <div class="container">
            <div class="alert alert-success mt-5">
                <div class="row">
                    <div class="col-sm-6 justify-content-center justify-content-sm-start align-items-center d-flex">
                        <span>{{ session('message') }}</span>
                    </div>
                    <div class="col-sm-6 text-center text-sm-right">
                        <a href="{{ route('viewCart') }}" class="default-btn">কার্ট দেখুন</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        a.promo-video{
            position: relative;
        }
        a.promo-video .overlay{
            position: absolute;
            width: 100%;
            height: calc(100% - 30px);
            background: rgba(0,0,0,.7);
            left: 0;
            top: 0;
        }
        a.promo-video .overlay i{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            font-size: 100px;
            color: white;
        }
    </style>
    <!-- Start Single Course Area -->
    <section class="single-course-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-course-content">
                        <h3>{{ $course_info->title }}</h3>
                        <a href="{{ $course_info->promo }}" class="promo-video meet-time my-pop">
                            <img src="{{ asset('storage') }}/{{ $course_info->banner }}" alt="Image">
                            <span class="overlay">
                                <i class="flaticon-play-button"></i>
                            </span>
                        </a>
                    </div>

                    <div class="tab single-course-tab">
                        <ul class="tabs">
                            <li>
                                <a href="#">কোর্স ওভারিভিউ</a>
                            </li>
                            <li>
                                <a href="#">কারিক্যুলাম</a>
                            </li>
                            <li>
                                <a href="#">ট্রেইনার</a>
                            </li>
                            <li>
                                <a href="#">রিভিউ</a>
                            </li>
                        </ul>

                        <div class="tab_content">
                            <div class="tabs_item course_overview">
                                {!! $course_info->overview !!}
                            </div>

                            <div class="tabs_item">
                                <div class="curriculum-content">
                                    <h3>কোর্স কারিক্যুলাম</h3>
                                    @foreach($course_info->modules as $module)
                                        @if(count($module->videos) < 1)
                                            @continue
                                        @endif
                                    <div class="curriculum-list">
                                        <h4>{{ $module->title }}</h4>
                                        <ul>
                                            @foreach($module->videos as $video)
                                            <li>
                                                <a href="javascript:void(0)" class="meet-title">
                                                    <i class="bx bx-right-arrow"></i>
                                                    {{ $video->title }}
                                                </a>
                                                @if($video->preview == 1)
                                                    <a href="{{ ($video->type == 1 ? 'https://www.youtube.com/watch?v=' . $video->link : 'http://vimeo.com/' . $video->link) }}" class="meet-time my-pop">
                                                        <span class="preview">Preview</span>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="meet-time">
                                                        <i class="bx bxs-lock-alt"></i>
                                                    </a>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="tabs_item">
                                <div class="instructor-content">
                                    @foreach($course_info->instructors as $single_instructor)
                                        <div class="row align-items-center " style="margin-bottom: 30px">
                                        <div class="col-sm-4 text-center text-sm-left">
                                            <div class="advisor-img">
                                                <img src="{{ asset('storage') }}/{{ $single_instructor->square_image }}" alt="Image">
                                            </div>
                                        </div>

                                        <div class="col-sm-8 text-center text-sm-left">
                                            <div class="advisor-content">
                                                <a href="{{ route('singleInstructor', $single_instructor->slug) }}">
                                                    <h3>{{ $single_instructor->name }}</h3>
                                                </a>

                                                <span>{{ $single_instructor->designation }}</span>

                                                <a href="{{ route('singleInstructor', $single_instructor->slug) }}" class="default-btn mb-3 d-inline-block">ট্রেইনার সম্পর্কে জানুন</a>

                                                <ul>
                                                    <ul>
                                                        @if($single_instructor->fb)
                                                            <li>
                                                                <a href="{{ $single_instructor->fb }}" title="Facebook Profile Link" target="_blank"><i class="bx bxl-facebook"></i></a>
                                                            </li>
                                                        @endif
                                                        @if($single_instructor->instagram)
                                                            <li>
                                                                <a href="{{ $single_instructor->instagram }}" title="Instagram Profile Link" target="_blank"><i class="bx bxl-instagram"></i></a>
                                                            </li>
                                                        @endif
                                                        @if($single_instructor->twitter)
                                                            <li>
                                                                <a href="{{ $single_instructor->twitter }}" title="Twitter Profile Link" target="_blank"><i class="bx bxl-twitter"></i></a>
                                                            </li>
                                                        @endif
                                                        @if($single_instructor->freepik)
                                                            <li>
                                                                <a href="{{ $single_instructor->freepik }}" title="Freepik Profile Link" target="_blank"><img src="{{ asset('frontend/icons/freepik.svg') }}" style="width: 20px; margin-top: -8px" alt=""></a>
                                                            </li>
                                                        @endif
                                                        @if($single_instructor->website)
                                                            <li>
                                                                <a href="{{ $single_instructor->website }}" title="Website Address Link" target="_blank"><i class="bx bx-globe"></i></a>
                                                            </li>
                                                        @endif
                                                        @if($single_instructor->github)
                                                            <li>
                                                                <a href="{{ $single_instructor->github }}" title="Github Link" target="_blank"><i class="bx bxl-github"></i></a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="tabs_item">
                                <div class="review-content">
                                    <h3>কোর্স রেটিং</h3>

                                    <ul class="rating-star">
                                        @for($start_star = 1; $start_star <= floor($average_rating); $start_star ++)
                                            <li>
                                                <i class='bx bxs-star'></i>
                                            </li>
                                        @endfor
                                        @if($average_rating - floor($average_rating) > 0)
                                            <li>
                                                <i class='bx bxs-star-half'></i>
                                            </li>
                                            @for($start_star = 1; $start_star <= (5 - (floor($average_rating) + 1)); $start_star ++)
                                                <li>
                                                    <i class='bx bx-star'></i>
                                                </li>
                                            @endfor
                                        @else
                                            @for($start_star = 1; $start_star <= 5 - floor($average_rating); $start_star ++)
                                                <li>
                                                    <i class='bx bx-star'></i>
                                                </li>
                                            @endfor
                                        @endif
                                    </ul>

                                    <span>গড়ে {{ $bangla_number->BnNum($average_rating)  }} স্টার রেটিং (মোট রেটিং {{ $bangla_number->BnNum($total_review) }})</span>

                                    <div class="course-reviews-content">
                                        <h3>রিভিউ</h3>
                                        <ul class="course-reviews">
                                            @forelse($course_info->reviews as $review)
                                            <li style="margin-bottom: 30px">
                                                <img src="{{ asset('frontend/img/review-avatar.jpg') }}" style="width: 70px;" alt="Image">
                                                @if($review->rating)
                                                    <ul class="rating-star ml-0">
                                                        @for($star = 1; $star <= $review->rating; $star ++)
                                                            <li>
                                                                <i class='bx bxs-star'></i>
                                                            </li>
                                                        @endfor
                                                        @for($star = 1; $star<= 5 - $review->rating; $star ++)
                                                            <li>
                                                                <i class='bx bx-star'></i>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                @endif
                                                <h3>{{ $review->user->name }}</h3>
                                                <p>{{ $review->review }}</p>
                                            </li>
                                            @empty
                                            <li><h2>কোন রিভিউ পাওয়া যায় নি!</h2></li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="account-wrap">
                        <ul>
                            <li>
                                মূল্য <span class="bold">{{ $bangla_number->bnNum($course_info->fee) }}/-</span>
                            </li>
                            <li>
                                শুরু <span>{{ bangla_date(strtotime($course_info->starting_date),"en") }}</span>
                            </li>
                            <li>
                                এনরোল করেছে : <span>{{ $bangla_number->BnNum(count($course_info->users)) }}</span>
                            </li>
                        </ul>


                        @auth
                            @if($course_info->users->contains(auth()->id()))
                                <a href="{{ route('courseVideos', $course_info->slug) }}" class="default-btn">কোর্স ভিডিও</a>
                            @else
                                @if(is_array(session('cart')))
                                    @if(in_array($course_info->id, session('cart')))
                                        <a href="{{ route('viewCart') }}" class="default-btn">কার্ট দেখুন</a>
                                    @else
                                        <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn">এনরোল করুন</a>
                                    @endif
                                @else
                                    <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn">এনরোল করুন</a>
                                @endif
                            @endif
                        @else
                            @if(is_array(session('cart')))
                                @if(in_array($course_info->id, session('cart')))
                                    <a href="{{ route('viewCart') }}" class="default-btn">কার্ট দেখুন</a>
                                @else
                                    <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn">এনরোল করুন</a>
                                @endif
                            @else
                                <a href="{{ route('addToCart', $course_info->id) }}" class="default-btn">এনরোল করুন</a>
                            @endif
                        @endauth

                        <div class="social-content">
                            <p>
                                কোর্সটি শেয়ার করুন
                                <i class="bx bxs-share-alt"></i>
                            </p>

                            <ul>
                                <li>
                                    <a target="_blank" href="{{ fb_share(route('course_details', $course_info->slug)) }}">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{ twitter_share(route('course_details', $course_info->slug)) }}">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ share_to_mail($course_info->title, route('course_details', $course_info->slug)) }}">
                                        <i class='bx bxs-envelope'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Single Course Area -->
@endsection


@section('script')
    <script>
        $('.my-pop').magnificPopup({
            type: 'iframe'
            // other options
        });
    </script>
@endsection
