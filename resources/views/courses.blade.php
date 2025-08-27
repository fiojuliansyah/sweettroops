@extends('layouts.guest')

@section('content')
    <section class="sec-title">
        <div class="w-layout-blockcontainer cont-title w-container">
            <h1 class="heading-title">Online Classes</h1>
        </div>
    </section>

    <section class="section-23">
        <div class="w-layout-blockcontainer container-20 w-container">
            <p class="paragraph-20">
                Our online classes feel just like baking with us in the SweetTroops studio - minus the
                flour explosions and sticky fingers!<br>
                You'll get step-by-step videos, easy-to-follow recipes, and all
                our best tips, so it feels like we're right there cheering you on.<br>
                The best part? You can hit pause,
                rewind, or bake in your pyjamas at 2am - whatever suits your style.<br>
                No rush, no rules - just pure, joyful
                baking on your own time.
            </p>
        </div>
    </section>

    <section class="section-filter" style="padding: 20px 0;">
        <div class="container-21">
            <form action="{{ route('courses') }}" method="GET"
                  style="display: flex; flex-wrap: wrap; gap: 15px; align-items: center; margin-bottom: 30px;">
                
                <input type="text" name="search" placeholder="Search courses..."
                       value="{{ request('search') }}"
                       style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; flex:1; min-width:200px;">
                
                <select name="sort"
                        style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; min-width:180px;">
                    <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Sort by Newest</option>
                    <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>Sort by Alphabet (A-Z)</option>
                </select>
                
                <button type="submit"
                        style="padding: 10px 20px; background-color: #E0BFB4; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Apply
                </button>
                <a href="{{ route('courses') }}"
                   style="padding: 10px 20px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer;">
                   Reset
                </a>
            </form>
        </div>
    </section>

    <section class="team-circles">
        <div class="container-21">
            <div class="course-grid">
                @forelse ($courses as $course)
                    @php
                        $thumbnails = json_decode($course->thumbnail, true);
                        $firstThumbnail = $thumbnails[0] ?? 'path/to/default/image.png';
                    @endphp
                    <div class="course-card">
                        <img src="{{ asset('storage/' . $firstThumbnail) }}"
                             alt="{{ $course->title }}"
                             loading="lazy"
                             class="course-thumbnail">
                        <a href="{{ route('course.detail', $course->slug) }}" class="course-title">{{ $course->title }}</a>
                    </div>
                @empty
                    <div style="text-align: center; width: 100%; padding: 40px 0;">
                        <p class="paragraph-20">No courses found matching your criteria.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection


@push('styles')
<style>
    .course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

.course-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
}

.course-card:hover {
    transform: translateY(-5px);
}

.course-thumbnail {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
}

.course-title {
    display: block;
    padding: 15px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    color: #333;
    text-align: center;
}

.course-title:hover {
    color: #E0BFB4;
}

</style>
@endpush