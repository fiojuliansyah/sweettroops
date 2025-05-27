@extends('layouts.master')

@section('content')
    <div class="dashboard-body">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Kursus</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Kursus Saya</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('troopers.all-course') }}" method="GET" class="search-input-form">
                    <div class="search-input">
                        <select name="category_id" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                            <option value="" selected disabled>Kategori</option>
                        </select>
                    </div>
                    <div class="search-input">
                        <select name="type_id" class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                            <option value="" selected disabled>Tipe Kelas</option>
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
                    <img src="{{ Storage::disk('s3')->url('login-image.png') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
@endsection