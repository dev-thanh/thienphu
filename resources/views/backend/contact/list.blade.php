@extends('backend.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-contact" action="{!! route('contact.postMultiDel') !!}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-signature icon-header"></i>
                                        <h4 class="card-title">Danh sách Liên hệ</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('flash::message')
                                    <div class="table-responsive">
                                        <table id="table-ajax" class="display table table-striped table-hover">
                                            <thead>
                                              <tr>
                                                <th width="10px"><input type="checkbox" name="chkAll" id="chkAll"></th>
                                                <th width="10px">STT</th>
                                                <th>Họ tên</th>
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                                <th>Tiêu đề</th>
                                                <th>Thời gian gửi</th>
                                                <th width="90px">Trạng thái</th>
                                                <th>Thao tác</th>
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
        jQuery(document).ready(function($) {
            $('#table-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.list.contact') !!}',
                columns: [
                    { data: 'checkbox', name: 'checkbox' },
                    { data: 'DT_RowIndex',name: 'DT_RowIndex'},
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'email', name: 'email' },
                    { data: 'title', name: 'title' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                    
                ],
                'columnDefs': [{
                    'targets': [0,1], 
                    'orderable': false,
                    'searchable': false,
                }],
                language:{
                    "sProcessing":   "Đang xử lý...",
                    "sLengthMenu":   "Xem _MENU_ mục",
                    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                    "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Tìm:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Đầu",
                        "sPrevious": "Trước",
                        "sNext":     "Tiếp",
                        "sLast":     "Cuối"
                    }
                },
                "initComplete":function(){
                     $(".dataTables_length").append('<button class="btn btn-sm btn-danger" onClick="return confirm(\'Bạn có chắc chắn muốn xóa?\')"><i class="icon-trash"></i> Xóa</button>');         
                 }
            });
        });
    </script>
@endsection