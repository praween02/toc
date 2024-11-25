<?php $__env->startSection('title', ' - Tickets'); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
.sml{font-size:10px;font-style:italic}
.table>:not(:last-child)>:last-child>*{width:81px !important}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3><?php echo e(__('app.tickets')); ?></h3></div>
		            			<div class="col-md-6 text-end">
						    <?php if(in_array("vendor", get_roles()) OR in_array("institute", get_roles())): ?>
							<a href="<?php echo e(route('tickets.create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('app.add_ticket_complaint')); ?></a>
						    <?php endif; ?>
</div>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\projects\dot\resources\views/pages/ticket/index.blade.php ENDPATH**/ ?>