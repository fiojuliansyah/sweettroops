@extends('layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Create Slider</span></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                <h5 class="mb-0">Slider Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-20">
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Slider Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="Enter slider title">
                        </div>
                        <div class="col-sm-6">
                            <label class="h5 mb-8 fw-semibold font-heading">Slider Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Enter slider subtitle">
                        </div>
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Link</label>
                            <input type="url" name="link" class="form-control" placeholder="Enter URL for the link">
                        </div>
                        <div class="col-sm-12 flex-align justify-content-end gap-8">
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                            <button type="submit" class="btn btn-main rounded-pill py-9">Create Slider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
