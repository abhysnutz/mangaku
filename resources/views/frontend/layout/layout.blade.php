<!doctype html>
<html lang="id">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>@yield('title')</title>
        <!-- SEO Mangaku.web.id -->
        <meta name="description" content="@yield('meta-description')" />
        <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/themes/FlexorMagazine/style.css') }}" type="text/css" media="all">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/themes/FlexorMagazine/csi.css') }}" type="text/css" media="all">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/themes/FlexorMagazine/ctmb.css') }}" type="text/css" media="all">
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.css') }}">
        <link rel="icon" href="https://mangaku.fun/favicon.gif" type="image/gif" />
        <link rel="icon" href="https://mangaku.fun/favicon.gif" type="image/png" />
        <link rel="shortcut icon" href="https://mangaku.fun/favicon.gif" type="image/x-icon" />
        <link rel="prefetch" href="{{ asset('assets/frontend/js/themes/FlexorMagazine/cpr2.js') }}">
        <link rel='stylesheet' id='mg-index-css'  href='{{ asset('assets/frontend/css/themes/FlexorMagazine/tbin.css') }}' type='text/css' media='all' />
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>    <script></script>
        <script defer src="https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js"></script>
        <script src="{{ asset('assets/frontend/js/jquery.min.js') }}" ></script>
       
        <SCRIPT type='text/javascript'>
            //<![CDATA[
            (function(a,b){$window=a(b),a.fn.lazyload=function(c){function f(){var b=0;d.each(function(){var c=a(this);if(e.skip_invisible&&!c.is(":visible"))return;if(!a.abovethetop(this,e)&&!a.leftofbegin(this,e))if(!a.belowthefold(this,e)&&!a.rightoffold(this,e))c.trigger("appear");else if(++b>e.failure_limit)return!1})}var d=this,e={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!0,appear:null,load:null};return c&&(undefined!==c.failurelimit&&(c.failure_limit=c.failurelimit,delete c.failurelimit),undefined!==c.effectspeed&&(c.effect_speed=c.effectspeed,delete c.effectspeed),a.extend(e,c)),$container=e.container===undefined||e.container===b?$window:a(e.container),0===e.event.indexOf("scroll")&&$container.bind(e.event,function(a){return f()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,c.one("appear",function(){if(!this.loaded){if(e.appear){var f=d.length;e.appear.call(b,f,e)}a("<img />").bind("load",function(){c.hide().attr("src",c.data(e.data_attribute))[e.effect](e.effect_speed),b.loaded=!0;var f=a.grep(d,function(a){return!a.loaded});d=a(f);if(e.load){var g=d.length;e.load.call(b,g,e)}}).attr("src",c.data(e.data_attribute))}}),0!==e.event.indexOf("scroll")&&c.bind(e.event,function(a){b.loaded||c.trigger("appear")})}),$window.bind("resize",function(a){f()}),f(),this},a.belowthefold=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.height()+$window.scrollTop():e=$container.offset().top+$container.height(),e<=a(c).offset().top-d.threshold},a.rightoffold=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.width()+$window.scrollLeft():e=$container.offset().left+$container.width(),e<=a(c).offset().left-d.threshold},a.abovethetop=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.scrollTop():e=$container.offset().top,e>=a(c).offset().top+d.threshold+a(c).height()},a.leftofbegin=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.scrollLeft():e=$container.offset().left,e>=a(c).offset().left+d.threshold+a(c).width()},a.inviewport=function(b,c){return!a.rightofscreen(b,c)&&!a.leftofscreen(b,c)&&!a.belowthefold(b,c)&&!a.abovethetop(b,c)},a.extend(a.expr[":"],{"below-the-fold":function(c){return a.belowthefold(c,{threshold:0,container:b})},"above-the-top":function(c){return!a.belowthefold(c,{threshold:0,container:b})},"right-of-screen":function(c){return a.rightoffold(c,{threshold:0,container:b})},"left-of-screen":function(c){return!a.rightoffold(c,{threshold:0,container:b})},"in-viewport":function(c){return!a.inviewport(c,{threshold:0,container:b})},"above-the-fold":function(c){return!a.belowthefold(c,{threshold:0,container:b})},"right-of-fold":function(c){return a.rightoffold(c,{threshold:0,container:b})},"left-of-fold":function(c){return!a.rightoffold(c,{threshold:0,container:b})}})})(jQuery,window)
            //]]>
        </SCRIPT>
        <script src='{{ asset('assets/frontend/js/themes/FlexorMagazine/main.js') }}' type='text/javascript'></script>
        <script type="text/javascript">
            $(document).ready(function() {
              $('#nav2 li:first-child:not(ul.children li)').hover(function(){$(this).addClass('firstac')}, function(){$(this).removeClass('firstac')});
              $('#sidebar ul li:last-child:not(ul.children li)').addClass('last');
            });
        </script>
        
        <script src='https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.js' type='text/javascript'></script>
        <script type='text/javascript' src='{{ asset('assets/frontend/js/themes/FlexorMagazine/jqtmg.js') }}'></script>
        <script type='text/javascript' src='{{ asset('assets/frontend/js/themes/FlexorMagazine/owl.carouselv3.js') }}'></script>
        <script type='text/javascript' src='{{ asset('assets/frontend/js/themes/FlexorMagazine/jqtmgid.js') }}'></script>
        <script type='text/javascript'>
            //<![CDATA[
            (function(a,b){$window=a(b),a.fn.lazyload=function(c){function f(){var b=0;d.each(function(){var c=a(this);if(e.skip_invisible&&!c.is(":visible"))return;if(!a.abovethetop(this,e)&&!a.leftofbegin(this,e))if(!a.belowthefold(this,e)&&!a.rightoffold(this,e))c.trigger("appear");else if(++b>e.failure_limit)return!1})}var d=this,e={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!0,appear:null,load:null};return c&&(undefined!==c.failurelimit&&(c.failure_limit=c.failurelimit,delete c.failurelimit),undefined!==c.effectspeed&&(c.effect_speed=c.effectspeed,delete c.effectspeed),a.extend(e,c)),$container=e.container===undefined||e.container===b?$window:a(e.container),0===e.event.indexOf("scroll")&&$container.bind(e.event,function(a){return f()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,c.one("appear",function(){if(!this.loaded){if(e.appear){var f=d.length;e.appear.call(b,f,e)}a("<img />").bind("load",function(){c.hide().attr("src",c.data(e.data_attribute))[e.effect](e.effect_speed),b.loaded=!0;var f=a.grep(d,function(a){return!a.loaded});d=a(f);if(e.load){var g=d.length;e.load.call(b,g,e)}}).attr("src",c.data(e.data_attribute))}}),0!==e.event.indexOf("scroll")&&c.bind(e.event,function(a){b.loaded||c.trigger("appear")})}),$window.bind("resize",function(a){f()}),f(),this},a.belowthefold=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.height()+$window.scrollTop():e=$container.offset().top+$container.height(),e<=a(c).offset().top-d.threshold},a.rightoffold=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.width()+$window.scrollLeft():e=$container.offset().left+$container.width(),e<=a(c).offset().left-d.threshold},a.abovethetop=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.scrollTop():e=$container.offset().top,e>=a(c).offset().top+d.threshold+a(c).height()},a.leftofbegin=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.scrollLeft():e=$container.offset().left,e>=a(c).offset().left+d.threshold+a(c).width()},a.inviewport=function(b,c){return!a.rightofscreen(b,c)&&!a.leftofscreen(b,c)&&!a.belowthefold(b,c)&&!a.abovethetop(b,c)},a.extend(a.expr[":"],{"below-the-fold":function(c){return a.belowthefold(c,{threshold:0,container:b})},"above-the-top":function(c){return!a.belowthefold(c,{threshold:0,container:b})},"right-of-screen":function(c){return a.rightoffold(c,{threshold:0,container:b})},"left-of-screen":function(c){return!a.rightoffold(c,{threshold:0,container:b})},"in-viewport":function(c){return!a.inviewport(c,{threshold:0,container:b})},"above-the-fold":function(c){return!a.belowthefold(c,{threshold:0,container:b})},"right-of-fold":function(c){return a.rightoffold(c,{threshold:0,container:b})},"left-of-fold":function(c){return!a.rightoffold(c,{threshold:0,container:b})}})})(jQuery,window)
            $(function(){var e;particlesJS("mgjs",{particles:{number:{value:100,density:{enable:!0,value_area:800}},color:{value:"#ffffff"},shape:{type:"circle",stroke:{width:0,color:"#000000"},polygon:{nb_sides:5},image:{src:"img/github.svg",width:100,height:100}},opacity:{value:.5,random:!1,anim:{enable:!1,speed:1,opacity_min:.1,sync:!1}},size:{value:3,random:!0,anim:{enable:!1,speed:40,size_min:.1,sync:!1}},line_linked:{enable:!1,distance:150,color:"#ffffff",opacity:.4,width:1},move:{enable:!0,speed:6,direction:"none",random:!1,straight:!1,out_mode:"out",bounce:!1,attract:{enable:!1,rotateX:600,rotateY:1200}}},interactivity:{detect_on:"canvas",events:{onhover:{enable:!0,mode:"repulse"},onclick:{enable:!0,mode:"push"},resize:!0},modes:{grab:{distance:400,line_linked:{opacity:1}},bubble:{distance:400,size:40,duration:2,opacity:4,speed:3},repulse:{distance:200,duration:.4},push:{particles_nb:4},remove:{particles_nb:2}}},retina_detect:!0}),e=function(){window.pJSDom[0].pJS.particles&&window.pJSDom[0].pJS.particles.array,requestAnimationFrame(e)},requestAnimationFrame(e)});
            //]]>
        </script>
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/layout.css') }}">
        

        @stack('css-top')

        <script>
            function ClearFields() {$("button.close-iconx").trigger("click");$("#datalivesearch").hide();}
            function imerriwp(iwp){
            const iwpx = /https?:\/\/i\d.wp.com\//gm;	
            const gtn = 'https://';
            const ckipwx = iwpx.test(iwp.src);
            if(ckipwx){	
                iwp.src = iwp.src.replace(iwpx, gtn);
            }	
            }
        </script>
        <link href="{{ asset('assets/frontend/css/themes/FlexorMagazine/crs.css') }}" rel="stylesheet" type="text/css" media="all" />
        <meta name="referrer" content="no-referrer" />
        <script type='text/javascript' src='{{ asset('assets/frontend/js/themes/FlexorMagazine/tab_view.js') }}'></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="mainwrap">
            <div id="mgjs"></div>
            <div id="header">
                <div id="blogtitle">
                    <h1><a href="{{ route('index') }}"><img onerror="imerriwp(this);" class="logo" src="https://cdn.mangaku.my.id/gambar/2023/01/91137ef8b67fb91151c5023d-bc1fe5f1a438de74c3f5d3d7dcb929d8.png" /></a></h1>
                    <div class="description"> mangaotan.com </div>
                </div>
                <div class="adv">
                    <div class="separator" style="clear: both; text-align: center;"><a href="https://usahapastislot.com/" imageanchor="1" style="margin-left: 1em; margin-right: 1em;">
                        <img border="0" data-original-height="1300" data-original-width="905" src="https://cdn.mangaku.my.id/gambar/2022/02/272ea74f2a6a221d7599544c-68bd9f9b7c53d87b924963392e22e459.gif" width="650" /></a>
                    </div>
                </div>
            </div>
            <div id="nav2">
                <!-- CATEGORY MENU -->
                <ul class="sf-menu">
                    <li> <a href="{{ route('index') }}">Home</a></li>
                    <li> <a href="{{ route('comic.index') }}">Daftar Komik</a></li>
                </ul>
            </div>
            <!-- END CATEGyORY MENU -->
            <!-- START CAROUSEL -->
            @include('frontend.layout.header')
            <!-- START CAROUSEL -->
            
            {{-- START CONTENT --}}
            @yield('content')
            {{-- END CONTENT --}}

            <!-- iklan -->	
            <script type="text/javascript">
                (function($,window,document,undefined){var lazyLoadXT='lazyLoadXT',dataLazied='lazied',load_error='load error',classLazyHidden='lazy-hidden',docElement=document.documentElement||document.body,forceLoad=(window.onscroll===undefined||!!window.operamini||!docElement.getBoundingClientRect),options={autoInit:!0,selector:'img[data-src]',blankImage:'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',throttle:99,forceLoad:forceLoad,loadEvent:'pageshow',updateEvent:'load orientationchange resize scroll touchmove focus',forceEvent:'lazyloadall',oninit:{removeClass:'lazy'},onshow:{addClass:classLazyHidden},onload:{removeClass:classLazyHidden,addClass:'lazy-loaded'},onerror:{removeClass:classLazyHidden},checkDuplicates:!0},elementOptions={srcAttr:'data-src',edgeX:0,edgeY:0,visibleOnly:!0},$window=$(window),$isFunction=$.isFunction,$extend=$.extend,$data=$.data||function(el,name){return $(el).data(name)},elements=[],topLazy=0,waitingMode=0;$[lazyLoadXT]=$extend(options,elementOptions,$[lazyLoadXT]);function getOrDef(obj,prop){return obj[prop]===undefined?options[prop]:obj[prop]}
                function scrollTop(){var scroll=window.pageYOffset;return(scroll===undefined)?docElement.scrollTop:scroll}
                $.fn[lazyLoadXT]=function(overrides){overrides=overrides||{};var blankImage=getOrDef(overrides,'blankImage'),checkDuplicates=getOrDef(overrides,'checkDuplicates'),scrollContainer=getOrDef(overrides,'scrollContainer'),forceShow=getOrDef(overrides,'show'),elementOptionsOverrides={},prop;$(scrollContainer).on('scroll',queueCheckLazyElements);for(prop in elementOptions){elementOptionsOverrides[prop]=getOrDef(overrides,prop)}
                return this.each(function(index,el){if(el===window){$(options.selector).lazyLoadXT(overrides)}else{var duplicate=checkDuplicates&&$data(el,dataLazied),$el=$(el).data(dataLazied,forceShow?-1:1);if(duplicate){queueCheckLazyElements();return}
                if(blankImage&&el.tagName==='IMG'&&!el.src){el.src=blankImage}
                $el[lazyLoadXT]=$extend({},elementOptionsOverrides);triggerEvent('init',$el);elements.push($el);queueCheckLazyElements()}})};function triggerEvent(event,$el){var handler=options['on'+event];if(handler){if($isFunction(handler)){handler.call($el[0])}else{if(handler.addClass){$el.addClass(handler.addClass)}
                if(handler.removeClass){$el.removeClass(handler.removeClass)}}}
                $el.trigger('lazy'+event,[$el]);queueCheckLazyElements()}
                function triggerLoadOrError(e){triggerEvent(e.type,$(this).off(load_error,triggerLoadOrError))}
                function checkLazyElements(force){if(!elements.length){return}
                force=force||options.forceLoad;topLazy=Infinity;var viewportTop=scrollTop(),viewportHeight=window.innerHeight||docElement.clientHeight,viewportWidth=window.innerWidth||docElement.clientWidth,i,length;for(i=0,length=elements.length;i<length;i++){var $el=elements[i],el=$el[0],objData=$el[lazyLoadXT],removeNode=!1,visible=force||$data(el,dataLazied)<0,topEdge;if(!$.contains(docElement,el)){removeNode=!0}else if(force||!objData.visibleOnly||el.offsetWidth||el.offsetHeight){if(!visible){var elPos=el.getBoundingClientRect(),edgeX=objData.edgeX,edgeY=objData.edgeY;topEdge=(elPos.top+viewportTop-edgeY)-viewportHeight;visible=(topEdge<=viewportTop&&elPos.bottom>-edgeY&&elPos.left<=viewportWidth+edgeX&&elPos.right>-edgeX)}
                if(visible){$el.on(load_error,triggerLoadOrError);triggerEvent('show',$el);var srcAttr=objData.srcAttr,src=$isFunction(srcAttr)?srcAttr($el):el.getAttribute(srcAttr);if(src){el.src=src}
                removeNode=!0}else{if(topEdge<topLazy){topLazy=topEdge}}}
                if(removeNode){$data(el,dataLazied,0);elements.splice(i--,1);length--}}
                if(!length){triggerEvent('complete',$(docElement))}}
                function timeoutLazyElements(){if(waitingMode>1){waitingMode=1;checkLazyElements();setTimeout(timeoutLazyElements,options.throttle)}else{waitingMode=0}}
                function queueCheckLazyElements(e){if(!elements.length){return}
                if(e&&e.type==='scroll'&&e.currentTarget===window){if(topLazy>=scrollTop()){return}}
                if(!waitingMode){setTimeout(timeoutLazyElements,0)}
                waitingMode=2}
                function initLazyElements(){$window.lazyLoadXT()}
                function forceLoadAll(){checkLazyElements(!0)}
                $(document).ready(function(){triggerEvent('start',$window);$window.on(options.updateEvent,queueCheckLazyElements).on(options.forceEvent,forceLoadAll);$(document).on(options.updateEvent,queueCheckLazyElements);if(options.autoInit){$window.on(options.loadEvent,initLazyElements);initLazyElements()}})})(window.jQuery||window.Zepto||window.$,window,document);(function($){var options=$.lazyLoadXT;options.selector+=',video,iframe[data-src]';options.videoPoster='data-poster';$(document).on('lazyshow','video',function(e,$el){var srcAttr=$el.lazyLoadXT.srcAttr,isFuncSrcAttr=$.isFunction(srcAttr),changed=!1;$el.attr('poster',$el.attr(options.videoPoster));$el.children('source,track').each(function(index,el){var $child=$(el),src=isFuncSrcAttr?srcAttr($child):$child.attr(srcAttr);if(src){$child.attr('src',src);changed=!0}});if(changed){this.load()}})})(window.jQuery||window.Zepto||window.$)
                $(document).ready(function() {
                $('#closed').click(function(){
                $('#bm_banner').slideToggle({duration: 1000});
                });
                });
            </script>
            <!-- #iklan -->		
            
            <div id="footer">
                <div class="alignleft">Copyright &copy; 2023. All Rights Reserved. Designed by <a href="http://www.mangaku.live">Mangaku.live</a></div>
               
            </div>
        </div>
        
        <script type="text/javascript">
            function delay(callback, ms) {
              var timer = 0;
              return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                  callback.apply(context, args);
                }, ms || 0);
              };
            }
            // $(document).ready(function(){$("input#keyword").keyup(delay(function(a){if($(this).val().length>=3&&$(this).val().length<=150){$.ajax({url:'https://mangaku.fun/wp-admin/admin-ajax.php',type:"post",data:{action:"data_live_search",scx: '0e067c02e8',keyword:$("input#keyword").val()},beforeSend:function(){$(".lds-ring").show();$("#datalivesearch").hide()},success:function(b){$(".lds-ring").hide();$("#datalivesearch").show();$("#datalivesearch").html(b)}})}else{$("#datalivesearch").hide()}},300))});
        </script>
        {{-- <script type='text/javascript' src='https://mangaku.fun/wp-includes/js/wp-embed.min.js?ver=4.9.23'></script> --}}
        <div id="fb-root"></div>
        <script>
            function ref(e) 
            {
              setTimeout(reloadImg, 1000, e);
            }
            
            function reloadImg(e)
            {
              var source = e.src;
              e.src = source;
            }
            $(document).ready(function(){
            $(".owl-carousel img").each(function() {
              
                  $(this).addClass("owl-lazy");
                  $(this).attr("data-src",$(this).attr("src"));
                  $(this).removeAttr("src");
                  
            });    
              
            (function(d, s, id){
               var js, fjs = d.getElementsByTagName(s)[0];
               if (d.getElementById(id)) {return;}
               js = d.createElement(s); js.id = id;
               js.src = '//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.2&appId=279823932968559';
               fjs.parentNode.insertBefore(js, fjs);
             }(document, 'script', 'facebook-jssdk'));
             
                  $('img[src^="http://"]').each(function(){ 
                      var oldUrl = $(this).attr("src"); 
                      var newUrl = oldUrl.replace("http://", "https://"); 
                      $(this).attr("src", newUrl);
                  });
              });
        </script>
        <a title="Back To Top" href="javascript:void(0);" id="scmg" class="shrc"></a>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            
            gtag('config', 'G-9SKC50BZ5L');
        </script>
        <script type='text/javascript' src="{{ asset('assets/frontend/js/themes/FlexorMagazine/fnic.js') }}"></script>
        <script type='text/javascript'>
            $(document).ready(function() {
                $("#loading-slider").remove();
                $('.border').show();
                $('.border').owlCarousel({
                    items:6,
                
                    lazyLoad:true,
                    loop:true,
                    nav: true,
                    navText: ['', ''],
                    dots: false,
                    autoplay:true,
                    autoplayTimeout:2000,
                    autoplayHoverPause:true,
                    margin:10,
                    autoHeight:false,
                    mouseDrag: true,
                    touchDrag: true,
                    pullDrag: true,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:2,
                            
                        },
                        600:{
                            items:4,
                            
                        },
                        980:{
                            items:6,
                            
                            loop:true
                        }
                }
                });
                jQuery(window).scroll(function() {
                    jQuery(window).scrollTop() < 350 ? jQuery("#scmg").slideUp(500) : jQuery("#scmg").slideDown(500);
                    let exx = jQuery("#ft")[0] ? jQuery("#ft")[0] : jQuery(document.body)[0],
                        txx = $("#scmg"),
                        nxx = (parseInt(document.documentElement.clientHeight), parseInt(document.body.getBoundingClientRect().top), parseInt(exx.clientWidth)),
                        rxx = txx.clientWidth;
                    if (1e3 > nxx) {
                        let lxx = parseInt(txx.offsetLeft);
                        lxx = rxx > lxx ? 2 * lxx - rxx : lxx, txx.css('left', nxx + lxx + "px")
                    } else txx.css("right", 10)
                }), jQuery("#scmg").click(function() {
                    jQuery('html, body').css('scroll-behavior', 'unset'); 
                    jQuery("html, body").animate({
                        scrollTop: "0px",
                        display: "none"
                    }, {
                        duration: 1000,
                        easing: "linear"
                    });
                    let epp = this;
                    this.className += " lnrc", setTimeout(function() {
                        epp.className = "shrc";
                        jQuery('html, body').css('scroll-behavior', 'smooth'); 
                    }, 1000)
                });	
            });
        </script>
        <script>
            $('#close-footer').on('click touchstart', function () {
                $('#ftads').css("display", "none");
            });
            jQuery(document).ready(function() {
                jQuery("time.timeago").timeago();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
        @stack('js-bottom')
    </body>
</html>	