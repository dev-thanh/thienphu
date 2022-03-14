@extends('backend.layouts.app')

@section('content')

	<style>
		.file__name{
			position: absolute;
			bottom: 0px;
			width: 100%;
			padding: 5px;
			background: #e6f4fa;
			font-size: 10px;
			text-align: center;
		}
	</style>
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
		                <div class="col-sm-9">
		                	<div class="card">
		                		<div class="card-header">
									 <div class="nav-tabs-custom">
										<ul class="breadcrumbs">
											<li class="nav-home">
												<a href="{{ route('products.index') }}">
													<i class="icon-handbag icon-header"></i>
												</a>
											</li>
											<li class="separator">
												<i class="flaticon-right-arrow"></i>
											</li>
											<li class="nav-item">
												<a href="{{ route('products.index') }}">Sản phẩm</a>
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
						                        <a class="nav-link active" href="#activity" data-toggle="tab" aria-expanded="true">Thông tin sản phẩm</a>
						                    </li>
						                    <li class="nav-item">
						                    	<a class="nav-link" href="#image" data-toggle="tab" aria-expanded="true">Hình ảnh chi tiết sản phẩm</a>
						                    </li>
											<li class="nav-item">
						                    	<a class="nav-link" href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
						                    </li>
						                </ul>
						                <div class="tab-content">

						                    <div class="tab-pane active" id="activity">
						                    	<div class="row">

												<?php 

													$sku = old('sku', @$data->sku);

													if(empty($sku)){

														$sku = generateRandomCode();

													}

												?>

												<div class="col-sm-12">

													<div class="form-group">

														<label for="">Model</label>

														<input type="text" name="sku" class="form-control" value="{{ @$sku }}">

													</div>

												</div>
				                                    
													<div class="col-sm-12">
														<div class="form-group">
						                                    <label>Tên sản phẩm</label>
						                                    <input type="text" class="form-control" name="name" id="name" value="{!! old('name', @$data->name) !!}">
						                                </div>
													</div>
												
						                    		<div class="col-sm-12">
						                                @if(isUpdate(@$module['action']))
							                                <div class="form-group" id="edit-slug-box">
							                                    @include('backend.products.permalink')
							                                </div>
						                                @endif
				                                    </div>

													<div class="col-sm-12">

														<div class="form-group form-price">

															<label for="">Giá bán</label>

															<div class="price__contact">
																<input type="text" name="price" class="form-control" 

																value="{{ old('price', @$data->price) }}">

																<!-- <div class="form-check">
																	<label class="form-check-label">
																		<input type="checkbox" class="category form-check-input" name="category[]" value="26">
																		<span class="form-check-sign">
																			Liên hệ
																		</span> 
																	</label>
																</div> -->
															</div>

														</div>

													</div>

													<?php if(!empty($data->file)){
															$contentPdf = json_decode($data->file);
														} ?>
														@if(old('file'))
															<?php $contentPdf = json_decode(json_encode(old('file'))); ?>
														@endif
													<div class="col-sm-12">
				                                        <div class="form-group">
				                                            <label for="">Thông số kỹ thuật( .pdf )</label>
				                                            <!-- <input name="file" type="file"> -->
															<div class="col-md-4 text-center pdf-item">
																<div class="image">
																	<div class="image__thumbnail pdf__thumbnail">
																		<img src="{{ __URL__ }}/images/pdf.png"
																				data-init="{{ __IMAGE_DEFAULT__ }}">
																		<a href="javascript:void(0)" class="image__delete" onclick="urlFileDeletePdf(this)">
																			<i class="fa fa-times"></i></a>
																		<input type="hidden" value="{{ @$contentPdf->url }}" name="file[url]"/>
																		<input class="pdf-name-hidden" type="hidden" value="{{ @$contentPdf->name }}" name="file[name]"/>
																		<div class="image__button pdf__upload" onclick="fileSelectPdf(this)">
																			<i class="fa fa-upload"></i>
																			Upload file
																		</div>
																		<div class="pdf__name">{{@$contentPdf->name}}</div>
																	</div>
																	
																	<div class="pdf__error"></div>
																</div>
															</div>
				                                        </div>
													</div>
				                                    
													<div class="col-sm-12">
				                                        <div class="form-group">
				                                            <label for="">Thông số kỹ thuật</label>
				                                            <textarea class="content" style="min-height: 100px" name="desc">{!! old('desc', @$data->desc) !!}</textarea>
				                                        </div>
													</div>\

													<div class="col-sm-12">
				                                        <div class="form-group">
				                                            <label for="">Chi tiết sản phẩm</label>
				                                            <textarea class="content" style="min-height: 100px" name="content">{!! @$data->content !!}</textarea>
				                                        </div>
													</div>
						                    	</div>
											</div>

											<div class="tab-pane" id="image">
						                    	<div class="row">
													<div class="col-sm-12 image">

														<br><br>

														<div class="image__gallery">

															@if (!empty($data->more_image))

																<?php $more_image = json_decode($data->more_image) ?>

																@foreach ($more_image as $item)
																	@php
																		$image = $item;
																		$div = '';
																	@endphp
																	@if(str_contains($item,'__video__'))
																		@php 
																			$fileName = explode('__video__', $item);
																			$image = '/public/backend/plugins/ckfinder/skins/neko/file-icons/128/video.png?ckfver=513698098'; 
																			$div = '<div class="file__name">'.$fileName[0].'</div>';
																		@endphp
																	@endif

																	<div class="image__thumbnail image__thumbnail--style-1">

																		<img src="{{ @$image }}">

																		<a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">

																			<i class="fa fa-times"></i>

																		</a>

																		<input type="hidden" name="gallery[]" value="{{ $item }}">
																		{!!$div!!}
																	</div>

																@endforeach

															@endif

														</div>

														<button type="button" class="btn btn-success" onclick="fileMultiSelect(this)"><i class="fa fa-upload"></i>  

															Chọn hình ảnh hoặc video

														</button>

													</div>
												</div>
											</div>
											
											<div class="tab-pane" id="setting">
						                    	<div class="form-group">
							                        <label>Title SEO</label>
							                        <label style="float: right;">Số ký tự đã dùng: <span id="countTitle">{{ @$data->meta_title != null ? mb_strlen( $data->meta_title, 'UTF-8') : 0 }}/70</span></label>
							                        <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', isset($data->meta_title) ? $data->meta_title : null) !!}" id="meta_title">
							                    </div>

							                    <div class="form-group">
							                        <label>Meta Description</label>
							                        <label style="float: right;">Số ký tự đã dùng: <span id="countMeta">{{ @$data->meta_description != null ? mb_strlen( $data->meta_description, 'UTF-8') : 0 }}/360</span></label>
							                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{!! old('meta_description', isset($data->meta_description) ? $data->meta_description : null) !!}</textarea>
							                    </div>

							                    <div class="form-group">
							                        <label>Meta Keyword</label>
							                        <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', isset($data->meta_keyword) ? $data->meta_keyword : null) !!}">
							                    </div>
							                    @if(isUpdate(@$module['action']))
								                    <h4 class="ui-heading">Xem trước kết quả tìm kiếm</h4>
								                    <div class="google-preview">
								                        <span class="google__title"><span>{!! !empty($data->meta_title) ? $data->meta_title : @$data->name !!}</span></span>
								                        <div class="google__url">
								                            {{ asset( 'products/'.$data->slug ) }}
								                        </div>
								                        <div class="google__description">{!! old('meta_description', isset($data->meta_description) ? @$data->meta_description : '') !!}</div>
								                    </div>
							                    @endif
						                    </div>
						                </div>
						            </div>
					            </div>
		                	</div>
						</div>
						<div class="col-sm-3">
							<div class="card">
								<div class="card-body">
									<div class="box box-success">
						                <div class="box-header with-border">
						                    <h3 class="box-title">Đăng sản phẩm</h3>
						                </div>
						                <div class="box-body">
						                    <div class="form-group">
				                                <label class="custom-checkbox">
						                        	@if(isUpdate(@$module['action']))
						                        	<div class="form-check">
						                                <label class="form-check-label">
							                            	<input class="form-check-input" type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> 
							                            	<span class="form-check-sign">
								                            	Hiển thị
								                            </span>
							                            </label>
							                        </div>
													<div class="form-check">
						                                <label class="form-check-label">
							                            	<input class="form-check-input" type="checkbox" name="is_new" value="1" {{ @$data->is_new == 1 ? 'checked' : null }}> 
							                            	<span class="form-check-sign">
								                            	Sản phẩm mới
								                            </span>
							                            </label>
							                        </div>
													<div class="form-check">
						                                <label class="form-check-label">
							                            	<input class="form-check-input" type="checkbox" name="hot" value="1" {{ @$data->hot == 1 ? 'checked' : null }}> 
							                            	<span class="form-check-sign">
								                            	Sản phẩm nổi bật
								                            </span>
							                            </label>
							                        </div>
						                            @else
						                            	<div class="form-check">
							                                <label class="form-check-label">
								                            	<input class="form-check-input" type="checkbox" name="status" value="1" checked>
								                            	<span class="form-check-sign">
									                            	Hiển thị
									                            </span>
								                            </label>
								                        </div>
														<div class="form-check">
							                                <label class="form-check-label">
								                            	<input class="form-check-input" type="checkbox" name="is_new" value="1">
								                            	<span class="form-check-sign">
									                            	Sản phẩm mới
									                            </span>
								                            </label>
								                        </div>
														<div class="form-check">
							                                <label class="form-check-label">
								                            	<input class="form-check-input" type="checkbox" name="hot" value="1">
								                            	<span class="form-check-sign">
									                            	Sản phẩm nổi bật
									                            </span>
								                            </label>
								                        </div>
						                            @endif
						                        </label>
											</div>
											
						                    <div class="form-group">
						                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại sản phẩm</button>
						                    </div>
						                </div>
									</div>
									
				                    <div class="box box-success">
				                        <div class="box-header with-border">
						                    <h3 class="box-title">Danh mục sản phẩm</h3>
						                </div>
						                <div class="box-body checkboxlist checkbox-products">
				                            <?php 
												$category_list = [];
						                        if(!empty(@$data->category)){
						                           $category_list = @$data->category->pluck('id')->toArray();
						                        }
						                    ?>
						                    @if(old('category'))
							                    @php
							                    	$category_list = old('category');
						                    	@endphp
						                    @endif
						                    @if (!empty($categories))
						                        @foreach ($categories as $item)
						                            @if ($item->parent_id == 0)
						                            <div class="form-check">
						                                <label class="form-check-label">
						                                    <input type="checkbox" class="category form-check-input" name="category[]" value="{{ $item->id }}" {{ in_array( $item->id, $category_list ) ? 'checked' : null }}>
						                                    <span class="form-check-sign">
							                                    {{ $item->name }}
						                                    </span> 
						                                 </label>
						                             </div>
						                                 <?php checkBoxCategory( $categories, $item->id, $item->get_child_cate, $category_list ) ?>
						                            @endif
						                        @endforeach
						                    @endif
						                </div>
						            </div>
						            <div class="box box-success">
						                <div class="box-header with-border text-center">
						                    <h3 class="box-title">Ảnh đại diện sản phẩm</h3>
						                </div>
						                <div class="box-body">
						                    <div class="form-group" style="text-align: center;">
						                        <div class="image">
						                        	@if(old('image'))
						                        	<div class="image__thumbnail">
						                                <img src="{{ !empty(old('image')) ? old('image') : __IMAGE_DEFAULT__ }}"
						                                     data-init="{{ __IMAGE_DEFAULT__ }}">
						                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
						                                    <i class="fa fa-times"></i></a>
						                                <input type="hidden" value="{{ old('image') }}" name="image"/>
						                                <div class="image__button" onclick="fileSelect(this)">
						                                	<i class="fa fa-upload"></i>
						                                    Upload
						                                </div>
						                            </div>
						                        	@else
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
						                            @endif
						                        </div>
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

@stop

@section('scripts')
	<script>
		jQuery(document).ready(function($) {
			$('#btn-ok').click(function(event) {
		        var slug_new = $('#new-post-slug').val();
		        var name = $('#name').val();
		        $.ajax({
		        	url: '{{ route($module['module'].'.get-slug') }}',
		        	type: 'GET',
		        	data: {
		        		id: $('#idPost').val(),
		        		slug : slug_new.length > 0 ? slug_new : name,
		        		type : 'slug'
		        	},
		        })
		        .done(function(data) {
		        	$('#change_slug').show();
			        $('#btn-ok').hide();
			        $('.cancel.button-link').hide();
			        $('#current-slug').val(data);
		        	cancelInput(data);
		        })
		    });
		});
	</script>
	
@endsection

@section('css')
	<link rel="stylesheet" href="{{ url('public/backend/plugins/datetimepicker/bootstrap-timepicker.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
@endsection

