@extends('backend.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-contact" action="{!! route('contact.postMultiDel') !!}" method="POST">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-signature icon-header"></i>
                                        <h4 class="card-title"><a href="{{ route('get.list.contact') }}">Liên hệ</a></h4>
                                        <span>
                                            <i class="flaticon-right-arrow"></i>Chi tiết
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('flash::message')
                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Tiêu đề</label>
                                                <br>
                                                <span class="badge badge-primary badge-title">{{$data->title}}</span>
                                            </div>
                                            <div class="form-group">
                                                <label>Họ tên</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                       value="{!! old('name', isset($data) ? $data->name : null) !!}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" id="email"
                                                       value="{!! old('email', isset($data) ? $data->email : null) !!}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label>Số điện thoại</label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                       value="{!! old('phone', isset($data) ? $data->phone : null) !!}" readonly>
                                            </div>

                                            @if($data->type==2)
                                            <div class="form-group">
                                                <label>Vị trí ứng tuyển</label>
                                                <input type="text" class="form-control" name="phone" 
                                                       value="{!! old('phone', isset($data) ? $data->vitri : null) !!}" readonly>
                                            </div>

                                            <div class="form-group" style="">
                                                <label>Giới thiệu bản thân</label>                           
                                                <textarea class="form-control" name="address" id="phone" readonly="">{{ isset($data) ? $data->address : null }}</textarea>
                                            </div>
                                            @else
                                            <div class="form-group" style="">
                                                <label>Nội dung liên hệ</label>                           
                                                <textarea class="form-control" name="content" id="phone" readonly="">{{ isset($data) ? $data->content : null }}</textarea>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection