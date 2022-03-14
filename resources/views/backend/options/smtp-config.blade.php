@extends('backend.layouts.app')

@section('content')

	<div class="main-panel">
		<div class="content">
			<div class="page-inner">
				
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Mail config</h4>
							</div>
							<div class="card-body">
						       	@include('flash::message')
								<div class="nav-tabs-custom">
								    <ul class="nav nav-pills nav-secondary">
								        <li class="nav-item">
								            <a class="nav-link active" href="#activity" data-toggle="tab" aria-expanded="true">Cấu hình</a>
								        </li>
								        <li class="nav-item">
								            <a class="nav-link" href="#activity1" data-toggle="tab" aria-expanded="true">Kiểm tra</a>
								        </li>
								    </ul>
								    <div class="tab-content">
								        <div class="tab-pane active" id="activity">
								        	<form action="{{ route('backend.options.smtp-config.post') }}" method="POST">
								        		@csrf
								        		<div class="row">
								        			<div class="col-lg-6">
							                			<div class="form-group">
							                				<label for="">Mail driver</label>
							                				<input type="text" name="content[driver]" class="form-control" value="{{ @$content->driver }}" placeholder="smtp">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Mail host</label>
							                				<input type="text" name="content[host]" class="form-control" value="{{ @$content->host }}" placeholder="smtp.gmail.com">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Mail port</label>
							                				<input type="text" name="content[port]" class="form-control" value="{{ @$content->port }}" placeholder="587">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Mail encryption</label>
							                				<input type="text" name="content[encryption]" class="form-control" value="{{ @$content->encryption }}" placeholder="tls">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Mail username</label>
							                				<input type="text" name="content[username]" class="form-control" value="{{ @$content->username }}">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Mail password</label>
							                				<input type="password" name="content[password]" class="form-control" value="{{ @$content->password }}">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Mail name</label>
							                				<input type="text" name="content[name]" class="form-control" value="{{ @$content->name }}">
							                			</div>
							                			<div class="form-group">
							                				<button type="submit" class="btn btn-primary">Lưu lại</button>
							                			</div>
							                			<p style="color: red; font-style: italic; font-weight: bolder;">Trang này chỉ dành cho dev, Nếu không phải dev vui lòng rời khỏi trang này.</p>
							                		</div>
								        		</div>
								        	</form>
								        </div>
								        <div class="tab-pane" id="activity1">
								        	<form action="{{ route('backend.options.send-mail.post') }}" method="POST">
								        		@csrf
								        		<div class="row">
								        			<div class="col-lg-6">
							                			<div class="form-group">
							                				<label for="">Tới</label>
							                				<input type="text" name="smtp_email" class="form-control" value="" placeholder="Email">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Tiêu đề</label>
							                				<input type="text" name="smtp_title" class="form-control" value="" placeholder="Tiêu đề">
							                			</div>
							                			<div class="form-group">
							                				<label for="">Tin nhắn</label>
							                				<textarea class="form-control" rows="5" name="smtp_message"></textarea>
							                			</div>
							                			<div class="form-group">
							                				<button type="submit" class="btn btn-primary">Gửi thử email</button>
							                			</div>
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
			</div>
		</div>
	</div>
@endsection