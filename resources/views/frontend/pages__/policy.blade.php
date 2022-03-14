@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/detail__project-news.css" />
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
                        <p>{{$data->name}}</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="detail__news">
            <div class="container">
                <div class="project__news-group">
                    <div class="project__news-content" style="margin: auto">
                        {!! $data->content !!}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
