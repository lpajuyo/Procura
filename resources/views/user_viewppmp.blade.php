@extends('bo_main') 
@section('title', 'View PPMP') 
@section('ppmp-active', 'active') 
@section('brand', 'PPMP') 
@section('content')
<!-- 
<h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 10px; padding-right: 20px;">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-body" style="margin-top: 10px;">
        @can('create', App\Project::class)
        <!-- 	<p style="font-size: 23px; margin-bottom: 40px;"> LIST OF PPMP
					<i class="fas fa-list-ul" style="margin-left: 10px; "></i><br> -->
        <a href="{{ route('projects.create') }}" id="create" style="margin-right: 200px;">
          <span class="fa fa-pencil-alt fa-xs"></span> </a> @elsecan('approveProjects', App\Project::class) @endcan

        <a href="#" class="circle tablinks" id="all" onclick="filterTableByStatus('')" style="margin-right: 150px;" rel="tooltip"
          title="All PPMP"> <span class="fas fa-list-ul fa-xs"></span> </a>

        <a href="#" class="circle tablinks" id="approved" onclick="filterTableByStatus('Approved')" style="margin-right: 100px;"
          rel="tooltip" title="Approved"> <span class="far fa-thumbs-up fa-xs"></span> </a>

        <a href="#" class="circle tablinks" id="pending" onclick="filterTableByStatus('Pending')" style="margin-right: 50px;" rel="tooltip"
          title="Pending">
            <span class="far fa-file-powerpoint fa-xs"></span> 
          </a>

        <a href="#" class="circle tablinks" id="rejected" onclick="filterTableByStatus('Rejected')" rel="tooltip" title="Rejected">
          <span class="far fa-thumbs-down fa-xs"></span> </a>
        <!-- <p style="font-size: 23px;"> APPROVE PPMP
					<i class="fas fa-pencil-alt" style="margin-left: 10px; "></i><br>
        </p><br> -->
        {{-- <a href="#" class="circle tablinks" id="all" onclick="openFilter(event, 'All')" style="margin-right: 150px;"
          rel="tooltip" title="All PPMP"> <span class="fas fa-list-ul fa-xs"></span> </a>

        <a href="#" class="circle tablinks" id="approved" onclick="openFilter(event, 'Approved')" style="margin-right: 100px;" rel="tooltip"
          title="Approved"> <span class="far fa-thumbs-up fa-xs"></span> </a>

        <a href="#" class="circle tablinks" id="pending" onclick="openFilter(event, 'Pending')" style="margin-right: 50px;" rel="tooltip"
          title="Pending">
            <span class="far fa-file-powerpoint fa-xs"></span> 
          </a>

        <a href="#" class="circle tablinks" id="rejected" onclick="openFilter(event, 'Rejected')" rel="tooltip" title="Rejected"> <span class="far fa-thumbs-down fa-xs"></span> </a>        --}}

        <div id="All" class="tabcontent">
          <p class="text-info" style="position: absolute; font-size: 22px;">LIST OF ALL PPMP FOR {{ $activeYear->budget_year }}
            <i class="fas fa-list-ul fa-sm" style="margin-left: 10px; color:black;"></i> </p>
          <br><br><br>

          @if(session('dept_budget_error'))
          <div class="alert alert-danger notif" role="alert" style="margin-bottom: 20px;">
            {{ session('dept_budget_error') }}
          </div>
          @endif
          @if(session('signature_error'))
          <div class="alert alert-danger notif" role="alert" style="margin-bottom: 60px;">
            {{ session('signature_error') }}
          </div>
          @endif
          
          <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
              <tr class=" text-primary">
                <th>Project Title</th>
                @can('create', App\Project::class)
                <th>Approver</th>
                @elsecan('approveProjects', App\Project::class)
                <th>Department</th>
                @endcan
                <th>Date Submitted</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="minrow">
              @foreach($projects as $project)
              <tr>
                <td>{{ $project->title }}</td>
                @can('create', App\Project::class)
                <td>{{ $project->approver->name }}</td>
                @elsecan('approveProjects', App\Project::class)
                <td>{{ $project->department->name }}</td>
                @endcan
                <td>{{ ($project->submitted_at) ? $project->submitted_at : '--' }}</td>
                <td>{{ (is_null($project->submitted_at)) ? 'Waiting Submission' : ((is_null($project->is_approved)) ? 'Pending' : (($project->is_approved == true) ? 'Approved' : 'Rejected')) }}
                </td>
                <td>
                  @can('submit', $project)
                  <button form="submit-{{ $project->id }}" type="submit" rel="tooltip" title="Submit" class="btn btn-success btn-simple btn-sm">
                                <i class="fa fa-upload"></i>
                            </button>
                  <form id="submit-{{ $project->id }}" style="display: none;" method="POST" action="{{ route('projects.submit', ['project' => $project->id]) }}">
                    @csrf
                  </form>
                  @elsecan('unsubmit', $project)
                  <button form="unsubmit-{{ $project->id }}" type="submit" rel="tooltip" title="Cancel Submission" class="btn btn-default btn-simple btn-sm">
                                <i class="fa fa-upload"></i>
                            </button>
                  <form id="unsubmit-{{ $project->id }}" style="display: none;" method="POST" action="{{ route('projects.cancel_submit', ['project' => $project->id]) }}">
                    @csrf
                    @method('DELETE')
                  </form>
                  @endcan

                  <button type="button" rel="tooltip" title="View Full Details" class="view-ppmp-btn btn btn-primary btn-simple btn-sm" data-id="{{ $project->id }}">
  					                    <i class="fa fa-eye"></i>
                              </button>
                  @can('update', $project)
                  <a href="{{ route('project_items.create', ['project' => $project->id]) }}" rel="tooltip" title="Edit Project" class="btn btn-warning btn-simple btn-sm">
                    <i class="fa fa-pencil-square-o"></i>
                  </a>
                  @endcan
                  <a href="{{ route('projects.generateFile', ['project' => $project->id]) }}">
                        <button type="button" rel="tooltip" title="Generate PPMP Document" class="btn btn-info btn-simple btn-sm" >
  					            	<i class="far fa-file"></i>
  					            </button>
                        </a> 
                  @can('delete', $project)
                  <button type="submit" form="{{ 'del-proj-' . $project->id }}" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-sm">
                          <i class="fa fa-times"></i>
                        </button>
                  <form style="display: none;" id="{{ 'del-proj-' . $project->id }}" method="POST" action="{{ route('projects.destroy', ['project' => $project->id]) }}">
                    @csrf @method('DELETE')
                  </form>
                  @endcan {{-- @can('approveProjects', App\Project::class)
                  <button type="button" rel="tooltip" title="Sign PPMP Document" class="btn btn-success btn-simple btn-xs">
  					            	<i class="fas fa-pencil-alt"></i>
  					            </button> @endcan --}} {{-- <button type="submit" form="{{ $project->id }}-create-pr"
                    rel="tooltip" title="Create Purchase Request" class="btn btn-danger btn-simple btn-xs">
  					            	<i class="fas fa-pencil-alt"></i>
  					            </button>

                  <form id="{{ $project->id }}-create-pr" method="POST" action="{{ route('purchase_requests.store') }}">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                  </form> --}}

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{--
        <div id="Approved" class="tabcontent hide">
          <p class="text-success" style="position: absolute; font-size: 22px;"> APPROVED PPMP
            <i class="far fa-thumbs-up fa-sm" style="margin-left: 10px; color:black;"></i> </p>
          <br><br><br>
          <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
              <tr class=" text-primary">
                <th>Project Title</th>
                @can('create', App\Project::class)
                <th>Approver</th>
                @elsecan('approveProjects', App\Project::class)
                <th>Department</th>
                @endcan
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
                @can('create', App\Project::class)
                <td>{{ $project->approver->name }}</td>
                @elsecan('approveProjects', App\Project::class)
                <td>{{ $project->department->name }}</td>
                @endcan
                <td>{{ $project->created_at }}</td>
                <td>//24/11/2019</td>
                <td>{{ (is_null($project->is_approved)) ? 'Pending' : (($project->is_approved == true) ? 'Approved' : 'Rejected'
                  )}}
                </td>
                <td>
                  <button type="button" rel="tooltip" title="View Full Details" class="view-ppmp-btn btn btn-warning btn-simple btn-xs" data-id="{{ $project->id }}">
                                <i class="fa fa-eye"></i>
                            </button>

                  <a href="{{ route('projects.generateFile', ['project' => $project->id]) }}">
                        <button type="button" rel="tooltip" title="Generate PPMP Document" class="btn btn-success btn-simple btn-xs" >
                          <i class="far fa-file"></i>
                        </button>
                        </a> @can('approveProjects', App\Project::class)
                  <button type="button" rel="tooltip" title="Sign PPMP Document" class="btn btn-success btn-simple btn-xs">
                          <i class="fas fa-pencil-alt"></i>
                        </button> @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div id="Pending" class="tabcontent hide">
          <p class="text-warning" style="position: absolute; font-size: 22px;"> PENDING PPMP
            <i class="far fa-file-powerpoint fa-sm" style="margin-left: 10px; color:black;"></i> </p>
          <br><br><br> PENDING
        </div>

        <div id="Rejected" class="tabcontent hide">
          <p class="text-danger" style="position: absolute; font-size: 22px;"> REJECTED PPMP
            <i class="far fa-thumbs-down fa-sm" style="margin-left: 10px; color:black;"></i> </p>
          <br><br><br> REJECTED
        </div> --}}
      </div>
    </div>
  </div>

