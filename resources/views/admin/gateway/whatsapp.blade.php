@extends('layouts.guest')

@section('content')
    <section class="sec-title">
        <div class="w-layout-blockcontainer w-container">
            <h1 class="heading-title">WhatsApp Gateway</h1>
        </div>
    </section>

    <section class="section-40">
        <div class="w-layout-blockcontainer container-38 w-container">
            {{-- Tombol Refresh Manual --}}
            <button id="btn-refresh" class="button-3 w-button">Refresh Status</button>
        </div>
    </section>

    <section class="section-39">
        <div class="w-layout-blockcontainer container-38 w-container">
            <div style="background: #fff; padding: 40px; border-radius: 8px; text-align: center; border: 1px solid #e1e1e1;">
                
                <div id="status-container">
                    @if($qr)
                        <div id="qr-area">
                            <h3 style="margin-bottom: 20px;">Scan QR Code</h3>
                            <div style="padding: 20px; border: 1px solid #eee; display: inline-block; background: #fff;">
                                <img id="qr-image" src="data:image/png;base64,{{ $qr }}" alt="QR Code" style="max-width: 250px;">
                            </div>
                            <p style="margin-top: 20px; color: #f39c12; font-weight: bold;">
                                <i class="fas fa-spinner fa-spin"></i> Menunggu Scan...
                            </p>
                        </div>
                    @else
                        <div id="connected-area">
                            <div style="font-size: 60px; color: #2ecc71; margin-bottom: 10px;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 style="color: #2ecc71;">Terhubung!</h3>
                            <p class="text-muted">{{ $message == 'device already connect' ? 'WhatsApp Anda sudah aktif.' : $message }}</p>
                        </div>
                    @endif
                </div>

                <p style="margin-top: 30px; font-size: 14px; color: #777;">
                    Buka WhatsApp di ponsel Anda > Ketuk Menu atau Pengaturan > Perangkat Tertaut.
                </p>
            </div>
        </div>
    </section>
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
                            <h3 style="margin-bottom: 20px;">Scan QR Code</h3>
                            <div style="padding: 20px; border: 1px solid #eee; display: inline-block; background: #fff;">
                                <img src="data:image/png;base64,${data.qr}" style="max-width: 250px;">
                            </div>
                            <p style="margin-top: 20px; color: #f39c12; font-weight: bold;">Menunggu Scan...</p>
                        </div>
                    `);
                } else if (data.message === "device already connect") {
                    $('#status-container').html(`
                        <div id="connected-area">
                            <div style="font-size: 60px; color: #2ecc71; margin-bottom: 10px;">✔</div>
                            <h3 style="color: #2ecc71;">Terhubung!</h3>
                            <p>WhatsApp Anda sudah aktif.</p>
                        </div>
                    `);
                }
            }
        });
    }

    // Auto check setiap 15 detik
    setInterval(checkStatus, 15000);

    // Refresh manual
    $('#btn-refresh').click(function(e) {
        e.preventDefault();
        $(this).text('Checking...');
        checkStatus();
        setTimeout(() => $(this).text('Refresh Status'), 1000);
    });
</script>
@endpush