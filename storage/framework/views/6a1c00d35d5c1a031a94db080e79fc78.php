<?php $__env->startSection('title', ' - Assign Vendor Institutes'); ?>
<?php $__env->startSection('content'); ?>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.assign_vendor_institutes')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-assign-inst-vendor-form" action="<?php echo e(route('vendor_institutes.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>
                                    

                                        <div class="mb-3">
                                            <label for="zone" class="form-label"><?php echo e(__('labels.zone')); ?> <span class="req">*</span></label>
                                            <select name="zone" class="form-control">
                                                <option value="">-- Select --</option>
                                                <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(old('zone') == $zone->id ? "selected" : ""); ?> value="<?php echo e($zone->id); ?>"><?php echo e(ucfirst(strtolower($zone->zone))); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('zone')): ?>
                                                <p class="req"><?php echo e($errors->first('zone')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="vendor" class="form-label"><?php echo e(__('labels.vendor')); ?> <span class="req">*</span></label>
                                            <select name="vendor" class="form-control">
                                                <option value="">-- Select --</option>
                                                <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(old('vendor') == $vendor->id ? "selected" : ""); ?> value="<?php echo e($vendor->id); ?>"><?php echo e(ucfirst(strtolower($vendor->name))); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('vendor')): ?>
                                                <p class="req"><?php echo e($errors->first('vendor')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="institute" class="form-label"><?php echo e(__('labels.institute')); ?> <span class="req">*</span></label>
                                            <select id="inst" name="institute_id[]" class="form-control select2" multiple>
                                                <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(in_array($institute->id, $assigned_institutes) ? "disabled" : ""); ?> value="<?php echo e($institute->id); ?>"><?php echo e(ucwords($institute->institute)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('institute_id')): ?>
                                                <p class="req"><?php echo e($errors->first('institute_id')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

                                        <button type="button" class="btn btn-primary waves-effect waves-light"><svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>Cancel</button>


                                    </form>

                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap.min.js?v=1.0')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap-multiselect.min.js?v=1.0')); ?>"></script>
<script>
    $(document).ready(function() {
        $('#inst').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/vendor_institutes/create.blade.php ENDPATH**/ ?>