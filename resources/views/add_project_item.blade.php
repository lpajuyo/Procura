@extends('bo_main') 
@section('title', 'Create PPMP') 
@section('ppmp-active', 'active') 
@section('brand', 'PPMP') 
@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 20px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; ">
				<p style="font-size: 20px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> CREATE PPMP
					<i class="fas fa-edit" style="margin-left:10px;"></i>
					<br>
					<!-- <span style="font-size: 15px;">Project Procurement Management Plan</span> -->
					<!-- <a href="" data-toggle="modal" data-target="#additem" id="create2"><span class="fas fa-plus fa-xs"></span> </a> -->
				</p><br>

				<div class="row">
					<div class="col-lg-12">
						<form id="add-item-form" method="POST" action="{{ route('project_items.store', ['project' => $project->id]) }}">
							@csrf
							<div class="row" style="padding:0px 30px 0px 30px;">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="For Year">For Year:</label>
										<input type="text" class="form-control" value="{{ $project->year->budget_year }}" disabled>
									</div>
								</div>

								<div class="col-lg-7">
									<div class="form-group">
										<label for="Product Type">Project Title:</label>
										<input name="title" value="{{ $project->title }}" type="text" class="form-control" id="Type" disabled>
									</div>
								</div>
							</div>

							<br />

							<div class="row" style="padding:0px 30px 5px 30px;">
								<div class="col-lg-2" style="margin-top: 26px;">
									<div class="form-check form-check-radio">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" id="cse-radio" name="is_cse" value="1" checked>
											CSE Item
											<span class="form-check-sign"></span>
										</label>
									</div>
								</div>

								<div class="col-lg-2" style="margin-top: 26px;">
									<div class="form-check form-check-radio">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" id="non-cse-radio" name="is_cse" value="0">
											Non-CSE Item
											<span class="form-check-sign"></span>
										</label>
									</div>
								</div>

								<div class="col-lg-7">
									<div class="form-group">
										<label for="exampleFormControlSelect1">Item Type:</label>
										<select class="form-control" id="type-dropdown" name="item_type_id">
											<option selected disabled value="0">--Select Item Type--</option>
											@foreach($itemTypes as $type)
											<option value="{{ $type->id }}" {{ ($type->id == old('item_type_id') ? "selected" : "") }}>{{ $type->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row" style="padding:0px 30px 5px 30px;">
								<div class="col-lg-4"></div>
								<div class="col-lg-7">
									<div class="form-group">
										<label for="exampleFormControlSelect1">Common Use Items:</label>
										<select class="form-control" id="cse-dropdown">
											{{-- @if(old('description') == null)
											<option selected disabled value="0">--Select an Item--</option>
											@endif
											@foreach($cseItems as $cseItem)
											<option value="{{ $cseItem->id }}" {{ ($cseItem->description == old('description') ? "selected" : "") }}>{{ $cseItem->description }}</option>
											@endforeach --}}
										</select>
									</div>
								</div>
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
								<div class="col-lg-4">
									<div class="form-group">
										<label for="Code">Code:</label>
										<input name="code" type="text" class="form-control" id="Code" value="{{ old('code') }}">
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group">
										<label for="Description">Product Description:</label>
										<input name="description" type="text" class="form-control" id="Description" value="{{ old('description') }}">
										<!-- <select class="form-control" id="Description">
								      <option>1</option>
								      <option>2</option>
								      <option>3</option>
								    </select> -->
									</div>
								</div>
							</div>

							<div class="row" style="padding:0px 100px 5px 30px;">
								<div class="col-lg-2">
									<div class="form-group">
										<label for="Quantity">Quantity:</label>
										<input name="quantity" min="0" type="number" class="form-control" id="Qty" value="{{ old('quantity') }}">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="Unit of Measurement">Unit of Measurement:</label>
										<input name="uom" type="text" class="form-control" id="Uom" value="{{ old('uom') }}">
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="Unit Price">Unit Price:</label>
										<input name="unit_cost" min="0" step=".01" value="{{ old('unit_cost') }}" type="number" min="0" step=".01" class="form-control"
										 id="UPrice">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label for="Estimated Budget">Estimated Budget:</label>
										<input name="estimated_budget" min="0" step=".01" value="{{ old('estimated_budget') }}" type="number" min="0" step=".01"
										 class="form-control" id="Total">
									</div>
								</div>
							</div>

							<div class="row" style="padding:0px 100px 5px 30px;">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="Mode of Procurement">Mode of Procurement:</label>
										<input name="procurement_mode" type="text" class="form-control" id="Proc-Mode" value="{{ old('procurement_mode') }}">
									</div>
								</div>
								<div class="col-lg-4" style="padding-top: 26px">
									<label for="Total">PPMP Total Estimated Budget<span>(+10% Provision for Interest, +10% Contigency)</span>:</label>
								</div>
								<div class="col-lg-4" style="padding-top: 26px;">
									<div class="form-group">
										<!-- <label for="Total">PPMP Total Estimated Budget<span>(+10% Provision for Interest, +10% Contigency)</span>:</label> -->
										<input name="total_ppmp_budget" value="{{ (old('total_ppmp_budget') == null) ? $project->total_budget_with_contingency : old('total_ppmp_budget') }}"
										 type="number" min="0" step=".01" class="form-control" id="PPMP-Total" readonly>
									</div>
								</div>
							</div>


							<div class="form-group">
								<label style="padding: 5px 0px 0px 30px;">Schedule / Milestones:</label>
								<div class="row" style="font-size: 18px; padding:20px 100px 20px 30px;">
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.1')) ? "checked" : "" }}> January
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[1][quantity]" value="{{ old('schedules.1.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.2')) ? "checked" : "" }}> February
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[2][quantity]" value="{{ old('schedules.2.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.3')) ? "checked" : "" }}> March
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[3][quantity]" value="{{ old('schedules.3.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.4')) ? "checked" : "" }}> April
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[4][quantity]" value="{{ old('schedules.4.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.5')) ? "checked" : "" }}> May
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[5][quantity]" value="{{ old('schedules.5.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.6')) ? "checked" : "" }}> June
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[6][quantity]" value="{{ old('schedules.6.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
								</div>

								<div class="row" style="font-size: 18px; padding:10px 100px 10px 30px;">
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.7')) ? "checked" : "" }}> July
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[7][quantity]" value="{{ old('schedules.7.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.8')) ? "checked" : "" }}> August
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[8][quantity]" value="{{ old('schedules.8.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.9')) ? "checked" : "" }}> September
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[9][quantity]" value="{{ old('schedules.9.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.10')) ? "checked" : "" }}> October
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[10][quantity]" value="{{ old('schedules.10.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.11')) ? "checked" : "" }}> November
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[11][quantity]" value="{{ old('schedules.11.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-check">
											<label class="form-check-label">
										        <input class="form-check-input" type="checkbox" {{ (old('schedules.12')) ? "checked" : "" }}> December
										        <span class="form-check-sign">
										            <span class="check"></span>
										        </span>
											</label>
											<input name="schedules[12][quantity]" value="{{ old('schedules.12.quantity') }}" type="text" class="form-control" placeholder="Quantity"
											 disabled>
										</div>
									</div>
								</div>
							</div>

							@include('errors')

							<div class="row">
								<div class="col-lg-1" style="margin-right:40px;"></div>
								<div class="col-lg-4">
									<div style="padding: 20px 0px 30px 0px;" class="text-center">
										<button type="submit" class="btn btn-info btn-block makeppmp">Add Item</button>
									</div>
								</div>
								<div class="col-lg-4">
									<div style="padding: 20px 0px 30px 0px;" class="text-center">
										<a id="done-btn" href="{{ route('projects.index') }}" class="btn btn-success btn-block makeppmp">Done</a>
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


<div class="row" style="padding-left: 20px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px; margin-left: 10px; padding: 15px 25px 20px 15px; ">
				<p style="font-size: 20px; margin-bottom: 0px; padding-bottom: 0px; bottom: 0;"> PPMP DETAILS
					<i class="fas fa-info-circle" style="margin-left: 10px; "></i><br>
				</p><br>
				<table class="table table-bordered" style="margin: : 0px 50px 20px 40px;">
					<thead class="text-center text-info">
						<tr style="font-weight: bolder;">
							<td rowspan="2">ITEM #</td>
							<td rowspan="2">DESCRIPTION</td>
							<td rowspan="2">QTY</td>
							<td rowspan="2">UNIT PRICE</td>
							<td rowspan="2">ESTIMATED BUDGET</td>
							<td rowspan="2">MODE OF PROCUREMENT</td>
							<td rowspan="2">Action</td>
						</tr>
					</thead>
					<tbody style="font-size: 12px;">
						@php $count=1; 
@endphp @foreach($project->items as $item)
						<tr class="text-center" style="line-height: 10px;">
							<td>{{ $count++ }}</td>
							<td>{{ $item->description }}</td>
							<td>{{ $item->quantity . ' ' . $item->uom }}</td>
							<td>{{ $item->unit_cost }}</td>
							<td>{{ $item->estimated_budget }}</td>
							<td>{{ $item->procurement_mode }}</td>
							<td>
								<a href="{{ route('project_items.edit', ['project' => $project->id, 'project_item' => $item->id]) }}" class="edit-proj-item-btn btn btn-default btn-sm" title="Edit Item">
									<i class="fa fa-pencil-square-o"></i>
								</a>
								<button type="submit" form="del-item-{{ $item->id }}" class="btn btn-danger btn-sm" title="Delete Item">
									<i class="fa fa-times"></i>
								</button>
								<form id="del-item-{{ $item->id }}" method="POST" action="{{ route('project_items.destroy', ['project' => $project->id, 'project_item' => $item->id]) }}">
									@csrf @method('DELETE')
								</form>
							</td>
						</tr><br>
						@endforeach
					</tbody>
				</table>
				<br>

				<table class="table table-bordered">
					<thead class="text-center text-info">
						<tr style="font-weight: bolder;">
							<td rowspan="2">ITEM #</td>
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
					<tbody style="font-size: 12px;">
						@php $count=1; 
						@endphp 
						@foreach($project->items as $item)
						<tr class="text-center" style="line-height: 10px;">
							<td>{{ $count++ }}</td>

							@for($i=1; $i
							<=12; $i++) <td> {!! ($item->schedules->firstWhere('id', $i)) ? "&#x2714;" : "" !!} </td>
								@endfor
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
 
@section('modals')
{{--
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
</div> --}}
@endsection
 
@section('scripts')
<!-- autocomplete of costs -->
<script>
	$(document).ready(function(){
	$("#Qty,#UPrice,#Total").on("input", function(e){
		var id = $(e.target).attr('id');
		var origPpmpTotal = {{ $project->total_budget }}; 

		if(id == "Qty" || id == "UPrice"){
			if($("#Qty").val() != "" && $("#UPrice").val() != ""){
				$("#Total").val(($("#Qty").val() * $("#UPrice").val()).toFixed(2));

				$("#PPMP-Total").val("");
				$("#PPMP-Total").val(function(i, currentVal){
					var total = Number(origPpmpTotal) + Number($("#Total").val());
					return (total + total*.2).toFixed(2);
				});
			}
		}

		if(id == "Total"){
			$("#PPMP-Total").val("");
			$("#PPMP-Total").val(function(i, currentVal){
				var total = Number(origPpmpTotal) + Number($("#Total").val());
				return (total + total*.2).toFixed(2);
			});
		}
	});
});

</script>
<!-- CSE and item dropdown related scripts -->
<script>
	$(document).ready(function(){
		// $("#Code,#Description,#Uom,#UPrice,#Total").prop("readonly", true);
		window.items = @json($cseItems);

		$(":checkbox").filter(function(){
			return $(this).prop("checked")
		}).parent().next(":text").prop("disabled", false);

		@if(old('is_cse') === "0")
			$("#non-cse-radio").prop('checked', true);
			$("#cse-dropdown").prop('disabled', true);
		@endif
	});

	$("[name=is_cse]").change(function(e){
		var id = $(e.target).attr('id');
		// console.log(id);
		if(id == "cse-radio"){
			$("#cse-dropdown").prop("disabled", false);
			$("#cse-dropdown").val(0);
			$("#type-dropdown").val(0);
			$("#cse-dropdown").html('');
			
			// $("#Code,#Description,#Uom,#UPrice,#Total").prop("readonly", true);
		}
		else if(id == "non-cse-radio"){
			$("#cse-dropdown").prop("disabled", true);
			$("#cse-dropdown").val(0);
			$("#type-dropdown").val(0);
			$("#cse-dropdown").html('');
			// $("#Code,#Description,#Uom,#UPrice,#Total").prop("readonly", false);
			$("#Code,#Description,#Uom,#UPrice,#Total").val("");
		}
	});

	$("#cse-dropdown").change(function(){
		var val = $(this).val();

		$("#Code").val(items[val-1].code);
		$("#Description").val(items[val-1].description);
		$("#Uom").val(items[val-1].uom);
		$("#UPrice").val(items[val-1].price);
	});

	$("[type=checkbox]").on("click", function(){
		if($(this).prop("checked"))
			$(this).parent().next(":text").prop("disabled", false);
		else
			$(this).parent().next(":text").prop("disabled", true);
	})

	$("#type-dropdown").change(function(){
		var typeId = $(this).val();

		if($('input[type=radio]:checked').val() == 1){
		$("#Code").val('');
		$("#Description").val('');
		$("#Uom").val('');
		$("#UPrice").val('');

		$("#cse-dropdown").html('<option selected disabled value="0">--Select Item--</option>');

		var filteredItems = $.grep(items, function(elem, index){
			if(elem.item_type_id == typeId)
				return true;
		})

		$.each(filteredItems, function(index, val){
			console.log(val.description);
			$("#cse-dropdown").append('<option value=' + val.id + '>' + val.description + '</option>');
		});

		console.log(filteredItems);
		}
	});
</script>
{{-- warning when clicking done while having inputs --}}
<script>
	$("#done-btn").click(function(event){
		var hasInput = $("#add-item-form :input").not("button,:radio,:hidden,:disabled,[readonly]").is(function(){
			if($(this).is(":checkbox"))
				return $(this).prop("checked");
			else
				return $(this).val();
		});

		if(hasInput){
			event.preventDefault();

			if(confirm("You currently have some inputs. If you want to add these to the PPMP, you should <Add Item> first. Otherwise, click 'OK'"))
				window.location = $(this).attr("href");
		}
	})
</script>
{{-- edit project item scripts --}}
{{-- <script>
	$('.edit-proj-item-btn').click(function(){
		$(window).scrollTop(98);
	});
</script> --}}
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