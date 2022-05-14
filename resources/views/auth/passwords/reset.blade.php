@extends('layouts.frontend_inner_page')

@section('page_title') পাসওয়ার্ড পরিবর্তন করুন @endsection

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
                    <h3 class="form-title">পাসওয়ার্ড পরিবর্তন করুন</h3>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">ই-মেইল এড্রেস</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">নতুন পাসওয়ার্ড</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">কনফার্ম পাসওয়ার্ড</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="default-btn">
                            পাসওয়ার্ড পরিবর্তন করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Recover Password Area -->
@endsection

