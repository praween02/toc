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

                                    <form method="POST" id="save-vendor-data-form" action="<?php echo e(route('users.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label"><?php echo e(__('Name')); ?> <span class="req">*</span></label>
                                            <input type="text" name="name" autocomplete="off" class="form-control" id="name" placeholder="<?php echo e(__('placeholder.name')); ?>" value="<?php echo e(old('name')); ?>" />

                                            <?php if($errors->has('name')): ?>
                                                <p class="req"><?php echo e($errors->first('name')); ?></p>
                                            <?php endif; ?>

                                        </div>


                                        <div class="mb-3">
                                            <label for="email" class="form-label"><?php echo e(__('Email')); ?> <span class="req">*</span></label>
                                            <input type="text" name="email" autocomplete="off" class="form-control" id="email" placeholder="<?php echo e(__('placeholder.email')); ?>" value="<?php echo e(old('email')); ?>" />

                                            <?php if($errors->has('email')): ?>
                                                <p class="req"><?php echo e($errors->first('email')); ?></p>
                                            <?php endif; ?>

                                        </div>


                                        <div class="mb-3">
                                            <label for="password" class="form-label"><?php echo e(__('Password')); ?> <span class="req">*</span></label>
                                            <input type="password" name="password" autocomplete="off" class="form-control" id="password" placeholder="<?php echo e(__('placeholder.password')); ?>" value="<?php echo e(old('password')); ?>" />
                                            <p><small class="sm">Min: 6 Characters</small></p>

                                            <?php if($errors->has('password')): ?>
                                                <p class="req"><?php echo e($errors->first('password')); ?></p>
                                            <?php endif; ?>

                                        </div>


                                        <div class="mb-3">
                                            <label for="address1" class="form-label"><?php echo e(__('Address1')); ?> <span class="req">*</span></label>

                                            <textarea name="address1" autocomplete="off" class="form-control" id="address1" placeholder="<?php echo e(__('placeholder.address1')); ?>"><?php echo e(old('address1')); ?></textarea>


                                            <!-- <input type="text" name="address1" autocomplete="off" class="form-control" id="address1" placeholder="<?php echo e(__('placeholder.address1')); ?>" value="<?php echo e(old('address1')); ?>" /> -->

                                            <?php if($errors->has('address1')): ?>
                                                <p class="req"><?php echo e($errors->first('address1')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="address2" class="form-label"><?php echo e(__('Address2')); ?> </label>


                                            <textarea name="address2" autocomplete="off" class="form-control" id="address2" placeholder="<?php echo e(__('placeholder.address2')); ?>"><?php echo e(old('address2')); ?></textarea>
                                            
                                            <!-- <input type="text" name="address2" autocomplete="off" class="form-control" id="address2" placeholder="<?php echo e(__('placeholder.address2')); ?>" value="<?php echo e(old('address2')); ?>" /> -->

                                            <?php if($errors->has('address2')): ?>
                                                <p class="req"><?php echo e($errors->first('address2')); ?></p>
                                            <?php endif; ?>

                                        </div>


                                        <div class="mb-3">
                                            <label for="mobile" class="form-label"><?php echo e(__('Mobile')); ?> <span class="req">*</span></label>
                                            <input type="text" name="mobile" autocomplete="off" class="form-control" id="mobile" placeholder="<?php echo e(__('placeholder.mobile')); ?>" value="<?php echo e(old('mobile')); ?>" />

                                            <?php if($errors->has('mobile')): ?>
                                                <p class="req"><?php echo e($errors->first('mobile')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="role_id" class="form-label"><?php echo e(__('Role')); ?> <span class="req">*</span></label>
                                            <select name="role_id" id="" class="form-control" onchange="roleSelect(this.value)">
                                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($role->id); ?>" <?php echo e(old('role_id') == $role->id ? "selected" : ""); ?>><?php echo e(ucwords($role->name)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('role_id')): ?>
                                                <p class="req"><?php echo e($errors->first('role_id')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <?php
                                            $hidden_cls = 'd-none';
                                            if (old('role_id') == 3)
                                            $hidden_cls = '';
                                        ?>

                                        <div class="mb-3 <?php echo e($hidden_cls); ?> inst_container">
                                            <label for="institute_id" class="form-label"><?php echo e(__('Institutes')); ?> <span class="req">*</span></label>
                                            <select name="institute_id" id="" class="form-control">
                                                <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($institute->id); ?>" <?php echo e(old('institute_id') == $institute->id ? "selected" : ""); ?>><?php echo e(ucwords($institute->institute)); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php if($errors->has('institute')): ?>
                                                <p class="req"><?php echo e($errors->first('institute')); ?></p>
                                            <?php endif; ?>

                                        </div>



                                        <div class="mb-3">
                                            <label for="status" class="form-label"><?php echo e(__('Status')); ?> <span class="req">*</span></label>
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

<?php $__env->startPush('scripts'); ?>
<script>
    function roleSelect(id) {
        if (id == 3) {
            $('.inst_container').removeClass('d-none');
        } else {
            $('.inst_container').addClass('d-none');
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/user/create.blade.php ENDPATH**/ ?>