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
                        <a class="btn btn-primary" href="{{ $slider->link }}">Lihat Detail</a>
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
                  <h2 class="text-center-sm">{{ $homepage->title }}</h2>
                  <img class="img-responsive img-rounded pull-right-lg col-md-4 center-block" src="img/services/services-home.jpg" alt="">
                  <p class="lead res-margin">{{ $homepage->sub_title }}</p>
                  <p>{{ $homepage->detail }}</p>
               </div>               
                <!-- owl-carousel -->
                <div id="owl-services" class="owl-carousel owl-theme text-center res-margin">
                   <!-- service 1  -->
                  @foreach ($categories as $category)  
                     <div class="col-lg-12 p-1">
                        <div class="box-hover icon p-3">
                              <img src="{{ asset('storage/' . $category->image) }}" alt="" width="30%">
                              <div class="service-content">
                                 {{-- Link to courses based on category slug --}}
                                 <a href="{{ route('courses.byCategory', $category->slug) }}">
                                    <h5>{{ $category->name }}</h5>
                                 </a>
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
                        <li class="active"><a data-toggle="tab" href="#A">{{ $homepage->tab_1 }}</a></li>
                        <li><a data-toggle="tab" href="#B">{{ $homepage->tab_2 }}</a></li>
                        <li><a data-toggle="tab" href="#C">{{ $homepage->tab_3 }}</a></li>
                     </ul>
                     <!-- /nav-tabs -->
                     <!--/nav nav-tabs -->
                     <div class="tabbable">
                        <div class="tab-content">
                           <div class="tab-pane active in fade" id="A">
                              <div class="col-md-5 p-2">
                                 <img class="img-responsive img-rounded center-block" src="img/tab1.jpg" alt="">
                              </div>
                              <h3 class="text-center-sm">{{ $homepage->title_tab_1 }}</h3>
                              <p>{{ $homepage->detail_tab_1 }}</p>
                           </div>
                           <!-- /tab-pane -->
                           <div class="tab-pane fade" id="B">
                              <h3 class="text-center-sm">{{ $homepage->title_tab_2 }}</h3>
                              <div class="col-md-4 p-2 pull-right-lg">
                                 <img class="img-responsive img-rounded center-block" src="img/tab2.jpg" alt="">
                              </div>
                              <p>{{ $homepage->detail_tab_2 }}</p>
                           </div>
                           <!-- /tab-pane -->
                           <div class="tab-pane fade" id="C">
                              <h3 class="text-center-sm">{{ $homepage->title_tab_3 }}</h3>
                              <p>{{ $homepage->detail_tab_3 }}</p>
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
                                 @php
                                       $thumbnails = json_decode($course->thumbnail, true);
                                       $firstThumbnail = isset($thumbnails[0]) ? $thumbnails[0] : 'default-thumbnail.jpg';
                                 @endphp
                                 <img class="img-responsive" src="{{ asset('storage/' . $firstThumbnail) }}" alt="">
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
                              <p class="post-description">{!! \Illuminate\Support\Str::limit($course->description, 100) !!} ...</p>
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
                     <h5><p>{{ $homepage->section_title }}</p></h5>
                     <p>{{ $homepage->section_detail }}</p>
                     <!-- button -->
                     <a class="btn btn-secondary" href="{{ $homepage->section_link }}">{{ $homepage->section_button }}</a>
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
                     <h4 class="no-margin-top">{{ $homepage->accord_title }}</h4>
                     <p>{{ $homepage->accord_detail }}</p>
                  </div>
                  <div class="col-md-7">
                     <!-- Accordions -->
                     <div class="panel-group" id="accordion">
                        <!-- Question 1 -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h6 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">{{ $homepage->accord_tab_1 }}</a>
                              </h6>
                           </div>
                           <!-- /panel-heading -->
                           <div id="collapse1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                 <p>{{ $homepage->accord_detail_tab_1 }}</p>
                              </div>
                           </div>
                        </div>
                        <!--/panel -->
                        <!-- Question 2 -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h6 class="panel-title">
                                 <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2">{{ $homepage->accord_tab_2 }}</a>
                              </h6>
                           </div>
                           <!-- /panel-heading -->
                           <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <p>{{ $homepage->accord_detail_tab_2 }}</p>
                              </div>
                           </div>
                        </div>
                        <!--/panel -->
                        <!-- Question 3 -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h6 class="panel-title">
                                 <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">{{ $homepage->accord_tab_3 }}</a>
                              </h6>
                           </div>
                           <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <p>{{ $homepage->accord_detail_tab_3 }}</p>
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
               <h2>{{ $homepage->contact_title }}</h2>
               <p>{{ $homepage->contact_detail }}</p>
               <div class="row contact-boxes text-center margin1">
                  <div class="col-md-3">
                     <div class="box-hover icon p-2">
                        <!---icon-->
                        <i class="fa fa-envelope small-icon"></i>
                        <!-- contact-icon info-->
                        <div class="contact-icon-info">
                           <h5>Email</h5>
                           <p>Email address: <a href="mailto:{{ $homepage->email }}">{{ $homepage->email }}</a></p>
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
                           <p>{{ $homepage->hours }}</p>
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
                           <p>{{ $homepage->location }}</p>
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
                           <p>Phone number: <br/>{{ $homepage->phone }}</p>
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
                     {!! $homepage->map_url !!}
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
                   <p><i class="fas fa-map-marker-alt margin-icon"></i>{{ $homepage->location }}</p>
                   <p><i class="fas fa-phone margin-icon"></i>{{ $homepage->phone }}</p>
                   <p><i class="far fa-clock margin-icon"></i>{{ $homepage->hours }}</p>
                   <p><a href="{{ route('privacy.policy') }}">Privacy Policy</a> | <a href="{{ route('terms') }}">Terms</a></p>
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
