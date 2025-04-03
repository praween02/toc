<?php $__env->startSection('title', ' - Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<style>
.card-body label{color:#fff}
.spacer{line-height:28px}
h6{color:#fff;padding-left:10px;font-size:14px;letter-spacing:1px}
.card-body{padding-top:5px !important}
.card-body label{color:#f7f7f7}
.brder{border-radius:10px;background:#fff;padding:5px;box-shadow: 6px 11px 41px -28px #796eb1;-webkit-box-shadow: 6px 11px 41px -28px #796eb1;}
.hghtchart,#container{height:300px}
.card{box-shadow:0 0 10px #bebebe}
</style>
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" type="text/css" rel="stylesheet" />
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 float-left"><h3><?php echo e(__('Dashboard')); ?></h3><br /></div>
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
                         <!-- end col-->
                         <!-- <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card"> -->
                               <!-- <h6>Project Timeline</h6> -->
                               <!-- <div class="card-body brder">
                                  <div id="container2" class="hghtchart"></div>
                               </div>
                            </div> -->
                            <!-- end widget-rounded-circle-->
                         <!-- </div> -->
                         <!-- end col-->
                        <!-- end col-->
                         <div class="col-md-6 col-xl-4">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Tickets</h6> -->
                                <div class="card-body brder">
                                  <div id="container3" class="hghtchart"></div>
                                </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->

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
                                            <?php $__empty_1 = true; $__currentLoopData = $response['stats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                              <td><?php echo e($loop->iteration); ?></th>
                                              <td><?php echo e($stat_info->institute); ?></td>
                                              <td><?php echo e($stat_info->delivered); ?></td>
                                              <td><?php echo e($stat_info->installed); ?></td>
                                              <td><?php echo e($stat_info->commissioned); ?></td>
                                              <td><?php echo e($stat_info->equipment_delivered_on_time); ?></td>
                                              <td><?php echo e($stat_info->equipment_installed_on_time); ?></td>
                                              <td><?php echo e($stat_info->equipment_commision_on_time); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
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
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
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
    // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

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
        enabled: false
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
    },

    series: [
        {
            name: 'Lab Status',
            colorByPoint: true,
            data: <?php echo json_encode($response['lab_status_arr']); ?>
        }
    ]
});


Highcharts.chart('container2', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Project Timeline'
    },
    tooltip: {
        valueSuffix: '%'
    },

     plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1.2em',
                    textOutline: 'none',
                    opacity: 0.7
                },
                filter: {
                    operator: '>',
                    property: 'percentage',
                    value: 10
                }
            }]
        }
    },
    
    series: [
        {
            name: 'Project Timeline',
            colorByPoint: true,
            data: [
                {
                    name: 'Ontime',
                    y: <?php echo $response['pr_on_time_stats'] ?>
                },
                {
                    name: 'Delayed',
                    y: <?php echo $response['pr_delayed_time_stats']  ?>
                }
            ]
        }
    ]
});



// Create the chart
Highcharts.chart('container3', {
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
                    y: <?php echo $response['ticket_data']->received ?>,
                    drilldown: 'Received'
                },

                {
                    name: 'Open',
                    y: <?php echo (int) $response['ticket_data']->open ?>,
                    drilldown: 'Resolved'
                },


                {
                    name: 'Resolved',
                    y: <?php echo (int) $response['ticket_data']->closed ?>,
                    drilldown: 'Resolved'
                },
                {
                    name: 'In Process',
                    y: <?php echo (int) $response['ticket_data']->in_progress ?>,
                    drilldown: 'In Process'
                }
            ]
        }
    ]
});


</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/dashboard/vendor.blade.php ENDPATH**/ ?>