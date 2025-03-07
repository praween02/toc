
<?php $__env->startSection('title', ' - System Manual'); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
table tr td:first-child{width:75%}	
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">               
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3><?php echo e(__('System Manual')); ?></h3></div>

		            	
		            			<div class="col-md-6 text-end"><a href="<?php echo e(route('system_manual.create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('System Manual')); ?></a></div>
		            		
		            		
		            	</div>

		                <?php echo e($dataTable->table(['class' => 'table table-bordered'])); ?>

		            </div>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('sections.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\projects\dot\resources\views/pages/system_manual/index.blade.php ENDPATH**/ ?>