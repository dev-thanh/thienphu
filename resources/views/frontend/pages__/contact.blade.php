<?php 
	if(!empty($dataSeo)){
      	$content = json_decode($dataSeo->content);
   	}
?>
@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__contact.css" />
    <link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/toastr.min.css" />
@endsection
    <main id="main">
        @if(count($slider))
        <section class="addon__banner">
            @foreach($slider as $item)
            <div class="banner__item">
                <div class="frame">
                    <img src="{{url('/').$item->image}}" alt="{{$item->name}}">
                </div>
            </div>
            @endforeach
        </section>
        @endif

        <section class="page__contact">
            <div class="container">
                <div class="page__contact-group">
                    <div class="contact__about-us">
                        <h1 class="page__contact-title">
                            {{@$content->title}}
                        </h1>
                        <p>
                            {!! @$content->desc !!}
                        </p>

                        <ul class="page__contact-info">
                            <li>
                                <img src="{{ __BASE_URL__ }}/icons/icon__phone.svg" alt="icon__phone.svg">
                                <p>
                                    {{@$content->phone}}
                                </p>
                            </li>
                            <li>
                                <img src="{{ __BASE_URL__ }}/icons/icon__mail-1.svg" alt="icon__mail-1.svg">
                                <p>
                                    Email: {{@$content->email}}
                                </p>
                            </li>
                            <li>
                                <img src="{{ __BASE_URL__ }}/icons/icon__add.svg" alt="icon__add.svg">
                                <p>
                                    {{@$content->address}}
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="page__contact-form">
                        <h2 class="title__global">
                            {{@$content->title_form}}
                        </h2>
                        <div class="desc__global">
                            {{@$content->desc_form}}
                        </div>
                        <form class="form__register-global" action="{{route('home.post-contact')}}" method="POST">
                            @csrf
                            <div class="form__box">
                                <input type="text" placeholder="Họ và tên" class="input__control" name="name">
                                <span class="fr-error fr-error_name"></span>
                            </div>
                            <div class="form__box">
                                <input type="text" placeholder="Số điện thoại" class="input__control" name="phone">
                                <span class="fr-error fr-error_phone"></span>
                            </div>
                            <div class="form__box">
                                <input type="text" placeholder="Email" class="input__control" name="email">
                                <span class="fr-error fr-error_email"></span>
                            </div>
                            <div class="form__box">
                                <input type="text" placeholder="Tiêu đề" class="input__control" name="title">
                                <span class="fr-error fr-error_title"></span>
                            </div>
                            <div class="form__box textarea">
                                <textarea placeholder="Lời nhắn" class="input__control" name="content"></textarea>
                                <span class="fr-error fr-error_content"></span>
                            </div>
                            <button type="button" class="btn btn__register btn__send__contact">
                                Đăng ký
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="map">
            <h2 class="title__global">
                Bản đồ
            </h2>
            {!! @$content->googlemap !!}
        </section>

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
    <script type="module">
        import addonBanner from "{{ __BASE_URL__ }}/js/addons/addon-banner.js";
        addonBanner();
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
	    });
    </script>
@endsection