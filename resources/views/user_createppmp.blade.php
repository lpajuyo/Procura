@extends('bo_main') 

@section('title', 'Create PPMP')

@section('brand', 'PPMP')



@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 23px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> CREATE PPMP 
					<i class="fas fa-box" style="margin-left: 10px; "></i><br>
					<!-- <span style="font-size: 15px;">Project Procurement Management Plan</span> -->
					<!-- <a href="" data-toggle="modal" data-target="#additem" id="create2"><span class="fas fa-plus fa-xs"></span> </a> -->
				</p><br>
				
				<div class="row">
					<div class="col-lg-12">
						<form method="POST" id="add-ppmp-form" action="{{ route('projects.store') }}">
						@csrf
							<div class="row" style="padding:0px 30px 5px 30px;">
			                    <div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="For Year">For Year:</label>
			                        <select name="budget_year_id" class="form-control" id="For Year">
										@foreach($budgetYears as $year)
								      		<option value="{{ $year->id }}">{{ $year->budget_year }}</option>
										@endforeach
								    </select>
			                      </div>
			                    </div>
							</div>
							<div class="form-group" style="padding:0px 30px 5px 30px;">
								<label for="Product Type">Project Title:</label>
                    			<input name="title" value="{{ old('title') }}" type="text" class="form-control" id="Type">
							</div>

							<div class="row" style="padding:0px 30px 5px 30px;">
			                    <!-- <div class="col-lg-6">
			                      <div class="form-group">
			                        <label for="Product Type">Product Type:</label>
			                        <select class="form-control" id="Product Type">
								      <option>1</option>
								      <option>2</option>
								      <option>3</option>
								    </select>
			                      </div>
			                    </div> -->
								<div class="col-lg-3">
									<div class="form-group">
										<label for="Code">Code:</label>
										<input type="text" class="form-control" id="Code">
									</div>
								</div>
			                    <div class="col-lg-9">
			                      <div class="form-group">
			                        <label for="Description">Product Description:</label>
									<input value="" type="text" class="form-control" id="Description">
			                        <!-- <select class="form-control" id="Description">
								      <option>1</option>
								      <option>2</option>
								      <option>3</option>
								    </select> -->
			                      </div>
			                    </div>
			                  </div>

			                 <div class="row" style="padding:0px 30px 5px 30px;">
			                    <div class="col-lg-2">
			                      <div class="form-group">
			                        <label for="Quantity">Quantity:</label>
			                        <input value="" type="number" class="form-control" id="Qty">
			                      </div>
			                    </div>
								<div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="Quantity">Unit of Measurement:</label>
			                        <input value="" type="text" class="form-control" id="Uom">
			                      </div>
			                    </div>
			                    <div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="Unit Price">Unit Price:</label>
			                        <input value="" type="number" class="form-control" id="UPrice">
			                      </div>
			                    </div>
			                    <div class="col-lg-4">
			                      <div class="form-group">
			                        <label for="Total">Estimated Total:</label>
			                        <input value="" type="number" class="form-control" id="Total" disabled>
			                      </div>
			                    </div>
			                  </div>
							  <div class="row" style="padding:0px 30px 5px 30px;">
							 	<div class="col-lg-6">
									<div class="form-group">
										<label for="Mode of Procurement">Mode of Procurement:</label>
										<input type="text" class="form-control" id="Proc-Mode">
									</div>
								</div>
							  </div>


							<div class="form-group">
								<label style="padding: 5px 0px 0px 30px;">Schedule / Milestones:</label>
								<div class="row" style="font-size: 20px; padding:20px 30px 20px 30px;">
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> January
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> February
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> March
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> April
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> May
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> June
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
								</div>

								<div class="row" style="font-size: 20px; padding:10px 30px 10px 30px;">
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> July
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> August
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> September
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> October
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> November
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" value=""> December
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
								</div>
							</div>
						

						<div style="padding: 10px 0px 20px 300px; width: 60%;" class="text-center">
							<button type="button" onClick="addInputItem()" class="btn btn-primary btn-block makeppmp">Add Item</button>
							<button type="submit" class="btn btn-success btn-block makeppmp">Create PPMP</button>
						</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection


@section('modals')
<!-- MODAL FOR ADD ITEM -->
  <div id="additem" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #f4f3ef;">
            <p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
            Add An Item</p>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <form>
                  <div class="form-group">
                    <label for="Product Type">Product Type:</label>
                    <input type="text" class="form-control" id="Type">
                  </div><br>
                  
                  <div class="form-group">
                    <label for="Description">Product Description:</label>
                    <input type="text" class="form-control" id="Desc">
                  </div><br>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="UOM">Unit Of Measurement:</label>
                        <input type="text" class="form-control" id="UOM">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="Price">Price:</label>
                         <input type="number" class="form-control" id="Price">
                      </div>
                    </div>
                  </div>

                  <br>
                 <button type="submit" class="btn btn-success btn-block">Submit</button>
                </form>
          </div>

        </div>
      </div>
    </div>
@endsection


@section('scripts')
<script>
	var n = 0;
	function addInputItem(){
		alert(n);
		n++;
	}
</script>
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