@extends('layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Edit Course</span></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                <h5 class="mb-0">Edit Course Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- For update route -->
                    <div class="row gy-20">
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Course Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="Enter course title" value="{{ old('title', $course->title) }}">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Instructor Name <span class="text-danger">*</span></label>
                            <input type="text" name="instructor" class="form-control" required placeholder="Enter instructor name" value="{{ old('instructor', $course->instructor) }}">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Course Type <span class="text-danger">*</span></label>
                            <select name="type_id" class="form-select" required>
                                <option value="" disabled selected>Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $course->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Description</label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Enter course description">{{ old('description', $course->description) }}</textarea>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Normal Price</label>
                            <input type="number" name="normal_price" class="form-control" placeholder="Enter normal price" value="{{ old('normal_price', $course->normal_price) }}">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Discounted Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter discounted price" value="{{ old('price', $course->price) }}">
                        </div>
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Thumbnail</label>
                            @if($course->thumbnail)
                                <div>
                                    <img src="{{ asset('storage/' . json_decode($course->thumbnail)[0]) }}" alt="Current Thumbnail" style="max-width: 100px;">
                                    <p>Current Thumbnail</p>
                                </div>
                            @endif
                            <input type="file" name="thumbnail[]" class="form-control" multiple>
                        </div>
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Trailer</label>
                            <input type="file" name="trailer" class="form-control">
                        </div>  
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Course Points</label>
                            <input type="number" name="point" class="form-control" placeholder="Enter course points" value="{{ old('point', $course->point) }}">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Featured Course</label>
                            <select name="is_featured" class="form-select">
                                <option value="0" {{ $course->is_featured == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $course->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Recommend Course</label>
                            <select name="is_recommend" class="form-select">
                                <option value="0" {{ $course->is_recommend == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $course->is_recommend == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Active Status</label>
                            <select name="is_active" class="form-select">
                                <option value="1" {{ $course->is_active == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $course->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-sm-12 flex-align justify-content-end gap-8">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                            <button type="submit" class="btn btn-main rounded-pill py-9">Update Course</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
