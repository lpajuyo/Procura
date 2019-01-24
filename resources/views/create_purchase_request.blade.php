@extends('bo_main') 

@section('title', 'Create Purchase Request')

@section('brand', 'PPMP')



@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 23px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> CREATE PURCHASE REQUEST 
					<i class="fas fa-box" style="margin-left: 10px; "></i><br>
					<!-- <span style="font-size: 15px;">Project Procurement Management Plan</span> -->
					<!-- <a href="" data-toggle="modal" data-target="#additem" id="create2"><span class="fas fa-plus fa-xs"></span> </a> -->
				</p><br><br>
				
				<!-- <div class="row">
					<div class="col-lg-12"> -->
						<form method="POST" action="{{ route('purchase_requests.store') }}">
						@csrf
							<div class="row" style="padding:0px 30px 5px 0px;">
								<div class="col-lg-2"></div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="Purchase Request No.">Purchase Request No.:</label>
		                    			<input name="pr_number" value="{{ $pr_number }}" type="text" class="form-control" id="PRnum" readonly>
									</div>
								</div>

								<div class="col-lg-4">
			                      <div class="form-group">
			                        <label for="Project">Project:</label>
			                        <select name="project_id" class="form-control" id="Project">
										<option disabled selected>--Select Project--</option>
										@foreach($projects as $project)
										<option value="{{ $project->id }}">{{ $project->title }}</option>
										@endforeach
								    </select>
			                      </div>
			                    </div>
							</div>

							<div class="row" style="padding:0px 30px 5px 0px;">
								<div class="col-lg-2"></div>
			                    <div class="col-lg-8">
			                    	<div class="form-group">
										<label for="Purpose">Purpose:</label>
		                    			<input name="purpose" value="{{ old('purpose') }}" type="text" class="form-control" id="Purpose">
									</div>
			                    </div>
							</div>
						

							@include('errors')

						<div style="padding: 10px 0px 20px 300px; width: 60%;" class="text-center">
							<button type="submit "class="btn btn-success btn-block makeppmp">Create Purchase Request</button>
						</div>
						</form>
					<!-- </div>
				</div> -->
			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<!-- <script type="text/javascript">
$('button.makeppmp').click(function(e) {
	e.preventDefault();
	swal({
	  type: 'success',
	  title:'SUCCESS',
	  text: 'Your ppmp was successfully created!',
	  timer: 1500,
	  showCancelButton: false,
	  showConfirmButton: false
	});
	// swal("SUCCESS", "Your ppmp was successfully created", "success");
});
</script> -->
@endsection