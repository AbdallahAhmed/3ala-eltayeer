@extends('layouts.app')
@section('meta')
    @include('extensions.meta',['post'=>$video])
@endsection
@section('title',$video->slug)
@section('content')

    <section class="video-section">
        @include('layouts.partials.header')
        <div class="container">
            <div class="video-wrapper">
                <div class="video-card" id="video">
                    <div class="video">
                        <video poster="{{thumbnail($video->image->path,'video-details')}}"
                               src="{{$video->media->path}}">
                        </video>
                    </div>
                    <button class="play-card"><i class="icon-play"></i></button>
                    <div class="over-video">
                        <div class="title d-inline-block">
                            <img src="{{thumbnail($category->image->path, 'category-logo')}}" alt="#">
                            <span class="second-title-font">{{$category->name}}</span>
                        </div>
                        <div class="hover-card  d-inline-block ">
                            <div class="social-icon" data-youtube="{{$video->media->path}}" data-url="{{$video->path}}"
                                 data-title="{!! $video->title !!}">
                                <a href="javascript:void(0)"><i class="icon-youtube youtube shareBtn"></i></a>
                                <a href="javascript:void(0)"><i class="icon-facebook facebook shareBtn"></i></a>
                                <a href="javascript:void(0)"><i class="icon-twitter twitter shareBtn"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="title-card clearfix">
                    <p class="second-title-font ">
                        {!! $video->title !!}
                    </p>
                </div>
            </div>

        </div>
    </section>
    <section class="padding-section video-details">
        <div class="container">
            <p class="title-section main-title-font  black-color ">{{trans('app.latest_videos')}}</p>
            <hr class="under-line">
            <div class="cards">
                @include('extensions.index-videos', $videos)

                @if(count($videos) == 6)
                    <div class="btn-more">
                        <button class="more">{{trans('app.more')}}</button>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @include('extensions.subscribe')
@endsection
@push('scripts')
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        $(function () {
            offset = 6
            $('.btn-more').on('click', function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "{{route('posts.show',['slug'=> $video->slug])}}",
                    data: {'offset': offset, 'limit': 6},
                    success: function (data) {
                        if (data.count > 0) {
                            $(data.view).hide().insertBefore('.btn-more').fadeIn(800);
                            offset += data.count;
                        }
                        if (data.count < 6)
                            $('.btn-more').remove();
                    }
                })
            });

            $(document).on('click','.play-card',function (e) {
                e.preventDefault()
                var video = $(this).closest('.video-card').find('video');
                var src = video[0].src;
                var div = $('#video');
                var height = div.height();
                var width = div.width();
                var vid = src.split('embed/')[1];

                player = new YT.Player('video', {
                    width: width,
                    height: height,
                    videoId: vid,
                    playerVars: { 'autoplay': 1, 'controls': 1 },
                    events:{
                        onStateChange: stopVideo
                    }
                });
            });
            function stopVideo(e) {
                if(e.data == 0)
                    $('.video-wrapper').html("<div class=\"video-card\" id=\"video\">\n" +
                        "                    <div class=\"video\">\n" +
                        "                        <video poster=\"{{thumbnail($video->image->path,'video-details')}}\"\n" +
                        "                               src=\"{{$video->media->path}}\">\n" +
                        "                        </video>\n" +
                        "                    </div>\n" +
                        "                    <button class=\"play-card\"><i class=\"icon-play\"></i></button>\n" +
                        "                    <div class=\"over-video\">\n" +
                        "                        <div class=\"title d-inline-block\">\n" +
                        "                            <img src=\"{{thumbnail($category->image->path, 'category-logo')}}\" alt=\"#\">\n" +
                        "                            <span class=\"second-title-font\">{{$category->name}}</span>\n" +
                        "                        </div>\n" +
                        "                        <div class=\"hover-card  d-inline-block \">\n" +
                        "                            <div class=\"social-icon\" data-youtube=\"{{$video->media->path}}\" data-url=\"{{$video->path}}\"\n" +
                        "                                 data-title=\"{!! $video->title !!}\">\n" +
                        "                                <a href=\"javascript:void(0)\"><i class=\"icon-youtube youtube shareBtn\"></i></a>\n" +
                        "                                <a href=\"javascript:void(0)\"><i class=\"icon-facebook facebook shareBtn\"></i></a>\n" +
                        "                                <a href=\"javascript:void(0)\"><i class=\"icon-twitter twitter shareBtn\"></i></a>\n" +
                        "                            </div>\n" +
                        "                        </div>\n" +
                        "                    </div>\n" +
                        "                </div>\n" +
                        "                <div class=\"title-card clearfix\">\n" +
                        "                    <p class=\"second-title-font \">\n" +
                        "                        {!! $video->title !!}\n" +
                        "                    </p>\n" +
                        "                </div>")
            }
        })
    </script>
@endpush
