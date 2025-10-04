@extends('layouts.main')

@section('content')
<div class="content-wrapper blank-page">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="page-title"> Edit Hands-on Class </h3>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row gy-20">
                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Title <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name', $gallery->name) }}">
                    </div>

                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $gallery->description) }}</textarea>
                    </div>

                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Current Images</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(json_decode($gallery->image, true) ?? [] as $img)
                                <div style="width:120px">
                                    <img src="{{ asset('storage/'.$img) }}" class="img-fluid rounded mb-2" alt="gallery">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Upload New Images</label>
                        <input type="file" name="image[]" class="form-control" multiple>
                        <small class="text-muted">Leave empty if no new images.</small>
                    </div>

                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', $gallery->date) }}">
                    </div>

                    <div class="col-sm-12 mt-3">
                        <a href="{{ route('admin.galleries.index') }}" class="btn btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Course</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
