@extends('layouts.frontend_inner_page')

@section('page_title') প্রশ্নোত্তর @endsection

@section('main_content_inner')
    <!-- Start FAQ Area -->
    <section class="faq-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span class="top-title">এফ এ কিউ</span>
                <h2>কিছু প্রশ্নোত্তর</h2>
            </div>

            <div class="faq-accordion">
                <ul class="accordion">
                    @forelse($faqs as $single_faq)
                    <li class="accordion-item">
                        <a class="accordion-title {{ $loop->index == 0 ? 'active' : '' }}" href="javascript:void(0)">
                            <i class="bx bx-plus"></i>
                            {{ $single_faq->question }}
                        </a>

                        <div class="accordion-content {{ $loop->index == 0 ? 'show' : '' }}">
                            <p>
                                {{ $single_faq->answer }}
                            </p>
                        </div>
                    </li>
                    @empty
                        <h2 class="text-center" style="color: red">দুঃখিত! কোন এফ এ কিউ পাওয়া যায় নি!</h2>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
    <!-- End FAQ Area -->
@endsection
