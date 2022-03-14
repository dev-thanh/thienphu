@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				@include('flash::message')
				<form class="form-add-user" action="{{ route('users.store') }}" method="POST" autocomplete="off">
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
											<a href="">Thêm mới</a>
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
							                    value="{!! old('name') !!}">
							                </div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
							                    <label>Số điện thoại</label>
							                    <input type="text" class="form-control" name="phone" value="{!! old('phone') !!}">
							                </div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
							                    <label>Email</label>
							                    <input type="text" class="form-control" name="email" value="{!! old('email') !!}">
							                </div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group">
							                    <label>Tài khoản</label>
							                    <input type="text" class="form-control" name="user_name" value="{!! old('user_name') !!}">
							                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
							                    <label>Vai trò</label>
							                    <select name="level" class="form-control">
							                        <option value="1" selected>Người quản lý</option>
							                        <option value="2">Biên tập viên</option>
							                    </select>
							                </div>
										</div>
									</div>
									<div class="row mt-3">
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
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked>
										<label class="custom-control-label m-0" for="status">Kích hoạt</label>
									</div>
									<div class="text-right mt-3 mb-3">
										<button type="submit" class="btn btn-success">Thêm mới</button>
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
				                                   <img src="{{ old('image') ? old('image') :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
				                                   <a href="javascript:void(0)" class="image__delete" 
				                                   onclick="urlFileDelete(this)">
				                                    <i class="fa fa-times"></i></a>
				                                   <input type="hidden" value="{{ old('image') }}" name="image"  />
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