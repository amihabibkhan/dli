@extends('layouts.frontend_inner_page')

@section('page_title') টার্মস @endsection

@section('main_content_inner')
    <section class="privacy-policy-area ptb-100">
        <div class="container">
            <div class="privacy-policy-wrap">
                <div class="title">
                    <h2>টার্মস এন্ড কন্ডিশন</h2>
                    <p>কোন কোর্সে এনরোল করার পূর্বে নিচের বিষয় গুলো পড়ে নিন</p>
                </div>
                <ul class="list-group">
                    @forelse($terms as $single_term)
                        <li class="list-group-item" style="border: 0">
                            {{ $single_term->terms }}
                        </li>
                    @empty
                        <li class="list-group-item" style="border: 0"> দুঃখিত, কোন টার্মস এন্ড কন্ডিশন খুজে পাওয়া যায় নি!</li>
                    @endforelse
                </ul>
                <p class="text-center pt-3">
                    লিজেন্ড আইটিতে আপনার শেখা আনন্দঘন হোক, শুভকামনা!
                </p>
            </div>
        </div>
    </section>
@endsection
