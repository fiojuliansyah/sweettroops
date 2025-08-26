@extends('layouts.guest')

@section('content')
<section class="section-44">
    <div class="w-layout-blockcontainer container-43 w-container"><a href="{{ route('troopers.my-course') }}"
            class="button-4 w-button">&lt; BACK</a></div>
</section>
<section class="section-43">
    <div class="w-layout-blockcontainer container-41 w-container">
        
        <div class="video-responsive-wrapper">
            <iframe src="{{ $video->link_url }}" 
                    allow="autoplay; fullscreen" 
                    allowfullscreen 
                    frameborder="0"
                    sandbox="allow-scripts allow-same-origin allow-forms"></iframe>
                    </div>

    </div>
</section>
<section class="section-43">
    <div class="w-layout-blockcontainer container-41 w-container">
        <div class="rich-text-block-3 w-richtext">
            {!! $course->description !!}
        </div>
    </div>
</section>

@endsection

@push('styles')
    <style>
    .video-responsive-wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 56.25%; /* 9 / 16 = 0.5625 atau 56.25% (untuk rasio 16:9) */
    }

    .video-responsive-wrapper iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
    }
</style>
@endpush
