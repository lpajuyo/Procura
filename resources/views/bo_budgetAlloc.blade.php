@extends('bo_main') 
@section('title', 'Budget Allocation') {{-- 
@section('brand', 'Budget Year') --}} 
@section('budget-active',
'active') 
@section('budget-dropdown-show', 'show') 
@section('bAlloc-active', 'active') 
@section('content')
<div class="row" style="padding-left: 35px; padding-right: 20px;">

  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="nc-icon nc-money-coins text-success"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              @if(Auth::user()->type->name == "Sector Head")
              <p class="card-category">Sector's Total Budget</p>
              <p class="card-title">
                @if(Auth::user()->userable->sector->isAllocated($budgetYear)) &#8369;{{ number_format(Auth::user()->userable->sector->isAllocated($budgetYear)->budget->total(),
                2) }} @else {{ "--" }} @endif
              </p>
              @else
              <p class="card-category">Year's Total Budget</p>
              <p class="card-title">&#8369;{{ number_format($budgetYear->total(), 2) }}</p>
              {{-- @if(strlen($budgetYear->total()) > 9)
              <p class="card-title">&#8369;{{ substr_replace($budgetYear->total(),"",-9) }} M
                <p>
                  @else
                  <p class="card-title">&#8369;{{ number_format($budgetYear->total(), 2) }}
                    <p>
                      @endif --}} @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <!-- <div class="stats">
                  <i class="fa fa-calendar-o"></i> Total Budget
                </div> -->
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-3">
            <div class="icon-big text-center icon-warning">
              <i class="lnr lnr-cart text-primary"></i>
            </div>
          </div>
          <div class="col-9">
            <div class="numbers">
              @if(Auth::user()->type->name == "Sector Head")
              <p class="card-category">Sector's Total Budget Allocated</p>
              <p class="card-title">
                @if(Auth::user()->userable->sector->isAllocated($budgetYear)) &#8369;{{ number_format(Auth::user()->userable->sector->isAllocated($budgetYear)->budget->allocated(),
                2) }} @else {{ "--" }} @endif
              </p>
              @else
              <p class="card-category">Total Budget Allocated</p>
              <p class="card-title">
                &#8369;{{ number_format($budgetYear->allocated(), 2) }}
              </p>
              {{-- @if(strlen($budgetYear->allocated()) > 9)
              <p class="card-title">&#8369;{{ substr_replace($budgetYear->allocated(),"",-9) }} M
                <p>
                  @else
                  <p class="card-title">&#8369;{{ number_format($budgetYear->allocated(), 2) }}
                    <p>
                      @endif --}} @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <!-- <div class="stats">
                  <i class="fa fa-clock-o"></i> Total Budget Allocated
                </div> -->
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="lnr lnr-cart text-danger"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              @if(Auth::user()->type->name == "Sector Head")
              <p class="card-category">Sector's Remaining Budget</p>
              <p class="card-title">
                @if(Auth::user()->userable->sector->isAllocated($budgetYear)) &#8369;{{ number_format(Auth::user()->userable->sector->isAllocated($budgetYear)->budget->remaining(),
                2) }} @else {{ "--" }} @endif
              </p>
              @else
              <p class="card-category">Remaining Budget</p>
              <p class="card-title">
                &#8369;{{ number_format($budgetYear->remaining(), 2) }}
              </p>
              {{-- @if(strlen($budgetYear->remaining()) > 9)
              <p class="card-title">&#8369;{{ substr_replace($budgetYear->remaining(),"",-9) }} M
                <p>
                  @else
                  <p class="card-title">&#8369;{{ number_format($budgetYear->remaining(), 2) }}
                    <p>
                      @endif --}} @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <!-- <div class="stats">
                  <i class="fa fa-clock-o"></i> Remaining Budget
                </div> -->
      </div>
    </div>
  </div>
</div>

<!-- 
  <h3 style="font-family:Montserrat; padding-top: 0;"> Budget Proposal History &nbsp; </h3> -->
