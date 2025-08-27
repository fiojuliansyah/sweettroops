<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CMS</title>
    <link rel="stylesheet" href="/frontadmin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/frontadmin/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/frontadmin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/frontadmin/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/frontadmin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/frontadmin/assets/vendors/flag-icon-css/css/flag-icons.min.css">
    <link rel="stylesheet" href="/frontadmin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/frontadmin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="/frontadmin/assets/css/style.css">
    <link rel="shortcut icon" href="/frontadmin/assets/images/favicon.png" />
    <script src=https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"></script>
    <script src=https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css"></script>
    @stack('css')
  </head>
  <body>
    <div class="container-scroller">
      @include('layouts.partials.admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('layouts.partials.admin.navbar')
        <div class="main-panel">
          @yield('content')

          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025 <a href="https://sweettroops.com/" target="_blank">SweetTroops</a>. All rights reserved.</span>
              <span class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center"> <span class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span> <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
        </div>
      </div>
    </div>
    <script src="/frontadmin/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/frontadmin/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="/frontadmin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="/frontadmin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="/frontadmin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/frontadmin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="/frontadmin/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="/frontadmin/assets/js/off-canvas.js"></script>
    <script src="/frontadmin/assets/js/misc.js"></script>
    <script src="/frontadmin/assets/js/settings.js"></script>
    <script src="/frontadmin/assets/js/todolist.js"></script>

    <script src="/frontadmin/assets/js/proBanner.js"></script>
    <script src="/frontadmin/assets/js/dashboard.js"></script>

    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>
    @stack('js')
  </body>
</html>