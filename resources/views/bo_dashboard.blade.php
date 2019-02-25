@extends('bo_main') 
@section('title', 'Dashboard') 
@section('dashboard-active', 'active') 
@section('brand') Dashboard
@endsection


@section('content')
<div class="card cardmod" style="margin: 0px 0px 0px 10px;">
  <div class="card-body">

    <div class="row" style="padding: 5px;">

      <div class="col-lg-9">
        <div class="welcome"> Welcome to Procura! </div>
        <span class="tagline"> Better Procurement System. Better Workplace.</span>
      </div>

      <div class="col-lg-3">
        <div id="fulldate" style="font-size: 15px;"></div>
        <span id="hour" class="clockbg"></span>
        <span style="font-size: 30px;">:</span>
        <span id="minute" class="clockbg2"></span>
        <span style="font-size: 30px;">:</span>
        <span id="second" class="clockbg3"></span> &nbsp;
        <span id="sufx" style="font-size: 23px;" class="text-info"> </span>
      </div>

    </div>

  </div>
</div>

<div class="row" style="margin: 20px 0px 0px 10px;">
  <div class="col-lg-4 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-body ">
        <div class="row">
          <div class="col-5 col-md-4">
            <div class="icon-big text-center icon-warning">
              <i class="lnr lnr-calendar-full text-warning"></i>
            </div>
          </div>
          <div class="col-7 col-md-8">
            <div class="numbers">
              <p class="card-category">Budget Year</p>
              <p class="card-title">{{ $budgetYear->budget_year ?? '--' }}
                <p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <i class="fa fa-refresh"></i>Active Budget Year
        </div>
      </div>
    </div>
  </div>

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
              <p class="card-title">
                &#8369;{{ (isset($budgetYear)) ? number_format($budgetYear->total(), 2) : '--' }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <i class="fa fa-calendar-o"></i> Active Year's Total Budget
        </div>
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
              <p class="card-category">Budget Left</p>
              <p class="card-title">
                &#8369;{{ (isset($budgetYear)) ? number_format($budgetYear->remaining(), 2) : '--' }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer ">
        <hr>
        <div class="stats">
          <i class="fa fa-clock-o"></i> Active Year's Remaining Budget
        </div>
      </div>
    </div>
  </div>
</div>
<!--  danger: #ef8157
        warning: #fbc658
        success: #6bd098 
        info: #51bcda
        primary: #51cbce  -->

{{--
<!------------  FIRST ROW --------------->

<div class="row" style="margin: 5px 0px 0px 10px;">
  <div class="col-lg-4">

    <div class="row">
      <div class=" smallbox card">
        <div class="text-info number"> 24 </div>
        <div class="numtitle">Documents Made</div>
      </div>
      <div class=" smallbox card" style="margin-left: 10px;">
        <div class="text-success number"> 7 </div>
        <div class="numtitle">Budget Proposal</div>
      </div>
    </div>

    <div class="row">
      <div class="smallbox card">
        <div class="text-warning number"> 6 </div>
        <div class="numtitle">PPMP</div>
      </div>
      <div class="smallbox card" style="margin-left: 10px;">
        <div class="text-danger number"> 11 </div>
        <div class="numtitle">Purchase Request</div>
      </div>
    </div>

  </div>

  <div class="col-lg-8 card" style="margin-left: 0px; padding: 25px 10px 5px 5px;">
    <div style="margin: 0px 0px 10px 15px; font-size: 17px;"> Purchases Made </div>
    <div class="ct-chart-line"></div>
  </div>

</div> --}}


<!------------  SECOND ROW --------------->

<div class="row" style="margin: 5px 0px 0px 10px;">
  <div class="col-lg-12 bargraph card">
    <div style="margin: 2px 6px 15px 6px; font-size: 17px;"> Annual Budget Allocation</div>
    <div class="ct-chart-bar"></div>
  </div>
</div>

<!------------  THIRD ROW --------------->

