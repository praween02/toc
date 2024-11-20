@extends('layouts.app')
@section('title', '- APPLICATION FORM FOR POC IN BSNL')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css?v=1.0') }}" />   
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<style type="text/css">
small{font-size:10px;color:#7b5f07;letter-spacing:0.9px} 
ul.err li {color:#ff0000;}  
label.error{font-weight:normal;width:100%}
.tab-pane{padding-left:15px !important}
.select2-container{border:1px solid #ced4da !important;width:100% !important;padding: 0.45rem 0.9rem;font-size: .8125rem;font-weight: 400;line-height: 1.5;color: #6c757d;background-color: #fff;background-clip: padding-box;-webkit-appearance: none;appearance: none;border-radius: 0.2rem;transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;}
.select2-container--default .select2-selection--single{border: none !important}
.select2-container--default .select2-selection--single .select2-selection__arrow{top:8px !important}
</style>		
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.application_form_for_poc_in_bsnl') }}</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="errors"></div>
                                    <form id="poc_bsnl" action="{{ route('poc_bsnl.store') }}" method="POST" enctype="multipart/form-data">
                                       @csrf     
                                       <div class="row jumbotron box8">

                                          <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                              <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">Application Details</button>

                                              <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Documents</button>

                                              <button class="nav-link" id="nav-project-solution-tab" data-bs-toggle="tab" data-bs-target="#nav-project-solution" type="button" role="tab" aria-controls="nav-project-solution" aria-selected="false">Product/Solution</button>

                                              <button class="nav-link" id="nav-infrastructure-tab" data-bs-toggle="tab" data-bs-target="#nav-infrastructure" type="button" role="tab" aria-controls="nav-infrastructure" aria-selected="false">Infrastructure</button>

                                              <button class="nav-link" id="nav-payment-tab" data-bs-toggle="tab" data-bs-target="#nav-payment-plan" type="button" role="tab" aria-controls="nav-payment-plan" aria-selected="false">Payment</button>

                                              <button class="nav-link" id="nav-declaration-funding-tab" data-bs-toggle="tab" data-bs-target="#nav-declaration-funding" type="button" role="tab" aria-controls="nav-declaration-funding" aria-selected="false">Declaration and Undertaking</button>

                                            </div>
                                          </nav>


                                          <div class="tab-content" id="nav-tabContent">

                                             <div class="mpm-10 tab-pane fade show active" id="nav-application" role="tabpanel" aria-labelledby="nav-application-tab">

                                                 <div class="row mb-3">
                                                   <div class="col-sm-6 form-group">
                                                      <label for="company_name">Company/Firm Name <span class="req">*</span></label>
                                                      <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter your company/firm name" value="{{ old('company_name') }}" autocomplete="off" />
                                                      @if($errors->has('company_name'))
                                                         <p class="req">{{ $errors->first('company_name') }}</p>
                                                     @endif
                                                   </div>
                                                   <div class="col-sm-6 form-group">
                                                      <label for="cin_number">CIN Number (if applicable) </label>
                                                      <input type="text" class="form-control" name="cin_number" id="cin_number" placeholder="Enter CIN number if applicable" value="{{ old('cin_number') }}" autocomplete="off" />
                                                      @if($errors->has('cin_number'))
                                                         <p class="req">{{ $errors->first('cin_number') }}</p>
                                                      @endif
                                                   </div>
                                                 </div>

                                                 <div class="row mb-3">
                                                   <div class="col-sm-6 form-group">
                                                      <label for="regd_office_address">Registered Office Address <span class="req">*</span></label>
                                                      <textarea class="form-control" name="regd_office_address" id="regd_office_address" placeholder="Enter registered office address." autocomplete="off" >{{ old('regd_office_address') }}</textarea>

                                                      @if($errors->has('regd_office_address'))
                                                         <p class="req">{{ $errors->first('regd_office_address') }}</p>
                                                      @endif

                                                   </div>
                                                   <div class="col-sm-6 form-group">
                                                      <label for="corp_office_address">Corporate Office Address <span class="req">*</span></label>
                                                      <textarea class="form-control" name="corp_office_address" id="corp_office_address" placeholder="Enter corporate office address." autocomplete="off" >{{ old('corp_office_address') }}</textarea>
                                                      @if($errors->has('corp_office_address'))
                                                         <p class="req">{{ $errors->first('corp_office_address') }}</p>
                                                      @endif
                                                   </div>
                                                 </div>

                                                 <div class="row">
                                                   <div class="col-sm-12 form-group mb-3">
                                                      <label for="company_website">Company/Firm Website <span class="req">*</span></label>
                                                      <input type="text" class="form-control" name="company_website" placeholder="Enter website url with http(s)" value="{{ old('company_website') }}" id="company_website" autocomplete="off" />
                                                      @if($errors->has('company_website'))
                                                         <p class="req">{{ $errors->first('company_website') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-10 form-group mb-3">
                                                      <label for="mse_type">Whether the applicant is a Startup or Micro or Small Enterprise (MSE) <span class="req">*</span></label>
                                                      <div class="input-group">

                                                         <select name="mse_type" id="mse_type" class="form-control">
                                                            <option value="Startups">Startups</option>
                                                            <option value="MSME">MSME</option>
                                                            <option value="Domestic Companies">Domestic Companies</option>
                                                            <option value="Academia">Academia</option>
                                                            <option value="R&D Institutes">R&D Institutes</option>
                                                            <option value="CoES">CoES</option>
                                                         </select>
                                                         <div class="input-group-append">
                                                            <label class="input-group-text" for="mse_certificate"> <i class="fa fa-upload pr-1"></i> Attach Certificate</label>
                                                            <input type="file" class="form-control" name="mse_certificate" id="mse_certificate" accept=".pdf, .doc, .docx" />
                                                             @if($errors->has('mse_certificate'))
                                                                 <p class="req">{{ $errors->first('mse_certificate') }}</p>
                                                             @endif
                                                         </div>
                                                      </div>
                                                      @if($errors->has('mse_type'))
                                                              <p class="req">{{ $errors->first('mse_type') }}</p><br />
                                                      @endif
                                                      <small>Attach a certificate verifying your enterprise type.</small>
                                                   </div>
                                                 </div>

                                                   <!-- 2. -->
                                                 <div class="col-sm-12 mb-2">
                                                   <h5>Authorized Contact Person Details</h5>
                                                 </div>

                                                 <div class="row mb-3">
                                                   <div class="col-sm-6 form-group">
                                                      <label for="name">Name <span class="req">*</span></label>
                                                      <input type="text" value="{{ old('name') }}" class="form-control" name="name" id="name" placeholder="Name"  autocomplete="off" />
                                                      @if($errors->has('name'))
                                                         <p class="req">{{ $errors->first('name') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-6 form-group">
                                                      <label for="designation">Designation <span class="req">*</span></label>
                                                      <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation"  value="{{ old('designation') }}" autocomplete="off" />
                                                      @if($errors->has('designation'))
                                                            <p class="req">{{ $errors->first('designation') }}</p>
                                                      @endif
                                                   </div>

                                                 </div>

                                                 <div class="row mb-3">
                                                   <div class="col-sm-6 form-group">
                                                      <label for="contact_no">Contact Number <span class="req">*</span></label>
                                                      <input type="tel" class="form-control" name="contact_no" id="contact_no" placeholder="Contact Number" value="{{ old('contact_no') }}"  autocomplete="off" />
                                                      @if($errors->has('contact_no'))
                                                          <p class="req">{{ $errors->first('contact_no') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-6 form-group">
                                                      <label for="email_id">Email ID <span class="req">*</span></label>
                                                      <input type="text" class="form-control" name="email_id" id="email_id" placeholder="Email ID"  value="{{ old('email_id') }}" autocomplete="off" />
                                                      @if($errors->has('email_id'))
                                                         <p class="req">{{ $errors->first('email_id') }}</p>
                                                      @endif
                                                   </div>
                                                 </div>

                                                 <div class="row">
                                                      <div class="form-group col-md-6">
                                                        <button onclick="$('#poc_bsnl .nav-tabs button#nav-documents-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                      </div>
                                                 </div>

                                             </div>

                                             <div class="mpm-10 tab-pane fade" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
                                             
                                                <div class="row">
                                                   <div class="col-sm-12 mb-2">
                                                      <h5>Checklist for documents to be submitted</h5>
                                                   </div>
                                                   <div class="col-sm-6 form-group mb-3">
                                                      <label for="cert_incorporation">Certificate of Incorporation <span class="req">*</span></label>
                                                      <input type="file" class="form-control" name="cert_incorporation" id="cert_incorporation" accept="application/pdf" />
                                                      <small>(Allowed:PDF | Size : 2MB)</small>
                                                      @if($errors->has('cert_incorporation'))
                                                         <p class="req">{{ $errors->first('cert_incorporation') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-6 form-group mb-3">
                                                      <label for="cert_self_declaration">Self-declaration - Relevant Standards <span class="req">*</span></label>
                                                      <input type="file" class="form-control" name="cert_self_declaration" id="cert_self_declaration" accept="application/pdf" />
                                                      <small>(Allowed:PDF | Size : 2MB)</small>
                                                      @if($errors->has('cert_self_declaration'))
                                                         <p class="req">{{ $errors->first('cert_self_declaration') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-6 form-group mb-3">
                                                      <label for="cert_self_declaration_lab">Self-declaration - Lab Tests <span class="req">*</span></label>
                                                      <input type="file" class="form-control" name="cert_self_declaration_lab" id="cert_self_declaration_lab" accept="application/pdf" />
                                                      <small>(Allowed:PDF | Size : 2MB)</small>
                                                      @if($errors->has('cert_self_declaration_lab'))
                                                         <p class="req">{{ $errors->first('cert_self_declaration_lab') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-6 form-group mb-3">
                                                      <label for="cert_draft">Draft Test Schedule <span class="req">*</span></label>
                                                      <input type="file" class="form-control" name="cert_draft" id="cert_draft" accept="application/pdf" />
                                                      <small>(Allowed:PDF | Size : 2MB)</small>
                                                      @if($errors->has('cert_draft'))
                                                         <p class="req">{{ $errors->first('cert_draft') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-6 form-group mb-3">
                                                      <label for="cert_ownership">Ownership <span class="req">*</span></label>
                                                      <input type="file" class="form-control" name="cert_ownership" id="cert_ownership" accept="application/pdf" />
                                                      <small>(Allowed:PDF | Size : 2MB)</small>
                                                      @if($errors->has('cert_ownership'))
                                                         <p class="req">{{ $errors->first('cert_ownership') }}</p>
                                                      @endif
                                                   </div>
                                                   
                                                </div>

                                                <div class="row">
                                                   <div class="form-group col-md-6">
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-application-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                     &nbsp;
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-project-solution-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                   </div>
                                               </div>
                                             </div>

                                             
                                             <div class="mpm-10 tab-pane fade" id="nav-project-solution" role="tabpanel" aria-labelledby="nav-project-solution-tab">    

                                                <div class="row">
                                                   <div class="col-sm-12 mb-3">
                                                      <h5>Details of Product/Solution offered for PoC</h5>
                                                   </div>
                                                   <div class="col-sm-12 form-group mb-3">
                                                      <label for="solution_name">Product/Solution Name <span class="req">*</span></label>
                                                      <input type="text" class="form-control" name="solution_name" id="solution_name" placeholder="Enter your product/solution name"  autocomplete="off" value="{{ old('solution_name') }}" />
                                                      @if($errors->has('solution_name'))
                                                         <p class="req">{{ $errors->first('solution_name') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-12 form-group mb-3">
                                                      <label for="solution_designed_for">Which part of the telecom network is the Product/Solution designed for <span class="req">*</span></label>
                                                      <input type="text" class="form-control" name="solution_designed_for" id="solution_designed_for" placeholder="Enter the part of the telecom network your product/solution is designed for"  autocomplete="off" value="{{ old('solution_designed_for') }}" />
                                                      @if($errors->has('solution_designed_for'))
                                                         <p class="req">{{ $errors->first('solution_designed_for') }}</p>
                                                      @endif

                                                      <small>Please provide a brief description of the product/solution and its intended use as a separate annexure.</small>
                                                   </div>
                                                   <div class="col-sm-12 form-group mb-3">
                                                      <label for="solution_compiles_to">Name of standard/specification to which the product/solution complies to <span class="req">*</span></label>
                                                      <input type="text" class="form-control" name="solution_compiles_to" id="solution_compiles_to" placeholder="Enter the standard/specification name"  value="{{ old('solution_compiles_to') }}" autocomplete="off" />
                                                      @if($errors->has('solution_compiles_to'))
                                                         <p class="req">{{ $errors->first('solution_compiles_to') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-12 form-group mb-3">
                                                      <label for="solution_source">Is there any similar product/solution already available in the market? If yes, information on sources may be provided <span class="req">*</span></label>

                                                      <input type="text" class="form-control" name="solution_source" id="solution_source" placeholder="Provide information on similar products/solutions in the market, if any"  autocomplete="off" value="{{ old('solution_source') }}" />

                                                      @if($errors->has('solution_source'))
                                                         <p class="req">{{ $errors->first('solution_source') }}</p>
                                                      @endif

                                                   </div>
                                                   <div class="col-sm-12 form-group mb-3">
                                                      <label for="solution_telecom">If there is no similar product/solution already available in the market,
                                                      how will your product/solution add value to the telecom industry <span class="req">*</span></label>

                                                      <input type="text" class="form-control" name="solution_telecom" id="solution_telecom" placeholder="Explain how your product/solution will add value to the telecom industry in the absence of similar products"  autocomplete="off" value="{{ old('solution_telecom') }}" />
                                                      @if($errors->has('solution_telecom'))
                                                         <p class="req">{{ $errors->first('solution_telecom') }}</p>
                                                      @endif
                                                   </div>
                                                   <div class="col-sm-12 form-group mb-3">
                                                      <label for="solution_testing">Approximate time period required for complete PoC testing (in month) <span class="req">*</span></label>

                                                      <select name="solution_testing" id="solution_testing" class="form-control">
                                                         @for($i = 1; $i <= 30; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                         @endfor
                                                      </select>

                                                      @if($errors->has('solution_testing'))
                                                         <p class="req">{{ $errors->first('solution_testing') }}</p>
                                                      @endif
                                                   </div>
                                                </div>

                                                <div class="row">
                                                   <div class="form-group col-md-6">
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-documents-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                     &nbsp;
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-infrastructure-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                   </div>
                                               </div>

                                             </div>

                                             <div class="mpm-10 tab-pane fade" id="nav-infrastructure" role="tabpanel" aria-labelledby="nav-infrastructure-tab">    
                                                <div class="row">
                                                   <div class="col-sm-12 mb-3">
                                                      <h5>Infrastructure Requirements expected to be provided by BSNL </h5>
                                                   </div>
                                             
                                                      <div class="col-sm-6 form-group mb-3">
                                                         <label for="bsnl_voltage">Power (Specify voltage and current): <span class="req">*</span></label>
                                                         <div class="input-group">
                                                            <input type="text" class="form-control" name="bsnl_voltage" id="bsnl_voltage" placeholder="Voltage"  value="{{ old('bsnl_voltage') }}" autocomplete="off" />
                                                            <input type="text" class="form-control" name="bsnl_current" id="bsnl_current" placeholder="Current"  autocomplete="off" value="{{ old('bsnl_current') }}" />

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
                                                         <label for="bsnl_space">Space (Specify dimensions and any special requirements) <span class="req">*</span></label>
                                                         <input type="text" class="form-control" name="bsnl_space" id="bsnl_space" placeholder="Square Feet" value="{{ old('bsnl_space') }}" autocomplete="off" />
                                                         @if($errors->has('bsnl_space'))
                                                            <p class="req">{{ $errors->first('bsnl_space') }}</p>
                                                         @endif
                                                      </div>
                                                      <div class="col-sm-6 form-group mb-3">
                                                         <label for="bsnl_port">Transmission Port <span class="req">*</span></label>
                                                         <input type="text" class="form-control" name="bsnl_port" id="bsnl_port" placeholder="Transmission port"  value="{{ old('bsnl_port') }}" autocomplete="off" />
                                                         @if($errors->has('bsnl_port'))
                                                            <p class="req">{{ $errors->first('bsnl_port') }}</p>
                                                         @endif
                                                      </div>
                                                      <div class="col-sm-6 form-group mb-3">
                                                         <label for="bsnl_bandwidth">Bandwidth <span class="req">*</span></label>
                                                         <input type="text" class="form-control" name="bsnl_bandwidth" id="bsnl_bandwidth" placeholder="Bandwidth"  value="{{ old('bsnl_bandwidth') }}" autocomplete="off" />
                                                         @if($errors->has('bsnl_bandwidth'))
                                                            <p class="req">{{ $errors->first('bsnl_bandwidth') }}</p>
                                                         @endif
                                                      </div>
                                                      <div class="col-sm-6 form-group mb-3">
                                                         <label for="bsnl_testing_location">Preferred PoC Testing Location: <span class="req">*</span></label>

                                                         <p><select name="bsnl_testing_location" id="bsnl_testing_location" class="form-control bsnl_testing_location">
                                                               <option value="">-- Select --</option>
                                                               <option value="local">Local</option>
                                                               <!-- @foreach($cities as $city)
                                                                  <option value="{{ $city->id }}"> {{ $city->name }}</option>
                                                               @endforeach -->
                                                         </select>
                                                      </p>


                                                         <!-- <input type="text" class="form-control" name="bsnl_testing_location" id="bsnl_testing_location" placeholder="Preferred PoC Testing location"  value="{{ old('bsnl_testing_location') }}" autocomplete="off" /> -->
                                                         @if($errors->has('bsnl_testing_location'))
                                                            <p class="req">{{ $errors->first('bsnl_testing_location') }}</p>
                                                         @endif
                                                      </div>
                                                      <div class="col-sm-6 form-group mb-3">
                                                         <label for="requirements">Any Other Requirement</label>
                                                         <textarea class="form-control" name="requirements" id="requirements" placeholder="Provide any other Requirement"  autocomplete="off">{{ old('requirements') }}</textarea>
                                                         @if($errors->has('requirements'))
                                                            <p class="req">{{ $errors->first('requirements') }}</p>
                                                         @endif
                                                      </div>
                                                </div>

                                                <div class="row">
                                                   <div class="form-group col-md-6">
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-project-solution-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                     &nbsp;
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-payment-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                   </div>
                                               </div>
                                                
                                             </div>

                                             <div class="mpm-10 tab-pane fade" id="nav-payment-plan" role="tabpanel" aria-labelledby="nav-payment-plan-tab">    

                                                 <div class="row mb-3">
                                                   

                                                   <div class="col-sm-12 form-group">
                                                      <label for="payment_mode">Payment Mode <span class="req">*</span></label>
                                                      <select class="form-control" name="payment_mode" id="payment_mode" onchange="pay_mode(this.value)">
                                                         <option value="">-- Select --</option>
                                                         <option value="dd">DD/Banker Cheque</option>
                                                         <option value="online">Online (NEFT/RTGS)</option>
                                                         <option value="upi">UPI</option>
                                                      </select>
                                                      @if($errors->has('payment_mode'))
                                                         <p class="req">{{ $errors->first('payment_mode') }}</p>
                                                      @endif
                                                   </div>

                                                   <div class="row payment_box d-none">

                                                      <div class="col-sm-12 mb-3">
                                                         <h5>Details of payment of Registration fee</h5>
                                                      </div>

                                                      <div class="col-sm-6 form-group mb-3" id="dd_banker_cheque">
                                                         <label for="cheque_no">DD/Banker's Cheque Number <span class="req">*</span></label>
                                                         <input type="text" class="form-control" name="cheque_no" id="cheque_no" placeholder="Enter DD/Banker's Cheque Number" value="{{ old('cheque_no') }}"  autocomplete="off" />
                                                         @if($errors->has('cheque_no'))
                                                            <p class="req">{{ $errors->first('cheque_no') }}</p>
                                                        @endif
                                                      </div>


                                                      <div class="col-sm-6 form-group mb-3">
                                                         <label for="amount">Amount <span class="req">*</span></label>
                                                         <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter the amount" value="{{ old('amount') }}"  autocomplete="off" />
                                                         @if($errors->has('amount'))
                                                            <p class="req">{{ $errors->first('amount') }}</p>
                                                         @endif
                                                      </div>


                                                      <div class="col-sm-6 form-group mb-3">
                                                         <label for="issue_date">Date of Issue <span class="req">*</span></label>
                                                         <input type="text" class="form-control datepicker" name="issue_date" id="issue_date"  value="{{ old('issue_date') != '' ? old('issue_date') : date('Y-m-d')  }}" autocomplete="off" />
                                                         @if($errors->has('issue_date'))
                                                            <p class="req">{{ $errors->first('issue_date') }}</p>
                                                         @endif
                                                      </div>

                                                      <div class="col-sm-6 form-group mb-3 mt-2">
                                                         <label for="issue_branch">Name of Issuing Branch &amp; Bank <span class="req">*</span></label>
                                                         <input type="text" class="form-control" name="issue_branch" id="issue_branch" placeholder="Enter issuing branch &amp; bank"  value="{{ old('issue_branch') }}" autocomplete="off" />
                                                         @if($errors->has('issue_branch'))
                                                            <p class="req">{{ $errors->first('issue_branch') }}</p>
                                                         @endif
                                                      </div>

                                                   </div>

                                                   <div class="row online_box d-none">

                                                         <div class="col-sm-6 form-group mt-2">
                                                            <label for="transaction">Transaction Receipt <span class="req">*</span></label>
                                                            <input type="file" class="form-control" name="transaction_receipt" id="transaction_receipt" placeholder="Upload Transaction Receipt" autocomplete="off" />
                                                            @if($errors->has('transaction_receipt'))
                                                               <p class="req">{{ $errors->first('transaction_receipt') }}</p>
                                                            @endif
                                                         </div>
                                                   </div>

                                                 </div>

                                                <div class="row">
                                                   <div class="form-group col-md-6">
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-infrastructure-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                     &nbsp;
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-declaration-funding-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                   </div>
                                               </div>

                                             </div>
                                             
                                             <div class="mpm-10 tab-pane fade" id="nav-declaration-funding" role="tabpanel" aria-labelledby="nav-declaration-funding-tab">
                                                <div class="row">
                                                   <!-- 6. -->

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
                                                      <p><input type="checkbox" name="terms" class="form-check d-inline" id="terms" value="1" {{ old('terms') == 1 ? "checked" : "" }}><label for="chb" class="form-check-label">&nbsp;I accept all terms and conditions. <span class="req">*</span></label></p>

                                                   </div>

                                                   <div class="col-sm-6 form-group ">
                                                      <div class="input-group ">
                                                         <!-- <label for="signature" class="mb-0 align-self-center">Signature of Authorized Signatory:</label> -->
                                                         <div class="input-group-append">
                                                            <label class="input-group-text border-0" for="signature">Signature of
                                                            Authorized
                                                            Signatory:</label>
                                                            <input type="file" class="form-control" name="signature" id="signature" accept=".png, .jpg, .jpeg" />
                                                            <small>(Allowed:PNG,JPG,JPEG | Size : 2MB)</small>
                                                            @if($errors->has('signature'))
                                                               <p class="req">{{ $errors->first('signature') }}</p>
                                                            @endif
                                                         </div>
                                                      </div>
                                                   </div>

                                               </div>   

                                                <div class="row">
                                                   <div class="form-group col-md-6">
                                                     <button onclick="$('#poc_bsnl .nav-tabs button#nav-payment-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                   </div>
                                                   <div class="row mt-2">
                                                      <button type="submit" id="sbmitbtn" class="btn btn-primary">Submit</button>
                                                   </div>
                                               </div>

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
 <script src="{{ asset('assets/js/jquery.validate.min.js?v=1.0') }}"></script>
 <script src="{{ asset('assets/js/poc-bsnl-validation.js?v=' . rand(111111,999999)) }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script>
      $(document).ready(function() {

          $('.bsnl_testing_location').select2({placeholder: 'Select city'});
          $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd', startDate: '{{ date('Y-m-d', strtotime('-3 months')) }}' });
      });
    </script>
@endpush
