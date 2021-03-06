@extends('bo_main') 
@section('title', 'Settings') 
@section('content')

<div class="row">
  <div class="col-lg-4 col-md-12">
    <div class="card card-user">
      <div class="image">
        <img src="{{ asset('/images/bg1.jpg') }}">
      </div>

      <div class="card-body profile-body">
        <div class="author">
          <a class="user-account">
                    <img src="{{ asset('storage/'.$user->user_image) }}" class="img-responsive rounded-circle user-photo" alt="User Profile Picture" style="width: 250px; height: 250px;"> <br><br>
                    @if ($user->user_signature != null)
                    <img src="{{ asset('storage/'.$user->user_signature) }}" style="width: 50%; height: 50%;" alt="User Signature">
                    @endif
                    <h5 class="title text-primary" style="margin-bottom: 0px; padding-bottom: 0px;">{{ $user->name }}</h5>
                    <hr>
                  </a>
          <p class="description"> {{ $user->position }} </p>
          <!-- <p class="text-left description">
                  	SECTOR: <span> academic affairs</span><br>
                  	DEPARTMENT: <span> mathematics </span><br>
                  	USER TYPE: <span> department head </span>
                  </p> -->
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-8 col-md-12">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-user">
          <div class="card-header">
            <span class="card-title" style="font-size:18px; font-weight:bold;"> EDIT PROFILE</span>
          </div>
          <div class="card-body edit-profile">

            @include('errors')

            <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
              @csrf @method('PATCH')
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" placeholder="" value="{{ $user->name }}" name="name">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="" value="{{ $user->username }}" name="username">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-1" style="margin-left: 30px;"></div>
                <div class="col-md-3 pr-1">
                  <div class="update ml-auto mr-auto">
                    <button type="submit" class="btn btn-info btn-round">Update Profile</button>
                  </div>
                </div>

                <div class="col-md-3 pl-1">
                  <div class="update ml-auto mr-auto">
                    <button type="button" class="btn btn-danger btn-round" onclick="resetEditForm()">Discard Changes</button>
                  </div>
                </div>

                <div class="col-md-3 px-1">
                  <div class="update ml-auto mr-auto">
                    <span class="btn btn-warning btn-round" data-toggle="modal" data-target="#changepass">Change Password
                      	</span>
                  </div>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-lg-12">
        <div class="card card-user">
          <!-- <div class="card-header">
	                <span class="card-title" style="font-size:18px; font-weight:bold;"> CHANGE PROFILE PICTURE</span>
	              </div> -->
          <div class="card-body">
            <form method="POST" action="{{ route('users.update_picture', ['user' => $user->id]) }}" enctype="multipart/form-data">
              @csrf @method('PATCH')
              <span class="card-title" style="font-size:17px; font-weight:bold;"> UPLOAD PROFILE PICTURE</span>

              <div>
                <input type="file" class="dropify" data-height="170" data-allowed-file-extensions="png jpg" name="user_image">
              </div>

              <button type="submit" class="btn btn-success btn-sm btn-block">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card card-user">
          <!-- <div class="card-header">
                    <span class="card-title" style="font-size:18px; font-weight:bold;"> CHANGE PROFILE PICTURE</span>
                  </div> -->
          <div class="card-body">
            <form id="signature-form" method="POST" action="{{ route('users.update_signature', ['user' => $user->id]) }}" enctype="multipart/form-data">
              @csrf @method('PATCH')
              <span class="card-title" style="font-size:17px; font-weight:bold;"> SET SIGNATURE</span>
              <input type="hidden" name="user_signature" value="">
              {{-- <div>
                <input type="file" class="dropify" data-height="170" data-allowed-file-extensions="png jpg" name="user_image">
              </div> --}}
              <div id="signature-pad" class="signature-pad">
                <div class="signature-pad--body">
                  <canvas></canvas>
                </div>
                <div class="signature-pad--footer">
                  <div class="description">Sign above</div>
            
                  <div class="signature-pad--actions">
                    <div>
                      <button type="button" class="button clear" data-action="clear">Clear</button>
                      {{-- <button type="button" class="button" data-action="change-color">Change color</button>
                      <button type="button" class="button" data-action="undo">Undo</button> --}}
            
                    </div>
                    {{-- <div>
                      <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                      <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
                      <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
                    </div> --}}
                  </div>
                </div>
              </div>            

              <button type="submit" class="btn btn-success btn-sm btn-block">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!----- END COL-LG-8--------->
</div>
<!----- END ROW--------->
@endsection
 
@section('modals')
<div id="changepass" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #f4f3ef;">
        <p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:16px; font-weight: bold;">
          CHANGE PASSWORD &nbsp;<i class="fas fa-lock"></i> </p>
        <!-- 
            <button type="button" class="close" data-dismiss="modal">&times;</button> -->
      </div>

      <div class="modal-body">
        <form method="POST" action="{{ route('users.update_password', ['user' => $user->id]) }}">
          @csrf @method('PATCH')
          <div class="form-group">
            <label for="newpass">Current Password:</label>
            <input type="password" class="form-control" name="current_password">
          </div>

          <div class="form-group">
            <label for="newpass">New Password:</label>
            <input type="password" class="form-control" name="password">
          </div>

          <div class="form-group" style="margin-bottom: 20px;">
            <label for="confirm">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm" name="password_confirmation">
          </div>

          <button type="submit" class="btn btn-success btn-block">CHANGE</button>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
 
@section('scripts')
<script>
  $(function() {
    $('.dropify').dropify();
  });

</script>
<script>
  function resetEditForm(){
    $("[name='name']").val('{{ $user->name }}')
    $("[name='username']").val('{{ $user->username }}')
  }

</script>
{{-- signature --}}
<script>
  $(document).ready(function(){
    var canvas = document.querySelector("canvas");

    // Make it visually fill the positioned parent
    canvas.style.width ='100%';
    canvas.style.height='100%';
    // ...then set the internal size to match
    canvas.width  = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight * 2;
 
    var signaturePad = new SignaturePad(canvas);

    $('[data-action="clear"]').click(function(){
      signaturePad.clear();
    });

    $('#signature-form [type="submit"]').click(function(event){
      event.preventDefault();
      if (signaturePad.isEmpty()) {
        alert("Please provide a signature first.");
      } else {
        var dataURL = signaturePad.toDataURL();
        $('[name="user_signature"]').val(dataURL);
        $('#signature-form').submit();
      }
    });
  });
</script>
@endsection