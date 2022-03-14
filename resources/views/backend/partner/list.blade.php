@extends('backend.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-contact" action="{{route('partner.store')}}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header card-header-product">
                                    <div class="d-flex align-items-center">
                                        <i class="icon-notebook icon-header"></i>
                                        <h4 class="card-title">Đối tác</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('flash::message')
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control" name="name" 
                                                value="{!! old('name',@$data->name) !!}">
                                    </div>
                                    <?php if(!empty($data->content)){

                                        $content = json_decode($data->content);

                                    } ?>

                                    @if(old('content'))
                                        <?php $content = json_decode(json_encode(old('content'))); ?>
                                    @endif
                                    <div class="form-group">
                                        <label>Mô tả ngắn khối (trang chủ)</label>
                                        <input type="text" class="form-control" name="content[partner][desc]" 
                                                value="{!! @$content->partner->desc !!}">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="repeater" id="repeater">
                                            <div class="form-group">
                                                <label for="">Danh sách đối tác</label>	
                                            </div>
                                            <table class="table table-bordered table-hover page-table page-table-home partner">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px;">STT</th>
                                                        <th style="width: 200px">Hình ảnh đối tác</th>
                                                        <th>Nội dung</th>
                                                        <th style="width: 50px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sortable">
                                                    @if (!empty($content->partner->content))
                                                        @foreach ($content->partner->content as $key => $value)
                                                            <?php $index = $loop->index + 1; ?>
                                                            @include('backend.repeater.row-partner')
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                <button class="btn btn-sm btn-primary" 
                                                    onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'partner', '.partner')">Thêm
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Lưu lại</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection