@extends('layouts.app')
@section('title', ' - Vendors')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('app.vendors') }}</h3></div>
		            	</div>

		                {{ $dataTable->table(['class' => 'table table-bordered']) }}
		            </div>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>

<!-- Modal-->
<div id="modalBox"></div>
<!-- Close -->
@endsection

@push('scripts')
    @include('sections.datatable_js')

    <script>
	    let is_del = {{ in_array('admin_view', get_roles()) ? 0 : 1 }};
            async function getVendorInstitute(id = '') {

                let vendorInstRoute = "{{ route('vendor.institutes')}}";
                vendorInstRoute = `${vendorInstRoute}?id=${id}`;

                let html = `<div class='modal fade show' id='popModal_${id}' tabindex='-1' role='dialog' aria-labelledby='popModalLabel' aria-hidden='true'>
                                <div class='modal-dialog' role='document' style="max-width:93%">
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='popModalLabel'><strong>Assigned Institutes</strong> </h5>
                                            <button type='button' class='btn btn-danger close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>
                                        <div class='modal-body inst'>
                                            <table class='table'>
                                                <thead>
                                                    <tr>
                                                        <th scope='col'>#</th>
                                                        <th scope='col'>Zone</th>
                                                        <th scope='col'>Institute</th>
                                                        <th scope='col'>Assigned at</th>
                                                        <th scope='col'>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="inst_listing">
                                                    <tr><td colspan='5'>just a moment...</tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                $(`#modalBox`).html(html);
                $(`#popModal_${id}`).modal('show');

                const response = await fetch(vendorInstRoute);
                const resp = await response.json();

                let htm = '';
                if (resp.institutes.length > 0)
                    {
                        let s = 0;
                        $.each(resp.institutes, function (a, b) {
                            s += 1;
                            htm += `<tr>
                                            <td scope='col'>${s}</td>
                                            <td scope='col'>${b.zone}</td>
                                            <td scope='col'>${b.institute}</td>
                                            <td scope='col'>${new Date(b.created_at)}</td>
					    <td scope='col'>${is_del ? "<button onClick=\"trash('${b.random_id}')\" class=\"btn btn-xs btn-danger\"><i class=\"fa fa-trash\"></i></button>" : "N/A"}</td>
                                     </tr>`;
                        });
                    }
                else
                    {
                            htm += `<tr>
                                        <td colspan="5">No data!</td>
                                     </tr>`;
                    }
                $(`#inst_listing`).html(htm);
            }

    function trash(random_id) {
        if (confirm('Are you sure you want to delete this data ?')) {
            alert(random_id);
        }
    }
    </script>
@endpush
