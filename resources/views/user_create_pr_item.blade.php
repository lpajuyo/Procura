@extends('bo_main') 
@section('title', 'View Purchase Request') 
@section('pr-active', 'active') 
@section('content')
<div class="row">
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
							<input type="hidden" name="is_cse" value="">  {{-- value inserted by script --}}
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label for="Item">Item:</label>
										<select name="project_item_id" class="form-control" id="item-dropdown">
									<option disabled selected>--Select an Item--</option>
									@foreach($projectItems as $item)
									<option value="{{ $item->id }}" {{ $item->remaining_quantity == 0 && $item->quantity != null ? 'disabled' : '' }} {{ $item->id == old('project_item_id') ? 'selected' : '' }}>{{ $item->description }}</option>
									@endforeach
								</select>
									</div>
								</div>

								<div class="col-lg-2">
									<div class="form-group">
										<label for="Quantity">Quantity:</label>
										<input name="quantity" min="0" value="{{ ($errors->create->any()) ? old('quantity') : null }}" type="number" class="form-control" id="Qty">
									</div>
								</div>

								<div class="col-lg-2">
									<div class="form-group">
										<label for="Unit of Measurement">Unit of Measurement:</label>
										<input type="text" class="form-control" id="Uom" name="uom" value="{{ ($errors->create->any()) ? old('uom') : null }}" readonly>
									</div>
								</div>

								<div class="col-lg-2">
									<div class="form-group">
										<label for="Unit Cost">Unit Cost:</label>
										<input min="0" step=".01" name="unit_cost" value="{{ ($errors->create->any()) ? old('unit_cost') : null }}" type="number" min="0" step=".01" class="form-control" id="UPrice">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="Specifications">Specifications:</label>
										<textarea class="form-control" name="specifications" id="Specification" rows="10" style="max-height: 20vh;">{{ ($errors->create->any()) ? old('specifications') : null }}</textarea>
									</div>
								</div>

								<div class="col"></div>

								<div class="col-lg-2">
									<div class="form-group">
										<label for="Total Price">Item Total Cost:</label>
										<input name="total_cost" min="0" step=".01" value="{{ ($errors->create->any()) ? old('total_cost') : null }}" type="number" min="0" step=".01" class="form-control" id="Total">
									</div>
								</div>
							</div><br>

							@if ($errors->create->any())
							<div class="alert alert-danger" role="alert">
								@foreach ($errors->create->all() as $error)
								<p>{{ $error }}</p>
								@endforeach
							</div>
							@endif

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

				<table class="table table-bordered" style="margin: : 0px 50px 20px 40px;">
					<thead class="text-center text-info">
						<tr style="font-weight: bolder;">
							<td rowspan="2">ITEM #</td>
							<td rowspan="2">UNIT</td>
							<td rowspan="2">ITEM DESCRIPTION</td>
							<td rowspan="2">QTY</td>
							<td rowspan="2">UNIT PRICE</td>
							<td rowspan="2">TOTAL PRICE</td>
							<td rowspan="2">ACTION</td>
						</tr>
					</thead>
					<tbody style="font-size: 12px;">
						@php $n=1; 
@endphp @foreach($purchaseRequest->items as $item)
						<tr class="text-center" style="line-height: 10px;">
							<td>{{ $n++ }}</td>
							<td>{{ $item->project_item->uom }}</td>
							<td>{{ $item->project_item->description }} <br /> {{ $item->specifications }}</td>
							<td>{{ $item->quantity }}</td>
							<td>{{ $item->project_item->unit_cost }}</td>
							<td>{{ $item->total_cost }}</td>
							<td>
								<button class="edit-pr-item-btn btn btn-default btn-sm" data-pr-item-id="{{ $item->id }}" title="Edit Item">
									<i class="fa fa-pencil-square-o"></i>
								</button>
								<button type="submit" form="del-item-{{ $item->id }}" class="btn btn-danger btn-sm" title="Delete Item">
									<i class="fa fa-times"></i>
								</button>
								<form id="del-item-{{ $item->id }}" method="POST" action="{{ route('items.destroy', ['purchase_request' => $purchaseRequest->id, 'item' => $item->id]) }}">
									@csrf @method('DELETE')
								</form>
							</td>
						</tr><br> @endforeach
					</tbody>
				</table>
				<br>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('modals')
