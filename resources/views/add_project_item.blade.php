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
						<form method="POST" action="{{ route('items.store', ['project' => $project->id]) }}">
						@csrf
							<div class="row" style="padding:0px 30px 5px 30px;">
			                    <div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="For Year">For Year:</label>
									<input type="text" class="form-control" value="{{ $project->year->budget_year }}" disabled>
			                      </div>
			                    </div>
							</div>
							<div class="form-group" style="padding:0px 30px 5px 30px;">
								<label for="Product Type">Project Title:</label>
                    			<input name="title" value="{{ $project->title }}" type="text" class="form-control" id="Type" disabled>
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
										<input name="code" type="text" class="form-control" id="Code">
									</div>
								</div>
			                    <div class="col-lg-9">
			                      <div class="form-group">
			                        <label for="Description">Product Description:</label>
									<input name="description" value="" type="text" class="form-control" id="Description">
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
			                        <input name="quantity" value="" type="number" class="form-control" id="Qty">
			                      </div>
			                    </div>
								<div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="Unit of Measurement">Unit of Measurement:</label>
			                        <input name="uom" value="" type="text" class="form-control" id="Uom">
			                      </div>
			                    </div>
			                    <div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="Unit Price">Unit Price:</label>
			                        <input name="unit_cost" value="" type="number" class="form-control" id="UPrice">
			                      </div>
			                    </div>
			                    <div class="col-lg-4">
			                      <div class="form-group">
			                        <label for="Total">Estimated Total:</label>
			                        <input name="estimated_budget" value="" type="number" class="form-control" id="Total">
			                      </div>
			                    </div>
			                  </div>
							  <div class="row" style="padding:0px 30px 5px 30px;">
							 	<div class="col-lg-6">
									<div class="form-group">
										<label for="Mode of Procurement">Mode of Procurement:</label>
										<input name="procurement_mode" type="text" class="form-control" id="Proc-Mode">
									</div>
								</div>
							  </div>


							<div class="form-group">
								<label style="padding: 5px 0px 0px 30px;">Schedule / Milestones:</label>
								<div class="row" style="font-size: 20px; padding:20px 30px 20px 30px;">
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="1">January
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="2"> February
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="3"> March
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="4"> April
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="5"> May
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="6"> June
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
										        <input class="form-check-input" type="checkbox" name=schedules[] value="7"> July
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="8"> August
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="9"> September
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="10"> October
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="11"> November
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
										    <label class="form-check-label">
										        <input class="form-check-input" type="checkbox" name=schedules[] value="12"> December
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
										    </label>
										</div>
									</div>
								</div>
							</div>
						

						<div style="padding: 10px 0px 20px 300px; width: 60%;" class="text-center">
							<button type="submit" class="btn btn-success btn-block makeppmp">Add Item</button>
						</div>

						</form>
					</div>
				</div>
				<div class="row">
					<div class="col">
					<table class="table table-bordered" >
						<thead class="text-center">
						<tr style="font-weight: bolder;">
							<td rowspan="2">DESCRIPTION</td>
							<td rowspan="2">QTY</td>
							<td rowspan="2">UNIT PRICE</td>
							<td rowspan="2">TOTAL</td>
							<td colspan="12" rowspan="1" class="text-center">SCHEDULE / MILESTONES</td>
							<!-- <td rowspan="2">Action</td>                 -->
						</tr>
						<tr>
							<td>Jan</td>
							<td>Feb</td>
							<td>Mar</td>
							<td>Apr</td>
							<td>May</td>
							<td>Jun</td>
							<td>Jul</td>
							<td>Aug</td>
							<td>Sept</td>
							<td>Oct</td>
							<td>Nov</td>
							<td>Dec</td>
						</tr>
						</thead>
						<tbody>
						<tr>
						</tr>
						<tr class="text-center">
							<td rowspan="2">TestTestTe</td>
							<td rowspan="2">12</td>
							<td rowspan="2">10</td>
							<td rowspan="2">120</td>
							<td rowspan="2"> -- </td>
							<td rowspan="2"> -- </td>
							<td rowspan="2"> &#x2714; </td>
							<td rowspan="2"> &#x2714; </td>
							<td rowspan="2"> &#x2714; </td>
							<td rowspan="2"> &#x2714;</td>
							<td rowspan="2"> -- </td>
							<td rowspan="2"> -- </td>
							<td rowspan="2"> &#x2714; </td>
							<td rowspan="2"> -- </td>
							<td rowspan="2"> -- </td>
							<td> &#x2714; </td>
						</tr>
						</tbody>
					</table>
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