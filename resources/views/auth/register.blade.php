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
                        <select class="form-control" id="type-dropdown" name="user_type_id">
                              <option selected disabled value="0">--Select User Type--</option>
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
                  <div class="col-md-4 pr-1" style="margin-right: 50px;" id="sector-form-group">
                     <div class="form-group">
                        <label>Sector:</label>
                        <select class="form-control" id="sector-dropdown" name="sect-dept">
                           <option selected disabled value="0">--Select Sector--</option>
                           @foreach ($sectors as $sector)
                              <option value="{{ $sector->id }}" {{ $sector->id == old('sect-dept') ? 'selected' : '' }}>{{ $sector->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4 pr-1" style="margin-right: 50px;" id="open-sector-form-group">
                     <div class="form-group">
                        <label>Available Sectors:</label>
                        <select class="form-control" name="sector_id">
                           @foreach ($availSectors as $sector)
                              <option value="{{ $sector->id }}" {{ $sector->id == old('sector_id') ? 'selected' : '' }}>{{ $sector->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4 pl-1"  id="department-form-group">
                     <div class="form-group">
                        <label>Available Departments:</label>
                        <select class="form-control" name="department_id" id="dept-dropdown">
                           <option selected disabled value="0">--Select Sector--</option>
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
   $(document).ready(function(){
      $("#sector-form-group, #department-form-group,#open-sector-form-group").hide();

      $("#type-dropdown").change(function(){
         if($(this).val() == 1){
            $("#sector-form-group, #department-form-group").show();
            $("#open-sector-form-group").hide();
         }
         else if($(this).val() == 3){
            $("#open-sector-form-group").show();
            $("#department-form-group").hide()
            $("#sector-form-group").hide()
         }
         else if($(this).val() == 2 || $(this).val() == 4){
            $("#sector-form-group, #department-form-group, #open-sector-form-group").hide();
         }
      })

      $("#sector-dropdown").change(function(){
         var sector_id = $(this).val();
         var departments = @json($departments)

         $("#dept-dropdown").html('<option selected disabled value="0">--Select Department--</option>');

         var filteredItems = $.grep(departments, function(elem, index){
			if(elem.sector_id == sector_id)
				return true;
         })

         $.each(filteredItems, function(index, val){
            $("#dept-dropdown").append('<option value=' + val.id + '>' + val.name + '</option>');
         });
      })

      $("#type-dropdown").val({{ old('user_type_id') }}).trigger('change');
      $("#sector-dropdown").val({{ old('sect_dept') }}).trigger('change');
      $("#dept-dropdown").val({{ old('department_id') }}).trigger('change');
   });
</script>
@endsection