<div id="edit-pr-item-modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Edit Project Item</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="">
				@csrf	
				@method('PATCH')
					<input type="hidden" name="is_cse" value=""> {{-- populated by script --}}
					<div class="form-group">
						<label for="Product Type">Product Description:</label>
						<input type="text" class="form-control" id="edit-description" name="description" value="{{ old('description') }}" readonly>
					</div><br>

					<div class="form-group">
						<label for="Description">Specifications:</label>
						<textarea class="form-control" id="Desc" name="specifications">{{ old('specifications') }}</textarea>
					</div><br>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="Quantity">Quantity:</label>
								<input type="number" class="form-control" id="edit-quantity" name="quantity" value="{{ old('quantity') }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="Uom">Unit of Measurement:</label>
								<input type="text" class="form-control" id="edit-uom" name="uom" value="{{ old('uom') }}" readonly>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="UOM">Unit Cost:</label>
								<input type="number" min="0" step=".01" class="form-control" id="edit-unit-cost" name="unit_cost" value="{{ old('unit_cost') }}">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="Price">Price:</label>
								<input type="number" min="0" step=".01" class="form-control" id="edit-price" name="total_cost" value="{{ old('total_cost') }}">
							</div>
						</div>
					</div>

					@if ($errors->edit->any())
					<div class="alert alert-danger" role="alert">
						@foreach ($errors->edit->all() as $error)
						<p>{{ $error }}</p>
						@endforeach
					</div>
					@endif

					<br>
					<button type="submit" class="btn btn-success btn-block">Submit</button>
				</form>
			</div>

		</div>
	</div>
</div>


@section('scripts')
<script>
	$("#item-dropdown").change(function(){
		var items = @json($projectItems->keyBy('id'));
		var val = $(this).val();

		$("#Qty").val(items[val].quantity);
		$("#Uom").val(items[val].uom);
		$("#UPrice").val(items[val].unit_cost);
		$("#Total").val(items[val].estimated_budget);
		$("[name='is_cse']").val(items[val].is_cse);
	});

</script>
<script>
	// auto compute of costs
	$(document).ready(function(){
		$("#Qty,#UPrice").on("input", function(e){
			$("#Total").val(($("#Qty").val() * $("#UPrice").val()).toFixed(2));
		});
	});
</script>
{{-- edit pr item scripts --}}
<script>
	$(document).ready(function(){
		@if($errors->edit->any())
			$("#edit-pr-item-modal form").attr('action', "{{ route('items.index', ['purchase_request' => $purchaseRequest]) . '/' . session('id') }}"); 
			$('#edit-pr-item-modal').modal();
		@endif

		$("#edit-quantity,#edit-unit-cost").on("input", function(e){
			$("#edit-price").val(($("#edit-quantity").val() * $("#edit-unit-cost").val()).toFixed(2));
		});
	});

	$('.edit-pr-item-btn').click(function(){
		var id = $(this).attr('data-pr-item-id');
		var url = "{{ route('items.index', ['purchase_request' => $purchaseRequest]) }}" + "/" + id + "/edit";

		$.ajax({
			url: url, 
			dataType: "json",
			async: false
		}).done(function(prItem){
			$("#edit-pr-item-modal [role=alert]").remove();
			$("#edit-pr-item-modal form").attr('action', url.replace("/edit", "")); 
			$("#edit-pr-item-modal #edit-description").val(prItem.project_item.description);
			$("#edit-pr-item-modal [name=specifications]").val(prItem.specifications);
			$("#edit-pr-item-modal [name=quantity]").val(prItem.quantity);
			$("#edit-pr-item-modal #edit-uom").val(prItem.project_item.uom);
			$("#edit-pr-item-modal #edit-unit-cost").val(prItem.project_item.unit_cost);
			$("#edit-pr-item-modal #edit-price").val(prItem.total_cost);
			$("#edit-pr-item-modal [name='is_cse']").val(prItem.project_item.is_cse);
			
			$('#edit-pr-item-modal').modal();
		});
	});
</script>
@endsection