<div class="row">
  {{-- <div class="col-lg-7" style="margin: 0px 0px 0px 0px; padding-left:25px !important;">
    <div class="card" style="border-radius: 5px !important;">
      <div class="card-body" style="padding-bottom: 0px !important; margin-bottom: 0px !important;">
        <div style="margin: 2px 6px 15px 6px; font-size: 17px;"> Allocated Budget per Sector </div>
        <div class="ct-chart-pie ct-square">
        </div>
      </div>

      <div class="card-footer ">
        <hr>
        <div class="legend">
          <span class="legend-name">
               <i class="fa fa-circle text-primary"></i> Goods
            </span>
          <span class="legend-name">
                 <i class="fa fa-circle text-danger"></i> Consultancy
              </span>
          <span class="legend-name">
               <i class="fa fa-circle text-warning"></i> Infrastructures
            </span>
        </div>
      </div>

    </div>
  </div> --}}

  {{-- <div class="col-lg-12"> --}}

    {{-- <div class="row"> --}}
      <div class="col-lg-3" style="padding-right: 0px; margin-right: 0px;">
        <div class="mediumbox card  text-info" style="font-size:14px;">
          <span class="far fa-file-word fa-5x ppmpicon"></span>
          <span class="ppmptitle"> Budget Proposals for Active Year </span>
        </div>
      </div>

      <div class="col-lg-3" style="padding-right: 0px; margin-right: 0px;">
        <div id="circle_approved" class="mediumbox card">
          <div class="text-success progresstext1"> Approved </div>
        </div>
      </div>
    {{-- </div> --}}

    {{-- <div class="row"> --}}
      <div class="col-lg-3" style="padding-right: 0px; margin-right: 0px;">
        <div id="circle_pending" class="mediumbox card">
          <div class="text-warning progresstext2"> Pending </div>
        </div>
      </div>

      <div class="col-lg-3" style="padding-right: 0px; margin-right: 0px;">
        <div id="circle_rejected" class="mediumbox card">
          <div class="text-danger progresstext3"> Rejected </div>
        </div>
      </div>
    {{-- </div> --}}

  {{-- </div> --}}

  {{--
  <div class="col-lg-6" style="margin: 5px 0px 0px 0px;">
    <div class="card updates" style="border-radius: 5px !important;">
      <div class="card-body" style="margin-bottom: 0px; padding-bottom: 0px;">
        <div style="margin: 2px 6px 15px 6px; font-size: 17px;"> Recent Activity </div>
        <div id="activities">
          <div class="activity activitybg1"></div>
          <div class="activity activitybg2"></div>
          <div class="activity activitybg3"></div>
          <div class="activity activitybg4"></div>
        </div>
      </div>

      <div class="card-footer ">
        <hr>
        <i class="fa fa-history"></i> Updated 3 minutes ago
      </div>
    </div>
  </div> --}}

</div>
@endsection
 
@section('scripts')


<script>
  $(document).ready(function() {
    $('.welcome').toggleClass('show');
  });

</script>

<script>
  $(document).ready(function() {
    $('.ppmpicon').toggleClass('ppmpiconshow');
  });

</script>

<!-------  TYPE EFFECT -------->
<script>
  function typeEffect(element, speed) {
var text = $(element).text();
$(element).html('');
  
  var i = 0;
  var timer = setInterval(function() {
      if (i < text.length) {
        $(element).append(text.charAt(i));
        i++;
      } else {
         clearInterval(timer);
      }
  }, speed);
}

$(document).ready(function() {
  var speed = 75;
  // var delay = $('.welcome').text().length * speed + speed;
  // typeEffect($('.welcome'), speed);
  setTimeout(function(){
    $('.tagline').css('display', 'inline-block');
    typeEffect($('.tagline'), speed);
  }, 1500);
});

</script>


<!-------  TIME WIDGET -------->
<script type="text/javascript">
  function rtdate(){
    var current = new Date(),
    hours = current.getHours(),
    minutes = current.getMinutes(),
    seconds = current.getSeconds();

    var hours = checkTime(hours),
    minutes = checkTime(minutes),
    seconds = checkTime(seconds);

    var suffix = "AM";
    if (hours >= 12) {
      suffix = "PM";
      hours = hours - 12;
      if (hours < 10){
        hours = "0" + hours;
      }
    }
    if (hours == 0) {
     hours = 12;
    }

    document.getElementById("hour").innerHTML = hours;
    document.getElementById("minute").innerHTML = minutes;
    document.getElementById("second").innerHTML = seconds;
    document.getElementById("sufx").innerHTML = suffix;

    var t = setTimeout(rtdate, 500);
  }

  function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
  }
  
  var current = new Date(),
  date = current.getDate(),
  year = current.getFullYear();

  var day = new Array(7);
  day[0] = "SUN";
  day[1] = "MON";
  day[2] = "TUE";
  day[3] = "WED";
  day[4] = "THURS";
  day[5] = "FRI";
  day[6] = "SAT";

  var month = new Array(12);
  month[0] = "January";
  month[1] = "February";
  month[2] = "March";
  month[3] = "April";
  month[4] = "May";
  month[5] = "June";
  month[6] = "July";
  month[7] = "August";
  month[8] = "September";
  month[9] = "October";
  month[10] = "November";
  month[11] = "December";

  var dayword = day[current.getDay()];
  var monthword = month[current.getMonth()];
  document.getElementById("fulldate").innerHTML = dayword + "    "+ monthword + "  " + date + "," + "  " + year;

