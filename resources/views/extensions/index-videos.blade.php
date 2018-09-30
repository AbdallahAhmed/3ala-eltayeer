@foreach($videos as $video)
    <div class="card">
        <div class="img-card" id="img-{{$video->id}}">
            {{--<a href="javascript:void(0)"><img src="{{thumbnail($video->image->path,'common')}}" alt="{{$video->title}}"></a>--}}
            <a href="{{$video->path}}"><div>

                    <button class="play-card" id="icon-{{$video->id}}"><i class="icon-play" ></i></button>
                    <video poster="{{thumbnail($video->image->path,'common')}}" id="video-{{$video->id}}"
                           src="{{$video->media->path}}">
                    </video>
                </div></a>
            <div class="over-video">
                <a href="{{$video->category->path}}"><div class="title d-inline-block">
                        <img
                                src="{{thumbnail($video->category->image->path,'category-logo')}}"
                                alt="{{$video->category->name}}">
                        <span class="second-title-font">{{$video->category->name}}</span>
                    </div></a>
                <div class="hover-card  d-inline-block ">
                    <div class="social-icon" data-youtube="{{$video->media->path}}" data-url="{{$video->path}}" data-title="{{$video->title}}">
                        <a href="javascript:void(0)"><i class="icon-youtube youtube shareBtn"></i></a>
                        <a href="javascript:void(0)"><i class="icon-facebook facebook shareBtn"></i></a>
                        <a href="javascript:void(0)"><i class="icon-twitter twitter shareBtn"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="title-card clearfix">
            <a href="{{$video->path}}"><p class="second-title-font ">
                    {{$video->title}}
                </p></a>
        </div>
    </div>
@endforeach