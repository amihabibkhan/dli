@extends('layouts.frontend_inner_page')

@section('page_title') ট্রেইনার তালিকা @endsection


@section('main_content_inner')
    <!-- Start Teachers Area -->
    <section class="teachers-area-three ptb-100">
        <div class="container">
            <div class="section-title">
                <span>শিক্ষক তালিকা</span>
                <h2>প্রফেশনাল ট্রেইনার</h2>
            </div>

            <div class="row">
                @forelse($instructors as $instructor)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-teachers">
                            <a href="{{ route('singleInstructor', $instructor->slug) }}">
                                <img src="{{ asset('storage') }}/{{ $instructor->profile_pic }}" alt="Image">

                                <div class="teachers-content">
                                    <ul>
                                        @if($instructor->fb)
                                            <li>
                                                <a href="{{ $instructor->fb }}" title="Facebook Profile Link" target="_blank"><i class="bx bxl-facebook"></i></a>
                                            </li>
                                        @endif
                                        @if($instructor->instagram)
                                            <li>
                                                <a href="{{ $instructor->instagram }}" title="Instagram Profile Link" target="_blank"><i class="bx bxl-instagram"></i></a>
                                            </li>
                                        @endif
                                        @if($instructor->twitter)
                                            <li>
                                                <a href="{{ $instructor->twitter }}" title="Twitter Profile Link" target="_blank"><i class="bx bxl-twitter"></i></a>
                                            </li>
                                        @endif
                                        @if($instructor->freepik)
                                            <li>
                                                <a href="{{ $instructor->freepik }}" title="Freepik Profile Link" target="_blank"><img src="{{ asset('frontend/icons/freepik.svg') }}" style="width: 20px; margin-top: -8px" alt=""></a>
                                            </li>
                                        @endif
                                        @if($instructor->website)
                                            <li>
                                                <a href="{{ $instructor->website }}" title="Website Address Link" target="_blank"><i class="bx bx-globe"></i></a>
                                            </li>
                                        @endif
                                        @if($instructor->github)
                                            <li>
                                                <a href="{{ $instructor->github }}" title="Github Link" target="_blank"><i class="bx bxl-github"></i></a>
                                            </li>
                                        @endif
                                    </ul>

                                    <a href="{{ route('singleInstructor', $instructor->slug) }}">
                                        <h3>{{ $instructor->name }}</h3>
                                        <span>{{ $instructor->designation }}</span>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <h2 class="text-center">কোন ট্রেইনার খুজে পাওয়া যায় নাই</h2>
                @endforelse
                <style>
                    .pagination-area .pagination{
                        display: block;
                    }
                    .pagination-area .page-item {
                        width: 40px;
                        height: 40px;
                        line-height: 40px;
                        color: var(--heading-color);
                        text-align: center;
                        display: inline-block;
                        position: relative;
                        margin-left: 5px;
                        margin-right: 5px;
                        font-size: 18px;
                        background-color: #f5f6fa;
                        border: 0;
                    }
                    .pagination-area .page-item.active .page-link {
                        z-index: 3;
                        color: #fff;
                        background-color: #ffb607;
                        border-color: #ffb607;
                    }
                </style>
                <div class="col-lg-12 col-md-12">
                    <div class="pagination-area">
                        {{ $instructors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Teachers Area -->
@endsection
