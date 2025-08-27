@extends('layouts.main')

@section('content')
<div class="content-wrapper blank-page">
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Courses </h3>
            <div class="d-flex gap-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#importCompetitionModal" class="btn btn-info">
                    <i class="mdi mdi-upload"></i> Import Competitions
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#importModal" class="btn btn-info">
                    <i class="mdi mdi-upload"></i> Import Excel
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#importVideoModal" class="btn btn-info">
                    <i class="mdi mdi-upload"></i> Import Videos
                </a>
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus"></i> Add New Course
                </a>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
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

<!-- Modal Import Videos -->
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

@push('css')
<style>
.dataTables_wrapper {
    overflow-x: auto;
}
</style>
@endpush

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
