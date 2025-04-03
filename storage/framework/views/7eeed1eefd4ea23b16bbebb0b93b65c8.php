<?php $__env->startSection('title', ' - Add System Document'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
<style>
    .ck-editor__editable {
        min-height: 150px;
    }
</style>
<div class="content-page">
<?php if(in_array('institute', get_roles()) || in_array('super_admin', get_roles())): ?>
    <div class="content">
        <!-- Start Content-->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="errors"></div>

                            <!-- Upload Document Form -->
                            <div class="row jumbotron box8">
                                <div class="tab-content" id="nav-tabContent">
                                    
                                    <!-- Upload Document Tab -->
                                   
                                        <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="<?php echo e(route('system_manual.store')); ?>" enctype="multipart/form-data" id="form-uat">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <input type="hidden" name="type" value="4">
                                                            <div class="mb-3">
                                                                <label for="document_title_3" class="form-label"><?php echo e(__('Document Title')); ?> <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_3" placeholder="<?php echo e(__('Document Title')); ?>" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="date_3" class="form-label"><?php echo e(__('Signature Date')); ?> <span class="req">*</span></label>
                                                                <input type="date" name="date" autocomplete="off" class="form-control" id="date_3"  required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_description_3" class="form-label"><?php echo e(__('Document Description')); ?> </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_3" placeholder="<?php echo e(__('Document Description')); ?>"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_3" class="form-label"><?php echo e(__('Document File')); ?> <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_3" placeholder="<?php echo e(__('Document File')); ?>" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="no_of_page_3" class="form-label"><?php echo e(__('No of page')); ?> <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_3" placeholder="<?php echo e(__('No of Document')); ?>" required min="1">
                                                                <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-uat">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/system_manual/uatSignatureCreate.blade.php ENDPATH**/ ?>