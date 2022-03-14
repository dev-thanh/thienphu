@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/detail__project-news.css" />
@endsection
    <main id="main">
        <section class="breadcrumb-group">
            <div class="container">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{route('home')}}">
                            <img src="{{ __BASE_URL__ }}/icons/icon__home.svg" alt="icon__home.svg">
                        </a>
                    </li>
                    <li>
                        <a href="{{route('home.news')}}">
                            Tin tức
                        </a>
                    </li>
                    <li>
                        <p>{{$data->name}}</p>
                    </li>
                </ul>
            </div>
        </section>

        @if(count($postHot))
        <section class="detail__news">
            <div class="container">
                <div class="project__news-group">
                    <div class="project__news-content">
                        {!! $data->content !!}
                    </div>
                    <div class="project__news-sidebar">
                        <h2 class="sidebar-title">
                            Tin tức nổi bật
                        </h2>
                        <div class="sidebar-content">
                            @foreach($postHot as $item)
                            <a href="{{route('home.single-news',$item->slug)}}" title="{{$item->name}}" class="project__item ">
                                <div class="frame">
                                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                </div>
                                <div class="project__box">
                                    <h2 class="project__title">
                                        {{$item->name}}
                                    </h2>
                                    <div class="time">
                                        <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="icon__time.svg"> 
                                        {{arrayGetDay(Carbon\Carbon::parse($item->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <input type="hidden" class="current_page" value="1">
                        @if($postHot->lastPage() > 1)
                        <button class="btn btn__view load_more_item" data-type="posts" data-id="{{$data->id}}" data-lastpage="{{$postHot->lastPage()}}">
                            Xem thêm
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(count($postSame))
        <section class="news__related">
            <div class="container">
                <h2 class="related-title">
                    Tin tức liên quan
                </h2>
                <div class="related-slide">
                    @foreach($postSame as $itemp)
                    <a href="{{route('home.single-news',$item->slug)}}" title="{{$item->name}}" class="project__item ">
                        <div class="frame">
                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                        </div>
                        <div class="time">
                            <img src="{{ __BASE_URL__ }}/icons/icon__time.svg" alt="icon__time.svg">
                            {{arrayGetDay(Carbon\Carbon::parse($item->created_at)->format('l'))}} {{format_datetime($item->created_at,'d/m/Y')}}
                        </div>
                        <h2 class="project__title">
                            {{$item->name}}
                        </h2>
                        <div class="project__desc">
                            {{$item->desc}}
                        </div>
                    </a>
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
            $('.related-slide').slick({
                dots: true,
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            })
        })
    </script>
    <script type="module" src="{{ __BASE_URL__ }}/js/custom.js"></script>
@endsection
