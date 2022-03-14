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
                                    <i class="fas fa-align-justify icon-header"></i>
                                    <h4 class="card-title">Danh sách videos</h4>
                                    <a class="btn btn-primary btn-round ml-auto" href="{{ route($module['module'].'.create') }}">
                                
                                        <i class="fa fa-plus"></i>
                                    
                                        Thêm mới
                                
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('flash::message')
                                <div class="table-responsive">
                                    <table id="example1" class="table table-hover" data-ordering="false">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên danh mục</th>
                                                <th>Video</th>
                                                <!-- <th>Order</th> -->
                                                <th class="text-center">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $k => $item)
                                            <tr>
                                                <td>{{$k+1}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>
                                                    <div style="padding: 15px">
                                                        {!! $item->desc !!}
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                                                        <a href="{{route('videos.edit',$item->id)}}" title="Sửa">
                                                            <span class="label label-primary action-span"><i class="fa fa-edit"></i></span>
                                                        </a>
                                                    </button>
                                                    <button type="button" class="btn btn-link btn-danger" data-original-title="Xóa">
                                                        <a href="javascript:;" class="btn-destroy" data-href="{{route('videos.destroy',$item->id)}}" data-toggle="modal" data-target="#confim">
                                                            <span class="label label-danger action-span"><i class="fa fa-times"></i></span>
                                                        </a>
                                                    </button>
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