</script>


<!-------------  CHARTIST.JS --------------->
{{--
<!-------  LINE CHART -------->
<script>
  var data = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    series: [
      [4, 15, 3, 20, 0, 12, 3, 17, 5, 1.5, 22, 4.5]
    ]
  };

  var options = {
    width: 700,
    height: 250,

    showArea: true,

    axisY: {
      showGrid: false,
      // type: Chartist.FixedScaleAxis,
      // ticks: [0, 10, 20, 30, 40, 50],
      low: 0,
      high: 25
    },

    lineSmooth: Chartist.Interpolation.simple({
    divisor: 2
    })
  };

  new Chartist.Line('.ct-chart-line', data, options);

</script> --}}

<!-------  BAR CHART -------->
<script>
  var data = {
    labels: @json($yearLabels),
      series: [
      @json($yearAmounts)
    ]
  };

  var yLabels = [
    '',
    '10m',
    '20m',
    '30m',
    '40m',
    '50m',
    '60m',
    '70m',
    '80m',
    '90m',
    '100m'
  ];

  var options = {
    fullWidth: true,
    height: 350,

    axisX: {
      showGrid: false,
    },

    axisY:{
      low: 10000000,
      high: 100000000,
      labelInterpolationFnc: function(value, index) {
        return yLabels[index];
      },
    }
  };

new Chartist.Bar('.ct-chart-bar', data, options);

</script>

<!------- PIE CHART -------->
<script>
  var data = {
  series: [10,10,10,10]
};

var sum = function(a, b) { return a + b };

new Chartist.Pie('.ct-chart-pie', data,{
  labelInterpolationFnc: function(value) {
    return Math.round(value / data.series.reduce(sum) * 100) + '%';
  }
});

</script>


<!-------  PROGRESS BAR -------->
<!-------  APPROVED -------->
<script>
  var newvalue = {{ number_format($approvedPercentage) }};
  var bar = new ProgressBar.Circle(circle_approved, {
  color: '#6bd098',
  strokeWidth: 6,
  trailWidth: 2,
  easing: 'bounce',
  duration: 1400,
  text: {
    autoStyleContainer: false
  },
  from: { color: '#6bd098', width: 6 },
  to: { color: '#6bd098', width: 6 },
  
  step: function(state, circle) {
    circle.path.setAttribute('stroke', state.color);
    circle.path.setAttribute('stroke-width', state.width);

    var value = Math.round(circle.value() * 100);
    if (value === 0) {
      circle.setText('');
    } else {
      circle.setText(value + '%');
    }

  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '1.5rem';

bar.animate(newvalue / 100);  // Number from 0.0 to 1.0

</script>


<!-------  PENDING -------->
<script>
  var newvalue = {{ number_format($pendingPercentage) }};
  var bar = new ProgressBar.Circle(circle_pending, {
  color: '#fbc658',
  strokeWidth: 6,
  trailWidth: 2,
  easing: 'bounce',
  duration: 1400,
  text: {
    autoStyleContainer: false
  },
  from: { color: '#fbc658', width: 6 },
  to: { color: '#fbc658', width: 6 },
  
  step: function(state, circle) {
    circle.path.setAttribute('stroke', state.color);
    circle.path.setAttribute('stroke-width', state.width);

    var value = Math.round(circle.value() * 100);
    if (value === 0) {
      circle.setText('');
    } else {
      circle.setText(value + '%');
    }

  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '1.5rem';

bar.animate(newvalue / 100);

</script>


<!-------  REJECTED -------->
<script>
  var newvalue = {{ number_format($rejectedPercentage) }};
  var bar = new ProgressBar.Circle(circle_rejected, {
  color: '#ef8157',  
  strokeWidth: 6,
  trailWidth: 2,
  easing: 'bounce',
  duration: 1400,
  text: {
    autoStyleContainer: false
  },
  from: { color: '#ef8157', width: 6 },
  to: { color: '#ef8157', width: 6 },
  
  step: function(state, circle) {
    circle.path.setAttribute('stroke', state.color);
    circle.path.setAttribute('stroke-width', state.width);

    var value = Math.round(circle.value() * 100);
    if (value === 0) {
      circle.setText('');
    } else {
      circle.setText(value + '%');
    }

  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '1.5rem';

bar.animate(newvalue / 100);

</script>

<!-------  END OF PROGRESS BAR -------->
@endsection