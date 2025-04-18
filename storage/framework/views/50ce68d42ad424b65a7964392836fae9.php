<?php $__env->startSection('title', ' - Add Payment'); ?>
<?php $__env->startSection('content'); ?>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><?php echo e(__('app.add_payment')); ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-payment-data-form" action="<?php echo e(route('payments.store')); ?>">
                                        <?php echo csrf_field(); ?>

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="utr_no" class="form-label"><?php echo e(__('Unique Transaction Reference')); ?> <span class="req">*</span></label>
                                            <input type="text" name="utr_no" autocomplete="off" class="form-control" id="utr_no" placeholder="<?php echo e(__('placeholder.utr_no')); ?>" value="<?php echo e(old('utr_no')); ?>" />

                                            <?php if($errors->has('utr_no')): ?>
                                                <p class="req"><?php echo e($errors->first('utr_no')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                         <div class="mb-3">
                                            <label for="transaction_date" class="form-label"><?php echo e(__('Transaction Date')); ?> <span class="req">*</span></label>
                                            <input type="date" name="transaction_date" autocomplete="off" class="form-control" id="transaction_date" placeholder="<?php echo e(__('placeholder.transaction_date')); ?>" value="<?php echo e(old('transaction_date')); ?>" />

                                            <?php if($errors->has('transaction_date')): ?>
                                                <p class="req"><?php echo e($errors->first('transaction_date')); ?></p>
                                            <?php endif; ?>

                                        </div>

                                         <div class="mb-3">
                                            <label for="amount" class="form-label"><?php echo e(__('Amount')); ?> <span class="req">*</span></label>
                                            <input type="number" name="amount" autocomplete="off" class="form-control" id="amount" placeholder="<?php echo e(__('placeholder.amount')); ?>" value="<?php echo e(old('amount')); ?>" />

                                            <?php if($errors->has('amount')): ?>
                                                <p class="req"><?php echo e($errors->first('amount')); ?></p>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/payments/create.blade.php ENDPATH**/ ?>