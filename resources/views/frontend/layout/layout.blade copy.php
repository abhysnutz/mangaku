<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml" lang="id-ID">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="theme-color" content="#e2520d" />
        <meta name="msapplication-navbutton-color" content="#e2520d" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#e2520d" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noodp">
        <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
        <title>@yield('title')</title>
        <meta name="description" content="@yield('meta-description')" />
        @if (env("APP_ENV") == "production")
            <meta name="propeller" content="486fb85c528378757b1d97b5bb396189">
        @endif
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <style type="text/css">
            img.wp-smiley,
            img.emoji {
                display: inline !important;
                border: none !important;
                box-shadow: none !important;
                height: 1em !important;
                width: 1em !important;
                margin: 0 0.07em !important;
                vertical-align: -0.1em !important;
                background: none !important;
                padding: 0 !important;
            }
        </style>
        @stack('css-top')
 
        <!-- LOAD CSS -->
        <script type="text/javascript">
            var defaultTheme = "darkmode";
            
            function lazycss(url) {
                let css = document.createElement("link");
                let app = "{{ env('APP_ENV') }}"
                css.href = url
                css.rel = "stylesheet";
                css.type = "text/css";
                document.getElementsByTagName("head")[0].appendChild(css);
            }

            // LOAD CSS
            lazycss("{{ asset('assets/frontend/css/style.css') }}");
            lazycss("https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap");
            lazycss("https://fonts.googleapis.com/css?family=Fira+Sans:400,400i,500,500i,600,600i,700,700i&display=swap");
            lazycss("{{ asset('assets/frontend/css/lightmode.css') }}");
            lazycss("{{ asset('assets/frontend/css/font-awesome.min.css') }}");
            lazycss("{{ asset('assets/frontend/css/owl.carousel.css') }}");
            lazycss("{{ asset('assets/frontend/css/swiper.min.css') }}");
        </script> 

        <script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
        <script data-minify="1" type="text/javascript" src="{{ asset('assets/frontend/js/function.js') }}" ></script>
        {{-- <script type="text/javascript" src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script> --}}
        <script data-minify="1" type="text/javascript" src="{{ asset('assets/frontend/js/tabs.js') }}" async></script>
        @if (env("APP_ENV") == "production")
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-T1QY2EJFXM"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'G-T1QY2EJFXM');
            </script>
        @endif

        <style>
            .th {
                padding-top:5px;
            }
            .th,
            .serieslist.pop ul li.topone .limit .bw .ctr,
            .releases .vl,
            .scrollToTop,
            #sidebar #bm-history li a:hover,
            .hpage a,
            #footer .footermenu,
            .footer-az .az-list li a,
            .main-info .info-desc .spe span:before,
            .bxcl ul li span.dt a,
            .bookmark,
            .commentx #submit,
            .radiox input:checked ~ .checkmarkx,
            .advancedsearch button.searchz,
            .lightmode .nav_apb a:hover,
            .lista a,
            .lightmode .lista a:hover,
            .nextprev a,
            .disqusmen #commentform #submit,
            .blogbox .btitle .vl,
            .bigblogt span a,
            .big-slider .paging .centerpaging .swiper-pagination span.swiper-pagination-bullet-active {
                background: #e2520d;
            }

            .pagination span.page-numbers.current,
            .quickfilter .filters .filter.submit button,
            #sidebar .section .ts-wpop-series-gen .ts-wpop-nav-tabs li.active a,
            #gallery.owl-loaded .owl-dots .owl-dot.active span,
            .bs.stylefiv .bsx .chfiv li a:hover {
                background: #e2520d !important;
            }

            #sidebar .section #searchform #searchsubmit,
            .series-gen .nav-tabs li.active a,
            .lastend .inepcx a,
            .nav_apb a:hover,
            #top-menu li a:hover,
            .readingnav.rnavbot .readingnavbot .readingbar .readingprogress,
            .lightmode .main-info .info-desc .wd-full .mgen a:hover,
            .lightmode .bxcl ul li .chbox:hover,
            .lightmode ul.taxindex li a:hover,
            .comment-list .comment-body .reply a:hover,
            .topmobile,
            .bxcl ul::-webkit-scrollbar-thumb,
            .lightmode .slider:before,
            .quickfilter .filters .filter .genrez::-webkit-scrollbar-thumb,
            .hothome .releases,
            .lightmode .seriestucon .seriestucont .seriestucontr .seriestugenre a:hover,
            .bloglist .blogbox .innerblog .thumb .btags {
                background: #e2520d;
            }

            .lightmode #sidebar .section h4,
            .lightmode .serieslist ul li .ctr,
            .listupd .utao .uta .luf ul li,
            .lightmode .bs .bsx:hover .tt,
            .soralist ul,
            a:hover,
            .lightmode .blogbox .btitle h3,
            .lightmode .blogbox .btitle h1,
            .bxcl ul li .lchx a:visited,
            .listupd .utao .uta .luf ul li a:visited,
            .lightmode .pagination a:hover,
            .lightmode a:hover,
            #sidebar .serieslist ul li .leftseries h2 a:hover,
            .bs.styletere .epxs,
            .bxcl ul li .dt a,
            .lightmode .main-info .info-desc .wd-full .mgen a,
            .lightmode #sidebar .serieslist ul li .leftseries h2 a:hover,
            .comment-list .comment-body .reply a,
            .bxcl ul li .eph-num a:visited,
            .headpost .allc a,
            .lightmode .seriestucon .seriestucont .seriestucontr .seriestugenre a,
            .bs.stylefiv .bsx .chfiv li a {
                color: #e2520d;
            }

            .bxcl ul li .lchx a:visited,
            .listupd .utao .uta .luf ul li a:visited,
            .bs.stylefiv .bsx .chfiv li a {
                color: #e2520d !important;
            }

            .lightmode .serieslist ul li .ctr,
            .advancedsearch button.searchz,
            .lista a,
            .lightmode .lista a:hover,
            .blogbox .boxlist .bma .bmb .bmba,
            .page.blog .thumb,
            #sidebar .section #searchform #searchsubmit,
            .lightmode .main-info .info-desc .wd-full .mgen a,
            .lightmode .bxcl ul li .chbox:hover,
            .comment-list .comment-body .reply a,
            .lightmode .seriestucon .seriestucont .seriestucontr .seriestugenre a {
                border-color: #e2520d;
            }

            .bs.stylefiv .bsx .chfiv li a:before {
                content: "";
                background: #e2520d;
                opacity: 0.2;
                position: absolute;
                display: block;
                left: 0;
                right: 0;
                top: 0;
                bottom: 0;
                border-radius: 10px;
            }

            .bs.stylefiv .bsx .chfiv li a {
                background: none !important;
            }

            .slider.round:before {
                background: #333;
            }

            .hpage a:hover,
            .bs.stylefiv .bsx .chfiv li a:hover {
                color: #fff !important;
            }

            @media only screen and (max-width: 800px) {
                .lightmode.black .th,
                .lightmode .th,
                .th,
                .surprise {
                    background: #e2520d;
                }

                #main-menu {
                    background: rgba(28, 28, 28, 0.95);
                }
            }
        </style>
        <link rel="icon" href="{{ asset('assets/frontend/img/icon-32.png') }}" sizes="32x32" />
        <link rel="icon" href="{{ asset('assets/frontend/img/icon-192.png') }}" sizes="192x192" />
        <link rel="apple-touch-icon" href="{{ asset('assets/frontend/img/icon-180.png') }}" />
        <meta name="msapplication-TileImage" content="{{ asset('assets/frontend/img/icon-270.png') }}" />
    </head>
    <body class="darkmode" itemscope="itemscope" itemtype="http://schema.org/WebPage">
        
        <div class="mainholder">
            <div class="th">
                <div class="centernav bound">
                    <div class="shme">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <header role="banner" itemscope itemtype="http://schema.org/WPHeader">
                        <div class="site-branding logox">
                            <span class="logos">
                                <a title="{{ env('APP_NAME') }} - Baca Manga Komik Bahasa Indonesia" itemProp="url" href="{{ route('index') }}">
                                    <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="{{ env('APP_NAME') }} - Baca Manga Komik Bahasa Indonesia" />
                                    <span class="hdl">{{ env('APP_NAME') }}</span>
                                </a>
                            </span>
                            <meta itemProp="name" content="{{ env('APP_NAME') }}" />
                        </div>
                    </header>
                    <nav id="main-menu" class="mm">
                        <span itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
                            <ul id="menu-home" class="menu">
                                <li id="menu-item-23" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-23">
                                    <a href="{{ route('index') }}" aria-current="page" itemProp="url">
                                        <span itemProp="name">Beranda</span>
                                    </a>
                                </li>
                                <li id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22">
                                    <a href="{{ route('comic.index') }}" itemProp="url">
                                        <span itemProp="name">Daftar Komik</span>
                                    </a>
                                </li>
                                <li id="menu-item-22" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-22">
                                    <a href="{{ route('update') }}" itemProp="url">
                                        <span itemProp="name">Komik Terbaru</span>
                                    </a>
                                </li>
                            </ul>
                        </span>
                        <div class="clear"></div>
                    </nav>
                    <div class="searchx minmb">
                        <form action="{{ env('APP_URL') }}" id="form" method="get" itemprop="potentialAction" itemscope="" itemtype="http://schema.org/SearchAction">
                           <meta itemprop="target" content="{{ env('APP_URL') }}?s={query}">
                             <input id="s" itemprop="query-input" class="search-live live-search_focused live-search_focused live-search_focused" type="text" placeholder="Cari" name="s" autocomplete="off">
                           <button type="submit" id="submit"><i class="fas fa-search" aria-hidden="true"></i></button>
                           <div class="srcmob srccls"><i class="fas fa-times-circle"></i></div>
                        </form>
                   </div>
                    {{-- <div class="srcmob">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </div> --}}
                    <div id="thememode" style="display:@yield('thememode')">
                        <span class="xt">Dark?</span>
                        <label class="switch">
                            <input type="checkbox" />
                            <span class="slider round"></span>
                        </label>
                    </div>
                    
                </div>
                <div class="clear"></div>
            </div>
            <!--themesia cache start-->
            <div class="big-slider swiper-container">
                <div class="swiper-wrapper"></div>
                <div class="paging">
                    <div class="centerpaging">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            
            {{-- CONTENT --}}
            @yield('content')

            {{-- FOOTER --}}
            @include('frontend.layout.footer')
        </div>
        <a href="#" class="scrollToTop">
            <span class="fas fa-angle-up"></span>
        </a>
       
        <script>
            $(document).ready(function(){
                $(".shme").click(function(){
                    $(".mm").toggleClass("shwx");
                });
                $(".srcmob").click(function(){
                    $(".minmb").toggleClass("minmbx");
                });
            });
            ts_darkmode.init();

            //Check to see if the window is top if not then display button
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $(".scrollToTop").fadeIn();
                } else {
                    $(".scrollToTop").fadeOut();
                }
            });
            //Click event to scroll to top
            $(".scrollToTop").click(function () {
                $("html, body").animate( { scrollTop: 0, }, 800 );
                return false;
            });
            
            if (localStorage.getItem("thememode") == null) {
                $("#thememode input[type='checkbox']").prop("checked", true);
            } else {
                $("#thememode input[type='checkbox']").prop("checked", (localStorage.getItem("thememode") == "lightmode") ? false : true);
            }
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script> ts_darkmode.listen(); </script>
        @if (env("APP_ENV") == "production")
            <!-- Histats.com  START  (aync)-->
            <script type="text/javascript">var _Hasync= _Hasync|| [];
                _Hasync.push(['Histats.start', '1,4700376,4,0,0,0,00010000']);
                _Hasync.push(['Histats.fasi', '1']);
                _Hasync.push(['Histats.track_hits', '']);
                (function() {
                    var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
                    hs.src = ('//s10.histats.com/js15_as.js');
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                })();
            </script>
            <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4700376&101" alt="" border="0"></a></noscript>
            <!-- Histats.com  END  -->
        @endif
        @stack('js-bottom')
    </body>
</html>