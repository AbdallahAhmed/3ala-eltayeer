@extends('layouts.app')
@section('title',app()->getLocale())
@section('content')
    <section class="contact">
    @include('layouts.partials.header')
        <div class="container">
            <p class="third-title-font padding-section pb-45">إتصل بنا</p>
            <div class="contact-section to-hide clearfix">
                <form class="d-inline-block" id="contact-form">
                    <div class="frist-input d-inline-block">
                        <input type="text" placeholder="الإسم" maxlength="50" min-characters="3" max-characters="50">
                    </div>
                    <div class="frist-input d-inline-block">
                        <input type="text" placeholder="الإسم الأخير" maxlength="50" min-characters="3" max-characters="50">
                    </div>
                    <div class="frist-input d-inline-block phone">
                        <input type="number" placeholder="رقم التليفون" maxlength="11" min-characters="11" max-characters="11">
                    </div>
                    <div class="frist-input d-inline-block">
                        <input type="email" placeholder="البريد الإلكتروني" maxlength="50" min-characters="6" max-characters="50">
                        <p>من فضلك أدخل البريد الإلكتروني</p>

                    </div>
                    <div class="frist-input message">
                        <textarea placeholder="الرسالة" maxlength="500" min-characters="3" max-characters="1000"></textarea>

                    </div>
                    <div>
                        <button class="send" type="submit">إرسل</button>
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