@extends('layouts.guest')

@section('content')
<div class="spark-section spark-hero-background-image-with-centered-content">
        <div class="spark-container spark-centered-content w-container">
            <img src="/frontend/assets/images/Logo-ST-Pink.png" width="40%">
            <h1>SWEET TROOPS</h1>
            <p class="spark-hero-sub-paragraph">Start your sweet journey here...</p>
        </div>
    </div>
    <section class="section-46">
        <div class="container-4">
            <h2 class="centered-heading-2">UPCOMING&nbsp; CLASS</h2>
            <div class="team-grid-2">
               @forelse ($upcomings as $upcoming)
                  <div id="w-node-ca84af2a-9836-8afa-9f74-52860d2bdefe-05a7959e" class="pc-card">
                    @php
                        $thumbnails = json_decode($upcoming->thumbnail, true);
                        $firstThumbnail = isset($thumbnails[0])
                            ? $thumbnails[0]
                            : 'default-thumbnail.jpg';
                    @endphp
                  <img src="{{ asset('storage/' . $firstThumbnail) }}" loading="lazy" class="pc-image"><a href="#" class="pc-link">{{ $upcoming->title }}</a>
                  </div> 
               @empty
                   
               @endforelse
            </div>
        </div>
    </section>
    <section>
        <div class="container-4">
            <h2 class="centered-heading-2">NEWEST &nbsp;CLASS</h2>
            <div class="team-grid-2">
               @forelse ($courses as $course)
                  <div id="w-node-ca84af2a-9836-8afa-9f74-52860d2bdefe-05a7959e" class="pc-card">
                    @php
                        $thumbnails = json_decode($course->thumbnail, true);
                        $firstThumbnail = isset($thumbnails[0])
                            ? $thumbnails[0]
                            : 'default-thumbnail.jpg';
                    @endphp
                  <img src="{{ asset('storage/' . $firstThumbnail) }}" loading="lazy" class="pc-image"><a href="#" class="pc-link">{{ $course->title }}</a>
                  </div> 
               @empty
                   
               @endforelse
            </div>
        </div>
    </section>
@endsection
