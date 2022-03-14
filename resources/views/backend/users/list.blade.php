@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header card-header-user">
								<div class="d-flex align-items-center">
									<i class="fas fa-user"></i>
									<h4 class="card-title">Tài khoản quản trị</h4>
									<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
										<a href="{{ route('users.create') }}">
										<i class="fa fa-plus"></i>
										
											Thêm tài khoản
										
										</a>
									</button>
								</div>
							</div>
							<div class="card-body">
								@include('flash::message')
				           		
								<div class="table-responsive">
								    <table id="example1" class="display table table-striped table-hover">
								    	<thead>
								    		<tr>
								    			<th>STT</th>
								    			<th>Tên tài khoản</th>
								    			<th>Tên người dùng</th>
								    			<th>Số điện thoại</th>
								    			<th>Email</th>
								    			<th>Trạng thái</th>
								    			<th>Hành động</th>
								    		</tr>
								    	</thead>
								    	<tbody>
								    		@foreach ($data as $item)
								    		<tr>
								    			<td>{{ $loop->index +1 }}</td>
								    			<td>
								    				@if (!empty($item->image))
								    					<img src="{{ $item->image }}"  width="35px" height="35px">
								    				@else
								    					<img src="{{ asset('uploads/user/no-image.png') }}">
								    				@endif
								    				&nbsp; &nbsp;
								    				{{ $item->user_name }}
								    			</td>
								    			<td>{{ $item->name }}</td>
								    			<td>{{ $item->phone }}</td>
								    			<td>{{ $item->email }}</td>
								    			<td>
								    				@if ($item->status == 1 )
								    					<span class="badge badge-success">Đang hoạt động</span>
								    				@else
								    					<span class="badge badge-danger">Đang khóa</span>
								    				@endif
								    			<td>
							    					@if ($item->user_name != 'gco_admin')
							    						<div class="form-button-action">
															<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
																<a href="{{ route('users.edit', $item->id ) }}">
																	<i class="fa fa-edit"></i>
																</a>
															</button>
															<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
																<a href="javascript:;" class="btn-destroy" data-href="{{ route( 'users.destroy',  $item->id ) }}"
								    								data-toggle="modal" data-target="#confim">
																	<i class="fa fa-times"></i>
																</a>
															</button>
														</div>
							    					@endif
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