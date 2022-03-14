@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				@include('flash::message')
				<form class="form-add-user" action="{{ route('policy.post-add') }}" method="POST" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<ul class="breadcrumbs">
										<li class="nav-home">
											<a href="{{ route('policy.list') }}">
												<i class="fas fa-user"></i>
											</a>
										</li>
										<li class="separator">
											<i class="flaticon-right-arrow"></i>
										</li>
										<li class="nav-item">
											<a href="{{ route('policy.list') }}">Điều khoản, chính sách</a>
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

			                        <div class="row">

			                            <div class="col-sm-12">

			                                <div class="form-group">

			                                    <label>Tiêu đề</label>

			                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name') !!}" >

			                                </div>

			                                <div class="form-group" style="display: none;">

			                                    <label>Đường dẫn tĩnh</label>

			                                    <input type="text" class="form-control" name="slug" id="slug" value="{!! old('slug') !!}">

			                                </div>

			                                <div class="form-group">

			                                    <label>Nội dung</label>

			                                    <textarea class="content" name="content">{!! old('content') !!}</textarea>

			                                </div>

			                                <div class="form-check">
				                                <label class="form-check-label">
					                            	<input class="form-check-input" type="checkbox" name="status" value="1" checked>
					                            	<span class="form-check-sign">
						                            	Hiển thị
						                            </span>
					                            </label>
					                        </div>

			                                <div class="text-right mt-3 mb-3">
												<button type="submit" class="btn btn-success">Thêm mới</button>
											</div>

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



