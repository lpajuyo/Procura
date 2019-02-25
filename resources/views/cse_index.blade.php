@extends('bo_main') 
@section('title', 'Common Use Supplies and Equipment') 
@section('cse-active', 'active') 
@section('admin-dropdown-show',
'show') 
@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 10px; padding-right: 10px;">

	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 5px;">
				<div>
					<p style="position: absolute; font-size: 25px;"> Common Use Supplies and Equipment </p>
					<a href="{{ route('cse_items.create') }}" class="btn btn-default" style="right: 200px; position: absolute !important;">
				  <i class="fa fa-plus"></i> &nbsp;Import Catalog File
					</a>
					<button class="btn btn-default" style="right: 30px; position: absolute !important;" data-toggle="modal" data-target="#add-cse-modal">
				  <i class="fa fa-plus"></i> &nbsp;Add CSE Item
					</button>
				</div><br><br><br>
				<div class="table-responsive" style="overflow: visible;">
					<table class="table table-striped table-bordered">
						<thead>
							<tr class=" text-primary">
								<th>Code</th>
								<th>Item Description</th>
								<th>UOM</th>
								<th>Price</th>
								<th>Item Type</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>

						<tbody class="minrow">
							@foreach ($cseItems as $cseItem)
							<tr>
								<td>{{ $cseItem->code }}</td>
								<td>{{ $cseItem->description }}</td>
								<td>{{ $cseItem->uom }}</td>
								<td>{{ $cseItem->price }}</td>
								<td>{{ $cseItem->type->name ?? '--' }}</td>
								<td class="td-actions text-center">
									{{-- @can('update', $cseItem) --}}
									<button type="button" rel="tooltip" title="Edit CSE Item" class="btn btn-warning btn-simple btn-sm edit-cse-item-btn"
									 data-cse-id="{{ $cseItem->id }}">
					                    <i class="fa fa-edit"></i>
													</button>
									{{-- @endcan  --}}
									{{-- @can('delete', $cseItem) --}}
									<button type="submit" form="{{ 'del-item-' . $cseItem->id }}" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
										<i class="fa fa-times"></i>
									</button>
									<form style="display: none;" id="{{ 'del-item-' . $cseItem->id }}" method="POST" action="{{ route('cse_items.destroy', ['cse_item' => $cseItem->id]) }}">
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
<!-- MODAL FOR ADD CSE ITEM -->
<div id="add-cse-modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Add CSE Item</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('cse_items.store') }}">
					@csrf
					<div class="form-group">
						<label for="Item Type">Item Type:</label>
						<select name="item_type_id" class="form-control">
							<option selected disabled value="0">--Select Item Type--</option>
							@foreach ($itemTypes as $type)
								<option value="{{ $type->id }}">{{ $type->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="Code">Code:</label>
						<input type="text" class="form-control" name="code" value="{{ old('code') }}">
					</div>
					<div class="form-group">
						<label for="Description">Item Description:</label>
						<input type="text" class="form-control" name="description" value="{{ old('description') }}">
					</div>
					<div class="form-group">
						<label for="UOM">Unit of Measurement:</label>
						<input type="text" class="form-control" name="uom" value="{{ old('uom') }}">
					</div>
					<div class="form-group">
						<label for="Price">Price:</label>
						<input type="number" class="form-control" min="0" step=".01" name="price" value="{{ old('price') }}">
					</div><br />
					
					@if ($errors->create->any())
					<div class="alert alert-danger" role="alert">
						@foreach ($errors->create->all() as $error)
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


<!-- MODAL FOR EDIT BUDGET YEAR -->
<div id="edit-cse-item-modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Edit CSE Item</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST">
					@csrf @method('PATCH')
					<div class="form-group">
							<label for="Item Type">Item Type:</label>
							<select name="item_type_id" class="form-control">
								<option selected disabled value="0">--Select Item Type--</option>
								@foreach ($itemTypes as $type)
									<option value="{{ $type->id }}">{{ $type->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="Code">Code:</label>
							<input type="text" class="form-control" name="code" value="{{ old('code') }}">
						</div>
						<div class="form-group">
							<label for="Description">Item Description:</label>
							<input type="text" class="form-control" name="description" value="{{ old('description') }}">
						</div>
						<div class="form-group">
							<label for="UOM">Unit of Measurement:</label>
							<input type="text" class="form-control" name="uom" value="{{ old('uom') }}">
						</div>
						<div class="form-group">
							<label for="Price">Price:</label>
							<input type="number" class="form-control" min="0" step=".01" name="price" value="{{ old('price') }}">
						</div><br />
					
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

@if ($errors->create->any())
<script>
	$('#add-cse-modal').modal('show')
</script>
@endif 
@if ($errors->edit->any())
<script>
	$("#edit-cse-item-modal form").attr('action', "{{ url('/cse_items') . '/' . session('id') }}"); //form action="example.com/budget_years/{id}"
	$("#edit-cse-item-modal [name=item_type_id]").val({{ old('item_type_id') }});
	$('#edit-cse-item-modal').modal('show')

</script>
@endif
<!-- Show edit budget year modal with appropriate input values -->
<script>
	$('.edit-cse-item-btn').click(function(){
		var id = $(this).attr('data-cse-id');
		var url = "{{ url()->current() }}" + "/" + id + "/edit";
		
		$.ajax({
			url: url, 
			dataType: "json"
		}).done(function(cseItem){
			$("#edit-cse-item-modal [role=alert]").remove();
			$("#edit-cse-item-modal form").attr('action', url.replace("/edit", "")); //form action="example.com/budget_years/{id}"
			$("#edit-cse-item-modal [name=code]").val(cseItem.code);
			$("#edit-cse-item-modal [name=description]").val(cseItem.description);
			$("#edit-cse-item-modal [name=uom]").val(cseItem.uom);
			$("#edit-cse-item-modal [name=price]").val(cseItem.price);
			$("#edit-cse-item-modal [name=item_type_id]").val(cseItem.item_type_id);
			
			$('#edit-cse-item-modal').modal();
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
