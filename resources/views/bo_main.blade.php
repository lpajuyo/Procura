<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}">
  <title> @yield('title', 'Procura')</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/fonts.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('font-awesome-4.7.0/css/font-awesome.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome/css/fontawesome-all.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/linearicons/style.css') }}">
  <!-- CSS Files -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/custom.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/pd/css/bootstrap.min.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('/pd/css/paper-dashboard.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('/dropify/css/dropify.min.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/chartist.min.css') }}" >
  <!-- DATA TABLE CSS Files -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/datatables/dataTables.bootstrap4.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('/datatables/fixedHeader.bootstrap4.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('/datatables/responsive.bootstrap4.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/sweetalert2.css') }}">
    <!--   Core JS Files   -->
  <script type="text/javascript" src="{{ asset('/pd/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/app.js') }}"></script>
  <script src="{{ asset('/js/sweetalert2.js') }}"></script>
  <script src="{{ asset('/pd/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/pd/js/core/bootstrap.min.js') }}"></script>
  {{-- <!-- <script src="{{'public/js/plugins/perfect-scrollbar.jquery.min.js'}}"></script> --> --}}
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="{{ asset('/pd/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('/js/chartist.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('/pd/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('/pd/js/paper-dashboard.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/pd/demo/demo.js') }}"></script>
  <script src="{{ asset('/js/progressbar.min.js') }}"></script>
  <!-- DATA TABLE JS Files -->
  <script src="{{ asset('/datatables/jquery.dataTables.js') }}"> </script>
  <script src="{{ asset('/datatables/dataTables.bootstrap4.js') }}"> </script>
  <script src="{{ asset('/datatables/dataTables.fixedHeader.js') }}"> </script>
  <script src="{{ asset('/datatables/dataTables.responsive.js') }}"> </script>
</head>

<body class="" onload="rtdate()">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <div class="user-account">
          <img src="{{ asset('/images/user.png') }}" class="img-responsive rounded-circle user-photo" alt="User Profile Picture"> 
          <h6 class="user-name"> Hello <strong> {{ Auth::user()->name }} </strong> </h6>   
        </div>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="@yield('dashboard-active')">
            <a href="/home">
              <i class="nc-icon nc-layout-11"></i>
              <p>Dashboard</p>
            </a>  
          </li>
          @if(Auth::user()->can('viewBudgetProposals', App\BudgetProposal::class) || Auth::user()->can('viewBudgetYears', App\BudgetYear::class) || Auth::user()->can('viewBudgetAlloc'))
          <li class="sb-content @yield('budget-active')">
            <a data-toggle="collapse" href="#collapseItem1" aria-expanded="false" aria-controls="collapseItem1">
            <i class="nc-icon nc-money-coins"></i>
            <p>Budgeting</p> </a>
            <ul class="collapse @yield('budget-dropdown-show')" id="collapseItem1">
              @can('viewBudgetProposals', App\BudgetProposal::class)
              <li class="@yield('proposal-active')"> <a href="/budget_proposals"> <p> Budget Proposals</p> </a> </li>
              @endcan
              @can('viewBudgetYears', App\BudgetYear::class)
              <li class="@yield('bYear-active')"> <a href="/budget_years"> <p> Budget Year</p> </a> </li>
              @endcan
              @can('viewBudgetAlloc')
              <li class="@yield('bAlloc-active')"> <a href="/budget_allocation"> <p> Budget Allocation</p> </a> </li>
              @endcan
            </ul>
          </li>
          @endif
          @can('viewProjects', App\Project::class)
          <li class="sb-content @yield('ppmp-active')">
            <a href="/projects">
            <i class="nc-icon nc-briefcase-24"></i> 
            <p>PPMP</p> </a>
          </li>
          @endcan

          @can('viewPurchaseRequests', App\PurchaseRequest::class)
          <li class="@yield('pr-active')">
            <a href="/purchase_requests">
              <i class="nc-icon nc-bag-16"></i>
              <p>Purchase Request</p>
            </a>
          </li>
          @endcan
          @can('view-APP')
          <li class="sb-content">
            <a data-toggle="collapse" href="#collapseItem2" aria-expanded="false" aria-controls="collapseItem2">
            <i class="nc-icon nc-money-coins"></i>
            <p>APP</p> </a>
            <ul class="collapse" id="collapseItem2">
            <li class=""> <a href="{{ route('app_cse') }}"> <p> APP CSE </p> </a> </li>
              <li class=""> <a href="{{ route('app_non_cse') }}"> <p> APP NON-CSE </p> </a> </li>
            </ul>
          </li>
          @endcan
          @can('administer')
          <li class="sb-content @yield('admin-active')">
            <a data-toggle="collapse" href="#collapseItem3" aria-expanded="false" aria-controls="collapseItem3">
            <i class="nc-icon nc-money-coins"></i>
            <p>ADMINISTRATION</p> </a>
            <ul class="collapse @yield('admin-dropdown-show')" id="collapseItem3">
              <li class="@yield('cse-active')"> <a href="{{ route('cse_items.create') }}"> <p> COMMON SUPPLIES AND EQUIPMENT </p> </a> </li>
              <li class=""> <a data-toggle="modal" data-target="#pr-approver-modal"> <p> SET PR APPROVER </p> </a> </li>
            </ul>
          </li>
          @endcan

          {{-- @includeWhen((Auth::user()->type->name == 'Budget Officer'), 'sidebars.budget_officer')
          @includeWhen((Auth::user()->type->name == 'Sector Head'), 'sidebars.sector_head')
          @includeWhen((Auth::user()->type->name == 'Department Head'), 'sidebars.dept_head') --}}

          <li>
            <a href="{{ route('logout') }}" 
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
              <i class="lnr lnr-exit"></i>
              <p>Log Out</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>

    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent" style="padding-top: 0px !important;">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo" style="padding-bottom: 5px;">
              <img src="{{ asset('/images/logo.png') }}" class="img-responsive tuplogo"> 
              <div class="tuptitle"> <strong> TECHNOLOGICAL UNIVERSITY </strong> <br> OF THE <strong> PHILIPPINES </strong></div>
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">

              <li class="nav-item btn-rotate dropdown" style="padding: 0px; margin: 0px; left: 0;">
                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" rel="tooltip" title="Notifications">
                  <i class="nc-icon nc-bell-55 navicons"></i>
                  <span class="badge1" data-badge="3"></span>

                  <p>
                    <span class="d-lg-none d-md-block">Notification</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="margin-right: 9px;">
                  <a class="dropdown-item" href="#">No new notification</a>
                </div>
              </li>

              <span class="navline"></span>

              <li class="nav-item btn-rotate dropdown" style="padding-right: 0px;">
                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-tap-01 navicons"></i> quicklinks
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="margin-right: 40px;">
                  <a class="dropdown-item" href="#" data-toggle="modal">Create Budget Proposal</a>
                  <a class="dropdown-item" href="#">Create PPMP</a>
                  <a class="dropdown-item" href="#">Create Purchase Request</a>
                </div>
              </li>

              <span class="navline"></span>

              <li class="nav-item" style="padding-left: 0px;">
                <a class="nav-link btn-rotate" href="#" rel="tooltip" title="Settings">
                  <i class="nc-icon nc-settings-gear-65 navicons"></i> settings
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">
      <canvas id="bigDashboardChart"></canvas>
      </div> -->


      <div class="content" style="margin-top: 10%;">
        
          @yield('content')

      </div>
    </div>
  </div>


<!-- ALLLLLLLLLLL MODALSSSSSSSSSS -->

@yield('modals')
<div id="pr-approver-modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<div class="modal-header" style="background-color: #f4f3ef;">
				<p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;">
					Set Purchase Request Approver</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('pr_approver.set') }}">
          @csrf
          <div class="form-group">
            <label for="Current Approver">Current Approver:</label>
            <input type="text" class="form-control" value="{{ App\User::find(Setting::get('pr_approver_id', 8))->name . ', ' . App\User::find(Setting::get('pr_approver_id', 8))->position }}" readonly>
          </div>
					<div class="form-group">
            <label for="Users">Users:</label>
            <select class="form-control" name="pr_approver_id">
              @foreach (App\User::all()->keyBy('id')->forget(1)->forget(Setting::get('pr_approver_id', 8)) as $user)
              <option value="{{ $user->id }}">{{ $user->name . ', ' . $user->position}}</option>
              @endforeach
            </select>
          </div>

					<button type="submit" class="btn btn-success btn-block">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      // demo.initChartsPages();

      Echo.private('App.User.' + {{ Auth::user()->id }})
        .notification((notification) => {
          //append to notifs dropdown
          

          // show floating notif
          $.notify({
            message: notification.message
          },{
            placement: {
              from: "bottom",
              align: "right"
            }
          });
        });
      // $.notify("Hello World");
    });
  </script>
  @yield('scripts')
</body>

</html>