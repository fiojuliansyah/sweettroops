@extends('layouts.master')

@section('content')
<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">{{ $homepage ? 'Edit Homepage' : 'Create Homepage' }}</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ $homepage ? 'Edit Homepage' : 'Create Homepage' }}</h5>
        </div>
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

            <form action="{{ route('admin.homepages.save', $homepage->id ?? '') }}" method="POST">
                @csrf
                @if($homepage)
                    @method('POST') <!-- Untuk update data -->
                @endif

                <div class="row">
                    <!-- Title and Sub Title -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label h6">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $homepage->title ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sub_title" class="form-label h6">Sub Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" name="sub_title" value="{{ old('sub_title', $homepage->sub_title ?? '') }}" required>
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Detail Section -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="detail" class="form-label h6">Detail <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" rows="4" required>{{ old('detail', $homepage->detail ?? '') }}</textarea>
                            @error('detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Tabs -->
                    @foreach([1, 2, 3] as $tab)
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tab_{{ $tab }}" class="form-label h6">Tab {{ $tab }}</label>
                                <input type="text" class="form-control @error('tab_' . $tab) is-invalid @enderror" id="tab_{{ $tab }}" name="tab_{{ $tab }}" value="{{ old('tab_' . $tab, $homepage->{'tab_' . $tab} ?? '') }}">
                                @error('tab_' . $tab)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title_tab_{{ $tab }}" class="form-label h6">Tab {{ $tab }} Title</label>
                                <input type="text" class="form-control @error('title_tab_' . $tab) is-invalid @enderror" id="title_tab_{{ $tab }}" name="title_tab_{{ $tab }}" value="{{ old('title_tab_' . $tab, $homepage->{'title_tab_' . $tab} ?? '') }}">
                                @error('title_tab_' . $tab)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="tab_{{ $tab }}" class="form-label h6">Tab {{ $tab }} Content</label>
                                <textarea class="form-control @error('detail_tab_' . $tab) is-invalid @enderror" id="detail_tab_{{ $tab }}" name="detail_tab_{{ $tab }}" rows="4">{{ old('detail_tab_' . $tab, $homepage->{'detail_tab_' . $tab} ?? '') }}</textarea>
                                @error('detail_tab_' . $tab)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <!-- Section Details -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="section_title" class="form-label h6">Section Title</label>
                            <input type="text" class="form-control @error('section_title') is-invalid @enderror" id="section_title" name="section_title" value="{{ old('section_title', $homepage->section_title ?? '') }}">
                            @error('section_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="section_sub_title" class="form-label h6">Section Sub Title</label>
                            <input type="text" class="form-control @error('section_sub_title') is-invalid @enderror" id="section_sub_title" name="section_sub_title" value="{{ old('section_sub_title', $homepage->section_sub_title ?? '') }}">
                            @error('section_sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="section_detail" class="form-label h6">Section Detail</label>
                            <textarea class="form-control @error('section_detail') is-invalid @enderror" id="section_detail" name="section_detail" rows="4">{{ old('section_detail', $homepage->section_detail ?? '') }}</textarea>
                            @error('section_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="section_button" class="form-label h6">Section Button</label>
                            <input type="text" class="form-control @error('section_button') is-invalid @enderror" id="section_button" name="section_button" value="{{ old('section_button', $homepage->section_button ?? '') }}">
                            @error('section_button')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="section_link" class="form-label h6">Section Link</label>
                            <input type="text" class="form-control @error('section_link') is-invalid @enderror" id="section_link" name="section_link" value="{{ old('section_link', $homepage->section_link ?? '') }}">
                            @error('section_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Accordion Details -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="accord_title" class="form-label h6">Accordion Title</label>
                            <input type="text" class="form-control @error('accord_title') is-invalid @enderror" id="accord_title" name="accord_title" value="{{ old('accord_title', $homepage->accord_title ?? '') }}">
                            @error('accord_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="accord_detail" class="form-label h6">Accordion Detail</label>
                            <textarea class="form-control @error('accord_detail') is-invalid @enderror" id="accord_detail" name="accord_detail" rows="4">{{ old('accord_detail', $homepage->accord_detail ?? '') }}</textarea>
                            @error('accord_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Accord Tabs -->
                    @foreach([1, 2, 3] as $accordTab)
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="accord_tab_{{ $accordTab }}" class="form-label h6">Accordion Tab {{ $accordTab }} Title</label>
                                <input type="text" class="form-control @error('accord_tab_' . $accordTab) is-invalid @enderror" id="accord_tab_{{ $accordTab }}" name="accord_tab_{{ $accordTab }}" value="{{ old('accord_tab_' . $accordTab, $homepage->{'accord_tab_' . $accordTab} ?? '') }}">
                                @error('accord_tab_' . $accordTab)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="accord_detail_tab_{{ $accordTab }}" class="form-label h6">Accordion Tab {{ $accordTab }} Detail</label>
                                <textarea class="form-control @error('accord_detail_tab_' . $accordTab) is-invalid @enderror" id="accord_detail_tab_{{ $accordTab }}" name="accord_detail_tab_{{ $accordTab }}" rows="4">{{ old('accord_detail_tab_' . $accordTab, $homepage->{'accord_detail_tab_' . $accordTab} ?? '') }}</textarea>
                                @error('accord_detail_tab_' . $accordTab)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <!-- Contact Information -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="contact_title" class="form-label h6">Contact Title</label>
                            <input type="text" class="form-control @error('contact_title') is-invalid @enderror" id="contact_title" name="contact_title" value="{{ old('contact_title', $homepage->contact_title ?? '') }}">
                            @error('contact_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="contact_detail" class="form-label h6">Contact Detail</label>
                            <textarea class="form-control @error('contact_detail') is-invalid @enderror" id="contact_detail" name="contact_detail" rows="4">{{ old('contact_detail', $homepage->contact_detail ?? '') }}</textarea>
                            @error('contact_detail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label h6">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $homepage->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="hours" class="form-label h6">Working Hours</label>
                            <input type="text" class="form-control @error('hours') is-invalid @enderror" id="hours" name="hours" value="{{ old('hours', $homepage->hours ?? '') }}">
                            @error('hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location" class="form-label h6">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $homepage->location ?? '') }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label h6">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $homepage->phone ?? '') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="map_url" class="form-label h6">Map URL</label>
                            <input type="text" class="form-control @error('map_url') is-invalid @enderror" id="map_url" name="map_url" value="{{ old('map_url', $homepage->map_url ?? '') }}">
                            @error('map_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-main">
                        <i class="ph ph-check-circle me-2"></i> Save Homepage
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
