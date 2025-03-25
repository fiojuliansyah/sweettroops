@extends('layouts.master')

@section('content')
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">Discuss</span></li>
</ul>
</div>
<!-- Breadcrumb End -->
    

    <div class="chart-wrapper d-flex flex-wrap gap-24">
        <!-- chat sidebar Start -->
        <div class="card chat-list">
            <div class="card-header py-16 border-bottom border-gray-100">
                <form action="#" class="position-relative">
                    <button type="submit" class="input-icon text-xl d-flex text-gray-600 pointer-event-none"><i class="ph ph-magnifying-glass"></i></button> 
                    <input type="text" class="form-control ps-44 h-44 border-gray-100 focus-border-main-600 rounded-pill placeholder-15" placeholder="Search here...">
                </form>
            </div>
            <div class="card-body p-0">
                <div class="chat-list-wrapper p-24 overflow-y-auto scroll-sm">
                    <div class="chat-list__item flex-between gap-8 cursor-pointer">
                        @foreach ($courseList as $course)   
                            <div class="d-flex align-items-start gap-16">
                                <div class="position-relative flex-shrink-0">
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="" class="w-44 h-44 rounded-circle object-fit-cover flex-shrink-0">
                                    <span class="activation-badge w-12 h-12 border-2 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="text-line-1 text-15 text-gray-400 fw-bold mb-0">{{ $course->title }}</h6>
                                    <span class="text-line-1 text-13 text-gray-200">You: I will send you...</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- chat sidebar End -->

        <!-- chat sidebar Start -->
        <div class="card chat-box">
            <div class="card-header py-16 border-bottom border-gray-100">
                <div class="chat-list__item flex-between gap-8 cursor-pointer">
                    <div class="d-flex align-items-start gap-16">
                        <div class="d-flex flex-column">
                            <h6 class="text-line-1 text-15 text-gray-400 fw-bold mb-0">{{ $course->title }}</h6>
                            <span class="text-line-1 text-13 text-gray-200">Online</span>
                        </div>
                    </div>

                    <div class="flex-align gap-16">
                        <button type="button" class="text-main-600 text-xl d-flex"><i class="ph-fill ph-phone"></i></button>
                        <button type="button" class="text-main-600 text-xl d-flex"><i class="ph-fill ph-video-camera"></i></button>
                        <div class="dropdown flex-shrink-0">
                            <button class="text-gray-400 text-xl d-flex rounded-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ph-fill ph-dots-three-outline-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu--md border-0 bg-transparent p-0">
                                <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                                    <div class="card-body p-12">
                                        <div class="max-h-200 overflow-y-auto scroll-sm pe-8">
                                            <ul>
                                                <li class="mb-0">
                                                    <button type="button" class="delete-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                        <span class="text"><i class="ph ph-x-circle"></i> All Clear</span>
                                                    </button>
                                                </li>
                                                <li class="mb-0">
                                                    <button type="button" class="delete-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                        <span class="text"><i class="ph ph-user-minus"></i> Block</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="chat-box-item-wrapper overflow-y-auto scroll-sm p-24">
                    <div class="chat-box-item d-flex align-items-end gap-8">
                         <img src="assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                         <div class="chat-box-item__content">
                             <p class="chat-box-item__text p-16 rounded-16 mb-12">Hello Mac</p>
                             <p class="chat-box-item__text py-16 px-16 px-lg-4">Lorem ipsum dolor sit amet consectetur. Cursus vulputate eget ullamcorper bibendum pulvinar sed at libero. Vulputate amet fermentum sapien amet tempus ac donec.</p>
                             <span class="text-gray-200 text-13 mt-2 d-block">10 min ago</span>
                         </div>
                    </div>
                    <div class="chat-box-item right d-flex align-items-end gap-8">
                         <img src="assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                         <div class="chat-box-item__content">
                             <p class="chat-box-item__text py-16 px-16 px-lg-4">Lorem ipsum dolor sit amet consect.Cursus vulputate eget ullamcorper bibendum </p>
                             <span class="text-gray-200 text-13 mt-2 d-block">10 min ago</span>
                         </div>
                    </div>
                    <div class="chat-box-item d-flex align-items-end gap-8">
                         <img src="assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                         <div class="chat-box-item__content">
                             <p class="chat-box-item__text py-16 px-16 px-lg-4">Lorem ipsum dolor sit amet consectetur. Cursus vulputate eget ullamcorper bibendum pulvinar sed at libero.</p>
                             <span class="text-gray-200 text-13 mt-2 d-block">10 min ago</span>
                         </div>
                    </div>
                    <div class="chat-box-item right d-flex align-items-end gap-8">
                         <img src="assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                         <div class="chat-box-item__content">
                             <p class="chat-box-item__text py-16 px-16 px-lg-4">Lorem ipsum dolor sit amet consect.Cursus vulputate eget ullamcorper bibendum </p>
                             <span class="text-gray-200 text-13 mt-2 d-block">10 min ago</span>
                         </div>
                    </div>
                    <div class="chat-box-item d-flex align-items-end gap-8">
                         <img src="assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                         <div class="chat-box-item__content">
                             <p class="chat-box-item__text p-16 rounded-16 mb-12">Hello Mac</p>
                             <p class="chat-box-item__text py-16 px-16 px-lg-4">Lorem ipsum dolor sit amet consectetur. Cursus vulputate eget ullamcorper bibendum pulvinar sed at libero. Vulputate amet fermentum sapien amet tempus ac donec.</p>
                             <span class="text-gray-200 text-13 mt-2 d-block">10 min ago</span>
                         </div>
                    </div>
                    <div class="chat-box-item right d-flex align-items-end gap-8">
                        <img src="assets/images/thumbs/avatar-img1.png" alt="" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                        <div class="chat-box-item__content">
                            <p class="chat-box-item__text py-4 px-16 px-lg-4">...</p>
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
        <!-- chat sidebar End -->
    </div>
     
</div>
@endsection