<?php $__env->startSection('title', ' - Add Equipment'); ?>
<?php $__env->startSection('content'); ?>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.add_course')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-course-data-form" action="<?php echo e(route('courses.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="course" class="form-label"><?php echo e(__('Course')); ?> <span class="req">*</span></label>
                                            <input type="text" name="course" autocomplete="off" class="form-control" id="course" placeholder="<?php echo e(__('placeholder.course')); ?>" value="<?php echo e(old('course')); ?>" />

                                            <?php if($errors->has('course')): ?>
                                                <p class="req"><?php echo e($errors->first('course')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label"><?php echo e(__('Status')); ?> <span class="req">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="1" <?php echo e(old('status') == 1 ? "selected" : ""); ?>>Active</option>
                                                <option value="0" <?php echo e(old('status') == 0 ? "selected" : ""); ?>>Inactive</option>
                                            </select>

                                            <?php if($errors->has('status')): ?>
                                                <p class="req"><?php echo e($errors->first('status')); ?></p>
                                            <?php endif; ?>

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
        function check_all(ths, cls) {
            $(`.${cls}`).prop('checked', ths.checked);
        }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\development\htdocs\projects\toc\portal\resources\views/pages/course/create.blade.php ENDPATH**/ ?>