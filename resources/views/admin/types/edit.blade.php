@extends('layouts.main')

@section('content')
<div class="content-wrapper blank-page">
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Edit Type: {{ $type->name }} </h3>
        </div>
    </div>
    <div class="card">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.types.update', $type) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label h6">Type Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $type->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <input type="hidden" class="form-control" id="slug" value="{{ $type->slug }}" disabled readonly>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label h6">Type Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                <small class="text-muted">Leave empty to keep the current image.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label h6">Current Image</label>
                                <div class="border rounded p-2 text-center">
                                    <img id="current-image" src="{{ asset('storage/' . $type->image) }}" alt="{{ $type->name }}" style="max-height: 200px; max-width: 100%;">
                                </div>
                            </div>
                            
                            <div class="mb-3" id="preview-container" style="display: none;">
                                <label class="form-label h6">New Image Preview</label>
                                <div class="border rounded p-2 text-center">
                                    <img id="image-preview" src="#" alt="Preview" style="max-height: 200px; max-width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                        <a href="{{ route('admin.types.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>

<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('image-preview');
        
        if (event.target.files.length > 0) {
            preview.src = URL.createObjectURL(event.target.files[0]);
            previewContainer.style.display = 'block';
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endsection