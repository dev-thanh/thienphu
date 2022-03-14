@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Css, js config</h4>
							</div>
							<div class="card-body">
								@include('flash::message')
								<form action="{{ route('backend.options.css-js.post') }}" method="POST">
				               		@csrf
				               		<div class="row">
				               			<div class="col-sm-12">
					                    	<div class="form-group">
					                    		<div class="form-group">
					                    		<label>Vui lòng nhập css cần thêm</label>
				               						<textarea class="form-control" rows="5" name="content[css]" style="min-height: 300px">{!! @$content->css !!}</textarea>
					               				</div>
					                    	</div>
					                    	<div class="form-group">
					                    		<div class="form-group">
						                    		<label>Vui lòng nhập js cần thêm</label>
				               						<textarea class="form-control" rows="5" name="content[js]" style="min-height: 300px">{!! @$content->js !!}</textarea>
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