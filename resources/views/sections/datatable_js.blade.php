<!-- Datatables -->
<script src="{{ asset('assets/datatables/jquery.dataTables.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/datatables/dataTables.bootstrap4.min.js?v=1.0') }}"></script>
{{-- <script src="{{ asset('assets/datatables/dataTables.responsive.min.js?v=1.0') }}"></script> --}}
{{-- <script src="{{ asset('assets/datatables/responsive.bootstrap.min.js?v=1.0') }}"></script> --}}
<script src="{{ asset('assets/datatables/dataTables.buttons.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/datatables/buttons.bootstrap4.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/datatables/buttons.server-side.js?v=1.0') }}"></script>
{!! $dataTable->scripts() !!}
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

    
</script>