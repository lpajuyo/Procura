@extends('bo_main') 

@section('title', 'Create Project')

@section('brand', 'PPMP')



@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 23px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> ADD PURCHASE REQUEST ITEM 
					<i class="fas fa-box" style="margin-left: 10px; "></i><br>
					<!-- <span style="font-size: 15px;">Project Procurement Management Plan</span> -->
					<!-- <a href="" data-toggle="modal" data-target="#additem" id="create2"><span class="fas fa-plus fa-xs"></span> </a> -->
				</p><br>
				
				<!-- <div class="row">
					<div class="col-lg-12"> -->
						<form method="POST" action="{{ route('pr_items.store', ['purchase_request' => $purchaseRequest->id]) }}">
						@csrf
							<div class="row" style="padding:0px 30px 5px 30px;">
			                    <div class="col-lg-4">
			                      <div class="form-group">
			                        <label for="For Year">Project Items:</label>
			                        <select name="project_item_id" class="form-control" id="item-dropdown">
										<option disabled selected>--Select an Item--</option>
										@foreach($projectItems as $item)
								      		<option value="{{ $item->id }}">{{ $item->description }}</option>
										@endforeach
								    </select>
			                      </div>
			                    </div>
							</div>
							<div class="row">
								<div class="col">
									<div class="form-group" style="padding:0px 30px 5px 30px;">
										<label for="Product Type">Specifications:</label>
		                    			<input type="textarea" name="specification" class="form-control" id="Specification">
									</div>
								</div>
							</div>
							<div class="row" style="padding:0px 100px 5px 30px;">
			                    <div class="col-lg-2">
			                      <div class="form-group">
			                        <label for="Quantity">Quantity:</label>
			                        <input name="quantity" min="0" value="" type="number" class="form-control" id="Qty">
			                      </div>
			                    </div>
								<div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="Unit of Measurement">Unit of Measurement:</label>
			                        <input value="" type="text" class="form-control" id="Uom">
			                      </div>
			                    </div>
			                    <div class="col-lg-3">
			                      <div class="form-group">
			                        <label for="Unit Price">Unit Price:</label>
			                        <input min="0" step=".01" value="" type="number" min="0" step=".01" class="form-control" id="UPrice">
			                      </div>
			                    </div>
			                    <div class="col-lg-4">
			                      <div class="form-group">
			                        <label for="Estimated Budget">Total Cost:</label>
			                        <input name="total_cost" min="0" step=".01" value="" type="number" min="0" step=".01" class="form-control" id="Total">
			                      </div>
			                    </div>
			                  </div>
						

							@include('errors')

						<div style="padding: 10px 0px 20px 300px; width: 60%;" class="text-center">
							<button type="submit "class="btn btn-success btn-block makeppmp">ADD ITEM</button>
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
<script>
	$("#item-dropdown").change(function(){
		var items = @json($projectItems);
		var val = $(this).val();

		$("#Qty").val(items[val-1].quantity);
		$("#Uom").val(items[val-1].uom);
		$("#UPrice").val(items[val-1].unit_cost);
		$("#Total").val(items[val-1].estimated_budget);
	});
</script>
@endsection