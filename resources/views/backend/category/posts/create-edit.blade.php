@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				@include('flash::message')
				<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
					@csrf
					@if(isUpdate(@$module['action']))
				        {{ method_field('put') }}
				    @endif
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									 <div class="nav-tabs-custom">
										<ul class="breadcrumbs">
											<li class="nav-home">
												<a href="{{ route(@$module['module'].'.index') }}">
													<i class="fas fa-align-justify icon-header"></i>
												</a>
											</li>
											<li class="separator">
												<i class="flaticon-right-arrow"></i>
											</li>
											<li class="nav-item">
												<a href="{{ route(@$module['module'].'.index') }}">{{@$module['name']}}</a>
											</li>
											<li class="separator">
												<i class="flaticon-right-arrow"></i>
											</li>
											<li class="nav-item">
												<a href="#">{{renderAction(@$module['action'])}}</a>
											</li>
										</ul>
									</div>
									<!-- <div class="card-title">Tài khoản <small>Thêm</small></div> -->
								</div>
								<div class="card-body">
								    <div class="nav-tabs-custom">
						                <ul class="nav nav-pills nav-secondary">
						                    <li class="nav-item">
						                        <a class="nav-link active" href="#activity" data-toggle="tab" aria-expanded="true">{{@$module['name']}}</a>
						                    </li>
						                    <li class="nav-item">
						                    	<a class="nav-link" href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
						                    </li>
						                </ul>
						                <div class="tab-content">
						                    <div class="tab-pane active" id="activity">
												<div class="form-group">
													<label for="">Tên danh mục</label>
													<input type="text" class="form-control" name="name" id="name" value="{{ old('name', @$data->name) }}">
												</div>
												
												<div class="form-group">
													<label for="">Đường dẫn tĩnh</label>
													<input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug', @$data->slug) }}">
												</div>
												
												<div class="form-group">
													<label for="">Danh mục cha</label>
													<select name="parent_id" class="form-control">
														<option value="0">Danh mục cha</option>
														   <?php menuMulti( $categories , 0 , '' ,   old( 'parent_id', @$data->parent_id )); ?>
													</select>
												</div>

												<div class="form-group">
													<label for="">Mô tả ngắn danh mục</label>
													<textarea name="desc" class="form-control" rows="5">{!! old('desc', @$data->desc) !!}</textarea>
												</div>
<!-- 												
												<div class="form-check">
					                                <label class="form-check-label">
						                            	<input class="form-check-input" type="checkbox" name="show" value="1" {{ @$data->show == 1 ? 'checked' : null }}> 
						                            	<span class="form-check-sign">
							                            	Hiển thị danh mục ngoài trang chủ
							                            </span>
						                            </label>
						                        </div> -->
						                    </div>
						                    <div class="tab-pane" id="setting">
						                    	<div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="">Banner đầu trang</label>
                                                            <div class="image">
                                                                <div class="image__thumbnail">
                                                                    <img src="{{ !empty(@$data->image) ? @$data->image : __IMAGE_DEFAULT__ }}"
                                                                        data-init="{{ __IMAGE_DEFAULT__ }}">
                                                                    <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                                                                        <i class="fa fa-times"></i></a>
                                                                    <input type="hidden" value="{{ old('image', @$data->image) }}" name="image"/>
                                                                    <div class="image__button" onclick="fileSelect(this)">
                                                                        <i class="fa fa-upload"></i>
                                                                        Upload
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
						                    		<div class="col-sm-8">
						                    			<div class="form-group">
								                            <label>Title SEO</label>
								                            <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', @$data->meta_title) !!}">
								                        </div>
						                    		
								                        <div class="form-group">
								                            <label>Meta Description</label>
								                            <textarea name="meta_description" id="" class="form-control" rows="5">{!! old('meta_description', @$data->meta_description) !!}</textarea>
								                        </div>
								                       
								                        <div class="form-group">
								                            <label>Meta Keyword</label>
								                            <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', @$data->meta_keyword) !!}">
								                        </div>
						                    		</div>
						                    	</div>
						                    </div>
						                    <button type="submit" class="btn btn-primary">Lưu lại</button>
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