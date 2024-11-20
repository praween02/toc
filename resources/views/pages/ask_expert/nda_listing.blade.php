@extends('layouts.app')
@section('title', ' - NDA Listing')
@section('content')
<style>
.paginate_button{padding:0 3px}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">

		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('NDA Listing') }}</h3></div>
		            	</div>

		            	<table class="table table-bordered" id="nda-datatable">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Expert</th>
						      <th scope="col">NDA (Non-Disclosure Agreement)</th>
						      <th scope="col">Upload Date/Time</th>
						    </tr>
						  </thead>
						  <tbody>
						  	@forelse($nda_listing as $list)
						    <tr>
						      <th scope="row">{{ $loop->iteration }}</th>
						      <td>{{ $list->first_name }}</td>
						      <td><a download target="_blank" href="{{ url('storage/uploads/' . $list->nda_agreement) }}">{{ $list->nda_agreement }}</a></td>
						      <td>{{ date('D, j M\'y H:i:s', strtotime($list->nda_upload_date_time)) }}</td>
						    </tr>
						     @empty
						      <tr><td colspan="4">No data!</td></tr>
						    @endforelse
						  </tbody>
						</table>
		            </div>
		        </div>
		    </div>

		</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#nda-datatable').DataTable();
    });
</script>
@endpush