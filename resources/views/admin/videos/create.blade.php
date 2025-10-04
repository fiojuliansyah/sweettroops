@extends('layouts.main')

@section('content')
<div class="content-wrapper blank-page">
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Upload Video </h3>
        </div>
    
        <div class="card">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
    
                <form id="upload-form" action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" id="filename" name="filename" />
    
                    <div class="row gy-20">
                        <!-- Title -->
                        <div class="col-sm-12 mt-3">
                            <label class="h5 mb-8 fw-semibold font-heading">Video Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title') }}">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
    
                        <!-- Description -->
                        <div class="col-sm-12 mt-3">
                            <label class="h5 mb-8 fw-semibold font-heading">Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required rows="4">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
    
                        <!-- Tipe Upload -->
                        <div class="col-sm-6 mt-3">
                            <label class="h5 mb-8 fw-semibold font-heading">Tipe Upload <span class="text-danger">*</span></label>
                            <select name="type" id="uploadType" class="form-select" required>
                                <option value="">-- Pilih</option>
                                <option value="url">URL</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
    
                        <!-- Penyimpanan -->
                        <div class="col-sm-6 mt-3" id="storageSection" style="display: none;">
                            <label class="h5 mb-8 fw-semibold font-heading">Penyimpanan <span class="text-danger">*</span></label>
                            <select name="storage" id="storage" class="form-select">
                                <option value="">-- Pilih</option>
                                <option value="youtube">Upload YouTube</option>
                                <option value="aws">Storage AWS</option>
                            </select>
                        </div>
    
                        <!-- URL -->
                        <div class="col-sm-12 mt-3" id="urlSection" style="display: none;">
                            <label class="h5 mb-8 fw-semibold font-heading">URL Video <span class="text-danger">*</span></label>
                            <input type="text" name="link_url" id="link_url" class="form-control @error('link_url') is-invalid @enderror" value="{{ old('link_url') }}">
                            @error('link_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
    
                        <!-- Upload Video -->
                        <div class="col-sm-12 mt-3" id="videoSection" style="display: none;">
                            <div class="card border">
                                <div class="card-header"><h5 class="mb-0">Upload File</h5></div>
                                <div class="card-body text-center">
                                    <button type="button" id="browseFile" class="btn btn-primary">Browse File</button>
                                    <input type="file" id="fileInput" name="video_file" accept="video/*" style="display: none;">
                                    <div class="progress mt-3" style="height: 25px; display: none;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">0%</div>
                                    </div>
                                </div>
                                <div class="card-footer p-4" style="display: none;">
                                    <video id="videoPreview" controls style="width: 100%; height: auto;"></video>
                                </div>
                            </div>
                        </div>
    
                        <!-- Action -->
                        <div class="col-sm-12 mt-4">
                            <a href="{{ route('admin.videos.index', $course->id) }}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ph ph-cloud-arrow-up me-2"></i> Upload Video
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectType = document.getElementById('uploadType');
            const urlSection = document.getElementById('urlSection');
            const videoSection = document.getElementById('videoSection');
            const storageSection = document.getElementById('storageSection');
            const storageSelect = document.getElementById('storage');
            const fileInput = document.getElementById('fileInput');
            const browseFileBtn = document.getElementById('browseFile');
            const progressBar = videoSection.querySelector('.progress');
            const progressBarInner = progressBar.querySelector('.progress-bar');
            const videoPreview = document.getElementById('videoPreview');
            const cardFooter = videoSection.querySelector('.card-footer');
            const filenameInput = document.getElementById('filename');

            function toggleSections() {
                const selectedType = selectType.value;
                urlSection.style.display = selectedType === 'url' ? 'block' : 'none';
                videoSection.style.display = selectedType === 'video' ? 'block' : 'none';
                storageSection.style.display = selectedType === 'video' ? 'block' : 'none';
                resetVideoSection();
            }

            function resetVideoSection() {
                progressBar.style.display = 'none';
                progressBarInner.style.width = '0%';
                progressBarInner.textContent = '0%';
                videoPreview.src = '';
                videoPreview.style.display = 'none';
                cardFooter.style.display = 'none';
                fileInput.value = '';
                filenameInput.value = '';
            }

            browseFileBtn.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', async () => {
                const file = fileInput.files[0];
                if (!file) return;

                // Tampilkan preview video
                const videoUrl = URL.createObjectURL(file);
                videoPreview.src = videoUrl;
                videoPreview.style.display = 'block';
                cardFooter.style.display = 'block';

                // Reset progress
                progressBar.style.display = 'block';
                progressBarInner.style.width = '0%';
                progressBarInner.textContent = '0%';

                const storage = storageSelect.value;

                if (storage === 'aws') {
                    try {
                        const uploadedUrl = await uploadFileToS3(file, progress => {
                            progressBarInner.style.width = progress + '%';
                            progressBarInner.textContent = progress + '%';
                        });
                        alert('Upload ke S3 berhasil!');
                    } catch (error) {
                        alert('Upload ke S3 gagal: ' + error.message);
                        resetVideoSection();
                    }
                } else if (storage === 'youtube') {
                    alert('File akan diupload ke YouTube saat form disubmit.');
                } else {
                    alert('Silakan pilih penyimpanan.');
                }
            });

            async function uploadFileToS3(file, onProgress) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch('/s3/presigned-url', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        filename: file.name,
                        content_type: file.type,
                        folder: 'videos',
                    })
                });

                if (!response.ok) {
                    throw new Error('Gagal mendapatkan presigned URL dari server.');
                }

                const data = await response.json();

                return new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', e => {
                        if (e.lengthComputable && typeof onProgress === 'function') {
                            const percent = Math.round((e.loaded / e.total) * 100);
                            onProgress(percent);
                        }
                    });

                    xhr.onload = () => {
                        if (xhr.status >= 200 && xhr.status < 300) {
                            filenameInput.value = data.key;
                            resolve(data.url); // optional: public_url if available
                        } else {
                            reject(new Error('Upload gagal dengan status ' + xhr.status));
                        }
                    };

                    xhr.onerror = () => reject(new Error('Upload gagal (network error)'));
                    xhr.open('PUT', data.url, true);
                    xhr.setRequestHeader('Content-Type', file.type);
                    xhr.send(file);
                });
            }

            selectType.addEventListener('change', toggleSections);
            storageSelect.addEventListener('change', () => {
                const inputName = (storageSelect.value === 'youtube') ? 'youtube_video_file' : 'video_file';
                fileInput.setAttribute('name', inputName);
            });

            toggleSections(); // Inisialisasi awal
        });
    </script>
@endpush
