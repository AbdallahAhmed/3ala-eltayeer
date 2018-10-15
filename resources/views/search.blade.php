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
        <section>
            <div class="container">
                <img src="{{assets('assets')}}/images/green.png" alt="" class="green">
                <div class="cards">
                    @include('extensions.index-videos', $videos)
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $('[name="search-submit"]').click(function (e) {
            e.preventDefault();
            alert()
            let q = $('[name="q"]').val();
            /*if (q.trim().length == 0) {
                $('[name="q"]').val('');
                return false;
            }*/
            window.location.href = encodeURI("{{route('index')}}" + '/search/' + encodeURIComponent(q));
            //return false;
        });
    </script>
@endpush