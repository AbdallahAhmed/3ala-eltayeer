@extends('layouts.app')
@section('title',trans('app.contact_us'))
@section('content')
    <section class="contact">
        @include('layouts.partials.header')
        <div class="container">
            <p class="third-title-font padding-section pb-45">{{trans('app.contact_us')}}</p>
            <p style="display: none" class="third-title-font confirm">شكراً للتواصل معنا</p>
            <div class="contact-section to-hide clearfix">
                <form class="d-inline-block" id="contact-form">
                    <div class="frist-input d-inline-block">
                        <input name="first_name" type="text" placeholder="{{trans('app.first_name')}}" maxlength="50"
                               min-characters="3"
                               max-characters="50">
                        <p style="display: none" id="error_first_name">{{trans('app.error_first_name')}}</p>
                    </div>
                    <div class="frist-input d-inline-block">
                        <input name="last_name" type="text" placeholder="{{trans('app.last_name')}}" maxlength="50"
                               min-characters="3"
                               max-characters="50">
                        <p style="display: none" id="error_last_name">{{trans('app.error_last_name')}}</p>
                    </div>
                    <div class="frist-input d-inline-block phone">
                        <input name="number" type="number" placeholder="{{trans('app.number')}}" maxlength="11"
                               min-characters="11"
                               max-characters="11">
                        <p style="display: none" id="error_number">{{trans('app.error_number')}}</p>
                    </div>
                    <div class="frist-input d-inline-block">
                        <input name="email" type="text" placeholder="{{trans('app.email')}}" maxlength="50"
                               min-characters="6"
                               max-characters="50">
                        <p style="display: none" id="error_email">{{trans('app.error_email')}}</p>
                    </div>
                    <div class="frist-input message">
                        <textarea name="message" placeholder="{{trans('app.message')}}" maxlength="500"
                                  min-characters="3"
                                  max-characters="1000"></textarea>
                        <p style="display: none" id="error_message">{{trans('app.error_message')}}</p>
                    </div>
                    <div>
                        <button class="send" type="submit">{{trans('app.send')}}</button>
                    </div>
                </form>
            </div>
            <div class="social-tabs">
                <a target="_blank" href="{{option('facebook_page')}}">Facebook</a>
                <a target="_blank" href="{{option('twitter_page')}}">Twitter</a>
                <a target="_blank" href="{{option('youtube_page')}}">Youtube</a>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>

        $('#contact-form').submit(function (e) {
            arr = {
                'name': $('[name="first_name"]').val(),
                'last': $('[name="last_name"]').val(),
                'email': $('[name="email"]').val(),
                'number': $('[name="number"]').val(),
                'message': $('[name="message"]').val()
            };
            e.preventDefault();
            if(validate(arr)){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{route('contact-us')}}",
                    data: arr,
                    success: function () {
                        $('.contact-section').hide();
                        $('.social-tabs').hide();
                        $('.confirm').show();
                    }
                })
            }
        });

        function validate(arr) {
            var valid = true;
            regex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

            if(arr.name.length < 3 || arr.name.length > 50){
                $('#error_first_name').show();
                valid = false;
            }else{
                $('#error_first_name').hide();
            }
            if(arr.last.length < 3 || arr.last.length > 50){
                $('#error_last_name').show();
                valid = false;
            }else{
                $('#error_last_name').hide();
            }
            if(arr.number.length !== 11){
                $('#error_number').show();
                valid = false;
            }else{
                $('#error_number').hide();
            }
            if(!regex.test(arr.email)){
                $('#error_email').show();
                valid = false;
            }else{
                $('#error_email').hide();
            }
            if(arr.message.length < 3 || arr.message.length > 1000){
                $('#error_message').show();
                valid = false;
            }else{
                $('#error_message').hide();
            }
            return valid;
        }
    </script>
@endpush()