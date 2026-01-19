@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body text-center">
            <h4 class="card-title">Scan QR Code</h4>
            
            <div id="status-container" class="mt-4">
                @if($qr)
                    <div id="qr-area">
                        <img id="qr-image" src="data:image/png;base64,{{ $qr }}" style="max-width: 300px;">
                        <p class="mt-3 text-warning">Status: Menunggu Scan...</p>
                    </div>
                @else
                    <div id="connected-area">
                        <i class="mdi mdi-check-circle text-success" style="font-size: 50px;"></i>
                        <p class="text-success">{{ $message }}</p>
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <button id="btn-refresh" class="btn btn-primary">Refresh Manual</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function checkStatus() {
        $.ajax({
            url: "{{ route('admin.gateway.whatsapp') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.status === true && data.qr) {
                    $('#status-container').html(`
                        <div id="qr-area">
                            <img src="data:image/png;base64,${data.qr}" style="max-width: 300px;">
                            <p class="mt-3 text-warning">Status: Menunggu Scan...</p>
                        </div>
                    `);
                } else if (data.message === "device already connect") {
                    $('#status-container').html(`
                        <div id="connected-area">
                            <i class="mdi mdi-check-circle text-success" style="font-size: 50px;"></i>
                            <p class="text-success">Device Anda sudah terhubung!</p>
                        </div>
                    `);
                }
            }
        });
    }

    setInterval(checkStatus, 10000);

    $('#btn-refresh').click(function() {
        $(this).text('Checking...');
        checkStatus();
        setTimeout(() => $(this).text('Refresh Manual'), 1000);
    });
</script>
@endpush