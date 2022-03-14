@extends('backend.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-contact" action="{!! route($module['module'].'.postMultiDel') !!}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header card-header-product">
                                    <div class="d-flex align-items-center">
                                        <i class="icon-notebook icon-header"></i>
                                        <h4 class="card-title">Danh sách tin tức</h4>
                                        <a class="btn btn-primary btn-round ml-auto" href="{{ route($module['module'].'.create') }}">
                                
                                            <i class="fa fa-plus"></i>
                                        
                                            Thêm mới
                                    
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('flash::message')
                                    <div class="table-responsive table-products">
                    			        <table id="table-ajax" class="table table-bordered table-striped table-hover">
                    			            <thead>
                    			            <tr>
                    			                <th width="10px"><input type="checkbox" name="chkAll" id="chkAll"></th>
                    			                <th width="10px">STT</th>
                    			                <th width="80px">Hình ảnh</th>
                    			                <th>Tiêu đề</th>
                                                <th>Danh mục</th>
                    			                <th width="100px">Trạng thái</th>
                    			                <th width="100px">Thao tác</th>
                    			            </tr>
                    			            </thead>
                    			            <tbody>

                    			            </tbody>
                    			        </table>
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

@section('scripts')
    <script>
        jQuery(document).ready(function ($) {
            $('#table-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    'url': '{!! route('posts.index') !!}',
                    'data': {
                        'type': '{{ request()->get('type') }}',
                    }
                },
                columns: [
                    {data: 'checkbox', name: 'checkbox'},
                    {data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    {data: 'image', name: 'image'},
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},

                ],
                'columnDefs': [{
                    'targets': [0, 1],
                    'orderable': false,
                    'searchable': false,
                }],
                language: {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    }
                },
                "initComplete":function(){
                     $(".dataTables_length").append('<button class="btn btn-sm btn-danger" onClick="return confirm(\'Bạn có chắc chắn muốn xóa?\')"><i class="icon-trash"></i> Xóa</button>');         
                 }
            });
        });
    </script>
@endsection