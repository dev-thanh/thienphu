@extends('backend.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-contact" action="{{ route('pages.build.post') }}" method="POST">
                            @csrf
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <i class="icon-book-open icon-header"></i>
	                                    <h4 class="card-title"><a href="{{ route('pages.list') }}">Cài đặt trang</a></h4>
	                                    <span>
                                            <i class="flaticon-right-arrow"></i>Cập nhật
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
					               	@include('flash::message')
									<input name="type" value="{{ $data->type }}" type="hidden">
									<input name="lang" value="{{ $data->lang }}" type="hidden">

					               	<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label for="">Trang</label>
												<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">
											</div>
										</div>
									</div>
									

									<?php if(!empty($data->content)){

										$content = json_decode($data->content);

									} ?>

								    <div class="tab-content">

										<div class="tab-pane active" id="seo">

											<div class="row">

												<div class="col-sm-2">

													<div class="form-group">

							                           <label>Hình ảnh</label>

							                           <div class="image">

							                               <div class="image__thumbnail">

							                                   <img src="{{ $data->image ?  url('/').$data->image : __IMAGE_DEFAULT__ }}"  

							                                   data-init="{{ __IMAGE_DEFAULT__ }}">

							                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">

							                                    <i class="fa fa-times"></i></a>

							                                   <input type="hidden" value="{{ @$data->image }}" name="image"  />

							                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>

							                               </div>

							                           </div>

							                       </div>

												</div>

												<div class="col-sm-10">

													<div class="form-group">

														<label for="">Tiêu đề trang</label>

														<input type="text" name="meta_title" class="form-control" value="{{ @$data->meta_title }}">

													</div>

													<div class="form-group">

														<label for="">Mô tả trang</label>

														<textarea name="meta_description" 

														class="form-control" rows="5">{!! @$data->meta_description !!}</textarea>

													</div>

													<div class="form-group">

														<label for="">Từ khóa</label>

														<input type="text" name="meta_keyword" class="form-control" value="{!! @$data->meta_keyword !!}">

													</div>

												</div>

											</div>

							            </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        </div>

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