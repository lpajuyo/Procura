@extends('bo_main') 

@section('title', 'Approve PR')


@section('content')
<div class="row" style="padding-left: 35px; padding-right: 20px;">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body" style="margin-top: 10px;">
				<!-- <p style="font-size: 23px;"> APPROVE PR -->
					<a href="#" class="circle tablinks" id="all" onclick="openFilter(event, 'All')" style="margin-right: 150px;" rel="tooltip" title="All PR"> <span class="fas fa-list-ul fa-xs"></span> </a>
					
					<a href="#" class="circle tablinks" id="approved" onclick="openFilter(event, 'Approved')" style="margin-right: 100px;" rel="tooltip" title="Approved"> <span class="far fa-thumbs-up fa-xs"></span> </a>
					
					<a href="#" class="circle tablinks" id="pending" onclick="openFilter(event, 'Pending')"  style="margin-right: 50px;" rel="tooltip" title="Pending">
						<span class="far fa-file-powerpoint fa-xs"></span> 
					</a>
					
					<a href="#" class="circle tablinks" id="rejected" onclick="openFilter(event, 'Rejected')"  rel="tooltip" title="Rejected"> <span class="far fa-thumbs-down fa-xs"></span> </a>
				<!-- </p><br> -->
				
				<div id="All" class="tabcontent">
					<p class="text-info" style="position: absolute; font-size: 22px;">PURCHASE REQUESTS 
         			 <i class="fas fa-list-ul fa-sm" style="margin-left: 10px; color:black;"></i> </p> <br><br><br>

					<table id="example" class="table table-striped table-bordered display" style="width:100%">
				        <thead>
				            <tr class=" text-primary">
				                <th>PR NO.</th>
				                <th>Department</th>
				                <th>Date Submitted</th>
				                <th>Due Date</th>
				                <th>Status</th>
				                <th>Action</th>
				            </tr>
				        </thead>
				        <tbody>
				            <tr>
				                <td>001</td>
				                <td>Mathemathics</td>
				                <td>24/10/2019</td>
				                <td>24/11/2019</td>
				                <td>Approved</td>
				                <td>
				                	<button type="button" rel="tooltip" title="View Full Details" class="btn btn-warning btn-simple btn-xs"
						                	data-toggle="modal" data-target="#prdetails-sector">
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
<!-- MODAL FOR VIEW PR DETAILS-SECTOR -->
<div id="prdetails-sector" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg  detsbody">
        <div class="modal-content" style="margin-top: 20px; width: 1000px;">

          <div class="modal-body" style="padding: 25px 25px 25px 25px;">
            <p style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 5px;" class="text-primary"> 
              PURCHASE REQUEST NUMBER: &nbsp; <span id="title" style="color: black;"></span></p>

              <table class="table table-bordered" style="margin: : 0px 50px 20px 40px;" >
            <thead class="text-center text-info">
            <tr style="font-weight: bolder;">
              <td rowspan="2">ITEM</td>
              <td rowspan="2">ITEM DESCRIPTION</td>
              <td rowspan="2">QTY</td>
              <td rowspan="2">UNIT PRICE</td>
              <td rowspan="2">TOTAL PRICE</td>
              <td rowspan="2">PURPOSE</td>
            </tr>
            </thead>
            <tbody style="font-size: 12px;">
            <tr class="text-center" style="line-height: 10px;">
              <td></td>
              <td> </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr><br>
            </tbody>
          </table>

          <div class="row">
            <div class="col-lg-3"></div>

            <div class="col-lg-3">
              <button type="submit" class="btn btn-block btn-success"> APPROVE &nbsp;
              <i class="fa fa-thumbs-up"></i> </button>
            </div>

            <span class="line"></span>

            <div class="col-lg-3">
              
              <button type="submit" class="btn btn-block btn-danger" > REJECT &nbsp;
              <i class="fa fa-thumbs-down"></i> </button>
            </div>
          </div>
          
          </div>

        </div>
      </div>
    </div>
@endsection


@section('scripts')
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