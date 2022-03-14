@extends('frontend.master')
@section('main')
    <main id="content-wapper">
        <!-- banner -->
        <section id="banner-featured_page" class="fadeIn wow" data-wow-delay="0.2s">
            <img src="{{url('/').$data->image}}" alt="bannerchild">
            <div class="background-overlay">
                <div class="container">
                    <h2 class="title-featured_page">{{$data->name}}</h2>
                    <p class="desc-featured_page">{{$data->desc}}</p>
                </div>
            </div>
        </section>
        <div class="archive-posts">
            <div class="background-overlay">
                <div class="container">
                    <div class="page-breadcrumb">
                        <ul class="list-page-breadcrumb">
                            <li><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><span>{{$data->name}}</span></li>
                        </ul>
                    </div>
                    <div class="row content-archive-posts">
                        @foreach($posts as $item)
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 colums-posts">
                            <div class="box-posts">
                                <div class="img-posts">
                                    <a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">
                                        <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                    </a>
                                    <div class="ovrly"></div>
                                    <div class="details-posts">
                                        <a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">Xem chi tiết</a>
                                    </div>
                                </div>
                                <div class="infor-posts">
                                    <p class="date-posts">{{format_datetime($item->created_at,'d/m/Y')}}</p>
                                    <h3 class="name-posts"><a href="{{route('home.single-news',['id'=>$item->id,'slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if(count($posts))
                    <?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
                    <div class="page-pagination">
                        <ul class="list-page-pagination">
                            @for($i = 0; $i < $posts->lastpage(); $i++)
                            <li @if($curent_page == $i+1) class="active @endif"><a href="{{url()->current()}}?page={{$i+1}}" @if($curent_page == $i+1) onclick="return false;" @endif>{{$i+1}}</a></li>
                            @endfor
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection