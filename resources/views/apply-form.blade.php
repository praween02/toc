@extends('layouts.app')
@section('title', ' - APPLICATION FORM')
@section('content')
<style>
	.col-sm-6,.col-sm-12{margin:15px 0 15px 0}
</style>


        <!--        section_two      -->
       <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">APPLICATION FORM</h4>
								
								@if ($errors->any())
									<div class="alert alert-danger">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif
								
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
									
									
											<form  action="{{ route('apply-form.store') }}" method="post" enctype="multipart/form-data">
												@csrf
												<div class="row jumbotron box8">
													<div class="col-sm-12">
														<h2 class="text-center text-info text-uppercase">Application form for PoC in BSNL</h2>
													</div>
													<!-- 1. -->
													<div class="col-sm-12 mx-t3 mb-4 mt-3">
														<h5>Applicant Details:</h5>
													</div>

													<div class="col-sm-6 form-group">
														<label for="name-f">Company/Firm Name:</label>
														<input type="text" class="form-control" name="company_name" id="name-f"
															placeholder="Enter your company/firm name." value="{{ old('company_name') }}" required>
															@if($errors->has('company_name'))
																		<p class="req">{{ $errors->first('company_name') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="name-l">CIN Number (if applicable)</label>
														<input type="text" class="form-control" name="cin_number" id="name-l"
															placeholder="Enter CIN number if applicable." value="{{ old('cin_number') }}" required>
															@if($errors->has('cin_number'))
																		<p class="req">{{ $errors->first('cin_number') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="registered-address">Registered Office Address</label>
														<textarea class="form-control" name="regd_office_address" id="registered-address"
															placeholder="Enter registered office address." style="color:black"required>{{ old('regd_office_address') }}</textarea>
															@if($errors->has('regd_office_address'))
																		<p class="req">{{ $errors->first('regd_office_address') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="corporate-address">Corporate Office Address</label>
														<textarea class="form-control" name="corp_office_address" id="corporate-address"
															placeholder="Enter corporate office address."  style="color:black" required>{{ old('corp_office_address') }}</textarea>
															@if($errors->has('corp_office_address'))
																		<p class="req">{{ $errors->first('corp_office_address') }}</p>
																	@endif
													</div>

													<div class="col-sm-12 form-group">
														<label for="website">Company/Firm Website</label>
														<input type="text" class="form-control" name="company_website" id="website"
															placeholder="Enter website URL." value="{{ old('company_website') }}" required>
															@if($errors->has('company_website'))
																		<p class="req">{{ $errors->first('company_website') }}</p>
																	@endif
													</div>


													<div class="col-sm-10 form-group">
														<label for="enterpriseInfo">Whether the applicant is a Startup or Micro or Small
															Enterprise
															(MSE)</label>
														<div class="input-group">
															<input type="text" class="form-control" name="mse_type" id="enterpriseType"
																placeholder="Enter enterprise type" required value="{{ old('mse_type') }}">
																@if($errors->has('mse_type'))
																		<p class="req">{{ $errors->first('mse_type') }}</p>
																	@endif
															<div class="input-group-append">
																<label class="input-group-text" for="certificate"> <i
																		class="fa fa-upload pr-1"></i> Attach Certificate</label>
																<input type="file" class="form-control" name="mse_certificate" id="certificate"
																	accept=".pdf, .doc, .docx" required/>
															</div>
														</div>
														<small class="form-text text-muted">Attach a certificate verifying your enterprise
															type.</small>
															@if($errors->has('mse_certificate'))
																		<p class="req">{{ $errors->first('mse_certificate') }}</p>
																	@endif
													</div>


													<!-- 2. -->
													<div class="col-sm-12 mt-3 mb-4">
														<h5>Authorized Contact Person Detail</h5>
													</div>
													<div class="col-sm-6 form-group">
														<label for="name">Name:</label>
														<input type="text" value="{{ old('name') }}" class="form-control" name="name" id="name"
															placeholder="Enter your name." required>
															@if($errors->has('name'))
																		<p class="req">{{ $errors->first('name') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="designation">Designation:</label>
														<input type="text" class="form-control" name="designation" id="designation"
															placeholder="Enter your designation." required value="{{ old('designation') }}">
															@if($errors->has('designation'))
																		<p class="req">{{ $errors->first('designation') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="contact-number">Contact Number:</label>
														<input type="tel" class="form-control" name="contact_no" id="contact-number"
															placeholder="Enter your contact number." value="{{ old('contact_no') }}" required>
															@if($errors->has('contact_no'))
																		<p class="req">{{ $errors->first('contact_no') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="email">Email ID:</label>
														<input type="email" class="form-control" name="email_id" id="email"
															placeholder="Enter your email ID." required value="{{ old('email_id') }}">
															@if($errors->has('email_id'))
																		<p class="req">{{ $errors->first('email_id') }}</p>
																	@endif
													</div>




													<!-- 3. -->
													<div class="col-sm-12 mt-3 mb-4">
														<h5>Details of payment of Registration fee</h5>
													</div>

													<!-- Fields for DD/Banker's Cheque Information -->
													<div class="col-sm-6 form-group">
														<label for="dd-number">DD/Banker's Cheque Number:</label>
														<input type="text" class="form-control" name="cheque_no" id="dd-number"
															placeholder="Enter DD/Banker's Cheque Number." value="{{ old('cheque_no') }}" required>
															@if($errors->has('cheque_no'))
																		<p class="req">{{ $errors->first('cheque_no') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="amount">Amount:</label>
														<input type="number" class="form-control" name="amount" id="amount"
															placeholder="Enter the amount." value="{{ old('amount') }}" required>
															@if($errors->has('amount'))
																		<p class="req">{{ $errors->first('amount') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="date-of-issue">Date of Issue:</label>
														<input type="date" class="form-control" name="issue_date" id="date-of-issue" required value="{{ old('issue_date') }}">
														@if($errors->has('issue_date'))
																		<p class="req">{{ $errors->first('issue_date') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="issuing-branch">Name of Issuing Branch & Bank:</label>
														<input type="text" class="form-control" name="issue_branch" id="issuing-branch"
															placeholder="Enter issuing branch & bank." required value="{{ old('issue_branch') }}">
															@if($errors->has('issue_branch'))
																		<p class="req">{{ $errors->first('issue_branch') }}</p>
																	@endif
													</div>

													<div class="col-sm-12 form-group">
														<label for="payment-mode">Payment Mode:</label>
														<select class="form-control" name="payment_mode" id="payment-mode" required>
															<option value="dd">DD/Banker's Cheque</option>
															<option value="online">Online (RTGS/NEFT)</option>
														</select>
														@if($errors->has('payment_mode'))
																		<p class="req">{{ $errors->first('payment_mode') }}</p>
																	@endif
													</div>

													<div class="col-sm-12 form-group" id="online-payment-details" style="display: none;">
														<label for="proof-of-payment">Proof of Payment:</label>
														<input type="file" class="form-control" name="proofOfPayment" id="proof-of-payment"
															accept=".pdf, .doc, .docx">
														<small class="form-text text-muted">Attach proof of online payment (RTGS/NEFT).</small>
													</div>





													<!-- 4. -->
													<div class="col-sm-12 mt-3 mb-4">
														<h5>Details of Product/Solution offered for PoC</h5>
													</div>

													<div class="col-sm-12 form-group">
														<label for="product-name">Product/Solution Name:</label>
														<textarea class="form-control" name="solution_name" id="product-name"
															placeholder="Enter your product/solution name."  style="color:black" required>{{ old('solution_name') }}</textarea>
															@if($errors->has('solution_name'))
																		<p class="req">{{ $errors->first('solution_name') }}</p>
																	@endif
													</div>

													<div class="col-sm-12 form-group">
														<label for="product-description">Which part of the telecom network is the
															Product/Solution designed
															for:</label>
														<textarea class="form-control" name="solution_designed_for" id="product-description"
															placeholder="Enter the part of the telecom network your product/solution is designed for."  style="color:black"
															required>{{ old('solution_designed_for') }}</textarea>
														<small class="form-text text-muted">Please provide a brief description of the
															product/solution and
															its intended use as a separate annexure.</small>
															@if($errors->has('solution_designed_for'))
																		<p class="req">{{ $errors->first('solution_designed_for') }}</p>
																	@endif
													</div>
													<div class="col-sm-12 form-group">
														<label for="compliance-standard">Name of standard/specification to which the
															product/solution
															complies to:</label>
														<input type="text" class="form-control" name="solution_compiles_to"
															id="compliance-standard" placeholder="Enter the standard/specification name."
															required value="{{ old('solution_compiles_to') }}">
															@if($errors->has('solution_compiles_to'))
																		<p class="req">{{ $errors->first('solution_compiles_to') }}</p>
																	@endif
													</div>
													<div class="col-sm-12 form-group">
														<label for="similar-product">Is there any similar product/solution already available in
															the market?
															If yes, information on sources may be provided:</label>
														<textarea class="form-control" name="solution_source" id="similar-product"
															placeholder="Provide information on similar products/solutions in the market, if any."  style="color:black"
															required>{{ old('solution_source') }}</textarea>
															@if($errors->has('solution_source'))
																		<p class="req">{{ $errors->first('solution_source') }}</p>
																	@endif
													</div>
													<div class="col-sm-12 form-group">
														<label for="value-addition">If there is no similar product/solution already available in
															the market,
															how will your product/solution add value to the telecom industry:</label>
														<textarea class="form-control" name="solution_telecom" id="value-addition"
															placeholder="Explain how your product/solution will add value to the telecom industry in the absence of similar products."  style="color:black"
															required>{{ old('solution_telecom') }}</textarea>
															@if($errors->has('solution_telecom'))
																		<p class="req">{{ $errors->first('solution_telecom') }}</p>
																	@endif
													</div>
													<div class="col-sm-12 form-group">
														<label for="poc-testing-duration">Approximate time period required for complete PoC
															testing:</label>
														<input type="text" class="form-control" name="solution_testing"
															id="poc-testing-duration"
															placeholder="Enter the estimated time period for PoC testing." required value="{{ old('solution_testing') }}">
															@if($errors->has('solution_testing'))
																		<p class="req">{{ $errors->first('solution_testing') }}</p>
																	@endif
													</div>
													<div class="col-sm-10 form-group">
														<label for="enterpriseInfo">Whether the applicant is a Startup or Micro or Small
															Enterprise
															(MSE)</label>
														<div class="input-group">
															<input type="text" class="form-control" name="solution_mse_type" id="enterpriseType"
																placeholder="Enter enterprise type" required value="{{ old('solution_mse_type') }}">
																@if($errors->has('solution_mse_type'))
																		<p class="req">{{ $errors->first('solution_mse_type') }}</p>
																	@endif
															<div class="input-group-append">
																<label class="input-group-text" for="certificate">Attach Certificate</label>
																 <input type="file" class="form-control" name="solution_mse_certificate" id="certificate" accept=".pdf, .doc, .docx" required> 
															</div>
														</div>
														<small class="form-text text-muted">Attach a certificate verifying your enterprise
															type.</small>
															@if($errors->has('solution_mse_certificate'))
																		<p class="req">{{ $errors->first('solution_mse_certificate') }}</p>
																	@endif

													</div>







													<!-- 5. -->
													<div class="col-sm-12 mt-3 mb-4">
														<h5>Infrastructure Requirements expected to be provided by BSNL:</h5>
													</div>
													<div class="col-sm-6 form-group">
														<label for="power-specification">Power (Specify voltage and current):</label>
														<div class="input-group">
															<input type="text" class="form-control" name="bsnl_voltage" id="voltage"
																placeholder="Voltage" required value="{{ old('bsnl_voltage') }}">
																@if($errors->has('bsnl_voltage'))
																		<p class="req">{{ $errors->first('bsnl_voltage') }}</p>
																	@endif

															<input type="text" class="form-control" name="bsnl_current" id="current"
																placeholder="Current" required>
																@if($errors->has('bsnl_current'))
																		<p class="req">{{ $errors->first('bsnl_current') }}</p>
																	@endif

														</div>
													</div>
													<div class="col-sm-6 form-group">
														<label for="space-specification">Space (Specify dimensions and any special
															requirements):</label>
														<textarea class="form-control" name="bsnl_space" id="space-specification"
															placeholder="Enter dimensions and special requirements..."  style="color:black" required>{{ old('bsnl_space') }}</textarea>
															@if($errors->has('bsnl_space'))
																		<p class="req">{{ $errors->first('bsnl_space') }}</p>
																	@endif
													</div>
													<div class="col-sm-6 form-group">
														<label for="transmission-port">Transmission Port:</label>
														<input type="text" class="form-control" name="bsnl_port" id="transmission-port"
															placeholder="Enter Specify the transmission port" required value="{{ old('bsnl_port') }}">
															@if($errors->has('bsnl_port'))
																		<p class="req">{{ $errors->first('bsnl_port') }}</p>
																	@endif
													</div>
													<div class="col-sm-6 form-group">
														<label for="bandwidth">Bandwidth:</label>
														<input type="text" class="form-control" name="bsnl_bandwidth" id="bandwidth"
															placeholder="Enter the bandwidth" required value="{{ old('bsnl_bandwidth') }}">
															@if($errors->has('bsnl_bandwidth'))
																		<p class="req">{{ $errors->first('bsnl_bandwidth') }}</p>
																	@endif
													</div>
													<div class="col-sm-6 form-group">
														<label for="poc-testing-location">Preferred PoC Testing Location:</label>
														<input type="text" class="form-control" name="bsnl_testing_location"
															id="poc-testing-location" placeholder="Enter the preferred PoC testing location"
															required value="{{ old('bsnl_testing_location') }}">
															@if($errors->has('bsnl_testing_location'))
																		<p class="req">{{ $errors->first('bsnl_testing_location') }}</p>
																	@endif
													</div>
													<div class="col-sm-6 form-group">
														<label for="additional-requirements">Any Other Requirement:</label>
														<textarea class="form-control" name="requirements"
															id="additional-requirements"
															placeholder="Provide any additional information ..."  style="color:black"
															required >{{ old('requirements') }}</textarea>
															@if($errors->has('requirements'))
																		<p class="req">{{ $errors->first('requirements') }}</p>
																	@endif
													</div>




													<!-- 6. -->
													<div class="col-sm-12 mt-3 mb-4">
														<h5>Declaration and Undertaking:</h5>
													</div>
													<div class="col-sm-12">
														<p>By submitting this application, the applicant agrees to the following terms and
															conditions:</p>
														<ul>
															<li><i class="fa fa-check-circle"></i> BSNL reserves the right to accept or reject
																any
																application at its sole discretion.</li>
															<li><i class="fa fa-check-circle"></i> I/We undertake that the telecom
																product/solution offered
																for PoC is/are indigenously developed by me/us and to the best of our knowledge
																no other
																individual, organization, or entity has any ownership claim or rights to the
																product.</li>
															<li><i class="fa fa-check-circle"></i> I/We will be responsible for ensuring the
																accuracy of the
																information provided in this form. Any information found to be false/incorrect
																may lead to
																rejection of the application for PoC.</li>
															<li><i class="fa fa-check-circle"></i> I/We declare that I/We am/are not blacklisted
																by any
																Govt. department/CPSU/State PSU/GST Authorities.</li>
															<li><i class="fa fa-check-circle"></i> I/We agree that the decision of BSNL on
																acceptance/rejection of PoC application shall be binding on me/us and I/We will
																not
																challenge it.</li>
															<li><i class="fa fa-check-circle"></i> Registration fee for PoC Application is
																non-refundable
																and I/We will not claim any refund if the application for PoC is rejected.</li>
															<li><i class="fa fa-check-circle"></i> I/We comply with all terms and conditions as
																mentioned in
																PoC Policy of BSNL as available on BSNL website.</li>
															<li><i class="fa fa-check-circle"></i> I/We comply with all statutory rules,
																regulations and law
																of the land during the time period of PoC.</li>
															<li><i class="fa fa-check-circle"></i> I/We will not hold BSNL liable for any
																damages, losses,
																or expenses that may be incurred by me/us as a result of using the Telecom
																Network/Sandbox
																of BSNL for PoC testing and indemnify BSNL from all the financial, legal or any
																other
																liabilities arising due to the PoC.</li>
															<li><i class="fa fa-check-circle"></i> I/We agree to share the results of the PoC
																testing with
																BSNL for record & reference.</li>
															<li><i class="fa fa-check-circle"></i> I/We comply with all requirements w.r.t. Rule
																144(xi of
																GFR, 2017 and hereby submit the required declaration.</li>
															<li><i class="fa fa-check-circle"></i> I/We undertake that, if my/our equipment is
																shortlisted
																for PoC then I/We shall sign Security Agreement (as applicable for the
																type/category of PoC
																equipment).</li>
														</ul>
													</div>



													<div class="col-sm-6">
														<input type="checkbox" class="form-check d-inline" id="chb" required><label for="chb"
															class="form-check-label">&nbsp;I accept all terms and conditions.
														</label>
													</div>

													<div class="col-sm-6 form-group ">
														<div class="input-group ">
															<!-- <label for="signature" class="mb-0 align-self-center">Signature of Authorized Signatory:</label> -->
															<div class="input-group-append">
																<label class="input-group-text border-0" for="signature-upload">Signature of
																	Authorized
																	Signatory:</label>
																<input type="file" class="form-control" name="signature"
																	id="signature-upload" accept=".png, .jpg, .jpeg" required>
																	@if($errors->has('signature'))
																		<p class="req">{{ $errors->first('signature') }}</p>
																	@endif
															</div>

														</div>
													</div>




													<!-- 7. -->
													<div class="col-sm-12 mt-3 mb-4">
														<h5>Checklist for documents to be submitted</h5>
													</div>


													<div class="col-sm-6 form-group">
														<label for="certificate-of-incorporation">Certificate of Incorporation:</label>
														<input type="file" class="form-control" name="cert_incorporation"
															id="certificate-of-incorporation" accept=".pdf, .doc, .docx" required>
															@if($errors->has('cert_incorporation'))
																		<p class="req">{{ $errors->first('cert_incorporation') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="self-declaration-standards">Self-declaration - Relevant Standards:</label>
														<input type="file" class="form-control" name="cert_self_declaration"
															id="self-declaration-standards" accept=".pdf, .doc, .docx" required>
															@if($errors->has('cert_self_declaration'))
																		<p class="req">{{ $errors->first('cert_self_declaration') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="self-declaration-lab-tests">Self-declaration - Lab Tests:</label>
														<input type="file" class="form-control" name="cert_self_declaration_lab"
															id="self-declaration-lab-tests" accept=".pdf, .doc, .docx" required>
															@if($errors->has('cert_self_declaration_lab'))
																		<p class="req">{{ $errors->first('cert_self_declaration_lab') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="draft-test-schedule">Draft Test Schedule:</label>
														<input type="file" class="form-control" name="cert_draft"
															id="draft-test-schedule" accept=".pdf, .doc, .docx" required>
															@if($errors->has('cert_draft'))
																		<p class="req">{{ $errors->first('cert_draft') }}</p>
																	@endif
													</div>

													<div class="col-sm-6 form-group">
														<label for="undertaking-ownership">Undertaking - Ownership:</label>
														<input type="file" class="form-control" name="cert_ownership"
															id="undertaking-ownership" accept=".pdf, .doc, .docx" required>
															@if($errors->has('cert_ownership'))
																		<p class="req">{{ $errors->first('cert_ownership') }}</p>
																	@endif
													</div>

													<div class="col-sm-12 form-group d-flex justify-content-center my-5">
														<button class="btn btn-primary ">Submit</button>
													</div>

												</div>
											</form>
                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->
        </div>
@endsection