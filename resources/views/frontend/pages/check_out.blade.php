@extends('layouts.frontend_inner_page')

@section('page_title') চেক আউট @endsection

@section('main_content_inner')
    <style>
        ul.number{
            padding-left: 10px;
            margin-bottom: 15px;
            margin-top: 15px;
        }
        ul.number li{
            position: relative;
            margin-bottom: 15px;
            color: black;
        }
        ul.number li:before {
            font-family: FontAwesome;
            content: "\f00c";
            display: inline-block;
            padding-right: 15px;
            vertical-align: middle;
            font-weight: 900;
            color: #ffb607;
        }
    </style>
    <section class="user-area-style ptb-100">
        <div class="container">
            <div class="log-in-area">
                <div class="section-title text-center">
                    <h2>চেক আউট করুন</h2>
                </div>

                @if(auth()->check())
                <div class="contact-form-action">
                    <p>সাময়িক অসুবিধার জন্য দুঃখিত। আমরা এখনো পেমেন্ট মেথড একটিভ করিনি। খুব দ্রুতই একটিভ করা হবে ইনশাল্লাহ। বিকাশ অথবা নগদ মোবাইল ব্যাংকিং এর মাধ্যমে পেমেন্ট করুন।</p>
                    <h5 style="color: black; background-color: #ffb607; padding: 10px"> বিকাশ থেকে পাঠালে <strong>{{ $bangla_number->bnNum($total_bkash) }} টাকা</strong> সেন্ড মানি (Send Money) করুন (২% ক্যাশ আউট চার্জ)</h5>
                    <h5 style="color: black; background-color: #85ff73; padding: 10px"> নগদ থেকে পাঠালে <strong>{{ $bangla_number->bnNum($total_nagad) }} টাকা</strong> সেন্ড মানি (Send Money) করুন (১% ক্যাশ আউট চার্জ)</h5>
                    <ul class="number">
                        <li>বিকাশ : 01770496249</li>
                        <li>নগদ : 01770496249</li>
                    </ul>
                    <hr>
                    <form action="{{ route('checkOutFormSubmit') }}" method="post">
                        @csrf

                        <div class="custom-control custom-radio mb-2">
                            <input type="radio" value="Bkash" class="custom-control-input" id="bkash" name="payment_method" required>
                            <label class="custom-control-label" for="bkash">বিকাশ থেকে টাকা পাঠিয়েছি</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" value="Nagad" class="custom-control-input" id="nagad" name="payment_method" required>
                            <label class="custom-control-label" for="nagad">নগদ থেকে টাকা পাঠিয়েছি</label>
                        </div>

                        <div class="form-group">
                            <label for="">যে নাম্বার থেকে টাকা পাঠিয়েছেন</label>
                            <input type="text" name="phone_number" class="form-control">
                            @error('phone_number')
                                <div class="mt-2">
                                    <span style="color: red">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">ট্রানজেকশন আইডি (Transaction ID)</label>
                            <input type="text" name="transaction_id" class="form-control">
                            @error('transaction_id')
                            <div class="mt-2">
                                <span style="color: red">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <input type="submit" class="default-btn" value="কনফার্ম করুন">
                    </form>
                </div>
                @else
                    <div class="contact-form-action">
                        <h4 class="text-center mb-4">আপনার একাউন্টে লগইন করুন। একাউন্ট না থাকলে নতুন একাউন্ট তৈরি করুন।</h4>
                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('login') }}" class="default-btn">লগইন করুন</a>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('register') }}" class="default-btn">নতুন একাউন্ট</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
