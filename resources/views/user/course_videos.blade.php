
<!doctype html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.css">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/icons/css/boxicons.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/flaticon.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/meanmenu.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">

    <link rel="stylesheet" href="{{ asset('frontend') }}/css/video.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend') }}/img/fab_icon.png">
    <!-- Title -->
    <title>{{ $course_info->title }} - লিজেন্ড আইটি</title>
</head>

<body>
{{--<!-- Start Preloader Area -->--}}
{{--<div class="loader-wrapper">--}}
{{--    <div class="loader">--}}
{{--        <div class="dot-wrap">--}}
{{--            <span class="dot"></span>--}}
{{--            <span class="dot"></span>--}}
{{--            <span class="dot"></span>--}}
{{--            <span class="dot"></span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- End Preloader Area -->--}}

<!-- video section start  -->

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-4 order-lg-1 order-2">
            <div class="content_list" id="content_list">
                <div class="course_title" id="course_title">
                    <h2><span class="d-none d-md-block">{{ $course_info->title }}</span><span class="d-md-none">কোর্স ভিডিও</span></h2>
                </div>
                <div class="scrollable_content" id="scrollable_content">
                    <div class="faq-accordion">
                        <ul class="accordion">
                            @forelse($modules as $module)
                            <li class="accordion-item">
                                <a class="accordion-title {{ $active_video->module_id == $module->id ? 'active' : '' }}" href="javascript:void(0)">
                                    <i class="bx bx-plus"></i>
                                    {{ $module->title }}
                                </a>

                                <div class="accordion-content {{ $active_video->module_id == $module->id ? 'show' : '' }}">
                                    <ul class="inner_item">
                                        @forelse($module->videos as $single_video)
                                            <li class="{{ $single_video->id == $active_video->id ? 'active' : '' }}">
                                                <a href="{{ route('courseVideos', [$course_info->slug, $single_video->id]) }}">
                                                    @if($single_video->users()->where('user_id', auth()->id())->exists())
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-play-circle" aria-hidden="true"></i>
                                                    @endif
                                                    {{ $single_video->title }}
                                                </a>
                                            </li>
                                        @empty
                                            <li><a href="javascript:void(0)">এই চ্যাপ্টারে কোন ভিডিও আপলোড করা হয় নি। </a></li>
                                        @endforelse
                                    </ul>
                                </div>
                            </li>
                            @empty
                            <li class="accordion-item">
                                <a class="accordion-title" href="javascript:void(0)">
                                    এখনো কন্টেন্ট আপলোড করা শুরু হয় নি।
                                </a>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-2 order-1">
            <h2 class="d-block d-md-none" style="background-color: #ffb607; color: white; text-align: center; margin: 0 -15px; padding: 15px">{{ $course_info->title }}</h2>
            <div class="video">
                <div class="row">
                    <div class="col-9 col-md-10">
                        <h2>{{ $active_video->title }}</h2>
                    </div>
                    <div class="col-3 col-md-2 text-right">
                        <a href="{{ route('userCourseList') }}" class="btn btn-dark">BACK</a>
                    </div>
                </div>
                <div class="video_frame">
                    @if($active_video->type == 1)
                    <iframe width="100%"
                            id="get_width"
                            src="https://www.youtube.com/embed/{{ $active_video->link }}?autoplay=1"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                    @else
                    <iframe
                        id="get_width"
                        src="https://player.vimeo.com/video/{{ $active_video->link }}?autoplay=1&title=0&byline=0&portrait=0"
                        width="100%"
                        frameborder="0"
                        allow="autoplay; fullscreen"
                        allowfullscreen>
                    </iframe>
                    @endif
                    <!-- <iframe
                        id="get_width"
                        style="height: auto; width: 100%; border: 0"
                        src="https://drive.google.com/file/d/0Bzap5mSsZhGcM2JocXhJV3RhU28/preview?usp=sharing">
                    </iframe> -->
                </div>
                <p class="pt-3">কোর্সে আপনাকে স্বাগতম। এখানে কোর্স মেটারিয়াল গুলোর ডাউনলোড লিংক দেওয়া হবে। </p>
            </div>
        </div>
    </div>
</section>

<!-- video section end  -->

<!-- Jquery-3.5.1.Slim.Min.JS -->
<script src="{{ asset('frontend') }}/js/jquery-3.5.1.slim.min.js"></script>
<!-- Popper JS -->
<script src="{{ asset('frontend') }}/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
<!-- Meanmenu JS -->
<script src="{{ asset('frontend') }}/js/jquery.meanmenu.js"></script>
<!-- Wow JS -->
<script src="{{ asset('frontend') }}/js/wow.min.js"></script>
<!-- Owl Carousel JS -->
<script src="{{ asset('frontend') }}/js/owl.carousel.js"></script>
<!-- Owl Magnific JS -->
<script src="{{ asset('frontend') }}/js/jquery.magnific-popup.min.js"></script>
<!-- Nice Select JS -->
<script src="{{ asset('frontend') }}/js/jquery.nice-select.min.js"></script>
<!-- Parallax JS -->
<script src="{{ asset('frontend') }}/js/parallax.min.js"></script>
<!-- Appear JS -->
<script src="{{ asset('frontend') }}/js/jquery.appear.js"></script>
<!-- Odometer JS -->
<script src="{{ asset('frontend') }}/js/odometer.min.js"></script>
<!-- Form Validator JS -->
<script src="{{ asset('frontend') }}/js/form-validator.min.js"></script>
<!-- Contact JS -->
<script src="{{ asset('frontend') }}/js/contact-form-script.js"></script>
<!-- Ajaxchimp JS -->
<script src="{{ asset('frontend') }}/js/jquery.ajaxchimp.min.js"></script>
<!-- Custom JS -->
<script src="{{ asset('frontend') }}/js/custom.js"></script>

<script>
    $(function () {
        var div_width = $('#get_width').width();
        var div_height = div_width * 56 /100;
        $('#get_width').css({ 'height' : div_height + 'px'});

        var course_title_height = $('#course_title').height();
        var content_list_height = $('#content_list').height();
        var decreased_height = content_list_height - (course_title_height + 30);
        $('#scrollable_content').css({ 'height' : decreased_height + 'px'});
    });

</script>
</body>
</html>
