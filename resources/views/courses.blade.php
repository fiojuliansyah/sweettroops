@extends('layouts.guest')

@section('content')
    <section class="sec-title">
        <div class="w-layout-blockcontainer cont-title w-container">
            <h1 class="heading-title">Online Classes</h1>
        </div>
    </section>
    <section class="section-23">
        <div class="w-layout-blockcontainer container-20 w-container">
            <p class="paragraph-20">Our online classes feel just like baking with us in the SweetTroops studio - minus the
                flour explosions and sticky fingers!<br>You&#x27;ll get step-by-step videos, easy-to-follow recipes, and all
                our best tips, so it feels like we&#x27;re right there cheering you on.<br>The best part? You can hit pause,
                rewind, or bake in your pyjamas at 2am - whatever suits your style.<br>No rush, no rules - just pure, joyful
                baking on your own time.</p>
        </div>
    </section>
    <section class="team-circles">
        <div class="container-21">
            <div class="collection-list-wrapper-2 w-dyn-list">
                <div role="list" class="collection-list-2 w-dyn-items w-row">
                    @forelse ($courses as $course)
                        <div role="listitem" class="collection-item-2 w-dyn-item w-col w-col-4">
                            @php
                                $thumbnails = json_decode($course->thumbnail, true);
                                $firstThumbnail = isset($thumbnails[0])
                                    ? $thumbnails[0]
                                    : 'https://cdn.prod.website-files.com/6863dbc5c3cb25eebe6ab6ce/68666cf3de7c05db6b6a495a_Blackforest%20PC.png';
                            @endphp
                            <img
                                src="{{ asset('storage/' . $firstThumbnail) }}"
                                loading="lazy"
                                id="w-node-a0986e99-da9f-4b86-822c-f527d14b120e-18607b69" width="479px" height="355" class="image-10"><a href="{{ route('course.detail', $course->slug) }}" class="link-4">{{ $course->title }}</a>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
