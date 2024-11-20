@extends('layouts.app')
@section('title', ' - Telecom Project')
@section('content')
<style type="text/css">
table tr td:second-child{width:75%} 
.badge{font-size:13px;font-weight:bold}
h4{color:#fff;font-size:15px !important}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
            <div class="container">
                <div class="card">               
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 float-left"><h3>{{ __('Telecom Project Dashboard') }}</h3></div><hr />
                        </div><br />

                        <div class="row">
                            @foreach($resp as $k => $data)

                                 <div class="col-md-6 col-xl-4">

                                    <div style="box-shadow:0 0 10px #bebebe" class="widget-rounded-circle card {{ ($loop->iteration == 1 ? 'bg-danger' : ($loop->iteration == 2 ? 'bg-primary' : 'bg-success')) }} shadow-none">
                                       <div class="card-body" style="box-shadow:0 0 10px #bebebe">
                                          <div class="row">
                                             <div class="col-4" style="border-right:1px solid #ddd;padding-top:60px">
                                                <h4 class="text-center" style="font-size:23px !important">{{ $k }}</h4>
                                             </div>
                                             <div class="col-8">
                                                <div class="text-end">
                                                    <p style="font-size:15px;font-weight:bold;" class="text-white mb-0 text-truncate">Total Projects <span style="background: #505050;letter-spacing:0.5px" class="badge badge-success">{{ $data['total'] }}</span></p>
                                                    @foreach($stats_arr[$k] as $key => $sdata)
                                                      <h6 style="color:#fff;font-size:13px">{{ $key }}: <span style="background:#030203;letter-spacing:0.5px" class="badge badge-success">{{ $sdata }}</span></h6>
                                                    @endforeach
                                                    <h5 style="font-size:15px;font-weight:bold;" class="text-white mt-2">Cost <span style="background: #857878;letter-spacing:0.5px" class="badge badge-success">₹ {{ $data['cost'] }}</span></h5>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- end row-->
                                       </div>
                                    </div>
                                    <!-- end widget-rounded-circle-->
                                 </div>
                            @endforeach
                        </div>


                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card" style="box-shadow:0 0 10px #bebebe">
                                   <!-- <h6>Deliverables Status</h6> -->
                                   <div class="card-body brder">
                                     <div id="container1" class="hghtchart" style="height: 320px;"></div>
                                   </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="widget-rounded-circle card" style="box-shadow:0 0 10px #bebebe">
                                   <!-- <h6>Deliverables Status</h6> -->
                                   <div class="card-body brder">
                                     <div id="container2" class="hghtchart" style="height: 320px;"></div>
                                   </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <!-- End Content-->
    </div>
</div>
@endsection


@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>

// Create the chart
Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Total Projects'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    legend: {
        enabled: false
    },

    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
            }
        }
    },

    series: [
        {
            name: '',
            colorByPoint: true,
            data: @php echo json_encode($total_projects_arr) @endphp
        }
    ],
    
});


Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Total Cost'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    legend: {
        enabled: false
    },
     plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
            }
        }
    },

    series: [
        {
            name: '',
            colorByPoint: true,
            data: @php echo json_encode($total_costs_arr) @endphp
        }
    ],
    
});

</script>
@endpush