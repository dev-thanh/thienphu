@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__news.css" />
@endsection
<main id="main">
    <section class="page__news">
        <div class="container">
            <h1 class="title__global">
                {{@$dataSeo->meta_title}}
            </h1>
            @if(isset($posts[0]))
            <div class="hot__news">
                <div class="hot__news-img">
                    <div class="frame">
                        <img src="{{url('/').$posts[0]->image}}" alt="{{$posts[0]->name}}">
                    </div>
                </div>
                <div class="hot__news-group">
                    <div class="hot__news-tag">
                        New
                    </div>
                    <div class="time">
                        <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="time">
                        {{arrayGetDay(Carbon\Carbon::parse($posts[0]->created_at)->format('l'))}} {{format_datetime($posts[0]->created_at,'d/m/Y')}}
                    </div>
                    <a href="{{route('home.single-news',$posts[0]->slug)}}" class="hot__news-title">
                        {{$posts[0]->name}}
                    </a>
                    <div class="hot__news-desc">
                        {{$posts[0]->desc}}
                    </div>
                    <a href="{{route('home.single-news',$posts[0]->slug)}}" class="news-link">
                        Xem chi tiết
                        <img src="{{ __BASE_URL__ }}/icons/icon__link-prev.svg" alt="icon__link-prev.svg">
                    </a>
                </div>
            </div>
            @endif
            <div class="news__group">
                @foreach($posts as $k => $item)
                    @if($k !=0)
                    <a href="{{route('home.single-news',$item->slug)}}" class="news-item" title="{{$item->name}}">
                        <div class="news__img">
                            <div class="frame">
                                <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                            </div>
                        </div>
                        <div class="time">
                            <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="time"> 
                            {{arrayGetDay(Carbon\Carbon::parse($item->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
                        </div>
                        <h3 class="news__title">
                            {{$item->name}}
                        </h3>
                        <div class="news__desc">
                            {{$item->desc}}
                        </div>
                        <button class="btn news-link">
                            Xem chi tiết
                            <img src="{{ __BASE_URL__ }}/icons/icon__link-prev.svg" alt="icon__link-prev.svg">
                        </button>
                    </a>
                    @endif
                @endforeach
            </div>
            @if($posts->lastpage() > 1)
            <?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
            <ul class="addon__pagination">
                <li class="addon__pagination-item">
                    <a href="{{url()->current()}}?page={{$curent_page-1}}" @if($curent_page==1) onclick="return false;" @endif class="addon__pagination-item-link">
                        <i class="fa fa-angle-left" aria-hidden="true" aria-hidden="true"></i>
                    </a>
                </li>
                @for($i = 0; $i < $posts->lastpage(); $i++)
                <li class="addon__pagination-item @if($curent_page == $i+1) active @endif">
                    <a href="{{url()->current()}}?page={{$i+1}}" @if($curent_page==$i+1) onclick="return false;" @endif class="addon__pagination-item-link" title="{{$i+1}}">{{$i+1}}</a>
                </li>
                @endfor
                <li class="addon__pagination-item">
                    <a href="{{url()->current()}}?page={{$curent_page+1}}" @if($curent_page == $posts->lastpage()) onclick="return false;" @endif class="addon__pagination-item-link">
                        <i class="fa fa-angle-right" aria-hidden="true" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            @endif
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
    <script>
        $(document).ready(function() {
            $('.partner__slider').slick({
                dots: true,
                arrows: false,
                slidesToShow: 5,
                autoplay: true,
                infinite: true,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            });
        })
    </script>
@endsection