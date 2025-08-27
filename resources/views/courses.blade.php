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
                our best tips, so it feels like we&#x27;re right there cheering you on.<br>The best part? You can hit pause,
                rewind, or bake in your pyjamas at 2am - whatever suits your style.<br>No rush, no rules - just pure, joyful
                baking on your own time.</p>
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
            <div class="collection-list-wrapper-2 w-dyn-list">
                <div role="list" class="collection-list-2 w-dyn-items w-row">
                    <div class="courses-grid">
                        @forelse ($courses as $course)
                            <div class="course-item">
                                @php
                                    $thumbnails = json_decode($course->thumbnail, true);
                                    $firstThumbnail = $thumbnails[0] ?? 'images/default-course.png';
                                @endphp

                                <img 
                                    src="{{ asset('storage/' . $firstThumbnail) }}" 
                                    alt="{{ $course->title }}" 
                                    class="course-thumbnail">
                                <a href="{{ route('course.detail', $course->slug) }}" class="link-4">
                                    {{ $course->title }}
                                </a>
                            </div>
                        @empty
                            <p>No courses found</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>

.courses-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* default desktop: 3 kolom */
    gap: 20px;
}

.course-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.course-thumbnail {
    width: 100%;
    max-height: 220px;
    object-fit: cover;
    border-radius: 8px;
}

/* Tablet (max 1024px) → 2 kolom */
@media (max-width: 1024px) {
    .courses-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile (max 640px) → 1 kolom */
@media (max-width: 640px) {
    .courses-grid {
        grid-template-columns: 1fr;
    }
}

</style>
@endpush