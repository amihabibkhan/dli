
<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('admin') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('page_title', 'Dashboard')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('admin') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin') }}/css/toastr.min.css">
    <style>
        .sub_menu{
            padding: 0;
        }
        .sub_menu li{
            padding-left: 30px;
        }
    </style>
    @yield('css')
</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo">
            <a href="https://www.creative-tim.com" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="{{ asset('admin') }}/img/logo-small.png">
                </div>
                <!-- <p>CT</p> -->
            </a>
            <a target="_blank" href="{{ route('index') }}" class="simple-text logo-normal">
                DLI ADMIN
                <!-- <div class="logo-image-big">
                  <img src="{{ asset('admin') }}/img/logo-big.png">
                </div> -->
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ menu_active('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="{{ menu_active('courses.index', 'courses.create') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#course" role="button" aria-expanded="false" aria-controls="course">
                        <i class="nc-icon nc-book-bookmark"></i>
                        <p>Courses</p>
                    </a>
                    <div class="collapse {{ menu_active('courses.index', 'courses.create') ? 'show' : '' }}" id="course">
                        <div class="sub_menu card card-body">
                            <ul class="nav">
                                <li class="{{ menu_active('courses.index') ? 'active' : '' }}">
                                    <a href="{{ route('courses.index') }}"> - Course List</a>
                                </li>
                                <li class="{{ menu_active('courses.create') ? 'active' : '' }}">
                                    <a href="{{ route('courses.create') }}"> - Add New</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="{{ menu_active('instructors.index', 'instructors.create') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#instructor" role="button" aria-expanded="false" aria-controls="instructor">
                        <i class="nc-icon nc-single-02"></i>
                        <p>Instructor</p>
                    </a>
                    <div class="collapse {{ menu_active('instructors.index', 'instructors.create') ? 'show' : '' }}" id="instructor">
                        <div class="sub_menu card card-body">
                            <ul class="nav">
                                <li class="{{ menu_active('instructors.index') ? 'active' : '' }}">
                                    <a href="{{ route('instructors.index') }}"> - Instructor List</a>
                                </li>
                                <li class="{{ menu_active('instructors.create') ? 'active' : '' }}">
                                    <a href="{{ route('instructors.create') }}"> - Add New</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="{{ menu_active('transaction.index', 'transaction.show') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#transaction" role="button" aria-expanded="false" aria-controls="transaction">
                        <i class="nc-icon nc-credit-card"></i>
                        <p>Transaction</p>
                    </a>
                    <div class="collapse {{ menu_active('transaction.index', 'transaction.show') ? 'show' : '' }}" id="transaction">
                        <div class="sub_menu card card-body">
                            <ul class="nav">
                                <li class="{{ menu_active('transaction.index') ? 'active' : '' }}">
                                    <a href="{{ route('transaction.index') }}"> - Transaction List</a>
                                </li>
                                <li class="{{ menu_active('transaction.show') ? 'active' : '' }}">
                                    <a href="{{ route('transaction.show', 'pending') }}"> - Pending List</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="{{ menu_active('options.index') ? 'active' : '' }}">
                    <a href="{{ route('options.index') }}">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>Theme Options</p>
                    </a>
                </li>
                <li class="{{ menu_active('coupons.index') ? 'active' : '' }}">
                    <a href="{{ route('coupons.index') }}">
                        <i class="nc-icon nc-chart-pie-36"></i>
                        <p>Coupon</p>
                    </a>
                </li>
                <li class="{{ menu_active('faq.index') ? 'active' : '' }}">
                    <a href="{{ route('faq.index') }}">
                        <i class="nc-icon nc-bullet-list-67"></i>
                        <p>FAQs</p>
                    </a>
                </li>
                <li class="{{ menu_active('terms.index') ? 'active' : '' }}">
                    <a href="{{ route('terms.index') }}">
                        <i class="nc-icon nc-paper"></i>
                        <p>Terms</p>
                    </a>
                </li>
                <li class="{{ menu_active('messages.index') ? 'active' : '' }}">
                    <a href="{{ route('messages.index') }}">
                        <i class="nc-icon nc-email-85"></i>
                        <p>Messages</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nc-icon nc-key-25"></i>
                        <p>Log Out</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="javascript:;">
                        @yield('page_title')
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form>
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="nc-icon nc-zoom-split"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link btn-magnify" href="javascript:;">
                                <i class="nc-icon nc-layout-11"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nc-icon nc-bell-55"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-rotate" href="javascript:;">
                                <i class="nc-icon nc-settings-gear-65"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="content" style="min-height: 100vh">

            @yield('main_content')

        </div>
        <footer class="footer footer-black  footer-white ">
            <div class="container-fluid">
                <div class="row">
                    <nav class="footer-nav">
                    </nav>
                    <div class="credits ml-auto">
              <span class="copyright">
                &copy; {{ date('Y') }} developed by <i class="fa fa-heart heart"></i> by <a href="https://innovainst.com/">INNOVA IT</a>
              </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('admin') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('admin') }}/js/core/popper.min.js"></script>
<script src="{{ asset('admin') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('admin') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('admin') }}/js/plugins/bootstrap-notify.js"></script>
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

@yield('javascript')
</body>

</html>


