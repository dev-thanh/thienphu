<?php 
	if(!empty($dataSeo)){
      	$content = json_decode($dataSeo->content);
   	}
?>
@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__product.css" />
@endsection
    <main id="main">
        <section class="page__product">
            <div class="container">
                <h1 class="title__global">
                    Sản phẩm
                </h1>
                <div class="category-group">
                    @foreach($category as $item)
                    <a href="{{route('home.cate-product',$item->slug)}}" class="category-item" title="{{$item->name}}">
                        <div class="category-avatar ">
                            <div class="frame">
                                <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                            </div>
                        </div>
                        <div class="category-title">
                            {{$item->name}}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="hot__product">
            <div class="container">
                <h2 class="title__global">
                    Sản phẩm nổi bật
                </h2>
                <ul class="product-list control-list">
                    <li class="control-list__item product-list__item active" tab-show="#tab1">Sản phẩm mới</li>
                    <li class="control-list__item product-list__item" tab-show="#tab2">
                        Sản phẩm đánh giá tốt nhất
                    </li>
                    <li class="control-list__item product-list__item" tab-show="#tab3">
                        Sản phẩm bán chạy nhất
                    </li>
                </ul>
                <div class="product__group grid">
                    <div class="tab-item active" id="tab1">
                        <div class="product__box">
                        @foreach($productNew as $item)
                            <a href="{{route('home.single-product',$item->slug)}}" class="product__item" title="{{$item->name}}">
                                <div class="product__img">
                                    <div class="frame">
                                        <img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
                                    </div>
                                </div>
                                <div class="product-title">
                                    {{$item->name}}
                                </div>

                                <div class="product-price">
                                    @if(!empty($item->price))
                                    <div class="product__old-price">
                                        {{$item->price}}
                                    </div>
                                    @endif
                                    @if(!empty($item->sale_price))
                                    <div class="product-sale">
                                        {{$item->sale_price}}
                                    </div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @if($productNew->lastPage() > 1)
                        <input type="hidden" class="current_page" value="1">
                        <button class="btn btn__view btn__load__products" data-type="is_new" data-lastpage="{{$productNew->lastPage()}}">Xem thêm</button>
                        @endif
                    </div>
                    <div class="tab-item" id="tab2">
                        <div class="product__box">
                            @foreach($productReview as $item)
                            <a href="{{route('home.single-product',$item->slug)}}" class="product__item" title="{{$item->name}}">
                                <div class="product__img">
                                    <div class="frame">
                                        <img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
                                    </div>
                                </div>
                                <div class="product-title">
                                    {{$item->name}}
                                </div>

                                <div class="product-price">
                                    @if(!empty($item->price))
                                    <div class="product__old-price">
                                        {{$item->price}}
                                    </div>
                                    @endif
                                    @if(!empty($item->sale_price))
                                    <div class="product-sale">
                                        {{$item->sale_price}}
                                    </div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @if($productReview->lastPage() > 1)
                        <input type="hidden" class="current_page" value="1">
                        <button class="btn btn__view btn__load__products" data-type="review" data-lastpage="{{$productReview->lastPage()}}">Xem thêm</button>
                        @endif
                    </div>
                    <div class="tab-item" id="tab3">
                        <div class="product__box">
                        @foreach($productSelling as $item)
                            <a href="{{route('home.single-product',$item->slug)}}" class="product__item" title="{{$item->name}}">
                                <div class="product__img">
                                    <div class="frame">
                                        <img src="{{url('/').$item->image}}" alt="{{$item->name}}" />
                                    </div>
                                </div>
                                <div class="product-title">
                                    {{$item->name}}
                                </div>

                                <div class="product-price">
                                    @if(!empty($item->price))
                                    <div class="product__old-price">
                                        {{$item->price}}
                                    </div>
                                    @endif
                                    @if(!empty($item->sale_price))
                                    <div class="product-sale">
                                        {{$item->sale_price}}
                                    </div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @if($productSelling->lastPage() > 1)
                        <input type="hidden" class="current_page" value="1">
                        <button class="btn btn__view btn__load__products" data-type="selling" data-lastpage="{{$productSelling->lastPage()}}">Xem thêm</button>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @include('frontend.pages.item.partner')

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
    <script src="{{ __BASE_URL__ }}/js/plugins/tab.js"></script>

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

            $('.btn__load__products').click(function(e){

                const baseUrl = $('#base_url').val();

                const button = $(this);

                const type = $(this).data('type');

                const lastPage = $(this).data('lastpage');

                const _this = $(this).parents('.tab-item');

                const content = _this.find('.product__box');

                const _el = _this.find('.current_page');

                const currentPage = _el.val();

                const nextPage = parseFloat(currentPage) + 1;

                const loading = '<img height="25px" src="'+baseUrl+'/public/frontend/icons/loading.gif" />';

                button.html(loading);

                $.ajax({

                    type: 'GET',

                    url: baseUrl+'/ajax-load-products',

                    data: {type: type, page: nextPage},

                    success:function(data){
                        
                        _el.val(nextPage);

                        content.append(data);

                        if(lastPage == nextPage)
                        {
                            button.remove();
                        }

                        button.html('Xem thêm');
                    }
                });

            });
	    });
    </script>

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