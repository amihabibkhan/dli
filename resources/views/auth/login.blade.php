@extends('layouts.frontend_inner_page')

@section('page_title') লগইন @endsection

@section('main_content_inner')
    <!-- Start Log In Area -->
    <section class="user-area-style ptb-100">
        <div class="container">
            <div class="log-in-area">
                <div class="section-title">
                    <h2>লগইন করুন</h2>
                </div>

                <div class="contact-form-action">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ই-মেইল এ্রড্রেস</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>ই-মেঈল অথবা পাসওয়ার্ড মিলছে না</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>পাসওয়ার্ড</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>সঠিক পাসওয়ার্ড দিন</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="login-action">
										<span class="log-rem">
											<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
											<label for="remember">মনে রাখুন!</label>
										</span>
                                    <span class="forgot-login">
											<a href="{{ route('password.request') }}">পাসওয়ার্ড ভুলে গেছেন?</a>
										</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="default-btn" type="submit">
                                    লগইন করুন
                                </button>
                            </div>

                            <div class="col-12">
                                <p>একাউন্ট নাই? <a href="{{ route('register') }}">রেজিস্ট্রেশন করুন!</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Log In Area -->
@endsection
