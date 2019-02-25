@extends('bo_main') 
@section('title', 'Users') 
@section('user-active', 'active') 
@section('admin-dropdown-show', 'show')

@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 10px; padding-right: 10px;">

	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 5px;">
				<div>
					<p style="position: absolute; font-size: 25px;"> User List </p>
					<a href="{{ route('register') }}" class="btn btn-default" style="right: 30px; position: absolute !important;">
				  	<i class="fa fa-plus"></i> &nbsp;Add user
					</a>
				</div><br><br><br>
				<div class="table-responsive" style="overflow: visible;">
					<table class="table table-striped table-bordered">
						<thead>
							<tr class=" text-primary">
								<th>Username</th>
								<th>Full Name</th>
								<th>Position</th>
								<th>Sector</th>
								<th>Department</th>
								<th>User Type</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>

						<tbody class="minrow">
							@foreach ($users as $user)
							<tr>
								<td>{{ $user->username }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->position }}</td>
								<td>{{ $user->userable->sector->name ?? $user->userable->department->sector->name ?? ($user->type->name == 'Budget Officer'
									? 'Administration and Finance' : '--') }}</td>
								<td>{{ $user->userable->department->name ?? ($user->type->name == 'Budget Officer' ? 'Budget Office' : '--') }}</td>
								<td>{{ $user->type->name }}</td>
								<td class="td-actions text-center">
									{{-- @can('update', $user) --}}
									<button type="button" rel="tooltip" title="Edit User" class="btn btn-warning btn-simple btn-sm edit-user-btn" data-user-id="{{ $user->id }}">
					                    <i class="fa fa-edit"></i>
													</button> {{-- @endcan --}} {{-- @can('delete', $user) --}}
									<button type="submit" form="{{ 'del-type-' . $user->id }}" rel="tooltip" title="Delete User" class="btn btn-danger btn-simple btn-sm">
										<i class="fa fa-times"></i>
									</button>
									<form style="display: none;" id="{{ 'del-type-' . $user->id }}" method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
										@csrf @method('DELETE')
									</form>
									{{-- @endcan --}}
								</td>
							</tr>
							@endforeach

						</tbody>

					</table>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('modals')
<!-- MODAL FOR EDIT USER -->
<div id="edit-user-modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Edit User</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST">
					@csrf @method('PATCH')
					<div class="form-group">
						<label>Username:</label>
						<input type="text" class="form-control" placeholder="" value="{{ old('username') }}" name="username">
					</div><br>

					<div class="form-group">
						<label>Full Name:</label>
						<input type="text" class="form-control" placeholder="" value="{{ old('name') }}" name="name">
					</div><br>

					<div class="form-group">
						<label>Position:</label>
						<input type="text" class="form-control" placeholder="" value="{{ old('position') }}" name="position">
					</div><br>

					@if ($errors->edit->any())
					<div class="alert alert-danger" role="alert">
						@foreach ($errors->edit->all() as $error)
						<p>{{ $error }}</p>
						@endforeach
					</div>
					@endif

					<button type="submit" class="btn btn-success btn-block">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('scripts')
<script>
	$(document).ready(function(){
		$("table").DataTable({
			"order": []
		});
	});
</script>
@if ($errors->edit->any())
<script>
	$("#edit-user-modal form").attr('action', "{{ url('/users') . '/' . session('id') . '/admin' }}"); //form action="example.com/budget_years/{id}"
	$('#edit-user-modal').modal('show')
</script>
@endif
<!-- Show edit user modal with appropriate input values -->
<script>
	$('.edit-user-btn').click(function(){
		var id = $(this).attr('data-user-id');
		var url = "{{ url()->current() }}" + "/" + id + "/edit"; //example.com/budget_years/{id}/edit
		
		$.ajax({
			url: url, 
			dataType: "json"
		}).done(function(user){
			$("#edit-user-modal [role=alert]").remove();
			$("#edit-user-modal form").attr('action', url.replace("/edit", "/admin")); //form action="example.com/budget_years/{id}"
			$("#edit-user-modal [name=username]").val(user.username);
			$("#edit-user-modal [name=name]").val(user.name);
			$("#edit-user-modal [name=position]").val(user.position);
			
			$('#edit-user-modal').modal();
		});
	});

</script>

<!-- Put comma while typing numbers on budget year modal -->
<!-- <script type="text/javascript">
$('input.comma').keyup(function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
</script> -->

<!-- <script type="text/javascript">
function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
$(document).ready(function() {
  $("input.comma").each(function() {
    var num = $(this).text();
    var commaNum = numberWithCommas(num);
    $(this).text(commaNum);
  });
});
</script> -->

<!-- <script>
var el = document.querySelector('input.comma');
el.addEventListener('keyup', function (event) {
  // if (event.which >= 37 && event.which <= 40) return;

  this.value = this.value.replace(/\D/g, '')
                         .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
});
</script> -->
@endsection