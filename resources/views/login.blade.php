<!DOCTYPE html>
<html>
<head>
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
	<div class="container-fluid body1">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-s-3"></div>
			<div class="col-lg-6 col-md-6 col-s-6">
				<form class="form-box">
					<img src="{{ asset('/images/logo.png') }}" class="tuplogo" alt="TUP LOGO"> <br><br>
					<span class="tup">TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</span> <br><br><br>
					<div class="form-group"> 
						<!-- <label></label> -->
						<span class="fa fa-user fa1"></span>
						<input type="text" name="username" id="username" placeholder="username" class="L1-input"> 
					</div>
					<div class="form-group"> 
						<!-- <label></label> -->
						<span class="fa fa-lock fa1"></span>
						<input type="password" name="password" id="password" placeholder="password" class="L1-input">
					</div>
					<button type="submit" class="btn btn-success btn-block">Login</button>
				</form>
			</div>
			<div class="col-lg-3 col-md-3 col-s-3">
			</div>
		</div>
	</div>
    
<!-- <script type="text/javascript">
	$(document).ready(function(){
		$("#username").focus(function(){
			$("span").css ("visibility", "visible");
		});
	});
</script> -->

</body>
</html>