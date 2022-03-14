@extends('frontend.master')
@section('main')
<main id="content-wapper">
    <div class="archive-videos">
        <div class="background-overlay">
            <div class="container">
                <div class="page-breadcrumb">
                    <ul class="list-page-breadcrumb">
                        <li><a href="index.html">Trang chủ</a></li>
                        <li><span>Video</span></li>
                    </ul>
                </div>
                <div class="row content-archive-videos">
                    @foreach($data as $item)
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 colums-videos">
                        <div class="img-videos">
                            <a href="{{$item->url}}" class="swipebox popup-youtube">
                            <img src="{{$item->image}}" alt="{{$item->name}}">
                            <span class="play_video"><i class="fa fa-play"></i></span>
                            </a>
                        </div>
                        <p class="name-videos">{{$item->name}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection