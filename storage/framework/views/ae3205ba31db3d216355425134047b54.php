<?php $__env->startSection('title', ' - Equipments'); ?>
<?php $__env->startSection('content'); ?>
<div class="content-page">
    <div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="card-title"><?php echo e(__('app.list_of_equipments')); ?></h4>
                            <a href="<?php echo e(route('equipment-list.create')); ?>" class="btn btn-primary">
                                <i class="fe-plus"></i> Add New Equipment
                            </a>
                        </div>

                        <?php if($message = Session::get('success')): ?>
                        <div class="alert alert-success">
                            <p><?php echo e($message); ?></p>
                        </div>
                        <?php endif; ?>

                        <!-- Institute Filter Dropdown -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form action="<?php echo e(route('equipment-list.index')); ?>" method="GET">
                                    <div class="input-group">
                                        <select name="institute_id" class="form-control" id="institute-filter" <?php echo e(isset($userIsInstitute) && $userIsInstitute ? 'disabled' : ''); ?>>
                                            <option value="">All Institutes</option>
                                            <?php $__currentLoopData = $institutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $institute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($institute->id); ?>" 
                                                    <?php echo e((isset($instituteId) && $instituteId == $institute->id) ? 'selected' : ''); ?>>
                                                    <?php echo e($institute->institute); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" <?php echo e(isset($userIsInstitute) && $userIsInstitute ? 'disabled' : ''); ?>>Filter</button>
                                        </div>
                                    </div>
                                    
                                    <?php if(isset($userIsInstitute) && $userIsInstitute): ?>
                                        <small class="text-muted">You are viewing equipment for your institute only.</small>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Equipment Name</th>
                                        <th>Model No</th>
                                        <th>Date</th>
                                        <th>Running Time</th>
                                        <th>Institute</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $equipmentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($equipment->id); ?></td>
                                        <td><?php echo e($equipment->equipment_name); ?></td>
                                        <td><?php echo e($equipment->model_no); ?></td>
                                        <td><?php echo e($equipment->date); ?></td>
                                        <td><?php echo e($equipment->running_time); ?></td>
                                        <td><?php echo e($equipment->institute->institute ?? 'N/A'); ?></td>
                                        <td>
                                            <form action="<?php echo e(route('equipment-list.destroy', $equipment->id)); ?>" method="POST">
                                                <a class="btn btn-info btn-sm" href="<?php echo e(route('equipment-list.show', $equipment->id)); ?>">
                                                    <i class="fe-eye"></i> View
                                                </a>
                                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('equipment-list.edit', $equipment->id)); ?>">
                                                    <i class="fe-edit"></i> Edit
                                                </a>
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this equipment?')">
                                                    <i class="fe-trash-2"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        // Only add auto-submit for non-institute users
        <?php if(!isset($userIsInstitute) || !$userIsInstitute): ?>
            $('#institute-filter').on('change', function() {
                $(this).closest('form').submit();
            });
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Deepak\Desktop\toc\resources\views/pages/equipment-list/index.blade.php ENDPATH**/ ?>