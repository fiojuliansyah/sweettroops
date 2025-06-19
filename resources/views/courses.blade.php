@extends('layouts.guest')

@section('content')
<div id="content" class="col-md-10 split">
            <!--content-wrapper  -->
            <div class="content-wrapper">
               <!--divider-top  -->
               <div class="divider-top">
                  <!--header-info  -->
                  <div class="header-info col-md-12">
                     <!--inside-wrapper  -->
                     <div class="inside-wrapper container">
                        <!-- Heading -->
                        <h1>Our Course</h1>
                        <!-- Breadcrumb -->
                        <ul class="breadcrumb">
                           <li><a href="/">Home</a></li>
                           <li class="active">Our Course</li>
                        </ul>
                        <!--/Breadcrumb -->
                     </div>
                     <!--/inside-wrapper  -->
                  </div>
                  <!--/header-info  -->
                  <!-- image gradient overlay-->
                  <div class="gradient-overlay"></div>
               </div>
               <!-- /divider-top -->
               <div class="content-box container">
                  <!-- ===== section starts  ===== -->
                  <section class="inside-page">
                     <div class="inside-wrapper container">
                        <h2>{{ $category->name }}</h2>
                        <div class="col-lg-9">
                           <!-- Price tabs Start -->
                           <div class="col-md-12">
                              <!-- menu body -->
                              <div class="menu-body">
                                 <div class="menu-section">
                                    @foreach ($courses as $course)   
                                        <div class="menu-item">
                                        <div class="menu-item-pic lightbox">
                                            <a href="{{ route('troopers.all-course') }}">
                                                @php
                                                    $thumbnails = json_decode($course->thumbnail, true);
                                                    $firstThumbnail = isset($thumbnails[0]) ? $thumbnails[0] : 'default-thumbnail.jpg';
                                                @endphp
                                                <img class="img-responsive img-circle img-price" src="{{ asset('storage/' . $firstThumbnail) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="menu-item-name">
                                            {{ $course->name }}
                                        </div>
                                        <div class="menu-item-price">
                                            Rp. {{ number_format($course->price) }}
                                        </div>
                                        <div class="menu-item-description">
                                            <p>{!! \Illuminate\Support\Str::limit($course->description, 200) !!} ...</p>
                                        </div>
                                        </div>                                       
                                    @endforeach
                                 </div>
                                 <!--/ menu section -->
                              </div>
                              <!-- / menu body -->
                           </div>
                           <!--/tababble--> 
                        </div>
                        <!--/col-lg-9--> 
                     </div>
                     <!--/ inside-wrapper  -->
                  </section>
               </div>
               <!-- / content-box -->
            </div>
            <!-- /content-wrapper -->
         </div>
@endsection