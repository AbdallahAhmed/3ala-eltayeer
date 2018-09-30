@extends('layouts.app')
@section('title',trans('app.contact_us'))
@section('content')
    <section class="contact">
    @include('layouts.partials.header')
        <div class="container">
            <p class="third-title-font padding-section pb-45">{{trans('app.contact_us')}}</p>
            <div class="contact-section to-hide clearfix">
                <form class="d-inline-block" id="contact-form">
                    <div class="frist-input d-inline-block">
                        <input type="text" placeholder="{{trans('app.first_name')}}" maxlength="50" min-characters="3" max-characters="50">
                        <p style="display: none" id="error_first_name">{{trans('app.error_first_name')}}</p>
                    </div>
                    <div class="frist-input d-inline-block">
                        <input type="text" placeholder="{{trans('app.last_name')}}" maxlength="50" min-characters="3" max-characters="50">
                        <p style="display: none" id="error_last_name">{{trans('app.error_last_name')}}</p>
                    </div>
                    <div class="frist-input d-inline-block phone">
                        <input type="number" placeholder="{{trans('app.number')}}" maxlength="11" min-characters="11" max-characters="11">
                        <p style="display: none" id="error_number">{{trans('app.error_number')}}</p>
                    </div>
                    <div class="frist-input d-inline-block">
                        <input type="email" placeholder="{{trans('app.email')}}" maxlength="50" min-characters="6" max-characters="50">
                        <p style="display: none" id="error_email">{{trans('app.error_email')}}</p>
                    </div>
                    <div class="frist-input message">
                        <textarea placeholder="{{trans('app.message')}}" maxlength="500" min-characters="3" max-characters="1000"></textarea>
                        <p style="display: none" id="error_message">{{trans('app.error_message')}}</p>
                    </div>
                    <div>
                        <button class="send" type="submit">{{trans('app.send')}}</button>
                    </div>
                </form>
            </div>
            <div class="social-tabs">
                <a href="#">YOUTUBE</a>
                <a href="#">TWITTER</a>
                <a href="#">FACEBOOK</a>
            </div>
        </div>
    </section>
    @endsection