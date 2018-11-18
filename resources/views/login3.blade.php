<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{'bootstrap/css/bootstrap.css' }}">
    <link rel="stylesheet" type="text/css" href="{{'bootstrap/css/bootstrap.min.css' }}" >
    <link rel="stylesheet" type="text/css" href="{{'public/css/login.css' }}">
    <link rel="stylesheet" type="text/css" href="{{'public/css/fonts.css' }}">
    <link rel="stylesheet" type="text/css" href="{{'public/fontawesome/css/fontawesome-all.css'}}">

    <script type="text/javascript" src="{{'public/js/jquery.min.js'}}"></script>
    <script type="text/javascript" src="{{'bootstrap/js/bootstrap.min.js' }}"></script>
</head>

<body>
	<div class="container-fluid body1">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-s-3"></div>
			<div class="col-lg-6 col-md-6 col-s-6">
				<form class="form-box3">
					<img src="{{'public/images/logo.png'}}" class="tuplogo" alt="TUP LOGO"> <br><br>
					<span class="tup">TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</span> <br><br><br>
					<div class="form-group"> 
						<!-- <label></label> -->
						<span class="fa fa-user fa3"></span>
						<input type="text" name="username" id="username" placeholder="username" class="L3-input"> 
					</div>
					<div class="form-group"> 
						<!-- <label></label> -->
						<span class="fa fa-lock fa3"></span>
						<input type="password" name="password" id="password" placeholder="password" class="L3-input">
					</div>
					<button type="submit" class="btn btn-success btn-block btn3">Login</button>
				</form>
			</div>
			<div class="col-lg-3 col-md-3 col-s-3">
			</div>
		</div>
	</div>
</body>
</html>