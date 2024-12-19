<!-- Datatables -->
<script src="<?php echo e(asset('assets/datatables/jquery.dataTables.min.js?v=1.0')); ?>"></script>
<script src="<?php echo e(asset('assets/datatables/dataTables.bootstrap4.min.js?v=1.0')); ?>"></script>


<script src="<?php echo e(asset('assets/datatables/dataTables.buttons.min.js?v=1.0')); ?>"></script>
<script src="<?php echo e(asset('assets/datatables/buttons.bootstrap4.min.js?v=1.0')); ?>"></script>
<script src="<?php echo e(asset('assets/datatables/buttons.server-side.js?v=1.0')); ?>"></script>
<?php echo $dataTable->scripts(); ?>

<script>
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "inherit" );
    });

    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( "overflow", "auto" );
    })

    $(document).on('click', '.show-details', function() {
        let react_id = $(this).data('react_id');
        $(`#popModal_${react_id}`).modal('show');
    });

    $(document).on('click', '.close', function() {
        let react_id = $(this).data('react_id');
        $(`#popModal_${react_id}`).modal('hide');
    });

    
</script><?php /**PATH D:\wamp64\www\projects\bharat5glab\toc\resources\views/sections/datatable_js.blade.php ENDPATH**/ ?>