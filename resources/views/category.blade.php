@extends('layouts.app')
@section('title',$category->name)
@section('content')
    <style>
        .video-wrapper iframe {
            position: relative;
        }
    </style>
    <section class="category">
        @include('layouts.partials.header')
        <div class="container">
            <!--<img src="img/ball.png" alt="" class="ball">-->
            <div class="sliderContainer clearfix">
                <!--<img src="img/red.png" alt="" class="red-video">
                <img src="img/green.png" alt="" class="green-video">-->
                <!--<img src="img/lines.png" alt="" class="lines-video">-->
                <div class="swiper-container gallery-top col-12" dir="rtl">
                    <div class="swiper-wrapper">
                        @php $i = 0; @endphp
                        @foreach($videos as $video)
                            <div class="swiper-slide">
                                <div class="video-wrapper">
                                    <div id="rv-{{$i}}" class="video-card">
                                        <div class="video text-center">
                                            <video poster="{{thumbnail($video->image->path, 'video-details')}}"
                                                   class="video" data-id="{{$i}}" src="{{$video->media->path}}">
                                            </video>
                                        </div>
                                        <button id="{{$i}}" class="play-card"><i  class="icon-play"></i></button>
                                    </div>
                                </div>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
                <div class="below-video">
                    <div>
                        <img src="{{thumbnail($video->category->image->path, 'category-logo-cat')}}" alt=""
                             class="ball-icon">
                        <span class="third-title-font">{{$video->category->name}}</span>
                    </div>
                    <div class="position-relative">
                        <div class="swiper-container gallery-thumbs" dir="rtl">
                            <div class="swiper-wrapper">
                                @foreach($videos as $video)
                                    <div class="swiper-slide">
                                        <img src="{{thumbnail($video->image->path,'swiper-small')}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white">
                            <i id="stop" class="icon-slider-right"></i>
                        </div>
                        <div class="swiper-button-prev swiper-button-white">
                            <i id="stop" class="icon-slider-left"></i>
                        </div>
                    </div>
                    <div class="total-videos">
                    <span>
                        {{category_count($category->id)}}.
                    </span>
                        فيديو
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding-section category-videos">
        <div class="container">
            <div class="cards">
                @include('extensions.index-videos', $videos)
                @if(count($videos) == 12)
                    <div class="btn-more">
                        <button class="more">{{trans('app.more')}}</button>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        $(function () {
            offset = 12
            $('.btn-more').on('click', function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "{{route('category',['slug' => $category->slug])}}",
                    data: {'offset': offset, 'limit': 12},
                    success: function (data) {
                        if (data.count > 0) {
                            $(data.view).hide().insertBefore('.btn-more').fadeIn(800);
                            offset += data.count;
                        }
                        if (data.count < 12)
                            $('.btn-more').remove();
                    }
                })
            });

            v = 0;
            videos = [];
            function initVideos(id){
                for(i = 0; i < 2; ++i){
                    var video = $('#rv-'+i).find('video')[0];
                    var src = video.src;
                    var poster = video.poster;
                    var div = $('#rv-' + i);
                    var height = div.height();
                    var width = div.width();
                    var vid = src.split('embed/')[1];
                    videos[i] = new YT.Player('rv-'+i, {
                        height: height,
                        width: width,
                        videoId: vid,
                        playerVars: {'autoplay': 0, 'controls': 1},
                        /*events: {
                            onStateChange: function (e) {
                                if (e.data == 0)
                                    alert()
                                    stopVideo(i, poster, src)
                            }
                        }*/
                    })
                }

                videos[id].playVideo()
            }
            $(document).on('click', '.play-card', function (e) {
                //initVideos($(this).attr('id'));
                //return;
                e.preventDefault()
                var video = $(this).closest('.video-card').find('video');
                var src = video[0].src;
                var poster = video[0].poster;
                var div = $('#rv-' + video[0].dataset.id);
                var height = div.height();
                var width = div.width();
                var id = video[0].dataset.id;
                var vid = src.split('embed/')[1];
                videos[v] = new YT.Player('rv-' + id, {
                    width: width,
                    height: height,
                    videoId: vid,
                    playerVars: {'autoplay': 1, 'controls': 1},
                    autoplay: 1,
                    events: {
                        onStateChange: function (e) {
                            if (e.data == 0)
                                stopVideo(id, poster, src)
                        }
                    }
                });
                v++;
            });

            function stopVideo(id, poster, src) {
                $('#rv-' + id).hide();
                $("<div id=\"rv-" + id + "\" class=\"video-card\">\n" +
                    "                                        <div  class=\"video text-center\">\n" +
                    "                                            <video poster=\"" + poster + "\"\n" +
                    "                                                   class=\"video\" data-id=\"" + id + "\" src=\"" + src + "\">\n" +
                    "                                            </video>\n" +
                    "                                        </div>\n" +
                    "                                        <button class=\"play-card\"><i class=\"icon-play\"></i></button>\n" +
                    "                                    </div>").insertBefore('#rv-' + id);
                $('iframe#rv-'+id).remove();
            }
        })
    </script>

@endpush