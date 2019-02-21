@extends('bo_main') 
@section('title', 'Register') 
@section('admin-active', 'active') 
@section('admin-dropdown-show', 'show')

@section('register', 'active') 
@section('content')
<div class="row" style="padding-left: 30px; padding-right: 20px;">
   <div class="col-lg-12">
      <div class="card card-user">
         <div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
            <p style="font-size: 21px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> REGISTER NEW USER
               <i class="fas fa-user-plus" style="margin-left: 10px; "></i><br>
            </p><br>
   @include('errors')
            <form method="POST" action="{{ route('register') }}">
               @csrf
               <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-4 pr-1" style="margin-right: 50px;">
                     <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" placeholder="" value="{{ old('name') }}" name="name">
                     </div>
                  </div>
                  <div class="col-md-4 pl-1">
                     <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" placeholder="" value="{{ old('username') }}" name="username">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-4 pr-1" style="margin-right: 50px;">
                     <div class="form-group">
                        <label>New Password:</label>
                        <input type="password" class="form-control" placeholder="" value="" name="password">
                     </div>
                  </div>
                  <div class="col-md-4 pl-1">
                     <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="" value="" name="password_confirmation">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-4 pr-1" style="margin-right: 40px;">
                     <div class="form-group">
                        <label>User Type:</label>
                        <select class="form-control" id="" name="user_type_id">
                           @foreach ($userTypes as $type)
                              <option value="{{ $type->id }}" {{ $type->id == old('user_type_id') ? 'selected' : '' }}>{{ $type->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4 pr-1">
                     <div class="form-group">
                        <label>Position:</label>
                        <input type="text" class="form-control" placeholder="" value="{{ old('position') }}" name="position">
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-4 pr-1" style="margin-right: 50px;">
                     <div class="form-group">
                        <label>Sector:</label>
                        <select class="form-control" id="" name="sector_id">
                           @foreach ($sectors as $sector)
                              <option value="{{ $sector->id }}" {{ $sector->id == old('sector_id') ? 'selected' : '' }}>{{ $sector->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4 pl-1">
                     <div class="form-group">
                        <label>Department:</label>
                        <select class="form-control" id="" name="department_id">
                           @foreach ($departments as $dept)
				      	         <option value="{{ $dept->id }}" {{ $dept->id == old('department_id') ? 'selected' : '' }}>{{ $dept->name }}</option>
                           @endforeach
				            </select>
                     </div>
                  </div>
               </div>
               <div class="row">
               <div class="col-md-5"></div>
               <div class="col-md-4 pl-1" style="padding-top: 15px;">
                  <button type="submit" class="btn btn-success btn-round">Register New User</button>
                  <button type="reset" class="btn btn-danger btn-round">Discard </button>
               </div>
         </div>
         </form>
      </div>

   </div>
</div>
</div>
@endsection
 
@section('scripts')
<script>
   $("type-dropdown").change(function(){
      
   })
</script>
@endsection