@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__project.css" />
@endsection
    <main id="main">
        <section class="page__project">
            <div class="container">
                <h1 class="title__global">
                    {{$dataSeo->meta_title}}
                </h1>
                <ul class="control-list">
                    @foreach($cateProject as $k => $item)
                    <li class="control-list__item @if($k==0) active @endif">
                        <a href="{{route('home.cate-projects',$item->slug)}}">
                            {{$item->name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="project__group grid">
                    @foreach($data as $item)
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