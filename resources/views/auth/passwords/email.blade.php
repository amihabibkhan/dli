@extends('layouts.frontend_inner_page')

@section('page_title') পাসওয়ার্ড উদ্ধার করুন @endsection

@section('main_content_inner')
    <!-- Start Recover Password Area -->
    <section class="user-area-style recover-password-area ptb-100">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="contact-form-action recover">
                <div class="form-heading text-center">
                    <h3 class="form-title">পাসওয়ার্ড রিকোভার করুন</h3>
                    <p class="reset-desc">আপনার ই-মেইল এড্রেস টি দিন। আমরা আপনার পাসওয়ার্ড রিকোভার করার একটি নির্দেশনা মেইল করব। কোন সমস্যা হলে আমাদের সাথে <a href="{{ route('contactUs') }}">যোগাযোগ করুন</a></p>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input id="email" type="email" placeholder="ই-মেইল এড্রেস দিন" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a class="now-log-in font-q" href="{{ route('login') }}">লগইন করুন!</a>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <p class="now-register">
                                একাউন্ট নেই?
                                <a class="font-q" href="{{ route('register') }}">রেজিস্ট্রেশন করুন!</a>
                            </p>
                        </div>

                        <div class="col-12">
                            <button class="default-btn btn-two" type="submit">
                                পাসওয়ার্ড রিকোভার করুন
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Recover Password Area -->
@endsection
