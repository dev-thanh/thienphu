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
								<div class="card-header card-header-category">
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
													<label for="">Tiêu đề video</label>
													<input type="text" class="form-control" name="name" value="{{ old('name', @$data->name) }}">
												</div>
												
												<div class="form-group">
													<label for="">Url video</label>
													<input type="text" id="dSuggest" name="url" class="form-control" value="{{ old('url', @$data->url) }}">
												</div>
                                                <input type="hidden" name="videoId" value="">
                                                <input type="hidden" name="desc" value="{{@$data->desc}}">
                                                <div class="video__youtube__show" style="padding:30px">
													{!! @$data->desc !!}
												</div>
												
												<div class="form-check">
					                                <label class="form-check-label">
						                            	<input class="form-check-input" type="checkbox" name="show" value="1" {{ @$data->show == 1 ? 'checked' : null }}> 
						                            	<span class="form-check-sign">
							                            	Hiển thị video ngoài trang chủ
							                            </span>
						                            </label>
						                        </div>
						                    </div>
						                    <div class="tab-pane" id="setting">
						                    	<div class="row">
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
    @section('scripts')
        <script>
            function getId(url) {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                var match = url.match(regExp);

                if (match && match[2].length == 11) {
                    return match[2];
                } else {
                    return 'error';
                }
            }

            $('#dSuggest').keyup(function() {

                var dInput = this.value;

                var myId = getId(dInput);
                
                var embedUrl = 'https://www.youtube.com/embed/'+myId;

                var iframe = '<iframe width="100%" height="auto" src="https://www.youtube.com/embed/'+myId+'"></iframe>';

                $('input[name="videoId"]').val(myId);

                $('input[name="desc"]').val(iframe);

                $('.video__youtube__show').html(iframe);
            });

           
        </script>
    @endsection
@endsection