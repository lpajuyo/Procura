@extends('bo_main') 
@section('title', 'Item Types')

<!-- 
@section('brand', 'Budget Year') -->


@section('type-active', 'active') 
@section('admin-dropdown-show', 'show')
@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 10px; padding-right: 10px;">

	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 5px;">
				<div>
					<p style="position: absolute; font-size: 25px;"> Item Type List </p>
					<button class="btn btn-default" style="right: 30px; position: absolute !important;" data-toggle="modal" data-target="#addyear">
				  <i class="fa fa-plus"></i> &nbsp;Add Item Type
				</button>
				</div><br><br><br>
				<div class="table-responsive" style="overflow: visible;">
					<table class="table table-striped table-bordered">
						<thead>
							<tr class=" text-primary">
								<th>Type Name</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>

						<tbody class="minrow">
							@foreach ($itemTypes as $type)
							<tr>
								<td>{{ $type->name }}</td>
								<td class="td-actions text-center">
									{{-- @can('update', $type)
									<button type="button" rel="tooltip" title="Edit Budget Year" class="btn btn-warning btn-simple btn-sm btnEditBudgetYear"
									 data-year-id="{{ $type->id }}">
					                    <i class="fa fa-edit"></i>
													</button>
									@endcan				 --}}

									{{-- @can('delete', $type) --}}
									<button type="submit" form="{{ 'del-type-' . $type->id }}" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
										<i class="fa fa-times"></i>
									</button>
									<form style="display: none;" id="{{ 'del-type-' . $type->id }}" method="POST" action="{{ route('item_types.destroy', ['item_type' => $type->id]) }}">
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
<!-- MODAL FOR ADD ITEM TYPE -->
<div id="addyear" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Add New Item Type</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('item_types.store') }}">
					@csrf
					<div class="form-group">
						<label for="Item Type Name">Item Type Name:</label>
						<input type="text" class="form-control" name="name" value="{{ old('name') }}">
					</div><br>

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

{{-- <!-- MODAL FOR EDIT BUDGET YEAR -->
<div id="editbudgetyear" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Edit Budget Year</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST">
					@csrf @method('PATCH')
					<div class="form-group">
						<label for="Year">Budget Year</label>
						<input type="number" class="form-control" id="Year" name="budget_year" value="{{ session('year') }}" readonly>
					</div><br>

					<div class="form-group">
						<label for="Amount">Fund 101 Amount</label>
						<input type="number" min="0" step=".01" class="form-control" id="Amount" name="fund_101" value="{{ old('fund_101') }}">
					</div><br>

					<div class="form-group">
						<label for="Amount">Fund 164 Amount</label>
						<input type="number" min="0" step=".01" class="form-control" id="Amount" name="fund_164" value="{{ old('fund_164') }}">
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
</div> --}}
@endsection
 
{{-- @section('scripts') 
@if ($errors->create->any())
<script>
	$('#addyear').modal('show')
</script>
@endif
@if ($errors->edit->any())
<script>
	$("#editbudgetyear form").attr('action', "{{ url('/budget_years') . '/' . session('id') }}"); //form action="example.com/budget_years/{id}"
	$('#editbudgetyear').modal('show')
</script>
@endif --}}

{{-- <!-- Show edit budget year modal with appropriate input values -->
<script>
	$('.btnEditBudgetYear').click(function(){
		var id = $(this).attr('data-year-id');
		var url = "{{ url()->current() }}" + "/" + id + "/edit"; //example.com/budget_years/{id}/edit
		
		$.ajax({
			url: url, 
			dataType: "json"
		}).done(function(budgetYear){
			$("#editbudgetyear [role=alert]").remove();
			$("#editbudgetyear form").attr('action', url.replace("/edit", "")); //form action="example.com/budget_years/{id}"
			$("#editbudgetyear [name=budget_year]").val(budgetYear.budget_year);
			$("#editbudgetyear [name=fund_101]").val(budgetYear.fund_101);
			$("#editbudgetyear [name=fund_164]").val(budgetYear.fund_164);
			
			$('#editbudgetyear').modal();
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
@endsection --}}