@extends('bo_main') 

@section('title', 'View PR List')
<!-- @section('title', 'Approve PR') -->

@section('pr-active', 'active')

@section('content')
<div class="row" style="padding-left: 10px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px;">
				<!-- <p style="font-size: 23px;"> PURCHASE REQUESTS -->
					@can('create', App\PurchaseRequest::class) 
					<a href="{{ route('purchase_requests.create') }}" class="circle tablinks" id="createpr" style="margin-right: 200px;">
						<span class="fa fa-pencil-alt fa-xs"></span> 
					</a>
					@endcan
					
					<a href="#" class="circle tablinks" id="all" onclick="openFilter(event, 'All')" style="margin-right: 150px;" rel="tooltip" title="All PR"> <span class="fas fa-list-ul fa-xs"></span> </a>
					
					<a href="#" class="circle tablinks" id="approved" onclick="openFilter(event, 'Approved')" style="margin-right: 100px;" rel="tooltip" title="Approved"> <span class="far fa-thumbs-up fa-xs"></span> </a>
					
					<a href="#" class="circle tablinks" id="pending" onclick="openFilter(event, 'Pending')"  style="margin-right: 50px;" rel="tooltip" title="Pending">
						<span class="far fa-file-powerpoint fa-xs"></span> 
					</a>
					
					<a href="#" class="circle tablinks" id="rejected" onclick="openFilter(event, 'Rejected')"  rel="tooltip" title="Rejected"> <span class="far fa-thumbs-down fa-xs"></span> </a>
				<!-- </p><br> -->
				
				<div id="All" class="tabcontent">
					@if(session('approved_proj_error'))
					<div class="alert alert-danger" role="alert">
						{{ session('approved_proj_error') }}
					</div>
					@endif
					<p class="text-info" style="position: absolute; font-size: 22px;">PURCHASE REQUESTS 
         			 <i class="fas fa-list-ul fa-sm" style="margin-left: 10px; color:black;"></i> </p> <br><br><br>

					<table class="table table-striped table-bordered display" style="width:100%">
				        <thead>
				            <tr class=" text-primary">
				                <th>PR No.</th>
												@can('create', App\PurchaseRequest::class)
				                <th>Approver</th>
												@elsecan('approvePurchaseRequests', App\PurchaseRequest::class)
												<th>Department</th>
												@endcan
				                <th>Date Submitted</th>
				                {{-- <th>Due Date</th> --}}
				                <th>Status</th>
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
										@foreach($purchaseRequests as $pr)
				            <tr>
				                <td>{{ $pr->pr_number }}</td>
												@can('create', App\PurchaseRequest::class)
				                <td>{{ $pr->approver->name }}</td>
												@elsecan('approvePurchaseRequests', App\PurchaseRequest::class)
												<td>{{ $pr->department->name }}</td>
												@endcan
				                <td>{{ ($pr->submitted_at) ? $pr->submitted_at : '--' }}</td>
												<td>{{ (is_null($pr->submitted_at)) ? 'Waiting Submission' : ((is_null($pr->is_approved)) ? 'Pending' : (($pr->is_approved == true) ? 'Approved' : 'Rejected')) }}
												</td>
				                <td>
														@can('submit', $pr)
														<button form="submit-{{ $pr->id }}" type="submit" rel="tooltip" title="Submit" class="btn btn-default btn-simple btn-xs">
																					<i class="fa fa-upload"></i>
																			</button>
														<form id="submit-{{ $pr->id }}" style="display: none;" method="POST" action="{{ route('pr.submit', ['purchase_request' => $pr->id]) }}">
															@csrf
														</form>
														@elsecan('unsubmit', $pr)
														<button form="unsubmit-{{ $pr->id }}" type="submit" rel="tooltip" title="Cancel Submission" class="btn btn-danger btn-simple btn-xs">
																					<i class="fa fa-upload"></i>
																			</button>
														<form id="unsubmit-{{ $pr->id }}" style="display: none;" method="POST" action="{{ route('pr.cancel_submit', ['purchase_request' => $pr->id]) }}">
															@csrf
															@method('DELETE')
														</form>
														@endcan
				                	<button type="button" rel="tooltip" title="View Full Details" class="view-pr-btn btn btn-warning btn-simple btn-xs" data-id="{{ $pr->id }}"> <i class="fa fa-eye"></i> </button>

													<a href="{{ route('purchase_requests.showFile', ['purchase_request' => $pr->id]) }}">
							        		<button type="button" rel="tooltip" title="Generate PR Document" class="btn btn-success btn-simple btn-xs" > <i class="far fa-file"></i> </button>
													</a>

													@can('approvePurchaseRequests', App\PurchaseRequest::class)
													<button type="button" rel="tooltip" title="Sign PPMP Document" class="btn btn-success btn-simple btn-xs" >
						            	<i class="fas fa-pencil-alt"></i>
						            	</button>
													@endcan
				                </td>
				            </tr>
				    				@endforeach
				            </tbody>
				        </table>
				    </div>

				    <div id="Approved" class="tabcontent hide">
				    	<p class="text-success"  style="position: absolute; font-size: 22px;"> APPROVED PR
           			    <i class="far fa-thumbs-up fa-sm" style="margin-left: 10px; color:black;"></i> </p> 
           			    <br><br><br>
				    	APPROVED!
				    </div>

				    <div id="Pending" class="tabcontent hide">
				    	<p class="text-warning" style="position: absolute; font-size: 22px;"> PENDING PR
			            <i class="far fa-file-powerpoint fa-sm" style="margin-left: 10px; color:black;"></i> </p>
			            <br><br><br>
				    	PENDING!
				    </div>

				    <div id="Rejected" class="tabcontent hide">
				    	<p class="text-danger" style="position: absolute; font-size: 22px;"> REJECTED PR
			            <i class="far fa-thumbs-down fa-sm" style="margin-left: 10px; color:black;"></i>  </p>
			            <br><br><br>
				    	REJECTED!
				    </div>
			</div>
		</div>
	</div>

