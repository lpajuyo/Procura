@extends('bo_main') 
@section('title', 'Register')
@section('admin-active', 'active') 
@section('admin-dropdown-show',
'show') 
@section('register', 'active') 


@section('content')
<div class="row" style="padding-left: 30px; padding-right: 20px;">
	<div class="col-lg-12">
        <div class="card card-user">
        <div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
        	<p style="font-size: 21px; margin-bottom: 10px; padding-bottom: 0px; bottom: 0;"> REGISTER NEW USER
				<i class="fas fa-user-plus" style="margin-left: 10px; "></i><br>
			</p><br>
            <form>
              <div class="row">
              	<div class="col-md-1"></div>
              	<div class="col-md-4 pr-1" style="margin-right: 50px;">
                   <div class="form-group">
                      <label>Full Name:</label>
                      <input type="text" class="form-control" placeholder="" value="">
                   </div>
                </div>
                <div class="col-md-4 pl-1">
                   <div class="form-group">
                     <label>Username:</label>
                     <input type="text" class="form-control" placeholder="" value="">
                   </div>
                </div>
              </div>

              <div class="row">
              	<div class="col-md-1"></div>
              	<div class="col-md-4 pr-1" style="margin-right: 50px;">
                   <div class="form-group">
                      <label>New Password:</label>
                      <input type="text" class="form-control" placeholder="" value="">
                   </div>
                </div>
                <div class="col-md-4 pl-1">
                   <div class="form-group">
                     <label>Confirm Password:</label>
                     <input type="text" class="form-control" placeholder="" value="">
                   </div>
                </div>
              </div>

               <div class="row">
               	<div class="col-md-1"></div>
              	<div class="col-md-4 pr-1" style="margin-right: 50px;">
                   <div class="form-group">
                      <label>Sector:</label>
                      <select class="form-control" id="">
				      	<option>Administration</option>
				      </select>
                   </div>
                </div>
                <div class="col-md-4 pl-1">
                   <div class="form-group">
                     <label>Department:</label>
                     <select class="form-control" id="">
				      	<option>Administration</option>
				      </select>
                   </div>
                </div>
              </div>

              <div class="row" style="padding-bottom: 30px;">
              	<div class="col-md-1"></div>
              	<div class="col-md-4 pr-1" style="margin-right: 50px;">
                   <div class="form-group">
                      <label>User Type:</label>
                      <select class="form-control" id="">
				      	<option>Admin</option>
				      </select>
                   </div>
                </div>
                <div class="col-md-4 pl-1" style="padding-top: 15px;">
                   <button type="submit" class="btn btn-success btn-round">Register New User</button>
                   <button type="submit" class="btn btn-danger btn-round">Discard </button>
                </div>
              </div>
            </form>
        </div>

      </div>
    </div>
</div>
@endsection