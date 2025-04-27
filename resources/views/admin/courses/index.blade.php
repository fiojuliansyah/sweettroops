@extends('layouts.master')

@section('content')
<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                <li><span class="text-main-600 fw-normal text-15">Courses</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <a href="#" data-bs-toggle="modal" data-bs-target="#importCompetitionModal" class="btn btn-outline-main">
                <i class="ph ph-upload-simple me-2"></i> Import Competitions
            </a>            
            <a href="#" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-outline-main">
                <i class="ph ph-upload-simple me-2"></i> Import Excel
            </a>  
            <a href="#" data-bs-toggle="modal" data-bs-target="#importVideoModal" class="btn btn-outline-main">
                <i class="ph ph-upload-simple me-2"></i> Import Videos
            </a>           
            <a href="{{ route('admin.courses.create') }}" class="btn btn-main">
                <i class="ph ph-plus-circle me-2"></i> Add New Course
            </a>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <div class="card">
        <div class="card-body">

            {{ $dataTable->table() }}
        </div>
    </div>
</div>
<!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <form action="{{ route('admin.courses.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
          @csrf
          <div class="modal-header">
              <h5 class="modal-title" id="importModalLabel">Import Courses dari Excel</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
              @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              <div class="mb-3">
                  <label for="file" class="form-label">Upload file Excel (.xlsx, .xls)</label>
                  <input class="form-control" type="file" name="file" id="file" accept=".xlsx,.xls" required>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-main">Import</button>
          </div>
      </form>
    </div>
  </div>
  <!-- Modal Import Competitions -->
<div class="modal fade" id="importCompetitionModal" tabindex="-1" aria-labelledby="importCompetitionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.competitions.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="importCompetitionModalLabel">Import Competitions dari Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="mb-3">
                    <label for="file" class="form-label">Upload file Excel (.xlsx, .xls)</label>
                    <input class="form-control" type="file" name="file" id="file" accept=".xlsx,.xls" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-main">Import</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="importVideoModal" tabindex="-1" aria-labelledby="importVideoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.course.import-videos') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="importVideoModalLabel">Import Videos dari Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="mb-3">
                    <label for="file" class="form-label">Upload file Excel (.xlsx, .xls)</label>
                    <input class="form-control" type="file" name="file" id="file" accept=".xlsx,.xls" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-main">Import</button>
            </div>
        </form>
    </div>
</div>

  
@endsection

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush