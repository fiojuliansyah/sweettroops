@extends('layouts.master')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><a href="{{ route('admin.courses.index') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Courses</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><a href="{{ route('admin.videos.index', $course->id) }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">{{ $course->title }}</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Upload Video</span></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom border-gray-100 flex-align gap-8">
                <h5 class="mb-0">Upload Video to YouTube</h5>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form id="upload-form" action="{{ route('admin.videos.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <div class="row gy-20">
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Video Title <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                required placeholder="Enter video title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Description <span
                                    class="text-danger">*</span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required
                                placeholder="Enter video description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Video File <span class="text-danger">*</span></label>
                            <input type="file" name="video" id="video" class="filepond" 
                                   accept="video/mp4,video/quicktime,video/x-flv,video/x-ms-wmv">
                            <div id="file-info" class="mt-2 text-muted"></div>
                            <small class="text-muted d-block mt-2">Supported formats: MP4, MOV, FLV, WMV. Files up to 2GB+ supported.</small>
                        </div>                    

                        <!-- Submit Button -->
                        <div class="col-sm-12 flex-align justify-content-end gap-8">
                            <a href="{{ route('admin.videos.index', $course->id) }}"
                                class="btn btn-outline-main rounded-pill py-9">Cancel</a>
                            <button type="submit" class="btn btn-main rounded-pill py-9">
                                <i class="ph ph-cloud-arrow-up me-2"></i> Upload Video
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('css')
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Register plugins
        FilePond.registerPlugin(
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        
        // Create hidden input element
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'video_path';
        document.getElementById('upload-form').appendChild(hiddenInput);
        
        // Create FilePond instance
        const pond = FilePond.create(document.querySelector('#video'), {
            // Set name to "filepond" - this is what FilePond uses by default
            name: 'filepond',
            
            // Server configuration with explicit CSRF token
            server: {
                process: {
                    url: '{{ route("admin.videos.upload") }}',
                    method: 'POST',
                    withCredentials: false,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    onload: (response) => {
                        console.log('Raw response:', response);
                        try {
                            const data = JSON.parse(response);
                            if (data.path) {
                                hiddenInput.value = data.path;
                                console.log('Video path stored:', data.path);
                            }
                        } catch (e) {
                            console.error('Invalid server response:', response);
                        }
                        return response;
                    },
                    onerror: (response) => {
                        console.error('Upload error response:', response);
                    }
                }
            },
            
            // Validation
            acceptedFileTypes: ['video/mp4', 'video/quicktime', 'video/x-flv', 'video/x-ms-wmv'],
            fileValidateTypeLabelExpectedTypes: 'Supports MP4, MOV, FLV, WMV',
            fileValidateSizeMax: 2 * 1024 * 1024 * 1024,
            labelIdle: 'Drag & Drop your video or <span class="filepond--label-action">Browse</span>'
        });
        
        // Form validation before submit
        document.getElementById('upload-form').addEventListener('submit', function(e) {
            if (!hiddenInput.value) {
                e.preventDefault();
                alert('Please upload a video file first.');
            }
        });
    });
</script>
@endpush
