<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- page title -->
      <title>SweetTroops | Baking Studio Web App</title>
      <!--[if lt IE 9]>
      <script src="/pages/assets/js/respond.js"></script>
      <![endif]-->
      <!-- Font files -->
      <link href="https://fonts.googleapis.com/css?family=Satisfy:400,400i,700,700i%7CNunito:300,400,700" rel="stylesheet">
      <link href="/pages/assets/fonts/flaticon/flaticon.css" rel="stylesheet" type="text/css">
      <link href="/pages/assets/fonts/fontawesome/fontawesome-all.min.css" rel="stylesheet" type="text/css">
      <!-- Favicons-->
      <link rel="apple-touch-icon" sizes="72x72" href="/pages/assets/img/logo.png">
      <link rel="apple-touch-icon" sizes="114x114" href="/pages/assets/img/logo.png">
      <link rel="shortcut icon" href="/pages/assets/img/logo.png" type="image/x-icon">
      <!-- Bootstrap core CSS -->
      <link href="/pages/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- style CSS -->
      <link href="/pages/assets/css/style.css" rel="stylesheet">
      <!-- plugins CSS -->
      <link href="/pages/assets/css/plugins.css" rel="stylesheet">
      <!-- Colors CSS -->
      <link href="/pages/assets/styles/maincolors.css" rel="stylesheet">
      <!-- LayerSlider CSS -->
      <link rel="stylesheet" href="/pages/assets/vendor/layerslider/css/layerslider.css">
      <!-- Prefix free -->
      <script src="/pages/assets/js/prefixfree.min.js"></script>
	</head>
   <!-- ==== body starts ==== -->
   <body id="top">
     <!-- Preloader -->
      <div id="preloader">
         <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
         </div>
      </div>
      <!-- ===== Page Content ===== -->
      <div class="container-fluid">
         <!-- ===== Sidebar starts ===== -->
         @include('layouts.partials.sidebar')
         <!-- ===== / sidebar ends ===== -->
		 <!-- ===== content starts  ===== -->
         @yield('content')
         <!-- /content -->
      </div>
      <!-- /container-fluid -->
      <!-- Bootstrap core & Jquery -->
      <script src="/pages/assets/vendor/jquery/jquery.min.js"></script>
      <script src="/pages/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
      <!-- Custom Js -->
      <script src="/pages/assets/js/custom.js"></script>
      <script src="/pages/assets/js/plugins.js"></script>
      <!-- number counter script -->
      <script src="/pages/assets/js/counter.js"></script>
      <!-- GreenSock -->
      <script src="/pages/assets/vendor/layerslider/js/greensock.js"></script>
      <!-- LayerSlider script files -->
      <script src="/pages/assets/vendor/layerslider/js/layerslider.transitions.js"></script>
      <script src="/pages/assets/vendor/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
      <script src="/pages/assets/vendor/layerslider/js/layerslider.load.js"></script>
   </body>
</html>