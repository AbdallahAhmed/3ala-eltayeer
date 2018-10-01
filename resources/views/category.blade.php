@extends('layouts.app')
@section('title',$category->name)
@section('content')

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
                        @foreach($videos as $video)
                            <div class="swiper-slide">
                                <div class="video-wrapper">
                                    <div id="rv-{{$video->id}}" class="video-card">
                                        <div  class="video text-center">
                                            <video poster="{{thumbnail($video->image->path, 'video-details')}}"
                                                   class="video" data-id="{{$video->id}}" src="{{$video->media->path}}">
                                            </video>
                                        </div>
                                        <button class="play-card"><i class="icon-play"></i></button>
                                    </div>
                                </div>
                            </div>
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
    <script>
        $(document).on('click','#stop',function () {
                $('iframe').each(function (i) {
                    $(this).pauseVideo()
                    return false;
                })
        })
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

            $('.play-card').click(function (e) {
                e.preventDefault()
                var video = $(this).closest('.video-card').find('video');
                src = video[0].src;
                height = $('#rv-'+video[0].dataset.id).height();
                width = $('#rv-'+video[0].dataset.id).width();
                $('#rv-'+video[0].dataset.id).
                html('<div class="video"> <iframe frameborder="0" height="'+height+'" width="'+width+'" id="iframe-'+video[0].dataset.id+'"  src="'+src+'?autoplay=1" ></iframe></div>');
            });


        })
    </script>
@endpush