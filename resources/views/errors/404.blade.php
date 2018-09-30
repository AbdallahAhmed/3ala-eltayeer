@extends('layouts.app')
@section('title',404)
@section('content')
    <section class="error">
        <header>
            <div class="container">
                <div class="nav ">
                    <div class="top">
                        <div class="d-inline-block logo">
                            <a href="#">
                                <img src="{{assets('assets')}}/images/Vector-Smart-Object.png" alt="#">
                            </a>
                        </div>
                        <a href="{{route('index')}}">
                            العودة الي الرئيسية
                        </a>
                    </div>
                </div>

            </div>


        </header>
        <div class="container">
            <div class="error-img">
                <img src="{{assets('assets')}}/images/404.png" alt="">
            </div>
            <div class="error-content">
                <span class="second-title-font">الصفحة غير موجودة</span>
                <p class="first-para">
                    عذرا ، ولكن الصفحة التي كنت تبحث عنها لم يتم العثور عليها. حاول التحقق من URL للخطأ ، ثم اضغط على زر
                    التحديث في المتصفح الخاص بك أو حاول العثور على شيء آخر في موقعنا .
                </p>
                <p id="s">

                </p>
            </div>
        </div>
    </section>
    <script>
        $('#s').html('سيتم تحويلك ' + 6);
        var counter = 6;
        setInterval(function () {
            c = -- counter;
            if(c < 1){
                window.location.href = '{{route('index', ['lang' => app()->getLocale()])}}';
                return;
            }
            $('#s').html('سيتم تحويلك '+ c);
        }, 1000);
    </script>
@endsection
