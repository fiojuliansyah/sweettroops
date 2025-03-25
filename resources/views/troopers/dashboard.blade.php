@extends('layouts.master')

@section('content')
<div class="dashboard-body">
            
    <div class="row gy-4">
        <div class="col-xxl-8">
            <div class="card h-100">
                <div class="card-body grettings-box-two position-relative z-1 p-0">
                    <div class="row align-items-center h-100">
                        <div class="col-lg-6">
                            <div class="grettings-box-two__content">
                                <h2 class="fw-medium mb-0 flex-align gap-10">Hi, {{ Auth::user()->name }} <img
                                        src="/admin/assets/images/icons/wave-hand.png" alt=""> </h2>
                                <h2 class="fw-medium mb-16">What do you want to learn today with your partner?
                                </h2>
                                <p class="text-15 text-gray-400">Discover courses, track progress, and achieve
                                    your learning goods seamlessly.</p>
                                <a href="{{ route('troopers.all-course') }}" class="btn btn-main rounded-pill mt-32">Explore
                                    Courses</a>
                            </div>
                        </div>
                        <div class="col-lg-6 d-md-block d-none mt-auto">
                            <img src="/admin/assets/images/thumbs/cooking.png" alt="" width="50%">
                        </div>
                    </div>
                    <img src="/admin/assets/images/bg/star-shape.png"
                        class="position-absolute start-0 top-0 w-100 h-100 z-n1 object-fit-contain"
                        alt="">
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <!-- Widgets Start -->
            <div class="row gy-4">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex-between gap-8 mb-24">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-600 text-white text-2xl"><i
                                        class="ph-fill ph-graduation-cap"></i></span>
                                <div id="complete-course" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>

                            <h4 class="mb-2">155+</h4>
                            <span class="text-gray-300">Completed Courses</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex-between gap-8 mb-24">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-main-two-600 text-white text-2xl"><i
                                        class="ph-fill ph-graduation-cap"></i></span>
                                <div id="earned-certificate"
                                    class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>

                            <h4 class="mb-2">39+</h4>
                            <span class="text-gray-300">Earned Certificate</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex-between gap-8 mb-24">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-purple-600 text-white text-2xl"><i
                                        class="ph-fill ph-certificate"></i></span>
                                <div id="course-progress" class="remove-tooltip-title rounded-tooltip-value">
                                </div>
                            </div>

                            <h4 class="mb-2">25+</h4>
                            <span class="text-gray-300">Course in Progress</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex-between gap-8 mb-24">
                                <span
                                    class="flex-shrink-0 w-48 h-48 flex-center rounded-circle bg-warning-600 text-white text-2xl"><i
                                        class="ph-fill ph-users-four"></i></span>
                                <div id="community-support"
                                    class="remove-tooltip-title rounded-tooltip-value"></div>
                            </div>

                            <h4 class="mb-2">18k+</h4>
                            <span class="text-gray-300">Community Support</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->
        </div>
    </div>
</div>
@endsection