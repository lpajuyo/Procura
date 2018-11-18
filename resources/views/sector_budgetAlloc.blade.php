@extends('sector_main') 

@section('title', 'Budget Allocation')

<!-- @section('brand')
  
  Dashboard

@endsection -->

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
                      <p class="card-category">Total Budget</p>
                      <p class="card-title">$ 100,000
                        <p>
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
                      <p class="card-category">Total Budget Allocated</p>
                      <p class="card-title">$ 2,000
                        <p>
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
                      <p class="card-category">Remaining Budget</p>
                      <p class="card-title">$ 2,000
                        <p>
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

      
<div class="row" style="padding-left: 35px; padding-right: 20px;">

  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-body" style="margin-top: 5px;">
        <div>
        <p style="position: absolute; font-size: 25px;"> Budget Allocated to Departments </p>
        <button class="btn btn-default btn-sm" style="right: 30px; position: absolute !important;" data-toggle="modal"
        data-target="#BA">
          <i class="fa fa-plus"></i> &nbsp;New Budget Allocation
        </button>
        </div><br><br><br>
        <div class="table-responsive" style="overflow: visible;"> 
          <table class="table table-striped">
            <thead>
              <tr class=" text-primary">
                      <th>Departments</th>
                      <th>Budget Allocated</th>
                      <th>Remaining Budget</th>
                      <th class="text-center">Budget Status</th>
                  </tr>
              </thead>

              <tbody>
                  <tr>
                    <td>College of Science</td>
                    <td>15000000</td>
                      <td >9000000</td>
                      <td class="text-center" >Active</td>
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