@extends('layouts.master')

@section('content')
<div class="dashboard-body">
    <!-- Breadcrumb Start -->
<div class="breadcrumb mb-24">
<ul class="flex-align gap-4">
<li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Courses</a></li>
<li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
<li><span class="text-main-600 fw-normal text-15">All Course</span></li>
</ul>
</div>
<!-- Breadcrumb End -->

    <div class="card">
        <div class="card-body">
            <h4 class="mb-0">Recommended For You</h4>
            <br>
            <form action="{{ route('troopers.all-course') }}" method="GET" class="search-input-form">
                <div class="search-input">
                    <select name="category_id" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-input">
                    <select name="type_id" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Tipe Kelas</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-input">
                    <select name="price" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Harga</option>
                        <option value="termurah" {{ request('price') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                        <option value="termahal" {{ request('price') == 'termahal' ? 'selected' : '' }}>Termahal</option>
                    </select>
                </div>
                <div class="search-input">
                    <button type="submit" class="btn btn-main rounded-pill py-9 w-100">Search</button>
                </div>
            </form>                    
        </div>
    </div>
    <div class="card mt-14">
        <div class="card-body">
            
            <div class="row g-20">
                @foreach ($courses as $course)   
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="card border border-gray-100">
                            <div class="card-body p-8">
                                <a href="course-details.html" class="rounded-20 overflow-hidden text-center mb-8 flex-center p-8">
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Course Image" width="500">
                                </a>
                                <div class="p-8">
                                    <span class="text-13 py-2 px-10 rounded-pill bg-success-50 text-success-600 mb-16">{{ $course->category->name }}</span>
                                    @if ($course->is_recommend == 1)  
                                        <span class="text-13 py-2 px-10 rounded-pill bg-info-50 text-info-600 mb-16">Recommended</span>
                                    @endif
                                    @if ($course->is_featured == 1)  
                                        <span class="text-13 py-2 px-10 rounded-pill bg-warning-50 text-warning-600 mb-16">Featured</span>
                                    @endif
                                    <h5 class="mb-0"><a href="course-details.html" class="hover-text-main-600">{{ $course->title }}</a></h5>

                                    <div class="flex-align gap-8 flex-wrap mt-16">
                                        <div>
                                            <span class="text-gray-600 text-13">Tipe Kelas <a href="profile.html" class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">{{ $course->type->name }}</a> </span>
                                        </div>
                                    </div>

                                    <div class="flex-align gap-8 mt-12 pt-12 border-top border-gray-100">
                                        <div class="flex-align gap-4">
                                            <span class="text-sm text-main-600 d-flex"><i class="ph ph-video-camera"></i></span>
                                            <span class="text-13 text-gray-600">1 Lesson</span>
                                        </div>
                                        <div class="flex-align gap-4">
                                            <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                            <span class="text-13 text-gray-600">2 Hours</span>
                                        </div>
                                    </div>

                                    <div class="flex-align gap-8 mt-12 pt-12">
                                        <div class="flex-align gap-4">
                                            <span class="text-20 text-success-600">Rp. {{ number_format($course->price) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-align gap-8">
                                        <div class="flex-align gap-4">
                                            <span class="text-13 text-danger-600"><s>Rp. {{ number_format($course->normal_price) }}</s></span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex-between gap-4 flex-wrap mt-24">
                                        <div class="flex-align gap-4">
                                            <span class="text-15 fw-bold text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            <span class="text-13 fw-bold text-gray-600">4.9</span>
                                            <span class="text-13 fw-bold text-gray-600">(12k)</span>
                                        </div>
                                        <a href="{{ route('troopers.detail-course', $course->slug) }}" class="btn btn-outline-main rounded-pill py-9">View Details</a>
                                        <a href="javascript:void(0)" class="btn btn-main rounded-pill py-9 buy-course" data-course-id="{{ $course->id }}"> BUY Course </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex-between flex-wrap gap-8 mt-20">
                <!-- Tombol Previous -->
                @if ($courses->onFirstPage())
                    <span class="btn btn-outline-gray rounded-pill py-9 flex-align gap-4 disabled">
                        <i class="ph ph-arrow-left"></i> Previous
                    </span>
                @else
                    <a href="{{ $courses->previousPageUrl() }}" class="btn btn-outline-gray rounded-pill py-9 flex-align gap-4">
                        <i class="ph ph-arrow-left"></i> Previous
                    </a>
                @endif
            
                <!-- Pagination Number -->
                <ul class="pagination flex-align flex-wrap">
                    @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $courses->currentPage() ? 'active' : '' }}">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                </ul>
            
                <!-- Tombol Next -->
                @if ($courses->hasMorePages())
                    <a href="{{ $courses->nextPageUrl() }}" class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                        Next <i class="ph ph-arrow-right"></i>
                    </a>
                @else
                    <span class="btn btn-outline-gray rounded-pill py-9 flex-align gap-4 disabled">
                        Next <i class="ph ph-arrow-right"></i>
                    </span>
                @endif
            </div>
            
            
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ config('midtrans.base_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.querySelectorAll('.buy-course').forEach(button => {
        button.addEventListener('click', function () {
            let courseId = this.getAttribute('data-course-id');

            fetch(`{{ url('/troopers/buy-course/') }}/${courseId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    snap.pay(data.snapToken);
                } else {
                    alert('Payment error');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endpush