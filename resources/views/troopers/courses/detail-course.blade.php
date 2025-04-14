@extends('layouts.master')

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Courses</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">{{ $course->title }}</span></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-gray-200 fw-normal text-15 hover-text-main-600">Details</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

    <div class="row gy-4">
        <div class="col-md-8">
            <!-- Course Card Start -->
            <div class="card">
                <div class="card-body p-lg-20 p-sm-3">
                    <div class="flex-between flex-wrap gap-12 mb-20">
                        <div>
                            <h3 class="mb-4">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-15">{{ $course->type->name }}</p>
                        </div>

                        <div class="flex-align flex-wrap gap-24">
                            <span class="py-6 px-16 bg-main-50 text-main-600 rounded-pill text-15">{{ $course->category->name }}</span>
                        </div>
                    </div>

                    <div class="rounded-16 overflow-hidden">
                        <video id="player" class="player" playsinline controls data-poster="{{ asset('storage/' . $course->thumbnail) }}">
                            <source src="{{ asset('storage/' . $course->trailer) }}" type="video/mp4">
                        </video>
                    </div>
                    
                    <div class="mt-24">
                        <div class="mb-24 pb-24 border-bottom border-gray-100">
                            <h5 class="mb-12 fw-bold">About this course</h5>
                            <p class="text-gray-300 text-15">...</p>
                        </div>
                        <div class="mb-24 pb-24 border-bottom border-gray-100">
                            <h5 class="mb-12 fw-bold">Description</h5>
                            <p class="text-gray-300 text-15 mb-8">{!! $course->description !!}</p>
                        </div>
                        <div class="">
                            <h5 class="mb-12 fw-bold">Instructor</h5>
                            <div class="flex-align gap-8">
                                <img src="/admin/assets/images/thumbs/mentor-img1.png" alt="" class="w-44 h-44 rounded-circle object-fit-cover flex-shrink-0">
                                <div class="d-flex flex-column">
                                    <h6 class="text-15 fw-bold mb-0">{{ $course->instructor }}</h6>
                                    <span class="text-13 text-gray-300">Baking Mentor</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Course Card End -->
        </div>

        <div class="col-md-4">
            <h4 class="mb-20">Discuss</h4>
            <div class="card mb-20">
                <div class="card-body">
                    <p class="mb-16">Diskusi akan tersedia setelah membeli kelas ini</p>
                </div>
            </div>
            <h4 class="mb-20">Materi</h4>
            <div class="card mt-24">
                <div class="card-body p-0">
                    <div class="course-item">
                        <div class="course-item-dropdown active border-bottom border-gray-100">
                            <ul class="course-list p-16 pb-0">
                                @forelse ($course->videos as $video)
                                    <li class="course-list__item flex-align gap-8 mb-16 active">
                                        <div class="w-100">
                                            <a href="#" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                                {{ $video->title ?? '' }}
                                                <span class="text-gray-300 fw-normal d-block">2.4 min</span>
                                            </a>
                                        </div>
                                    </li>
                                @empty
                                    <p class="mb-16">Tidak ada Video Tersedia</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection