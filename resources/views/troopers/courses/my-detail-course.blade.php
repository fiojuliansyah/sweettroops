@extends('layouts.guest')

@section('content')
<section class="section-44">
    <div class="w-layout-blockcontainer container-43 w-container"><a href="{{ route('troopers.my-course') }}"
            class="button-4 w-button">&lt; BACK</a></div>
</section>
<section class="section-47">
    <div class="w-layout-blockcontainer container-44 w-container">
        <div id="w-node-_8e5052ec-8ecd-1126-ef66-b2b7acd7b277-2e3d46b7" class="w-layout-layout wf-layout-layout">
            <div class="w-layout-cell cell-12">
                <div class="video-responsive-wrapper">
                <iframe src="{{ $video->link_url }}" 
                    allow="autoplay; fullscreen" 
                    allowfullscreen 
                    frameborder="0"
                    sandbox="allow-scripts allow-same-origin allow-forms"></iframe>
                    </div>
            </div>
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
    .video-responsive-wrapper {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
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

        #w-node-_8e5052ec-8ecd-1126-ef66-b2b7acd7b277-2e3d46b7 {
        display: flex;
        align-items: flex-start; /* Konten dimulai dari atas */
        gap: 24px; /* Jarak antara video dan daftar video */
    }

    /* 2. Atur lebar untuk kolom video dan kolom daftar */
    .cell-12 {
        flex: 3; /* Kolom video mengambil 3 bagian ruang */
        min-width: 0; /* Diperlukan untuk flexbox agar tidak meluap */
    }
    .cell-13 {
        flex: 1; /* Kolom daftar mengambil 1 bagian ruang */
        min-width: 0;
    }

    /* 3. Buat layout kembali vertikal di layar kecil (Responsif) */
    @media (max-width: 767px) {
        #w-node-_8e5052ec-8ecd-1126-ef66-b2b7acd7b277-2e3d46b7 {
            flex-direction: column; /* Ubah arah flex menjadi vertikal */
        }
    }
</style>
@endpush
