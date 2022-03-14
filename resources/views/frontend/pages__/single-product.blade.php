@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/detail__product.css" />
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
                        <a href="{{route('home.products')}}">
                            Sản phẩm
                        </a>
                    </li>
                    <li>
                        <p>{{@$data->name}}</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="detail__product">
            <div class="container">
                <div class="detail__product-group">
                    <div class="detail__product-slide-box">
                        <div class="detail__product-slide product1 active">
                            <?php if(!empty($data->more_image)){
                                $images = json_decode($data->more_image);
                            } ?>
                            <div class="slider-for">
                                @foreach($images as $image)
                                <div class="frame">
                                    <img src="{{url('/').$image}}" alt="{{$data->name}}">
                                </div>
                                @endforeach
                            </div>
                            <div class="slider-nav">
                                @foreach($images as $image)
                                <div class="frame">
                                    <img src="{{url('/').$image}}" alt="{{$data->name}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="detail__product-content">
                        <div class="detail__product-box">
                            <div class="detail__product-type">
                                Ghế sofa đơn
                            </div>
                            <h1 class="detail__product-title">
                                {{$data->name}}
                            </h1>
                            <div class="detail__product-code">
                                SKU: {{$data->sku}}
                            </div>
                        </div>
                        <div class="detail__product-box">
                            @if(!empty($data->price))
                            <div class="old-price">
                                {{$data->price}}
                            </div>
                            @endif
                            @if(!empty($data->price))
                            <div class="price">
                                {{$data->sale_price}}
                            </div>
                            @endif
                            <div class="detail__product-desc">
                                {{$data->desc}}
                            </div>
                        </div>
                        <?php if(!empty($data->content)){
                            $contents = json_decode($data->content);
                        } ?>
                        @if(!empty($contents->color))
                        <div class="detail__product-box">
                            <div class="color-title">
                                Màu sắc
                            </div>
                            <ul class="control-list ">
                                @foreach($contents->color as $color)
                                <li class="control-list__item @if($loop->first) active @endif" tab-show="#tab1" style="background-color: {{$color->value}};">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="detail__product-box">
                            <div class="material-size">
                                <h3>
                                    {{@$contents->title}}
                                </h3>
                                @if(!empty($contents->size))
                                {!! @$contents->size !!}
                                @endif
                            </div>
                        </div>
                        @if(!empty(@$contents->orther))
                        <div class="detail__product-box">
                            @foreach($contents->orther as $orther)
                            <div class="policy-item">
                                <img src="{{url('/').$orther->image}}" alt="{{$orther->title}}">
                                <p>
                                    {{@$orther->title}}
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        
        @if(count($productSame))
        <section class="product__related ">
            <div class="container">
                <h2 class="detail__title">
                    Sản phẩm liên quan
                </h2>
                <div class="detail__slide-global">
                    @foreach($productSame as $item)
                    <a href="{{route('home.single-product',$item->slug)}}" class="product__item data1 data1" title="{{$item->name}}">
                        <div class="product__img">
                            <div class="frame">
                                <img src="{{url('/').$item->image}}" alt="{{$item->image}}">
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
            </div>
        </section>
        @endif
        
        @if(count($productView))
        <section class="product__watched ">
            <div class="container">
                <h2 class="detail__title">
                    Đã xem gần đây
                </h2>
                <div class="detail__slide-global">
                    @foreach($productView as $item)
                    <a href="{{route('home.single-product',$item->slug)}}" class="product__item data1 data1" title="{{$item->name}}">
                        <div class="product__img">
                            <div class="frame">
                                <img src="{{url('/').$item->image}}" alt="{{$item->image}}">
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
            </div>

        </section>
        @endif
        </main>
@endsection
@section('script')
    <script src="{{ __BASE_URL__ }}/js/plugins/tab.js"></script>

    <script>
        $(document).ready(function() {
            function slideDetail() {
                $('.slider-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    asNavFor: '.slider-nav'
                });
                $('.slider-nav').slick({
                    slidesToShow: 4,
                    asNavFor: '.slider-for',
                    dots: false,
                    arrows: false,
                    centerPadding: 0,
                    focusOnSelect: true,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 3
                        }
                    }]
                });


            }
            slideDetail();

            $(".detail__slide-global").slick({
                slidesToShow: 4,
                dots: false,
                arrows: true,
                centerPadding: 0,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            });

            function hProduct() {
                var $grid = $('.detail__product-slide-box').isotope({});
                $grid.isotope({
                    filter: '.product1'
                });
                $('.color-list li').click(function() {
                    $('.color-list li').removeClass('active');
                    $(this).addClass('active');
                    var data = $(this).data('id');
                    $grid.isotope({
                        filter: '.' + data
                    });
                    var a = '.' + data;
                })
            }
            // hProduct();
        })
    </script>
@endsection