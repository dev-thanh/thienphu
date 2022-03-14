@extends('frontend.master')
@section('main')
<main id="content-wapper">
    <!-- banner -->
    <div class="single-product">
        <div class="background-overlay">
            <div class="container">
                <div class="page-breadcrumb">
                    <ul class="list-page-breadcrumb">
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li><a href="{{route('home.products')}}">Sản phẩm</a></li>
                        <li><span>{{$data->name}}</span></li>
                    </ul>
                </div>
                <div class="row content-single-products">
                    @if(!empty($data->more_image))
                    <?php
                        $images = json_decode($data->more_image);
                         ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 gallery-single_products">
                        <div id="details_product_large" class="owl-carousel owl-theme">
                            @foreach($images as $image)
                            @if(str_contains($image,'__video__')) 
                            <?php 
                                $fileName = explode('__video__', $image);
                                $image = $data->image; 
                                ?>  
                            <div class="items-gallery_pr">          
                                <a class="swipebox  popup-youtube" href="{{url('/').@$fileName[1]}}">
                                <img src="{{url('/').$image}}" alt="product">
                                <span class="play"></span>
                                </a>
                            </div>
                            @else
                            <div class="items-gallery_pr">          
                                <img src="{{url('/').$image}}" alt="product">    
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div id="details_product_thumb" class="owl-carousel owl-theme">
                            @foreach($images as $image)
                            @if(str_contains($image,'__video__'))       
                            <?php
                                $image = $data->image; 
                                ?> 
                            @endif
                            <div class="items-gallery_pr">          
                                <img src="{{url('/').$image}}" alt="product">    
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 entry-summary">
                        @if(!empty($data->sku))
                        <p class="sku-products">MODEL: {{$data->sku}}</p>
                        @endif
                        <h3 class="tit-single-products">{{$data->name}}</h3>
                        <p class="price-single-products">{{!empty($data->price) ? number_format($data->price,0, '.', '.') : 'Giá: Liên hệ' }}</p>
                        <div id="thongso_kythuat">
                            {!! $data->desc !!}
                        </div>
                        <div class="button-navbar-product">
                            <a class="btn btn-primary contact-buynow" href="#">Liên hệ mua hàng</a>
                            @if(!empty($data->file))
                            <?php $file = json_decode($data->file); ?>
                            @endif
                            @if(!empty(@$file->url))
                            <a class="btn btn-light download-specifications" href="{{$file->url}}" download><i class="fal fa-cloud-download"></i>Tải thông số kỹ thuật</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="information-products">
                    <h3 class="tit-information-products">Thông tin sản phẩm</h3>
                    <div class="entry-single-products">
                        {!! $data->content !!}
                    </div>
                </div>
                @if(count($productSame))
                <div class="related_products">
                    <h3 class="tit-related-product">Sản phẩm liên quan</h3>
                    <div class="row content-related_products">
                        @foreach($productSame as $item)
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 colums-products">
                            <div class="box-products">
                                <div class="img-products">
                                    <a href="{{route('home.single-product',$item->slug)}}">
                                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                    </a>
                                </div>
                                <h3 class="name-products"><a href="{{route('home.single-product',$item->slug)}}">{{$item->name}}</a></h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection