@extends('layouts.guest')

@section('content')
<div id="content" class="col-md-10 split">
    <div id="home" class="content-wrapper">
       <!-- Parallax Slider -->
       <div id="slider" class="parallax-slider" style="width:1200px;margin:0 auto;margin-bottom: 0px;">
          @foreach ($sliders as $slider)  
            <div class="ls-slide" data-ls="duration:6000; transition2d:7; kenburnszoom:out; kenburnsscale:1.2;">
               <!-- background image  -->
               <img src="{{ asset('storage/' . $slider->image) }}" class="ls-bg" alt="" />
               <!-- text  -->
               <div class="ls-l header-wrapper" data-ls="offsetyin:150; durationin:700; delayin:200; easingin:easeOutQuint; rotatexin:20; scalexin:1.4; offsetyout:600; durationout:400;">
                  <div class="header-text">
                     <h1>{{ $slider->title }}</h1>
                     <p class="header-p">{{ $slider->subtitle }}</p>
                     <div class="hidden-small">
                        <a class="btn btn-primary" href="{{ $slider->link }}">Lihat Menu</a>
                     </div>
                     <!--/hidden-small -->
                  </div>
                  <!-- header-text  -->
               </div>
               <!-- ls-l  -->
            </div>
          @endforeach
       </div>
       <!-- /slider -->
       <!--divider-home -->
       <div class="divider-top divider-home" ></div>
       <!-- /divider-home -->
       <!-- ===== content-box starts  ===== -->
       <div id="about" class="content-box container">
          <section class="inside-page">
             <div class="inside-wrapper container">
               <div class="col-md-12">
                  <h2 class="text-center-sm">Kelas Berbasis Cinta</h2>
                  <img class="img-responsive img-rounded pull-right-lg col-md-4 center-block" src="img/services/services-home.jpg" alt="">
                  <p class="lead res-margin">Kami telah menawarkan kelas baking berkualitas tinggi. Setiap kelas dirancang dengan penuh cinta untuk membantu Anda menguasai keterampilan praktis yang akan membawa Anda ke level berikutnya dalam dunia baking.</p>
                  <p>Di SweetTroops Baking Studio, kami percaya bahwa proses belajar harus menyenangkan dan menginspirasi. Kami tidak hanya mengajarkan resep, tetapi juga memberi Anda keterampilan yang akan Anda gunakan sepanjang hidup. Dengan instruktur berpengalaman dan bahan berkualitas tinggi, kami menciptakan pengalaman belajar yang tak terlupakan.</p>
                  <p>Apakah Anda seorang pemula atau ingin meningkatkan keterampilan baking Anda, kelas kami dirancang untuk memberikan pengalaman langsung yang menyenangkan dan edukatif. Bergabunglah dengan kami dan temukan kecintaan Anda pada dunia baking sambil mengembangkan keahlian praktis di setiap langkahnya.</p>
               </div>               
                <!-- owl-carousel -->
                <div id="owl-services" class="owl-carousel owl-theme text-center res-margin">
                   <!-- service 1  -->
                   @foreach ($categories as $category)  
                     <div class="col-lg-12 p-1">
                        <div class="box-hover icon p-3">
                           <!-- service icon -->
                          <img src="{{ asset('storage/' . $category->image) }}" alt="" width="30%">
                           <!-- service content -->
                           <div class="service-content">
                              <h5>{{ $category->name }}</h5>
                           </div>
                        </div>
                     </div>
                   @endforeach
                </div>
                <!-- /owl-carousel -->
             </div>
          </section>
          <div class="bg-light">
            <section id="why" class="inside-page">
               <div class="inside-wrapper container">
                  <div class="col-md-12">
                     <!-- Tabs -->
                     <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#A">Kenapa Memilih Kelas Kami?</a></li>
                        <li><a data-toggle="tab" href="#B">Filosofi Pengajaran</a></li>
                        <li><a data-toggle="tab" href="#C">Kualitas Pengajaran</a></li>
                     </ul>
                     <!-- /nav-tabs -->
                     <!--/nav nav-tabs -->
                     <div class="tabbable">
                        <div class="tab-content">
                           <div class="tab-pane active in fade" id="A">
                              <div class="col-md-5 p-2">
                                 <img class="img-responsive img-rounded center-block" src="img/tab1.jpg" alt="">
                              </div>
                              <h3 class="text-center-sm">Kenapa Memilih Kelas Kami?</h3>
                              <p>Kelas baking kami didesain untuk memberikan pengalaman langsung dalam membuat kue yang lezat dan berkualitas. Kami menawarkan kursus yang mudah diikuti, baik untuk pemula maupun profesional. Dengan pengajaran dari instruktur berpengalaman, Anda akan menguasai teknik-teknik dasar hingga tingkat lanjut.</p>
                              <p><strong>Kami percaya bahwa setiap orang bisa menjadi ahli dalam membuat kue dengan latihan yang tepat dan bahan yang berkualitas.</strong></p>
                              <p>Apakah Anda ingin belajar cara membuat kue-kue khas atau menciptakan kreasi kue unik Anda sendiri? Kami siap membantu Anda mencapai tujuan tersebut dalam kelas praktis yang menyenangkan dan bermanfaat.</p>
                           </div>
                           <!-- /tab-pane -->
                           <div class="tab-pane fade" id="B">
                              <h3 class="text-center-sm">Filosofi Pengajaran</h3>
                              <div class="col-md-4 p-2 pull-right-lg">
                                 <img class="img-responsive img-rounded center-block" src="img/tab2.jpg" alt="">
                              </div>
                              <p>Di SweetTroops Baking Studio, kami memprioritaskan pendekatan pembelajaran yang menyenangkan dan penuh kreativitas. Filosofi kami adalah menggabungkan teknik-teknik tradisional dengan inovasi terkini dalam dunia baking. Setiap peserta akan diajarkan tidak hanya cara membuat kue, tetapi juga bagaimana mengekspresikan diri melalui kreasi makanan.</p>
                              <p><strong>Belajar bersama kami adalah tentang mengembangkan passion dan keterampilan dalam membuat kue yang luar biasa.</strong></p>
                              <ul class="custom pl-0">
                                 <li>Pengajaran yang praktis dengan fokus pada keterampilan langsung</li>
                                 <li>Kelas yang dirancang untuk memenuhi kebutuhan semua tingkat kemampuan</li>
                                 <li>Instruktur berpengalaman yang siap berbagi pengetahuan dan tips</li>
                              </ul>
                           </div>
                           <!-- /tab-pane -->
                           <div class="tab-pane fade" id="C">
                              <h3 class="text-center-sm">Kualitas Pengajaran</h3>
                              <p>Kami memastikan setiap kelas yang kami tawarkan memiliki standar tinggi dalam pengajaran dan pengalaman belajar. Dengan instruktur yang berpengalaman dan berpengetahuan luas, kami memberikan pelatihan yang sangat praktis dan mudah dipahami. Semua peserta akan mendapat perhatian penuh untuk mengasah keterampilan mereka.</p>
                              <p><strong>Di SweetTroops, kualitas pengajaran adalah prioritas kami agar setiap peserta dapat belajar dengan percaya diri dan hasil yang maksimal.</strong></p>
                              <p>Dengan pendekatan hands-on, setiap peserta akan langsung terlibat dalam setiap langkah pembuatan kue, memastikan pemahaman yang mendalam dan keterampilan yang terasah dengan baik.</p>
                           </div>
                           <!-- /tab-pane -->
                        </div>
                        <!-- /tab-content -->
                     </div>
                     <!-- /tabbable -->
                  </div>
                  <!-- /col-md-12 -->
               </div>
               <!-- /inside-wrapper-->
            </section>
         </div>
         
          <!-- /bg-light -->
          <section id="class" class="inside-page">
             <div class="inside-wrapper container">
                <h2 class="text-center-sm">Kelas Terbaru</h2>
                <div id="owl-posts" class="col-md-12 owl-carousel">
                  @foreach ($courses as $course) 
                     <div class="col-md-12 p-1">
                        <div class="post-slide box-hover">
                           <div class="post-img">
                              <a href="blog-single.html">
                                 <!-- Image -->
                                 <img class="img-responsive" src="{{ asset('storage/' . $course->thumbnail) }}" alt="">
                                 <!--date -->
                                 <div class="post-date">
                                    <span class="date">{{ $course->created_at->format('d') }}</span>
                                    <span class="month">{{ $course->created_at->format('M') }}</span>
                                 </div>
                              </a>
                           </div>
                           <!-- post info -->
                           <div class="post-review">
                              <h5 class="post-title"><a href="{{ route('troopers.detail-course', $course->slug) }}">{{ $course->title }}</a></h5>
                              <ul class="post-bar">
                                 <li><i class="fa fa-user"></i><a href="#">{{ $course->instructor }}</a></li>
                              </ul>
                              <p class="post-description">{{ $course->description }}</p>
                              <!-- button -->
                              <a class="btn btn-primary btn-md" href="{{ route('troopers.detail-course', $course->slug) }}">Baca Selengkapnya</a>
                           </div>
                           <!--/post-review -->
                        </div>
                        <!--/post-slide -->
                     </div>
                  @endforeach
                </div>
                <!-- alert box -->
                <div class="alert-bg alert alert-info col-md-12 margin1">
                     <h5>Tertarik Mengikuti Kelas Baru?</h5>
                     <p>Apakah Anda ingin belajar langsung dari ahli di bidangnya? Kami menawarkan berbagai kelas membuat kue yang bisa diikuti secara langsung atau online, sesuai dengan kebutuhan Anda.</p>
                     <p>Jangan ragu untuk menghubungi kami untuk informasi lebih lanjut dan untuk memesan kelas sesuai preferensi Anda.</p>
                     <!-- button -->
                     <a class="btn btn-secondary" href="#">Hubungi Kami</a>
                  </div>               
                <!-- /alert -->   
             </div>
             <!-- /inside-wrapper -->
          </section>
          <!-- footer -->
          <section id="faq" class="inside-page">
            <div class="inside-wrapper container">
               <!-- row -->
               <div class="row ">
                  <div class="col-md-5">
                     <h4 class="no-margin-top">Pertanyaan yang Sering Diajukan tentang Kelas</h4>
                     <p>Berikut adalah beberapa pertanyaan yang sering kami terima terkait dengan kelas baking kami. Jika Anda memiliki pertanyaan lain, jangan ragu untuk menghubungi kami. Kami siap membantu Anda dengan semua kebutuhan terkait kursus dan pelatihan kami!</p>
                  </div>
                  <div class="col-md-7">
                     <!-- Accordions -->
                     <div class="panel-group" id="accordion">
                        <!-- Question 1 -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h6 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">Apakah SweetTroops menawarkan kelas baking online?</a>
                              </h6>
                           </div>
                           <!-- /panel-heading -->
                           <div id="collapse1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                 <p>Ya, kami menawarkan kelas baking online bagi Anda yang ingin belajar di rumah. Anda bisa mengikuti kursus ini dari mana saja dengan instruksi langsung dari instruktur kami yang berpengalaman.</p>
                              </div>
                           </div>
                        </div>
                        <!--/panel -->
                        <!-- Question 2 -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h6 class="panel-title">
                                 <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2">Bagaimana cara mendaftar untuk kelas baking di SweetTroops?</a>
                              </h6>
                           </div>
                           <!-- /panel-heading -->
                           <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <p>Anda dapat mendaftar untuk kelas baking kami langsung melalui situs web kami. Cukup pilih kelas yang Anda inginkan, pilih jadwal yang sesuai, dan lakukan pembayaran untuk mengamankan tempat Anda.</p>
                              </div>
                           </div>
                        </div>
                        <!--/panel -->
                        <!-- Question 3 -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h6 class="panel-title">
                                 <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">Apakah ada kelas untuk pemula?</a>
                              </h6>
                           </div>
                           <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <p>Ya, kami menawarkan kelas untuk pemula yang ingin belajar dasar-dasar baking. Instruktur kami akan memandu Anda langkah demi langkah dalam membuat kue dan hidangan lainnya dengan mudah.</p>
                              </div>
                           </div>
                        </div>
                        <!--/panel -->
                     </div>
                     <!-- /.accordion -->		
                  </div>
                  <!-- /col-md- -->		
               </div>
               <!-- /row -->		
            </div>
          </section>

          <section id="contact" class="inside-page">
            <div class="inside-wrapper container">
               <h2>Get in Touch with us</h2>
               <p> Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules, Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.                        </p>
               <p>Aliquam erat volutpat In id fermentum augue, ut pellentesque leo. Maecenas at arcu risus. Donec commodo sodales ex, scelerisque laoreet nibh hendrerit id. In aliquet magna nec lobortis maximus. Etiam rhoncus leo a dolor placerat, nec elementum ipsum convall.</p>
               <div class="row contact-boxes text-center margin1">
                  <div class="col-md-3">
                     <div class="box-hover icon p-2">
                        <!---icon-->
                        <i class="fa fa-envelope small-icon"></i>
                        <!-- contact-icon info-->
                        <div class="contact-icon-info">
                           <h5>Email</h5>
                           <p>Email address: <a href="mailto:info@sweettroops.com">info@sweettroops.com</a></p>
                        </div>
                     </div>
                  </div>
                  <!-- /contact-icon-->
                  <div class="col-md-3 res-margin">
                     <div class="box-hover icon p-2">
                        <!---icon-->
                        <i class="fa fa-clock small-icon"></i>
                        <!-- contact-icon info-->
                        <div class="contact-icon-info">
                           <h5>Hours</h5>
                           <p>mon - fri: 9am to 6pm
                              <br/>Weekends - closed
                           </p>
                        </div>
                     </div>
                  </div>
                  <!-- /contact-icon-->
                  <div class="col-md-3 res-margin">
                     <div class="box-hover icon p-2">
                        <!---icon-->
                        <i class="fa fa-map-marker small-icon"></i>
                        <!-- contact-icon info-->
                        <div class="contact-icon-info">
                           <h5>Our Location</h5>
                           <p>Jakarta, Indonesia</p>
                        </div>
                     </div>
                  </div>
                  <!-- /contact-icon-->
                  <div class="col-md-3 res-margin">
                     <div class="box-hover icon p-2">
                        <!---icon-->
                        <i class="fa fa-phone small-icon"></i>
                        <!-- contact-icon info -->
                        <div class="contact-icon-info">
                           <h5>Call us</h5>
                           <p>Phone number: <br/>(+62) 8 5311 2323 77</p>
                        </div>
                     </div>
                     <!-- /contact-icon-->
                  </div>
                  <!-- /col-md-4-->
               </div>
               <!-- /row contact-boxes-->
               <div class="row margin1" >
                  <div class="col-md-7">
                     <!-- contact info -->
                     <div class="contact-info">
                        <h4 class="title no-margin-top">Write us a Message</h4>
                        <!-- Form Starts -->
                        <div id="contact_form">
                           <div class="form-group">
                              <!-- row -->
                              <div class="row">
                                 <div class="col-md-6">
                                    <label>Name<span class="required">*</span></label>
                                    <input type="text" name="name" class="form-control input-field" required=""> 
                                 </div>
                                 <div class="col-md-6">
                                    <label>Email Adress <span class="required">*</span></label>
                                    <input type="email" name="email" class="form-control input-field" required=""> 
                                 </div>
                              </div>
                              <!-- /row -->
                              <!-- row -->
                              <div class="row">
                                 <div class="col-md-12">
                                    <label>Subject</label>
                                    <input type="text" name="subject" class="form-control input-field"> 
                                 </div>
                                 <div class="col-md-12">
                                    <label>Message<span class="required">*</span></label>
                                    <textarea name="message" id="message" class="textarea-field form-control" rows="3"  required=""></textarea>
                                 </div>
                              </div>
                              <!-- /row -->
                              <button type="submit" id="submit_btn" value="Submit" class="btn btn-primary">Send message</button>
                           </div>
                           <!-- Contact results -->
                           <div id="contact_results"></div>
                        </div>
                        <!-- /contact-form -->
                     </div>
                     <!-- /contact-info -->
                  </div>
                  <!-- /col-md- -->
                  <div class="col-md-5">
                     <!-- map-->
                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.242063543142!2d106.78583197499047!3d-6.231786793756394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1397d42093b%3A0xf898bb99eb1b70f5!2sSweet%20Troops%20Artisan%20Baking%20Studio!5e0!3m2!1sen!2sid!4v1742887700976!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                  <!-- /col-md--->
               </div>
               <!-- /row-->
            </div>
            <!-- /inside-wrapper-->
         </section>
         
         
         
          <footer class="footer">
             <!-- image gradient overlay-->
             <div class="gradient-overlay top-to-bottom"></div>
             <div class="inside-wrapper container">
                <div class="col-md-3 col-md-offset-3">
                   <div class="brand-footer">
                      <a href="index.html">
                      <img src="/pages/assets/img/logo.png" alt="" class="img-responsive center-block" width="60%">
                      </a>
                   </div>
                </div>
                <div class="col-md-4 margin-footer text-center-sm">
                   <!-- Logo -->
                   <p><i class="fas fa-map-marker-alt margin-icon"></i>Jakarta, Indonesia</p>
                   <p><i class="fas fa-phone margin-icon"></i>(+62) 8 5311 2323 77</p>
                   <p><i class="far fa-clock margin-icon"></i>Senin-Sabtu: 9 pagi-5 sore</p>
                   <!--Social icons -->
                   <div class="social-media ">
                      <a href="#" title=""><i class="fas fa-envelope"></i></a>
                      <a href="#" title=""><i class="fab fa-twitter"></i></a>
                      <a href="#" title=""><i class="fab fa-facebook"></i></a>
                      <a href="https://www.instagram.com/sweettroops_bakingstudio/?hl=en" title=""><i class="fab fa-instagram"></i></a>
                   </div>
                   <!-- /brand -->
                </div>
                <div class="col-md-12 text-center">
                   <p class="copy">Copyright 2025 <a href="#">SweetTroops</a></p>
                </div>
                <!--/ footer-->
             </div>
             <!-- / inside-wrapper -->
             <!-- Go To Top Link -->
             <div class="page-scroll">
                <a href="#top" class="back-to-top"><i class="fa fa-angle-up"></i></a>
             </div>
             <!--/page-scroll-->
          </footer>
          <!-- / footer-->
       </div>
       <!-- / content-box -->
    </div>
    <!-- /content-wrapper -->
 </div>
@endsection
