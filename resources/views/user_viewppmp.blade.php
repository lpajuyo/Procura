@extends('bo_main') 

@section('title', 'View PPMP')

@section('brand', 'PPMP')



@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px;">
				<p style="font-size: 23px;"> LIST OF PPMP 
					<i class="fas fa-list-ul" style="margin-left: 10px; "></i><br>
        <p style="font-size: 23px;"> APPROVE PPMP
					<i class="fas fa-pencil-alt" style="margin-left: 10px; "></i><br>
					<!-- <span style="font-size: 15px;">Project Procurement Management Plan</span> -->
					<a href="{{ route('projects.create') }}" id="create"><span class="fa fa-pencil-alt fa-xs"></span> </a>
				</p><br>
				
				<table id="example" class="table table-striped table-bordered dataTable" style="width:100%">
			        <thead>
			            <tr class=" text-primary">
			                <th>Project Title</th>
			                <th>Approver</th>
			                <th>Department</th>
			                <th>Date Submitted</th>
			                <th>Due Date</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
									@foreach($projects as $project)
			            <tr>
			                <td>{{ $project->title }}</td>
			                <td>{{ $project->approver->name }}</td>
			                <td>{{ $project->department->name }}</td>
                      <td>Mathemathics</td>
			                <td>{{ $project->created_at }}</td>
			                <td>//24/11/2019</td>
			                <td>//Approved</td>
			                <td>
			                	<button type="button" rel="tooltip" title="View Full Details" class="view-ppmp-btn btn btn-warning btn-simple btn-xs" data-id="{{ $project->id }}">
					                    <i class="fa fa-eye"></i>
					                </button>

					            <button type="button" rel="tooltip" title="Generate PPMP Document" class="btn btn-success btn-simple btn-xs" >
					            	<i class="far fa-file"></i>
					            </button>

                      <button type="button" rel="tooltip" title="Sign PPMP Document" class="btn btn-success btn-simple 		btn-xs" >
					            	<i class="fas fa-pencil-alt"></i>
					            </button>
			                </td>
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
<!-- MODAL FOR VIEW PPMP DETAILS -->
<div id="viewdets" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg  detsbody">
        <div class="modal-content" style="margin-top: 100px;">

          <div class="modal-header" style="background-color: #f4f3ef;">
            <p style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 15px;"> PROJECT TITLE: </p>
          </div>

          <div class="modal-body" style="padding: 25px 25px 25px 25px;">
            <table class="table table-bordered" >
              <thead class="text-center">
              <tr style="font-weight: bolder;">
                <td rowspan="2">CODE</td>
                <td rowspan="2">DESCRIPTION</td>
                <td rowspan="2">QTY</td>
                <td rowspan="2">UNIT PRICE</td>
                <td rowspan="2">ESTIMATED BUDGET</td>
                <td rowspan="2">MODE OF PROCUREMENT</td>
                <td colspan="12" rowspan="1" class="text-center">SCHEDULE / MILESTONES</td>               
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
            <tbody>
              <!-- populated by script -->
            </tbody>
          </table>

          <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-3">
              <button type="submit" class="btn btn-block btn-success"> APPROVE</button>
            </div>
            <div class="col-lg-3">
              <button type="submit" class="btn btn-block btn-danger"> REJECT </button>
            </div>
            <div class="col-lg-3"></div>
          </div>
          
          </div>

        </div>
      </div>
    </div>
@endsection


@section('scripts')
<!-- view ppmp modal -->
<script>
	$(".view-ppmp-btn").click(function(){
    var id = $(this).attr('data-id');
		$.ajax({
      url: "{{ route('projects.index') }}/" + id,
      dataType: "json"
    }).done(function(project){
      $("#viewdets tbody").empty();
      $.each(project.items, function (indexInArray, item) { 
        $("#viewdets tbody").append("<tr>")
        $("#viewdets tbody").append("<td>"+ item.code +"</td>");
        $("#viewdets tbody").append("<td>"+ item.description +"</td>");
        $("#viewdets tbody").append("<td>"+ item.quantity + " " + item.uom +"</td>");
        $("#viewdets tbody").append("<td>"+ item.unit_cost +"</td>");
        $("#viewdets tbody").append("<td>"+ item.estimated_budget +"</td>");
        $("#viewdets tbody").append("<td>"+ item.procurement_mode +"</td>");
        
        var months = item.schedules.map(function(schedule){
          return schedule.id;
        });
        for(i=1; i<=12; i++){
          if($.inArray(i, months) != -1)
            $("#viewdets tbody").append("<td>&#x2714;</td>");
          else
            $("#viewdets tbody").append("<td></td>");
          
        }
        $("#viewdets tbody").append("</tr>");
      
      });

      $("#viewdets").modal("show");
    });
	});
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
        	 "columnDefs": [
			    { "orderable": false, "targets": [4,5] }
			  ]
		} );
    } );
  </script>
@endsection