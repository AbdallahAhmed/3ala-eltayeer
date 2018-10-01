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
                <div class="video-card">
                    <div class="video">
                        <video poster="{{thumbnail($video->image->path,'video-details')}}" id="video"
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

            $('.play-card').click(function (e) {
                e.preventDefault()
                var video = $(this).closest('.video-card').find('video');
                src = video[0].src;
                height = $('.video').height()
                width = $('.video').width()
                $('.video-card').html('<div class="video"> <iframe frameborder="0" height="'+height+'" width="'+width+'" src="'+src+'?autoplay=1"></iframe></div>');

            });
        })
    </script>
@endpush
