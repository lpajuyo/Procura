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
	<div class="container-fluid body2">
		<div class="row">
			<div class="filter"> </div>
			<div class="col-lg-3 col-md-3 col-s-3"></div>
			<div class="col-lg-6 col-md-6 col-s-6">
				<form class="form-box2">
					
					<img src="{{'public/images/logo.png'}}" class="tuplogo2" alt="TUP LOGO"> <br>
					<span class="tup2">TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</span> <br><br><br>
					<div class="login-ic">
						<i ></i>
						<input type="text"  value="User name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User name';}"/>
						<div class="clear"> </div>
					</div>
					<div class="login-ic">
						<i class="icon"></i>
						<input type="password"  value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"/>
						<div class="clear"> </div>
					</div>
				
					<div class="log-bwn">
						<input type="submit"  value="Login" >
					</div>
					<!-- <button type="submit" class="btn btn-success btn-block">Login</button> -->	
				</form>
			</div>
			<div class="col-lg-3 col-md-3 col-s-3">
			</div>
		</div>
	</div>