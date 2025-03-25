<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> Sweettroops | Baking Studio Apps</title>
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
</head> 
<body>
    


<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

    @yield('content')

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
    <!-- apex charts -->
    <script src="/admin/assets/js/apexcharts.min.js"></script>
    <!-- Calendar Js -->
    <script src="/admin/assets/js/calendar.js"></script>
    <!-- jvectormap Js -->
    <script src="/admin/assets/js/jquery-jvectormap-2.0.5.min.js"></script>
    <!-- jvectormap world Js -->
    <script src="/admin/assets/js/jquery-jvectormap-world-mill-en.js"></script>
    
    <!-- main js -->
    <script src="/admin/assets/js/main.js"></script>
    @stack('js')

    </body>
</html>