@extends('layouts.app')
@section('title', ' - Future Tech Expert Summary')
@section('content')
<style>
	tbody, td, tfoot, th, thead, tr{width:50%}
	.form-group{margin-bottom:15px;}
	label{margin-bottom:10px}
	.expert label{font-weight:bold}
	.expert input { readonly }

	.form-control:disabled, .form-control[readonly] {
	  background-color:#f9f9f9;
	  border:1px dotted #ddd
	}

</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card">
		            <div class="card-body expert_summary" style="padding-left:25px;">
		            	<div class="row">
		            		<div class="col-md-6 float-left"><h3>{{ ucwords($user->first_name) }}'s {{ __('Summary') }}</h3><br /></div>
		            	</div>

		            		<div class="row expert">

								   <!-- 1. -->

								      <div class="col-sm-6 form-group">
								         <label for="">Family Name </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->family_name ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="lname">First Name</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->first_name ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="gender">Gender </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->gender ? ($user->gender == 'M' ? 'Male' : 'Female') : 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="position">Position </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->position ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="current_organization">Current Organization</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->current_organization ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="affiliations_certifications">Affiliations/Certifications</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->affiliations_certifications ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="nationality">Nationality </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->nationality ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="date-of-issue">Date of graduation</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->graduation_date ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="official_email">Email address (Official) </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->official_email ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="personal_email">Additional Email address(personal) </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->personal_email ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="address">Address</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->address ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="country">Country</label>
								          <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->country ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="state">State</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->state ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="city">City</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->city ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="post_code">Post Code</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->post_code ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="whether_have_oci">Whether have OCI  </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->whether_have_oci ?? 'N/A' }}" />
								      </div>

								      <div class="col-sm-6 form-group">
								         <label for="tel_mobile">Tel. Mobile </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->tel_mobile ?? 'N/A' }}" />
								      </div>

								      <div class="col-sm-6 form-group">
								         <label for="fax_prof">Mobile No.</label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->fax_prof ?? 'N/A' }}" />
								      </div>
								   </div>
								   <!-- 2. -->

								   <div class="row">

								      <div class="col-sm-12 mt-3 mb-4">
								         <h5>Area of Expertise</h5>
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="payment-mode">Activity </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->activity ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-6 form-group">
								         <label for="level">Level </label>
								         <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->level ?? 'N/A' }}" />
								      </div>
								      <div class="col-sm-12 form-group">
								         <label for="enterpriseInfo">Curriculum Vitae </label>
								         <div class="input-group">
								            <a href="{{ $path }}{{ $user->cv }}" target="_blank" download="">{{ $user->cv ?? 'N/A' }}</a>
								         </div>
								      </div>
								      <div class="col-sm-12">
								         <div class="form-group">
								            <label for="enterpriseInfo">ID details/Passport for foreign Resident</label>
								            <div class="input-group">
								               <a href="{{ $path }}{{ $user->id_proof_document }}" target="_blank" download="">{{ $user->id_proof_document ?? 'N/A' }}</a>
								            </div>
								         </div>
								      </div>
								      <div class="col-sm-12">
								         <div class="form-group">
								            <label for="enterpriseInfo"> Photograph</label>
								            <div class="input-group">
								               <!--<img src="data:image/png;base64,{{ @base64_encode(@file_get_contents($path . $user->photograph)) }}" alt="" width="120" />-->
												<img src="data:image/png;base64,{{ @base64_encode(@file_get_contents($path . $user->photograph, false, stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]))) }}" alt="" width="120" />
								            </div>
								         </div>
								         <div class="form-group">
								            <label for="">Web  page / linked / personal web page </label>
								            <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->web_page ?? 'N/A' }}" />
								         </div>
								         <div class="form-group">
								            <label for="">No of hours per week you can dedicate</label>
								            <input type="text" autocomplete="off" class="form-control" readonly value="{{ $user->no_hours ?? 'N/A' }}" />
								         </div>
								      </div>
								    </div>
								   <!-- Circles which indicates the steps of the form: -->
								   
								</div>




 			            	<!-- <table id="expert" class="d-none table table-striped table-bordered">

						        <tbody>
						            <tr>
						                <td>Family Name</td>
						                <td>{{ $user->family_name ?? 'N/A' }}</td>
						            </tr>

						            <tr>
						                <td>First Name</td>
						                <td>{{ $user->first_name ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Gender</td>
						                <td>{{ $user->gender ?? 'N/A' }}</td>
						            </tr>

						            <tr>
						                <td>Position</td>
						                <td>{{ $user->position ?? 'N/A' }}</td>
						            </tr>

						            <tr>
						                <td>Current Organization</td>
						                <td>{{ $user->current_organization ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Affiliations/Certifications</td>
						                <td>{{ $user->affiliations_certifications ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Nationality</td>
						                <td>{{ $user->nationality ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Date of birth</td>
						                <td>{{ $user->graduation_date ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Email address official</td>
						                <td>{{ $user->official_email ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Additional Email address(personal)</td>
						                <td>{{ $user->personal_email ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Address</td>
						                <td>{{ $user->address ?? 'N/A'  }}</td>
						            </tr>


						            <tr>
						                <td>Country</td>
						                <td>{{ $user->country ?? 'N/A'  }}</td>
						            </tr>


						            <tr>
						                <td>State</td>
						                <td>{{ $user->state ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>City</td>
						                <td>{{ $user->city ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Post Code</td>
						                <td>{{ $user->post_code ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Whetder have OCI</td>
						                <td>{{ $user->whether_have_oci ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Telephone</td>
						                <td>{{ $user->tel_prof ?? 'N/A'  }}</td>
						            </tr>


						            <tr>
						                <td>Area of Expertise</td>
						                <td>{{ $user->activity ?? 'N/A'  }}</td>
						            </tr>


						            <tr>
						                <td>Level</td>
						                <td>{{ $user->level ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Curriculum Vitae </td>
						                <td>{{ $user->cv ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>ID details/Passport for foreign Resident</td>
						                <td>{{ $user->id_proof_document ?? 'N/A'  }}</td>
						            </tr>

						            <tr>
						                <td>Photograph</td>
						                <td><img src="data:image/png;base64,{{ @base64_encode(@file_get_contents($user->photograph  ?? 'N/A' )) }}" alt="" width="120" /></td>
						            </tr>

						            <tr>
						                <td>Web  page / linked / personal web page</td>
						                <td>{{ $user->web_page ?? 'N/A'  }}</td>
						            </tr>


						            <tr>
						                <td>No of hours per week you can dedicate</td>
						                <td>{{ $user->no_hours ?? 'N/A'  }}</td>
						            </tr>					            

						        </tbody>
						    </table>  -->
		          
		            </div>
		            <button type="button" class="btn btn-primary" onclick="getPDF('.expert_summary')" id="pdf">DOWNLOAD PDF</button>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>
@endsection

@push('scripts')
<script src="https://kendo.cdn.telerik.com/2017.1.223/js/kendo.all.min.js?v=1.0.0"></script>
<script>
	function getPDF(selector) {
		kendo.drawing.drawDOM($(selector)).then(function(group){
          kendo.drawing.pdf.saveAs(group, "download.pdf");
        });
	}
</script>
@endpush