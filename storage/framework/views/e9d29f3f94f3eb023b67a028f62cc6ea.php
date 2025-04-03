<?php $__env->startSection('title', ' - Edit System Document'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="<?php echo e(route('system_manual.store', $systemManual->id)); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="type" value="<?php echo e($systemManual->type); ?>">

                                <div class="mb-3" id="equipment_select" style="<?php echo e($systemManual->type == 1 ? '' : 'display: none;'); ?>">
                                    <label for="equipment_id" class="form-label">Products <span class="req">*</span></label>
                                    <select name="equipment_id" class="form-control" id="equipment_id">
                                        <option value="">-- Select --</option>
                                        <?php $__currentLoopData = $equipmentsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($equipment->id); ?>" <?php echo e($systemManual->equipment_id == $equipment->id ? 'selected' : ''); ?>>
                                                <?php echo e($equipment->equipment); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="document_title" class="form-label">Document Title <span class="req">*</span></label>
                                    <input type="text" name="document_title" class="form-control" id="document_title"
                                        value="<?php echo e(old('document_title', $systemManual->document_title)); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Signature Date<span class="req">*</span></label>
                                    <input type="date" name="date" class="form-control" id="date"
                                        value="<?php echo e(old('date', $systemManual->date)); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="document_description" class="form-label">Document Description</label>
                                    <textarea name="document_description" class="form-control" id="document_description"><?php echo e(old('document_description', $systemManual->document_description)); ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="document_file" class="form-label">Document File</label>
                                    <input type="file" accept=".pdf" name="document_file" class="form-control" id="document_file">
                                    <?php if($systemManual->document_file): ?>
                                        <p>Current file: <a href="<?php echo e(asset('storage/' . $systemManual->document_file)); ?>" target="_blank">View</a></p>
                                    <?php endif; ?>
                                    <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="no_of_page" class="form-label">No of Pages <span class="req">*</span></label>
                                    <input type="number" name="no_of_page" class="form-control" id="no_of_page"
                                        value="<?php echo e(old('no_of_page', $systemManual->no_of_page)); ?>" required min="1">
                                        <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/system_manual/uatSignatureEdit.blade.php ENDPATH**/ ?>