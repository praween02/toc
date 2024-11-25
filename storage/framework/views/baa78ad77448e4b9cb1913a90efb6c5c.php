<?php $__env->startSection('title', ' - Experts'); ?>
<?php $__env->startSection('content'); ?>
<style>
	table tr td:first-child{width:20%}
	.sactive{border:3px solid #5ea439}
	.badge-light{background:#3c3c3c;font-size:13px !important}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
			     <?php if(in_array('super_admin', get_roles())): ?>
				<h2 class="text-right"><button type="button" class="lesp btn btn-success sactive">Total Application <span class="badge badge-light"><?php echo e($total_applications); ?></span></button> </h2>
			    <?php endif; ?>

		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3><?php echo e(__('Experts Data')); ?></h3></div>
		            		<div class="col-md-6">
		            		    <?php
		            		    	$check_record_exist = \App\Models\AskExpertDetail::where('user_id', current_user_id())->count();
		            		    ?>

		            		    <?php if(empty($check_record_exist) && ( ! in_array('super_admin', get_roles())) && (! in_array('admin_view', get_roles()))): ?>
		            				<a href="<?php echo e(route('expert_user')); ?>"><button class="btn btn-primary float-end">Apply Expert</button></a>
		            		    <?php endif; ?>
		            		</div>
		            	</div>


		                <?php echo e($dataTable->table(['class' => 'table table-bordered'])); ?>

		            </div>

		            <!-- Modal -->
					<div class="modal fade" id="appFormModal" tabindex="-1" aria-labelledby="appFormModallLabel" aria-hidden="true">
					  <div class="modal-dialog modal-fullscreen-xxl-down">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Application Details</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <table class="table table-striped table-bordered" style="border-radius:25px">
							  <thead>
							  </thead>
							  <tbody id="app_data">
							  </tbody>
							</table>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- close -->


		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('sections.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
    	function application_summary(react_id) {
    		const origin  = "<?php echo e(url('storage/poc_bsnl/')); ?>";
    		$('#appFormModal').modal('show');
    		let html = '';
    		$.ajax({  
						url: "<?php echo e(route('expert_user.show')); ?>?react_id=" + react_id,  
						type: 'GET', 
						dataType: 'json', 
						beforeSend: function() {
					        $("#app_data").html(`<center>just a moment...</center>`);   
					    },
					  	success: function(data) { 
					  	    const { response, status, path } = data; 
					    	if (status == 'success') {
					    			html = `<tr>
										      <td><strong>Family Name</strong></th>
										      <td>${response.family_name}</td>
										    </tr>
										    <tr>
										      <td><strong>First Name</strong></td>
										      <td>${response.first_name}</td>
										    </tr>
										    <tr>
										      <td><strong>Gender</strong></th>
										      <td>${response.gender == 'M' ? 'Male' : 'Female'}</td>
										    </tr>
										    <tr>
										      <td><strong>Position</strong></th>
										      <td>${response.position}</td>
										    </tr>
										    <tr>
										      <td><strong>Current Organization</strong></th>
										      <td>${response.current_organization}</td>
										    </tr>
										    <tr>
										      <td><strong>Affiliations/Certifications</strong></th>
										      <td>${response.affiliations_certifications}</td>
										    </tr>
										    <tr>
										      <td><strong>Date of graduation</strong></th>
										      <td>${response.graduation_date}</td>
										    </tr>
										    <tr>
										      <td><strong>Email address official</strong></th>
										      <td><i class="mdi mdi-email" aria-hidden="true"></i> ${response.official_email}</td>
										    </tr>
										    <tr>
										      <td><strong>Additional Email address(personal)</strong></th>
										      <td><i class="mdi mdi-email" aria-hidden="true"></i> ${response.personal_email}</td>
										    </tr>
											
											 <tr>
										      <td><strong>Address</strong></th>
										      <td>${response.address}</td>
										    </tr>

										    <tr>
										      <td><strong>City</strong></th>
										      <td>${response.city}</td>
										    </tr>

										    <tr>
										      <td><strong>State</strong></th>
										      <td>${response.state}</td>
										    </tr>

										    <tr>
										      <td><strong>Country</strong></th>
										      <td>${response.country}</td>
										    </tr>

										    <tr>
										      <td><strong>Post Code</strong></th>
										      <td>${response.post_code}</td>
										    </tr>
										    
										    <tr>
										      <td><strong>Whether have OCI</strong></th>
										      <td>${response.whether_have_oci}</td>
										    </tr>

										    <tr>
										      <td><strong>Tel. Mobile</strong></th>
										      <td>${response.tel_mobile}</td>
										    </tr>

										    <tr>
										      <td><strong>Fax Prof</strong></th>
										      <td>${response.fax_prof}</td>
										    </tr>
										    <tr>
										      <td><strong>Area of Expertise</strong></th>
										      <td>${response.activity} <p><small style="font-size:11px;font-weight:bold">${response.activity == 'Other' ? response.other : ''}</small></p></td>
										    </tr>
										    <tr>
										      <td><strong>Level</strong></th>
										      <td>${response.level}</td>
										    </tr>
										    <tr>
										      <td><strong>Curriculum Vitae</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}/${response.cv}'><i class="mdi mdi-link-variant"></i> ${response.cv}</a></td>
										    </tr>
										    <tr>
										      <td><strong>Any ID details/Passport for foreign Resident</strong></th>
										      <td>${response.id_number} <a title="click here to download" target="_blank" download href='${path}/${response.id_proof_document}'><i class="mdi mdi-link-variant"></i> ${response.id_proof_document}</a></td>
										    </tr>
										     <tr>
										      <td><strong>Photograph</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}/${response.photograph}'><i class="mdi mdi-link-variant"></i> ${response.photograph}</a></td>
										    </tr>
										     <tr>
										      <td><strong>Web page</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${response.web_page}'><i class="mdi mdi-link-variant"></i> ${response.web_page}</a></td>
										    </tr>`;
					    	} else {
					    			html = `<center>${response}</center>`;
					    	}
					    			$("#app_data").html(html);            
					  	},
					  	error: function(data) {
					  		$("#app_data").html(`<center>oops.. something went wrong. try again !</center>`); 
					  	}
				  });
    	}
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\projects\dot\resources\views/pages/ask_expert/index.blade.php ENDPATH**/ ?>