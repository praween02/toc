<?php $__env->startSection('title', ' - Institute'); ?>
<?php $__env->startSection('content'); ?>		
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.add_institute')); ?></h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-institute-data-form" action="<?php echo e(route('institutes.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>
    
                                        <div class="mb-3">
                                            <label for="institute" class="form-label"><?php echo e(__('labels.institute')); ?> <span class="req">*</span></label>
                                            <input type="text" name="institute" autocomplete="off" class="form-control" id="institute" placeholder="<?php echo e(__('placeholder.institute')); ?>" value="<?php echo e(old('institute')); ?>" />

                                            <?php if($errors->has('institute')): ?>
                                                <p class="req"><?php echo e($errors->first('institute')); ?></p>
                                            <?php endif; ?>

                                        </div>


                                        <div class="mb-3">
                                            <label for="address" class="form-label"><?php echo e(__('labels.address')); ?> <span class="req">*</span></label>
                                            <textarea name="address" autocomplete="off" class="form-control" id="address" placeholder="<?php echo e(__('placeholder.address')); ?>"><?php echo e(old('address')); ?></textarea>

                                            <?php if($errors->has('address')): ?>
                                                <p class="req"><?php echo e($errors->first('address')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label"><?php echo e(__('labels.email')); ?> <span class="req">*</span></label>
                                            <input type="text" name="email" autocomplete="off" class="form-control" id="email" placeholder="<?php echo e(__('placeholder.email')); ?>" value="<?php echo e(old('email')); ?>" />

                                            <?php if($errors->has('email')): ?>
                                                <p class="req"><?php echo e($errors->first('email')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_person" class="form-label"><?php echo e(__('labels.contact_person')); ?> <span class="req">*</span></label>
                                            <input type="text" name="contact_person" autocomplete="off" class="form-control" id="contact_person" placeholder="<?php echo e(__('placeholder.contact_person')); ?>" value="<?php echo e(old('contact_person')); ?>" />

                                            <?php if($errors->has('contact_person')): ?>
                                                <p class="req"><?php echo e($errors->first('contact_person')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_number" class="form-label"><?php echo e(__('labels.contact_number')); ?> <span class="req">*</span></label>
                                            <input type="text" name="contact_number" autocomplete="off" class="form-control" id="contact_number" placeholder="<?php echo e(__('placeholder.contact_number')); ?>" value="<?php echo e(old('contact_number')); ?>" />

                                            <?php if($errors->has('contact_number')): ?>
                                                <p class="req"><?php echo e($errors->first('contact_number')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label"><?php echo e(__('labels.status')); ?> <span class="req">*</span></label>
                                            <select name="status" id="" class="form-control">
                                                <option value="1" <?php echo e(old('status') === 1 ? "selected" : ""); ?>><?php echo e(__('Active')); ?></option>
                                                <option value="0" <?php echo e(old('status') === 0 ? "selected" : ""); ?>><?php echo e(__('Inactive')); ?></option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/institute/create.blade.php ENDPATH**/ ?>