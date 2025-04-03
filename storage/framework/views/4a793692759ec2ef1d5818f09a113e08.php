<?php $__env->startSection('title', ' - List of Submitted Applications For 6G Appliation'); ?>
<?php $__env->startSection('content'); ?>
<style>
table tr td:nth-child(6){width:17%}
.badge-light{background:#3c3c3c;font-size:13px !important}
.btn-primary1{background:#ffa91c !important;color:#fff}
.lesp{letter-spacing:0.7px}
.container_stats{border:1px dashed #a8a6a6;padding:20px 0;margin-bottom:10px;margin-left:0px;margin-top:10px}
.all_active{border:3px solid #be7a0c}
.sactive{border:3px solid #5ea439}
.pactive{border:3px solid #9d2c08}

#snackbar{visibility:hidden;min-width:250px;margin-left:-125px;background-color:#333;color:#fff;text-align:center;border-radius:2px;padding:16px;position:fixed;z-index:1;left:50%;bottom:30px}#snackbar.show{visibility:visible;-webkit-animation:fadein 0.5s,fadeout .5s 2.5s;animation:fadein 0.5s,fadeout .5s 2.5s}@-webkit-keyframes fadein{from{bottom:0;opacity:0}to{bottom:30px;opacity:1}}@keyframes fadein{from{bottom:0;opacity:0}to{bottom:30px;opacity:1}}@-webkit-keyframes fadeout{from{bottom:30px;opacity:1}to{bottom:0;opacity:0}}@keyframes fadeout{from{bottom:30px;opacity:1}to{bottom:0;opacity:0}}
.select2-container{width:100% !important}
.evaluation_container{border:1px dashed #ddd;border-radius:10px;padding:10px;margin-top:10px}
small{font-size:9px;color:#383A80}
.padr10{padding-right:10px}
.pad0{padding:0px}
.trash{padding-right:0;text-align:center}
#evaluation_box{max-height:200px;overflow-y:scroll;overflow-x:hidden;padding-right:25px;overflow:auto;}
.dp{display:block}


</style>

<?php if( ! in_array('super_admin', get_roles())): ?>
<style type="text/css">
	.dt-buttons{display:none !important}
</style>
<?php endif; ?>

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3><?php echo e(app('request')->input('action') ? ucfirst(app('request')->input('action')) : 'Submitted'); ?> Application</h3></div>
		            		<div class="col-md-6">
		            		    <?php
		            		    	$check_record_exist = \App\Models\SixGUser::where('is_form_submit', 1)->where('user_id', current_user_id())->count();
		            		    ?>

		            		    <?php if(empty($check_record_exist) && ( ! in_array('super_admin', get_roles())) && ( ! in_array('admin_view', get_roles()))): ?>)
		            				<a href="<?php echo e(route('six_g_user')); ?>"><button class="btn btn-primary float-end">Apply 6G Form</button></a>
		            		    <?php endif; ?>
	
					    
		            		</div>
		            	</div>

				<?php if(in_array('super_admin', get_roles())): ?>
					
				<?php
		            	  $all_active = "";
		            	  $sactive = "";
		            	  $pactive = "";

		            	  $tab = app('request')->input('tab') ?? 'submitted';
		            		if ("all" == $tab) {
				                $all_active = 'all_active';
				            } elseif ("submitted" == $tab) {
				                $sactive = 'sactive';
				            } else {
				                $pactive = 'pactive';
				            }
				?>

				<div class="row container_stats">
		            			<div class="col-md-8">
		            				<a href="<?php echo e(route('six_g_user.index')); ?>?tab=submitted"><button type="button" class="lesp btn btn-success <?php echo e($sactive); ?>">Submitted <span class="badge badge-light"><?php echo e($submit_application); ?></span></button></a>&nbsp;&nbsp;
		            				<a href="<?php echo e(route('six_g_user.index')); ?>?tab=pending"><button type="button" class="lesp btn btn-danger <?php echo e($pactive); ?>">Pending <span class="badge badge-light"><?php echo e($total_application - $submit_application); ?></span></button></a>&nbsp;&nbsp;
							<a href="<?php echo e(route('six_g_user.index')); ?>?tab=all"><button type="button" class="lesp btn btn-primary1 <?php echo e($all_active); ?>">All Application <span class="badge badge-light"> <?php echo e($total_application); ?></span></button></a>

		            			</div>
						
							<?php if(in_array('super_admin', get_roles())): ?>
	            						<div class="col-md-4 text-right">
	            							<button name="assigned" id="assigned" class="btn btn-primary float-end" type="button">Assigned Application</button>
	            						</div>
	            					<?php endif; ?>
						
		            	</div><br />
				<?php endif; ?>


		            	<?php echo e($dataTable->table(['class' => 'table table-bordered'])); ?>


		            </div>

		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>




<!-- Modal -->

        <div class="modal fade modalBox" id="assignedModal" tabindex="-1" role="dialog" aria-labelledby="assignedModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
          	<div id="errors"></div>
            <form method="post" name="update_assigned_info" class="" id="update_assigned_info" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assigned Application to Committee </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                      <div class="form-group">
                        <label for="team-name" class="col-form-label">Committee <span class="req">*</span></label>
                        <select name="teams[]" id="teams" class="form-control select2" multiple>
                        	<option disabled value="">-- Select --</option>
                        	<?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        	  <option value="<?php echo e($team->id); ?>"><?php echo e($team->team); ?></option>
                        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>

                      <div class="form-group evaluation_container">
									        <div class="row">
									         	<div class="col-md-10"><h4>Add Evaluation Criteria</h4></div>
									        </div>

									        <div id="evaluation_box">
											        <div class="row mt-2">
											         	<div class="col-md-9">
											         		<small>Evaluation Criteria <span class="req">*</span></small>
											         		<input type="text" class="form-control" name="evaluation_criteria[]" autocomplete="off" />
											         	</div>
											         	<div class="col-md-2">
											         		<small>Max Marks <span class="req">*</span></small>
											         		<input autocomplete="off" type="text" value="0" min="0" max="100" class="form-control" name="max_marks[]" />
											         	</div>

											         	<div class="col-md-1 text-right mt-3">
											         		<button type="button" class="btn btn-xs btn-success add">+</button>
											         	</div>

											        </div>
										      </div>
									  </div>

                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="sbmitbtn">Submit</button>
                  </div>
                </div>
            </form>

          </div>
        </div>

        <div id="snackbar"></div>


        <!-- Admin -->

        <?php if(in_array('super_admin', get_roles())): ?>
        <div class="modal fade bd-example-modal-lg" id="adminEvaluateModal" tabindex="-1" aria-labelledby="adminEvaluateModallLabel" aria-hidden="true">
						  <div class="modal-dialog">

							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Evaluation Summary</h5>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							      </div>
							      <div class="modal-body" id="adminEv" style="max-height:400px;overflow-y:scroll;">
									    
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							      </div>
							    </div>

						  </div>
				</div>
				<?php endif; ?>

        <!-- Close -->

        <!-- Assigned Expert -->

        <div class="modal fade bd-example-modal-lg" id="assignedAppModal" tabindex="-1" aria-labelledby="assignedAppModallLabel" aria-hidden="true">
						  <div class="modal-dialog wd700">

							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Assigned Experts</h5>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							      </div>
							      <div class="modal-body">
									    	<table class="table table-bordered">
									    		<thead>
									    			<tr>
									    				<td>#</td>
									    				<td>Name</td>
									    				<td>Email</td>
									    				<td>Evaluation Submit</td>
									    			</tr>
									    		</thead>
									    		<tbody id="assignedApEv">
									    		</tbody>
									    	</table>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							      </div>
							    </div>

						  </div>
				</div>

<!-- Close -->


<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('sections.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script src="<?php echo e(asset('assets/js/jquery.validate.min.js?v=1.0')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2.min.js?v=1.0')); ?>"></script>
    <script>
    	let cbox_val;

    	let htm = '';

    	$(document).on('click', '.cbox', function() {
    		 let v = $(this).val();
    		 let route = "<?php echo e(route('six_g_user.index')); ?>" + `?app_id=${v}`;
    		 location.href = route;
    	})

    	$(document).on('click', '.assigned_app', function() 
	    	{
		    		  $("#assignedApEv").html('loading...');
		    			$("#assignedAppModal").modal('show');

		    			let app_id = $(this).data('enc-id');

	    				$.ajax({
							            url: `<?php echo e(route('assigned.experts')); ?>?appid=${app_id}`,
	                        type: "GET",
	                        success: function(response) {
	                        	 if (response.status == "success") {
	                        	 				  let htm = '';
																	    $.each(response.users, function(c, d) 
																	    	{
																		  		htm += `<tr>
																					  				<td>${c + 1}</td>
																					  				<td>${d.name}</td>
																					  				<td>${d.email}</td>
																					  				<td>${response.evalaution_submit_arr.includes(d.id) ? '<span class=\'badge btn-success\'>Yes</span>' : '<span class=\'badge btn-danger\'>No</span>' }</td>
																					  		 </tr>`;
																	      });
																	    $("#assignedApEv").html(htm);
	                        	 } else {
	                        	 	 $("#assignedApEv").html('Something went wrong.');
	                        	 }
	                        },error: function (jqXHR, exception) {
	                        	 $("#assignedApEv").html('Something went wrong.');
												  }
	             });

	    	});

    	$(function($) {
			  let checkList = $('.dropdown-check-list');
			  checkList.on('click', 'span.anchor', function(event) {
			    let element = $(this).parent();
			    if (element.hasClass('visible')) {
			      element.removeClass('visible');
			    } else {
			      element.addClass('visible');
			    }
			  });
			});

    	function category(id, ctgry) {

    		$.ajax({
						            url: `<?php echo e(route('sixg.category')); ?>?id=${id}&val=${ctgry}`,
                        type: "GET",
                        success: function(response) {
                        	 if (response.status == "success") {
                        	 	 alert("Update successfully");
                        	 } else {
                        	 	 alert('Something went wrong!');
                        	 }
                        },error: function (jqXHR, exception) {
                        	 alert('Something went wrong!');
											  }
              });
    	}


    	function get_evaluation(id) 
    		{
    					$("#adminEv").html('just a moment...');
              $("#adminEvaluateModal").modal('show');

    					$.ajax({
						            url: `<?php echo e(route('get_evaluation_reports')); ?>?id=${id}`,
                        type: "GET",    
                        data: {},
                        success: function(response) {

                        	let htm = '';
                        	if(response.status == "success") 
                        	 {
                        	 	  let cri = [];
                        	 	  let lbl = [];
                        	 	  let omarks = 0;

                        	 		$.each(response.res, function (a, b)  
                        	 			{
						                       htm += `<h4>${b.expert.name.charAt(0).toUpperCase() + b.expert.name.slice(1)}</h4>
						                      						<table class="table table-bordered">
																							  <thead>
																							    <tr>
																							      <th scope="col">#</th>
																							      <th scope="col">Evaluation Criteria List </th>
																							      <th scope="col">Max. Marks</th>
																							      <th scope="col">Obtain Marks</th>
																							    </tr>
																							  </thead>
																							  <tbody class="evaluation_criteria">`
																							    $.each(b.evalaution, function(c, d) 
																							    	{
																							    		let pmarks = typeof cri[d.cid] === 'undefined' ? 0 : cri[d.cid];

																							    		cri[d.cid] = pmarks + parseInt(d.obtain_marks != 'N/A' ? d.obtain_marks : 0);
																							    		lbl[d.cid] = d.criteria;

																								  		htm += `<tr>
																											  				<td>${c + 1}</td>
																											  				<td>${d.criteria}</td>
																											  				<td>${d.max_marks}</td>
																											  				<td>${d.obtain_marks}</td>
																											  		  </tr>`;
																							      });
																							  htm += `<tr><td colspan="4"><strong>Remarks:</strong> ${b.remarks ?? 'N/A'}</td></tr>`;
																							  htm += `</tbody>
																							</table>`;
															 });

		                        	 		let cri_data = Object.values(cri);
		                        	 		let len = response.res.length; 

						                      htm += `<h4>Average: </h4>
						                      						<table class="table table-bordered">
																							  <thead>
																							    <tr>
																							      <th scope="col">#</th>
																							      <th scope="col">Evaluation Criteria List </th>
																							      <th scope="col">Avg Marks</th>
																							    </tr>
																							  </thead>
																							  <tbody>`
																							    $.each(Object.values(lbl), function(c, d) 
																							    	{
																								  		htm += `<tr>
																											  				<td>${c + 1}</td>
																											  				<td>${d}</td>
																											  				<td>${Math.round(cri_data[c] / len)}</td>
																											  		 </tr>`;
																							      });
																							  htm += `</tbody>
																							</table>`;


                        	 		$("#adminEv").html(htm);
                        	}
                        	else {
                        		alert('Something went wrong!');
                        		$("#adminEv").html('');
                        	}
                        },
                        error: function (jqXHR, exception) {
                        	$("#adminEv").html('');
                        	alert('Something went wrong!');
											  }
									});
    		}


    	$(document).on('click', '.del', function() {
    		$(this).parent().parent().remove();
    	});

    	$('.add').click(function() {
	    		let html = `<div class="row mt-2">
								         	<div class="col-md-9">
								         			<small>Evaluation Criteria List <span class="req">*</span></small>
								         			<input type="text" autocomplete="off" class="form-control" name="evaluation_criteria[]" />
								         	</div>
								         	<div class="col-md-2 pad0">
								         		  <small>Max Marks <span class="req">*</span></small>
								         			<input type="number" min="0" value="0" max="100" class="form-control" name="max_marks[]" />
								         	</div>
								         	<div class="col-md-1 trash">
								         			<small class='dp'>&nbsp;</small>
								         			<button type="button" class="btn btn-xs btn-danger del">-</button>
								         	</div>
								      </div>`;
					$('#evaluation_box').append(html);
    	});

    	$(document).ready(function() {
	    		$('.select2').select2({
			        dropdownParent: $('#assignedModal')
			    });
    	});


    	function all_cbox(e) {
    		$('input:checkbox.cbox').prop('checked', e);
    	}

    	$("#assigned").click(function() {
    		let checkbox_sel = parseInt($('input:radio.cbox:checked').length);
    		if (checkbox_sel) {
    			$("#assignedModal").modal('show');	
    		} else {
    				  $("#snackbar").addClass('show').html('Please select any application to continue');
			 	 	  setTimeout(function(){ $("#snackbar").removeClass("show"); }, 3000);
    		}
    	});

    	$(".close").click(function() {
    		$("#assignedModal").modal('hide');
    	});


    	function sel_activity(activity) 
    		{
    				let expertise_arr = [0];

    				$('ul.items li input.expertise_list:checked').each(function(a, b) {
    						expertise_arr.push(b.value);
    				});

    				let app_id = $("input[type='radio']:checked").val();

    			  $("#expert").html(`<option disabled value="">just a moment...</option>`).trigger("change");
    			  let _token = $('meta[name="csrf-token"]').attr('content');
		    		$.ajax({
						            url: `<?php echo e(route('expert_based_on_activity')); ?>`,
                        type: "POST",    
                        data: {expertise_arr,app_id,_token},
                        success: function(response) {
                        	if(response.users.length) {
                        		let option = '<option disabled value="">-- Select --</option>';
                        		$.each(response.users, function(a, b) {
                        				option += `<option value='${b.user_id}'>${b.first_name}</option>`;
                        		});
                        		$("#expert").html(option).trigger("change");
                        	}
                        	else {
                        		$("#expert").html(`<option disabled value="">no experts</option>`).trigger("change");
                        	}
                        },
                        error: function (jqXHR, exception) {
											  }
									});
    	}

    // validate signup form on keyup and submit
		$("#update_assigned_info").validate({
			ignore: [],  // ignore NOTHING

			rules: {
		    'teams[]': {
		      required: true
		    },

		    'evaluation_criteria[]': {
		      required: true
		    },

		    'obtain_marks[]': {
		      required: true,
		      min:0
		    }
		  },

			messages: {
			},

			submitHandler: function(form) {

		        let selected_app = $('input:radio.cbox:checked').val();

						let formData =  new FormData(form);

	          formData.append("app", selected_app);

	          $("#sbmitbtn").attr('disabled', true).html('just a moment...');

		        $.ajax({
				            url: "<?php echo e(route('assigned_application_expert')); ?>",
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
	                                if (response.status == 'success') {
	                                	location.href = `<?php echo e(route('six_g_user.index')); ?>`;
	                                } else {
	                                	alert('Something went wrong. Try again');
	                                	$("#sbmitbtn").removeAttr('disabled').html('Submit');
	                                }
                            },
                            error: function (jqXHR, exception) {
                            	if (jqXHR?.responseJSON?.errors)
	                        			{
	                        			 	let validation = '<ul class=\'err\'>';
	                        			 	for (const [key, value] of Object.entries(jqXHR?.responseJSON?.errors)) 
	                        			 		{
												  						validation += `<li>${value}</li>`;
																		}
		                        			 		validation += `</ul>`;
		                        			 		$("#errors").html(validation);
		                        			 		$("html, body").animate({ scrollTop: 0 }, "slow");
	                        			}
                               		    $("#sbmitbtn").removeAttr('disabled').html('Submit');
                                      alert('Something went wrong!');
                            }
		       		  });
		    }
		});
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/six_g_user/index.blade.php ENDPATH**/ ?>