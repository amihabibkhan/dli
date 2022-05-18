@extends('layouts.frontend_inner_page')

@section('page_title') যোগাযোগ @endsection

@section('main_content_inner')
    <!-- Start Contact Info Area -->
    <section class="contact-info-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-contact-info">
                        <i class="flaticon-call"></i>
                        <h3>আমাদেরকে কল করুন</h3>
                        @if(option('phone_1'))
                            <a href="tel:{{ option('phone_1') }}">ফোন : {{ option('phone_1') }}</a>
                        @endif
                        @if(option('phone_2'))
                            <a href="tel:{{ option('phone_2') }}">ফোন : {{ option('phone_2') }}</a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="single-contact-info">
                        <i class="flaticon-pin"></i>
                        <h3>আমাদের অফিস</h3>
                        <a href="#">{{ option('address') }}</a>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                    <div class="single-contact-info">
                        <i class="flaticon-email"></i>
                        <h3>ই-মেইল</h3>
                        @if(option('email_1'))
                            <a href="mailto:{{option('email_1')}}">{{ option('email_1') }}</a>
                        @endif
                        @if(option('email_2'))
                            <a href="mailto:{{option('email_2')}}">{{ option('email_2') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Info Area -->

    <!-- Start Contact Area -->
    <section class="main-contact-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-wrap contact-pages mb-0">
                        <div class="contact-form">
                            <div class="section-title">
                                <h2>আমাদেরকে লিখুন</h2>
                                <p>আমাদের কোর্স গুলো বা অন্যান্য বিষয়ে আরো বিস্তারিত জানতে <br> অথবা যে কোন প্রশ্ন করুন</p>

                            </div>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label>আপনার নাম</label>
                                            <input type="text" name="name" id="name" class="form-control" required data-error="দয়া করে আপনার নাম লিখুন">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label>আপনার ই-মেইল</label>
                                            <input type="email" name="email" id="email" class="form-control" required data-error="একটি সঠিক ই-মেইল দিন">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>বিষয়</label>
                                            <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="কোন বিষয়ে জানতে চান">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>আপনার কথা</label>
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="10" required data-error="বিস্তারিত লিখুন"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-two">
                                            পাঠিয়ে দিন
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Area -->
@endsection

@section('script')
    <script>
        (function ($) {
            "use strict"; // Start of use strict
            $("#contactForm").validator().on("submit", function (event) {
                if (event.isDefaultPrevented()) {
                    // handle the invalid form...
                    formError();
                    submitMSG(false, "ফর্মটি সঠিকভাবে পূরণ করুন");
                } else {
                    // everything looks good!
                    event.preventDefault();
                    submitForm();
                }
            });


            function submitForm(){
                // Initiate Variables With Form Content
                var name = $("#name").val();
                var email = $("#email").val();
                var msg_subject = $("#msg_subject").val();
                var message = $("#message").val();

                $.ajax({
                    url: "{{ url(route('messages.store')) }}",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },

                    data: {name: name, email: email, subject: msg_subject, details: message},
                    method: "POST",
                    success : function(text){
                        if (text.message == "success"){
                            formSuccess();
                        } else {
                            formError();
                            submitMSG(false,text.message);
                        }
                    }
                });
            }

            function formSuccess(){
                $("#contactForm")[0].reset();
                submitMSG(true, "মেসেজ চলে গেছে!")
            }

            function formError(){
                $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                    $(this).removeClass();
                });
            }

            function submitMSG(valid, msg){
                if(valid){
                    var msgClasses = "h4 tada animated text-success";
                } else {
                    var msgClasses = "h4 text-danger";
                }
                $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
            }
        }(jQuery));
    </script>
@endsection
