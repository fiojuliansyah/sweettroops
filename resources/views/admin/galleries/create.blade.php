@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Create Hands-on Class </h3>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row gy-20">
                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Course Title <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required placeholder="Enter course title">
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter course description"></textarea>
                    </div>
                    <div class="col-sm-12">
                        <label class="h5 mb-8 fw-semibold font-heading">Images</label>
                        <input type="file" name="image[]" class="form-control" multiple>
                    </div>                                              
                    <div class="col-sm-12 mt-3">
                        <label class="h5 mb-8 fw-semibold font-heading">Date</label>
                        <input type="date" name="date" class="form-control">
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