@extends('frontend.master')
@section('main')
    <main id="content-wapper">
        <!-- banner -->
        <?php $banner = $data->image !='' ? $data->image : $dataSeo->image; ?>
        <section id="banner-featured_page" class="fadeIn wow" data-wow-delay="0.2s">
            <img src="{{url('/').$banner}}" alt="bannerchild">
            <div class="background-overlay">
                <div class="container">
                    <h2 class="title-featured_page">{{$data->name}}</h2>
                </div>
            </div>
        </section>
        <div class="archive-posts">
            <div class="background-overlay">
                <div class="container">
                    <div class="page-breadcrumb">
                        <ul class="list-page-breadcrumb">
                            <li><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><a href="{{route('home.products')}}">Sản phẩm</a></li>
                            <li><span>{{$data->name}}</span></li>
                        </ul>
                    </div>
                    <div class="row content-archive-products">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 sidebar-archive_products">
                            <h3 class="tit-archive_products">{{$data->name}}</h3>
                            <ul class="menu-categories">
                                @foreach($category as $item)
                                @if($item->parent_id==0)
                                <?php 
                                    $cateChild = $item->get_child_cate()->get();
                                    $idArray = $cateChild->pluck('id')->toArray();
                                ?>
                                <li class=" @if(in_array($data->id,$idArray)) open @endif @if($data->id == $item->id) active @endif">
                                    <a href="{{route('home.cate-product',$item->slug)}}">{{$item->name}}</a>
                                    <ul class="sub-menu" @if(in_array($data->id,$idArray) || $item->id==$data->id) class="open" style="display:block" @endif>
                                        @foreach($cateChild as $val)    
                                        <li @if($data->id == $val->id) class="active" @endif><a href="{{route('home.cate-product',$val->slug)}}">{{$val->name}}</a></li>
                                        @endforeach   
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 main-archive_products">
                            <div class="sorting-products">
                                <p class="txt-sorting-products">Sắp Xếp:</p>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected>Mới nhất</option>
                                    <option value="1">Giá tăng dần</option>
                                    <option value="2">Giá giảm dần</option>
                                </select>
                            </div>
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
                                    <li @if($curent_page == $i+1) class="active @endif"><a href="{{url()->current()}}?page={{$i+1}}" @if($curent_page == $i+1) onclick="return false;" @endif>{{$i+1}}</a></li>
                                    @endfor
                                </ul>
                            </div>
                            @else
                            <div class="content-no_products">
                                Sản phẩm đang được cập nhật
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection