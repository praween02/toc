@extends('layouts.app')
@section('title', '- APPLICATION FORM FOR EXPERT DETAILS FORM')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css?v=1.0') }}" />   
@endpush
@section('content')		
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">EXPERT DETAILS FORM</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                 <!-- <iframe src="http://localhost/bharat5gNew/experts/form3#regForm" title="W3Schools Free Online Web Tutorials" height="100%" width="100%">
                                 </iframe> -->
                                    <form action="{{ route('poc_bsnl.store') }}" method="POST" enctype="multipart/form-data" class="d-none">
                                       @csrf     

                                       <div class="row jumbotron box8">
										   
										   @if ($errors->any())
                                     <div class="alert alert-danger">
                                         <ul>
                                             @foreach ($errors->all() as $error)
                                                 <li>{{ $error }}</li>
                                             @endforeach
                                         </ul>
                                     </div>
                                 @endif
										   
										   

                                        <div class="row mb-3">
                                          <div class="col-sm-6 form-group">
                                             <label for="name-f">Company/Firm Name</label>
                                             <input type="text" class="form-control" name="company_name" id="name-f" placeholder="Enter your company/firm name" value="{{ old('company_name') }}" autocomplete="off" />
                                             @if($errors->has('company_name'))
                                                <p class="req">{{ $errors->first('company_name') }}</p>
                                            @endif
                                          </div>
                                          <div class="col-sm-6 form-group">
                                             <label for="name-l">CIN Number (if applicable)</label>
                                             <input type="text" class="form-control" name="cin_number" id="name-l" placeholder="Enter CIN number if applicable" value="{{ old('cin_number') }}" autocomplete="off" />
                                             @if($errors->has('cin_number'))
                                                <p class="req">{{ $errors->first('cin_number') }}</p>
                                             @endif
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-sm-6 form-group">
                                             <label for="registered-address">Registered Office Address</label>
                                             <textarea class="form-control" name="regd_office_address" id="registered-address" placeholder="Enter registered office address." autocomplete="off" >{{ old('regd_office_address') }}</textarea>

                                             @if($errors->has('regd_office_address'))
                                                <p class="req">{{ $errors->first('regd_office_address') }}</p>
                                             @endif

                                          </div>
                                          <div class="col-sm-6 form-group">
                                             <label for="corporate-address">Corporate Office Address</label>
                                             <textarea class="form-control" name="corp_office_address" id="corporate-address" placeholder="Enter corporate office address." autocomplete="off" >{{ old('corp_office_address') }}</textarea>
                                             @if($errors->has('corp_office_address'))
                                                <p class="req">{{ $errors->first('corp_office_address') }}</p>
                                             @endif
                                          </div>
                                        </div>


                                        <div class="row">
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="website">Company/Firm Website</label>
                                             <input type="text" class="form-control" name="company_website" id="website" placeholder="Enter website url with http(s)" value="{{ old('company_website') }}"  autocomplete="off" />
                                             @if($errors->has('company_website'))
                                                <p class="req">{{ $errors->first('company_website') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-10 form-group mb-3">
                                             <label for="enterpriseInfo">Whether the applicant is a Startup or Micro or Small Enterprise (MSE)</label>
                                             <div class="input-group">
                                                <input type="text" class="form-control" name="mse_type" id="enterpriseType" placeholder="Enter enterprise type"  value="{{ old('mse_type') }}" autocomplete="off" />

                                                

                                                <div class="input-group-append">
                                                   <label class="input-group-text" for="certificate"> <i class="fa fa-upload pr-1"></i> Attach Certificate</label>
                                                   <input type="file" class="form-control" name="mse_certificate" id="certificate" accept=".pdf, .doc, .docx" />
                                                    @if($errors->has('mse_certificate'))
                                                        <p class="req">{{ $errors->first('mse_certificate') }}</p>
                                                    @endif
                                                </div>
                                             </div>
                                             @if($errors->has('mse_type'))
                                                     <small class="req">{{ $errors->first('mse_type') }}</small><br />
                                             @endif
                                             <small class="form-text text-muted">Attach a certificate verifying your enterprise type.</small>
                                          </div>
                                        </div>

                                          <!-- 2. -->
                                          <div class="col-sm-12 mb-2">
                                             <h5>Authorized Contact Person Details</h5>
                                          </div>

                                        <div class="row mb-3">
                                          <div class="col-sm-6 form-group">
                                             <label for="name">Name</label>
                                             <input type="text" value="{{ old('name') }}" class="form-control" name="name" id="name" placeholder="Name"  autocomplete="off" />
                                             @if($errors->has('name'))
                                                <p class="req">{{ $errors->first('name') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group">
                                             <label for="designation">Designation</label>
                                             <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation"  value="{{ old('designation') }}" autocomplete="off" />
                                             @if($errors->has('designation'))
                                                   <p class="req">{{ $errors->first('designation') }}</p>
                                             @endif
                                          </div>

                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-sm-6 form-group">
                                             <label for="contact-number">Contact Number</label>
                                             <input type="tel" class="form-control" name="contact_no" id="contact-number" placeholder="Contact Number" value="{{ old('contact_no') }}"  autocomplete="off" />
                                             @if($errors->has('contact_no'))
                                                 <p class="req">{{ $errors->first('contact_no') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group">
                                             <label for="email">Email ID</label>
                                             <input type="text" class="form-control" name="email_id" id="email" placeholder="Email ID"  value="{{ old('email_id') }}" autocomplete="off" />
                                             @if($errors->has('email_id'))
                                                <p class="req">{{ $errors->first('email_id') }}</p>
                                             @endif
                                          </div>
                                        </div>


                                          <!-- 3. -->

                                        <div class="row mb-3">
                                          <div class="col-sm-12 mb-3">
                                             <h5>Details of payment of Registration fee</h5>
                                          </div>
                                          <!-- Fields for DD/Banker's Cheque Information -->
                                          <div class="col-sm-6 form-group">
                                             <label for="dd-number">DD/Banker's Cheque Number</label>
                                             <input type="text" class="form-control" name="cheque_no" id="cheque_no" placeholder="Enter DD/Banker's Cheque Number" value="{{ old('cheque_no') }}"  autocomplete="off" />
                                             @if($errors->has('cheque_no'))
                                                <p class="req">{{ $errors->first('cheque_no') }}</p>
                                            @endif
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-sm-6 form-group">
                                             <label for="amount">Amount</label>
                                             <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter the amount" value="{{ old('amount') }}"  autocomplete="off" />
                                             @if($errors->has('amount'))
                                                <p class="req">{{ $errors->first('amount') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group">
                                             <label for="date-of-issue">Date of Issue</label>
                                             <input type="text" class="form-control datepicker" name="issue_date" id="date-of-issue"  value="{{ old('issue_date') }}" autocomplete="off" />
                                             @if($errors->has('issue_date'))
                                                <p class="req">{{ $errors->first('issue_date') }}</p>
                                             @endif
                                          </div>
                                        </div>


                                        <div class="row">
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="issuing-branch">Name of Issuing Branch &amp; Bank</label>
                                             <input type="text" class="form-control" name="issue_branch" id="issuing-branch" placeholder="Enter issuing branch &amp; bank"  value="{{ old('issue_branch') }}" autocomplete="off" />
                                             @if($errors->has('issue_branch'))
                                                <p class="req">{{ $errors->first('issue_branch') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="payment-mode">Payment Mode</label>
                                             <select class="form-control" name="payment_mode" id="payment-mode">
                                                <option value="dd">DD/Banker's Cheque</option>
                                                <option value="online">Online (RTGS/NEFT)</option>
                                             </select>
                                             @if($errors->has('payment_mode'))
                                                <p class="req">{{ $errors->first('payment_mode') }}</p>
                                             @endif
                                          </div>
                                        </div>


                                        <div class="col-sm-12 form-group" id="online-payment-details" style="display: none;">
                                             <label for="proof-of-payment">Proof of Payment</label>
                                             <input type="file" class="form-control" name="proofOfPayment" id="proof-of-payment" accept=".pdf, .doc, .docx" />
                                             @if($errors->has('proofOfPayment'))
                                                <p class="req">{{ $errors->first('proofOfPayment') }}</p>
                                             @endif

                                             <small class="form-text text-muted">Attach proof of online payment (RTGS/NEFT).</small>
                                        </div>
                                        <!-- 4. -->


                                          <div class="col-sm-12 mb-3">
                                             <h5>Details of Product/Solution offered for PoC</h5>
                                          </div>
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="product-name">Product/Solution Name</label>
                                             <textarea class="form-control" name="solution_name" id="solution_name" placeholder="Enter your product/solution name"  autocomplete="off">{{ old('solution_name') }}</textarea>
                                             @if($errors->has('solution_name'))
                                                <p class="req">{{ $errors->first('solution_name') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="product-description">Which part of the telecom network is the Product/Solution designed for</label>
                                             <textarea class="form-control" name="solution_designed_for" id="product-description" placeholder="Enter the part of the telecom network your product/solution is designed for"  autocomplete="off">{{ old('solution_designed_for') }}</textarea>
                                             @if($errors->has('solution_designed_for'))
                                                <p class="req">{{ $errors->first('solution_designed_for') }}</p>
                                             @endif

                                             <small class="form-text text-muted">Please provide a brief description of the product/solution and its intended use as a separate annexure.</small>
                                          </div>
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="compliance-standard">Name of standard/specification to which the product/solution complies to</label>
                                             <input type="text" class="form-control" name="solution_compiles_to" id="compliance-standard" placeholder="Enter the standard/specification name"  value="{{ old('solution_compiles_to') }}" autocomplete="off" />
                                             @if($errors->has('solution_compiles_to'))
                                                <p class="req">{{ $errors->first('solution_compiles_to') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="similar-product">Is there any similar product/solution already available in the market? If yes, information on sources may be provided</label>
                                             <textarea class="form-control" name="solution_source" id="similar-product" placeholder="Provide information on similar products/solutions in the market, if any"  autocomplete="off">{{ old('solution_source') }}</textarea>
                                             @if($errors->has('solution_source'))
                                                <p class="req">{{ $errors->first('solution_source') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="value-addition">If there is no similar product/solution already available in the market,
                                             how will your product/solution add value to the telecom industry</label>
                                             <textarea class="form-control" name="solution_telecom" id="value-addition" placeholder="Explain how your product/solution will add value to the telecom industry in the absence of similar products"  autocomplete="off">{{ old('solution_telecom') }}</textarea>
                                             @if($errors->has('solution_telecom'))
                                                <p class="req">{{ $errors->first('solution_telecom') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-12 form-group mb-3">
                                             <label for="poc-testing-duration">Approximate time period required for complete PoC testing</label>
                                             <input type="text" class="form-control" name="solution_testing" id="poc-testing-duration" placeholder="Enter the estimated time period for PoC testing"  value="{{ old('solution_testing') }}" autocomplete="off" />
                                             @if($errors->has('solution_testing'))
                                                <p class="req">{{ $errors->first('solution_testing') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-10 form-group mb-3">
                                             <label for="enterpriseInfo">Whether the applicant is a Startup or Micro or Small Enterprise (MSE)</label>
                                             <div class="input-group">
                                                <input type="text" class="form-control" name="solution_mse_type" id="enterpriseType" placeholder="Enter enterprise type"  value="{{ old('solution_mse_type') }}" autocomplete="off" />
                                                

                                                <div class="input-group-append">
                                                   <label class="input-group-text" for="certificate">Attach Certificate</label>
                                                   <input type="file" class="form-control" name="solution_mse_certificate" id="certificate" accept=".pdf, .doc, .docx" /> 
                                                   @if($errors->has('solution_mse_certificate'))
                                                      <p class="req">{{ $errors->first('solution_mse_certificate') }}</p>
                                                   @endif
                                                </div>
                                             </div>
                                             @if($errors->has('solution_mse_type'))
                                                      <small class="req">{{ $errors->first('solution_mse_type') }}</small><br />
                                             @endif

                                             <small class="form-text text-muted">Attach a certificate verifying your enterprise
                                             type.</small>
                                          </div>
                                          <!-- 5. -->
                                          <div class="col-sm-12 mb-3">
                                             <h5>Infrastructure Requirements expected to be provided by BSNL</h5>
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="power-specification">Power (Specify voltage and current):</label>
                                             <div class="input-group">
                                                <input type="text" class="form-control" name="bsnl_voltage" id="voltage" placeholder="Voltage"  value="{{ old('bsnl_voltage') }}" autocomplete="off" />
                                                <input type="text" class="form-control" name="bsnl_current" id="current" placeholder="Current"  autocomplete="off" value="{{ old('bsnl_current') }}" />

                                             </div>
                                             <p class="req">
                                                @if($errors->has('bsnl_voltage'))
                                                   <small>{{ $errors->first('bsnl_voltage') }}</small>
                                                @endif
                                                
                                                @if($errors->has('bsnl_current'))
                                                   <small>{{ $errors->first('bsnl_current') }}</small>
                                                @endif
                                             </p>
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="space-specification">Space (Specify dimensions and any special requirements)</label>
                                             <textarea class="form-control" name="bsnl_space" id="space-specification" placeholder="Enter dimensions and special requirements"  autocomplete="off">{{ old('bsnl_space') }}</textarea>
                                             @if($errors->has('bsnl_space'))
                                                <p class="req">{{ $errors->first('bsnl_space') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="transmission-port">Transmission Port</label>
                                             <input type="text" class="form-control" name="bsnl_port" id="transmission-port" placeholder="Enter Specify the transmission port"  value="{{ old('bsnl_port') }}" autocomplete="off" />
                                             @if($errors->has('bsnl_port'))
                                                <p class="req">{{ $errors->first('bsnl_port') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="bandwidth">Bandwidth</label>
                                             <input type="text" class="form-control" name="bsnl_bandwidth" id="bandwidth" placeholder="Enter the bandwidth"  value="{{ old('bsnl_bandwidth') }}" autocomplete="off" />
                                             @if($errors->has('bsnl_bandwidth'))
                                                <p class="req">{{ $errors->first('bsnl_bandwidth') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="poc-testing-location">Preferred PoC Testing Location:</label>
                                             <input type="text" class="form-control" name="bsnl_testing_location" id="poc-testing-location" placeholder="Preferred PoC testing location"  value="{{ old('bsnl_testing_location') }}" autocomplete="off" />
                                             @if($errors->has('bsnl_testing_location'))
                                                <p class="req">{{ $errors->first('bsnl_testing_location') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="additional-requirements">Any Other Requirement</label>
                                             <textarea class="form-control" name="requirements" id="additional-requirements" placeholder="Provide any additional information"  autocomplete="off">{{ old('requirements') }}</textarea>
                                             @if($errors->has('requirements'))
                                                <p class="req">{{ $errors->first('requirements') }}</p>
                                             @endif
                                          </div>
                                          <!-- 6. -->
                                          <div class="col-sm-12 mb-3">
                                             <h5>Declaration and Undertaking:</h5>
                                          </div>

                                          <div class="col-sm-12 mb-3">
                                             <p>By submitting this application, the applicant agrees to the following terms and conditions:</p>
                                             <ul>
                                                <li><i class="fa fa-check-circle"></i> BSNL reserves the right to accept or reject any application at its sole discretion.</li>
                                                <li><i class="fa fa-check-circle"></i> I/We undertake that the telecom product/solution offered for PoC is/are indigenously developed by me/us and to the best of our knowledge no other individual, organization, or entity has any ownership claim or rights to the product.</li>
                                                <li><i class="fa fa-check-circle"></i> I/We will be responsible for ensuring the accuracy of the information provided in this form. Any information found to be false/incorrect may lead to rejection of the application for PoC.</li>
                                                <li><i class="fa fa-check-circle"></i> I/We declare that I/We am/are not blacklisted by any Govt. department/CPSU/State PSU/GST Authorities.</li>
                                                <li><i class="fa fa-check-circle"></i> I/We agree that the decision of BSNL on acceptance/rejection of PoC application shall be binding on me/us and I/We will not challenge it.</li>
                                                <li><i class="fa fa-check-circle"></i> Registration fee for PoC Application is non-refundable
                                                   and I/We will not claim any refund if the application for PoC is rejected.</li>
                                                <li><i class="fa fa-check-circle"></i> I/We comply with all terms and conditions as mentioned in
                                                   PoC Policy of BSNL as available on BSNL website.</li>
                                                <li><i class="fa fa-check-circle"></i> I/We comply with all statutory rules, regulations and law
                                                   of the land during the time period of PoC.</li>

                                                <li><i class="fa fa-check-circle"></i> I/We will not hold BSNL liable for any damages, losses, or expenses that may be incurred by me/us as a result of using the Telecom Network/Sandbox of BSNL for PoC testing and indemnify BSNL from all the financial, legal or any other liabilities arising due to the PoC.</li>

                                                <li><i class="fa fa-check-circle"></i> I/We agree to share the results of the PoC testing with
                                                   BSNL for record &amp; reference.</li>

                                                <li><i class="fa fa-check-circle"></i> I/We comply with all requirements w.r.t. Rule 144(xi of
                                                   GFR, 2017 and hereby submit the required declaration.</li>
                                                <li><i class="fa fa-check-circle"></i> I/We undertake that, if my/our equipment is shortlisted for PoC then I/We shall sign Security Agreement (as applicable for the type/category of PoC equipment).</li>
                                             </ul>
                                          </div>
                                          <div class="col-sm-6">
                                             <p><input type="checkbox" name="terms" class="form-check d-inline" id="chb" value="1" {{ old('terms') == 1 ? "checked" : "" }}><label for="chb" class="form-check-label">&nbsp;I accept all terms and conditions.</label></p>
                                          </div>
                                          <div class="col-sm-6 form-group ">
                                             <div class="input-group ">
                                                <!-- <label for="signature" class="mb-0 align-self-center">Signature of Authorized Signatory:</label> -->
                                                <div class="input-group-append">
                                                   <label class="input-group-text border-0" for="signature-upload">Signature of
                                                   Authorized
                                                   Signatory:</label>
                                                   <input type="file" class="form-control" name="signature" id="signature-upload" accept=".png, .jpg, .jpeg" />
                                                   @if($errors->has('signature'))
                                                      <p class="req">{{ $errors->first('signature') }}</p>
                                                   @endif
                                                </div>
                                             </div>
                                          </div>
                                          <!-- 7. -->
                                          <div class="col-sm-12 mt-3 mb-2">
                                             <h5>Checklist for documents to be submitted</h5>
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="certificate-of-incorporation">Certificate of Incorporation</label>
                                             <input type="file" class="form-control" name="cert_incorporation" id="certificate-of-incorporation" accept=".pdf, .doc, .docx" />
                                             @if($errors->has('cert_incorporation'))
                                                <p class="req">{{ $errors->first('cert_incorporation') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="self-declaration-standards">Self-declaration - Relevant Standards</label>
                                             <input type="file" class="form-control" name="cert_self_declaration" id="self-declaration-standards" accept=".pdf, .doc, .docx" />
                                             @if($errors->has('cert_self_declaration'))
                                                <p class="req">{{ $errors->first('cert_self_declaration') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="self-declaration-lab-tests">Self-declaration - Lab Tests</label>
                                             <input type="file" class="form-control" name="cert_self_declaration_lab" id="self-declaration-lab-tests" accept=".pdf, .doc, .docx" />
                                             @if($errors->has('cert_self_declaration_lab'))
                                                <p class="req">{{ $errors->first('cert_self_declaration_lab') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="draft-test-schedule">Draft Test Schedule</label>
                                             <input type="file" class="form-control" name="cert_draft" id="draft-test-schedule" accept=".pdf, .doc, .docx" />
                                             @if($errors->has('cert_draft'))
                                                <p class="req">{{ $errors->first('cert_draft') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-6 form-group mb-3">
                                             <label for="undertaking-ownership">Undertaking - Ownership</label>
                                             <input type="file" class="form-control" name="cert_ownership" id="undertaking-ownership" accept=".pdf, .doc, .docx" />
                                             @if($errors->has('cert_ownership'))
                                                <p class="req">{{ $errors->first('cert_ownership') }}</p>
                                             @endif
                                          </div>
                                          <div class="col-sm-12 form-group d-flex justify-content-center">
                                             <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>
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

@push('scripts')
 <script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
 <script>
      $(document).ready(function() {
          $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd'});
      });

      document.addEventListener("DOMContentLoaded",async function(){
         let spinner = $('<div id="spinner" class="text-center">');
         spinner.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Loading...')
         $('.card-body').append(spinner);
         const form = $('form');
         await new Promise(resolve => setTimeout(resolve, 4000));
         fetch('/experts/form3',{
            method: 'GET',
            mode: 'cors',
            headers: {
               'Accept': 'text/html'
            }
         })
         .then(response => {
            if (!response.ok) {
               throw new Error('Unable to fetch the form.');
            }
            return response.text()
         })
         .then(async function(html) {

            spinner.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Getting ready...');
            await new Promise(resolve => setTimeout(resolve, 2000));
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
           
            [...doc.documentElement.querySelectorAll('header')].forEach(header => {
               header.remove();
            });

            doc.documentElement.querySelector('.wave_one_section_two').style.backgroundImage = 'none';
            doc.documentElement.querySelector('form').appendChild($('<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">')[0]);
            console.log($('form'));
            const iframe = document.createElement('iframe');
            $(iframe).insertAfter($('form'));

            iframe.srcdoc = doc.documentElement.outerHTML;
            iframe.style.width = '100%'; // Set iframe width as needed
            iframe.style.height = '1000px';   
            const targetElement =[0];
            console.log(targetElement)
            console.log(iframe);
            spinner.remove()
            //$('form').remove();
         })
         .catch(error => {
            //alert(error)
            spinner.find('span').remove();
            spinner.text(error)
         })
         
      })
    </script>
@endpush