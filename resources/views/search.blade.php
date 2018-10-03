@extends('layouts.app')
@section('title',trans('app.search').' | '.$q)
@section('content')
    <div class="search-section">
        <section>
            @include('layouts.partials.header')
        </section>
        <div class="search-page">
            <div class="container">
                <form id="search">
                    <input type="text" name="q" placeholder="إبحث" class="third-title-font">
                    <button name="search-submit">
                        <i class="icon-arrow-left"></i>
                    </button>
                </form>
                <img src="{{assets('assets')}}/images/red.png" alt="" class="red">
            </div>
        </div>
        <section>
            <div class="container">
                <img src="{{assets('assets')}}/images/green.png" alt="" class="green">
                <div class="cards">
                    @foreach($videos as $video)
                        <div class="card">
                            <div class="img-card">

                                <a href="{{$video->path}}"><img
                                            src="{{thumbnail($video->image->path, 'common')}}"
                                            alt="#">
                                <button class="play-card"><i class="icon-play"></i></button>
                                </a>
                                <div class="over-video">
                                    <div class="title d-inline-block">
                                        <img src="{{thumbnail($video->category->image->path, 'category-logo')}}" alt="#">
                                        <span class="second-title-font">{{$video->category->name}}</span>
                                    </div>
                                    <div class="hover-card  d-inline-block ">
                                        <div class="social-icon" data-youtube="{{$video->media->path}}" data-url="{{$video->path}}" data-title="{{$video->title}}">
                                            <a href="javascript:void(0)"><i class="icon-youtube youtube shareBtn"></i></a>
                                            <a href="javascript:void(0)"><i class="icon-facebook facebook shareBtn"></i></a>
                                            <a href="javascript:void(0)"><i class="icon-twitter twitter shareBtn"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="title-card clearfix">
                                <p class="second-title-font ">
                                   {{$video->title}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $('[name="search-submit"]').click(function (e) {
            alert()
            e.preventDefault();
            let q = $('[name="q"]').val();
            if (q.trim().length == 0) {
                $('[name="q"]').val('');
                return false;
            }
            window.location.href = encodeURI("{{route('index')}}" + '/search/' + encodeURIComponent(q));
            return false;
        });
    </script>
@endpush