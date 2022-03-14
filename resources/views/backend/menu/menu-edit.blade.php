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
									<a href="{{ route('setting.menu') }}">
										<i class="far fa-list-alt icon-header"></i>
									</a>
									<h4 class="card-title">{{$menuGroup->title}}</h4>
									<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addMenu" type="button"><i class="fa fa-plus"></i>Thêm mới</button>
								</div>
							</div>
							<div class="card-body">
							@include('flash::message')
								<div class="row">
							        <div class="col-sm-12">
							            <form action="{{ route('setting.menu.update') }}" method="POST">
							                <input type="hidden" id="nestable-output" name="jsonMenu">
							                <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
							                <button class="btn btn-success" type="submit" style="display: none;">Cập nhật menu</button>
							                <!-- <button class="btn btn-info" data-toggle="modal" data-target="#addMenu" type="button">Thêm mới</button> -->
							            </form>
							        </div>
							        <div class="col-sm-12">
							            <div class="dd" id="nestable">
							                <ol class="dd-list">
												@foreach ($data as $item)
							                        @if (empty($item->parent_id))
							                            <li class="dd-item" data-id="{{ $item->id }}">
							                                <div class="dd-handle">
							                                    {{ $item->title }} (<i>{{ $item->url }}</i>)
							                                </div>
							                                <div class="button-group">
							                                    <a href="javascript:;" title="Sửa" class="modalEditMenu" data-id="{{ $item->id }}"> 
							                                        <i class="fa fa-edit"></i>
							                                    </a> &nbsp; &nbsp; &nbsp;
							                                    <a class="text-danger" href="{!! route('setting.menu.delete',$item['id']) !!}" onclick="return confirm('Bạn có chắc chắn xóa không ?')" title="Xóa"> <i class="fa fa-times"></i></a>
							                                </div>
							                                <?php menuChildren($data, $item->id, $item ) ?>
							                            </li>
							                         @endif
							                    @endforeach
							                </ol>
							            </div>
							        </div>
							    </div>
							    <div class="modal bd-example-modal-lg modal__menu" id="addMenu">
							        <div class="modal-dialog modal-lg">
							            <div class="modal-content">
							                <div class="modal-header">
							                    <h4 class="modal-title">Thêm mới</h4>
							                    <button type="button" class="close" data-dismiss="modal">&times;</button>
							                </div>
							                <form action="{{ route('setting.menu.addItem', $id ) }}" method="POST" class="frm_add">
							                    <div class="modal-body">
							                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
							                        <fieldset class="form-group">
							                            <label>Tiêu đề</label>
							                            <input type="text" class="form-control" placeholder="Nhập tiêu đề" name="title" required>
													</fieldset>

							                        <fieldset class="form-group">
							                            <label>Đường đẫn</label><br>
							                            <label>Chỉ coppy phần bôi đỏ: <br>

							                                {{ url('/') }}<span style="color: red; font-weight: bold;">/gioi-thieu</span>
							                            </label>
							                            <div class="input-group mb-3">
															<div class="input-group-prepend">
															    <span class="input-group-text" id="inputGroup-sizing-default">{{ url('/') }}</span>
															</div>
															<input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Nhập đường dẫn" name="url">
														</div>
							                        </fieldset>
							                        
							                        <fieldset class="form-group">
							                            <label>Loại trang</label>
							                            <select name="class" class="form-control">
							                                <option value="">Trang bình thường</option>
							                                <option value="page-product">Trang sản phẩm</option>
							                                 <option value="page-quote">Trang báo giá</option>
							                            </select>
													</fieldset>
							                    </div>
							                    <div class="modal-footer">
							                        <button type="submit" class="btn btn-success">Thêm mới</button>
							                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							                    </div>
							                </form>
							            </div>
							        </div>
							    </div>
							    <div class="modal modal__menu" id="editMenu">
							        <div class="modal-dialog">
							            <div class="modal-content">
							                <div class="modal-header">
							                    <h4 class="modal-title">Sửa Menu</h4>
							                    <button type="button" class="close" data-dismiss="modal">&times;</button>
							                </div>
							                <form action="{{ route('setting.menu.editItem' ) }}" method="POST" class="frm_add">
							                    <div class="modal-body">
							                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
							                        <fieldset class="form-group">
							                            <label>Tiêu đề</label>
							                            <input type="text" class="form-control" id="editTitle" name="title" required >
							                            <input type="hidden" value="" id="id_menu" name="id">
													</fieldset>
													
							                        <fieldset class="form-group">
							                            <label>Đường đẫn</label>
							                            <input type="text" class="form-control" id="editUrl" name="url">
							                        </fieldset>
							                        
							                    </div>
							                    <div class="modal-footer">
							                        <button type="submit" class="btn btn-success">Sửa</button>
							                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							                    </div>
							                </form>
							            </div>
							        </div>
							    </div>
						    </div>
					    </div>
				    </div>
			    </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            var updateOutput = function(e){
                var list   = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    var param = window.JSON.stringify(list.nestable('serialize'));
                    $.ajax({
                        url: '{{ route('setting.menu.update') }}',
                        type: 'POST',
                        data: {
                            _token : $('#token').val(),
                            jsonMenu: param
                        },
                    }).done(function() {
                            $.toast({
                            text: "Cập nhật thành công !",
                            heading: 'Thông báo',
                            icon: 'success',
                            showHideTransition: 'fade',
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 1000, 
                            stack: 5, 
                            position: 'top-right', 
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#9ec600',
                        });
                    })
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            $('#nestable').nestable({
                group: 3,
                maxDepth : 3
            }).on('change', updateOutput);
            updateOutput($('#nestable').data('output', $('#nestable-output')));
        });
        $('.modalEditMenu').click(function(event) {
            var id = $(this).attr("data-id");
            $.get('{{ asset('/backend/menu/edit-item/') }}/'+id, function(data) {
                if(data.status == "success"){
					if(data.data.icon !=  null){
                		$('#iconEdit img').attr("src", data.data.icon);
                		$('#iconEdit input').val(data.data.icon);
                	}else{
                		$('#iconEdit img').attr("src", '{{ __IMAGE_DEFAULT__ }}');
                		$('#iconEdit input').val("");
                	}
                    $('#editTitle').val(data.data.title);
                    $('#editUrl').val(data.data.url);
                    $('#id_menu').val(id);
                    $('#editMenu').modal('show')
                }
            });
        });
        $('.frm_add').on('submit', function(event) {
            string  = $(this).children().find('.url').val();
            substring  = '{{ url('/') }}';
            if(string.includes(substring) == true){
                $.alert({
                    title: 'Thông báo',
                    content: 'Bạn nhập sai định dạng URL',
                });
                return false;
            }
        });
    </script>
@endsection

