@foreach($videos as $vid)
    <div class="card">
        <div class="img-card">
            <a href="{{$vid->path}}"><div>
                    <img src="{{thumbnail($vid->image->path, 'common')}}"
                         alt="#">
                    <button class="play-card"><i class="icon-play"></i></button>
                </div></a>
            <div class="over-video">
                <div class="title d-inline-block">
                    <img src="{{thumbnail($vid->category->image->path, 'category-logo')}}" alt="#">
                    <span class="second-title-font">{{$vid->category->name}}</span>
                </div>
                <div class="hover-card  d-inline-block ">
                    <div class="social-icon">
                        <a href="#"><i class="icon-youtube"></i></a>
                        <a href="#"><i class="icon-facebook"></i></a>
                        <a href="#"><i class="icon-twitter"></i></a>

                    </div>
                </div>
            </div>

        </div>
        <div class="title-card clearfix">
            <a href="{{$vid->path}}">
                <p class="second-title-font ">
                    {{$vid->title}}
                </p></a>
        </div>
    </div>
@endforeach