<header>
    <div class="container">
        <div class="nav ">
            <div class="top">
                <div class="d-inline-block logo">
                    <a href="{{route('index')}}">
                        <img src="{{asset('assets')}}/images/Vector-Smart-Object.png" alt="#">
                    </a>
                </div>
                <div class="d-inline-block">
                    <ul class="menu">
                        <li><a href="{{route('index')}}"
                               class="">{{trans('app.home')}}</a></li>
                        @foreach($headerNav as $item)
                            @if($item->name == 'الأقسام')
                                <li class="has-submenu">
                                    <a href="#">الأقسام</a>
                                    <div class="dropdown">
                                        <ul class="dropdown-categories">
                                            @foreach($cats as $cat)
                                                <li>
                                                    <img src="../uploads/{{$cat->image->path}}" alt="">
                                                    <a href="{{$cat->path}}">
                                                        <span>{{$cat->name}}</span>
                                                        <span>{{$cat->count}}.{{trans('app.video')}}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @else
                            <li><a href="{{nav_url($item)}}">{{$item->name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="search-icon d-inline-block">
                    <button class="icon-bar">
                        <i class="icon-menu"></i>
                    </button>
                    <form class="search-form" id="search">
                        <input type="text" name="search-input" maxlength="20" placeholder="ابحث">
                        <button class="btn-search" id="search-icon">
                            <i class="icon-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="menu-responsive">
        <div class="container">
            <ul class="items">
                <li><a href="{{route('index')}}"
                       class="">{{trans('app.home')}}</a></li>
                @foreach($headerNav as $item)
                    @if($item->name == "الأقسام")
                        <li><a>{{$item->name}}</a>
                            <ul class="sub-items">
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
                        </li>
                        @continue
                    @endif
                    <li><a href="{{nav_url($item)}}">{{$item->name}}</a></li>
                @endforeach
                <li class="social">
                    <a target="_blank" href="{{option('facebook_page')}}">Facebook</a>
                    <a target="_blank" href="{{option('twitter_page')}}">Twitter</a>
                    <a target="_blank" href="{{option('youtube_page')}}">Youtube</a>
                </li>
            </ul>
        </div>
    </div>
</header>
@push('scripts')
    <script>
        $('.search-form button').click(function (e) {
            e.preventDefault();
            let q = $('[name="search-input"]').val();
            window.location.href = encodeURI("{{route('index')}}" + '/search/' + encodeURIComponent(q));
        })

    </script>
@endpush