<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ @$devSetting->title }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ url('/').@$devSetting->favicon }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ __URL__ }}/plugins/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ __URL__ }}/custom/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ __URL__ }}/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ __URL__ }}/custom/css/atlantis.min.css">
	<link rel="stylesheet" href="{{ url('public/backend/custom/css/jquery.toast.min.css') }}">
	<link rel="stylesheet" href="{{ __URL__ }}/custom/css/custom.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ __URL__ }}/custom/css/demo.css">

	<script src="{{ __URL__ }}/core/jquery.3.2.1.min.js"></script>
	
	<script src="{{ asset('public/backend/plugins/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('public/backend/plugins/ckfinder/ckfinder.js') }}"></script>

	<script type="text/javascript">
        function homeUrl() {
            return "{!! url('/') !!}";
        }
    </script>
</head>
<?php if(!empty($options->content)){
	$contents = json_decode($options->content);
} ?>
<body data-background-color="{{ !empty($contents->backgroundColor) ? $contents->backgroundColor : 'white' }}">
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="{{ !empty($contents->logoHeaderColor) ? $contents->logoHeaderColor : 'dark2' }}">
				
				<a href="{{route('home')}}" class="logo" title="Xem website" target="_blank">
					<img src="{{ url('/').@$devSetting->logo }}" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="{{ !empty($contents->topbarColor) ? $contents->topbarColor : 'dark' }}">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
						@php $countNotifi = DB::table('notifications')->where('read_at',null)->get(); @endphp
						<li class="nav-item dropdown hidden-caret notifications__content">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification count-notification">{{count($countNotifi)}}</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								@if(count($countNotifi))
								<li>
									<div class="dropdown-title dropdown-title-count">Bạn có {{count($countNotifi)}} thông báo chưa xem</div>
								</li>
								<li>
									<?php $notifi = DB::table('notifications')->where('read_at',null)->orderBy('created_at','DESC')->get(); ?>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center list-notifications">
											@foreach($notifi as $item)
											<?php $data = json_decode($item->data); ?>
											<a href="{{@$data->contact_id ? route('contact.edit', @$data->contact_id) : ''}}">
												<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
												<div class="notif-content">
													<span class="block">
														{{@$data->title}} <b>{{@$data->name}}</b>
													</span>
													<span class="time">{{\Carbon\Carbon::parse(@$item->created_at)->diffForHumans()}}</span> 
												</div>
											</a>
											@endforeach
										</div>
									</div>
								</li>
								<!-- <li>
									<a class="see-all" href="javascript:void(0);">Xem thêm<i class="fa fa-angle-right"></i> </a>
								</li> -->
								@else
									<li>
										<div class="dropdown-title dropdown-title-count">Chưa có thông báo mới</div>
									</li>
								@endif
							</ul>
						</li>
						
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{url('/').auth()->user()->image}}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{url('/').auth()->user()->image}}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{auth()->user()->name}}</h4>
												<p class="text-muted">{{auth()->user()->email}}</p>
												<!-- <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a> -->
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id ) }}">Thông tin</a>
										<a class="dropdown-item" href="#">Inbox</a>
										<div class="dropdown-divider"></div>
										<!-- <a class="dropdown-item" href="#">Account Setting</a> -->
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); check();">Logout</a>
									</li>
									<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		@include('backend.layouts.sidebar')
		<!-- End Sidebar -->

		@yield('content')
		
		<!-- Custom template | don't include it in your project! -->
		
		<div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch LogoHeaderColor">
							<button type="button" class="@if(@$contents->logoHeaderColor == 'dark') selected @endif changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'blue') selected @endif changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'purple') selected @endif changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'light-blue') selected @endif changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'green') selected @endif changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'orange') selected @endif changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'red') selected @endif changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'white') selected @endif changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'dark2') selected @endif changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'blue2') selected @endif changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'purple2') selected @endif changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'light-blue2') selected @endif changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'green2') selected @endif changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'orange2') selected @endif changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="@if(@$contents->logoHeaderColor == 'red2') selected @endif changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch TopBarColor">
							<button type="button" class="@if(@$contents->topbarColor == 'dark') selected @endif changeTopBarColor" data-color="dark"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'blue') selected @endif changeTopBarColor" data-color="blue"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'purple') selected @endif changeTopBarColor" data-color="purple"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'light-blue') selected @endif changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'green') selected @endif changeTopBarColor" data-color="green"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'orange') selected @endif changeTopBarColor" data-color="orange"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'red') selected @endif changeTopBarColor" data-color="red"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'white') selected @endif changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="@if(@$contents->topbarColor == 'dark2') selected @endif changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'blue2') selected @endif changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'purple2') selected @endif changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'light-blue2') selected @endif changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'green2') selected @endif changeTopBarColor" data-color="green2"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'orange2') selected @endif changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="@if(@$contents->topbarColor == 'red2') selected @endif changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch sidebarColor">
							<button type="button" class="@if(@$contents->sidebarColor == 'white') selected @endif changeSideBarColor" data-color="white"></button>
							<button type="button" class="@if(@$contents->sidebarColor == 'dark') selected @endif changeSideBarColor" data-color="dark"></button>
							<button type="button" class="@if(@$contents->sidebarColor == 'dark2') selected @endif changeSideBarColor" data-color="dark2"></button>
							<button type="button" class="@if(@$contents->sidebarColor == 'purple') selected @endif changeSideBarColor" data-color="purple"></button>
							<button type="button" class="@if(@$contents->sidebarColor == 'green') selected @endif changeSideBarColor" data-color="green"></button>
							<button type="button" class="@if(@$contents->sidebarColor == 'orange') selected @endif changeSideBarColor" data-color="orange"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Background</h4>
						<div class="btnSwitch BackgroundColor">
							<button type="button" class="@if(@$contents->backgroundColor == 'bg2') selected @endif changeBackgroundColor" data-color="bg2"></button>
							<button type="button" class="@if(@$contents->backgroundColor == 'bg1') selected @endif changeBackgroundColor" data-color="bg1"></button>
							<button type="button" class="@if(@$contents->backgroundColor == 'bg3') selected @endif changeBackgroundColor" data-color="bg3"></button>
							<button type="button" class="@if(@$contents->backgroundColor == 'dark') selected @endif changeBackgroundColor" data-color="dark"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="flaticon-settings"></i>
			</div>
		</div>
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	

	<script src="{{ __URL__ }}/core/popper.min.js"></script>

	<script src="{{ __URL__ }}/core/bootstrap.min.js"></script>

	<script src="{{ __URL__ }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

	<!-- <script src="{{ __URL__ }}/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script> -->

	<!-- jQuery Scrollbar -->
	<script src="{{ __URL__ }}/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Chart JS -->
	<script src="{{ __URL__ }}/plugins/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ __URL__ }}/plugins/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Datatables -->
	<script src="{{ __URL__ }}/plugins/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ __URL__ }}/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- Sweet Alert -->
	<!-- <script src="{{ __URL__ }}/plugins/sweetalert/sweetalert.min.js"></script> -->

	<!-- Atlantis JS -->
	<script src="{{ __URL__ }}/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<!-- <script src="{{ __URL__ }}/demo.js"></script> -->
	<script src="{{ __URL__ }}/setting-demo.js"></script>
	
	<!-- <script src="{!! asset('public/tinymce/tinymce.min.js') !!}"></script> -->
	<script src="{{ url('public/backend/cus/jquery.nestable.js') }}"></script>

	<script src="{{ url('public/backend/custom/js/jquery.toast.min.js') }}"></script>

	<script src="{{ url('public/backend/cus/myscript.js') }}"></script>

	<script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    <script type="text/javascript">
    
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            encrypted: true,
            cluster: "ap1"
        });

        var channel = pusher.subscribe('contact-pusher');

        channel.bind('new-contact', function(data) {

		    $.ajax({

				type: 'GET',

				url: '{{route('get-notifications')}}',

				success:function(data){

					$('.notifications__content').html(data);

				},error:function(){

					
				}

			});
		});

    </script>

	<script>
		function check(){
	        var check = confirm('Bạn có chắc chắn muốn đăng xuất ?');
	        if(check == true){
	            document.getElementById('logout-form').submit();
	        }
	        return false;
	        
	    }
	    @if(Session::has('success'))
		    $.notify({
				icon: 'flaticon-alarm-1',
				title: 'Thông báo',
				message: '{{ session('success') }}',
			},{
				type: 'success',
				placement: {
					from: "bottom",
					align: "right"
				},
				time: 1000,
			});
	    @endif
		$('#lineChart').sparkline([102,109,120,99,110,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});

		$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});

		$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: 'rgba(255, 255, 255, .5)',
			fillColor: 'rgba(255, 255, 255, .15)'
		});
	</script>
	@yield('scripts')
	@include('backend.layouts.modal')
</body>
</html>