@extends('layouts.main')

@section('content')
<div class="content-wrapper blank-page">
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Create Type </h3>
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
            <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label h6">Type Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label h6">Type Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label h6">Image Preview</label>
                            <div class="border rounded p-2 text-center">
                                <img id="image-preview" src="#" alt="Preview" style="max-height: 200px; max-width: 100%; display: none;">
                                <p id="no-image-text" class="mb-0 py-5">No image selected</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        Submit
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
    document.getElementById('image').addEventListener('change', function(event) {
        const preview = document.getElementById('image-preview');
        const noImageText = document.getElementById('no-image-text');
        
        if (event.target.files.length > 0) {
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block';
            noImageText.style.display = 'none';
        } else {
            preview.style.display = 'none';
            noImageText.style.display = 'block';
        }
    });
</script>
@endsection