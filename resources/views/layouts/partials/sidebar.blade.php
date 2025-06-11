<div id="sidebar" class="split col-md-2">
    <div class="affix-sidebar col-md-12">
       <div class="sidebar-nav">
          <div class="navbar navbar-default" role="navigation">
             <div class="navbar-header">
                <!-- collapse button -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <!-- Logo -->
                <div class="brand">
                   <a href="/">
                   <img src="/pages/assets/img/logo.png" alt="" class="img-responsive center-block" >
                   </a>
                </div>
                <!-- /brand -->
             </div>
             <!-- /navbar-header  -->
             <div class="navbar-collapse collapse sidebar-navbar-collapse ">
                <ul class="nav navbar-nav" id="sidenav01">
                   <li><a href="#home">Home</a></li>
                   <li><a href="#about">Tentang</a></li>
                   <li><a href="#why">Kenapa Pilih Kami?</a></li>
                   <li><a href="#class">Kelas Terbaru</a></li>
                   <li><a href="#faq">FAQ</a></li>
                   <li><a href="#contact">Kontak</a></li>
                   <a class="btn btn-secondary" href="{{ route('login-phone') }}">Login</a>
                </ul>
                <!-- navbar-nav -->
             </div>
             <!--/.nav-collapse -->
          </div>
          <!--/navbar -->
       </div>
       <!--/sidebar-nav -->
       <div class="navbar-info hidden-sm hidden-xs hidden-md">
          <p class="small-text"><i class="fas fa-map-marker-alt margin-icon"></i>{{ $homepage->location }}</p>
          <p class="small-text"><i class="fas fa-phone margin-icon"></i>{{ $homepage->phone }}</p>
          <p class="small-text"><i class="far fa-clock margin-icon"></i>{{ $homepage->hours }}</p>
          <!--Social icons -->
          <div class="social-media ">
             <a href="#" title=""><i class="fas fa-envelope"></i></a>
             <a href="#" title=""><i class="fab fa-twitter"></i></a>
             <a href="#" title=""><i class="fab fa-facebook"></i></a>
             <a href="#" title=""><i class="fab fa-instagram"></i></a>
          </div>
       </div>
       <!-- /navbar-info -->
    </div>
    <!-- /affix-sidebar  -->
 </div>