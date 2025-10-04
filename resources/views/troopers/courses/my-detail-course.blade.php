@extends('layouts.guest')

@section('content')
<section class="section-44">
    <div class="w-layout-blockcontainer container-43 w-container">
        <a href="{{ route('troopers.my-course') }}" class="button-4 w-button">&lt; BACK</a>
    </div>
</section>

<section class="section-47">
    <div class="w-layout-blockcontainer container-44 w-container">
        <div id="video-layout-wrapper" class="w-layout-layout wf-layout-layout">
            <!-- VIDEO PLAYER -->
            <div class="w-layout-cell cell-12">
                <div class="video-responsive-wrapper">
                    <iframe src="{{ $video->link_url }}" 
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen 
                        frameborder="0">
                    </iframe>
                    <div class="iframe-overlay"></div>
                </div>
            </div>

            <!-- VIDEO LIST -->
            <div class="w-layout-cell cell-13">
                <p class="paragraph-21">List of Videos:</p>
                @foreach($course->videos as $listVideo)
                    <a href="{{ route('troopers.change-video', ['slug' => $course->slug, 'videoId' => $listVideo->id]) }}" 
                        class="link-8 {{ $listVideo->id == $video->id ? 'active' : '' }}">
                        {{ sprintf('%02d', $loop->iteration) }}. {{ $listVideo->title }}
                    </a>
                @endforeach
            </div>
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
    /* VIDEO WRAPPER */
    .iframe-overlay {
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;   /* kira-kira ukuran tombol popout */
        height: 40px;
        background: transparent;
        pointer-events: all; /* supaya klik ke tombol popout tertutup */
    }
    .video-responsive-wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 56.25%; /* 16:9 aspect ratio */
    }

    .video-responsive-wrapper iframe {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* ACTIVE VIDEO LIST STYLE */
    .link-8.active {
        font-weight: bold;
        color: #007bff;
        text-decoration: none;
    }

    .cell-13 a {
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        color: #333;
    }
    .cell-13 a:hover {
        text-decoration: underline;
    }

    /* FLEX LAYOUT */
    #video-layout-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 24px;
    }

    .cell-12 {
        flex: 3;
        min-width: 0; /* prevent overflow */
    }
    .cell-13 {
        flex: 1;
        min-width: 200px; /* biar ga terlalu sempit di desktop */
    }

    /* RESPONSIVE FIX */
    @media (max-width: 767px) {
        #video-layout-wrapper {
            flex-direction: column;
        }
        .cell-12, .cell-13 {
            width: 100%;
            min-width: auto;
        }
    }
</style>
@endpush
