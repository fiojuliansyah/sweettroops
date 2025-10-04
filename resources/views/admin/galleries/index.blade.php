@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-wrapper">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Hands-On Class </h3>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus"></i> Add New Hands-On Class
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
