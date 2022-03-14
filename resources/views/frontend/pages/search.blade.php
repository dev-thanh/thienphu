@extends('frontend.master')
@section('main')
    <main id="content-wapper">
        <section id="banner-featured_page" class="fadeIn wow" data-wow-delay="0.2s">
            <img src="{{url('/').$dataSeo->image}}" alt="bannerchild">
            <div class="background-overlay">
                <div class="container">
                    <h2 class="title-featured_page">Tìm kiếm</h2>
                </div>
            </div>
        </section>
        <div class="archive-posts">
            <div class="background-overlay">
                <div class="container">
                    <div class="page-breadcrumb">
                        <ul class="list-page-breadcrumb">
                            <li><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><a title="Tìm kiếm">Tìm kiếm</a></li>
                        </ul>
                    </div>
                    <div class="row content-archive-products">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 main-archive_products">
                            @if(count($products))
                            <div class="row content-archive_products">
                                @foreach($products as $item)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 colums-products">
                                    <div class="box-products">
                                        <div class="img-products">
                                            <a href="{{route('home.single-product',['slug'=>$item->slug])}}">
                                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                            </a>
                                        </div>
                                        <h3 class="name-products"><a href="{{route('home.single-product',['slug'=>$item->slug])}}">{{$item->name}}</a></h3>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
                            <div class="page-pagination">
                                <ul class="list-page-pagination">
                                    @for($i = 0; $i < $products->lastpage(); $i++)
                                    <li @if($curent_page == $i+1) class="active @endif"><a href="{{url()->current()}}?search={{request()->search}}&page={{$i+1}}" @if($curent_page == $i+1) onclick="return false;" @endif>{{$i+1}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                            @else
                            <div class="content-no_products">
                                Không tìm thấy kết quả nào
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection