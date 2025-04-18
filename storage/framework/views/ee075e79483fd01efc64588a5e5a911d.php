<?php $__env->startSection('title', ' - Institutes'); ?>
<?php $__env->startSection('content'); ?>
<style>
	.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem 1.25rem 0 1.25rem;
}
.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}
.text-capitalize {
    text-transform: capitalize!important;
}
.pt-4, .py-4 {
    padding-top: 1.5rem!important;
}
.justify-content-between {
    justify-content: space-between!important;
}
.d-flex {
    display: flex!important;
}
.border-0 {
    border: 0!important;
}
.w-30{width:30%}
.w-70{width:70%}
.card{box-shadow:0 0 2px 0 rgba(0,0,0,.5) !important}
.brd{border:1px dotted #ddd;border-radius:4px;margin-right:4px;padding:10px;text-align:center}
.grn{color:#0eae28}
.rd{color:#ff5b5b};
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">               
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-12 float-left"><h3><?php echo e($institute->institute); ?></h3></div>
		            	</div>

		            	<div class="row">
		            		<div class="col-xl-6">
		            			<div class="card bg-white border-0 b-shadow-4 mt-2">
						            <div class="card-body">
										<div class="col-12 px-0 pb-2 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize"><strong>Address</strong> </p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?php echo e($institute->address); ?></p>
						    			</div>
        							</div>

        							<div class="card-body">
										<div class="col-12 px-0 pb-2 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize"><strong>Email</strong> </p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?php echo e($institute->email); ?></p>
						    			</div>
        							</div>

        							<div class="card-body pt-2 ">
										<div class="col-12 px-0 pb-2 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize"><strong>Contact Person</strong> </p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?php echo e($institute->contact_person); ?></p>
						    			</div>
        							</div>

        							<div class="card-body pt-2 ">
										<div class="col-12 px-0 pb-2 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize"><strong>Contact Number</strong> </p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?php echo e($institute->contact_number); ?></p>
						    			</div>
        							</div>

        							<div class="card-body pt-2 ">
										<div class="col-12 px-0 pb-2 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize"><strong>State</strong>  </p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?php echo e($institute->state); ?></p>
						    			</div>
        							</div>

        							<div class="card-body pt-2 ">
										<div class="col-12 px-0 pb-2 d-lg-flex d-md-flex d-block">
											<p class="mb-0 text-lightest f-14 w-30 text-capitalize"><strong>Designation</strong>  </p>
											<p class="mb-0 text-dark-grey f-14 w-70 text-wrap"><?php echo e($institute->designation); ?> </p>
						    			</div>
        							</div>

    							</div>
		            		</div>

		            		<div class="col-xl-6">
		            				<p class="mt-2">
		            					<select class="form-control" onchange="equ_view(this.value)">
		            					     <option value="">-- Select Equipment</option>
		            					     <?php $__empty_1 = true; $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment_id => $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		            					     	<option value="<?php echo e($equipment_id); ?>"><?php echo e($equipment); ?></option>
		            					     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
		            					     <?php endif; ?>
		            					</select>
		            				</p>

		            		<?php $__empty_1 = true; $__currentLoopData = $equipments_timeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment_timeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
		            			<div class="card bg-white border-0 b-shadow-4 mt-2 crdtimeline" id="timeline_<?php echo e($equipment_timeline['equipment_id']); ?>">
						            <div class="card-body pt-2 ">
						            	<h5><?php echo e($equipment_timeline['equipment']); ?></h5>
						            	<div class="row mb-2">
											<div class="col pb-1 brd">
												<p class="mb-0 text-lightest f-14 text-capitalize">Delivery Date </p>
												<p class="mb-0 text-dark-grey f-14 text-wrap rd"><i class="fe-calendar"></i> <?php echo e((! empty($equipment_timeline['equipment_delivery_date']) ? date('D, j M Y', strtotime($equipment_timeline['equipment_delivery_date'])) : 'N/A')); ?></p>
							    			</div>
							    			<div class="col pb-1 brd">
												<p class="mb-0 text-lightest f-14 text-capitalize">Dispatch </p>
												<p class="mb-0 text-dark-grey f-14 text-wrap">
													<?php if(! empty($equipment_timeline['dispatch_invoice_file'])): ?>
														<a href="<?php echo e(url('storage/files/' . $equipment_timeline['dispatch_invoice_file'])); ?>"><i class="fe-file"></i> dispatch.pdf</a>
													<?php else: ?>
														<p>N/A</p>
												    <?php endif; ?>
												</p>
							    			</div>

							    			<div class="col pb-1 brd">
												<p class="mb-0 text-lightest f-14 text-capitalize">Delivered Date </p>
												<p class="mb-0 text-dark-grey f-14 text-wrap grn"><i class="fe-calendar"></i> <?php echo e((! empty($equipment_timeline['equipment_delivered_date']) ? date('D, j M Y', strtotime($equipment_timeline['equipment_delivered_date'])) : 'N/A')); ?></p>
							    			</div>
								    	</div>


								    	<div class="row mb-2">
											<div class="col pb-1 brd">
												<p class="mb-0 text-lightest f-14 text-capitalize">Installation Date </p>
												<p class="mb-0 text-dark-grey f-14 text-wrap"><i class="fe-calendar"></i> <?php echo e((! empty($equipment_timeline['equipment_install_date']) ? date('D, j M Y', strtotime($equipment_timeline['equipment_install_date'])) : 'N/A')); ?></p>
							    			</div>

							    			<div class="col pb-1 brd">
												<p class="mb-0 text-lightest f-14 text-capitalize">Installed Date </p>
												<p class="mb-0 text-dark-grey f-14 text-wrap"><i class="fe-calendar"></i> <?php echo e((! empty($equipment_timeline['equipment_installed_date']) ? date('D, j M Y', strtotime($equipment_timeline['equipment_installed_date'])) : 'N/A')); ?></p>
							    			</div>
								    	</div>

								    	<div class="row mb-2">
											<div class="col pb-1 brd">
												<p class="mb-0 text-lightest f-14 text-capitalize">Commission Date </p>
												<p class="mb-0 text-dark-grey f-14 text-wrap"><i class="fe-calendar"></i> <?php echo e((! empty($equipment_timeline['equipment_commision_date']) ? date('D, j M Y', strtotime($equipment_timeline['equipment_commision_date'])) : 'N/A')); ?></p>
							    			</div>

							    			<div class="col pb-1 brd">
												<p class="mb-0 text-lightest f-14 text-capitalize">Commissioned Date </p>
												<p class="mb-0 text-dark-grey f-14 text-wrap"><i class="fe-calendar"></i> <?php echo e((! empty($equipment_timeline['equipment_commisioned_date']) ? date('D, j M Y', strtotime($equipment_timeline['equipment_commisioned_date'])) : 'N/A')); ?></p>
							    			</div>
								    	</div>
        							</div>
        						</div>

        					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        					<p>No Data!</p>
        					<?php endif; ?>


		            		</div>
		            	</div>

		            </div>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
 function equ_view(val) {
 	if (val == '') {
 		 	$('.crdtimeline').removeClass('d-none');
 	} else {
 		$('.crdtimeline').addClass('d-none');
 		$(`#timeline_${val}`).removeClass('d-none');
 	}
 }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/institute/summary.blade.php ENDPATH**/ ?>