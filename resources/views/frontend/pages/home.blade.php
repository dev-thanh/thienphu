<?php 
	if(!empty($contentHome)){
      	$content = json_decode($contentHome->content);
   	}
?>
@extends('frontend.master')
@section('main')
    <main id="content-wapper">
        @if(count($slider))
        <section id="section-banner" class="fadeIn wow" data-wow-delay="0.2s">
        <div class="background-overlay">
            @if(!empty(@$site_info->discount))
            <div class="breaking-bar hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();"> 
                                @foreach($site_info->discount as $item)    
                                    <a href="{{@$item->link}}">{!! @$item->name !!} </a> 
                                @endforeach
                            </marquee>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div id="banner-carousel" class="owl-carousel owl-theme">
                @foreach($slider as $item)
                <div class="items-banner-slider">
                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                </div>
                @endforeach
            </div>
        </div>
        </section>
        @endif
        <!-- SP nổi bật -->
        @if(count($cateHome))
        <section id="section-featured" class="fadeIn wow" data-wow-delay="0.2s">
            <div class="background-overlay">
                <div class="container">
                    <div class="row content-featured">
                        @foreach($cateHome as $item)
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="box-product-featured">
                                <div class="img-product-featured">
                                    <a href="{{route('home.cate-product',['slug'=>$item->slug])}}">
                                        <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                    </a>
                                </div>
                                <h3 class="name-product-featured"><a href="{{route('home.cate-product',['slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
       @endif
        <!-- SP -->
        <section id="section-product" class="fadeIn wow" data-wow-delay="0.2s">
            <div class="background-overlay">
                <div class="container">
                    <h2 class="title-section"><span>Sản phẩm</span></h2>
                    <div id="product-carousel" class="owl-carousel owl-theme">
                        @foreach($products as $item)
                        <div class="items-products">
                            <div class="box-products">
                                <div class="img-products">
                                    <a href="{{route('home.single-product',$item->slug)}}" title="{{$item->name}}">
                                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                    </a>
                                </div>
                                <h3 class="name-products"><a href="{{route('home.single-product',$item->slug)}}" title="{{$item->name}}">{{$item->name}}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog -->
        <section id="section-blog" class="fadeIn wow" data-wow-delay="0.2s">
            <div class="background-overlay">
                <div class="container">
                    <div class="row content-blog">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 video-blog">
                            <div class="box-video-blog">
                                <h2 class="title-section"><span><i class="fa fa-video"></i> Video clip</span></h2>
                                <div class="inner-video-blog">
                                    @foreach($videos as $video)
                                    <div class="items-videos">
                                        <div class="img-videos">
                                            <a href="{{$video->url}}" class="swipebox popup-youtube">
                                            <img src="{{$video->image}}" alt="{{$video->name}}">
                                            <span class="play_video"><i class="fa fa-play"></i></span>
                                            </a>
                                        </div>
                                        <p class="name-videos">{{$video->name}}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 news-blog">
                            <div class="box-news-blog">
                                <h2 class="title-section"><span><i class="fa fa-newspaper"></i> Tin tức</span></h2>
                                <div class="inner-news-blog">
                                    @foreach($newsHot as $item)
                                    <div class="items-posts">
                                        <div class="img-posts">
                                            <a href="chi-tiet-tin-tuc.html">
                                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                            </a>
                                        </div>
                                        <div class="infor-posts">
                                            <p class="name-posts"><a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">{{$item->name}}</a></p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 location-blog">
                            <div class="box-location-blog">
                                <h2 class="title-section"><span><i class="fa fa-map-marker-alt"></i> Hệ thống</span></h2>
                                <div class="inner-location-blog">
                                    @foreach($site_info->address->list as $item)
                                    <div class="items-location">
                                        <h3 class="name-location">{!! @$item->title !!}</h3>
                                        <p class="address-location">{!! @$item->address !!}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- SP -->
        <section id="section-project" class="fadeIn wow" data-wow-delay="0.2s">
            <div class="background-overlay">
                <div class="container">
                    <h2 class="title-section"><span>Dự án tiêu biểu</span></h2>
                    <div id="project-carousel" class="owl-carousel owl-theme">
                        @foreach($newsTb as $item)
                        <div class="items-project">
                            <div class="box-project">
                                <div class="img-project">
                                    <a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">
                                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                    </a>
                                </div>
                                <h3 class="name-project"><a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection