@extends('layouts.guest')

@section('content')
  <section class="sec-title">
    <div class="w-layout-blockcontainer w-container">
      <h1 class="heading-title">Transactions Lists</h1>
    </div>
  </section>
  <section class="section-39">
    <div class="w-layout-blockcontainer container-38 w-container">
      {{ $dataTable->table() }}
    </div>
  </section>
@endsection

@push('js')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush