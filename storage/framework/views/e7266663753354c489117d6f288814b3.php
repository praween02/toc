<?php $__env->startSection('title', ' - System Manual'); ?>
<?php $__env->startSection('content'); ?>

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">               
		            <div class="card-body">
		            	<div class="row">

		            		

							<?php if(in_array('vendor', get_roles())): ?>
							<div class="col-md-6 float-left"><h3><?php echo e(__('Upload Document')); ?></h3></div>
		            			<div class="col-md-6 text-end"><a href="<?php echo e(route('system_manual.create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('Document')); ?></a></div>
							<?php endif; ?>
							<?php if(in_array('super_admin', get_roles())): ?>
							<div class="col-md-6 float-left"><h3><?php echo e(__('Document')); ?></h3></div>
		            			<div class="col-md-6 text-end"><a href="<?php echo e(route('system_manual.create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('Document')); ?></a></div>
							<?php endif; ?>
							<?php if(in_array('institute', get_roles())): ?>
							<div class="col-md-6 float-left"><h3><?php echo e(__('UAT Document')); ?></h3></div>
		            			<div class="col-md-6 text-end"><a href="<?php echo e(route('system_manual.create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('UAT Document')); ?></a></div>
							<?php endif; ?>

		            		
		            		<!-- <?php echo e(ucwords(Auth::user()->id)); ?>  -->
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\projects\bharat5glab\toc\resources\views/pages/system_manual/index.blade.php ENDPATH**/ ?>