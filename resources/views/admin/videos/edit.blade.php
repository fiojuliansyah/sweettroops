@extends('layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><a href="{{ route('admin.courses.index') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Courses</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><a href="{{ route('admin.videos.index', $course->id) }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">{{ $course->title }}</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Edit Video</span></li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                        <h5 class="mb-0">Edit Video Details</h5>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('admin.videos.update', $video->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row gy-20">
                                <div class="col-sm-12">
                                    <label class="h5 mb-8 fw-semibold font-heading">Video Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                        required value="{{ old('title', $video->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-sm-12">
                                    <label class="h5 mb-8 fw-semibold font-heading">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                        rows="4">{{ old('description', $video->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="h5 mb-8 fw-semibold font-heading">Order <span class="text-danger">*</span></label>
                                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" 
                                        required value="{{ old('order', $video->order) }}" min="1">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-sm-6">
                                    <label class="h5 mb-8 fw-semibold font-heading">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="active" {{ old('status', $video->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="deleted" {{ old('status', $video->status) == 'deleted' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-sm-12 flex-align justify-content-end gap-8">
                                    <a href="{{ route('admin.videos.index', $course->id) }}" class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">
                                        <i class="ph ph-floppy-disk me-2"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header border-bottom border-gray-100">
                        <h5 class="mb-0">Video Preview</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $video->youtubeId }}" title="{{ $video->title }}" allowfullscreen></iframe>
                            </div>
                        </div>
                        
                        <div class="video-info">
                            <div class="d-flex mb-3 align-items-center">
                                <span class="h6 mb-0 w-100px">Duration:</span>
                                <span class="text-gray-400">{{ $video->duration }}</span>
                            </div>
                            <div class="d-flex mb-3 align-items-center">
                                <span class="h6 mb-0 w-100px">URL:</span>
                                <a href="{{ $video->video_url }}" target="_blank" class="text-main-600">Watch on YouTube</a>
                            </div>
                            <div class="d-flex mb-3 align-items-center">
                                <span class="h6 mb-0 w-100px">Uploaded:</span>
                                <span class="text-gray-400">{{ $video->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection