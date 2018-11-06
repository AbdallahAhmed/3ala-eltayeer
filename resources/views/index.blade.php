 @extends('layouts.app')
    @section('title',trans('app.home'))
    @section('content')
    <section class="home-section">
            @include('layouts.partials.header')
        <div class="container">
            <div class="social-h">
                <a  target="_blank" href="{{option('facebook_page')}}">Facebook</a>
                <a  target="_blank" href="{{option('twitter_page')}}">Twitter</a>
                <a  target="_blank" href="{{option('youtube_page')}}">Youtube</a>
            </div>
            <div class="scroll">
                <a href="#"><i class="icon-arrow-down"></i> Scroll down</a>
            </div>
            <div class="swiper">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($categories as $category)
                            <div class="swiper-slide">
                                <div class="image"><img src="{{thumbnail($category->cover->path,'home-slider')}}" alt=""></div>
                                <div class="text">
                                    <p class="title">{{$category->name}}</p>
                                    <p><span>{{category_count($category->id)}}.</span> {{trans('app.video')}}</p>
                                    <a href="{{$category->path}}" class="more">
                                        {{trans('app.view_more')}} <i class="icon-slider-left"></i>
                                    </a>
                                    <a href="{{$category->path}}" class="play">
                                        <i class="icon-play"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next swiper-button-white">
                    <i class="icon-slider-right"></i>
                </div>
                <div class="swiper-button-prev swiper-button-white">
                    <i class="icon-slider-left"></i>
                </div>
            </div>
        </div>
</section>
<section class="padding-section category-videos">

    <div class="container">
        <p class="title-section main-title-font  black-color ">{{trans('app.latest_videos')}}</p>
        <hr class="under-line">
        <div class="cards">
            @include('extensions.index-videos', $videos)
            {{--@if(count($videos) == 12)--}}
            <div class="btn-more">
                <button class="more">{{trans('app.more')}}</button>
            </div>
            {{--@endif--}}
        </div>

    </div>
</section>
    @include('extensions.subscribe')

<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 0,
        centeredSlides: true,
        slideToClickedSlide: true,
        simulateTouch:false,
        loop: true,
        autoplay: true,
        navigation: {
            prevEl: '.swiper-button-next.swiper-button-white',
            nextEl: '.swiper-button-prev.swiper-button-white'
        },
        breakpoints: {
            768: {
                slidesPerView: 1,
                spaceBetween: 50
            }
        },

    });

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
                url: "{{route('index')}}",
                data: {'offset': offset, 'limit': 12},
                success: function (data) {
                    if (data.count > 0) {
                        $(data.view).insertBefore('.btn-more');
                        offset += data.count;
                        $('.card').each(function () {
                            if ($(this).isInViewport()) {
                                $(this).css({
                                    opacity: '1',
                                    transform: 'translateY(-10px)'
                                });
                            }
                        });
                    }
                    if (data.count < 12)
                        $('.btn-more').remove();
                }
            })
        });
    })

</script>
    @endsection
