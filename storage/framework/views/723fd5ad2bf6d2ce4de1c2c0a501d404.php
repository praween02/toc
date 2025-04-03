<?php $__env->startSection('title', ' - System Manual'); ?>
<?php $__env->startSection('content'); ?>

<div class="content-page">
    <div class="content">
        <!-- Start Content-->

        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">


                        <?php if(in_array('vendor', get_roles())): ?>
                        <div class="col-md-6 float-left">
                            <h3><?php echo e(__('Upload Document')); ?></h3>
                        </div>
                        <div class="col-md-6 text-end"><a href="<?php echo e(route('system_manual.create')); ?>"
                                class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i
                                    class="fa fa-plus"></i> <?php echo e(__('Upload Document')); ?></a></div>
                        <?php endif; ?>
                        <?php if(in_array('institute', get_roles())): ?>
                        <div class="col-md-6 float-left">
                            <h3><?php echo e(__('View Document')); ?></h3>
                        </div>
                        <div class="col-md-6 text-end"><a href="<?php echo e(route('system_manual.create')); ?>"
                                class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i
                                    class="fa fa-plus"></i> <?php echo e(__('Upload Document')); ?></a></div>
                        <?php endif; ?>
                        <?php if(in_array('super_admin', get_roles())): ?>
                        <div class="col-md-4 float-left">
                            <h3><?php echo e(__('Document')); ?></h3>

                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="<?php echo e(route('system_manual.index')); ?>" enctype="multipart/form-data"
                                id="filterForm">
                                <?php $typeFilter = $_GET['typeFilter'] ?? 0; ?>
                                <select class="form-select" id="typeFilter" name="typeFilter"
                                    onchange="document.getElementById('filterForm').submit();">
                                    <option value="0" selected>All Document</option>
                                    <option value="1" <?= ($typeFilter == '1') ? 'selected' : ''; ?>>System
                                        Manual
                                    </option>
                                    <option value="2" <?= ($typeFilter == '2') ? 'selected' : ''; ?>>Lab Implemention
                                        </option>
                                    <option value="3" <?= ($typeFilter == '3') ? 'selected' : ''; ?>>UAT
                                        Procedure</option>
                                    <option value="4" <?= ($typeFilter == '4') ? 'selected' : ''; ?>>UAT Sign
                                    </option>
                                    <option value="5" <?= ($typeFilter == '5') ? 'selected' : ''; ?>>Receipt of
                                        goods</option>
                                </select>
                            </form>
                            <!-- <button type="button" id="filterBtn">Filter</button>
                            <button type="button" id="resetBtn">Reset</button> -->
                        </div>
                        <div class="col-md-4 text-end"><a href="<?php echo e(route('system_manual.create')); ?>"
                                class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i
                                    class="fa fa-plus"></i> <?php echo e(__('Document')); ?></a>

                            <!-- <a href="<?php echo e(route('system_manual.signature-create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('UAT Signed Document')); ?></a>
								<a href="<?php echo e(route('system_manual.receipt-goods-create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('Receipt of goods Document')); ?></a> -->
                        </div>
                        <?php endif; ?>
                        <!-- <?php if(in_array('institute', get_roles())): ?>

							<div class="col-md-6 float-left"><h3><?php echo e(__('UAT Document')); ?></h3></div>
		            			<div class="col-md-6 text-end"><a href="<?php echo e(route('system_manual.create')); ?>" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> <?php echo e(__('UAT Document')); ?></a></div>
							<?php endif; ?> -->



                        <!-- <?php echo e(ucwords(Auth::user()->id)); ?>  -->


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

    <!-- <script>
$(document).ready(function() {
    var table = $('#system-manuals-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(route('system_manual.list')); ?>", // Correct route
            data: function(d) {
                d.type = $('#typeFilter').val(); // Pass filter value
            }
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'document_title',
                name: 'system_manual.document_title'
            },
            {
                data: 'document_file',
                name: 'system_manual.document_file'
            },
            {
                data: 'no_of_page',
                name: 'no_of_page'
            }
        ]
    });

    $('#typeFilter').change(function() {
        table.draw(); // Refresh table when filter changes
    });

    $('#resetBtn').click(function() {
        $('#typeFilter').val('0'); // Reset dropdown
        table.draw(); // Reload table
    });
});
</script> -->
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u457512262/domains/dssolution.in/public_html/dot/resources/views/pages/system_manual/index.blade.php ENDPATH**/ ?>