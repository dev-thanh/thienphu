<?php 
	if(!empty($dataSeo)){
      	$content = json_decode($dataSeo->content);
   	}
?>
@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__product.css" />
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__project.css" />
@endsection
    <main id="main">
        <section class="breadcrumb-group">
            <div class="container">
                <ul class="breadcrumb">
                    <li>
                        <a href="index.html">
                            <img src="{{ __BASE_URL__ }}/icons/icon__home.svg" alt="icon__home.svg">
                        </a>
                    </li>
                    
                    <li>
                        <p>Tìm kiếm</p>
                    </li>
                </ul>
            </div>
        </section>
        @if(count($products) || count($projects))
            <h2 style="padding-top: 30px;text-align: center;font-size: 22px">Kết quả tìm kiếm</h2>
            @if(count($products))
            <section class="page__product-1">
                <div class="container">
                    <h2 style="padding: 14px 0px">Sản phẩm</h2>
                    <div class="product__group ">
                        @foreach($products as $item)
                        <a href="{{route('home.single-product',$item->slug)}}" class="product__item data1 data1" title="{{$item->name}}">
                            <div class="product__img">
                                <div class="frame">
                                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
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

            @if(count($projects))
            <section class="page__project">
                <div class="container">
                    <h2 style="padding: 14px 0px">Dự án</h2>
                    <div class="project__group grid ">
                        @foreach($projects as $item)
                        <a href="{{route('home.single-project',$item->slug)}}" title="{{$item->name}}" class="project__item data1">
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
                                {!! $item->desc !!}
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif
        @else
            <section class="page__product-1">
                <div class="container">
                    <div class="no-result">
                        Không tìm thấy kết quả nào
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
@section('script')
    <script type="text/javascript">
	    $(document).ready(function() {
            $("select.cate__products__select").change(function(){

                const baseUrl = $('#base_url').val();

                var value = $(this).val();

                window.location = baseUrl+'/danh-muc-san-pham/'+value;
            });
        });
    </script>
@endsection