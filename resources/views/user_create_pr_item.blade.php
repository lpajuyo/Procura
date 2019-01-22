@extends('bo_main') 

@section('title', 'View PPMP')

@section('pr-active', 'active')

@section('content')
<div class="row" >
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 20px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> CREATE PURCHASE REQUEST
					<i class="fas fa-edit" style="margin-left:10px;"></i>
					<br>
				</p><br>
				
				<div class="row" style="padding: 5px 10px 30px 20px;">
				<div class="col-lg-12">
				<form method="POST" action="{{ route('pr_items.store', ['purchase_request' => $purchaseRequest->id]) }}">
				@csrf
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="form-group">
								<label for="Item">Item:</label>
								<select name="project_item_id" class="form-control" id="item-dropdown">
									<option disabled selected>--Select an Item--</option>
									@foreach($projectItems as $item)
									<option value="{{ $item->id }}">{{ $item->description }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-2">
			               <div class="form-group">
			                  <label for="Quantity">Quantity:</label>
							  <input name="quantity" min="0" value="" type="number" class="form-control" id="Qty">
			               </div>
			            </div>

						<div class="col-lg-2">
							<div class="form-group">
								<label for="Unit of Measurement">Unit of Measurement:</label>
								<input value="" type="text" class="form-control" id="Uom">
							</div>
						</div>

					    <div class="col-lg-2">
			               <div class="form-group">
			                  <label for="Unit Cost">Unit Cost:</label>
							  <input min="0" step=".01" value="" type="number" min="0" step=".01" class="form-control" id="UPrice">
			               </div>
			            </div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
			                    <label for="Specifications">Specifications:</label>
			                    <textarea class="form-control" name="specifications" id="Specification" rows="10" style="max-height: 20vh;"></textarea>
			                </div>
						</div>

						<div class="col"></div>

						<div class="col-lg-2">
			               <div class="form-group">
			                  <label for="Total Price">Total Price:</label>
							  <input name="total_cost" min="0" step=".01" value="" type="number" min="0" step=".01" class="form-control" id="Total">
			               </div>
			            </div>
					</div><br>


					<div class="row" style="margin-left:170px;">
							<div class="col-lg-4">
								<div style="" class="text-center">
									<button type="submit" class="btn btn-info btn-block makeppmp">Add Item</button>
								</div>
							</div>
							<div class="col-lg-4">
								<div style="" class="text-center">
									<a href="{{ route('purchase_requests.index') }}">
										<button type="button" class="btn btn-success btn-block makeppmp">Done</button>
									</a>
								</div>
							</div>	
						</div>

				</form>
				</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 20px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> PURCHASE REQUEST DETAILS
					<i class="fas fa-info-circle" style="margin-left: 10px; "></i><br>
				</p><br>

				<table class="table table-bordered" style="margin: : 0px 50px 20px 40px;" >
						<thead class="text-center text-info">
						<tr style="font-weight: bolder;">
							<td rowspan="2">ITEM #</td>
							<td rowspan="2">UNIT</td>
							<td rowspan="2">ITEM DESCRIPTION</td>
							<td rowspan="2">QTY</td>
							<td rowspan="2">UNIT PRICE</td>
							<td rowspan="2">TOTAL PRICE</td>
						</tr>
						</thead>
						<tbody style="font-size: 12px;">
						@php $n=1; @endphp
						@foreach($purchaseRequest->items as $item)
						<tr class="text-center" style="line-height: 10px;">
							<td>{{ $n++ }}</td>
							<td>{{ $item->project_item->uom }}</td>
							<td>{{ $item->project_item->description }} <br /> {{ $item->specifications }}</td>
							<td>{{ $item->quantity }}</td>
							<td>{{ $item->project_item->unit_cost }}</td>
							<td>{{ $item->total_cost }}</td>
						</tr><br>
						@endforeach
						</tbody>
					</table>
					<br>
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
