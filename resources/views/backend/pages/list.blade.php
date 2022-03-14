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
                                    <i class="icon-book-open icon-header"></i>
                                    <h4 class="card-title">Cài đặt trang</h4>
                                    <button type="button" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modal-default">
                                        
                                        <i class="fa fa-plus"></i>Thêm mới trang
                                        
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('flash::message')
                                <div class="table-responsive">
                                    <table class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30px">STT</th>
                                                <th width="">Tên trang</th>
                                                <th width="">Liên kết</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-body-pro">
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $item->name_page }}</td>
                                                    <td>
                                                        @if (Route::has($item->route))
                                                            @if($item->route=='home.index')
                                                            <a href="{{ route($item->route) }}?lang=vi" target="_blank">
                                                                <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                                                Link: {{ route($item->route) }}
                                                            </a>
                                                            @else
                                                            <a href="{{ route($item->route) }}" target="_blank">
                                                                <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                                                Link: {{ route($item->route) }}
                                                            </a>
                                                            @endif
                                                        @else
                                                        ---------------
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pages.build', ['page'=> $item->type, 'lang' => $item->lang ]) }}" 
                                                            class="btn btn-success btn-sm">
                                                        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Xây dựng trang</a>
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
    <div class="modal fade modal__menu" id="modal-default">
        <form action="{{ route('pages.create') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm mới</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input type="text" name="name_page" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Key</label>
                            <input type="text" name="type" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Route</label>
                            <input type="text" name="route" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection