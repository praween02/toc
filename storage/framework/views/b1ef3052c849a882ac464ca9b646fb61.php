<?php $__env->startSection('title', ' - Add Committee'); ?>
<?php $__env->startSection('content'); ?>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.add_committee')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-team-data-form" action="<?php echo e(route('teams.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="committee" class="form-label"><?php echo e(__('app.committee')); ?> <span class="req">*</span></label>
                                            <input type="text" name="committee" autocomplete="off" class="form-control" id="committee" placeholder="<?php echo e(__('app.committee')); ?>" value="<?php echo e(old('committee')); ?>" />

                                            <?php if($errors->has('committee')): ?>
                                                <p class="req"><?php echo e($errors->first('committee')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                        <div class="mb-3">
                                            <label for="experts" class="form-label"><?php echo e(__('Experts')); ?> <span class="req">*</span></label>
                                            <select name="experts[]" class="form-control" multiple>
                                                <?php $__currentLoopData = $experts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option <?php echo e(in_array($expert->user_id, old('experts') ?? []) ? "selected" : ""); ?> value="<?php echo e($expert->user_id); ?>"><?php echo e($expert->first_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select> 
                                            <p><small><strong>To select multiple:</strong> ( Mac: cmd + click, Windows: ctrl + click )</small></p>

                                            <?php if($errors->has('experts')): ?>
                                                <p class="req"><?php echo e($errors->first('experts')); ?></p>
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
    function roleSelect(id) {
        if (id == 3) {
            $('.inst_container').removeClass('d-none');
        } else {
            $('.inst_container').addClass('d-none');
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\development\htdocs\projects\toc\portal\resources\views/pages/team/create.blade.php ENDPATH**/ ?>