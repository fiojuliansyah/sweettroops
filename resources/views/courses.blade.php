@extends('layouts.guest')

@section('content')
    <section class="sec-title">
        <div class="w-layout-blockcontainer cont-title w-container">
            <h1 class="heading-title">Online Classes</h1>
        </div>
    </section>
    <section class="section-23">
        <div class="w-layout-blockcontainer container-20 w-container">
            <p class="paragraph-20">Our online classes feel just like baking with us in the SweetTroops studio - minus the
                flour explosions and sticky fingers!<br>You&#x27;ll get step-by-step videos, easy-to-follow recipes, and all
                our best tips, so it feels like we&#x27;re right there cheering you on.<br>The best part? You can hit pause,
                rewind, or bake in your pyjamas at 2am - whatever suits your style.<br>No rush, no rules - just pure, joyful
                baking on your own time.</p>
        </div>
    </section>
    <section class="team-circles">
        <div class="container-21">
            <div class="collection-list-wrapper-2 w-dyn-list">
                <div role="list" class="collection-list-2 w-dyn-items w-row">
                    <div role="listitem" class="collection-item-2 w-dyn-item w-col w-col-4"><img
                            src="https://d3e54v103j8qbb.cloudfront.net/plugins/Basic/assets/placeholder.60f9b1840c.svg"
                            loading="lazy" id="w-node-a0986e99-da9f-4b86-822c-f527d14b120e-18607b69" alt=""
                            class="image-10 w-dyn-bind-empty">
                        <a href="#" class="link-4"></a>
                    </div>
                </div>
                <section class="inside-page">
                    <div class="inside-wrapper container">
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
                                                            $firstThumbnail = isset($thumbnails[0])
                                                                ? $thumbnails[0]
                                                                : 'default-thumbnail.jpg';
                                                        @endphp
                                                        <img class="img-responsive img-circle img-price"
                                                            src="{{ asset('storage/' . $firstThumbnail) }}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="menu-item-name">
                                                    {{ $course->title }}
                                                </div>
                                                <div class="menu-item-price">
                                                    Rp. {{ number_format($course->price) }}
                                                </div>
                                                <div class="menu-item-description">
                                                    <p>{!! \Illuminate\Support\Str::limit($course->description, 200) !!} ...</p>
                                                </div>
                                            </div>
                                            <br>
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
        </div>
    </section>
@endsection
