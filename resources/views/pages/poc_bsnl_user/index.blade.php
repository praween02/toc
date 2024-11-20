@extends('layouts.app')
@section('title', ' - List of Submitted Applications For POC In BSNL')
@section('content')
<style>
	table tr td:first-child{width:20%}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>List of Submitted Applications</h3></div>
		            		<div class="col-md-6">
		            			<button class="btn btn-primary float-end" onclick="window.location = `{{ route('poc_bsnl_user') }}`" {!! count($users) ? 'disabled="disabled"' : '' !!}>
		            				{!! count($users) ? 'Submitted' : 'Apply Form' !!}
		            			</button>
		            		</div>
		            	</div>

		            	<table id="poc_bsnl" class="table table-striped table-bordered">
					        <thead>
					            <tr>
					                <th>Company Name</th>
					                <th>CIN Number</th>
					                <th>Name</th>
					                <th>Contact No</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@forelse($users as $user)
						            <tr>
						                <td>{{ $user->company_name }}</td>
						                <td>{{ $user->cin_number }}</td>
						                <td>{{ $user->name }}</td>
						                <td>{{ $user->contact_no }}</td>
						                <td class=""><a style="cursor:pointer" title="View Details" onClick="application_summary({{ $user->id }})"><i class="fa fa-eye">&nbsp;</i></td>
						            </tr>
						        @empty
						        @endforelse
					        </tbody>
					        <tfoot>
					            <tr>
					                <th>Company Name</th>
					                <th>CIN Number</th>
					                <th>Name</th>
					                <th>Contact No</th>
					                <th>Action</th>
					            </tr>
					        </tfoot>
					    </table>


		            </div>

					<!-- Modal -->
					<div class="modal fade" id="appFormModal" tabindex="-1" aria-labelledby="appFormModallLabel" aria-hidden="true">
					  <div class="modal-dialog modal-fullscreen-xxl-down">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Application Details</h5>
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <div class="modal-body">
					        <table class="table table-striped table-bordered" style="border-radius:25px">
							  <thead>
							  </thead>
							  <tbody id="app_data">
							  </tbody>
							</table>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- close -->

		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
	new DataTable('#poc_bsnl');
</script>
    <script>
    	function application_summary(react_id) {
    		const origin  = "{{ url('storage/poc_bsnl/') }}";
    		$('#appFormModal').modal('show');
    		let html = '';
    		$.ajax({  
						url: "{{ route('poc_bsnl_user.show') }}?react_id=" + react_id,  
						type: 'GET', 
						dataType: 'json', 
						beforeSend: function() {
					        $("#app_data").html(`<center>just a moment...</center>`);   
					    },
					  	success: function(data) { 
					  	    const { response, status, path } = data; 
					    	if (status == 'success') {
					    			html = `<tr>
										      <td><strong>Company/Firm Name</strong></th>
										      <td>${response.company_name}</td>
										    </tr>
										    <tr>
										      <td><strong>CIN Number</strong></td>
										      <td>${response.cin_number}</td>
										    </tr>
										    <tr>
										      <td><strong>Registered Office Address</strong></th>
										      <td>${response.regd_office_address}</td>
										    </tr>
										    <tr>
										      <td><strong>Corporate Office Address</strong></th>
										      <td>${response.corp_office_address}</td>
										    </tr>
										    <tr>
										      <td><strong>Company/Firm Website</strong></th>
										      <td>${response.company_website}</td>
										    </tr>
										    <tr>
										      <td><strong>Whether the applicant is a Startup or Micro or Small Enterprise (MSE)</strong></th>
										      <td>${response.mse_type} <br /><a title="click here to download" target="_blank" download href='${path}${response.mse_certificate}'><i class="mdi mdi-link-variant"></i> ${response.mse_certificate}</a></td>
										    </tr>
										    <tr>
										      <td><strong>Name</strong></th>
										      <td>${response.name}</td>
										    </tr>
										    <tr>
										      <td><strong>Designation</strong></th>
										      <td>${response.designation}</td>
										    </tr>
										    <tr>
										      <td><strong>Contact Number</strong></th>
										      <td>${response.contact_no}</td>
										    </tr>
										    <tr>
										      <td><strong>Email ID</strong></th>
										      <td><i class="mdi mdi-email" aria-hidden="true"></i> ${response.email_id}</td>
										    </tr>
										    <tr>
										      <td><strong>DD/Banker's Cheque Number</strong></th>
										      <td>${response.cheque_no}</td>
										    </tr>
										    <tr>
										      <td><strong>Amount</strong></th>
										      <td><i class="mdi mdi-currency-inr"></i> ${response.amount}</td>
										    </tr>
										    <tr>
										      <td><strong>Date of Issue</strong></th>
										      <td><i class="mdi mdi-calendar-blank" aria-hidden="true"></i> ${response.issue_date}</td>
										    </tr>
										    <tr>
										      <td><strong>Name of Issuing Branch & Bank</strong></th>
										      <td><i class="mdi mdi-bank" aria-hidden="true"></i> ${response.issue_branch}</td>
										    </tr>
										    <tr>
										      <td><strong>Payment Mode</strong></th>
										      <td>${response.payment_mode == 'dd' ? 'DD/Banker\'s Cheque' : 'Online (RTGS/NEFT)'}</td>
										    </tr>
										    <tr>
										      <td><strong>Product/Solution Name</strong></th>
										      <td>${response.solution_name}</td>
										    </tr>
										    <tr>
										      <td><strong>Which part of the telecom network is the Product/Solution designed for</strong></th>
										      <td>${response.solution_designed_for}</td>
										    </tr>
										    <tr>
										      <td><strong>Name of standard/specification to which the product/solution complies to</strong></th>
										      <td>${response.solution_compiles_to}</td>
										    </tr>
										    <tr>
										      <td><strong>Is there any similar product/solution already available in the market? If yes, information on sources may be provided</strong></th>
										      <td>${response.solution_source}</td>
										    </tr>
										    <tr>
										      <td><strong>If there is no similar product/solution already available in the market, how will your product/solution add value to the telecom industry</strong></th>
										      <td>${response.solution_telecom}</td>
										    </tr>
										    <tr>
										      <td><strong>Approximate time period required for complete PoC testing</strong></th>
										      <td>${response.solution_testing}</td>
										    </tr>
										    <tr>
										      <td><strong>Whether the applicant is a Startup or Micro or Small Enterprise (MSE)</strong></th>
										      <td>${response.solution_mse_type} <br /><a title="click here to download" target="_blank" download href='${path}${response.solution_mse_certificate}'><i class="mdi mdi-link-variant"></i> ${response.solution_mse_certificate}</a></td>
										    </tr>
										    <tr>
										      <td><strong>Power (Voltage)</strong></th>
										      <td>${response.bsnl_voltage}</td>
										    </tr>
										     <tr>
										      <td><strong>Power (Current)</strong></th>
										      <td>${response.bsnl_current}</td>
										    </tr>
										     <tr>
										      <td><strong>Space (dimensions and any special requirements)</strong></th>
										      <td>${response.bsnl_space}</td>
										    </tr>
										     <tr>
										      <td><strong>Transmission Port</strong></th>
										      <td>${response.bsnl_port}</td>
										    </tr>
										     <tr>
										      <td><strong>Bandwidth</strong></th>
										      <td>${response.bsnl_bandwidth}</td>
										    </tr>
										     <tr>
										      <td><strong>Preferred PoC Testing Location</strong></th>
										      <td>${response.bsnl_testing_location}</td>
										    </tr>
										     <tr>
										      <td><strong>Any Other Requirement</strong></th>
										      <td>${response.requirements}</td>
										    </tr>
										     <tr>
										      <td><strong>Signature</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}${response.signature}'><img src="${path}${response.signature}" width="70" alt="Signature" /></a></td>
										    </tr>
										     <tr>
										      <td><strong>Certificate of Incorporation</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}${response.cert_incorporation}'><i class="mdi mdi-link-variant"></i> ${response.cert_incorporation}</a></td>
										    </tr>
										     <tr>
										      <td><strong>Self-declaration - Relevant Standards</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}${response.cert_self_declaration}'><i class="mdi mdi-link-variant"></i> ${response.cert_self_declaration}</a></td>
										    </tr>
										    <tr>
										      <td><strong>Self-declaration - Lab Tests</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}${response.cert_self_declaration_lab}'><i class="mdi mdi-link-variant"></i> ${response.cert_self_declaration_lab}</a></td>
										    </tr>
										    <tr>
										      <td><strong>Draft Test Schedule</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}${response.cert_draft}'><i class="mdi mdi-link-variant"></i> ${response.cert_draft}</a></td>
										    </tr>
										    <tr>
										      <td><strong>Undertaking - Ownership</strong></th>
										      <td><a title="click here to download" target="_blank" download href='${path}${response.cert_ownership}'><i class="mdi mdi-link-variant"></i> ${response.cert_ownership}</a></td>
										    </tr>`;
					    	} else {
					    			html = `<center>${response}</center>`;
					    	}
					    			$("#app_data").html(html);            
					  	},
					  	error: function(data) {
					  		$("#app_data").html(`<center>oops.. something went wrong. try again !</center>`); 
					  	}
				  });
    	}
    </script>
@endpush
