<?php $__env->startSection('title', ' - NDA Listing'); ?>
<?php $__env->startSection('content'); ?>
<style>
.paginate_button{padding:0 3px}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">

		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3><?php echo e(__('NDA Listing')); ?></h3></div>
		            	</div>

		            	<table class="table table-bordered" id="nda-datatable">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Expert</th>
						      <th scope="col">NDA (Non-Disclosure Agreement)</th>
						      <th scope="col">Upload Date/Time</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php $__empty_1 = true; $__currentLoopData = $nda_listing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						    <tr>
						      <th scope="row"><?php echo e($loop->iteration); ?></th>
						      <td><?php echo e($list->first_name); ?></td>
						      <td><a download target="_blank" href="<?php echo e(url('storage/uploads/' . $list->nda_agreement)); ?>"><?php echo e($list->nda_agreement); ?></a></td>
						      <td><?php echo e(date('D, j M\'y H:i:s', strtotime($list->nda_upload_date_time))); ?></td>
						    </tr>
						     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
						      <tr><td colspan="4">No data!</td></tr>
						    <?php endif; ?>
						  </tbody>
						</table>
		            </div>
		        </div>
		    </div>

		</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#nda-datatable').DataTable();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/ask_expert/nda_listing.blade.php ENDPATH**/ ?>