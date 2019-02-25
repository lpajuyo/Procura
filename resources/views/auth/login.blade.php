<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('/pd/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome/css/fontawesome-all.css') }}">

    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/pd/js/core/bootstrap.min.js') }}"></script>
</head>

<body>
	<div class="container-fluid newbody">
		<div class="row">

			<div class="col-lg-2 col-md-2"></div>

			<div class="col-lg-8 col-md-8">

				<div class="wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-5 col-md-5 leftpanel">
								<div class="title">
									<img id="logospin" src="{{ asset('/images/logo.png') }}">
									<p> <strong>TECHNOLOGICAL UNIVERSITY </strong> <br> OF THE <strong> PHILIPPINES </strong></p>
								</div>

								<form method="POST" action="{{ route('login') }}">
									@csrf

									<div class="form-group"> 
										<!-- <label></label> -->
										<span class="fa fa-user fa4"></span>
										<input type="text" name="username" id="username" placeholder="username" class="input-underline" value="{{ old('username') }}">
										@if ($errors->has('username'))
											<span class="text-danger" role="alert" style="font-size:13px; margin-left:10px;">
												<strong>{{ $errors->first('username') }}</strong>
											</span>
				                        @endif 
									</div>
									
									<div class="form-group"> 
										<!-- <label></label> -->
										<span class="fa fa-lock fa4"></span>
										<input type="password" name="password" id="password" placeholder="password" class="input-underline">
										@if ($errors->has('password'))
											<span class="text-danger" role="alert" style="font-size:13px; margin-left:10px;">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
										@endif
									</div>
									
									<button type="submit" class="btn-5 fa fa-lock-open"><span>LOGIN</span></button>
								
								</form>
							</div>

							<div class="col-lg-7 col-md-7 rightpanel">
								<h4><strong> Better Procurement System. <br> Better Work Place. </strong></h4> <br>
								{{-- <p style="font-size: 13px;">Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit. Cras eros sem, laoreet quis <br> mollis vel, vestibulum in arcu.</p>	 --}}
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="col-lg-2 col-md-2"></div>

		</div>
	</div>
</body>
</html>