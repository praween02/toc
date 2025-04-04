<?php $__env->startSection('title', ' - Project Timeline'); ?>
<?php $__env->startSection('content'); ?> 
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css?v=1.0')); ?>" />   
<style>
 table{width:100%;border-collapse:collapse;margin-top:20px}
 td,th{border:1px solid #ddd;padding:10px;text-align:left}
 th{background-color:#f2f2f2}
 input[type=date]{width:100%;padding:8px;box-sizing:border-box}
 input[type=date]:not([value=""]){border:1px solid #ddd;border-radius:3px}.date-field{display:flex;justify-content:space-between;gap:10px}
 .srch{border:1px solid #ddd;border-radius:3px;height:30px;line-height:30px;width:80px}
 table {
  table-layout:fixed; 
  width:100%;
}
td, th {
  vertical-align:top;
  padding:5px;
  width:100px;
  font-weight:normal;
  font-size:11px;
}
.fix {
  position: absolute;
  margin-left:-100px;
  width:100px;
  height:351px !important;
}
.outer {
  position: relative;
}
.inner {
  overflow-x:scroll;
  overflow-y:visible;
  width:87%; 
  margin-left:100px;
  min-height:400px;
  height:100%;
}
.mbox{border:1px solid #ddd;padding:5px;font-size:10px;border-radius:5px;margin-bottom:3px}
.tableFixHead {
  overflow: auto;
  height: 100px;
}

.tableFixHead thead th {
  position: sticky;
  top: 0;
}
.hght {
    font-size: 10px;
    padding: 3px 7px !important;
    font-weight: normal !important;
    line-height: 10px;
    height: 18px;
    color:#999;
}
.btn-primary,.btn-danger,.btn-success{color:#fff}
div.box{border:1px dashed #bdbaba;border-radius:5px;padding:5px;font-size:10px;margin-bottom:8px}

th{background-color:#2f316f;color:#fff}
</style>
<?php $__env->stopPush(); ?>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.project_timeline')); ?></h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="row">
                                                <p style="color:#a29105;letter-spacing:0.5px">Please select zone and institute to view the project timeline!</p>
                                                <div class="form-group" style="width:20%">
                                                    <label>Select Zone</label>
                                                    <select name="zone" id="zone" class="form-control" onchange="sel_zone(this.value)">
                                                        <option value="">-- Select --</option>
                                                        <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php echo e(Request::get('zone_id') == $zone->id ? "selected" : ""); ?> value="<?php echo e($zone->id); ?>"><?php echo e($zone->zone); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="form-group" style="width:55%">
                                                    <label>Select Institute</label>
                                                    <select name="institute" id="institute" class="form-control" onchange="sel_institute(this.value)">
                                                        <option value="">-- Select --</option>
                                                        <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php echo e(Request::get('inst_id') == $institute->id ? "selected" : ""); ?> value="<?php echo e($institute->id); ?>"><?php echo e($institute->institute); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="form-group" style="width:25%">
                                                    <label>Search</label>
                                                    <input type="text" name="search" value="" autocomplete="off" class="form-control" id="srch" placeholder="Type Equipment..." />
                                                </div>


                                            </div>

                                            <div class="table table-responsive">
                                                <table id="timelines_show">
                                                    <thead>
                                                        <tr>
                                                            <th>Equipment</th>
                                                            <th>Delivery Info</th>
                                                            <th>Installation Info</th>
                                                            <th>Commission Info</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <tr>
                                                            <td class="equ"><?php echo e($equipment->equipment); ?></th>
                                                            <td>

                                                               <!-- <p>Actual Dispatch Date: <span class="badge btn-danger hght"><?php echo (! empty($response[$equipment->id]['equipment_actual_dispatch_date'])) ? (date("D, j M'y", strtotime($response[$equipment->id]['equipment_actual_dispatch_date']))) : 'N/A'; ?></span></p> -->

                                                               <?php
                                                                $cls1 = '';
                                                                if((! empty($response[$equipment->id]['equipment_delivery_date'])) &&  (! empty($response[$equipment->id]['equipment_delivered_date'])))
                                                                {
                                                                    if($response[$equipment->id]['equipment_delivery_date'] == $response[$equipment->id]['equipment_delivered_date'])
                                                                     {
                                                                            $cls1 = 'btn-success';
                                                                     }
                                                                    else
                                                                      {
                                                                            $cls1 = 'btn-danger';
                                                                      }
                                                                }                                            
                                                                ?>

                                                                <div class="box"><strong>Scheduled Delivery Date: </strong><?php echo (! empty($response[$equipment->id]['equipment_delivery_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_delivery_date'])) : 'N/A'; ?></strong></div>

                                                                <div class="box">Delivered Date: <span class="badge <?php echo e($cls1); ?> hght"><?php echo (! empty($response[$equipment->id]['equipment_delivered_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_delivered_date'])) : 'N/A'; ?></span></div>

                                                               <?php
                                                                if((! empty($response[$equipment->id]['equipment_delivery_date'])) &&  (! empty($response[$equipment->id]['equipment_delivered_date'])))
                                                                {
                                                                    $date1 = strtotime($response[$equipment->id]['equipment_delivery_date']);
                                                                    $date2 = strtotime($response[$equipment->id]['equipment_delivered_date']);

                                                                    echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></div>';
                                                                }                                            
                                                                ?>

                                                            </td>

                                                            <td>
                                                               <div class="box"><strong>Scheduled Installation date: </strong>
                                                                <?php echo (! empty($response[$equipment->id]['equipment_install_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_install_date'])) :  "N/A"; ?> 
                                                               </div>

                                                               <?php
                                                                if((! empty($response[$equipment->id]['equipment_install_date'])) &&  (! empty($response[$equipment->id]['equipment_installed_date'])))
                                                                {
                                                                    if($response[$equipment->id]['equipment_install_date'] == $response[$equipment->id]['equipment_installed_date'])
                                                                     {
                                                                        $cls1 = 'btn-success';
                                                                     }
                                                                    else
                                                                      {
                                                                        $cls1 = 'btn-danger';
                                                                      }
                                                                }                                            
                                                                ?>

                                                               <div class="box">Installed date: <span class="badge <?php echo e($cls1); ?> hght">
                                                                <?php echo (! empty($response[$equipment->id]['equipment_installed_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_installed_date'])) :  'N/A'; ?></span>
                                                               </div>

                                                               <?php
                                                                if((! empty($response[$equipment->id]['equipment_install_date'])) &&  (! empty($response[$equipment->id]['equipment_installed_date'])))
                                                                {
                                                                    $date1 = strtotime($response[$equipment->id]['equipment_install_date']);
                                                                    $date2 = strtotime($response[$equipment->id]['equipment_installed_date']);

                                                                    echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></div>';
                                                                }                                            
                                                                ?>

                                                            </td>

                                                            <td>
                                                               <div class="box"><strong>Scheduled Commission date: </strong> <?php echo (! empty($response[$equipment->id]['equipment_commision_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_commision_date']))  : 'N/A'; ?>

                                                               </div>

                                                               <?php
                                                                if((! empty($response[$equipment->id]['equipment_commision_date'])) &&  (! empty($response[$equipment->id]['equipment_commisioned_date'])))
                                                                {
                                                                    if($response[$equipment->id]['equipment_commision_date'] == $response[$equipment->id]['equipment_commisioned_date'])
                                                                     {
                                                                        $cls1 = 'btn-success';
                                                                     }
                                                                    else
                                                                      {
                                                                        $cls1 = 'btn-danger';
                                                                      }
                                                                }                                            
                                                                ?>
                                                               
                                                               <div class="box">Commissioned date: <span class="badge <?php echo e($cls1); ?> hght"><?php echo (! empty($response[$equipment->id]['equipment_commisioned_date'])) ? date("D, j M'y", strtotime($response[$equipment->id]['equipment_commisioned_date'])) :  'N/A'; ?>

                                                               </div>

                                                               <?php
                                                                if((! empty($response[$equipment->id]['equipment_commision_date'])) &&  (! empty($response[$equipment->id]['equipment_commisioned_date'])))
                                                                {
                                                                    $date1 = strtotime($response[$equipment->id]['equipment_commision_date']);
                                                                    $date2 = strtotime($response[$equipment->id]['equipment_commisioned_date']);

                                                                    echo '<div class="box">No of days delayed: <strong>' . round(($date2 - $date1) / (60 * 60 * 24)). '</strong></div>';
                                                                }                                            
                                                                ?>

                                                            </td>

                                                          </td>
                                                      </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                
                                </div> <!-- end card-body -->

                        </div> <!-- end card-->
                    </div> <!-- end col -->
                    <!-- end row -->
                    
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
 <script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js?v=1.0')); ?>"></script>
    <script>

        function sel_zone(val) {
            const {origin, pathname} = window.location;
            window.location.href = `${origin}${pathname}?zone_id=${val}`;
        }

        function sel_institute(val) {
            let zone_id = $("select#zone option:selected").val();
            if (val) {
                const {origin, pathname} = window.location;
                window.location.href = `${origin}${pathname}?zone_id=${zone_id}&inst_id=${val}`;
            } else {
                window.location.href = `${origin}${pathname}?zone_id=${zone_id}`;
            }
        }


        $("#srch").on("keyup", function() 
            {
                let searchText = $(this).val().toLowerCase();
                console.log(searchText);
                if (searchText == "") {
                    $("table#timelines_show tbody tr").show();  
                    return;  
                }
                $("table#timelines_show tbody tr").each(function(index) {
                    let equipment = $(this).find("td.equ").text();
                    console.log(equipment);
                    (equipment.toLowerCase().includes(searchText)) ? $(this).show() : $(this).hide();
                });
            });

        function inst(inst_id) {
            const { origin, pathname } = window.location;
            location.href = `${origin}${pathname}?inst_id=${inst_id}`;
        }

        $(document).ready(function() {
                $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd'});
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/project_timeline/list.blade.php ENDPATH**/ ?>