<section class="subscribe">
    <div class="bg-center"></div>
    <div class="container">
        {{--{{ dd($slider->files) }}--}}
        <div class="text-container">
            <div class="text">
                <p class="main-title-font ">اشترك الآن</p>
                <p class="second-title-font">نقدم فيديوهات مميزة اشترك الآن</p>

                <!--dalia comment -- d-none this text what will appear after subscription-->
                <p style="display: none" class="message"></p>


                <form class="d-none">
                    <input type="text" id="email" placeholder="البريد الإلكتروني">
                    <button id="s-button"><i class="icon-arrow-left"></i></button>
                </form>
                <div class="social">
                    <a  target="_blank" href="{{option('facebook_page')}}">Facebook</a>
                    <a  target="_blank" href="{{option('twitter_page')}}">Twitter</a>
                    <a  target="_blank" href="{{option('youtube_page')}}">Youtube</a>
                </div>

            </div>


        </div>
        <div class="images">
            <div class="slider-subscribe rtl-container">
                <div class="swiper-container " dir="rtl">
                    <div class="swiper-wrapper ">
                        @foreach($slider->files as $file)
                        <div class="swiper-slide">
                            <img src="{{ thumbnail($file->path , 'slider') }}" alt="{{ $file->title }}">
                        </div>
                        @endforeach
                        {{--<div class="swiper-slide">--}}
                            {{--<img src="{{assets('assets')}}/images/6plus.png" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide">--}}
                            {{--<img src="{{assets('assets')}}/images/6plus.png" alt="">--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        $(function () {
            $('.d-none').submit(function (e) {
                e.preventDefault();
                $("#s-button").fadeOut(200);
                let email = $('#email').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('subscribe')}}',
                    type: 'POST',
                    data: {
                        email: email
                    }
                }).done(function (json) {
                    $("#s-button").fadeIn(200);
                    if (json.status) {
                        //
                        $('#email').val('')
                        $('.message').html("{{trans('app.subscribed')}}");
                        $('.message').css('display', 'block')
                        $('.message').fadeOut(3000);
                    } else {
                            $('.message').css('display', 'block')
                        for (let error of json.errors)
                            $('.message').html( error );
                    }
                })/*.fail(function (xhr, status, errorThrown) {
                    alert('alert their error in request');
                });*/
                return false;
            });

            var subscribe = new Swiper('.slider-subscribe .swiper-container', {
                autoplay: true,
                navigation: {
                    nextEl: '.slider-1 .swiper-button-next',
                    prevEl: '.slider-1 .swiper-bu34tton-prev',
                },
            });
            subscribe.on('slideChange', () => {
                var children = $('.subscribe .social').children();
                children.removeClass('active-link');
                $(children[subscribe.realIndex]).addClass('active-link')
            });

        })
    </script>
@endpush
