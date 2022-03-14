<?php 
	if(!empty($dataSeo)){
      	$content = json_decode($dataSeo->content);
   	}
?>
@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" href="{{ __BASE_URL__ }}/css/pages/page__feng-shui.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
    <main id="main">
        <div class="page__feng-shui-title">
            <div class="page__feng-shui-container">
                <h1 class="title__global">
                    {{@$content->title}}
                </h1>
                <div class="desc__global">
                    {{@$content->desc}}
                </div>
            </div>
        </div>

        <section class="feng__shui-info">
            <div class="container">
                <form action="{{route('home.post-phongthuy')}}" method="POST" class="form__group">
                    @csrf
                    <div class="form__item">
                        <div class="form__box">
                            <div class="form__title">
                                Năm sinh
                            </div>

                            <select name="namsinh" class="info-select control__select2">
                                <option value="">--Năm sinh--</option>
                                @php $curYear = date('Y')-1; @endphp
                                @for($i=$curYear;$i >= 1900;$i--)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__box">
                            <div class="form__title">
                                Giới tính
                            </div>

                            <select name="gioitinh" class="info-select control__select2">
                                <option value="">--Giới tính--</option>
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form__item">
                        <div class="form__box">
                            <div class="form__title">
                                Hướng nhà
                            </div>
                            <select name="huongnha" class="info-select control__select2">
                                <option value="">-- Hướng nhà --</option> 
                                <option value="0">Nam</option> 
                                <option value="1">Tây Nam</option> 
                                <option value="2">Tây</option> 
                                <option value="3">Tây Bắc</option>
                                <option value="4">Bắc</option> 
                                <option value="5">Đông Bắc</option> 
                                <option value="6">Đông</option> 
                                <option value="7">Đông Nam</option> 
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn__view tracuu__phongthuy">
                        Xem quẻ
                    </button>
                </form>
            </div>
        </section>

        <section class="page__feng-shui">
            <div class="container">
                <div id="chitietphongthuy"></div>
                {!! @$content->content !!}
            </div>
        </section>

        @include('frontend.pages.item.partner')

    </main>
@endsection
@section('script')
    <script src="{{ __BASE_URL__ }}/js/plugins/slect2.js"></script>

    <script type="text/javascript" src="{{ __BASE_URL__ }}/js/custom.js"></script>

    <script>
        $(document).ready(function() {

            $(".info-select").select2();

            $('.tracuu__phongthuy:not(".disabled")').click(function(e){

                e.preventDefault();

                const el = $(this);
                
                const namsinh = el.parents('form').find('select[name="namsinh"]').val();

                const gioitinh = el.parents('form').find('select[name="gioitinh"]').val();

                const elNamsinh = el.parents('form').find('select[name="namsinh"]').parents('.form__item').find('.select2-selection--single');

                const elGioitinh = el.parents('form').find('select[name="gioitinh"]').parents('.form__item').find('.select2-selection--single');

                elNamsinh.removeClass('form-error');

                elGioitinh.removeClass('form-error');

                if(namsinh==''){

                    elNamsinh.addClass('form-error');

                    return false;
                }
                if(gioitinh==''){

                    elGioitinh.addClass('form-error');

                    return false;
                }

                const baseUrl = $('#base_url').val();

                const UrlPost =el.parents('form').attr('action');

                const data = el.parents('form').serialize();

                const loading = '<img src="'+baseUrl+'/public/frontend/icons/loading.gif" />';

                el.addClass('disabled');

                el.html(loading);

                $.ajax({

                    type: 'POST',

                    url: UrlPost,

                    data: data,

                    success:function(data){

                        el.removeClass('disabled');

                        console.log(data);

                        $('#chitietphongthuy').html(data);

                        el.html('Xem quẻ');

                    },error:function(){

                        el.html('Xem quẻ');

                    }

                });
                });
        })
    </script>
@endsection