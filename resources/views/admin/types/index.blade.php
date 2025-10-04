@extends('layouts.main')

@section('content')
<div class="content-wrapper blank-page">
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title"> Course Type </h3>
        </div>
        <a href="{{ route('admin.types.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus"></i> Add Course Type
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>

</div>
@endsection

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
