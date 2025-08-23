@extends('layouts.guest')

@section('content')
<section class="section-44">
    <div class="w-layout-blockcontainer container-43 w-container"><a href="{{ route('courses') }}"
            class="button-4 w-button">&lt; BACK</a></div>
</section>
<section class="section-43">
    <div class="w-layout-blockcontainer container-41 w-container">
        <h1 class="heading-21">{{ $course->title }}</h1><a href="#" class="lightbox-link-3 w-inline-block w-lightbox"
            aria-label="open lightbox" aria-haspopup="dialog">
            @php
                $thumbnails = json_decode($course->thumbnail, true);
                $firstThumbnail = isset($thumbnails[0])
                    ? $thumbnails[0]
                    : 'https://cdn.prod.website-files.com/6863dbc5c3cb25eebe6ab6ce/68666cf3de7c05db6b6a495a_Blackforest%20PC.png';
            @endphp
            <img src="{{ asset('storage/' . $firstThumbnail) }}" loading="lazy"class="image-21">
        </a>
    </div>
</section>
<section class="section-44">
    <div class="w-layout-blockcontainer container-42 w-container"><a href="/online-classes"
            class="button-5 w-button">ENROLL</a></div>
</section>
<section class="section-43">
    <div class="w-layout-blockcontainer container-41 w-container">
        <div class="div-block-37">
            <div class="text-block-21">DIFFICULTY:</div>
            <div class="text-block-21">PRICE:</div>
            <div class="text-block-21">CATEGORY:</div>
            <div class="text-block-22">Beginner</div>
            <div class="text-block-22">Rp. {{ number_format($course->price) }}</div>
            <div class="text-block-22">{{ $course->category->name }}</div>
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
