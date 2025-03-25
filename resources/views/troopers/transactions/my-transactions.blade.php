@extends('layouts.master')

@section('content')
<div class="dashboard-body">
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li><a href="#" class="text-gray-200 fw-normal text-15 hover-text-main-600">Transactions</a></li>
            <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
            <li><span class="text-main-600 fw-normal text-15">My Transactions</span></li>
        </ul>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="mb-0">Pending Transactions</h4>
            <br>
            @if(session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="row g-20">
                @foreach ($transactions as $transaction)
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="card border border-gray-100">
                            <div class="card-body p-8">
                                <h5 class="mb-0">Order ID: {{ $transaction->order_id }}</h5>
                                <p>Amount: Rp. {{ number_format($transaction->amount) }}</p>
                                <p>Status: <span class="badge bg-warning">{{ ucfirst($transaction->payment_status) }}</span></p>

                                <div class="flex-between gap-4 flex-wrap mt-24">
                                    <a href="javascript:void(0)" class="btn btn-main rounded-pill py-9 retry-payment"
                                       data-order-id="{{ $transaction->order_id }}">Bayar Sekarang</a>
                                       <form action="{{ route('troopers.transaction.delete', $transaction->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-pill py-9">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ config('midtrans.base_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.querySelectorAll('.retry-payment').forEach(button => {
        button.addEventListener('click', function () {
            let orderId = this.getAttribute('data-order-id');

            fetch(`{{ url('/troopers/retry-payment/') }}/${orderId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    snap.pay(data.snapToken);
                } else {
                    alert('Payment error');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endpush
