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
        <section class="breadcrumb-group">
            <div class="container">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{route('home')}}">
                            <img src="{{ __BASE_URL__ }}/icons/icon__home.svg" alt="icon__home.svg">
                        </a>
                    </li>
                    <li>
                        <a href="{{route('home.rooms')}}">
                            {{$dataSeo->meta_title}}
                        </a>
                    </li>
                    <li>
                        <p>{{$cateDetail->name}}</p>
                    </li>
                </ul>
            </div>
        </section>
        <section class="page__zoom">
            <div class="container">
                <div class="page__zoom-group">
                    @foreach($data as $item)
                    <div class="page__zoom-item">
                        <div class="page__zoom-img">
                            <div class="page__zoom-left">
                                <div class="frame">
                                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                                </div>
                            </div>
                            @if(!empty($item->more_image))
                            <div class="page__zoom-right">
                                @php
                                    $images = json_decode($item->more_image);
                                @endphp
                                @foreach($images as $image)
                                    <div class="frame">
                                        <img src="{{url('/').$image}}" alt="{{$item->name}}">
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="page__zoom-title">
                            {{$item->name}}
                        </div>
                        <div class="page__zoom-desc">
                            {{$item->desc}}
                        </div>
                        <a href="{{route('home.single-room',$item->slug)}}" class="btn btn__view"> Xem chi tiết</a>
                    </div>
                    @endforeach
                </div>

                @if($data->lastpage() > 1)
                <?php $curent_page = request()->get('page') ? request()->get('page') : '1'; ?>
                <ul class="addon__pagination">
                    <li class="addon__pagination-item">
                        <a href="{{url()->current()}}?page={{$curent_page-1}}" @if($curent_page==1) onclick="return false;" @endif class="addon__pagination-item-link">
                            <i class="fa fa-angle-left" aria-hidden="true" aria-hidden="true"></i>
                        </a>
                    </li>
                    @for($i = 0; $i < $data->lastpage(); $i++)
                    <li class="addon__pagination-item @if($curent_page == $i+1) active @endif">
                        <a href="{{url()->current()}}?page={{$i+1}}" @if($curent_page==$i+1) onclick="return false;" @endif class="addon__pagination-item-link" title="{{$i+1}}">{{$i+1}}</a>
                    </li>
                    @endfor
                    <li class="addon__pagination-item">
                        <a href="{{url()->current()}}?page={{$curent_page+1}}" @if($curent_page == $data->lastpage()) onclick="return false;" @endif class="addon__pagination-item-link">
                            <i class="fa fa-angle-right" aria-hidden="true" aria-hidden="true"></i>
                        </a>
                    </li>`
                </ul>
                @endif
            </div>
        </section>
    </main>
@endsection