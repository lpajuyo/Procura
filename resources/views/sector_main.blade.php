<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> @yield('title','Procura')</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/fonts.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/fontawesome/css/fontawesome-all.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/linearicons/style.css') }}">
  <!-- CSS Files -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/custom.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/pd/css/bootstrap.min.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('/pd/css/paper-dashboard.css') }}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('/dropify/css/dropify.min.css') }}" >

    <!--   Core JS Files   -->
  <script src="{{ asset('/pd/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('/pd/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/pd/js/core/bootstrap.min.js') }}"></script>
  <!-- <script src="{{'public/js/plugins/perfect-scrollbar.jquery.min.js'}}"></script> -->
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="{{ asset('/pd/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('/pd/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('/pd/js/paper-dashboard.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/pd/demo/demo.js') }}"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <div class="user-account">
          <img src="{{ asset('/images/user.png') }}" class="img-responsive rounded-circle user-photo" alt="User Profile Picture"> 
          <h6 class="user-name"> Hello <strong> Sector! </strong> </h6>   
        </div>
      </div>

      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="/">
              <i class="nc-icon nc-layout-11"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="sb-content">
            <a data-toggle="collapse" href="#collapseItem1" aria-expanded="false" aria-controls="collapseItem1">
            <i class="nc-icon nc-money-coins"></i>
            <p>Budget Proposal</p> </a>
            <ul class="collapse" id="collapseItem1">
              <li> <a href="" data-toggle="modal" data-target="#makebp"><p> Create Budget Proposal</p> </a> </li>
              <li> <a href="/sector_BPhistory"><p> Budget Proposal History</p> </a> </li>
            </ul>
          </li>

          <li class="sb-content">
            <a href="/sector_budgetAlloc">
            <i class="nc-icon nc-money-coins"></i>
            <p>Budget Allocation</p> </a>
          </li>

          <li class="sb-content">
            <a data-toggle="collapse" href="#collapseItem2" aria-expanded="false" aria-controls="collapseItem2">
            <i class="nc-icon nc-briefcase-24"></i> 
            <p>PPMP</p> </a>
            <ul class="collapse" id="collapseItem2">
              <li> <a href="./map.html"> <p> Create PPMP</p> </a> </li>
              <li> <a href="./map.html"> <p> View PPMP</p> </a> </li>
            </ul>
          </li>

          <li>
            <a href="./notifications.html">
              <i class="nc-icon nc-bag-16"></i>
              <p>Purchase Request</p>
            </a>
          </li>

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
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"><img src="{{ asset('/images/logo.png') }}" class="img-responsive" 
              style=" width: 40px; height: 40px;">
            Tecnological University of the Philippines</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <!-- <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <!-- <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li> -->
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="#pablo">
                  <i class="nc-icon nc-settings-gear-65"></i>
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


<!-- ALLLLL MODALSSSSS -->

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
            <form>
                  <div class="form-group">
                    <label for="Proposal Name">Budget Proposal Name</label>
                    <input type="text" class="form-control" id="Proposal Name">
                  </div>
                  
                  <div class="form-group">
                    <label for="Amount">Amount</label>
                    <input type="number" class="form-control" id="Amount">
                  </div>

                  <div>
                  <label for="Proposal File">Budget Proposal File</label>
                  <input type="file" class="dropify" data-allowed-file-extensions="pdf docx">
                 </div><br>

                 <button type="submit" class="btn btn-success btn-block">Submit</button>
                </form>
          </div>

        </div>
      </div>
    </div>



<!-- MODAL FOR BUDGET ALLOCATION -->
<div id="BA" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      
      <div class="modal-header" style="background-color: #f4f3ef;">
        <p class="modal-title text-center" style="color:#641E16; font-family:Montserrat; font-size:18px;"> Budget Allocation</p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form>
              <div class="form-group">
                <label for="Status">DEPARTMENT</label>
                <select class="form-control" id="Status">
                  <option> sample 1 </option>
                  <option> sample 2</option>
                  <option> sample 3 </option>
                </select>
              </div><br>
             
              <div class="form-group">
                <label for="Amount">AMOUNT</label>
                <input type="number" class="form-control" id="Amount">
              </div><br>

              <div class="form-group">
                <label for="Status">STATUS</label>
                <select class="form-control" id="Status">
                  <option> Active </option>
                  <option> Inactive </option>
                </select>
              </div><br>

              <button type="submit" class="btn btn-success btn-block">Save</button>
            </form>
            
         </div>



    </div>
  </div>
</div>



  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>

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

</body>

</html>