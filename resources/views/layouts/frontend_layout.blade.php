<!doctype html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('og_description', option('description'))"/>
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="@yield('page_title', option('site_title'))">
    <meta property="og:description" content="@yield('og_description', option('description'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ option('site_title') }}">
    <meta property="og:image" content="@yield('og_image', asset('storage').'/'.option('banner'))">
    <meta property="og:image:secure_url" content="@yield('og_image', asset('storage').'/'.option('banner'))">
    <meta property="og:image:width" content="940">
    <meta property="og:image:height" content="788">
    <meta property="og:image:alt" content="@yield('page_title', option('site_title'))">
    <meta property="og:image:type" content="image/jpeg">
    <meta name="twitter:card" content="@yield('page_title', option('site_title'))">
    <meta name="twitter:title" content="@yield('page_title', option('site_title'))">
    <meta name="twitter:description" content="@yield('og_description', option('description'))">
    <meta name="twitter:image" content="@yield('og_image', asset('storage').'/'.option('banner'))">
    @yield('meta')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <!-- Owl Theme Default CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.theme.default.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
    <!-- Owl Magnific CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/magnific-popup.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/animate.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/flaticon.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/meanmenu.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nice-select.css">
    <!-- Odometer CSS-->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/odometer.css">

    {{--  toaster css  --}}
    <link rel="stylesheet" href="{{ asset('admin') }}/css/toastr.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('storage') }}/{{ option('icon') }}">

    @yield('css')
    <!-- Title -->
    <title>@yield('page_title', option('site_title')) </title>
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

<!-- Start Navbar Area -->
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('index') }}" class="logo">
            <img src="{{ asset('storage') }}/{{ option('logo') }}" alt="Legend Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('storage') }}/{{ option('logo') }}" alt="Legend Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link {{ menu_active('index') ? 'active' : '' }}">হোম</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('aboutUs') }}" class="nav-link {{ menu_active('aboutUs') ? 'active' : '' }}">আমাদের সম্পর্কে</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                আমাদের সব কোর্স
                                <i class="bx bx-chevron-down"></i>
                            </a>

                            <ul class="dropdown-menu">
                                @forelse($menu_course_list as $single_menu_course)
                                    <li class="nav-item">
                                        <a href="{{ route('course_details', $single_menu_course->slug) }}" class="nav-link">{{ $single_menu_course->title }}</a>
                                    </li>
                                @empty
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link">কোন কোর্স নেই</a>
                                    </li>
                                @endforelse
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                জরুরী
                                <i class="bx bx-chevron-down"></i>
                            </a>

                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{ route('faq_page') }}" class="nav-link">প্রশ্নোত্তর</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('terms_page') }}" class="nav-link">টার্মস</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contactUs') }}" class="nav-link {{ menu_active('contactUs') ? 'active' : '' }}">যোগাযোগ</a>
                        </li>
                    </ul>

                    <!-- Start Other Option -->
                    <div class="others-option">
                        <div class="option-item">
                            <i class="search-btn bx bx-search"></i>
                            <i class="close-btn bx bx-x"></i>

                            <div class="search-overlay search-popup">
                                <div class='search-box'>
                                    <form class="search-form" action="{{ route('search') }}" method="get">
                                        <input class="search-input" name="search" placeholder="কোর্স খুজুন" type="text">

                                        <button class="search-button" type="submit"><i class="bx bx-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="cart-icon">
                            <a href="{{ route('viewCart') }}">
                                <i class="flaticon-shopping-cart"></i>
                                <span>
                                    @if(is_array(session('cart')))
                                        {{ $bangla_number->bnNum(count(session('cart'))) }}
                                    @else
                                        ০
                                    @endif
                                </span>
                            </a>
                        </div>

                        <div class="register">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <a href="{{ route('home') }}" class="default-btn">
                                    ডেশবোর্ড
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="default-btn">
                                    লগইন / রেজিস্টার
                                </a>
                            @endif
                        </div>
                    </div>
                    <!-- End Other Option -->
                </div>
            </nav>
        </div>
    </div>

    <!-- Start Others Option For Responsive -->
    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>

            <div class="container">
                <div class="option-inner">
                    <div class="others-option justify-content-center d-flex align-items-center">
                        <div class="option-item">
                            <i class="search-btn bx bx-search"></i>
                            <i class="close-btn bx bx-x"></i>

                            <div class="search-overlay search-popup">
                                <div class='search-box'>
                                    <form class="search-form" action="{{ route('search') }}" method="get">
                                        <input class="search-input" name="search" placeholder="খুজুন" type="text">

                                        <button class="search-button" type="submit"><i class="bx bx-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="cart-icon">
                            <a href="{{ route('viewCart') }}">
                                <i class="flaticon-shopping-cart"></i>
                                <span>
                                    @if(is_array(session('cart')))
                                        {{ $bangla_number->bnNum(count(session('cart'))) }}
                                    @else
                                        ০
                                    @endif
                                </span>
                            </a>
                        </div>

                        <div class="register">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <a href="{{ route('home') }}" class="default-btn">
                                    ডেশবোর্ড
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="default-btn">
                                    লগইন / রেজিস্টার
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Others Option For Responsive -->
</div>
<!-- End Navbar Area -->

@yield('main_content')

<!-- Start Footer Top Area -->
<footer class="footer-top-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <h3>যোগাযোগ</h3>

                    <ul class="address">
                        <li class="location">
                            <i class="fas fa-map-marker" aria-hidden="true"></i>
                            {{ option('address') }}
                        </li>

                        <li>
                            <i class="bx bxs-envelope"></i>
                            <a href="mailto:hello@eduon.com">{{ option('email_1') }}</a>
                        </li>

                        <li>
                            <i class="bx bxs-phone-call"></i>
                            <a href="tel:+1(514)312-5678">{{ option('phone_1') }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <h3>প্রয়োজনীয় লিংক সমূহ</h3>

                    <ul class="link">
                        <li>
                            <a href="{{ route('allCourse') }}">কোর্স লিস্ট</a>
                        </li>
                        <li>
                            <a href="{{ route('allInstructor') }}">ট্রেইনার লিস্ট</a>
                        </li>
                        <li>
                            <a href="{{ route('faq_page') }}">প্রশ্নোত্তর</a>
                        </li>

                        <li>
                            <a href="{{ route('terms_page') }}">টার্মস</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="footer-widget">
                    <h3>জনপ্রিয় কোর্স গুলো</h3>

                    <ul class="link">
                        @foreach($menu_course_list as $footer_course)
                            @if($loop->index == 3)
                                @continue
                            @endif
                        <li>
                            <a href="{{ route('course_details', $footer_course->slug) }}">{{ $footer_course->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Top Area -->

<!-- Start Footer Bottom Area -->
<footer class="footer-bottom-area">
    <div class="container">
        <div class="copyright-wrap">
            <p>কপিরাইট &copy; {{ $bangla_number->BnNum(date('Y')) }} | ডেনিং ল | ডেভেলপড বাই <a href="{{ route('index') }}" target="blank">ইনোভা আইটি</a></p>
        </div>
    </div>
</footer>
<!-- End Footer Bottom Area -->

<!-- Start Go Top Area -->
<div class="go-top">
    <i class='bx bx-chevrons-up'></i>
    <i class='bx bx-chevrons-up'></i>
</div>
<!-- End Go Top Area -->


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
{{-- taostr --}}
<script src="{{ asset('admin') }}/js/toastr.min.js"></script>

{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton: true,
        progressBar: true
    });
    @endforeach
    @endif
</script>

@yield('script')
</body>
</html>