<div class="row" style="padding-left: 35px; padding-right: 20px;">

  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-body" style="margin-top: 5px;">
        <div>
          @if(session('active_year_error'))
          <div class="alert alert-danger" role="alert">
            {{ session('active_year_error') }}
          </div>
          @elseif(session('active_year'))
          <div class="alert alert-success" role="alert">
            Showing current active budget year
          </div>
          @endif
          <p style="position: absolute; font-size: 25px;"> Budget Allocation for {{ $budgetYear->budget_year }} </p>
          {{-- @can('createBudgetAlloc', $budgetYear) --}} @if(Auth::user()->can('create', [App\SectorBudget::class, $budgetYear])
          || Auth::user()->can('create', [App\DepartmentBudget::class, $budgetYear]))
          <button class="btn btn-default btn-sm" style="right: 30px; position: absolute !important;" data-toggle="modal" data-target="#BA">
            <i class="fa fa-plus"></i> &nbsp;New Budget Allocation
          </button> @endif {{-- @endcan --}}
        </div><br><br><br>
        <div class="table-responsive" style="overflow: visible;">
          <table class="table">
            <thead>
              <tr class=" text-primary">
                <th>Sector</th>
                <th>Fund 101</th>
                <th>Fund 164</th>
                <!-- <th class="text-center">Budget Status</th> -->
              </tr>
            </thead>

            <tbody>
              @foreach($sectors as $sector) @can('view', [App\SectorBudget::class, $sector])
              <tr class="table-dark">
                <td>{{ $sector->name }}</td>
                <td>{!! ($sector->isAllocated($budgetYear)) ? $sector->isAllocated($budgetYear)->budget->fund_101 : "<em>Unallocated</em>"
                  !!}
                </td>
                <td>{!! ($sector->isAllocated($budgetYear)) ? $sector->isAllocated($budgetYear)->budget->fund_164 : "<em>Unallocated</em>"
                  !!}
                </td>
              </tr>
              @foreach($sector->departments as $dept)
              <tr class="table-light">
                <td>&#8640; {{ $dept->name }}</td>
                <td>{!! ($dept->isAllocated($budgetYear)) ? $dept->isAllocated($budgetYear)->budget->fund_101 : "<em>Unallocated</em>"
                  !!}
                </td>
                <td>{!! ($dept->isAllocated($budgetYear)) ? $dept->isAllocated($budgetYear)->budget->fund_164 : "<em>Unallocated</em>"
                  !!}
                </td>
              </tr>
              @endforeach
              <tr>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              @endcan @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
 