</div>
@endsection
 
@section('modals')
<!-- MODAL FOR VIEW PPMP DETAILS -->
<div id="viewdets" class="modal fade" role="dialog">
  <div class="modal-dialog detsbody">
    <div class="modal-content" style="margin-top: 20px; width: 1100px;">

      <!-- <div class="modal-header" style="background-color: #f4f3ef;">
            <p style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 15px;"> PROJECT TITLE: <span id="title"></span></p>
          </div> -->

      <div class="modal-body" style="padding: 25px 25px 25px 25px;">
        <p style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 5px;" class="text-primary">
          PROJECT TITLE: &nbsp; <span id="title" style="color: black;"></span></p>

        <table class="table table-bordered">
          <thead class="text-center text-info">
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
          <tbody style="font-size: 12px; line-height: 10px;">
            <!-- populated by script -->
          </tbody>
        </table>
        <p style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 5px;" class="text-success"><strong>
          TOTAL: </strong> &nbsp; <span style="color: black;">&#8369;</span> <span id="total" style="color: black;"></span></p>
        <p style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 5px;" class="text-danger"><strong>
          TOTAL WITH CONTINGENCY(+20%): </strong> &nbsp; <span style="color: black;">&#8369;</span> <span id="total-contingency" style="color: black;"></span></p>
        <p id="remarks" style="font-family: Montserrat; font-size: 18px; margin-top: 2%; margin-left: 5px;" class="text-warning">
          <strong> REMARKS: </strong> <span style="color: black;"></span></p>
        @can('approveProjects', App\Project::class)
        
        @include('errors')

        <div class="row">
          <div class="col-lg-3"></div>
          <div id="approve-dropdown" class="col-lg-3 dropdown">
            <button type="button" class="btn btn-block btn-success dropdown-toggle" data-toggle="dropdown"> APPROVE</button>
            <div class="dropdown-menu dropdown-menu-right">
              <form class="px-2 py-1" id="approve-project" method="POST" action="">
                @csrf
                <div class="form-group">
                  <label for="Remarks">Remarks:</label>
                  <textarea class="form-control" name="remarks" cols="100"></textarea>
                </div>

                <button type="submit" class="float-right btn btn-default btn-sm">Submit</button>
              </form>
            </div>
          </div>
          <div id="reject-dropdown" class="col-lg-3 dropdown">
            <button type="button" class="btn btn-block btn-danger dropdown-toggle" data-toggle="dropdown"> REJECT </button>
            <div class="dropdown-menu dropdown-menu-right">
              <form class="px-2 py-1" id="reject-project" method="POST" action="">
                @csrf @method('DELETE')
                <div class="form-group">
                  <label for="Remarks">Remarks:</label>
                  <textarea class="form-control" name="remarks" cols="100"></textarea>
                </div>

                <button type="submit" class="float-right btn btn-default btn-sm">Submit</button>
              </form>
            </div>
          </div>
          <div class="col-lg-3"></div>
        </div>
        @endcan
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
      $("#title").html(project.title);
      $("#total").html(project.total_budget);
      $("#total-contingency").html(project.total_budget_with_contingency);

      if(project.remarks)
        $("#remarks span").html(project.remarks);
      else
        $("#remarks").hide();

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
      @can('approveProjects', App\Project::class)
      if(project.is_approved == null){
        $("#approve-dropdown, #reject-dropdown").show();
        $("#approve-project, #reject-project").attr("action", "{{ url('approved_projects') }}/" + id);
      }
      else
        $("#approve-dropdown, #reject-dropdown").hide();
      @endcan
      $("#viewdets").modal("show");
    }).fail(function(jqXHR, textStatus, errorThrown){
	    	alert(errorThrown);
	  });
	});

</script>

<script>
  $(document).ready(function() {
    $('table.display').DataTable({
        "columnDefs": [{ 
          "orderable": false, 
          "targets": [4] 
          }]
    });
  });

</script>
<script>
  function filterTableByStatus(status){
    var table = $('table.display').DataTable();

    table.column(3).search(status).draw();
  }

</script>
{{--
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

</script> --}}

<script>
  $(document).ready(function() {
    $('.notif').toggleClass('show');
    setTimeout(function(){
      $('.notif').removeClass('show');
    }, 9000);
  });
</script>
@endsection