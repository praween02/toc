<?php $__env->startSection('title', ' - Ask Expert'); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
   small{font-size:10px;color:#958d46;letter-spacing:0.4px}
   .datepicker-days table tr td { text-align:center;cursor:pointer; }
   ul.err li {color:#ff0000;}  
</style>
<div class="content-page">
   <div class="content">
      <!-- Start Content-->
      <div class="container">
         <!-- Form row -->
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">

                     <form id="expert-form" enctype="multipart/form-data" class="" action="<?php echo e(route('ask_expert.store')); ?>" accept-charset="utf-8" method="post">
                        <?php echo csrf_field(); ?>

                        <div id="errors"></div>

                        <div class="row">
                           <div class="col-sm-12 mb-3">
                                 <h3 class="text-center text-info text-uppercase">Expert details form</h3>
                           </div>
                        </div>

                        <nav>
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-general-info-tab" data-bs-toggle="tab" data-bs-target="#nav-general-info" type="button" role="tab" aria-controls="nav-general-info" aria-selected="true">General Information</button>

                                <button class="nav-link" id="nav-other-info-tab" data-bs-toggle="tab" data-bs-target="#nav-other-info" type="button" role="tab" aria-controls="nav-other-info" aria-selected="true">Other Information</button>

                              </div>
                        </nav>
                        
                        <div class="" style="padding-top:10px">
                            <p class="mb-0"><span class="req">* </span>= required fields</p>
                        </div>

                        <?php if($errors->any()): ?>
                              <?php echo implode('', $errors->all('<div>:message</div>')); ?>

                        <?php endif; ?>

                        <div class="tab-content" id="nav-tabContent">

                            <div class="mpm-10 tab-pane fade show active" id="nav-general-info" role="tabpanel" aria-labelledby="nav-general-info-tab">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="family_name">Family Name <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" placeholder="Family name" name="family_name" id="family_name" value="<?php echo e(old('family_name')); ?>">
                                      <?php if($errors->has('family_name')): ?>
                                         <p class="req"><?php echo e($errors->first('family_name')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="first_name">First Name <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" id="first_name" placeholder="First name" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                      <?php if($errors->has('first_name')): ?>
                                         <p class="req"><?php echo e($errors->first('first_name')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="gender">Gender <span class="req">*</span></label>
                                      <select class="form-control" id="gender" name="gender">
                                         <option <?php echo e(old('gender') == "M" ? "selected" : ""); ?> value="M">M</option>
                                         <option <?php echo e(old('gender') == "F" ? "selected" : ""); ?> value="F">F</option>
                                      </select>
                                      <?php if($errors->has('gender')): ?>
                                         <p class="req"><?php echo e($errors->first('gender')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="position">Position <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" placeholder="Position" name="position" value="<?php echo e(old('position')); ?>" id="position" />
                                      <?php if($errors->has('position')): ?>
                                         <p class="req"><?php echo e($errors->first('position')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="current_organization">Current Organization <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" placeholder="Current Organization" name="current_organization" value="<?php echo e(old('current_organization')); ?>" id="current_organization">
                                      <?php if($errors->has('current_organization')): ?>
                                         <p class="req"><?php echo e($errors->first('current_organization')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="affiliations_certifications">Affiliations/Certifications <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" name="affiliations_certifications" class="form-control" placeholder="Affiliations/Certifications" value="<?php echo e(old('affiliations_certifications')); ?>" id="affiliations_certifications">
                                      <?php if($errors->has('affiliations_certifications')): ?>
                                         <p class="req"><?php echo e($errors->first('affiliations_certifications')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                      <label for="">Date of Graduation <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="datepicker1 form-control" placeholder="" name="graduation_date" value="<?php echo e(old('graduation_date') != '' ? old('graduation_date') : date('Y-m-d')); ?>" id="graduation_date" />
                                      <?php if($errors->has('graduation_date')): ?>
                                         <p class="req"><?php echo e($errors->first('graduation_date')); ?></p>
                                      <?php endif; ?>
                                    </div>

                                     <div class="col-md-6 mb-3">
                                      <label for="">Email Address Official<span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="official_email" placeholder="Email address official" value="<?php echo e(old('official_email')); ?>" id="official_email" />
                                      <?php if($errors->has('official_email')): ?>
                                         <p class="req"><?php echo e($errors->first('official_email')); ?></p>
                                      <?php endif; ?>
                                    </div>

                                </div>


                                <div class="row">
                                   
                                    <div class="col-md-6 mb-3">
                                      <label for="">Additional Email address(personal) <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="personal_email" placeholder="Additional Email address(personal)" value="<?php echo e(old('personal_email')); ?>" id="personal_email">
                                      <?php if($errors->has('personal_email')): ?>
                                         <p class="req"><?php echo e($errors->first('personal_email')); ?></p>
                                      <?php endif; ?>
                                    </div>

                                     <div class="col-md-6 mb-3">
                                         <label for="">Country <span class="req">*</span></label>
                                         <select class="form-control" name="country" id="country">
                                               <option value="">-- Select --</option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         </select>
                                         <?php if($errors->has('country')): ?>
                                            <p class="req"><?php echo e($errors->first('country')); ?></p>
                                         <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                      <label for="state">State <span class="req">*</span></label>
                                      <select class="form-control" name="state" id="state">
                                         <option>-- Select --</option>
                                      </select>
                                      <?php if($errors->has('state')): ?>
                                         <p class="req"><?php echo e($errors->first('state')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                      <label for="city">City <span class="req">*</span></label>
                                      <select class="form-control" name="city" id="city" />
                                        <option>-- Select --</option>
                                      </select>
                                      <?php if($errors->has('city')): ?>
                                         <p class="req"><?php echo e($errors->first('city')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                      <label for="">Address <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="address" placeholder="Address" value="<?php echo e(old('address')); ?>" id="address" />
                                      <?php if($errors->has('address')): ?>
                                         <p class="req"><?php echo e($errors->first('address')); ?></p>
                                      <?php endif; ?>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label for="">Post Code <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="post_code" placeholder="Post Code" value="<?php echo e(old('post_code')); ?>" id="post_code">
                                      <?php if($errors->has('post_code')): ?>
                                         <p class="req"><?php echo e($errors->first('post_code')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="">Whether have OCI <span class="req">*</span></label>
                                      <select class="form-control" id="whether_have_oci" name="whether_have_oci" id="whether_have_oci">
                                         <option value="yes" <?php echo e(old() == "yes" ? "selected" : ""); ?>>Yes</option>
                                         <option value="no" <?php echo e(old() == "no" ? "selected" : ""); ?>>No</option>
                                      </select>
                                      <?php if($errors->has('whether_have_oci')): ?>
                                         <p class="req"><?php echo e($errors->first('whether_have_oci')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="">Telephone <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="telephone" placeholder="Telephone" value="<?php echo e(old('telephone')); ?>" id="telephone">
                                      <?php if($errors->has('tel_prof')): ?>
                                         <p class="req"><?php echo e($errors->first('tel_prof')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="">Tel. Mobile <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="tel_mobile" placeholder="Tel. Mobile" value="<?php echo e(old('tel_mobile')); ?>" id="tel_mobile">
                                      <?php if($errors->has('tel_mobile')): ?>
                                         <p class="req"><?php echo e($errors->first('tel_mobile')); ?></p>
                                      <?php endif; ?>
                                    </div>

                                   <div class="col-md-6 mb-3">
                                      <label for="">Fax Prof </label>
                                      <input type="text" autocomplete="off" class="form-control" name="fax_prof" placeholder="Fax Prof" value="<?php echo e(old('fax_prof')); ?>" id="fax_prof">
                                      <?php if($errors->has('fax_prof')): ?>
                                         <p class="req"><?php echo e($errors->first('fax_prof')); ?></p>
                                      <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                      <button onclick="$('#expert-form .nav-tabs button#nav-other-info-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                    </div>
                                </div>
                        </div>

                        <div class="mpm-10 tab-pane fade" id="nav-other-info" role="tabpanel" aria-labelledby="nav-other-info-tab">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label for="">Area of Expertise </label>
                                  <select class="form-control" name="activity" id="activity">
                                        <option value="">-- Select --</option>
                                    <?php $__currentLoopData = $expertises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($expertise->id); ?>"><?php echo e($expertise->expertise); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </select>

				  <input type="text" autocomplete="off" placeholder="Other" name="other" id="other" class="d-none mt-1 form-control" /> 

				  <textarea class="form-control mt-1" id="remarks" name="remarks" placeholder="Please add 'Remarks' If expertise is not listed in the dropdown."></textarea>

                                  <?php if($errors->has('activity')): ?>
                                     <p class="req"><?php echo e($errors->first('activity')); ?></p>
                                  <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="">Level <span class="req">*</span></label>
                                  <select class="form-control" name="level" id="level">
                                     <option <?php echo e(old('level') == "beginner" ? "selected" : ""); ?> value="beginner">Beginner</option>
                                     <option <?php echo e(old('level') == "medium" ? "selected" : ""); ?> value="medium">Medium</option>
                                     <option <?php echo e(old('level') == "expert" ? "selected" : ""); ?> value="expert">Expert </option>
                                  </select>
                                  <?php if($errors->has('level')): ?>
                                     <p class="req"><?php echo e($errors->first('level')); ?></p>
                                  <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label for="">Upload your latest Curriculum Vitae <span class="req">*</span></label>
                                  <input type="file" autocomplete="off" class="form-control" name="cv" placeholder="Upload your latest Curriculum Vitae" accept="application/pdf" id="cv" />
                                  <p style="margin:0px;font-style:italic;"><small>Supported file format: PDF</small></p>
                                  <?php if($errors->has('cv')): ?>
                                     <p class="req"><?php echo e($errors->first('cv')); ?></p>
                                  <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="">Any ID details/Passport for foreign Resident <span class="req">*</span></label>
                                  <p style="margin-bottom:3px" class="d-flex">
                                     <input autocomplete="off" style="width:50%;" type="text" class="form-control" name="id_number" placeholder="Enter Id Number" value="<?php echo e(old('id_number')); ?>" id="id_number">&nbsp;<input type="file" style="width:50%;" class="form-control" id="id_proof_document" name="id_proof_document" accept="application/pdf" />
                                  </p>

                                  <p style="margin:0px;text-align:right;font-style:italic;"><small>Supported file format: PDF</small></p>
                                  <?php if($errors->has('id_proof_document')): ?>
                                     <p class="req"><?php echo e($errors->first('id_proof_document')); ?></p>
                                  <?php endif; ?>
                                </div>  

                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label for="">Upload the Photograph <span class="req">*</span></label>
                                  <input autocomplete="off" style="margin-bottom:3px" type="file" class="form-control" name="photograph" placeholder="Upload the Photograph" accept="image/*" id="photograph" />
                                  <p style="margin:0px;font-style:italic;"><small>Supported file formats: JPG, JPEG, PNG, GIF</small></p>
                                  <?php if($errors->has('photograph')): ?>
                                     <p class="req"><?php echo e($errors->first('photograph')); ?></p>
                                  <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="">Web page / linked / personal web page <span class="req">*</span></label>
                                  <input autocomplete="off" type="text" class="form-control" name="web_page" placeholder="Full Url (Web page / linked / personal web page)" value="<?php echo e(old('web_page')); ?>" id="web_page" />
                                  <?php if($errors->has('web_page')): ?>
                                     <p class="req"><?php echo e($errors->first('web_page')); ?></p>
                                  <?php endif; ?>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3 text-left">
                                  <button onclick="$('#expert-form .nav-tabs button#nav-general-info-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous </button>
                                </div>

                                <div class="col-md-6 mb-3 text-right" style="text-align:right;">
                                  <input type="submit" class="btn btn-primary" id="sbmitbtn" name="sbmitbtn" value="Submit" />
                                </div>
                            </div>
                        </div>


                       </div>

                     </form>

                  </div>
                  <!-- end card-body -->
               </div>
               <!-- end card-->
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js?v=1.0')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.validate.min.js?v=1.0')); ?>"></script>
<script src="<?php echo e(asset('assets/js/expert-user-validation.js?v=' . rand(111111,999999))); ?>"></script>
<script>
   $(document).ready(function() {
       $(`.datepicker1`).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
   });
 </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\projects\dot\resources\views/pages/ask_expert/create.blade.php ENDPATH**/ ?>