@section('modals')
<!-- MODAL FOR BUDGET ALLOCATION -->
<div id="BA" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header" style="background-color: #f4f3ef;">
        <p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;"> Budget Allocation</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <ul class="nav nav-pills nav-pills-info nav-pills-icons" role="tablist" style="right: 30px; position: absolute !important;">
          @can('create', [App\SectorBudget::class, $budgetYear])
          <li class="nav-item">
            <a class="nav-link active" href="#sector" role="tab" data-toggle="tab">
              <i class="nc-icon nc-app"></i>
              For Sector
            </a>
          </li>
          @endcan
          <li class="nav-item">
            @cannot('create', [App\SectorBudget::class, $budgetYear])
            <a class="nav-link active" href="#dept" role="tab" data-toggle="tab">
            @elsecannot('create', [App\DepartmentBudget::class, $budgetYear])
              <a class="nav-link disabled" href="#dept" role="tab" data-toggle="tab">
            @else
              <a class="nav-link" href="#dept" role="tab" data-toggle="tab">
            @endcannot
              <i class="nc-icon nc-settings"></i>
              For Department
            </a>
          </li>
        </ul> <br><br> @can('create', [App\SectorBudget::class, $budgetYear])
        <div class="tab-content tab-space" style="position: relative;">
          <div class="tab-pane active" id="sector">
            <form method="POST" action="/sector_budgets">
              @csrf
              <input type="hidden" name="budget_year_id" value="{{ $budgetYear->id }}">
              <div class="form-group">
                <label for="Status">Sector</label>
                <select name="sector_id" class="form-control" id="Status">
                  @foreach($sectors as $sector)
                  @if($sector->isUnallocated($budgetYear))
                  <option value="{{ $sector->id }}" {{ ($errors->sector_budget->any() && $sector->id == old('sector_id')) ? "selected" : "" }}>{{ $sector->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div><br>

              <div class="form-group">
                <label for="Amount">Fund 101 (Remaining: &#8369;{{ number_format($budgetYear->remainingFund101(), 2) }})</label>
                <input type="number" min="0" step=".01" class="form-control" id="Amount" name="fund_101" value="{{ ($errors->sector_budget->any()) ? old('fund_101') : '' }}">
              </div><br>

              <div class="form-group">
                <label for="Amount">Fund 164 (Remaining: &#8369;{{ number_format($budgetYear->remainingFund164(), 2) }})</label>
                <input type="number" min="0" step=".01" class="form-control" id="Amount" name="fund_164" value="{{ ($errors->sector_budget->any()) ? old('fund_1641') : '' }}">
              </div><br>

              <!-- <div class="form-group">
                <label for="Status">STATUS</label>
                <select class="form-control" id="Status">
                  <option> Active </option>
                  <option> Inactive </option>
                </select>
              </div><br> -->

              @if ($errors->sector_budget->any())
              <div class="alert alert-danger" role="alert">
                @foreach ($errors->sector_budget->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
              </div>
              @endif

              <button type="submit" class="btn btn-success btn-block">Save</button>
            </form>
          </div>
          @endcan

          <div class="tab-pane" id="dept">
            <form method="POST" action="/department_budgets">
              @csrf

              <input type="hidden" name="budget_year_id" value="{{ $budgetYear->id }}"> @can('create', App\SectorBudget::class)
              <div class="form-group">
                <label for="sectorstat">Sector</label>
                <select name="sector_id" class="form-control" id="sectorstat">
                  @foreach($sectors as $sector)
                  @if($sector->isAllocated($budgetYear))
                  @if($sector->departments->count() != $budgetYear->allocatedSectors->firstWhere('id', $sector->id)->budget->allocatedDepartments->count())
                  <option value="{{ $sector->id }}" {{ ($errors->dept_budget->any() && $sector->id == old('sector_id')) ? "selected" : "" }}>{{ $sector->name }}</option>
                  @endif
                  @endif
                  @endforeach
                </select>
              </div><br> @else
              <input type="hidden" name="sector_id" id="sectorstat" value="{{ Auth::user()->userable->sector_id }}"> @endcan

              <div class="form-group">
                <label for="deptstat">Department</label>
                <select name="department_id" class="form-control" id="deptstat"> <!-- options loaded thru popDepartments() -->
                </select>
              </div><br>

              <div class="form-group">
                <!-- get sectorbudget remaining fund 101 thru sector id and budget year id -->
                <label for="Amount">Fund 101 (Remaining: &#8369;<span id="sector-rem-101"></span>)</label>
                <input type="number" min="0" step=".01" class="form-control" id="Amount" name="fund_101" value="{{ ($errors->dept_budget->any()) ? old('fund_101') : '' }}">
              </div><br>

              <div class="form-group">
                <label for="Amount">Fund 164 (Remaining: &#8369;<span id="sector-rem-164"></span>)</label>
                <input type="number" min="0" step=".01" class="form-control" id="Amount" name="fund_164" value="{{ ($errors->dept_budget->any()) ? old('fund_164') : '' }}">
              </div><br>

              <!-- <div class="form-group">
                <label for="Status">STATUS</label>
                <select class="form-control" id="Status">
                  <option> Active </option>
                  <option> Inactive </option>
                </select>
              </div><br> -->

              @if ($errors->dept_budget->any())
              <div class="alert alert-danger" role="alert">
                @foreach ($errors->dept_budget->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
              </div>
              @endif

              <button type="submit" class="btn btn-success btn-block">Save</button>
            </form>
          </div>
        </div>
      </div>
      <!-- end of modal-content -->
    </div>
  </div>
@endsection
 
@section('scripts') @if ($errors->sector_budget->any())
  <script>
    $('#BA').modal('show')
    $('a[href="#sector"').tab('show')
  </script>
  @endif @if ($errors->dept_budget->any())
  <script>
    $('#BA').modal('show')
    $('a[href="#dept"').tab('show')
  </script>
  @endif


  <!-- scripts for add dept budget form -->
  <script>
    $(document).ready(function(){
      popDepartments($("#sectorstat").val());
      popRemainingFunds($("#sectorstat").val());
    });

    $("#sectorstat").change(function(){
      popDepartments($(this).val());
      popRemainingFunds($(this).val());
    });

    function popDepartments(sector_id){ //populate department dropdown for add deparment budget form
      var allocatedDepts = @json($budgetYear->departmentBudgets->pluck('department_id'));        
      $.ajax({                            
        url: "{{ url('sectors') }}" + "/" + sector_id,
        dataType: "json"
      })
      .done(function(sector){
        $("#deptstat").empty();
        $.each(sector.departments, function(index, dept){
          if($.inArray(dept.id, allocatedDepts) == -1) //if dept.id not in allocatedDepts
            @if(old('department_id') != null)
            if(dept.id == {{ old('department_id') }})
              $("#deptstat").append("<option value='" + dept.id + "' selected>" + dept.name + "</option>");
            else
            @endif
              $("#deptstat").append("<option value='" + dept.id + "'>" + dept.name + "</option>");
        });
      });
    }

    function popRemainingFunds(sector_id){
      $.ajax({
        url: "{{ route('budget_years.show', ['id' => $budgetYear->id ]) }}",
        dataType: "json"
      })
      .done(function(budgetYear){
        console.log(budgetYear);
        $.each(budgetYear.allocated_sectors, function(index, sector){
          if(sector.id == sector_id){
            $("#sector-rem-101").html(sector.budget.remaining_fund_101);
            $("#sector-rem-164").html(sector.budget.remaining_fund_164);
          }
        });
      });
    }
  </script>
@endsection