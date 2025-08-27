@extends('layouts.main')

@section('content')
<div class="content-wrapper blank-page">
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
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover w-100']) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
