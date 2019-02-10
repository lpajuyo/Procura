@extends('bo_main') 
@section('title', 'Budget Year')

<!-- 
@section('brand', 'Budget Year') -->


@section('budget-active', 'active') 
@section('budget-dropdown-show', 'show') 
@section('bYear-active', 'active') 
@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">

	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 5px;">
				<div>
					<p style="position: absolute; font-size: 25px;"> Budget Year List </p>
					<button class="btn btn-default" style="right: 30px; position: absolute !important;" data-toggle="modal" data-target="#addyear">
				  <i class="fa fa-plus"></i> &nbsp;Add Year
				</button>
				</div><br><br><br>
				<div class="table-responsive" style="overflow: visible;">
					<table class="table table-striped table-bordered">
						<thead>
							<tr class=" text-primary">
								<th>Budget Year</th>
								<th>Fund 101 Amount</th>
								<th>Fund 164 Amount</th>
								<th>Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($budgetYears as $budgetYear)
							<tr>
								<td>{{ $budgetYear->budget_year }}</td>
								<td>{{ $budgetYear->fund_101 }}</td>
								<td>{{ $budgetYear->fund_164 }}</td>
								<td>{{ ($budgetYear->is_active) ? "Active" : "Inactive" }}</td>
								<td class="td-actions text-center">
									@can('update', $budgetYear)
									<button type="button" rel="tooltip" title="Edit Budget Year" class="btn btn-warning btn-simple btn-xs btnEditBudgetYear"
									 data-year-id="{{ $budgetYear->id }}">
					                    <i class="fa fa-edit"></i>
													</button>
									@endcan				

									<a href="{{ route('budget_alloc', ['budgetYear' => $budgetYear->id]) }}">
									<button type="button" rel="tooltip" title="Proceed to Budget Allocation" class="btn btn-success btn-simple btn-xs btnEditBudgetYear"> 
										<i class="nc-icon nc-money-coins"></i>
					                </button>
									</a>

									@can('activate', $budgetYear)
									<button type="submit" form="{{ 'active-year-' . $budgetYear->budget_year }}" rel="tooltip" title="Set as Active" class="btn btn-success btn-simple btn-xs">
										<i class="fa fa-check"></i>
									</button>
									<form style="display: none;" id="{{ 'active-year-' . $budgetYear->budget_year }}" method="POST" action="{{ route('budget_year.activate', ['budget_year' => $budgetYear->id]) }}">
											@csrf
									</form> 
									@endcan

									@can('delete', $budgetYear)
									<button type="submit" form="{{ 'del-year-' . $budgetYear->budget_year }}" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
										<i class="fa fa-times"></i>
									</button>
									<form style="display: none;" id="{{ 'del-year-' . $budgetYear->budget_year }}" method="POST" action="{{ route('budget_years.destroy', ['budget_year' => $budgetYear->id]) }}">
											@csrf @method('DELETE')
									</form>
									@endcan
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
<!-- MODAL FOR ADD BUDGET YEAR -->
<div id="addyear" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Add New Budget Year</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('budget_years.store') }}">
					@csrf
					<div class="form-group">
						<label for="Year">New Budget Year</label>
						<input type="number" class="form-control" id="Year" name="budget_year" value="{{ old('budget_year') }}">
					</div><br>

					<div class="form-group">
						<label for="Amount">Fund 101 Amount</label>
						<input type="number" min="0" step=".01" class="comma form-control" id="Amount" name="fund_101" value="{{ old('fund_101') }}">
					</div><br>

					<div class="form-group">
						<label for="Amount">Fund 164 Amount</label>
						<input type="number" min="0" step=".01" class="comma form-control" id="Amount" name="fund_164" value="{{ old('fund_164') }}">
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

<!-- MODAL FOR EDIT BUDGET YEAR -->
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
</div>
@endsection
 
@section('scripts') 
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
@endif

<!-- Show edit budget year modal with appropriate input values -->
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
@endsection