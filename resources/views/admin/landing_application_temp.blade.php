@extends('layouts.master_dashboard')

@section('title')
Dashboard
@endsection

@section("azia-css")

<!-- vendor css -->
<link href="{{ url('azia-admin/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="{{ url('azia-admin/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ url('azia-admin/lib/typicons.font/typicons.css') }}" rel="stylesheet">
<link href="{{ url('azia-admin/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">

<!-- azia CSS -->
<link rel="stylesheet" href="{{ url('azia-admin/css/azia.css') }}">

@endsection

@section('content')

@if(Session::has('success_message'))
    <div class="alert alert-success">
        <span class="fas fa-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>
              {{ $error }}
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </li>
        @endforeach
    </ul>
@endif

<div class="row">

  <div class="col-md-12">

    <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">

          <div class="az-dashboard-nav"> 
            <nav class="nav">
              <a class="nav-link active" data-toggle="tab" href="#">Overview</a>
              <a class="nav-link" data-toggle="tab" href="#">Audiences</a>
              <a class="nav-link" data-toggle="tab" href="#">Demographics</a>
              <a class="nav-link" data-toggle="tab" href="#">More</a>
            </nav>

            <nav class="nav">
              <a class="nav-link" href="#"><i class="far fa-save"></i> Save Report</a>
              <a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Export to PDF</a>
              <a class="nav-link" href="#"><i class="far fa-envelope"></i>Send to Email</a>
              <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
            </nav>
          </div>

          <div class="row row-sm mg-b-20">
            <div class="col-lg-7 ht-lg-100p">
              <div class="card card-dashboard-one">
                <div class="card-header">
                  <div>
                    <h6 class="card-title">Business Transaction Metrics</h6>
                    <p class="card-text">Transactions while on the current date range.</p>
                  </div>
                  <div class="btn-group">
                    <button class="btn active">Day</button>
                    <button class="btn">Week</button>
                    <button class="btn">Month</button>
                  </div>
                </div><!-- card-header -->
                <div class="card-body">
                  <div class="card-body-top">
                    <div>
                      <label class="mg-b-0">Purchases</label>
                      <h2>13,956</h2>
                    </div>
                    <div>
                      <label class="mg-b-0">Purchase Rate</label>
                      <h2>33.50%</h2>
                    </div>
                    <div>
                      <label class="mg-b-0">Sales</label>
                      <h2>83,123</h2>
                    </div>
                    <div>
                      <label class="mg-b-0">Expenses</label>
                      <h2>16,869</h2>
                    </div>
                  </div><!-- card-body-top -->
                  <div class="flot-chart-wrapper">
                    <div id="flotChart" class="flot-chart"></div>
                  </div><!-- flot-chart-wrapper -->
                </div><!-- card-body -->
              </div><!-- card -->
            </div><!-- col -->
            <div class="col-lg-5 mg-t-20 mg-lg-t-0">
              <div class="row row-sm">
                <div class="col-sm-6">
                  <div class="card card-dashboard-two">
                    <div class="card-header">
                      <h6>33.50% <i class="icon ion-md-trending-up tx-success"></i> <small>18.02%</small></h6>
                      <p>Purchase Rate</p>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="chart-wrapper">
                        <div id="flotChart1" class="flot-chart"></div>
                      </div><!-- chart-wrapper -->
                    </div><!-- card-body -->
                  </div><!-- card -->
                </div><!-- col -->
                <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                  <div class="card card-dashboard-two">
                    <div class="card-header">
                      <h6>86k <i class="icon ion-md-trending-down tx-danger"></i> <small>0.86%</small></h6>
                      <p>Total Purchases</p>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="chart-wrapper">
                        <div id="flotChart2" class="flot-chart"></div>
                      </div><!-- chart-wrapper -->
                    </div><!-- card-body -->
                  </div><!-- card -->
                </div><!-- col -->
                <div class="col-sm-12 mg-t-20">
                  <div class="card card-dashboard-three">
                    <div class="card-header">
                      <p>All Expenses</p>
                      <h6>16,869 <small class="tx-success"><i class="icon ion-md-arrow-up"></i> 2.87%</small></h6>
                      <small>The total number of expenses within the date range.</small>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="chart"><canvas id="chartBar5"></canvas></div>
                    </div>
                  </div>
                </div>
              </div><!-- row -->
            </div><!--col -->
          </div><!-- row -->

          <div class="row row-sm mg-b-20">
            
            <div class="col-lg-12 mg-t-20 mg-lg-t-0">
              <div class="card card-dashboard-four">
                <div class="card-header">
                  <h6 class="card-title">Expenses by Item</h6>
                </div><!-- card-header -->
                <div class="card-body row">
                  <div class="col-md-6 d-flex align-items-center">
                    <div class="chart"><canvas id="chartDonut"></canvas></div>
                  </div><!-- col -->
                  <div class="col-md-6 col-lg-5 mg-lg-l-auto mg-t-20 mg-md-t-0">
                    <div class="az-traffic-detail-item">
                      <div>
                        <span>Salaries</span>
                        <span>1,320 <span>(25%)</span></span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-purple wd-25p" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div><!-- progress -->
                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span>Transport</span>
                        <span>987 <span>(20%)</span></span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-primary wd-20p" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                      </div><!-- progress -->
                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span>Allowance</span>
                        <span>2,010 <span>(30%)</span></span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-info wd-30p" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                      </div><!-- progress -->
                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span>Transaction Fees</span>
                        <span>654 <span>(15%)</span></span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-teal wd-15p" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                      </div><!-- progress -->
                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span>Other</span>
                        <span>400 <span>(10%)</span></span>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gray-500 wd-10p" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                      </div><!-- progress -->
                    </div>
                  </div><!-- col -->
                </div><!-- card-body -->
              </div><!-- card-dashboard-four -->
            </div><!-- col -->
          </div><!-- row -->

        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->

  </div>

</div>
<!-- /.row -->
@endsection

@section("js")
<script src="{{ url('azia-admin/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ url('azia-admin/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('azia-admin/lib/ionicons/ionicons.js') }}"></script>
<script src="{{ url('azia-admin/lib/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ url('azia-admin/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ url('azia-admin/lib/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ url('azia-admin/lib/peity/jquery.peity.min.js') }}"></script>

<script src="{{ url('azia-admin/js/azia.js') }}"></script>
<script src="{{ url('azia-admin/js/chart.flot.sampledata.js') }}"></script>
<script src="{{ url('azia-admin/js/dashboard.sampledata.js') }}"></script>
<script src="{{ url('azia-admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script>
    $(function(){
    'use strict'

        var plot = $.plot('#flotChart', [{
        data: flotSampleData3,
        color: '#007bff',
        lines: {
        fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
        }
    },{
        data: flotSampleData4,
        color: '#560bd0',
        lines: {
        fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
        }
    }], {
            series: {
                shadowSize: 0,
        lines: {
            show: true,
            lineWidth: 2,
            fill: true
        }
            },
        grid: {
        borderWidth: 0,
        labelMargin: 8
        },
            yaxis: {
        show: true,
                min: 0,
                max: 100,
        ticks: [[0,''],[20,'20K'],[40,'40K'],[60,'60K'],[80,'80K']],
        tickColor: '#eee'
            },
            xaxis: {
        show: true,
        color: '#fff',
        ticks: [[25,'OCT 21'],[75,'OCT 22'],[100,'OCT 23'],[125,'OCT 24']],
        }
    });

    $.plot('#flotChart1', [{
        data: dashData2,
        color: '#00cccc'
    }], {
            series: {
                shadowSize: 0,
        lines: {
            show: true,
            lineWidth: 2,
            fill: true,
            fillColor: { colors: [ { opacity: 0.2 }, { opacity: 0.2 } ] }
        }
            },
        grid: {
        borderWidth: 0,
        labelMargin: 0
        },
            yaxis: {
        show: false,
        min: 0,
        max: 35
        },
            xaxis: {
        show: false,
        max: 50
        }
        });

    $.plot('#flotChart2', [{
        data: dashData2,
        color: '#007bff'
    }], {
            series: {
                shadowSize: 0,
        bars: {
            show: true,
            lineWidth: 0,
            fill: 1,
            barWidth: .5
        }
            },
        grid: {
        borderWidth: 0,
        labelMargin: 0
        },
            yaxis: {
        show: false,
        min: 0,
        max: 35
        },
            xaxis: {
        show: false,
        max: 20
        }
        });


    //-------------------------------------------------------------//


    // Line chart
    $('.peity-line').peity('line');

    // Bar charts
    $('.peity-bar').peity('bar');

    // Bar charts
    $('.peity-donut').peity('donut');

    var ctx5 = document.getElementById('chartBar5').getContext('2d');
    new Chart(ctx5, {
        type: 'bar',
        data: {
        labels: [0,1,2,3,4,5,6,7],
        datasets: [{
            data: [2, 4, 10, 20, 45, 40, 35, 18],
            backgroundColor: '#560bd0'
        }, {
            data: [3, 6, 15, 35, 50, 45, 35, 25],
            backgroundColor: '#cad0e8'
        }]
        },
        options: {
        maintainAspectRatio: false,
        tooltips: {
            enabled: false
        },
        legend: {
            display: false,
            labels: {
                display: false
            }
        },
        scales: {
            yAxes: [{
            display: false,
            ticks: {
                beginAtZero:true,
                fontSize: 11,
                max: 80
            }
            }],
            xAxes: [{
            barPercentage: 0.6,
            gridLines: {
                color: 'rgba(0,0,0,0.08)'
            },
            ticks: {
                beginAtZero:true,
                fontSize: 11,
                display: false
            }
            }]
        }
        }
    });

    // Donut Chart
    var datapie = {
        labels: ['Search', 'Email', 'Referral', 'Social', 'Other'],
        datasets: [{
        data: [25,20,30,15,10],
        backgroundColor: ['#6f42c1', '#007bff','#17a2b8','#00cccc','#adb2bd']
        }]
    };

    var optionpie = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
        display: false,
        },
        animation: {
        animateScale: true,
        animateRotate: true
        }
    };

    // For a doughnut chart
    var ctxpie= document.getElementById('chartDonut');
    var myPieChart6 = new Chart(ctxpie, {
        type: 'doughnut',
        data: datapie,
        options: optionpie
    });

    });
</script>
@endsection
