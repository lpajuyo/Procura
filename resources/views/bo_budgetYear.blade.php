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
					            <th>Budget Amount</th>
					            <th >Status</th>
					            <th class="text-center">Action</th>
					        </tr>
					    </thead>

					    <tbody>
					        <tr>
					        	<td>2019</td>
					            <td>15000000</td>
					            <td >Active</td>
					            <td class="td-actions text-center">
					                <button type="button" rel="tooltip" title="Edit Budget Year" class="btn btn-danger btn-simple btn-xs" data-toggle="modal" data-target="#editbudgetyear">
					                    <i class="fa fa-edit"></i>
					                </button>
					               <!--  <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
					                    <i class="fa fa-times"></i>
					                </button> -->
					            </td>
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