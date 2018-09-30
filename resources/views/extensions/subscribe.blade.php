<section class="subscribe">
    <div class="bg-center"></div>
    <div class="container">
        <div class="text-container">
            <div class="text">
                <p class="main-title-font ">اشترك الآن</p>
                <p class="second-title-font">نقدم فيديوهات مميزة اشترك الآن</p>

                <!--dalia comment -- d-none this text what will appear after subscription-->
                <p style="display: none" class="message"></p>


                <form class="d-none">
                    <input type="text" id="email" placeholder="البريد الإلكتروني">
                    <button><i class="icon-arrow-left"></i></button>
                </form>
                <div class="social">
                    <a  target="_blank" href="{{option('facebook_page')}}">Facebook</a>
                    <a  target="_blank" href="{{option('twitter_page')}}">Twitter</a>
                    <a  target="_blank" href="{{option('youtube_page')}}">Youtube</a>
                </div>

            </div>


        </div>
        <div class="images">
            <img src="{{assets('assets')}}/images/6plus.png" alt="#">
        </div>
    </div>
</section>
@push('scripts')
    <script>
        $(function () {
            $('.d-none').submit(function (e) {
                e.preventDefault();
                let email = $('#email').val()
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: '{{route('subscribe',['lang'=>app()->getLocale()])}}',
                    type: 'POST',
                    data: {
                        email: email
                    }
                }).done(function (json) {
                    if (json.status) {
                        //
                        $('.message').html("{{trans('app.subscribed')}}");
                        $('.message').css('display', 'block')
                        $('.message').fadeOut(3000);
                    } else {
                            $('.message').css('display', 'block')
                        for (let error of json.errors)
                            $('.message').html( error );
                    }
                }).fail(function (xhr, status, errorThrown) {
                    alert('alert their error in request');
                });
                return false;
            });
        })
    </script>
@endpush
