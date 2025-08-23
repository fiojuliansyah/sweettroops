<!DOCTYPE html>
<!--  This site was created in Webflow. https://webflow.com  --><!--  Last Published: Sun Aug 17 2025 16:01:07 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="6871d9753f65fe81c0f0303e" data-wf-site="685911588c01846905a79595" lang="en">

<head>
    <meta charset="utf-8">
    <title>SweetTroops Baking Studio</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="/frontend/assets/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="/frontend/assets/css/webflow.css" rel="stylesheet" type="text/css">
    <link href="/frontend/assets/css/sweettroopss.webflow.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ["Droid Serif:400,400italic,700,700italic"]
            }
        });
    </script>
    <script type="text/javascript">
        ! function(o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                .className += t + "touch")
        }(window, document);
    </script>
    <link href="/frontend/assets/images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="/frontend/assets/images/webclip.png" rel="apple-touch-icon">

    @stack('styles')
</head>

<body class="body">
    @include('layouts.partials.guest.header')
    @yield('content')
    <section class="footer-dark">
        <div class="container-5">
            <div class="footer-wrapper"><a href="#" class="footer-brand w-inline-block"><img
                        src="/frontend/assets/images/Logo-ST.png"
                        loading="lazy" sizes="(max-width: 668px) 100vw, 668px"
                         class="image-3"></a>
                <div class="footer-content">
                    <div id="w-node-_1428390e-f8f5-6e62-91c7-677b0b167cc9-0b167cc3" class="footer-block">
                        <div class="title-small">Company</div><a href="{{ route('about') }}" class="footer-link">About
                            us</a><a href="{{ route('contacts') }}" class="footer-link">Contacts</a><a
                            href="{{ route('faqs') }}" class="footer-link">FAQs</a>
                    </div>
                    <div id="w-node-_1428390e-f8f5-6e62-91c7-677b0b167cd2-0b167cc3" class="footer-block">
                        <div class="title-small">COURSES</div><a href="{{ route('courses') }}" class="footer-link">Online Class</a><a
                            href="#" class="footer-link">Hands-On Class</a>
                    </div>
                    <div id="w-node-_1428390e-f8f5-6e62-91c7-677b0b167cdd-0b167cc3" class="footer-block">
                        <div class="title-small">About</div><a href="{{ route('terms') }}" class="footer-link">Terms
                            &amp;
                            Conditions</a><a href="{{ route('privacy.policy') }}" class="footer-link">Privacy policy</a>
                        <div class="footer-social-block"><a href="#"
                                class="footer-social-link w-inline-block"><img
                                    src="https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe09d00f767f9f0893_IG%20Logo.png"
                                    loading="lazy" sizes="(max-width: 1024px) 100vw, 1024px"
                                    srcset="https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe09d00f767f9f0893_IG%20Logo-p-500.png 500w, https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe09d00f767f9f0893_IG%20Logo-p-800.png 800w, https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe09d00f767f9f0893_IG%20Logo.png 1024w"
                                    alt="" class="image-4"></a><a href="#"
                                class="footer-social-link w-inline-block"><img
                                    src="https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe1e493b7dc8646c68_TT%20Logo.png"
                                    loading="lazy" sizes="(max-width: 1024px) 100vw, 1024px"
                                    srcset="https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe1e493b7dc8646c68_TT%20Logo-p-500.png 500w, https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe1e493b7dc8646c68_TT%20Logo-p-800.png 800w, https://cdn.prod.website-files.com/685911588c01846905a79595/685a5ffe1e493b7dc8646c68_TT%20Logo.png 1024w"
                                    alt="" class="image-5"></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-divider"></div>
        <div class="footer-copyright-center">Sweettroops © 2023. Please don't steal our secret ingredients. Whisked,
            Styled, Protected.</div>
    </section>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=685911588c01846905a79595"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <script src="/frontend/assets/js/webflow.js" type="text/javascript"></script>

    @stack('js')
</body>

</html>
