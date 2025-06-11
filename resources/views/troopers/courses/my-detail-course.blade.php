@extends('layouts.master')

@section('content')
<div class="dashboard-body">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="{{ route('troopers.my-course') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Courses</a></li>
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

                    <!-- Video Iframe -->
                    <div class="rounded-16 overflow-hidden" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%;">
                        <iframe src="{{ $video->link_url }}" 
                        allow="autoplay; fullscreen" 
                        allowfullscreen 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                        frameborder="0"
                        sandbox="allow-scripts allow-same-origin allow-forms"></iframe>
                    </div>                                 
                    
                    <div class="mt-24">
                        <div class="mb-24 pb-24 border-bottom border-gray-100">
                            <h5 class="mb-12 fw-bold">About this course</h5>
                            <p class="text-gray-300 text-15">{!! $video->description !!}</p>
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
                                    <span class="text-13 text-gray-300">Mentor</span>
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
                    <div style="text-align: center">
                        <a href="{{ route('troopers.discuss-course', $course->slug) }}"  class="btn btn-outline-main rounded-pill py-9" target="_blank">Discuss Room</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-20">Materi</h4>
            <div class="card mt-4">
                <div class="card-body p-0">
                    <div class="course-item">
                        <div class="course-item-dropdown active border-bottom border-gray-100">
                            <ul class="course-list p-16 pb-0">
                                @foreach ($course->videos as $video)
                                    <li class="course-list__item flex-align gap-8 mb-16">
                                        <div class="w-100">
                                            <!-- Update link to pass the video ID -->
                                            <a href="{{ route('troopers.change-video', [$course->slug, $video->id]) }}" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                                {{ $video->title }}
                                                <span class="text-gray-300 fw-normal d-block">{{ $video->duration ?? '-' }} min</span>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
