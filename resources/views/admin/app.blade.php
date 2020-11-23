<!DOCTYPE html>
<html lang="{{$lang}}" class="dark {{$blade}}">
<head>

    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    @if(!empty($modules_submenu_name))
        <title>{{$modules_submenu_name->name or trans('variables.title_page')}}</title>
    @elseif(!empty($modules_name))
        <title>{{$modules_name->name or trans('variables.title_page')}}</title>
    @else
        <title>{{trans('variables.title_page')}}</title>
    @endif
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('favicon.png')}}">

    <link rel="stylesheet" href="{{asset('admin-assets/css/jquery.arcticmodal-0.3.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/jquery.formstyler.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/css/admin.css')}}">

    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->

</head>
<body>

<main>
    @include('admin.header')

    @if(auth()->check() == true)
        @include('admin.sidebar')
    @endif

    <div class="content {{auth()->check() == true && (is_null(request()->cookie('sidebar')) || request()->cookie('sidebar')) ? ' with-sidebar' : ''}}">
        @yield('content')
    </div>

    @include('admin.footer')
</main>

@include('admin.popups')

<!-- development version, includes helpful console warnings -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
{{--

<!-- production version, optimized for size and speed -->
<script src="https://cdn.jsdelivr.net/npm/vue"></script>

--}}
<script defer src="{{asset('admin-assets/fontawesome/js/all.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery.arcticmodal-0.3.min.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery.formstyler.min.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery.matchHeight-min.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery.tablednd_0_5.js')}}"></script>
<script src="{{asset('admin-assets/js/select2.min.js')}}"></script>
<script src="{{asset('admin-assets/js/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('admin-assets/js/toastr.js')}}"></script>
<script src="{{asset('admin-assets/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin-assets/js/drag-arrange.js')}}"></script>
<script src="{{asset('admin-assets/js/dropzone.js')}}"></script>
<script src="{{asset('admin-assets/js/dropzone-config.js')}}"></script>
<script src="{{asset('admin-assets/js/google_map.js')}}"></script>
<script src="{{asset('admin-assets/js/scripts.js')}}"></script>
<script src="{{asset('admin-assets/js/OpenClose.js')}}"></script>
<script src="{{asset('admin-assets/js/FileUpload.js')}}"></script>
<script src="{{asset('admin-assets/js/NewSaveForm.js')}}"></script>

@include('vue.table')
@stack('scripts')
</body>
</html>