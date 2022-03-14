@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/detail__zoom.css" />
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
                            Số phòng
                        </a>
                    </li>
                    <li>
                        <p>{{$data->name}}</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="detail__zoom">
            <div class="container">
                <h1 class="detail__zoom-title">
                    {{$data->name}}
                </h1>
                <div class="detail__zoom-desc">
                    <ul>
                        @foreach($cateRoom as $item)
                        <li>{{$item->name}}</li>
                        @endforeach
                        <li>{{$data->city}}</li>
                        <li>{{format_datetime($data->created_at,'d-m-Y')}}</li>
                    </ul>
                </div>
                {!! $data->content !!}
            </div>
        </section>

        @if(count($roomSame))
        <section class="zoom__related">
            <div class="container">
                <h2 class="related-title">
                    Số phòng tương tự
                </h2>
                <div class="related-slide">
                    @foreach($roomSame as $item)
                    <a href="{{route('single-room',$item->slug)}}" title="{{$item->name}}" class="zoom__item ">
                        <div class="frame">
                            <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                        </div>
                        <h2 class="zoom__title">
                            {{$item->name}}
                        </h2>
                        <div class="zoom__desc">
                            {{$item->desc}}
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    </main>
@endsection