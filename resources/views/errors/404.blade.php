<!doctype html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/boxicons.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/flaticon.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/responsive.css">
    <title>ওহো - পেইজটি পাওয়া যায় নি</title>
</head>

<body>
<!-- Start Preloader Area -->
<div class="loader-wrapper">
    <div class="loader">
        <div class="dot-wrap">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</div>
<!-- End Preloader Area -->

<!-- Start 404 Error -->
<div class="error-area" style="background-color: black !important">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="error-content-wrap">
                <h1 style="font-family: 'Rubik', sans-serif;"><span class="a">4</span> <span class="red">0</span> <span class="b">4</span> </h1>
                <h3>ওহো! পেইজটি পাওয়া যায়নি</h3>
                <p>আপনি যেই পেইজটি খুজছেন সেটি পাওয়া যাচ্ছে না।</p>
                <a href="{{ route('index')}}" class="default-btn two">
                    হোম পেইজে ফিরে যান
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End 404 Error -->



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
<!-- Custom JS -->
<script src="{{ asset('frontend') }}/js/custom.js"></script>
</body>
</html>
