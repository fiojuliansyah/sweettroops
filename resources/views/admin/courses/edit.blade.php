@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Edit Course </h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- For update route -->
                <div class="row gy-20">
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required placeholder="Enter course title" value="{{ old('title', $course->title) }}">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Instructor Name <span class="text-danger">*</span></label>
                        <input type="text" name="instructor" class="form-control" required placeholder="Enter instructor name" value="{{ old('instructor', $course->instructor) }}">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Type <span class="text-danger">*</span></label>
                        <select name="type_id" class="form-select" required>
                            <option value="" disabled selected>Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ $course->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                   <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Description</label>
                        <textarea id="summernote" name="description" class="form-control" rows="6" placeholder="Enter course description">{{ old('description', $course->description) }}</textarea>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Normal Price</label>
                        <input type="number" name="normal_price" class="form-control" placeholder="Enter normal price" value="{{ old('normal_price', $course->normal_price) }}">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Discounted Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter discounted price" value="{{ old('price', $course->price) }}">
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Thumbnail</label>
                        @if($course->thumbnail)
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach (json_decode($course->thumbnail, true) as $thumb)
                                    <div>
                                        <img src="{{ asset('storage/' . $thumb) }}" 
                                            alt="Course Thumbnail" 
                                            style="max-width: 100px; border:1px solid #ddd; border-radius:5px; margin:5px;">
                                    </div>
                                @endforeach
                            </div>
                            <p>Current Thumbnails</p>
                        @endif
                        <input type="file" name="thumbnail[]" class="form-control mt-2" multiple>
                    </div>

                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Points</label>
                        <input type="number" name="point" class="form-control" placeholder="Enter course points" value="{{ old('point', $course->point) }}">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Featured Course</label>
                        <select name="is_featured" class="form-select">
                            <option value="0" {{ $course->is_featured == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $course->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Recommend Course</label>
                        <select name="is_recommend" class="form-select">
                            <option value="0" {{ $course->is_recommend == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $course->is_recommend == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Upcoming Course</label>
                        <select name="is_upcoming" class="form-select">
                            <option value="0" {{ $course->is_upcoming == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $course->is_upcoming == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Newest Course</label>
                        <select name="is_newest" class="form-select">
                            <option value="0" {{ $course->is_newest == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $course->is_newest == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Active Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1" {{ $course->is_active == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $course->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Course</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <style>
        /* Paksa board editor putih */
        .note-editor.note-frame .note-editing-area .note-editable {
            background-color: #ffffff !important;
            color: #000000; /* biar teks tetap jelas */
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Enter course description...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endpush
