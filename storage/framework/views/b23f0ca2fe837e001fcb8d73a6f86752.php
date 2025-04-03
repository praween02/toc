<?php $__env->startSection('title', ' - Add User'); ?>
<?php $__env->startSection('content'); ?>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.add_user')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form enctype="multipart/form-data" method="POST" id="save-institute-user-form" action="<?php echo e(route('institute_users.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="institute" class="form-label"><?php echo e(__('labels.first_name')); ?> <span class="req">*</span></label>
                                            <input type="text" name="first_name" autocomplete="off" class="form-control" id="first_name" placeholder="<?php echo e(__('placeholder.first_name')); ?>" value="<?php echo e(old('first_name')); ?>" />

                                            <?php if($errors->has('first_name')): ?>
                                                <p class="req"><?php echo e($errors->first('first_name')); ?></p>
                                            <?php endif; ?>

                                        </div>


                                        <div class="mb-3">
                                            <label for="last_name" class="form-label"><?php echo e(__('labels.last_name')); ?> <span class="req">*</span></label>
                                            <input type="text" name="last_name" autocomplete="off" class="form-control" id="last_name" placeholder="<?php echo e(__('placeholder.last_name')); ?>" value="<?php echo e(old('last_name')); ?>" />

                                            <?php if($errors->has('last_name')): ?>
                                                <p class="req"><?php echo e($errors->first('last_name')); ?></p>
                                            <?php endif; ?>

                                        </div>



                                        <div class="mb-3">
                                            <label for="phone_no" class="form-label"><?php echo e(__('labels.phone_no')); ?> <span class="req">*</span></label>
                                            <input type="text" name="phone_no" autocomplete="off" class="form-control" id="phone_no" placeholder="<?php echo e(__('placeholder.phone_no')); ?>" value="<?php echo e(old('phone_no')); ?>" />

                                            <?php if($errors->has('phone_no')): ?>
                                                <p class="req"><?php echo e($errors->first('phone_no')); ?></p>
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
                                            <label for="user_name" class="form-label"><?php echo e(__('labels.user_name')); ?> <span class="req">*</span></label>
                                            <input type="text" name="user_name" autocomplete="off" class="form-control" id="user_name" placeholder="<?php echo e(__('placeholder.user_name')); ?>" value="<?php echo e(old('user_name')); ?>" />
                                            <?php if($errors->has('user_name')): ?>
                                                <p class="req"><?php echo e($errors->first('user_name')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="gender" class="form-label"><?php echo e(__('labels.gender')); ?> <span class="req">*</span></label>

                                            <select name="gender" id="gender" class="form-control">
                                                <?php $__currentLoopData = $gender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('gender')): ?>
                                                <p class="req"><?php echo e($errors->first('gender')); ?></p>
                                            <?php endif; ?>

                                        </div>


                                        <div class="mb-3">
                                            <label for="user_type" class="form-label"><?php echo e(__('labels.user_type')); ?> <span class="req">*</span></label>
                                            <select name="user_type" class="form-control">
                                                <?php $__currentLoopData = $user_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('user_type')): ?>
                                                <p class="req"><?php echo e($errors->first('user_type')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3 d-none">
                                            <label for="status" class="form-label"><?php echo e(__('labels.profile_pic')); ?> </label>
                                            <p><input type="file" name="profile_pic" id="profile_pic" accept="image/*" /></p>
                                            <p><small><i>allowed extenstion:</i> <strong>jpg, jpeg, png, gif</strong></small></p>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/institute_users/create.blade.php ENDPATH**/ ?>