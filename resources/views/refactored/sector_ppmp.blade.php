@extends('bo_main') 

@section('title', 'PPMP')

@section('brand', 'PPMP APPROVALS')



@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px;">
				<p style="font-size: 23px;"> APPROVE PPMP
					<i class="fas fa-pencil-alt" style="margin-left: 10px; "></i><br>
					<!-- <span style="font-size: 15px;">Project Procurement Management Plan</span> -->
					<!-- <a href="/user_createppmp" id="create"><span class="fa fa-pencil-alt fa-xs"></span> </a> -->
				</p><br>
				
				<table id="example" class="table table-striped table-bordered dataTable" style="width:100%">
			        <thead>
			            <tr class=" text-primary">
			                <th>Project Title</th>
			                <th>Department</th>
			                <th>Date Submitted</th>
			                <th>Due Date</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			            <tr>
			                <td>PAPS</td>
			                <td>Mathemathics</td>
			                <td>24/10/2019</td>
			                <td>24/11/2019</td>
			                <td>Approved</td>
			                <td>
			                	<button type="button" rel="tooltip" title="View Full Details" class="btn btn-warning btn-simple btn-xs"
					                	data-toggle="modal" data-target="#viewdets">
					                    <i class="fa fa-eye"></i>
					                </button>

					            <button type="button" rel="tooltip" title="Sign PPMP Document" class="btn btn-success btn-simple 		btn-xs" >
					            	<i class="fas fa-pencil-alt"></i>
					            </button>
			                </td>
			            </tr>
			            <tr>
			                <td>PAPS 2</td>
			                <td>Chemistry</td>
			                <td>16/05/2018</td>
			                <td>16/06/2018</td>
			                <td>Pending</td>
			                <td>
			                	<button type="button" rel="tooltip" title="View Full Details" class="btn btn-warning btn-simple btn-xs"
					                	data-toggle="modal" data-target="#viewdets">
					                    <i class="fa fa-eye"></i>
					                </button>

					            <button type="button" rel="tooltip" title="Sign PPMP Document" class="btn btn-success btn-simple 		btn-xs" >
					            	<i class="fas fa-pencil-alt"></i>
					            </button>
			                </td>
			            </tr>
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
                <td rowspan="2">DESCRIPTION</td>
                <td rowspan="2">QTY</td>
                <td rowspan="2">UNIT PRICE</td>
                <td rowspan="2">TOTAL</td>
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
              <tr class="text-center">
                <td>Test</td>
                <td>12</td>
                <td>10</td>
                <td>120</td>
                <td> -- </td>
                <td> -- </td>
                <td> &#x2714; </td>
                <td> &#x2714; </td>
                <td> &#x2714; </td>
                <td> &#x2714;</td>
                <td> -- </td>
                <td> -- </td>
                <td> &#x2714; </td>
                <td> -- </td>
                <td> -- </td>
                <td> &#x2714; </td>
              </tr>
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