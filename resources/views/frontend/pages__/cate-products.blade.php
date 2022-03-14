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
        <section class="breadcrumb-group">
            <div class="container">
                <ul class="breadcrumb">
                    <li>
                        <a href="index.html">
                            <img src="{{ __BASE_URL__ }}/icons/icon__home.svg" alt="icon__home.svg">
                        </a>
                    </li>
                    <li>
                        <a href="{{route('home.products')}}">
                            Sản phẩm
                        </a>
                    </li>
                    <li>
                        <p>{{!empty($data) ? @$data->name : 'Tất cả'}}</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="page__product-1">
            <div class="container">
                <div class="category-list">
                    <p>Danh mục</p>
                    <select class=" custom-select info-select cate__products__select">
                        @foreach($category as $item)
                        <option value="{{$item->slug}}" @if($item->id == @$data->id) selected @endif>{{$item->name}}</option>
                        @endforeach
                        <option value="all" @if($slug=='all') selected @endif>Tất cả</option>
                    </select>
                </div>
                <div class="product__group ">
                    @if(count($products))
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
                    @else
                        <div class="no-product">Sản phẩm đang được cập nhật</div>
                    @endif
                </div>
                @if($products->lastpage() > 1)
                <?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
                <ul class="addon__pagination">
                    <li class="addon__pagination-item">
                        <a href="{{url()->current()}}?page={{$curent_page-1}}" @if($curent_page==1) onclick="return false;" @endif class="addon__pagination-item-link">
                            <i class="fa fa-angle-left" aria-hidden="true" aria-hidden="true"></i>
                        </a>
                    </li>
                    @for($i = 0; $i < $products->lastpage(); $i++)
                    <li class="addon__pagination-item @if($curent_page == $i+1) active @endif">
                        <a href="{{url()->current()}}?page={{$i+1}}" @if($curent_page==$i+1) onclick="return false;" @endif class="addon__pagination-item-link" title="{{$i+1}}">{{$i+1}}</a>
                    </li>
                    @endfor
                    <li class="addon__pagination-item">
                        <a href="{{url()->current()}}?page={{$curent_page+1}}" @if($curent_page == $products->lastpage()) onclick="return false;" @endif class="addon__pagination-item-link">
                            <i class="fa fa-angle-right" aria-hidden="true" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
                @endif
            </div>
        </section>
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