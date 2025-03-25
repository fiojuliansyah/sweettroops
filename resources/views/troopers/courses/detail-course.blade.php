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
                            <div class=" share-social position-relative">
                                <button type="button" class="share-social__button text-gray-200 text-26 d-flex hover-text-main-600"><i class="ph ph-share-network"></i></button>
                                <div class="share-social__icons bg-white box-shadow-2xl p-16 border border-gray-100 rounded-8 position-absolute inset-block-start-100 inset-inline-end-0">
                                    <ul class="flex-align gap-8">
                                        <li>
                                            <a href="https://www.facebook.com" class="flex-center w-36 h-36 border border-main-600 text-white rounded-circle text-xl bg-main-600 hover-bg-main-800 hover-border-main-800"><i class="ph ph-facebook-logo"></i></a> 
                                        </li>
                                        <li>
                                            <a href="https://www.google.com" class="flex-center w-36 h-36 border border-main-600 text-white rounded-circle text-xl bg-main-600 hover-bg-main-800 hover-border-main-800"> <i class="ph ph-twitter-logo"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.twitter.com" class="flex-center w-36 h-36 border border-main-600 text-white rounded-circle text-xl bg-main-600 hover-bg-main-800 hover-border-main-800"><i class="ph ph-linkedin-logo"></i></a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com" class="flex-center w-36 h-36 border border-main-600 text-white rounded-circle text-xl bg-main-600 hover-bg-main-800 hover-border-main-800"><i class="ph ph-instagram-logo"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="bookmark-icon text-gray-200 text-26 d-flex hover-text-main-600">
                                <i class="ph ph-bookmarks"></i>
                            </button>
                        </div>
                    </div>

                    <div class="rounded-16 overflow-hidden">
                        <video id="player" class="player" playsinline controls data-poster="{{ asset('storage/' . $course->thumbnail) }}">
                            <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4">
                        </video>
                    </div>
                    
                    <div class="mt-24">
                        <div class="mb-24 pb-24 border-bottom border-gray-100">
                            <h5 class="mb-12 fw-bold">About this course</h5>
                            <p class="text-gray-300 text-15">...</p>
                        </div>
                        <div class="mb-24 pb-24 border-bottom border-gray-100">
                            <h5 class="mb-12 fw-bold">Description</h5>
                            <p class="text-gray-300 text-15 mb-8">{{ $course->description }}</p>
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
            <div class="card">
                <div class="card-body">
                    <div class="chat-box-item-wrapper overflow-y-auto scroll-sm p-24">
                        <div class="chat-box-item d-flex align-items-end gap-8">
                                <img src="/admin/assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                                <div class="chat-box-item__content">
                                    <p class="chat-box-item__text p-16 rounded-16 mb-12">Hello Mac</p>
                                    <p class="chat-box-item__text py-16 px-16 px-lg-4">Lorem ipsum dolor sit amet consectetur. Cursus vulputate eget ullamcorper bibendum pulvinar sed at libero. Vulputate amet fermentum sapien amet tempus ac donec.</p>
                                    <span class="text-gray-200 text-13 mt-2 d-block">10 min ago</span>
                                </div>
                        </div>
                        <div class="chat-box-item right d-flex align-items-end gap-8">
                                <img src="/admin/assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                                <div class="chat-box-item__content">
                                    <p class="chat-box-item__text py-16 px-16 px-lg-4">Lorem ipsum dolor sit amet consect.Cursus vulputate eget ullamcorper bibendum </p>
                                    <span class="text-gray-200 text-13 mt-2 d-block">10 min ago</span>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top border-gray-100">
                    <form action="#" class="flex-align gap-8 chat-box-bottom">
                        <label for="fileUp" class="flex-shrink-0 file-btn w-48 h-48 flex-center bg-main-50 text-24 text-main-600 rounded-circle hover-bg-main-100 transition-2">
                            <i class="ph ph-plus"></i>
                        </label>
                        <input type="file" name="fileName" id="fileUp" hidden>
                        <input type="text" class="form-control h-48 border-transparent px-20 focus-border-main-600 bg-main-50 rounded-pill placeholder-15" placeholder="Type your message...">
                        <button type="submit" class="flex-shrink-0 submit-btn btn btn-main rounded-pill flex-align gap-4 py-15">
                            Submit <span class="d-flex text-md d-sm-flex d-none"><i class="ph-fill ph-paper-plane-tilt"></i></span> 
                        </button>
                    </form>
                </div>
            </div>
            <div class="card mt-24">
                <div class="card-body p-0">
                    <div class="course-item">
                        <button type="button" class="course-item__button active flex-align gap-4 w-100 p-16 border-bottom border-gray-100">
                            <span class="d-block text-start">
                                <span class="d-block h5 mb-0 text-line-1">The Courses Program</span>
                                <span class="d-block text-15 text-gray-300">2 / 5 | 4.4 min</span>
                            </span>
                            <span class="course-item__arrow ms-auto text-20 text-gray-500"><i class="ph ph-arrow-right"></i></span>
                        </button>
                        <div class="course-item-dropdown active border-bottom border-gray-100">
                            <ul class="course-list p-16 pb-0">
                                <li class="course-list__item flex-align gap-8 mb-16 active">
                                    <div class="w-100">
                                        <a href="#" class="text-gray-300 fw-medium d-block hover-text-main-600 d-lg-block">
                                            1. Welcome to this course
                                            <span class="text-gray-300 fw-normal d-block">2.4 min</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection