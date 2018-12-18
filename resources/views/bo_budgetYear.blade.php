@extends('bo_main') 

@section('title', 'Budget Year')

<!-- @section('brand', 'Budget Year') -->


@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">

	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 5px;">
				<div>
				<p style="position: absolute; font-size: 25px;"> Budget Year List </p>
				<button class="btn btn-default" style="right: 30px; position: absolute !important;" data-toggle="modal"
				data-target="#addyear">
				  <i class="fa fa-plus"></i> &nbsp;Add Year
				</button>
				</div><br><br><br>
				<div class="table-responsive" style="overflow: visible;"> 
					<table class="table table-striped">
						<thead>
							<tr class=" text-primary">
					            <th>Budget Year</th>
					            <th>Fund 101 Amount</th>
					            <th>Fund 164 Amount</th>
					            <!-- <th >Status</th> -->
					            <th class="text-center">Action</th>
					        </tr>
					    </thead>

					    <tbody>
							@foreach ($budgetYears as $budgetYear)
					        <tr>
					        	<td>{{ $budgetYear->budget_year }}</td>
					            <td>{{ $budgetYear->fund_101 }}</td>
					            <td>{{ $budgetYear->fund_164 }}</td>
					            <!-- <td >{{ ($budgetYear->is_active) ? "Active" : "Inactive" }}</td> -->
					            <td class="td-actions text-center">
					                <button type="button" rel="tooltip" title="Edit Budget Year" class="btn btn-danger btn-simple btn-xs btnEditBudgetYear" data-year-id="{{ $budgetYear->id }}">
					                    <i class="fa fa-edit"></i>
					                </button>
									<button type="submit" form="{{ 'del-year-' . $budgetYear->budget_year }}" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
										<i class="fa fa-times"></i>
									</button>

									<form id="{{ 'del-year-' . $budgetYear->budget_year }}" method="POST" action="{{ route('budget_years.destroy', ['budget_year' => $budgetYear->id]) }}">
									@csrf
									@method('DELETE')
									</form>
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

</div>

@endsection