</div>

@endsection


@section('modals')
<!-- MODAL FOR VIEW PR DETAILS -->
<div id="prdetails" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg  detsbody">
        <div class="modal-content" style="margin-top: 20px; width: 1100px;">

          <div class="modal-body" style="padding: 25px 25px 25px 25px;">
            <p style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 5px;" class="text-primary"> 
              PURCHASE REQUEST NUMBER: &nbsp; <span id="pr-no" style="color: black;"></span></p>

              <table class="table table-bordered" style="margin: : 0px 50px 20px 40px;" >
            <thead class="text-center text-info">
            <tr style="font-weight: bolder;">
							<td rowspan="2">ITEM #</td>
							<td rowspan="2">UNIT</td>
							<td rowspan="2">ITEM DESCRIPTION</td>
							<td rowspan="2">QTY</td>
							<td rowspan="2">UNIT PRICE</td>
							<td rowspan="2">TOTAL PRICE</td>
            </tr>
            </thead>
            <tbody style="font-size: 12px;">
						<!-- populated by script -->
            </tbody>
          </table>
					@can('approvePurchaseRequests', App\PurchaseRequest::class)
          <div id="pr-approval" class="row">
            <div class="col-lg-3"></div>

            <div class="col-lg-3">
							<form id="approve-pr" method="POST" action="">
							@csrf
								<button type="submit" class="btn btn-block btn-success"> APPROVE &nbsp;
								<i class="fa fa-thumbs-up"></i> </button>
							</form>
            </div>

            <span class="line"></span>

            <div class="col-lg-3">
							<form id="reject-pr" method="POST" action="">
							@csrf
							@method('DELETE')
								<button type="submit" class="btn btn-block btn-danger" > REJECT &nbsp;
								<i class="fa fa-thumbs-down"></i> </button>
							</form>
            </div>
          </div>
          @endcan
          </div>

        </div>
      </div>
    </div>
@endsection


@section('scripts')
<script>
$(".view-pr-btn").click(function(){
    var id = $(this).attr('data-id');
		console.log(id);
		$.ajax({
      url: "{{ route('purchase_requests.index') }}/" + id,
      dataType: "json"
    }).done(function(pr){
      $("#pr-no").html(pr.pr_number);

      $("#prdetails tbody").empty();
			var n = 1;
      $.each(pr.items, function (indexInArray, item) { 
        $("#prdetails tbody").append("<tr class='text-center' style='line-height: 10px;>'");
        $("#prdetails tbody").append("<td>"+ n++ +"</td>");
        $("#prdetails tbody").append("<td>"+ item.project_item.uom +"</td>");
        $("#prdetails tbody").append("<td>"+ item.project_item.description +"<br />"+ item.specifications +"</td>");
        $("#prdetails tbody").append("<td>"+ item.quantity +"</td>");
        $("#prdetails tbody").append("<td>"+ item.project_item.unit_cost +"</td>");
        $("#prdetails tbody").append("<td>"+ item.total_cost +"</td>");
			}); 

			@can('approvePurchaseRequests', App\PurchaseRequest::class)
      if(pr.is_approved == null){
        $("#approve-pr, #reject-pr").attr("action", "{{ url('approved_purchase_requests') }}/" + id);
        $("#pr-approval").show();
      }
      else
        $("#pr-approval").hide();
      @endcan

      $("#prdetails").modal("show");
    }).fail(function(jqXHR, textStatus, errorThrown){
	    	alert(errorThrown);
	  });
	});
</script>

<script>
    $(document).ready(function() {
        $('table.display').DataTable({
           "columnDefs": [
          { "orderable": false, "targets": [4,5] }
        ]
    } );
    } );
</script>

<script>
function openFilter(evt, filterName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(filterName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection