<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ url('/').$site_info->favicon }}">
    @if (isset($site_info->index_google))
    <meta name="robots" content="{{ $site_info->index_google == 1 ? 'index, follow' : 'noindex, nofollow' }}">
    @else
    <meta name="robots" content="noindex, nofollow">
    @endif
    {!! SEO::generate() !!}
    <meta name='revisit-after' content='1 days' />
    <meta name="copyright" content="GCO" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="geo.region" content="VN" />
    <meta name="geo.position" content="10.764338, 106.69208" />
    <meta name="geo.placename" content="Hà Nội" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}" />
    <meta property="og:url" content="url()->current()" />
    <link rel="canonical" href="{{ \Request::fullUrl() }}">
    <!--link css-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/fontawesome-pro/css/all.css">
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/carousel.min.css">

    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/magnific-popup.min.css">
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/animate.css">
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/menu.css">

    <!-- Themes core CSS -->
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/main.css">
    
    @yield('css')
    <!--End link css-->
    @if (!empty($site_info->ticktok))
    <!-- Ticktok -->
	    <script>
		    (function() {
		        var ta = document.createElement('script');
		        ta.type = 'text/javascript';
		        ta.async = true;
		        ta.src = 'https://analytics.tiktok.com/i18n/pixel/sdk.js?sdkid={{ $site_info->ticktok }}';
		        var s = document.getElementsByTagName('script')[0];
		        s.parentNode.insertBefore(ta, s);
		    })();
	    </script>
    @endif

    @if (!empty($site_info->google_analytics))
    <!-- Google Analysis -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$site_info->google_analytics}}"></script>

    <script>
	    window.dataLayer = window.dataLayer || [];
	    function gtag(){dataLayer.push(arguments);}
	    gtag('js', new Date());

	    gtag('config', '{{$site_info->google_analytics}}');
    </script>
    @endif

    @if (!empty($site_info->google_tag_manager))
	    <!-- Google Tag Manager -->
	    <script>
	    (function(w, d, s, l, i) {
	        w[l] = w[l] || [];
	        w[l].push({
	            'gtm.start': new Date().getTime(),
	            event: 'gtm.js'
	        });
	        var f = d.getElementsByTagName(s)[0],
	            j = d.createElement(s),
	            dl = l != 'dataLayer' ? '&l=' + l : '';
	        j.async = true;
	        j.src =
	            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
	        f.parentNode.insertBefore(j, f);
	    })(window, document, 'script', 'dataLayer', '{{ $site_info->google_tag_manager }}');
	    </script>
    @endif

    @if (!empty($site_info->head))
	    {!! $site_info->head !!}
    @endif
    @if(!empty($config->css))
        <style type="text/css">
            {!! $config->css !!}
        </style>
    @endif
</head>

<body class="page-body home-body">

    <input type="hidden" value="{{url('/')}}" id="base_url">

    @if (!empty($site_info->body))
    {!! $site_info->body !!}
    @endif

    <noscript>
    	<iframe src="https://www.googletagmanager.com/ns.html?id={{ @$site_info->google_tag_manager }}" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>

    @if (!empty($site_info->facebook_pixel))
    <!-- Facebook Pixel -->
	    <script>
	    ! function(f, b, e, v, n, t, s) {
	        if (f.fbq) return;
	        n = f.fbq = function() {
	            n.callMethod ?
	                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
	        };
	        if (!f._fbq) f._fbq = n;
	        n.push = n;
	        n.loaded = !0;
	        n.version = '2.0';
	        n.queue = [];
	        t = b.createElement(e);
	        t.async = !0;
	        t.src = v;
	        s = b.getElementsByTagName(e)[0];
	        s.parentNode.insertBefore(t, s)
	    }(window, document, 'script',
	        'https://connect.facebook.net/en_US/fbevents.js');
	    fbq('init', '{{ $site_info->facebook_pixel }}');
	    fbq('track', 'PageView');
	    </script>
    @endif

    <noscript>
    	<img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ @$site_info->facebook_pixel }}&ev=PageView&noscript=1" />
    </noscript>

    <div class="body-main">
        @include('frontend.teamplate.header')
        @yield('main')
        @include('frontend.teamplate.footer')
       
    </div>

    <!--Link js-->
    <script src="{{ __BASE_URL__ }}/js/jquery.min.js"></script>
    <script src="{{ __BASE_URL__ }}/js/popper.min.js"></script>
    <script src="{{ __BASE_URL__ }}/js/bootstrap.min.js"></script>
    <script src="{{ __BASE_URL__ }}/js/carousel.min.js"></script>
    <script src="{{ __BASE_URL__ }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ __BASE_URL__ }}/js/custom.js"></script>

    <!--End Link js-->

    @yield('script_map')
    
    @yield('script')

    @if (!empty($site_info->script))
	    {!! $site_info->script !!}
    @endif
    
    @if (!empty($site_info->facebook_chat))
        {!! $site_info->facebook_chat !!}
    @endif

    @if (Session::has('toastr'))

        <script>

            jQuery(document).ready(function($) {

                toastr["success"]('{{ Session::get('toastr') }}', '{{trans('message.thong_bao')}}');

            });

        </script>

    @endif
</body>

</html>