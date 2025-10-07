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
                    <div id="playerjs"></div>
                    <div class="disable-popout"></div>
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
    .disable-popout {
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 50px;
        background: transparent;
        pointer-events: auto;
        z-index: 2;
    }

    .video-responsive-wrapper {
        position: relative;
        overflow: hidden;
        width: 100%;
        padding-top: 56.25%; /* 16:9 */
    }

    #playerjs {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
    }

    /* ACTIVE VIDEO STYLE */
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

    .cell-12 { flex: 3; min-width: 0; }
    .cell-13 { flex: 1; min-width: 200px; }

    /* RESPONSIVE */
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

@push('js')
<!-- PLAYERJS SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/playerjs@1.0.0/playerjs.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const player = new Playerjs({
        id: "playerjs",
        file: "{{ $video->link_url }}", // file video dari backend
        poster: "{{ $video->thumbnail ?? '' }}", // opsional jika ada thumbnail
        autoplay: 0,
    });

    // --- FULLSCREEN ORIENTATION HANDLER ---
    document.addEventListener('fullscreenchange', async () => {
        try {
            if (document.fullscreenElement) {
                // Saat masuk fullscreen
                if (screen.orientation && screen.orientation.lock) {
                    await screen.orientation.lock('landscape');
                }
            } else {
                // Saat keluar fullscreen
                if (screen.orientation && screen.orientation.unlock) {
                    screen.orientation.unlock();
                }
            }
        } catch (err) {
            console.warn('Orientation lock not supported:', err);
        }
    });

    // --- SAFARI FALLBACK (karena Safari tidak support orientation.lock) ---
    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    if (isSafari) {
        player.api("play");
        // Safari fullscreen pakai webkit API
        player.on('fullscreen', function(full) {
            const videoEl = document.querySelector('#playerjs video');
            if (videoEl && videoEl.webkitEnterFullscreen) {
                videoEl.webkitEnterFullscreen();
            }
        });
    }
});
</script>
@endpush
