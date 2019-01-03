@extends('bo_main') 

@section('title', 'Budget Proposal')

@section('brand', 'Budget Proposal List')



@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 30px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px;">
				<p style="position: absolute; font-size: 22px;"> Budget Proposal List </p><br><br><br>
				<div class="table-responsive" style="overflow: visible;"> 
					<table class="table table-striped">
						<thead>
							<tr class=" text-primary">
					            <th>Proposal Name</th>
					            <th>Amount</th>
					            <th class="text-center">File Name</th>
					            <th class="text-center">Action</th>
					        </tr>
					    </thead>

					    <tbody>
					        <tr>
					        	<td>Budget for 2019</td>
					            <td>1.5M</td>
					            <td class="text-center">Blahblahblah.docx</td>
					            <td class="td-actions text-center">
					                <button type="button" rel="tooltip" title="View File" class="btn btn-success btn-simple btn-xs">
					                    <i class="fa fa-eye"></i>
					                </button>
					                <button type="button" rel="tooltip" title="Update Status" class="btn btn-danger btn-simple btn-xs"
					                data-toggle="modal" data-target="#updateBPstatus">
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

@section('modals')
<!-- MODAL FOR UPDATE BUDGET PROPOSAL STATUS -->
<div id="updateBPstatus" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #f4f3ef;">
			<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
			Update Budget Proposal Status</p>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form>
			<div class="form-group">
			<label for="Status">Update Status:</label>
			<select class="form-control" id="Status">
				<option> Approve </option>
				<option> For Review </option>
				<option> Reject </option>
			</select>
			</div><br>
			
			<div class="form-group">
			<label for="remarks">Comments or Remarks:</label>
			<textarea class="form-control" id="remarks" rows="10" style="max-height: 30vh;"></textarea>
			</div><br>

			<button type="submit" class="btn btn-success btn-block">Submit</button>
		</form>
			</div>

		</div>
	</div>
</div>
@endsection