<header>
    <div class="container">
        <div class="nav ">
            <div class="top">
                <div class="d-inline-block logo">
                    <a href="#">
                        <img src="{{asset('assets')}}/images/Vector-Smart-Object.png" alt="#">
                    </a>
                </div>
                <div class="d-inline-block">
                    <ul class="menu">
                        <li ><a href="{{route('index')}}"
                                                      class="">{{trans('app.home')}}</a></li>
                        @foreach($headerNav as $item)
                        <li><a href="{{nav_url($item)}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>


                </div>
                <div class="search-icon d-inline-block">
                    <button class="icon-bar">
                        <i class="icon-menu"></i>
                    </button>
                    <form action="" class="search-form">
                        <input type="text" placeholder="ابحث">
                        <button class="btn-search" id="search-icon" type="submit">
                            <i class="icon-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="search-page">
                <form>
                    <input type="text" placeholder="إبحث" class="third-title-font">
                    <button>
                        <i class="icon-arrow-left"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
    <div class="menu-responsive">
        <div class="container">
            <ul class="items">
                <li><a href="#">الرئيسية</a></li>
                <li><a href="#">عن على الطاير</a></li>
                <li>
                    <a href="#" class="mb-25">الأقسام</a>
                    <ul class="sub-items">
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                        <li>
                            <a href="#">الإمارات </a>
                            <p>
                                <span>110.</span>
                                فيديو
                            </p>

                        </li>
                    </ul>
                </li>
                <li><a href="#">إتصل بنا</a></li>
                <li class="social">
                    <a href="#">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">Youtube</a>
                </li>
            </ul>
        </div>
    </div>
</header>