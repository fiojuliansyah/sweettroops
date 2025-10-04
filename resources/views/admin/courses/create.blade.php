@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Create Course </h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row gy-20">
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required placeholder="Enter course title">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Instructor Name <span class="text-danger">*</span></label>
                        <input type="text" name="instructor" class="form-control" required placeholder="Enter instructor name">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Type <span class="text-danger">*</span></label>
                        <select name="type_id" class="form-select" required>
                            <option value="" disabled selected>Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter course description"></textarea>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Normal Price</label>
                        <input type="number" name="normal_price" class="form-control" placeholder="Enter normal price">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Discounted Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter discounted price">
                    </div>
                    <div class="col-sm-12">
                        <label class="h5 mb-8 fw-semibold font-heading">Thumbnails</label>
                        <input type="file" name="thumbnail[]" class="form-control" multiple>
                    </div>                                              
                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Points</label>
                        <input type="number" name="point" class="form-control" placeholder="Enter course points">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Featured Course</label>
                        <select name="is_featured" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Recommend Course</label>
                        <select name="is_recommend" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Upcoming Course</label>
                        <select name="is_upcoming" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Newest Course</label>
                        <select name="is_newest" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Active Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Course</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection