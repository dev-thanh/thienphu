
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{ getOptions('dev-config', 'title') }}</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ url('/').getOptions('dev-config', 'favicon') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ __URL__ }}/custom/js/webfont.min.js"></script>
	
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ __URL__ }}/bootstrap/fonts/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ __URL__ }}/custom/css/atlantis.css">
	<link rel="stylesheet" href="{{ __URL__ }}/custom/css/custom.css">
</head>
<body class="login">
	<div class="wrapper wrapper-login">
		<form method="post" action="{{ url('/login') }}">
            @csrf
			<div class="container container-login animated fadeIn">
				<h3 class="text-center">Sign In To Admin</h3>
				<div class="login-form">
					<div class="form-group form-floating-label">
						<input id="username" name="user_name" type="text" class="form-control input-border-bottom" value="{{ old('user_name') }}" required>
						<label for="username" class="placeholder">Username</label>
					</div>
					
					<div class="form-group form-floating-label">
						<input id="password" name="password" type="password" class="form-control input-border-bottom" required>
						<label for="password" class="placeholder">Password</label>
						<div class="show-password">
							<i class="icon-eye"></i>
						</div>
					</div>

					@if ($errors->has('user_name'))
                    <span class="help-block">
	                    <strong>{{ $errors->first('user_name') }}</strong>
	                </span>
	                @endif
					<div class="row form-sub m-0">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="rememberme">
							<label class="custom-control-label" for="rememberme">Remember Me</label>
						</div>
						
						<!-- <a href="#" class="link float-right">Forget Password ?</a> -->
					</div>
					<div class="form-action mb-3">
						<button class="btn btn-primary btn-rounded btn-login">Sign In</button>
					</div>
					<!-- <div class="login-account">
						<span class="msg">Don't have an account yet ?</span>
						<a href="#" id="show-signup" class="link">Sign Up</a>
					</div> -->
				</div>
			</div>
		</form>
		<div class="container container-signup animated fadeIn">
			<h3 class="text-center">Sign Up</h3>
			<div class="login-form">
				<div class="form-group form-floating-label">
					<input  id="fullname" name="fullname" type="text" class="form-control input-border-bottom" required>
					<label for="fullname" class="placeholder">Fullname</label>
				</div>
				<div class="form-group form-floating-label">
					<input  id="email" name="email" type="email" class="form-control input-border-bottom" required>
					<label for="email" class="placeholder">Email</label>
				</div>
				<div class="form-group form-floating-label">
					<input  id="passwordsignin" name="passwordsignin" type="password" class="form-control input-border-bottom" required>
					<label for="passwordsignin" class="placeholder">Password</label>
					<div class="show-password">
						<i class="icon-eye"></i>
					</div>
				</div>
				<div class="form-group form-floating-label">
					<input  id="confirmpassword" name="confirmpassword" type="password" class="form-control input-border-bottom" required>
					<label for="confirmpassword" class="placeholder">Confirm Password</label>
					<div class="show-password">
						<i class="icon-eye"></i>
					</div>
				</div>
				<div class="row form-sub m-0">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" name="agree" id="agree">
						<label class="custom-control-label" for="agree">I Agree the terms and conditions.</label>
					</div>
				</div>
				<div class="form-action">
					<a href="#" id="show-signin" class="btn btn-danger btn-link btn-login mr-3">Cancel</a>
					<a href="#" class="btn btn-primary btn-rounded btn-login">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ __URL__ }}/plugins/jquery.3.2.1.min.js"></script>
	<script src="{{ __URL__ }}/plugins/jquery-ui.min.js"></script>
	<script src="{{ __URL__ }}/plugins/popper.min.js"></script>
	<script src="{{ __URL__ }}/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{ __URL__ }}/custom/js/atlantis.min.js"></script>
</body>
</html>