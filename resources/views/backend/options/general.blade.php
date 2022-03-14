@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Cấu hình chung</h4>
							</div>
							<div class="card-body">
								@include('flash::message')
				               	<form action="{{ route('backend.options.general.post') }}" method="POST">
				               		@csrf
				               		 <div class="nav-tabs-custom">
							            <ul class="nav nav-pills nav-secondary">
							               <li class="nav-item">
												   <a class="nav-link active" href="#activity" data-toggle="tab" aria-expanded="true">Thông tin chung</a>
											</li>
							                <li class="nav-item">
							                	<a class="nav-link" href="#activity1" data-toggle="tab" aria-expanded="true">Thông tin liên hệ</a>
											</li>

											<li class="nav-item">
							                	<a class="nav-link" href="#activity8" data-toggle="tab" aria-expanded="true">Hệ thống(trang chủ)</a>
											</li>
											
											<li class="nav-item">
												<a class="nav-link" href="#activity4" data-toggle="tab" aria-expanded="true">Mạng xã hội</a>
										 	</li>
							               	<li class="nav-item">
							               		<a class="nav-link" href="#activity3" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
							               	</li>
											
											 <li class="nav-item">
												<a class="nav-link" href="#activity7" data-toggle="tab" aria-expanded="true">Khác</a>
										 	</li>
							            </ul>

								        <div class="tab-content">

					                		<div class="tab-pane active" id="activity">
							               		<div class="row">
							               			<div class="col-lg-2">
								                        <div class="form-group">
								                           <label>Favicon</label>
								                           <div class="image">
								                               <div class="image__thumbnail">
								                                   <img src="{{ !empty($content->favicon) ? url('/').$content->favicon :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
								                                   <a href="javascript:void(0)" class="image__delete" 
								                                   onclick="urlFileDelete(this)">
								                                    <i class="fa fa-times"></i></a>
								                                   <input type="hidden" value="{{ @$content->favicon }}" name="content[favicon]"  />
								                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
								                               </div>
								                           </div>
								                       </div>
								                    </div>
								                    <div class="col-lg-2">
								                        <div class="form-group">
								                           <label>Logo header</label>
								                           <div class="image">
								                               <div class="image__thumbnail">
								                                   <img src="{{ !empty($content->logo) ? url('/').$content->logo :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
								                                   <a href="javascript:void(0)" class="image__delete" 
								                                   onclick="urlFileDelete(this)">
								                                    <i class="fa fa-times"></i></a>
								                                   <input type="hidden" value="{{ @$content->logo }}" name="content[logo]"  />
								                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
								                               </div>
								                           </div>
								                       </div>
													</div>

								                    <div class="col-lg-2">
								                        <div class="form-group">
								                           <label>Hình ảnh đại diện khi chia sẻ</label>
								                           <div class="image">
								                               <div class="image__thumbnail">
								                                   <img src="{{ !empty($content->logo_share) ? url('/').$content->logo_share :  __IMAGE_DEFAULT__ }}"  data-init="{{ __IMAGE_DEFAULT__ }}">
								                                   <a href="javascript:void(0)" class="image__delete" 
								                                   onclick="urlFileDelete(this)">
								                                    <i class="fa fa-times"></i></a>
								                                   <input type="hidden" value="{{ @$content->logo_share }}" name="content[logo_share]"  />
								                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
								                               </div>
								                           </div>
								                       </div>
								                    </div>
							               		</div>

							               		<div class="row">
							               			<div class="col-sm-3">
							               				<div class="form-group">
							               					<label for="">Code Google Maps</label>
							               					<textarea name="content[google_maps]" class="form-control" rows="10">{!! @$content->google_maps !!}</textarea>
							               				</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label for="">Facebook chat</label>
															<textarea name="content[facebook_chat]" class="form-control" rows="10">{!! @$content->facebook_chat !!}</textarea>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label for="">Ticktok</label>
														 <input type="text" name="content[ticktok]" class="form-control" value="{!! @$content->ticktok !!}">
														</div>
													</div>
							               			<div class="col-sm-3">
							               				<div class="form-group">
							               					<label for="">Google Analytics</label>
															<input type="text" name="content[google_analytics]" class="form-control" value="{!! @$content->google_analytics !!}">
							               				</div>
							               			</div>
							               			<div class="col-sm-3">
							               				<div class="form-group">
															<label for="">Google Tag Manager</label>
															<input type="text" name="content[google_tag_manager]" class="form-control" value="{!! @$content->google_tag_manager !!}">
							               				</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label for="">Facebook pixel</label>
															<input type="text" name="content[facebook_pixel]" class="form-control" value="{!! @$content->facebook_pixel !!}">
														</div>
													</div>
													
							               		</div>

							               		<div class="row">
							               			<div class="col-sm-12">
							               				<div class="form-group">
								               				<label for="">Email nhận thông tin liên hệ</label>
								               				<input type="email" class="form-control" name="content[email_admin]" value="{{ @$content->email_admin }}">
														</div>
														
			                                            <div class="form-check">
							                                <label class="form-check-label">
								                            	<input class="form-check-input" type="checkbox" name="content[index_google]" value="1" {{ @$content->index_google == 1 ? 'checked' : null }}> 
								                            	<span class="form-check-sign">
									                            	Cho phép google tìm kiếm
									                            </span>
								                            </label>
								                        </div>
						                            </div>
							               			
							               		</div>
							               	</div>

							               	<div class="tab-pane" id="activity1">
							               		<div class="row">
							               			<div class="col-sm-12">
														<div class="form-group">
															<label for="">Tên công ty</label>
															<input type="text" name="content[company]" class="form-control" value="{{ @$content->company }}">
														</div>
														
														<div class="form-group">
														<div class="flex_grp">
																<input type="text" class="text_title" name="content[dcft_text]" value="{{ @$content->dcft_text }}">
																<input type="text" name="content[dcft]" class="form-control" value="{{ @$content->dcft }}">
															</div>
														</div>

														<div class="form-group">
															<div class="flex_grp">
																<input type="text" class="text_title" name="content[xsx_text]" value="{{ @$content->xsx_text }}">
																<input type="text" name="content[xsx]" class="form-control" value="{{ @$content->xsx }}">
															</div>
														</div>

														<div class="form-group">
															<div class="flex_grp">
																<input type="text" class="text_title" name="content[nmsx_text]" value="{{ @$content->nmsx_text }}">
																<input type="text" name="content[nmsx]" class="form-control" value="{{ @$content->nmsx }}">
															</div>
														</div>

														<div class="form-group">
															<div class="flex_grp">
																<input type="text" class="text_title" name="content[tax_code_text]" value="{{ @$content->tax_code_text }}">
																<input type="text" name="content[tax_code]" class="form-control" value="{{ @$content->tax_code }}">
															</div>
														</div>

														<div class="form-group">
															<label for="">Hotline (footer)</label>
															<input type="text" name="content[phone_footer]" class="form-control" value="{{ @$content->phone_footer }}">
														</div>

														<div class="form-group">
															<label for="">Số điện thoại(header)</label>
															<input type="text" name="content[phone]" class="form-control" value="{{ @$content->phone }}">
														</div>

														<div class="form-group">
															<label for="">Email</label>
															<input type="text" name="content[email]" class="form-control" value="{{ @$content->email }}">
														</div>
														
														<div class="form-group">
															<label for="">Liên kết Zalo</label>
															<input type="text" name="content[zalo]" class="form-control" value="{{ @$content->zalo }}">
														</div>
														<div class="form-group">
															<label for="">Website</label>
															<input type="text" name="content[website]" class="form-control" value="{{ @$content->website }}">
														</div>
										            </div>
										            <div class="col-sm-12">
										            	<div class="form-group">
										            		<label for="">Bản quyền chân trang</label>
										            		<input type="text" class="form-control" name="content[copyright]" 
										            		value="{{ @$content->copyright }}">
										            	</div>
										            </div>
							               		</div>
											</div>

											<div class="tab-pane" id="activity8">
							               		<div class="row">
							               			<div class="col-sm-12">
													   <div class="form-group">
														<label for="">Địa chỉ</label>
															<div class="repeater" id="repeater">
															<table class="table table-bordered table-hover address">
																<thead>
																	<tr>
																		<th style="width: 30px;">STT</th>
																		<th>Danh sách địa chỉ</th>
																		<th style="width: 20px;"></th>
																	</tr>
																</thead>
																<tbody id="sortable">
																	@if (!empty($content->address->list))
																		@foreach ($content->address->list as $id => $value)
																			<?php $index = $loop->index + 1 ?>
																			@include('backend.repeater.row-address')
																		@endforeach
																	@endif
																</tbody>
															</table>
															<div class="text-right">
																<button class="btn btn-primary btn-sm" 
																	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'address', '.address')">Thêm
																</button>
															</div>
														</div>
													</div>
													</div>
												</div>
											</div>
											
							               	<div class="tab-pane" id="activity3">
							               		<div class="row">
							               			<div class="col-sm-12">
							               				<div class="form-group">
															<label for="">Tên website</label>
															<input type="text" class="form-control" name="content[site_title]"
															value="{{ @$content->site_title }}">
														</div>

							               				<div class="form-group">
						               						<label for="">Mô tả ngắn</label>
						               						<textarea class="form-control" rows="5" 
						               						name="content[site_description]">{{ @$content->site_description }}</textarea>
							               				</div>

							               				<div class="form-group">
						               						<label for="">Meta keyword</label>
						               						<input type="text" class="form-control" name="content[site_keyword]"
						               						value="{{ @$content->site_keyword }}">
							               				</div>

							               			</div>
							               		</div>
							               	</div>
											
											<div class="tab-pane" id="activity4">
												<div class="row">
													<div class="col-sm-12">
														<div class="repeater" id="repeater">
											                <table class="table table-bordered table-hover social page-table-home">
											                    <thead>
												                    <tr>
																		<th style="width: 30px">STT</th>
												                    	<th>Tên mạng xã hội</th>
												                    	<th class="text-center">Icon</th>
												                    	<th>Liên kết</th>
												                    	<th></th>
												                    </tr>
											                	</thead>
											                    <tbody id="sortable">
											                    	@if (!empty($content->social))
											                    		@foreach ($content->social as $id => $val)
																			<tr>
																				<td class="index">{{ $index = $loop->index + 1  }}</td>
																				<td><input type="text" class="form-control" name="content[social][{{$id}}][name]" value="{{ $val->name }}" ></td>
																				<td class="text-center">
																					<div class="image">
																						<input type="text" class="form-control" name="content[social][{{$id}}][icon]" value="{{ @$val->icon }}">
																					</div>
																				
																				</td>
																				<td>
																			        <input type="text" class="form-control" required="" name="content[social][{{$id}}][link]" value="{{ $val->link }}">
																			    </td>
																			    <td style="text-align: center;">
																			        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
																			            <i class="fa fa-times"></i>
																			        </a>
																			    </td>
																			</tr>
											                    		@endforeach
											                    	@endif
																</tbody>
											                </table>
											                <div class="text-right">
											                    <button class="btn btn-primary btn-sm" 
													            	onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'social', '.social')">Thêm
													            </button>
											                </div>
											            </div>
													</div>
												</div>
											</div>
											
											<div class="tab-pane" id="activity7">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<label for="">Code thẻ head</label>
															<textarea name="content[head]" class="form-control" rows="10">{!! @$content->head !!}</textarea>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label for="">Code thẻ body</label>
															<textarea name="content[body]" class="form-control" rows="10">{!! @$content->body !!}</textarea>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label for="">Code thẻ footer</label>
															<textarea name="content[footer]" class="form-control" rows="10">{!! @$content->footer !!}</textarea>
														</div>
													</div>
												</div>
											</div>
							            </div>
							        </div>
				               		<div class="row">
				               			<div class="col-lg-12">
				               				<button class="btn btn-primary" type="submit">Lưu lại</button>
				               			</div>
				               		</div>
				               	</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection