@extends('layouts.frontend_inner_page')

@section('page_title') ধন্যবাদ @endsection

@section('css')
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">--}}
    <style>

        .congrats {
            text-align: center;
            margin: 0 auto;
            left: 0;
            right: 0;
        }

        h2.cong {
            font-size: 50px;
            cursor: pointer;
            z-index: 2;
            font-weight: 700;
        }

        .blob {
            height: 50px;
            width: 50px;
            color: #ffb607;
            position: absolute;
            top: 45%;
            left: 45%;
            z-index: 1;
            font-size: 30px;
            display: none;
        }
    </style>
@endsection
@section('main_content_inner')
    <section class="user-area-style ptb-100">
        <div class="congrats">
            <h2 class="cong">অভিনন্দন!</h2>
            <h2>আপনার কেনাকাটা সফল হয়েছে</h2>

            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>কোর্স</th>
                                <th>মূল্য</th>
                                <th>পরিমাণ</th>
                                <th>মোট</th>
                            </tr>

                            @foreach($transaction->courses as $course)
                                <tr>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $bangla_number->BnNum($course->fee) }}</td>
                                    <td>১</td>
                                    <td>{{ $bangla_number->BnNum($course->fee) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="3" >মোট</td>
                                <td>{{ $bangla_number->BnNum($total) }}/-</td>
                            </tr>
                            <tr>
                                <td colspan="3" >ডিসকাউন্ট</td>
                                <td>{{ $bangla_number->BnNum(round(($total - $transaction->amount) + ($transaction->amount * 2 / 102), 2)) }}/-</td>
                            </tr>
                            <tr>
                                <td colspan="3" >ক্যাশ আউট ফি</td>
                                <td>{{ $bangla_number->BnNum(round($transaction->amount * 2 / 102, 2)) }}/-</td>
                            </tr>
                            <tr>
                                <td colspan="3" >সর্বমোট</td>
                                <td>{{ $bangla_number->BnNum(round($transaction->amount, 2)) }}/-</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script src="{{ asset('admin/js/thanks/TweenMax.min.js') }}"></script>
    <script src="{{ asset('admin/js/thanks/underscore-min.js') }}"></script>
    <script>
        $(function() {
            var numberOfStars = 200;

            for (var i = 0; i < numberOfStars; i++) {
                $('.congrats').append('<div class="blob fa fa-star ' + i + '"></div>');
            }

            animateText();

            animateBlobs();
        });

        function animateText() {
            TweenMax.from($('h1'), 0.8, {
                scale: 0.4,
                opacity: 0,
                rotation: 15,
                ease: Back.easeOut.config(4),
            });
        }

        function animateBlobs() {

            var xSeed = _.random(350, 380);
            var ySeed = _.random(120, 170);

            $.each($('.blob'), function(i) {
                var $blob = $(this);
                var speed = _.random(1, 5);
                var rotation = _.random(5, 100);
                var scale = _.random(0.8, 1.5);
                var x = _.random(-xSeed, xSeed);
                var y = _.random(-ySeed, ySeed);

                TweenMax.to($blob, speed, {
                    x: x,
                    y: y,
                    ease: Power1.easeOut,
                    opacity: 0,
                    rotation: rotation,
                    scale: scale,
                    onStartParams: [$blob],
                    onStart: function($element) {
                        $element.css('display', 'block');
                    },
                    onCompleteParams: [$blob],
                    onComplete: function($element) {
                        $element.css('display', 'none');
                    }
                });
            });
        }
    </script>
@endsection
