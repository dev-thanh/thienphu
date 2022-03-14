@extends('frontend.master')
@section('main')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ __BASE_URL__ }}/css/toastr.min.css" />
@endsection
    <main id="content-wapper">
        <!-- banner -->
        <div id="contact_page">
            <div class="background-overlay">
                <div class="container">
                    <div class="page-breadcrumb">
                        <ul class="list-page-breadcrumb">
                            <li><a href="index.html">Trang chủ</a></li>
                            <li><span>Liên hệ</span></li>
                        </ul>
                    </div>
                    <div class="row content-contact_page">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 main-contact_page">
                            <h2 class="tit-contact_page">{!! @$site_info->company !!}</h2>
                            <div class="information-contact_page">
                            <p><strong>{!! @$site_info->dcft_text !!}</strong> {!! @$site_info->dcft !!}</p>
                            <p><strong>{!! @$site_info->xsx_text !!}</strong> {!! @$site_info->xsx !!}</p>
                            <p><strong>{!! @$site_info->nmsx_text !!}</strong> {!! @$site_info->nmsx !!}</p>
                            <p><strong>{!! @$site_info->tax_code_text !!}</strong> {!! @$site_info->tax_code !!}</p>
                            <p><strong>Hotline:</strong> {!! @$site_info->phone_footer !!}}</p>
                            <p><strong>Email:</strong> {!! @$site_info->email !!}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 form-contact_page">
                            <form id="form_contact" action="{{route('home.post-contact')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" id="InputName" name="name" aria-describedby="Họ tên" placeholder="Họ tên">
                                    <span class="fr-error fr-error_name"></span>
                                    <input type="email" class="form-control" id="InputPhone" name="phone" aria-describedby="Số điện thoại" placeholder="Số điện thoại">
                                    <span class="fr-error fr-error_phone"></span>
                                    <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="Email" placeholder="Email">
                                    <span class="fr-error fr-error_email"></span>
                                    <textarea class="form-control" id="TextareaMessenger" name="content" rows="3" placeholder="Lời nhắn"></textarea>
                                    <span class="fr-error fr-error_content"></span>
                                </div>
                                <button type="button" class="btn btn-primary btn__send__contact">Đăng ký thông tin</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @section('script')
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
        <script>
            $('.btn__send__contact:not(".disabled")').click(function(e){

                e.preventDefault();

                const el = $(this);

                const baseUrl = $('#base_url').val();

                const UrlContact =el.parents('form').attr('action');

                const data = el.parents('form').serialize();

                const loading = '<img style="max-width:60px" src="'+baseUrl+'/public/frontend/icons/loading.gif" />';

                el.addClass('disabled');

                $('.fr-error').html('');

                el.html(loading);

                $.ajax({

                    type: 'POST',

                    url: UrlContact,

                    dataType: "json",

                    data: data,

                    success:function(data){

                        el.removeClass('disabled');

                        if(data.success==false)
                        {
                            if(data.errorMessage){

                                $.each(data.errorMessage, function(field, item) {

                                    $('.fr-error_'+field).html(item);
                                    
                                });
                            }else{
                                toastr["error"](data.message, "Thông báo");
                            }
                        }

                        if (data.success==true) {

                            toastr["success"](data.message, "Thông báo");
                            
                            el.parents('form')[0].reset();

                        }

                        el.html('Đăng ký thông tin');

                    },error:function(){

                        // el.html('Đăng ký');

                    }

                });
                });
        </script>
    @endsection
@endsection