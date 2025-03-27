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
                            <label class="h5 mb-8 fw-semibold font-heading">Tipe Upload<span class="text-danger">*</span></label>
                            <select name="type" id="uploadType" class="form-control">
                                <option value="">Pilih</option>
                                <option value="url">Url</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                        
                        {{-- URL --}}
                        <div class="col-sm-12" id="urlSection" style="display: none;">
                            <label class="h5 mb-8 fw-semibold font-heading">URL Video<span class="text-danger">*</span></label>
                            <input type="text" name="link_url" id="link_url" class="form-control @error('link_url') is-invalid @enderror"
                                placeholder="Enter video Link URL" value="{{ old('link_url') }}">
                            @error('link_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- VIDEO UPLOAD --}}
                        <div class="col-sm-12" id="videoSection" style="display: none;">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5>Upload File</h5>
                                </div>
                        
                                <div class="card-body">
                                    <div id="upload-container" class="text-center">
                                        <span id="browseFile" class="btn btn-primary">Browse File</span>
                                    </div>
                                    <div style="display: none" class="progress mt-3" style="height: 25px">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                                    </div>
                                </div>
                        
                                <div class="card-footer p-4" style="display: none">
                                    <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the select dropdown and sections by id
            const selectType = document.getElementById('uploadType');
            const urlSection = document.getElementById('urlSection');
            const videoSection = document.getElementById('videoSection');
    
            // Function to toggle sections based on selected type
            function toggleSections() {
                const selectedType = selectType.value;
    
                // Show/hide sections based on selection
                if (selectedType === 'url') {
                    urlSection.style.display = 'block';
                    videoSection.style.display = 'none';
                } else if (selectedType === 'video') {
                    urlSection.style.display = 'none';
                    videoSection.style.display = 'block';
                } else {
                    urlSection.style.display = 'none';
                    videoSection.style.display = 'none';
                }
            }
    
            // Initialize the form visibility based on the current selection
            toggleSections();
    
            // Add event listener to handle change in the select dropdown
            selectType.addEventListener('change', toggleSections);
        });
    </script>    
    
    <script>
        let browseFile = $('#browseFile');

        let resumable = new Resumable({
            target: '/manage/video-upload/large',
            query: {
                _token:'{{ csrf_token() }}'
            },
            fileType: ['mp4'],
            chunkSize: 10 * 1024 * 1024,
            headers: {
                'Accept' : 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) {
            showProgress();
            resumable.upload()
        });

        resumable.on('fileProgress', function (file) {
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) {
            response = JSON.parse(response)

            $('#videoPreview').attr('src', response.path);
            $('.card-footer').show();

            $('#filename').attr('value', response.filename);
        });

        resumable.on('fileError', function (file, response) {
            alert('file uploading error.')
        });


        let progress = $('.progress');
        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>
@endpush
