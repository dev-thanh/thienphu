@extends('backend.layouts.app')

@section('content')

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                @include('flash::message')
                <form action="{{ route('image.update', $data->id) }}" method="POST">
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="breadcrumbs">
                                        <li class="nav-home">
                                            <a href="{{ route('image.index', ['type'=> 'slider']) }}">
                                                <i class="fas fa-file-image icon-header"></i>
                                            </a>
                                        </li>
                                        <li class="separator">
                                            <i class="flaticon-right-arrow"></i>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('image.index', ['type'=> 'slider']) }}">Slider</a>
                                        </li>
                                        <li class="separator">
                                            <i class="flaticon-right-arrow"></i>
                                        </li>
                                        <li class="nav-item">
                                            <a href="">Cập nhật</a>
                                        </li>
                                    </ul>
                                    <!-- <div class="card-title">Tài khoản <small>Thêm</small></div> -->
                                </div>
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <div class="col-xl-2 col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Hình ảnh</label>
                                                <div class="image">
                                                   <div class="image__thumbnail">
                                                       <img src="{{ old('image',@$data->image) ?  old('image',@$data->image) : __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
                                                       <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                                                        <i class="fa fa-times"></i></a>
                                                       <input type="hidden" value="{{ old('image', @$data->image) }}" name="image" value="{{ old('image', @$data->image) }}" />
                                                       <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>

                                        <div class="col-xl-10 col-lg-9 col-md-9 ">
                                            <div class="form-group">
                                                <label>Tiêu đề hình ảnh</label>
                                                <input type="text" class="form-control" name="name" 
                                                        value="{!! old('name',@$data->name) !!}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Đường dẫn (Link)</label>
                                                <input type="text" class="form-control" name="link" id="link"
                                                        value="{!! old('link',@$data->link) !!}">
                                            </div>
                                            
                                            <input type="hidden" name="type" value="{{ request()->get('type') }}">
                                            <div class="form-group">
                                                <label>Trạng thái</label> <br>
                                                <input type="checkbox" name="status" value="1" id="status" {{ old('status', @$data->status) ==  1 ? 'checked' : null }}>
                                                <label for="status" class="lbl">Hiển thị</label>
                                            </div>
                                            <div class="text-left mt-3 mb-3">
                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop


