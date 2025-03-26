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

                        {{-- CONTOH SAJA --}}
                        <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">File Name (tidak perlu di input manual)<span
                                    class="text-danger">*</span></label>
                            <input type="text" id="filename" name="filename" class="form-control @error('filename') is-invalid @enderror"
                                required placeholder="Enter video filename" value="{{ old('filename') }}">
                            @error('filename')
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

                        {{-- <div class="col-sm-12">
                            <label class="h5 mb-8 fw-semibold font-heading">Video File <span class="text-danger">*</span></label>
                            <input type="file" name="video" id="video" class="filepond" 
                                   accept="video/mp4,video/quicktime,video/x-flv,video/x-ms-wmv">
                            <div id="file-info" class="mt-2 text-muted"></div>
                            <small class="text-muted d-block mt-2">Supported formats: MP4, MOV, FLV, WMV. Files up to 2GB+ supported.</small>
                        </div>                     --}}
                        
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5>Upload File</h5>
                                </div>
                
                                <div class="card-body">
                                    <div id="upload-container" class="text-center">
                                        <span id="browseFile" class="btn btn-primary">Browse File</span>
                                    </div>
                                    <div  style="display: none" class="progress mt-3" style="height: 25px">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
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
    {{-- <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Register plugins
        //     FilePond.registerPlugin(
        //         FilePondPluginFileValidateSize,
        //         FilePondPluginFileValidateType
        //     );
            
        //     // Create hidden input element
        //     const hiddenInput = document.createElement('input');
        //     hiddenInput.type = 'hidden';
        //     hiddenInput.name = 'video_path';
        //     document.getElementById('upload-form').appendChild(hiddenInput);
            
        //     // Create FilePond instance
        //     const pond = FilePond.create(document.querySelector('#video'), {
        //         // Set name to "filepond" - this is what FilePond uses by default
        //         name: 'filepond',
                
        //         // Server configuration with explicit CSRF token
        //         server: {
        //             process: {
        //                 url: '{{ route("admin.videos.upload") }}',
        //                 method: 'POST',
        //                 withCredentials: false,
        //                 headers: {
        //                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //                     'Accept': 'application/json'
        //                 },
        //                 onload: (response) => {
        //                     console.log('Raw response:', response);
        //                     try {
        //                         const data = JSON.parse(response);
        //                         if (data.path) {
        //                             hiddenInput.value = data.path;
        //                             console.log('Video path stored:', data.path);
        //                         }
        //                     } catch (e) {
        //                         console.error('Invalid server response:', response);
        //                     }
        //                     return response;
        //                 },
        //                 onerror: (response) => {
        //                     console.error('Upload error response:', response);
        //                 }
        //             }
        //         },
                
        //         // Validation
        //         acceptedFileTypes: ['video/mp4', 'video/quicktime', 'video/x-flv', 'video/x-ms-wmv'],
        //         fileValidateTypeLabelExpectedTypes: 'Supports MP4, MOV, FLV, WMV',
        //         fileValidateSizeMax: 4 * 1024 * 1024 * 1024,
        //         labelIdle: 'Drag & Drop your video or <span class="filepond--label-action">Browse</span>'
        //     });
            
        //     // Form validation before submit
        //     document.getElementById('upload-form').addEventListener('submit', function(e) {
        //         if (!hiddenInput.value) {
        //             e.preventDefault();
        //             alert('Please upload a video file first.');
        //         }
        //     });
        // });

        // const uploadFileLogo = document.querySelector('input[name="video"]')
        // const uploadFileLogoButton = document.querySelector('#file-upload-button')
        // const uploadFileLogoPreview = document.querySelector('#filename-preview')

        // if(uploadFileLogo) {
        //     uploadFileLogo.addEventListener('change', function() {
        //         let uploadedFile = this.files[0]
                
        //         // SHOW FILENAME PREVIEW
        //         uploadFileLogoPreview.classList.add('flex')

        //         const fileSize = this.files[0].size;

        //         if(uploadFileLogo.value == null) {
        //             // console.log(uploadFileLogo.value);
        //         } else {
        //             uploadFileLogoPreview.innerHTML = `
        //                 <div class="upload-loader"></div>
        //             `
                    
        //             setTimeout(() => {
        //                 uploadFileLogoPreview.innerHTML = `
        //                     <div class="w-full h-full grid grid-cols-1 md:grid-cols-5 gap-5">
        //                         <div class="md:col-span-2 h-40 md:h-full border rounded-md overflow-hidden">
        //                             <img id="image-preview" class="w-full h-full object-cover" />
        //                         </div>
        //                         <div class="w-full md:col-span-3 overflow-x-auto">
        //                             <table class="w-full table-auto border text-left">
        //                                 <tbody>
        //                                     <tr class="border align-top">
        //                                         <th class="text-xs p-2 whitespace-nowrap">Nama File</th>
        //                                         <td class="text-xs p-2">:</td>
        //                                         <td class="text-xs p-2">${uploadedFile.name}</td>
        //                                     </tr>
        //                                     <tr class="border align-top">
        //                                         <th class="text-xs p-2 whitespace-nowrap">Ukuran</th>
        //                                         <td class="text-xs p-2">:</td>
        //                                         <td class="text-xs p-2">
        //                                             <span id="filesize-kb"></span>
        //                                             <span>/</span>
        //                                             <span id="filesize-mb"></span>
        //                                         </td>
        //                                     </tr>
        //                                     <tr class="border align-top">
        //                                         <th class="text-xs p-2 whitespace-nowrap">Catatan</th>
        //                                         <td class="text-xs p-2">:</td>
        //                                         <td class="text-xs p-2">
        //                                             <span id="file-size-warning" class="text-yellow-600"></span>
        //                                         </td>
        //                                     </tr>
        //                                     <tr class="border align-top">
        //                                         <th class="text-xs p-2">Aksi</th>
        //                                         <td class="text-xs p-2">:</td>
        //                                         <td class="p-2">
        //                                             <div id="delete-preview" class="flex items-center space-x-2 transition-all duration-100 whitespace-nowrap text-red-500 hover:text-red-600 hover:underline cursor-pointer rounded-md">
        //                                                 <iconify-icon icon="akar-icons:trash-can"></iconify-icon>
        //                                                 <span class="text-xs">Hapus file</span>
        //                                             </div>
        //                                         </td>
        //                                     </tr>
        //                                 </tbody>
        //                             </table>
        //                         </div>
        //                     </div>
        //                 `

        //                 let reader = new FileReader();
        
        //                 reader.onload = function (e) {
        //                     document.getElementById('image-preview').src = e.target.result;
                            
        //                     const fileSizeInKB = Math.round(fileSize / 1024);
        //                     const valueFileSizeInMB = fileSize / (1024 * 1024);
        //                     const fileSizeInMB = valueFileSizeInMB.toFixed(2)
        
        //                     document.getElementById('filesize-kb').innerText = fileSizeInKB + ' KB';
        //                     document.getElementById('filesize-mb').innerText = fileSizeInMB + ' MB';
        
        //                     if(fileSizeInMB > 5) {
        //                         document.getElementById('file-size-warning').innerText = 'Disarankan menggunakan file dengan ukuran lebih kecil!';
        //                     } else {
        //                         document.getElementById('file-size-warning').innerText = '-';
        //                     }
        //                 };
        
        //                 reader.readAsDataURL(this.files[0]);

        //                 const deletePreview = document.querySelector('#delete-preview')
            
        //                 if(deletePreview) {
        //                     deletePreview.addEventListener('click', function() {
        //                         uploadFileLogo.value = ''
            
        //                         uploadFileLogoPreview.innerHTML = `
        //                             <div class="w-56 p-5 md:p-0">
        //                                 <img src="{{ asset('images/nothing-upload.svg') }}" alt="" class="h-full" />
        //                             </div>
        //                             <div class="w-full text-center py-5">
        //                                 <h1 class="md:text-lg font-semibold">Belum ada file yang dipilih</h1>
        //                                 <p class="text-sm text-slate-500">Anda harus menambahkan gambar untuk fraksi</p>
        //                             </div>`
            
        //                         uploadFileLogoButton.innerHTML = `<div class="px-5">
        //                                                                 <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" viewBox="0 0 24 24">
        //                                                                     <path class="fill-blue-500" fill-rule="evenodd" d="M12 2a6.001 6.001 0 0 0-5.476 3.545a23.012 23.012 0 0 1-.207.452l-.02.001C6.233 6 6.146 6 6 6a4 4 0 1 0 0 8h.172l2-2H6a2 2 0 1 1 0-4h.064c.208 0 .45.001.65-.04a1.94 1.94 0 0 0 .7-.27c.241-.156.407-.35.533-.527a2.39 2.39 0 0 0 .201-.36c.053-.11.118-.255.196-.428l.004-.01a4.001 4.001 0 0 1 7.304 0l.005.01c.077.173.142.317.195.428c.046.097.114.238.201.36c.126.176.291.371.533.528c.242.156.487.227.7.27c.2.04.442.04.65.04L18 8a2 2 0 1 1 0 4h-2.172l2 2H18a4 4 0 0 0 0-8c-.146 0-.233 0-.297-.002h-.02A6.001 6.001 0 0 0 12 2m5.702 4.034" clip-rule="evenodd" />
        //                                                                     <path class="fill-blue-500" d="m12 12l-.707-.707l.707-.707l.707.707zm1 9a1 1 0 1 1-2 0zm-5.707-5.707l4-4l1.414 1.414l-4 4zm5.414-4l4 4l-1.414 1.414l-4-4zM13 12v9h-2v-9z" />
        //                                                                 </svg>
        //                                                             </div>
        //                                                             <div class="flex flex-col items-center md:items-start space-y-1 mt-2">
        //                                                                 <span class="font-semibold text-blue-600">Tarik gambar ke area ini atau</span>
        //                                                                 <button class="w-28 h-8 flex justify-center items-center bg-blue-500 group-hover:bg-blue-600 text-xs font-normal text-white">Pilih gambar</button>
        //                                                                 <span class="font-light text-[11px] md:text-xs text-blue-900">* Foto harus berupa .png/.jpg/.jpeg</span>
        //                                                             </div>
        //                                                             `
        //                     })
        //                 }
        //             }, 1800)
        //         }
        //     })
        // }

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

            // console.log(response);
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
