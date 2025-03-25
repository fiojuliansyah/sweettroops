<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ $title ?? 'Dashboard' }} | SweetTroops Baking Studio</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/admin/assets/images/logo/favicon.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/admin/assets/css/bootstrap.min.css">
    <!-- file upload -->
    <link rel="stylesheet" href="/admin/assets/css/file-upload.css">
    <!-- file upload -->
    <link rel="stylesheet" href="/admin/assets/css/plyr.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- full calendar -->
    <link rel="stylesheet" href="/admin/assets/css/full-calendar.css">
    <!-- jquery Ui -->
    <link rel="stylesheet" href="/admin/assets/css/jquery-ui.css">
    <!-- editor quill Ui -->
    <link rel="stylesheet" href="/admin/assets/css/editor-quill.css">
    <!-- apex charts Css -->
    <link rel="stylesheet" href="/admin/assets/css/apexcharts.css">
    <!-- calendar Css -->
    <link rel="stylesheet" href="/admin/assets/css/calendar.css">
    <!-- jvector map Css -->
    <link rel="stylesheet" href="/admin/assets/css/jquery-jvectormap-2.0.5.css">
    <!-- Main css -->
    <link rel="stylesheet" href="/admin/assets/css/main.css">
    <script src=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"></script>
    <script src=https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css"></script>
    @stack('css')
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ============================ Sidebar Start ============================ -->

    @include('layouts.partials.aside')
    <!-- ============================ Sidebar End  ============================ -->

    <div class="dashboard-main-wrapper">

        @include('layouts.partials.top-navbar')

        @if(session('success'))
        <div id="success-alert" style="position: fixed; top: 20px; right: 20px; min-width: 300px; background-color: #198754; color: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999; overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 15px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <strong><i class="ph ph-check-circle" style="margin-right: 8px;"></i> Success</strong>
                <button type="button" onclick="document.getElementById('success-alert').style.display='none';" style="background: transparent; border: none; color: white; font-size: 18px; cursor: pointer; padding: 0;">×</button>
            </div>
            <div style="padding: 12px 15px;">
                {{ session('success') }}
            </div>
        </div>

        <script>
            // Auto-hide after 5 seconds
            setTimeout(function() {
                var alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);
        </script>
        @endif

        @if(session('error'))
        <div id="error-alert" style="position: fixed; top: 20px; right: 20px; min-width: 300px; background-color: #dc3545; color: white; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 9999; overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 15px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <strong><i class="ph ph-x-circle" style="margin-right: 8px;"></i> Error</strong>
                <button type="button" onclick="document.getElementById('error-alert').style.display='none';" style="background: transparent; border: none; color: white; font-size: 18px; cursor: pointer; padding: 0;">×</button>
            </div>
            <div style="padding: 12px 15px;">
                {{ session('error') }}
            </div>
        </div>

        <script>
            // Auto-hide after 5 seconds
            setTimeout(function() {
                var alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.display = 'none';
                }
            }, 5000);
        </script>
        @endif

        
        @yield('content')

        @include('layouts.partials.footer')
        
        
    </div>

    <!-- Jquery js -->
    <script src="/admin/assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="/admin/assets/js/boostrap.bundle.min.js"></script>
    <!-- Phosphor Js -->
    <script src="/admin/assets/js/phosphor-icon.js"></script>
    <!-- file upload -->
    <script src="/admin/assets/js/file-upload.js"></script>
    <!-- file upload -->
    <script src="/admin/assets/js/plyr.js"></script>
    <!-- dataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- full calendar -->
    <script src="/admin/assets/js/full-calendar.js"></script>
    <!-- jQuery UI -->
    <script src="/admin/assets/js/jquery-ui.js"></script>
    <!-- jQuery UI -->
    <script src="/admin/assets/js/editor-quill.js"></script>
    <script src="/admin/assets/js/jquery-jvectormap-2.0.5.min.js"></script>
    <!-- jvectormap world Js -->
    <script src="/admin/assets/js/jquery-jvectormap-world-mill-en.js"></script>

    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

    <!-- main js -->
    <script src="/admin/assets/js/main.js"></script>

    @stack('js')



</body>

</html>
