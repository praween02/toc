@extends('layouts.app')
@section('title', ' - System Manual')
@section('content')

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">


                        @if(in_array('vendor', get_roles()))
                        <div class="col-md-6 float-left">
                            <h3>{{ __('Upload Document') }}</h3>
                        </div>
                        <div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}"
                                class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i
                                    class="fa fa-plus"></i> {{ __('Upload Document') }}</a></div>
                        @endif
                        @if(in_array('institute', get_roles()))
                        <div class="col-md-6 float-left">
                            <h3>{{ __('View Document') }}</h3>
                        </div>
                        <div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}"
                                class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i
                                    class="fa fa-plus"></i> {{ __('Upload Document') }}</a></div>
                        @endif
                        @if(in_array('super_admin', get_roles()))
                        <div class="col-md-4 float-left">
                            <h3>{{ __('Document') }}</h3>

                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('system_manual.index') }}" enctype="multipart/form-data"
                                id="filterForm">
                                <?php $typeFilter = $_GET['typeFilter'] ?? 0; ?>
                                <select class="form-select" id="typeFilter" name="typeFilter"
                                    onchange="document.getElementById('filterForm').submit();">
                                    <option value="0" selected>All Document</option>
                                    <option value="1" <?= ($typeFilter == '1') ? 'selected' : ''; ?>>System
                                        Manual
                                    </option>
                                    <option value="2" <?= ($typeFilter == '2') ? 'selected' : ''; ?>>UAT
                                        Document</option>
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
                        <div class="col-md-4 text-end"><a href="{{ route('system_manual.create') }}"
                                class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i
                                    class="fa fa-plus"></i> {{ __('Document') }}</a>

                            <!-- <a href="{{ route('system_manual.signature-create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('UAT Signed Document') }}</a>
								<a href="{{ route('system_manual.receipt-goods-create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('Receipt of goods Document') }}</a> -->
                        </div>
                        @endif
                        <!-- @if(in_array('institute', get_roles()))
							<div class="col-md-6 float-left"><h3>{{ __('UAT Document') }}</h3></div>
		            			<div class="col-md-6 text-end"><a href="{{ route('system_manual.create') }}" class="btn-primary f-14 p-2 mr-3 float-right mb-2 mb-lg-0 mb-md-0"><i class="fa fa-plus"></i> {{ __('UAT Document') }}</a></div>
							@endif -->


                        <!-- {{ ucwords(Auth::user()->id) }}  -->
                    </div>



                    {{ $dataTable->table(['class' => 'table table-bordered']) }}
                    <!-- <table id="system-manuals-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Document Title</th>
                                <th>Document File</th>
                                <th>No Of Page</th>
                            </tr>
                        </thead>
                    </table> -->
                </div>
            </div>
        </div>
        <!-- End Content-->
    </div>
</div>
@endsection

@push('scripts')
@include('sections.datatable_js')

<!-- <script>
$(document).ready(function() {
    var table = $('#system-manuals-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('system_manual.list') }}", // Correct route
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
@endpush