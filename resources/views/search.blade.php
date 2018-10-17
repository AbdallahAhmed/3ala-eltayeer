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
                    <input type="text" name="q" maxlength="50" placeholder="إبحث" class="third-title-font">
                    <button name="search-submit">
                        <i class="icon-arrow-left"></i>
                    </button>
                </form>
                <img src="{{assets('assets')}}/images/red.png" alt="" class="red">
            </div>
        </div>
        <section id="list">
            <div class="container">
                <img src="{{assets('assets')}}/images/green.png" alt="" class="green">
                <div class="cards">
                    @include('extensions.index-videos', $videos)
                    <div id="more"></div>
                </div>
            </div>
        </section>
        <div id="scroll-to"></div>
    </div>
@endsection
@push('scripts')
    <script>
        $('[name="search-submit"]').click(function (e) {
            e.preventDefault();
            let q = $('[name="q"]').val();
            window.location.href = encodeURI("{{route('index')}}" + '/search/' + encodeURIComponent(q));
        });

        offset = "{{$count}}";
        limti = 9;
        max = true
        $(window).scroll(function (e) {
            var hT = $('#scroll-to').offset().top,
                hH = $('#scroll-to').outerHeight(),
                wH = $(window).height(),
                wS = $(window).scrollTop();
            if (wS - 100 > (hT + hH - wH) && max) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "{{route('search',['q' => $q])}}",
                    async: false,
                    success: function (data) {
                        html = data.view;
                        if (data.count > 0) {
                            $(html).insertBefore('#more').hide().fadeIn(1000);
                        }
                        if (data.count < 9)
                            max = false;
                    }
                })
                return false;
            }
        })
    </script>
@endpush