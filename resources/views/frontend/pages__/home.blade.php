<?php 
	if(!empty($contentHome)){
      	$content = json_decode($contentHome->content);
   	}
?>
@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/index.css" />
@endsection
    <main id="main">
        @if(count($slider))
        <section class="addon__banner">
            @foreach($slider as $item)
            <div class="banner__item">
                <div class="frame">
                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                </div>
            </div>
            @endforeach
        </section>
        @endif

        <section class="home__service">
            <div class="container">
                <h2 class="title__global">
                    {{@$content->services->title}}
                </h2>
                <div class="bs-tab">
                    <ul class="control-list">
                        @foreach($cateServices as $key => $item)
                        <li class="control-list__item @if($key==1) active @endif" data-id="data{{$key+1}}">{{$item->name}}</li>
                        @endforeach
                    </ul>
                    <div class="tab-content grid">
                        @foreach($cateServices as $k => $item)
                        <div class="tab-item data{{$k+1}} @if($k==1) active @endif">
                            @if(!empty($item->desc))
                                @foreach(json_decode($item->desc) as $val)
                                <div class="service-item">
                                    <a href="#" class="service-link" title="{{@$val->title}}">
                                        <div class="frame">
                                            <img src="{{url('/').@$val->image}}" alt="{{@$val->title}}">
                                        </div>
                                        <p class="service__item-title">
                                            {{@$val->title}}
                                        </p>
                                    </a>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="actual__works">
            <div class="container">
                <h2 class="title__global">
                    {{@$content->project->title}}
                </h2>
                <div class="desc__global">
                    {{@$content->project->desc}}
                </div>
                <div class="actual__works-content">
                    @foreach($cateProjects as $item)
                    <a href="{{route('home.cate-projects',$item->slug)}}" class="actual__works-link" title="{{$item->name}}">
                        <div class="frame">
                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                        </div>
                        <div class="actual__works-title">
                            {{$item->name}}
                            <img src="{{ __BASE_URL__ }}/icons/icon__link-prev.svg" alt="icon__link-prev.svg">
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="home__product">
            <div class="container">
                <h2 class="title__global">
                    {{@$content->product->title}}
                </h2>
                <div class="desc__global">
                    {{@$content->product->desc}}
                </div>
                <div class="home__product-slider grid">
                    @foreach($productsHot as $item)
                    <div class="home__product-group">
                        <div class="home__product-content">
                            <a href="{{route('home.single-product',$item->slug)}}" class="home__product-title">
                                {{$item->name}}
                            </a>
                            <div class="home__product-desc">
                                {{$item->desc}}
                            </div>
                            @if(!empty($item->content))
                            <?php $contentProduct = json_decode($item->content); ?>
                                @if(!empty($contentProduct->color))
                                <ul class="color-list ">
                                    @foreach($contentProduct->color as $value)
                                    <li class="color-list__item @if ($loop->first) active @endif" style="background-color: {{$value->value}};"> </li>
                                    @endforeach
                                </ul>
                                @endif
                            @endif
                            <div class="home__product-call">
                                <div class="call-desc">
                                    Gọi điện đặt hàng ngay!
                                </div>
                                <a href="tel:{{@$site_info->hot}}" class="call-link">
                                    <div class="call__icon">
                                        <img src="{{ __BASE_URL__ }}/icons/icon__call.svg" alt="icon__call.svg">
                                    </div>
                                    <span>{{@$site_info->hotline}}</span>
                                </a>
                            </div>
                        </div>
                        <div class="home__product-item grid">
                            <div class="home__product-img">
                                <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        @include('frontend.pages.item.partner')

        <section class="home__exp">
            <div class="container">
                <h2 class="title__global">
                    {{@$content->news->title}}
                </h2>
                <div class="desc__global">
                    {{@$content->news->desc}}
                </div>
                <div class="home__exp-group">
                    @if(isset($newsHot[0]))
                    <div class="home__exp-box">
                        <div class="home__exp-first">
                            <a href="{{route('home.single-news',$newsHot[0]->slug)}}" class="home__exp-item" title="{{$newsHot[0]->name}}">
                                <div class="frame">
                                    <img src="{{url('/').$newsHot[0]->image}}" alt="{{$newsHot[0]->name}}">
                                </div>
                                <div class="home__exp-time">
                                    <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="icon__time.svg"> {{arrayGetDay(Carbon\Carbon::parse($newsHot[0]->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
                                </div>
                                <div class="home__exp-title">
                                    {{$newsHot[0]->name}}
                                </div>
                                <div class="home__exp-desc">
                                {{$newsHot[0]->desc}}
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="home__exp-box">
                        @foreach($newsHot as $k => $item)
                            @if($k!=0)
                            <a href="{{route('home.single-news',$item->slug)}}" class="home__exp-item" title="{{$item->name}}">
                                <div class="frame">
                                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                </div>
                                <div class="exp__item-box">
                                    <div class="home__exp-time">
                                        <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="{{$item->name}}"> {{arrayGetDay(Carbon\Carbon::parse($item->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
                                    </div>
                                    <div class="home__exp-title">
                                        {{$item->name}}
                                    </div>
                                    <div class="home__exp-desc">
                                    {{$item->desc}}
                                    </div>
                                </div>

                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <a href="{{route('home.news')}}">
                    <button class="btn btn__view">
                        Xem tất cả
                    </button>
                </a>
            </div>
        </section>
        @if(!empty($partner->content))
        <?php $partners = json_decode($partner->content); ?>
        <section class="partner__group">
            <div class="container">
                <h2 class="title__global">
                    {{$partner->name}}
                </h2>
                <div class="desc__global">
                    {!! @$partners->partner->desc !!}
                </div>
                <div class="partner__slider">
                    @foreach(@$partners->partner->content as $item)
                    <div class="partner-item">
                        <img src="{{url('/').@$item->image}}" alt="{{@$item->title}}" />
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>
@endsection
@section('script')
    <script src="{{ __BASE_URL__ }}/js/plugins/jquery.coundown.js"></script>
    <script src="{{ __BASE_URL__ }}/js/plugins/isotope.pkgd.js"></script>
    <script type="module">
        import addonBanner from "{{ __BASE_URL__ }}/js/addons/addon-banner.js";
        addonBanner();
        import index from "{{ __BASE_URL__ }}/js/addons/index.js";
        index();
    </script>

    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom.js"></script>

    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/toastr.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        });
    </script>
@endsection