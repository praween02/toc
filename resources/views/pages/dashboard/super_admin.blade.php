@extends('layouts.app')
@section('title', ' - Dashboard')

@section('content')
<style>
.card-body label{color:#fff}
.spacer{line-height:28px}
h6{color:#fff;padding-left:10px;font-size:14px;letter-spacing:1px}
.card-body{padding-top:5px !important}
.card-body label{color:#f7f7f7}
.card-body{padding-top:5px !important}
.card-body label{color:#f7f7f7}
.table>:not(caption)>*>*{padding:3px;color:#fff}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

.brder{border-radius:10px;background:#fff;padding:5px;}
.hghtchart,#container{height:300px}
.card{box-shadow:0 0 10px #bebebe}

.table thead.thead-dark tr th{color:#999 !important;font-weight:bold}
.table tr td, .table tr th {font-weight:400;color:#999 !important}
.table tr {line-height:40px}
.inst{width:125px;line-height:20px}
table.project_timeline_tbl tr th,table.project_timeline_tbl tr td{text-align:center;line-height:24px}
.pdtp15{padding-top:15px !important}
.widget-rounded-circle h5{color:#fff}
.ltrsp{letter-spacing:0.5px}
.text-end a {color:#fff}
#equ_tbl thead tr th {color:#fff !important}
</style>
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" type="text/css" rel="stylesheet" />
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 float-left"><h2>{{ __('Dashboard') }}</h2></div>
                        </div><br />

                        <div class="row">

                            <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card bg-info shadow-none" style="height:160px">
                                   <div class="card-body pdtp15">
                                      <div class="row">
                                        <h5>6G Applications</h5>
                                         <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-light">
                                               <i class="ti-files font-28 avatar-title text-white"></i>
                                            </div>
                                         </div>
                                         <div class="col-6">
                                            <div class="text-end">
                                               <a href="{{ route('six_g_user.index') }}" target="_blank"><h2 class="text-white mt-2"><span data-plugin="counterup">{{ $response['six_g_total'] }}</span></h2></a>
                                               <p class="text-white mb-0 text-truncate ltrsp"><a title="All" href="{{ route('six_g_user.index') }}?tab=all">All - {{ $response['total_6g_application'] }}</a></p>
                                               <p class="text-white mb-0 text-truncate ltrsp"><a title="Submitted" href="{{ route('six_g_user.index') }}?tab=submitted">Submitted - {{ $response['submit_6g_application'] }}</a></p>
                                               <p class="text-white mb-0 text-truncate ltrsp"><a title="Pending" href="{{ route('six_g_user.index') }}?tab=pending">Pending - {{ $response['total_6g_application'] - $response['submit_6g_application'] }}</a></p>
                                            </div>
                                         </div>
                                      </div>

                                      <!-- end row-->
                                   </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                             </div>


                            <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card bg-primary shadow-none" style="height:160px">
                                   <div class="card-body pdtp15">
                                      <div class="row">
                                         <h5>Experts</h5>
                                         <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-light">
                                               <i class="fe-users font-28 avatar-title text-white"></i>
                                            </div>
                                         </div>
                                         <div class="col-6">
                                            <div class="text-end">
                                               <a href="{{ route('expert_user.index') }}" target="_blank"><h2 class="text-white mt-2"><span data-plugin="counterup">{{ $response['expert_total'] }}</span></h2></a>
                                            </div>
                                         </div>
                                      </div>
                                      <!-- end row-->
                                   </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                            </div>


                            <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card bg-success shadow-none" style="height:160px">
                                   <div class="card-body pdtp15">
                                    <h5>POC BSNL</h5>
                                      <div class="row">
                                         <div class="col-6">
                                            <div class="avatar-lg rounded-circle bg-soft-light">
                                               <i class="fe-list font-28 avatar-title text-white"></i>
                                            </div>
                                         </div>
                                         <div class="col-6">
                                            <div class="text-end">
                                               <a href="{{ route('poc_bsnl.index') }}" target="_blank"><h2 class="text-white mt-2"><span data-plugin="counterup">{{ $response['poc_bsnl_total'] }}</span></h2></a>
                                            </div>
                                         </div>
                                      </div>
                                      <!-- end row-->
                                   </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                            </div>


                        </div>



                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <div class="widget-rounded-circle card">
                                   <!-- <h6>Lab Status</h6> -->
                                    <div class="card-body brder">
                                         <div id="container12" class="hghtchart"></div>
                                    </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                            </div>
                      </div>




                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card">
                                   <!-- <h6>Lab Status</h6> -->
                                    <div class="card-body brder">
                                         <div id="container" class="hghtchart"></div>
                                    </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                            </div>

                            <!-- <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card"> -->
                                    <!-- <h6>Project Timeline</h6> -->
                                    <!-- <div class="card-body brder">
                                        <div id="container6" class="hghtchart"></div>
                                    </div>
                                </div> -->
                                <!-- end widget-rounded-circle-->
                             <!-- </div> -->
                                
                            <div class="col-md-6 col-xl-4">
                                <div class="widget-rounded-circle card">
                                   <!-- <h6>Tickets</h6> -->
                                    <div class="card-body brder">
                                        <div id="container7" class="hghtchart"></div>
                                    </div>
                                </div>
                                <!-- end widget-rounded-circle-->
                            </div>

                      </div>



                        <!-- <div class="row">
                            <h3>Institutes's Equipments Report</h3><br />
                             <div class="col-md-12 col-xl-12">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body brder">

                                        <table class="table table-bordered project_timeline_tbl" id="equ_tbl">
                                          <thead>
                                            <tr>
                                              <th scope="col">#</th>
                                              <th scope="col"><strong>Institutes</strong></th>
                                              <th scope="col"><strong>Delivered</strong></th>
                                              <th scope="col"><strong>Installed</strong></th>
                                              <th scope="col"><strong>Commissioned</strong></th>
                                              <th scope="col"><strong>On Time Delivered</strong></th>
                                              <th scope="col"><strong>On Time Installed</strong></th>
                                              <th scope="col"><strong>On Time Commissioned</strong></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @forelse($response['stats'] as $stat_info)
                                            <tr>
                                              <td>{{ $loop->iteration }}</th>
                                              <td>{{ $stat_info->institute }}</td>
                                              <td>{{ $stat_info->delivered }}</td>
                                              <td>{{ $stat_info->installed }}</td>
                                              <td>{{ $stat_info->commissioned }}</td>
                                              <td>{{ $stat_info->equipment_delivered_on_time }}</td>
                                              <td>{{ $stat_info->equipment_installed_on_time }}</td>
                                              <td>{{ $stat_info->equipment_commision_on_time }}</td>
                                            </tr>
                                            @empty
                                            @endforelse
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                             </div>
                        </div> -->


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
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<script>

$(document).ready(function() {
    new DataTable('#equ_tbl', {
    layout: {
        topStart: {
            buttons: ['csv', 'excel']
        }
    }
}); });

Highcharts.setOptions({
    chart: {
        style: {
            fontFamily: 'Poppins,sans-serif',
            fontSize: '14px'
        }
    }
   });


// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'bar',
       // backgroundColor: null
    },
    title: {
        align: 'left',
        text: 'Lab Status'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Data'
        }

    },
    legend: {
        enabled: false,
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
    },

    series: [
        {
            name: "Equipment's Status",
            colorByPoint: true,
            data: [
                {
                    name: 'Delivered',
                    y: @php echo $response['eq_stats']->delivered @endphp,
                    drilldown: 'Delivered'
                },
                {
                    name: 'Installed',
                    y: @php echo $response['eq_stats']->delivered @endphp,
                    drilldown: 'Installed'
                },
                {
                    name: 'UAT Completed',
                    y: @php echo $response['eq_stats']->delivered @endphp,
                    drilldown: 'Commissioned'
                }
            ]

        }
    ]
});


//


// Highcharts.chart('container6', {
//     chart: {
//         type: 'pie'
//     },
//     title: {
//         text: 'Project Timeline'
//     },

//     plotOptions: {
//         series: {
//             allowPointSelect: true,
//             cursor: 'pointer',
//             dataLabels: [{
//                 enabled: true,
//                 distance: 20
//             }, {
//                 enabled: true,
//                 distance: -40,
//                 format: '{point.percentage:.1f}%',
//                 style: {
//                     fontSize: '1.2em',
//                     textOutline: 'none',
//                     opacity: 0.7
//                 },
//                 filter: {
//                     operator: '>',
//                     property: 'percentage',
//                     value: 10
//                 }
//             }]
//         }
//     },
    
//     series: [
//         {
//             name: 'Project Timeline',
//             colorByPoint: true,
//             data: [
//                 {
//                     name: 'Ontime',
//                     y: @php echo $response['pr_on_time_stats'] @endphp
//                 },
//                 {
//                     name: 'Delayed',
//                     y: @php echo $response['pr_delayed_time_stats']  @endphp
//                 }
//             ]
//         }
//     ]
// });




// Create the chart
Highcharts.chart('container7', {
    chart: {
        type: 'column',
       // backgroundColor: null
    },
    title: {
        align: 'left',
        text: 'Tickets'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Data'
        }
    },
    legend: {
        enabled: false
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
    },

    series: [
        {
            name: 'Tickets',
            colorByPoint: true,
            data: [
                {
                    name: 'Received',
                    y: @php echo (int) $response['ticket_data']->received @endphp,
                    drilldown: 'Received'
                },

                {
                    name: 'Open',
                    y: @php echo (int) $response['ticket_data']->open @endphp,
                    drilldown: 'Resolved'
                },


                {
                    name: 'Resolved',
                    y: @php echo (int) $response['ticket_data']->closed @endphp,
                    drilldown: 'Resolved'
                },
                {
                    name: 'In Process',
                    y: @php echo (int) $response['ticket_data']->in_progress @endphp,
                    drilldown: 'In Process'
                }
            ]
        }
    ]
});


// Create the chart
Highcharts.chart('container12', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Zone Wise Report'
    },
    xAxis: {
        categories: [@php echo "'" . implode("','", $response['categories_arr']) . "'"  @endphp]
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        column: {
            borderRadius: '25%'
        }
    },
    series: [{
        name: 'Delivered',
        // data: [@php echo implode(',', $response['equipment_delivery_date_arr']) @endphp]
        data: [25,25,25,25,25]
    }, {
        name: 'Installed',
        // data: [@php echo implode(',', $response['equipment_installed_arr']) @endphp]
        data: [25,25,25,25,25]
    }, {
        name: 'UAT Completed',
        // data: [@php echo implode(',', $response['equipment_commissioned_arr']) @endphp]
        data: [25,25,25,25,25]
    }]
});
</script>
@endpush