
<?php $__env->startSection('title', ' - Add System Manual'); ?>
<?php $__env->startSection('content'); ?>
<style>
    .ck-editor__editable {
        min-height: 150px;
    }
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"><?php echo e(__('app.ticket')); ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-lg-12 co-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" id="save-ticket-data-form" action="<?php echo e(route('tickets.store')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="mb-3">
                                    <p><span class="req">*</span> = required fields</p>
                                </div>

                                <?php
                                $onchange = '';
                                if(in_array('vendor', get_roles()))
                                $onchange = "onchange=sel_subject(this.value)";
                                ?>

                                <div class="mb-3">
                                    <label for="equipment_id" class="form-label"><?php echo e(__('Products')); ?> <span class="req">*</span></label>
                                    <select name="equipment_id" autocomplete="off" class="form-control" id="equipment_id" placeholder="<?php echo e(__('placeholder.subject')); ?>" <?php echo e($onchange); ?> required>
                                        <option value="">-- Select --</option>
                                        <?php $__currentLoopData = $equipmentsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipmentValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($equipmentValue->id); ?>" <?php echo e(old('equipment_id') == $equipmentValue->id ? 'selected' : ''); ?>>
                                            <?php echo e($equipmentValue->equipment); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </select>



                                </div>




                                <div class="mb-3">
                                    <label for="document_title" class="form-label"><?php echo e(__('Document Title')); ?> <span class="req">*</span></label>
                                    <input name="document_title" autocomplete="off" class="form-control" id="document_title" placeholder="<?php echo e(__('Document Title')); ?>" required>



                                </div>
                                <div class="mb-3">
                                    <label for="document_description" class="form-label"><?php echo e(__('Document Description')); ?> </label>
                                    <textarea name="document_description" autocomplete="off" class="form-control" id="document_description" placeholder="<?php echo e(__('Document Description')); ?>"></textarea>



                                </div>
                                <div class="mb-3">
                                    <label for="document_file" class="form-label"><?php echo e(__('Document File')); ?> <span class="req">*</span></label>
                                    <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file" placeholder="<?php echo e(__('Document File')); ?>" required>



                                </div>
                                <div class="mb-3">
                                    <label for="no_of_page" class="form-label"><?php echo e(__('No of page')); ?> <span class="req">*</span></label>
                                    <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page" placeholder="<?php echo e(__('No of Document')); ?>" required>



                                </div>


                                <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg>Submit</button>

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
<script src="<?php echo e(asset('assets/js/ckeditor.js?v=40.2.0')); ?>"></script>
<script>
    function check_all(ths, cls) {
        $(`.${cls}`).prop('checked', ths.checked);
    }

    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

    function sel_subject(val) {

        // if (val == "equipment_related") {
        //     $("#equipment_box").removeClass('d-none');
        // } else {
        //     $("#equipment_box").addClass('d-none');
        // }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\projects\dot\resources\views/pages/system_manual/create.blade.php ENDPATH**/ ?>