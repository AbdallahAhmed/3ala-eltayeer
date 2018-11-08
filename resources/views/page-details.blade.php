@extends('layouts.app')
@section('title',$page->slug)
@section('content')
    <section class="about original">
        @include('layouts.partials.header')
        <div class="container">
            <p class="third-title-font padding-section">{{$page->title}}</p>
            <div class="sub-icons">
                <img src="{{assets('assets')}}/images/tayer.png" alt="">
                <!--<img src="img/shapes.png" alt="" class="shapes">-->
            </div>
            <p>
                {{ strip_tags($page->content)}}
            </p>
            <div class="social-tabs">
                <a href="#">YOUTUBE</a>
                <a href="#">TWITTER</a>
                <a href="#">FACEBOOK</a>
            </div>
        </div>
    </section>
@endsection