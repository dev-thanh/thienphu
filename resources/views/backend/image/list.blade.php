@extends('backend.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <i class="far fa-images icon-header"></i>
                                    <h4 class="card-title">Danh sách Slider</h4>
                                   
                                    <a class="btn btn-primary btn-round ml-auto" href="{{ route('image.create') }}?type={{ request()->get('type') }}">
                                    <i class="fa fa-plus"></i>
                                    
                                        Thêm mới
                                    
                                    </a>
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                @include('flash::message')
                                <div class="table-responsive">
                                    <table id="example1" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Hình ảnh</th>
                                                <th width="30%">Tiêu đề</th>
                                                <th>Link</th>
                                                <th>Trạng thái</th>
                                                <th width="150px">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>
                                                        <img src="{{ renderImage($item->image) }}" class="img-responsive imglist">
                                                    </td>
                                                    <td>{!! $item->name !!}</td>
                                                    <td>{{  $item->link }}</td>
                                                    <td>
                                                        @if ($item->status == 1 )
                                                            <span class="badge badge-success">Đang hiển thị</span>
                                                        @else
                                                            <span class="badge badge-danger">Đang ẩn</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    <div>
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                            <a href="{{ route('image.edit', $item->id) }}?type={{$item->type}}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        </button>
                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                            <a href="javascript:;" class="btn-destroy" data-href="{{ route( 'image.destroy',  $item->id ) }}"
                                                                data-toggle="modal" data-target="#confim">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </button>
                                                      </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection