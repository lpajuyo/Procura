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
				@can('create', App\BudgetProposal::class)
				<button class="btn btn-default btn-sm" style="right: 40px; top: 25px; position: absolute !important;" data-toggle="modal"
				data-target="#makebp">
					<i class="fa fa-plus"></i> &nbsp;New Budget Proposal
				</button>
				@endcan
				<div class="table-responsive" style="overflow: visible;"> 
					<table class="table table-striped">
						<thead>
							<tr class=" text-primary">
					            <th>Year</th>
								@can('update', App\BudgetProposal::class)
					            <th>Submitter</th>
								<th>Department</th>
								@endcan
					            <th>Proposal Name</th>
					            <th>Amount</th>
					            <th>Status</th>
					            <th class="text-center">Action</th>
					        </tr>
					    </thead>

					    <tbody>
							@foreach($budgetProposals as $proposal)
					        <tr>
					        	<td>{{ $proposal->for_year }}</td>
								@can('update', App\BudgetProposal::class)
					        	<td>{{ $proposal->submitter->name }}</td>
					        	<td>{{ $proposal->department->name }}</td>
								@endcan
					        	<td>{{ $proposal->proposal_name }}</td>
					            <td>{{ $proposal->amount }}</td>
					            <td>{{ (is_null($proposal->is_approved)) ? 'Pending' : (($proposal->is_approved == true) ? 'Approved' : 'Rejected' )}}</td>
					            <td class="td-actions text-center">
									@can('view', $proposal)
									<button type="button" rel="tooltip" title="View Details" class="viewProposalbtn btn btn-info btn-simple btn-xs" data-id="{{ $proposal->id }}">
					                    <i class="fa fa-eye"></i>
					                </button>
									@endcan

									@can('viewFile', App\BudgetProposal::class)
									<a href="{{ route('budget_proposals.showFile', ['budget_proposal' => $proposal->id]) }}">
					                <button type="button" rel="tooltip" title="View File" class="btn btn-success btn-simple btn-xs">
					                    <i class="fa fa-eye"></i>
					                </button>
									</a>
									@endcan

									@can('approve', $proposal)
					                <button type="submit" form="approve-{{ $proposal->id }}" rel="tooltip" title="Approve" class="approve-btn btn btn-success btn-simple btn-xs">
					                    <i class="fa fa-edit"></i>
					                </button>
					                <button type="submit" form="reject-{{ $proposal->id }}" rel="tooltip" title="Reject" class="reject-btn btn btn-danger btn-simple btn-xs">
					                    <i class="fa fa-edit"></i>
					                </button>

									<form id="approve-{{ $proposal->id }}" method="POST" action="{{ route('approve_proposal', ['budgetProposal' => $proposal->id]) }}">
									@csrf
									</form>
									<form id="reject-{{ $proposal->id }}" method="POST" action="{{ route('reject_proposal', ['budgetProposal' => $proposal->id]) }}">
									@csrf
									@method('DELETE')
									</form>
									@endcan
					                <!-- <button type="button" rel="tooltip" title="Update Status" class="btn btn-danger btn-simple btn-xs"
					                data-toggle="modal" data-target="#updateBPstatus">
					                    <i class="fa fa-edit"></i>
					                </button> -->
					               <!--  <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
					                    <i class="fa fa-times"></i>
					                </button> -->

									
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

@section('modals')
@can('create', App\BudgetProposal::class)
<!-- MODAL FOR CREATE BUDGET PROPOSAL -->
<div id="makebp" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
				Create Budget Proposal</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form enctype="multipart/form-data" method="POST" action="{{ route('budget_proposals.store') }}">
				@csrf
					<div class="form-group">
					<label for="For Year">For Year</label>
					<input type="number" class="form-control" id="Year" name="for_year" value="{{ old('for_year') }}">
					</div>

					<div class="form-group">
					<label for="Proposal Name">Budget Proposal Name</label>
					<input type="text" class="form-control" id="Proposal Name" name="proposal_name" value="{{ old('proposal_name') }}">
					</div>
					
					<div class="form-group">
					<label for="Amount">Amount</label>
					<input type="number" min="0" step=".01" class="form-control" id="Amount" name="amount" value="{{ old('amount') }}">
					</div>

					<div>
					<label for="Proposal File">Budget Proposal File</label>
					<input type="file" class="dropify" data-allowed-file-extensions="pdf docx" name="proposal_file">
					</div><br>

					@include('errors')

					<button type="submit" class="btn btn-success btn-block">Submit</button>
				</form>
			</div>

		</div>
	</div>
</div>
@endcan

@can('view', $budgetProposals->first())
<!-- MODAL FOR VIEW BUDGET PROPOSAL DETAILS -->
<div id="viewBPdetails" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #f4f3ef;">
			<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
			Budget Proposal Details</p>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<p><strong>For Year:</strong> <i data-attr="for_year"></i> </p>
				<p><strong>Proposal Name:</strong> <i data-attr="proposal_name"></i> </p>
				<p><strong>Amount:</strong>  <i data-attr="amount"></i></p>
				<p><strong>Date Submitted:</strong> <i data-attr="date_submitted"></i></p>
				<p> <strong>Date Notified:</strong> <i data-attr="date_notified"></i></p>
				<p><strong>Status:</strong> <i data-attr="status"></i> </p>
				<p><strong>Comments or Remarks:</strong> </p>
				<p style="margin-left: 15px;"> <i data-attr="remarks"> </i></p>
			</div>
		</div>
	</div>
</div>
@endcan

@can('update', App\BudgetProposal::class)
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
			<label for="Status">Update Status: </label>
			<!-- <select class="form-control" id="Status">
				<option> Approve </option>
				<option> For Review </option>
				<option> Reject </option>
			</select> -->
			</div><br>
			
			<div class="form-group">
			<label for="remarks">Comments or Remarks:</label>
			<textarea class="form-control" id="remarks" rows="10" style="max-height: 30vh;" name="remarks" value=""></textarea>
			</div><br>

			<button type="submit" class="btn btn-success btn-block">Submit</button>
		</form>
			</div>

		</div>
	</div>
</div>
@endcan
@endsection

@section('scripts')
@can('create', App\BudgetProposal::class)
@if($errors->any())
<script>
	$(document).ready(function(){
		$("#makebp").modal("show");
	});
</script>
@endif

<script>
  $(function() {
    $('.dropify').dropify();

    var drEvent = $('#dropify-event').dropify();
    drEvent.on('dropify.beforeClear', function(event, element) {
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
      alert('File deleted');
    });

    $('.dropify-fr').dropify({
      messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove: 'Supprimer',
        error: 'Désolé, le fichier trop volumineux'
      }
    });
  });
</script>
@endcan

@can('view', $budgetProposals->first())
<script>
$(".viewProposalbtn").click(function(){
	$.ajax({
		url: "{{ url('budget_proposals') }}" + "/" + $(this).attr('data-id'),
		dataType: "json"
	}).done(function(budgetProposal){

		$("[data-attr=for_year").html(budgetProposal.for_year)
		$("[data-attr=proposal_name").html(budgetProposal.proposal_name)
		$("[data-attr=amount").html(budgetProposal.amount)
		$("[data-attr=date_submitted").html(budgetProposal.created_at)
		
		if(budgetProposal.is_approved == null){
			$("[data-attr=date_notified").html("--")
			$("[data-attr=status").html("Pending")
		}
		else if(budgetProposal.is_approved == 1){
			$("[data-attr=status").html("Approved")
			$("[data-attr=date_notified").html(budgetProposal.updated_at)
		}
		else if(budgetProposal.is_approved == 0){
			$("[data-attr=status").html("Rejected")
			$("[data-attr=date_notified").html(budgetProposal.updated_at)
		}
		$("[data-attr=remarks").html(budgetProposal.remarks)

		$("#viewBPdetails").modal("show")
	}).fail(function(jqXHR, textStatus, errorThrown){
		alert(errorThrown);
	});
});
</script>
@endcan

@can('update', App\BudgetProposal::class)
<script>
	$(".approve-btn, .reject-btn").click(function(event){
		event.preventDefault();
		var action = $(this).attr('title');
		var form = $(this).attr('form');
		
		$("#updateBPstatus [for=Status]").html(function(i, oldText){
			return oldText + action;
		});

		$("#updateBPstatus textarea,button[type=submit]").attr('form', form);

		$("#updateBPstatus").modal("show")
	});
</script>
@endcan
@endsection