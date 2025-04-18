<?php $__env->startSection('title', ' - Dashboard'); ?>

<?php $__env->startSection('content'); ?>
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

.brder{box-shadow: 6px 11px 41px -28px #796eb1;-webkit-box-shadow: 6px 11px 41px -28px #796eb1;border-radius:10px;background:#fff;padding:5px;}
.hghtchart,#container{height:300px}
.card{box-shadow:0 0 10px #bebebe}

</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 float-left"><h2><?php echo e(__('Dashboard')); ?></h2></div>
                        </div><br />
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


                        <!-- end col-->
                         <div class="col-md-6 col-xl-4 d-none">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Projects</h6> -->
                                <div class="card-body brder">
                                    <div id="container5" class="hghtchart"></div>
                                </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->



      
                         <!-- end col-->
                        <!-- end col-->
                         <div class="col-md-6 col-xl-4 d-none">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Projects</h6> -->
                                <div class="card-body brder">
                                    <div id="container1" class="hghtchart"></div>
                                </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->

                         <!-- end col-->
                         <div class="col-md-6 col-xl-4 d-none">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Use Case Verticle</h6> -->
                               <div class="card-body brder">
                                  <div id="container2" class="hghtchart"></div>
                                  <!-- end row-->
                               </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->

                         <!-- end col-->
                         <div class="col-md-6 col-xl-4 d-none">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>Deliverables Status</h6> -->
                               <div class="card-body brder">
                                 <div id="container3" class="hghtchart"></div>
                               </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->

                         <!-- end col-->
                         <div class="col-md-6 col-xl-4 d-none">
                            <div class="widget-rounded-circle card">
                               <!-- <h6>User Status</h6> -->
                                <div class="card-body brder">
                                    <div id="container4" class="hghtchart"></div>
                                </div>
                            </div>
                            <!-- end widget-rounded-circle-->
                         </div>
                         <!-- end col-->


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
<script>

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
            name: 'Lab Status',
            colorByPoint: true,
            data: <?php echo json_encode($response['lab_status_arr']); ?>
        }
    ]
});


//


Highcharts.chart('container1', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Projects',
        align: 'left'
    },
    xAxis: {
        categories: ['Students', 'Professors', 'Startup', 'MSME'],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Data'
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Completed',
            data: [133, 143, 153, 163]
        },
        {
            name: 'Active',
            data: [15, 16, 17, 18]
        },
        {
            name: 'Pending',
            data: [21, 22, 23, 24]
        }
    ]
});

Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Use Case Verticle',
        align: 'left'
    },
    xAxis: {
        categories: ['Agriculture', 'Health', 'Education', 'Utility', 'Mining', 'Power', 'Mission Critical'],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Data'
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Completed',
            data: [133, 143, 153, 163, 173, 183, 193]
        },
        {
            name: 'Active',
            data: [15, 16, 17, 18, 19, 20, 21]
        },
        {
            name: 'Pending',
            data: [21, 22, 23, 24, 25, 26, 27]
        }
    ]
});


Highcharts.chart('container3', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Deliverables Status'
    },
    xAxis: {
        categories: ['Students', 'Professors', 'Startup/MSME', 'Case Studies']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Goals'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [{
        name: 'Benchmark',
        data: [50, 40, 55, 70]
    }, {
        name: 'Status',
        data: [25, 18, 25, 25]
    }]
});



Highcharts.chart('container4', {
    chart: {
        type: 'bar',
       // backgroundColor: null
    },
    title: {
        align: 'left',
        text: 'User Status'
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
            name: 'User Status',
            colorByPoint: true,
            data: [
                {
                    name: 'Active',
                    y: 63,
                    drilldown: 'Active'
                },
                {
                    name: 'Non-Active',
                    y: 21,
                    drilldown: 'Non-Active'
                },
                {
                    name: 'Deactivate',
                    y: 15,
                    drilldown: 'Deactivate'
                },
                {
                    name: 'Total',
                    y: 10,
                    drilldown: 'Total'
                }
            ]
        }
    ]
});


Highcharts.chart('container5', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Payment Status'
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
            name: 'Payment Status',
            colorByPoint: true,
            data: [
                {
                    name: 'Paid',
                    y: 15000.00
                },
                {
                    name: 'Unpaid',
                    y: 10000.00
                }
            ]
        }
    ]
});


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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/dashboard/institute.blade.php ENDPATH**/ ?>