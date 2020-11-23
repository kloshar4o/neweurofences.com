<!DOCTYPE html>
<html lang="{{$lang}}">
<head>
    {!! showsettingbodybyalias('google-analytics', $lang_id) !!}
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>

    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{$meta_description}}">

    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:locale:alternate" content="ro_RO"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{$meta_title}}"/>
    <meta property="og:image" content="{{$meta_page_img}}"/>
    <meta property="og:description" content="{{$meta_description}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:site_name" content="{{env('APP_DOMAIN')}}"/>

    <meta property="og:fb:admins" content="{{env('APP_DOMAIN')}}"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="{{$meta_description}}"/>
    <meta name="twitter:title" content="{{$meta_title}}"/>
    <meta name="twitter:site" content="@url"/>
    <meta name="twitter:image" content="{{$meta_page_img}}"/>

    <meta name="google-site-verification" content="7K5sLG3-h8w8coDzng-rV7VmfZ573nh3PZ2QSFRt_AU"/>
    <title>{{$meta_title}}</title>


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="theme-color" content="#ffffff">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front-assets/css/main.css?v='. time()) }}">

</head>
<body>


<style>
    #loader {
        position: fixed;
        z-index: 999;
        background: white;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        vertical-align: middle;
        align-items: center;
    }

    .lds-dual-ring {
        display: inline-block;
        width: 64px;
        height: 64px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 46px;
        height: 46px;
        margin: 1px;
        border-radius: 50%;
        border: 5px solid;
        border-color: #6a6a6a transparent #6a6a6a transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>

<div id="loader" class="fade_of fade_in">
    <div class="lds-dual-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>
    <div class="header-cart">
        <div class="header-cart-title">
            <span>Coșul dvs.</span>
            <i class="js-hide-cart">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                </svg>
            </i>
        </div>


        @if(!$cartPage)
            <div class="header-cart-content" id="miniCart">
                @include('front.minicart')
            </div>
        @endif

    </div>
</div>


<div class="wrapper">
    @yield('header')
    @yield('container')
    @yield('gallery')
    @yield('footer')
</div>



<script type="text/javascript" src="{{asset('front-assets/js/main.js?v=') }}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/cookie.js') }}"></script>
<script type="text/javascript" src="{{asset('front-assets/js/edit.js') . devtimestamp() }}"></script>
<script src="{{asset('front-assets/js/functions.js') . devtimestamp()}}"></script>


@stack('scripts')

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(55065157, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/55065157" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>