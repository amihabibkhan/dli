@extends('layouts.frontend_inner_page')

@section('page_title') কার্ট @endsection

@section('main_content_inner')
    @if(session('message'))
        <div class="container">
            <div class="alert alert-danger mt-5">
                <div class="row">
                    <div class="col-md-12 align-items-center d-flex">
                        <span>{{ session('message') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(session('coupon'))
        <div class="container">
            <div class="alert alert-success mt-5">
                <div class="row">
                    <div class="col-md-6 align-items-center d-flex">
                        <span>{{ session('coupon')->title }} ({{ $bangla_number->bnNum(session('coupon')->percentage) }}% ডিসকাউন্ট) কুপনটি এপ্লাই হয়েছে।</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('removeCoupon') }}" class="default-btn">কুপন রিমুভ করুন।</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Start Cart Area -->
    <section class="cart-area ptb-100">
        <div class="container">
            @if($something_in_cart)
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="cart-wraps">
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">কোর্স</th>
                                        <th scope="col">মূল্য</th>
                                        <th scope="col">পরিমাণ</th>
                                        <th scope="col">মোট</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($courses as $course)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#">
                                                    <img src="{{ asset('storage') }}//{{ $course->thumbnail }}" height="100" alt="Image">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a href="javascript:void(0)">{{ $course->title }}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="unit-amount">{{ $bangla_number->bnNum($course->fee) }}/-</span>
                                            </td>

                                            <td class="product-quantity">
                                                ১
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="subtotal-amount">{{ $bangla_number->bnNum($course->fee) }}/-</span>
                                            </td>

                                            <td class="product-subtotal">
                                                <a href="{{ route('removeFromCart', $course->id) }}" class="remove">
                                                    <i class="bx bx-x"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">আপনার কার্টে কোন কোর্স নেই! <a href="">কোর্স ভিজিট করুন।</a></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="coupon-cart">
                                <div class="row">
                                    <div class="col-lg-8 col-sm-7">
                                        <div class="form-group mb-0">
                                            <form action="{{ route('applyCoupon') }}" method="post">
                                                @csrf
                                                <input type="text" name="coupon" class="form-control" placeholder="কুপন কোড">

                                                <button type="submit" class="default-btn">কুপন যোগ করুন</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <h3 class="cart-checkout-title">মোট দাম হয়েছে</h3>
                        <div class="cart-totals">
                            <ul>
                                <li>সাবটোটাল <span>{{ $bangla_number->bnNum($total) }}/-</span></li>


                                @if(session('coupon'))

                                    <li>ডিসকাউন্ট <span>{{ $bangla_number->bnNum($discount) }}/-</span></li>

                                    <li><b>টোটাল</b> <span><b>{{ $bangla_number->bnNum($total) }}/-</b></span></li>
                                @else
                                    <li><b>টোটাল</b> <span><b>{{ $bangla_number->bnNum($total) }}/-</b></span></li>
                                @endif


                            </ul>

                            <a href="{{ route('checkOut') }}" class="default-btn two">
                                কিনে ফেলুন
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <h2 class="text-center mb-4">
                        আপনার কার্টে কোন কোর্স নেই
                    </h2>
                    <a href="{{ route('allCourse') }}" class="default-btn">কোর্স ভিজিট করুন</a>
                </div>
            @endif
        </div>
    </section>
    <!-- End Cart Area -->
@endsection
