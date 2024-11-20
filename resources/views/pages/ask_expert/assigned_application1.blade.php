@extends('layouts.app')
@section('title', ' - Equipments')
@section('content')
<style>
	.container{border:1px dashed #ddd;border-radius:10px;padding:10px}
	input[type="text"]:disabled {background:#ddd}
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body">

		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ __('Assigned Applications') }}</h3></div>
		            		<div class="col-md-6">
		            		    @php
		            		    	$check_record_exist = \App\Models\AskExpertDetail::where('user_id', current_user_id())->count();
		            		    @endphp

		            		    @if(empty($check_record_exist) && ( ! in_array('super_admin', get_roles())))
		            				<a href="{{ route('expert_user') }}"><button class="btn btn-primary float-end">Apply Expert</button></a>
		            			@endif
		            		</div>
		            	</div>

	                	<table class="table table-bordered">
						  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">User Name</th>
							      <th scope="col">Organization Name</th>
							      <th scope="col">Nodal Contact Person</th>
							      <th scope="col">Designation</th>
							      <th scope="col">Contact No</th>
							      <th scope="col">Email Id </th>
							      <th scope="col">Action</th>
							    </tr>
						  </thead>
						  <tbody>
						    @forelse($assigned_application as $application)
						       <tr>
						       	   <td>{{ $loop->iteration }}</td>
						       	   <td>{{ $application->name }}</td>
						       	   <td>{{ $application->organization_name }}</td>
						       	   <td>{{ $application->nodal_contact_person }}</td>
						       	   <td>{{ $application->designation }}</td>
						       	   <td>{{ $application->contact_no }}</td>
						       	   <td>{{ $application->email_id }}</td>
						       	   <td class="d-flex"><a title="Evaluation Criteria" href="javascript:void(0)" onClick="showPop('{{ encrypt($application->id) }}')" class="btn-xs btn-primary"><i class="mdi  mdi-book-edit-outline"></i></a>&nbsp;<a href="{{ route('six_g_user.show', Crypt::encryptString($application->id)) }}" class="btn-xs btn-primary"><i class="fa fa-eye"></i></a></td>
						       </tr>
						    @empty
						        <tr><td colspan="5">No any assigned application!</td></tr>
						    @endforelse
						  </tbody>
						</table>

						<ul class="pagination"> 
							{{ $assigned_application->links() }}
						</ul>

		            </div>

		            <!-- Modal -->
						<div class="modal fade" id="evaluateFormModal" tabindex="-1" aria-labelledby="evaluateFormModallLabel" aria-hidden="true">
						  <div class="modal-dialog">

						  	<form name="evaluation_criteria_obtain_marks" id="evaluation_criteria_obtain_marks" method="POST">
							   @csrf
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Evaluation Criteria</h5>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							      </div>
							      <div class="modal-body" style="max-height:400px;overflow-y:scroll;">
									    <table class="table table-bordered">
										  <thead>
										    <tr>
										      <th scope="col">#</th>
										      <th scope="col">Evaluation Criteria List </th>
										      <th scope="col">Max. Marks</th>
										      <th scope="col">Obtain Marks</th>
										    </tr>
										  </thead>
										  <tbody class="evaluation_criteria"></tbody>
										</table>
							      </div>
							      <div class="modal-footer">
							      	<button type="submit" class="btn btn-primary">Update</button>
							        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							      </div>
							    </div>
							</form>

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
	<script src="{{ asset('assets/js/jquery.validate.min.js?v=1.0') }}"></script>
    <script>
    	let appid;

	    $("#evaluation_criteria_obtain_marks").validate({
				ignore: [],  // ignore NOTHING
				rules: {
						    'max_marks[]': {
						      		required: true,
						      		min:0,
						      		max:100
						    },
						},

				messages: {

				},

				submitHandler: function(form) {

				    let formData =  new FormData(form);
				    let _token = $('meta[name="csrf-token"]').attr('content');
		            formData.append("_token", _token);
		            $("#sbmitbtn").attr('disabled', true).html('just a moment...');
			        $.ajax({
					            url: "{{ route('application_evaluation_marks_criteria') }}",
	                            type: "POST",    
	                            data: formData,
	                            processData: false,
	                            contentType: false,
	                            success: function(response) {
	                            	if (response.status == "success") {
	                            		location.href = location.href;
	                            	}
	                            },
	                            error: function (jqXHR, exception) {

	                            }
			       		  });
			        return false;
			    }
		});

    	function showPop(app_id) {

    		$('.evaluation_criteria').html("<tr><td colspan='4'>Just a moment...</td></tr>");

    		$.ajax({
			            url: "{{ route('application_evaluation_criteria') }}",
	                    type: "GET",    
	                    data: {app_id},
	                    dataType: 'json',
	                    success: function(response) {
	                            if (response.status == 'success') 
		                            {
		                            	let htm = '';
		                            	let dis = '';

		                            	if(parseInt(Object.keys(response.app_eval_criteria_marks_obj).length) > 0) {
		                            		$('.modal-footer').addClass('d-none');
		                            		dis = 'disabled';
		                            	}
		                            	
		                            	if (response.records.length > 0)
		                            		 {
		                            		 	$.each(response.records, function(a, b) {
				                            		htm += `<tr>
				                            					<td>${a + 1}</td>
				                            					<td>${b.criteria_list}</td>
				                            					<td>${b.max_marks}</td>
				                            					<td>${dis ? response.app_eval_criteria_marks_obj[b.i] : `<input required class="form-control" autocomplete="off" type="number" min="0" max="100" name="max_marks[${b.id}]" id="" value="" />`}</td>
				                            				</tr>`;
				                            	});
				                            	$('.evaluation_criteria').html(htm);
		                            		 }
		                            	else {
		                            		$('.evaluation_criteria').html("<tr><td colspan='4'>No data.</td></tr>");
		                            		$('.modal-footer').addClass('d-none');
		                            	}		        
		                            } 
		                        else 
		                        	{
	                            		$('.evaluation_criteria').html('<tr><td colspan=\'4\'>Something went wrong.</td></tr>');
	                            		$('.modal-footer').addClass('d-none');
	                            	}
	                    },
	                    error: function (jqXHR, exception) {
	                    	$('.evaluation_criteria').html('Something went wrong.!');
	                    	$('.modal-footer').addClass('d-none');
	                    }
		       	  });
    		$("#evaluateFormModal").modal('show');
    	}
    </script>
@endpush
