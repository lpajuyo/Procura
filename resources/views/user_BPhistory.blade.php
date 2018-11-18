@extends('user_main') 

@section('title', 'Budget Proposal')

@section('brand', 'Budget Proposal History')



@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px;">
				<p style="font-size: 22px;"> Budget Proposal List </p>
				<div class="table-responsive" style="overflow: visible;"> 
					<table class="table table-striped">
						<thead>
							<tr class=" text-primary">
					            <th>Proposal Name</th>
					            <th>Amount</th>
					            <th class="text-center">Status</th>
					            <th class="text-center">Action</th>
					        </tr>
					    </thead>

					    <tbody>
					        <tr>
					        	<td>Budget for 2019</td>
					            <td>1.5M</td>
					            <td class="text-center">Pending</td>
					            <td class="td-actions text-center">
					                <button type="button" rel="tooltip" title="View Details" class="btn btn-info btn-simple btn-xs"
					                	data-toggle="modal" data-target="#viewBPdetails">
					                    <i class="fa fa-eye"></i>
					                </button>
					                <!-- <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
					                    <i class="fa fa-edit"></i>
					                </button>
					                <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
					                    <i class="fa fa-times"></i>
					                </button> -->
					            </td>
					        </tr>

					         <tr>
					        	<td>Budget for 2019</td>
					            <td>1.5M</td>
					            <td class="text-center">Pending</td>
					            <td class="td-actions text-center">
					                <button type="button" rel="tooltip" title="View Details" class="btn btn-info btn-simple btn-xs"
					                	data-toggle="modal" data-target="#viewBPdetails">
					                    <i class="fa fa-eye"></i>
					                </button>
					            </td>
					        </tr>

					         <tr>
					        	<td>Budget for 2019</td>
					            <td>1.5M</td>
					            <td class="text-center">Pending</td>
					            <td class="td-actions text-center">
					                <button type="button" rel="tooltip" title="View Details" class="btn btn-info btn-simple btn-xs"
					                	data-toggle="modal" data-target="#viewBPdetails">
					                    <i class="fa fa-eye"></i>
					                </button>
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