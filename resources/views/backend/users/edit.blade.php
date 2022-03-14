@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				@include('flash::message')
				<form class="form-add-user" action="{{ route('users.update', $data->id) }}" method="POST" autocomplete="off">
					{!! method_field('PUT') !!}
					@csrf
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<ul class="breadcrumbs">
										<li class="nav-home">
											<a href="{{ route('users.index') }}">
												<i class="fas fa-user"></i>
											</a>
										</li>
										<li class="separator">
											<i class="flaticon-right-arrow"></i>
										</li>
										<li class="nav-item">
											<a href="{{ route('users.index') }}">Tài khoản</a>
										</li>
										<li class="separator">
											<i class="flaticon-right-arrow"></i>
										</li>
										<li class="nav-item">
											<a href="">Chỉnh sửa</a>
										</li>
									</ul>
									<!-- <div class="card-title">Tài khoản <small>Thêm</small></div> -->
								</div>
								<div class="card-body">
									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group">
							                    <label>Họ và tên</label>
							                    <input type="text" class="form-control" name="name" 
							                    value="{!! old('name', isset($data->name) ? $data->name : null) !!}">
							                </div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
							                    <label>Số điện thoại</label>
							                    <input type="text" class="form-control" name="phone" value="{!! old('phone', isset($data->phone) ? $data->phone : null) !!}">
							                </div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
							                    <label>Email</label>
							                    <input type="text" class="form-control" name="email" value="{!! old('email', isset($data->email) ? $data->email : null) !!}">
							                </div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group">
							                    <label>Tài khoản</label>
							                    <input type="text" class="form-control" name="user_name" value="{!! old('user_name', isset($data->user_name) ? $data->user_name : null) !!}" readonly="">
							                </div>
										</div>
										@if (Auth::user()->user_name != $data->user_name)
										<div class="col-md-6">
											<div class="form-group">
							                    <label>Vai trò</label>
							                    <select name="level" class="form-control">
							                        <option value="1" {{ @$data->level == 1 ? 'selected' : null }}>Người quản lý</option>
							                        <option value="2" {{ @$data->level == 2 ? 'selected' : null }}>Biên tập viên</option>
							                    </select>
							                </div>
										</div>
										@endif
									</div>
									<div class="row mt-3 collapse" id="multiCollapseExample2">
										<div class="col-md-6">
											<div class="form-group">
							                    <label>Mật khẩu</label>
							                    <input type="password" class="form-control" name="password" value="">
							                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
							                    <label>Nhập lại mật khẩu</label>
							                    <input type="password" class="form-control" name="repassword" value="">
							                </div>
										</div>
									</div>
									@if (Auth::user()->user_name != $data->user_name)
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="status" name="status" {{ @$data->status == 1 ? 'checked' : null }} value="1">
										<label class="custom-control-label m-0" for="status">Kích hoạt</label>
									</div>
									@endif
									<div class="text-right mt-3 mb-3">
										<button type="submit" class="btn btn-success">Cập nhật</button>
										<button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Thay đổi mật khẩu</button>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-profile">
								<div class="card-header" style="background-image: url('https://themekita.com/demo-atlantis-bootstrap/livepreview/examples/assets/img/blogpost.jpg')">
									<!-- <div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
										</div>
									</div> -->
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="form-group">
				                           <div class="image">
				                               <div class="image__thumbnail">
				                                   <img src="{{ !empty($data->image) ? $data->image :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
				                                   <a href="javascript:void(0)" class="image__delete" 
				                                   onclick="urlFileDelete(this)">
				                                    <i class="fa fa-times"></i></a>
				                                   <input type="hidden" value="{{ $data->image }}" name="image"  />
				                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
				                               </div>
				                           </div>
				                       </div>
										<div class="view-profile">
											<span class="btn btn-secondary btn-block">Hình ảnh đại diện</span>
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
@endsection
@section('scripts')
	  <script>
	    jQuery(document).ready(function($) {
	      $('#chanePass').click(function(event) {
	      	console.log(44);
	        $('#pass').toggleClass('hidden');
	      });
	    });
	  </script>
@endsection