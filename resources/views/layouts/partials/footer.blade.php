<footer>
    <div class="container">
        <div class="top padding-section">
            <div class="d-inline-block logo">
                <a href="{{route('index')}}">
                    <img src="{{asset('assets')}}/images/Vector-Smart-Object.png" alt="#">
                </a>
            </div>
            <div class="sup-category">
                <ul>
                    @foreach($cats as $cat)
                        <li>
                            <a href="{{$cat->path}}">{{$cat->name}} </a>
                            <p>
                                <span>{{$cat->count}}.</span>
                                {{trans('app.video')}}
                            </p>

                        </li>
                    @endforeach

                </ul>
            </div>

        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <div class="d-inline-block width-50 right">
                @foreach($footerNav as $item)
                    <a href="{{nav_url($item)}}">{{$item->name}}</a>
                @endforeach
            </div>
            <div class="d-inline-block width-50 left">
                <a target="_blank" href="{{option('facebook_page')}}">Facebook</a>
                <a target="_blank" href="{{option('twitter_page')}}">Twitter</a>
                <a target="_blank" href="{{option('youtube_page')}}">Youtube</a>
            </div>

        </div>
    </div>
</footer>