<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" prefix="og: http://ogp.me/ns#">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="{{option('site_robots')}}">
    <meta name="copyright" content="3altayeer">
    <meta name="language" content="{{app()->getLocale()}}">
    @section('meta')
        <meta name="title" content="<?=  option('site_title')?>">
        <meta name="description" content="<?= str_limit(option('site_description'), 150)?>">
        <meta name="keywords" content="<?=option('site_keywords')?>">
        <meta name="author" content="<?=option('site_author')?>">
        <meta property="og:locale" content="{{app()->getLocale()}}"/>
        <meta property="og:title" content="<?=  option('site_title')?>"/>
        <meta property="og:site_name" content="{{option('site_name')}}"/>
        <meta property="og:description" content="<?= str_limit(option('site_description'), 150)?>">
        <meta property="og:image" content="{{asset('assets')}}/images/Vector-Smart-Object.png">
        <meta name="twitter:title" content="<?= option('site_title')?>">
        <meta name="twitter:description" content="<?= str_limit(option('site_description'), 150)?>">
        <meta name="twitter:image" content="{{asset('assets')}}/images/Vector-Smart-Object.png">
        <meta name="twitter:url" content="{{asset('/')}}">
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <link rel="icon" type="image/png" href="{{asset('assets')}}/images/fav.png">

    <title> @yield("title")</title>
    <script>
        window.trans = {};
        window.lang = "{{app()->getLocale()}}";
        window.searchUrl = "{{asset(app()->getLocale().'/search')}}";
    </script>

    <link rel="stylesheet" href="{{asset('assets')}}/css/reset.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/swiper.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/fontello.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets')}}/css/fontawesome-all.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/main.css">
    <link rel="stylesheet" href="{{asset('')}}/css/common.css">
    {{--<script src="{{asset('assets')}}/js/jquery-3.3.1.min.js"></script>--}}
    <script
            src="https://code.jquery.com/jquery-1.8.2.min.js"
            integrity="sha256-9VTS8JJyxvcUR+v+RTLTsd0ZWbzmafmlzMmeZO9RFyk="
            crossorigin="anonymous"></script>
    <script src="{{asset('assets')}}/js/swiper.js"></script>
    <script src="{{asset('assets')}}/js/main.js"></script>
    <script src="{{asset('')}}/js/common.js"></script>
    <script data-pace-options='{ "ajax": false }' src="{{asset('')}}/js/pace.js"></script>
    <script>
        Pace.once('start', function () {
            document.getElementById('wrapper-body').style.opacity = "0";
        })

        Pace.once('hide', function () {
            document.getElementById('wrapper-body').style.opacity = 1;
            document.getElementById('progress-bar').style.display = "none";
            document.getElementById('loading').style.display = "none";
            document.getElementById('body').style.height = "auto";
        })
    </script>
    @stack('head')
</head>
<body id="body" class="{{app()->getLocale()}}" style="overflow: hidden;height: 100vh">
    <div id="progress-bar">
    </div>
<section id="loading" >
    <img src="../assets/images/commonBg.png" alt="" id="loading">
        <div class="about2 load">
            <div class="container">
                <div class="sub-icons">
                    <img id="loading-image" src="../assets/images/tayer.png">
                    <span id="percentage"></span>
                </div>
            </div>
        </div>
</section>
<div id="wrapper-body" style="opacity: 0;">
    @yield('content')
    @yield('layouts.partials.footer')
</div>
</body>
@stack('scripts')
</html>