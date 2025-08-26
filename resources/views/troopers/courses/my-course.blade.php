@extends('layouts.guest')

@section('content')
    <section class="sec-title">
        <div class="w-layout-blockcontainer container-34 w-container">
        <h1 class="heading-title">My Class</h1>
        </div>
    </section>

    <section class="section-filter" style="padding: 20px 0;">
        <div class="container-21">
            <form action="{{ route('courses') }}" method="GET" style="display: flex; gap: 15px; align-items: center; margin-bottom: 30px;">
                
                <input type="text" name="search" placeholder="Search courses..." value="{{ request('search') }}" style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 300px;">
                
                <button type="submit" style="padding: 10px 20px; background-color: #E0BFB4; color: white; border: none; border-radius: 5px; cursor: pointer;">Search</button>
                <a href="{{ route('courses') }}" style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">Reset</a>
            </form>
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
                                $firstThumbnail = $thumbnails[0] ?? 'path/to/default/image.png';
                            @endphp
                            <img
                                src="{{ asset('storage/' . $firstThumbnail) }}"
                                loading="lazy"
                                id="w-node-a0986e99-da9f-4b86-822c-f527d14b120e-18607b69" width="479px" height="355" class="image-10">
                            <a href="{{ route('course.detail', $course->slug) }}" class="link-4">{{ $course->title }}</a>
                        </div>
                    @empty
                        <div style="text-align: center; width: 100%; padding: 40px 0;">
                            <p class="paragraph-20">No courses found matching your criteria.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection