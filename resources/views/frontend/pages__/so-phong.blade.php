<?php 
    if(!empty($dataSeo)){
        $content = json_decode($dataSeo->content);
    }
?>
@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__zoom.css" />
@endsection
    <main id="main">
        <section class="page__zoom">
            <div class="container">
                <h1 class="title__global">
                    {{@$data->name}}
                </h1>
                <div class="desc__global">
                    {{@$data->desc}}
                </div>
                <div class="page__zoom-group">
                    @foreach($projects as $item)
                    <div class="page__zoom-item" id="zoom-{{$item->id}}">
                        <div class="page__zoom-img">
                            <div class="page__zoom-left">
                                <div class="page__zoom-left-item">
                                    <div class="frame">
                                        <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                    </div>
                                </div>

                                <?php $images = collect(); ?>

                                @if(!empty($item->more_image))

                                    <?php $images = json_decode($item->more_image); ?>
                                    
                                @endif
                                @foreach($images as $image)
                                    <div class="page__zoom-left-item">
                                        <div class="frame">
                                            <img src="{{url('/').$image}}" alt="zooms-1.png">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if(!empty($item->more_image))
                            <div class="page__zoom-right">
                                <div class="page__zoom-right-item">
                                    <div class="frame">
                                        <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                    </div>
                                </div>
                                @foreach($images as $image)
                                <div class="page__zoom-right-item">
                                    <div class="frame">
                                        <img src="{{url('/').$image}}" alt="{{$item->name}}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="page__zoom-title">
                            {{$item->name}}
                        </div>
                        <div class="page__zoom-desc">
                            {!! $item->sort_desc !!}
                        </div>
                        <a href="{{route('home.single-room',$item->slug)}}" class="btn btn__view"> Xem chi tiết</a>
                    </div>
                    @endforeach
                </div>

                @if($projects->lastpage() > 1)
                <?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
                <ul class="addon__pagination">
                    <li class="addon__pagination-item">
                        <a href="{{url()->current()}}?page={{$curent_page-1}}" @if($curent_page==1) onclick="return false;" @endif class="addon__pagination-item-link">
                            <i class="fa fa-angle-left" aria-hidden="true" aria-hidden="true"></i>
                        </a>
                    </li>
                    @for($i = 0; $i < $projects->lastpage(); $i++)
                    <li class="addon__pagination-item @if($curent_page == $i+1) active @endif">
                        <a href="{{url()->current()}}?page={{$i+1}}" @if($curent_page==$i+1) onclick="return false;" @endif class="addon__pagination-item-link" title="{{$i+1}}">{{$i+1}}</a>
                    </li>
                    @endfor
                    <li class="addon__pagination-item">
                        <a href="{{url()->current()}}?page={{$curent_page+1}}" @if($curent_page == $projects->lastpage()) onclick="return false;" @endif class="addon__pagination-item-link">
                            <i class="fa fa-angle-right" aria-hidden="true" aria-hidden="true"></i>
                        </a>
                    </li>`
                </ul>
                @endif
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function slideZoom(a) {
                $(a + ' .page__zoom-left').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: a + ' .page__zoom-right'
                });
                $(a + ' .page__zoom-right').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: a + ' .page__zoom-left',
                    dots: false,
                    centerPadding: '0',
                    centerMode: false,
                    focusOnSelect: true,
                    vertical: true,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4,
                            vertical: false,

                        }
                    }, {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3,
                            vertical: false,

                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            vertical: false,
                        }
                    }]
                });

            }
            @foreach($projects as $item)
            slideZoom("#zoom-{{$item->id}}");
            @endforeach
        });
    </script>
@endsection