@extends('layouts.app')
@section('title', '- APPLICATION FORM FOR 6G RESEARCH PROPOSALS')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css?v=1.0') }}" />   
<style type="text/css">
.form-group, .form-group label{margin-bottom:5px}
.form-group{margin-bottom:20px}
h4{margin-bottom:15px}
.required{color:#ea0404}
.mrgn-5{margin:5px 0 0 0}
.sm{font-size:10px;color:#949330;letter-spacing:0.4px}
.mpm-10{padding-top:20px}
.req, .error{font-weight:normal;}
.smf{font-size:9px;font-weight: normal}
ul.err li,.err {color:#ff0000;}  
.err{background: #fce8e8;border:1px solid #f3bfbf;line-height:40px;padding: 0 10px;margin-bottom:20px;border-radius:2px}
.internet{background:#fedbdc;font-weight:normal;line-height:30px;border-radius:0px;color: #c21919;border:1px solid #9d1111;margin-left:12px}
</style>
@endpush
@section('content')

@php
    date_default_timezone_set("Asia/kolkata");
    $time = strtotime("2024-04-07 23:59:59");
    $current_time = time();
@endphp
    
    @if($time >= $current_time OR Auth::user()->id == 1616)
     
      <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">6G APPLICATION FORM</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                 <!-- form -->

                                    <div id="validation_block" class="err d-none"></div>

                                    <nav>
                                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-organization-tab" data-bs-toggle="tab" data-bs-target="#nav-organization" type="button" role="tab" aria-controls="nav-organization" aria-selected="true">Organization</button>

                                        <button class="nav-link" id="nav-collaborator-tab" data-bs-toggle="tab" data-bs-target="#nav-collaborator" type="button" role="tab" aria-controls="nav-collaborator" aria-selected="true">Collaborator</button>

                                        <button class="nav-link" id="nav-project-details-tab" data-bs-toggle="tab" data-bs-target="#nav-project-details" type="button" role="tab" aria-controls="nav-project-details" aria-selected="false">Project Details</button>

                                        <button class="nav-link" id="nav-product-desc-tab" data-bs-toggle="tab" data-bs-target="#nav-product-desc" type="button" role="tab" aria-controls="nav-product-desc" aria-selected="false">Product Description</button>

                                        <button class="nav-link" id="nav-project-plan-tab" data-bs-toggle="tab" data-bs-target="#nav-project-plan" type="button" role="tab" aria-controls="nav-project-plan" aria-selected="false">Project Plan</button>

                                        <button class="nav-link" id="nav-funding-tab" data-bs-toggle="tab" data-bs-target="#nav-funding" type="button" role="tab" aria-controls="nav-funding" aria-selected="false">Funding</button>

                                        <button class="nav-link" id="nav-regulatory-tab" data-bs-toggle="tab" data-bs-target="#nav-regulatory" type="button" role="tab" aria-controls="nav-regulatory" aria-selected="false">Regulatory approvals</button>

                                      </div>
                                    </nav>


                                    <div class="tab-content" id="nav-tabContent">

                                        <div class="mpm-10 tab-pane fade show active" id="nav-organization" role="tabpanel" aria-labelledby="nav-organization-tab">

                                            <form action="#" name="6g_user_form_organization" id="6g_user_form_organization" accept-charset="utf-8" method="post" enctype='multipart/form-data' novalidate>
                                                
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="organization_name">Organization Name <span class="required">*</span></label>
                                                      <input autocomplete="off" type="text" class="form-control" id="organization_name" placeholder="Organization Name" name="organization_name" value="{{ $application->organization_name ?? '' }}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="nodal_contact_person">Nodal Contact Person <span class="required">*</span></label>
                                                      <input autocomplete="off" type="text" class="form-control" id="nodal_contact_person" placeholder="Nodal Contact Person" name="nodal_contact_person" value="{{ $application->nodal_contact_person ?? '' }}" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="designation">Designation <span class="required">*</span></label>
                                                      <input autocomplete="off" type="text" class="form-control" id="designation" placeholder="Designation" name="designation" value="{{ $application->designation ?? '' }}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="authorization_letter">Authorization Letter <span class="required">*</span></label>&nbsp;
                                                      <input autocomplete="off" type="file" class="form-control" id="authorization_letter" placeholder="Authorization Letter" accept="application/pdf" name="authorization_letter" />
                                                      <small class="sm">Allowed File Extension: PDF</small>
                                                      <p class="smf">Undertaking form to validate the credential of the applicant, signed by Head of Department/Head of Institute.</p>

                                                      <input type="hidden" name="authorization_letter_hidden" id="authorization_letter_hidden" value="{{ $application->authorization_letter  ?? ''}}" /> 

                                                      @if(isset($application->authorization_letter))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->authorization_letter) }}">{{ $application->authorization_letter }}</a></p>
                                                      @endif

                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="bio_data_professional_credentials">Bio-data/ Professional Credentials <span class="required">*</span></label>
                                                      <input type="file" name="bio_data_professional_credentials" class="form-control" id="bio_data_professional_credentials" placeholder="Bio-data/ Professional Credentials" accept="application/pdf" />
                                                      <small class="sm">Allowed File Extension: PDF</small>

                                                      <input type="hidden" name="bio_data_professional_credentials_hidden" id="bio_data_professional_credentials_hidden" value="{{ $application->bio_data_professional_credentials ?? ''}}" />

                                                      @if(isset($application->bio_data_professional_credentials))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->bio_data_professional_credentials) }}">{{ $application->bio_data_professional_credentials }}</a></p>
                                                      @endif

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="contact_no">Contact No <span class="required">*</span></label>
                                                      <input autocomplete="off" type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No" maxlength="10" value="{{ $application->contact_no ?? '' }}" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="email_id">Email Id <span class="required">*</span></label>
                                                      <input autocomplete="off" type="text" class="form-control" id="email_id" name="email_id" placeholder="Email Id" value="{{ $application->email_id ?? '' }}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="country">Country <span class="required">*</span></label>
                                                      <select name="country" class="form-control" id="country">
                                                         <option value="">-- Select --</option>
                                                         @foreach ($countries as $country)
                                                           <option {{ @$application->country == $country->id ? "selected" : "" }} value="{{ $country->id }}">{{ $country->name }}</option>
                                                         @endforeach
                                                      </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="state">State <span class="required">*</span></label>
                                                      <select name="state" class="form-control" id="state">
                                                         <option value="">-- Select --</option>
                                                      </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="ciy">City <span class="required">*</span></label>
                                                      <select name="city" class="form-control" id="city">
                                                         <option value="">-- Select --</option>
                                                      </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="address">Address <span class="required">*</span></label>
                                                      <textarea autocomplete="off" placeholder="Address" class="form-control" name="address">{{ $application->address ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="pin_no">Pin No <span class="required">*</span></label>
                                                      <input autocomplete="off" type="text" class="form-control" id="pin_no" name="pin_no" placeholder="Pin No" maxlength="10" value="{{ $application->pin_no ?? '' }}" />
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="applying_as">Applying as <span class="required">*</span></label>
                                                      <select class="form-control" name="applying_as">
                                                         <option value="Acedemia" {{ @$application->applying_as == "Acedemia" ? "selected" : "" }}>Acedemia</option>
                                                         <option value="Govt. Institution" {{ @$application->applying_as == "Govt. Institution" ? "selected" : "" }}>Govt. Institution</option>
                                                         <option value="Other Registered R&D Organization" {{ @$application->applying_as == "Other Registered R&D Organization" ? "selected" : "" }}>Other Registered R&D Organization</option>
                                                      </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <button type="submit" id="org_submit" class="btn btn-primary">Save & Next &raquo;</button>

                                                      <button onclick="$('.nav-tabs button#nav-collaborator-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                    </div>
                                                </div>

                                            </form> 
                                        </div>

                                        <div class="mpm-10 tab-pane fade" id="nav-collaborator" role="tabpanel" aria-labelledby="nav-collaborator-tab">

                                            <form action="#" name="6g_user_form_collaborator" id="6g_user_form_collaborator" accept-charset="utf-8" method="post" enctype='multipart/form-data' novalidate>
                                                @csrf
                                                    <div id="collaborator_box">

                                                    @if(isset($application->collaborators))
                                                        @if($application->collaborators->count())
                                                            @foreach($application->collaborators as $col_obj)
                                                             <div class="collaborator">
                                                                @if($loop->iteration == 1)
                                                                    <div style="text-align:right" class="text-right mb-2"><button class="btn btn-secondary" type="button" onclick="add_more()">+Add More</button></div>
                                                                @else
                                                                    <div style="text-align:right" class="text-right mb-2 col_del"><button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></div>
                                                                @endif

                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_name">Name </label>
                                                                      <input autocomplete="off" name="collaborator_name[]" type="text" class="form-control" id="collaborator_name" placeholder="Name" value="{{ $col_obj->collaborator_name }}" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_designation">Designation </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_designation" placeholder="Designation" name="collaborator_designation[]" value="{{ $col_obj->collaborator_designation }}" />
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_contact_no">Contact No </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_contact_no" placeholder="Contact No" maxlength="10" name="collaborator_contact_no[]" value="{{ $col_obj->collaborator_contact_no }}" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_email_id">Email id </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_email_id" placeholder="Email id" name="collaborator_email_id[]" value="{{ $col_obj->collaborator_email_id }}" />
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_industry_cateogory">Industry Category </label>
                                                                      <select name="collaborator_industry_cateogory[]" class="form-control">
                                                                         <option value="Startup" {{ @$col_obj->collaborator_industry_cateogory == "Startup" ? "selected" : "" }}>Startup</option>
                                                                         <option value="SME" {{ @$col_obj->collaborator_industry_cateogory == "SME" ? "selected" : "" }}>SME</option>
                                                                         <option value="MNC/DPSU" {{ @$col_obj->collaborator_industry_cateogory == "MNC/DPSU" ? "selected" : "" }}>MNC/DPSU</option>
                                                                         <option value="Institute" {{ @$col_obj->collaborator_industry_cateogory == "Institute" ? "selected" : "" }}>Institute</option>
                                                                      </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_address">Address </label>
                                                                      <textarea autocomplete="off" placeholder="Address" class="form-control" name="collaborator_address[]">{{ $col_obj->collaborator_address ?? '' }}</textarea>
                                                                    </div>
                                                                </div>



                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_biodata">Bio-data/ Professional Credentials </label>
                                                                      <input type="file" class="form-control" id="collaborator_biodata" placeholder="Bio-data/ Professional Credentials" accept="application/pdf" name="collaborator_biodata[]" />

                                                                      <input type="hidden" name="collaborator_biodata_hidden[]" id="" value="{{ $col_obj->collaborator_biodata ?? '' }}" />

                                                                      @if(isset($col_obj->collaborator_biodata))
                                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $col_obj->collaborator_biodata) }}">{{ $col_obj->collaborator_biodata }}</a></p>
                                                                      @endif
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_area_of_work">Area of work/ Domain Expertise</label>
                                                                      <input autocomplete="off" type="text" name="collaborator_area_of_work[]" class="form-control" id="collaborator_area_of_work" placeholder="Area of work/ Domain Expertise" value="{{ $col_obj->collaborator_area_of_work }}" />
                                                                   </div>
                                                                </div>


                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_size_company">Size of company (In case of LLP) </label>
                                                                      <input autocomplete="off" name="collaborator_size_company[]" type="text" class="form-control" id="collaborator_size_company" placeholder="Size of company (In case of LLP)" value="{{ $col_obj->collaborator_size_company }}" />
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_location_of_head_office_branch">Location of Head office and branches if any</label>
                                                                      <input autocomplete="off" type="text" class="form-control" name="collaborator_location_of_head_office_branch[]" id="collaborator_location_of_head_office_branch" placeholder="Location of Head office and branches if any" value="{{ $col_obj->collaborator_location_of_head_office_branch }}" />
                                                                   </div>
                                                                </div>

                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_company_turnover">Company Turnover - last three years </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_company_turnover[]" placeholder="Company Turnover - last three years" name="collaborator_company_turnover[]" value="{{ $col_obj->collaborator_company_turnover }}" />
                                                                      <input type="file" name="collaborator_company_turnover_attachment[]" autocomplete="off" placeholder="Company Turnover - last three years" class="form-control mrgn-5" />

                                                                      <input type="hidden" name="collaborator_company_turnover_attachment_hidden[]" id="" value="{{ $col_obj->collaborator_company_turnover_attachment }}" />
                                                                      @if(isset($col_obj->collaborator_company_turnover_attachment))
                                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $col_obj->collaborator_company_turnover_attachment) }}">{{ $col_obj->collaborator_company_turnover_attachment }}</a></p>
                                                                      @endif
                                                                   </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @else
                                                                                                                    <div class="collaborator">
                                                                <div style="text-align:right" class="text-right mb-2"><button class="btn btn-secondary" type="button" onclick="add_more()">+Add More</button>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_name">Name </label>
                                                                      <input autocomplete="off" name="collaborator_name[]" type="text" class="form-control" id="collaborator_name" placeholder="Name" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_designation">Designation </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_designation" placeholder="Designation" name="collaborator_designation[]" />
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_contact_no">Contact No </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_contact_no" placeholder="Contact No" maxlength="10" name="collaborator_contact_no[]" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_email_id">Email id </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_email_id" placeholder="Email id" name="collaborator_email_id[]" />
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_industry_cateogory">Industry Category </label>
                                                                      <select name="collaborator_industry_cateogory[]" class="form-control">
                                                                         <option value="Startup">Startup</option>
                                                                         <option value="SME">SME</option>
                                                                         <option value="MNC/DPSU">MNC/DPSU</option>
                                                                         <option value="Institute">Institute</option>
                                                                      </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_address">Address </label>
                                                                      <textarea autocomplete="off" placeholder="Address" class="form-control" name="collaborator_address[]"></textarea>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_biodata">Bio-data/ Professional Credentials </label>
                                                                      <input type="file" class="form-control" id="collaborator_biodata" placeholder="Bio-data/ Professional Credentials" accept="application/pdf" name="collaborator_biodata[]" />
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_area_of_work">Area of work/ Domain Expertise</label>
                                                                      <input autocomplete="off" type="text" name="collaborator_area_of_work[]" class="form-control" id="collaborator_area_of_work" placeholder="Area of work/ Domain Expertise" />
                                                                   </div>
                                                                </div>


                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_size_company">Size of company (In case of LLP) </label>
                                                                      <input autocomplete="off" name="collaborator_size_company[]" type="text" class="form-control" id="collaborator_size_company" placeholder="Size of company (In case of LLP)" />
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_location_of_head_office_branch">Location of Head office and branches if any</label>
                                                                      <input autocomplete="off" type="text" class="form-control" name="collaborator_location_of_head_office_branch[]" id="collaborator_location_of_head_office_branch" placeholder="Location of Head office and branches if any" />
                                                                   </div>
                                                                </div>

                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_company_turnover">Company Turnover - last three years </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_company_turnover" placeholder="Company Turnover - last three years" name="collaborator_company_turnover[]" />
                                                                      <input type="file" name="collaborator_company_turnover_attachment[]" autocomplete="off" placeholder="Company Turnover - last three years" class="form-control mrgn-5" />
                                                                   </div>
                                                                </div>
                                                            </div>

                                                        @endif
                                                    @else
                                                            <div class="collaborator">
                                                                <div style="text-align:right" class="text-right mb-2"><button class="btn btn-secondary" type="button" onclick="add_more()">+Add More</button>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_name">Name </label>
                                                                      <input autocomplete="off" name="collaborator_name[]" type="text" class="form-control" id="collaborator_name" placeholder="Name" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_designation">Designation </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_designation" placeholder="Designation" name="collaborator_designation[]" />
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_contact_no">Contact No </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_contact_no" placeholder="Contact No" maxlength="10" name="collaborator_contact_no[]" />
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_email_id">Email id </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_email_id" placeholder="Email id" name="collaborator_email_id[]" />
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_industry_cateogory">Industry Category </label>
                                                                      <select name="collaborator_industry_cateogory[]" class="form-control">
                                                                         <option value="Startup">Startup</option>
                                                                         <option value="SME">SME</option>
                                                                         <option value="MNC/DPSU">MNC/DPSU</option>
                                                                         <option value="Institute">Institute</option>
                                                                      </select>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                      <label for="collaborator_address">Address </label>
                                                                      <textarea autocomplete="off" placeholder="Address" class="form-control" name="collaborator_address[]"></textarea>
                                                                    </div>
                                                                </div>


                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_biodata">Bio-data/ Professional Credentials </label>
                                                                      <input type="file" class="form-control" id="collaborator_biodata" placeholder="Bio-data/ Professional Credentials" accept="application/pdf" name="collaborator_biodata[]" />
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_area_of_work">Area of work/ Domain Expertise</label>
                                                                      <input autocomplete="off" type="text" name="collaborator_area_of_work[]" class="form-control" id="collaborator_area_of_work" placeholder="Area of work/ Domain Expertise" />
                                                                   </div>
                                                                </div>


                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_size_company">Size of company (In case of LLP) </label>
                                                                      <input autocomplete="off" name="collaborator_size_company[]" type="text" class="form-control" id="collaborator_size_company" placeholder="Size of company (In case of LLP)" />
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_location_of_head_office_branch">Location of Head office and branches if any</label>
                                                                      <input autocomplete="off" type="text" class="form-control" name="collaborator_location_of_head_office_branch[]" id="collaborator_location_of_head_office_branch" placeholder="Location of Head office and branches if any" />
                                                                   </div>
                                                                </div>

                                                                <div class="row">
                                                                   <div class="form-group col-md-6">
                                                                      <label for="collaborator_company_turnover">Company Turnover - last three years </label>
                                                                      <input autocomplete="off" type="text" class="form-control" id="collaborator_company_turnover" placeholder="Company Turnover - last three years" name="collaborator_company_turnover[]" />
                                                                      <input type="file" name="collaborator_company_turnover_attachment[]" autocomplete="off" placeholder="Company Turnover - last three years" class="form-control mrgn-5" />
                                                                   </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                            

                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                          <button onclick="$('.nav-tabs button#nav-organization-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                          &nbsp;
                                                          <button type="submit" id="colaborator_submit" class="btn btn-primary">Save & Next &raquo;</button>
                                                          &nbsp;
                                                          <button onclick="$('.nav-tabs button#nav-project-details-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                        </div>
                                                    </div>
                                            </form>


                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-project-details" role="tabpanel" aria-labelledby="nav-project-details-tab">

                                            <form action="#" name="6g_user_form_project_details" id="6g_user_form_project_details" accept-charset="utf-8" method="post" enctype='multipart/form-data' novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="proposed_project_title">Proposed Project Title <span class="required">*</span></label>
                                                      <input autocomplete="off" type="text" class="form-control" id="proposed_project_title" placeholder="Proposed Project Tile" name="proposed_project_title" value="{{ $application->proposed_project_title ?? '' }}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="proposed_product_area_category">Proposed Product area category <span class="required">*</span></label>
                                                      <select name="proposed_product_area_category" class="form-control">
                                                         <option value="Product (Module/Sub Module)" {{ @$application->proposed_product_area_category == "Product (Module/Sub Module)" ? "selected" : "" }}>Product (Module/Sub Module)</option>
                                                         <option value="Solution (Software Application)" {{ @$application->proposed_product_area_category == "Solution (Software Application)" ? "selected" : "" }}>Solution (Software Application)</option>
                                                      </select>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="technology_area">Technology Area <span class="required">*</span></label>
                                                      <select name="technology_area" class="form-control">
                                                         <option value="Semantic Communication" {{ @$application->technology_area == "Semantic Communication" ? "selected" : "" }}>Semantic Communication</option>
                                                         <option value="Blockchain for Edge" {{ @$application->technology_area == "" ? "selected" : "Blockchain for Edge" }}>Blockchain for Edge</option>
                                                         <option value="Deep Learning for Communication" {{ @$application->technology_area == "Deep Learning for Communication" ? "selected" : "" }}>Deep Learning for Communication</option>
                                                         <option value="Fluid cells and Antennas" {{ @$application->technology_area == "Fluid cells and Antennas Previous" ? "selected" : "" }}>Fluid cells and Antennas</option>
                                                         <option value="Ubiquitous Connectivity" {{ @$application->technology_area == "Ubiquitous Connectivity" ? "selected" : "" }}>Ubiquitous Connectivity</option>
                                                         <option value="Internet of Nano-Things and bio-nano things" {{ @$application->technology_area == "Internet of Nano-Things and bio-nano things" ? "selected" : "" }}>Internet of Nano-Things and bio-nano things</option>
                                                         <option value="Holistic Security Solutions" {{ @$application->technology_area == "Holistic Security Solutions" ? "selected" : "" }}>Holistic Security Solutions</option>
                                                         <option value="Generative Adversarial Networks" {{ @$application->technology_area == "Generative Adversarial Networks" ? "selected" : "" }}>Generative Adversarial Networks</option>
                                                         <option value="Blockchain for Infrastructure" {{ @$application->technology_area == "Blockchain for Infrastructure" ? "selected" : "" }}>Blockchain for Infrastructure</option>
                                                         <option value="Urban Micro-Space" {{ @$application->technology_area == "Urban Micro-Space" ? "selected" : "" }}>Urban Micro-Space</option>
                                                         <option value="Augmentation of Human Intelligence" {{ @$application->technology_area == "Augmentation of Human Intelligence" ? "selected" : "" }}>Augmentation of Human Intelligence</option>
                                                         <option value="THz Communication Systems" {{ @$application->technology_area == "THz Communication Systems" ? "selected" : "" }}>THz Communication Systems</option>
                                                         <option value="Spectrum Sensing and sharing" {{ @$application->technology_area == "Spectrum Sensing and sharing" ? "selected" : "" }}>Spectrum Sensing and sharing</option>
                                                         <option value="Artificial Neural Networks for Communication" {{ @$application->technology_area == "Artificial Neural Networks for Communication" ? "selected" : "" }}>Artificial Neural Networks for Communication</option>
                                                         <option value="Acoustic Meta-Learning" {{ @$application->technology_area == "Acoustic Meta-Learning" ? "selected" : "" }}>Acoustic Meta-Learning</option>
                                                         <option value="Quantum and QC Assisted Communications" {{ @$application->technology_area == "Quantum and QC Assisted Communications" ? "selected" : "" }}>Quantum and QC Assisted Communications</option>
                                                         <option value="Six Sense Communication Network" {{ @$application->technology_area == "Six Sense Communication Network" ? "selected" : "" }}>Six Sense Communication Network</option>
                                                         <option value="Genetic Programming" {{ @$application->technology_area == "Genetic Programming" ? "selected" : "" }}>Genetic Programming</option>
                                                         <option value="Framework of HC2WA" {{ @$application->technology_area == "Framework of HC2WA" ? "selected" : "" }}>Framework of HC2WA</option>
                                                         <option value="Other" {{ @$application->technology_area == "Other" ? "selected" : "" }}>Other</option>
                                                      </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="stage_of_product_based_on_minimum_technology_readiness_level">Stage of Product based on minimum Technology Readiness Level (TRL) <span class="required">*</span> </label>
                                                      <select name="stage_of_product_based_on_minimum_technology_readiness_level" class="form-control">
                                                         <option value="TRL9 Operations" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL9 Operations" ? "selected" : "" }}>TRL9 Operations</option>
                                                         <option value="TRL8 Active Commissioning" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL8 Active Commissioning" ? "selected" : "" }}>TRL8 Active Commissioning</option>
                                                         <option value="TRL7 inactive Commissioning" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL7 inactive Commissioning" ? "selected" : "" }}>TRL7 inactive Commissioning</option>
                                                         <option value="TRL6 Large Scale" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL6 Large Scale" ? "selected" : "" }}>TRL6 Large Scale</option>
                                                         <option value="TRL5 Pilot Scale" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL5 Pilot Scale" ? "selected" : "" }}>TRL5 Pilot Scale</option>
                                                         <option value="TRL4 Bench Scale Research" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL4 Bench Scale Research" ? "selected" : "" }}>TRL4 Bench Scale Research</option>
                                                         <option value="TRL3 Proof of Concept" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL3 Proof of Concept" ? "selected" : "" }}>TRL3 Proof of Concept</option>
                                                         <option value="TRL2-Technolgy Concept and/or Application Formulated" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL2-Technolgy Concept and/or Application Formulated" ? "selected" : "" }}>TRL2-Technolgy Concept and/or Application Formulated</option>
                                                         <option value="TRL 1-Basic Technology Research/Idea Inception" {{ @$application->stage_of_product_based_on_minimum_technology_readiness_level == "TRL 1-Basic Technology Research/Idea Inception" ? "selected" : "" }}>TRL 1-Basic Technology Research/Idea Inception</option>
                                                      </select>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="collaboration_customers_clients">Collaboration/ Customers/ Clients if any </label>
                                                      <textarea autocomplete="off" placeholder="Collaboration/ Customers/ Clients if any" class="form-control" name="collaboration_customers_clients">{{ $application->collaboration_customers_clients ?? '' }}</textarea>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="list_of_ipr_awards_paper_published">List of IPR/ Awards/ Paper Published if any </label>
                                                      <textarea autocomplete="off" placeholder="List of IPR/ Awards/ Paper Published if any" class="form-control" name="list_of_ipr_awards_paper_published">{{ $application->list_of_ipr_awards_paper_published ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="relevant_standards_standard_body_membership">Relevant Standards/Standard Body membership/ contributions/Certification Testing (TEC/ Security) if any </label>
                                                      <textarea autocomplete="off" name="relevant_standards_standard_body_membership" placeholder="Relevant Standards/Standard Body membership/ contributions/Certification Testing (TEC/ Security) if any" class="form-control">{{ $application->relevant_standards_standard_body_membership ?? '' }}</textarea>
                                                    </div>

                                                </div>
                                            


                                                <div class="row">
                                                    <div class="form-group col-md-6">

                                                     <button onclick="$('.nav-tabs button#nav-collaborator-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                    &nbsp;

                                                     <button type="submit" id="proj_details_submit" class="btn btn-primary">Save & Next &raquo;</button>
&nbsp;
                                                      <button onclick="$('.nav-tabs button#nav-product-desc-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                    </div>
                                                </div>

                                            </form>


                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-product-desc" role="tabpanel" aria-labelledby="nav-product-desc-tab">
                                        <form action="#" name="6g_user_form_product_desc" id="6g_user_form_product_desc" accept-charset="utf-8" method="post" enctype='multipart/form-data' novalidate>
                                            @csrf
                                            <!-- <h5>Product Description</h5><br /> -->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="brief_product_solution_idea_description">Brief product/ solution/ idea description<span class="required">*</span></label>
                                                  <textarea autocomplete="off" placeholder="Brief product/ solution/ idea description" class="form-control" name="brief_product_solution_idea_description">{{ $application->brief_product_solution_idea_description ?? '' }}</textarea>
                                                  <input type="file" name="brief_product_solution_idea_description_attachment" class="form-control mrgn-5" />

                                                  <input type="hidden" name="brief_product_solution_idea_description_attachment_hidden" id="$application->brief_product_solution_idea_description_attachment" value="{{ $application->brief_product_solution_idea_description_attachment ?? ''}}" /> 

                                                  @if(isset($application->brief_product_solution_idea_description_attachment))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->brief_product_solution_idea_description_attachment) }}">{{ $application->brief_product_solution_idea_description_attachment }}</a></p>
                                                  @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="primary_objective_of_module_sub_system_product_solution_proposed">Primary Objective of the module/ sub-system/system/product/Solution proposed <span class="required">*</span></label>
                                                  <input autocomplete="off" type="text" class="form-control" id="primary_objective_of_module_sub_system_product_solution_proposed" placeholder="Primary Objective of the module/ sub-system/system/product/Solution proposed" name="primary_objective_of_module_sub_system_product_solution_proposed" value="{{ $application->primary_objective_of_module_sub_system_product_solution_proposed ?? '' }}" />
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="key_deliverables">Key deliverables <span class="required">*</span></label>
                                                  <textarea autocomplete="off" placeholder="Key deliverables" class="form-control" name="key_deliverables">{{ $application->key_deliverables ?? '' }}</textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="type_of_solution_product">Type of solution/product-Stand-alone/ Sub-system/ Application/Complete system/product <span class="required">*</span></label>
                                                  <select name="type_of_solution_product" class="form-control">
                                                     <option value="Product Stand Alone" {{ @$application->type_of_solution_product == "Product Stand Alone" ? "selected" : "" }}>Product Stand Alone</option>
                                                     <option value="Sub System" {{ @$application->type_of_solution_product == "Sub System" ? "selected" : "" }}>Sub System</option>
                                                     <option value="Application" {{ @$application->type_of_solution_product == "Application" ? "selected" : "" }}>Application</option>
                                                     <option value="Complete System" {{ @$application->type_of_solution_product == "Complete System" ? "selected" : "" }}>Complete System</option>
                                                     <option value="Product" {{ @$application->type_of_solution_product == "Product" ? "selected" : "" }}>Product</option>
                                                  </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="details_prior_experience">Details of prior experience, expertise and components/ sub-systems/product developed in selected area of interest. </label>
                                                  <textarea autocomplete="off" placeholder="" class="form-control" name="details_prior_experience">{{ $application->details_prior_experience  ?? '' }}</textarea>
                                                </div>

                                                <div class="form-group col-md-6">
                                                  <label for="if_the_proposed_solution_product">(If the proposed solution/product is not stand-along and/or a module, please provide details of the larger solution it caters to/ required to integrate to arrive at full solution) </label>
                                                  <textarea autocomplete="off" placeholder="" class="form-control" name="if_the_proposed_solution_product">{{ $application->if_the_proposed_solution_product  ?? '' }}</textarea>
                                                </div>

                                            </div>


                                            <div class="row">
                                                
                                                <div class="form-group col-md-6">
                                                  <label for="is_product_tech_related_to_present_activities">Is the product/ technology related to present activities/products being developed by DOT? If so, how does the product tie in with present activities/ products, being developed by DOT? </label>
                                                  <textarea autocomplete="off" placeholder="" class="form-control" name="is_product_tech_related_to_present_activities">{{ $application->is_product_tech_related_to_present_activities  ?? ''}}</textarea>
                                                </div>

                                                <div class="form-group col-md-6">
                                                  <label for="is_it_new_concept_design_sol_product">Is it a new concept/design/ solution/ product? If so, What are relevant standards being adopted? </label>
                                                  <textarea autocomplete="off" placeholder="" class="form-control" name="is_it_new_concept_design_sol_product">{{ $application->is_it_new_concept_design_sol_product  ?? '' }}</textarea>
                                                </div>

                                            </div>


                                            <div class="row">
                                                
                                                <div class="form-group col-md-6">
                                                  <label for="are_there_any_alternate_competive_tech_product">Are there any alternate competitive technology/product? available/ under development locally / outside India? Please provide the information available with you. What is the comparison of performance/ specification/ features? </label>
                                                  <textarea autocomplete="off" placeholder="" class="form-control" name="are_there_any_alternate_competive_tech_product">{{ $application->are_there_any_alternate_competive_tech_product  ?? ''}}</textarea>
                                                </div>

                                                <div class="form-group col-md-6">
                                                  <label for="provide_the_specification_doc_relavant_to_product">Provide the specification document relevant to your product? <span class="required">*</span></label>
                                                  <input type="file" class="form-control" name="provide_the_specification_doc_relavant_to_product" />

                                                  <input type="hidden" name="provide_the_specification_doc_relavant_to_product_hidden" id="provide_the_specification_doc_relavant_to_product_hidden" value="{{ $application->provide_the_specification_doc_relavant_to_product  ?? ''}}" />

                                                  @if(isset($application->provide_the_specification_doc_relavant_to_product))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->provide_the_specification_doc_relavant_to_product) }}">{{ $application->provide_the_specification_doc_relavant_to_product }}</a></p>
                                                      @endif
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">

                                                  <button onclick="$('.nav-tabs button#nav-project-details-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                  &nbsp;

                                                  <button type="submit" id="proj_desc_submit" class="btn btn-primary">Save & Next &raquo;</button>

                                                  &nbsp;

                                                  <button onclick="$('.nav-tabs button#nav-project-plan-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                </div>
                                            </div>

                                            </form>

                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-project-plan" role="tabpanel" aria-labelledby="nav-project-plan-tab">
                                            <!-- <h5>Project Plan</h5><br /> -->
                                             <form action="#" name="6g_user_form_project_plan" id="6g_user_form_project_plan" accept-charset="utf-8" method="post" enctype='multipart/form-data' novalidate>
                                                @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="provide_dev_plan_indicate_major_milestone">Provide development Plan indicating the major milestone and respective cost break up of each milestone Provide bar chart/ project plan <span class="required">*</span></label>
                                                  <textarea autocomplete="off" placeholder="" class="form-control" name="provide_dev_plan_indicate_major_milestone">{{ $application->provide_dev_plan_indicate_major_milestone ?? '' }}</textarea>
                                                  <input type="file" name="provide_dev_plan_indicate_major_milestone_attachment" class="form-control mrgn-5" />

                                                  <input type="hidden" name="provide_dev_plan_indicate_major_milestone_attachment_hidden" id="provide_dev_plan_indicate_major_milestone_attachment_hidden" value="{{ $application->provide_dev_plan_indicate_major_milestone_attachment ?? ''}}" />

                                                    @if(isset($application->provide_dev_plan_indicate_major_milestone_attachment))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->provide_dev_plan_indicate_major_milestone_attachment) }}">{{ $application->provide_dev_plan_indicate_major_milestone_attachment ?? '' }}</a></p>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="inputPassword4">Manpower support requirements <span class="required">*</span> </label>
                                                  <textarea autocomplete="off" placeholder="Manpower support requirements" class="form-control" name="manpower_support_requirements">{{ $application->manpower_support_requirements  ?? '' }}</textarea>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="infrastructure_support_requirements">Infrastructure support requirements <span class="required">*</span></label>
                                                  <textarea autocomplete="off" placeholder="Infrastructure support requirements" class="form-control" name="infrastructure_support_requirements">{{ $application->infrastructure_support_requirements  ?? '' }}</textarea>
                                                  <input type="file" name="infrastructure_support_requirements_attachment" class="form-control mrgn-5" />

                                                  <input type="hidden" name="infrastructure_support_requirements_attachment_hidden" id="infrastructure_support_requirements_attachment_hidden" value="{{ $application->infrastructure_support_requirements_attachment ?? ''}}" />

                                                    @if(isset($application->infrastructure_support_requirements_attachment))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->infrastructure_support_requirements_attachment) }}">{{ $application->infrastructure_support_requirements_attachment }}</a></p>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="details_of_existing_tools_testers_platform">Details of Existing Tools, Testers and platform <span class="required">*</span> </label>
                                                  <textarea autocomplete="off" placeholder="Details of Existing Tools, Testers and platform" class="form-control" name="details_of_existing_tools_testers_platform">{{ $application->details_of_existing_tools_testers_platform  ?? '' }}</textarea>
                                                  <input type="file" name="details_of_existing_tools_testers_platform_attachment" class="form-control mrgn-5" />

                                                  <input type="hidden" name="details_of_existing_tools_testers_platform_attachment_hidden" id="details_of_existing_tools_testers_platform_attachment_hidden" value="{{ $application->details_of_existing_tools_testers_platform_attachment ?? ''}}" />

                                                    @if(isset($application->details_of_existing_tools_testers_platform_attachment))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->details_of_existing_tools_testers_platform_attachment) }}">{{ $application->details_of_existing_tools_testers_platform_attachment }}</a></p>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="any_additional_dev_tools_software_requirements">Any additional development tools and software requirements if any </label>
                                                  <textarea autocomplete="off" placeholder="Any additional development tools and software requirements if any" class="form-control" name="any_additional_dev_tools_software_requirements">{{ $application->any_additional_dev_tools_software_requirements  ?? '' }}</textarea>
                                                  
                                                </div>
                                            
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <button onclick="$('.nav-tabs button#nav-product-desc-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                  &nbsp;

                                                  <button type="submit" id="proj_plan_submit" class="btn btn-primary">Save & Next &raquo;</button>
                                                  &nbsp;
                                                  <button onclick="$('.nav-tabs button#nav-funding-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                </div>
                                            </div>

                                            </form>

                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-funding" role="tabpanel" aria-labelledby="nav-funding-tab">

                                             <form action="#" name="6g_user_form_funding" id="6g_user_form_funding" accept-charset="utf-8" method="post" enctype='multipart/form-data' novalidate>
                                                @csrf

                                            <!-- <h5>Funding</h5><br /> -->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="estimated_development_cost">Estimated development cost of the proposed modules/system. (Separately module wise, in case multiple modules are proposed) <span class="required">*</span></label>
                                                  <textarea autocomplete="off" placeholder="" class="form-control" name="estimated_development_cost">{{ $application->estimated_development_cost  ?? '' }}</textarea>
                                                  <input type="file" class="form-control mrgn-5" name="estimated_development_cost_attachment" />

                                                  <input type="hidden" name="estimated_development_cost_attachment_hidden" id="estimated_development_cost_attachment_hidden" value="{{ $application->estimated_development_cost_attachment ?? '' }}" />

                                                    @if(isset($application->estimated_development_cost_attachment))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->estimated_development_cost_attachment) }}">{{ $application->estimated_development_cost_attachment }}</a></p>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="fund_expected">Fund expected from this program (Separately module wise, in case multiple modules are proposed) <span class="required">*</span></label>
                                                  <input type="text" autocomplete="off" placeholder="Fund expected from this program" class="form-control" name="fund_expected" id="fund_expected" value="{{ $application->fund_expected ?? ''  }}" />
                                                </div>
                                            </div>

                                             <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="details_of_funding">Details of funding received for the Same/Similar project from other schemes of DoT/ GOI. </label>
                                                  <textarea autocomplete="off" placeholder="Details of funding received for the Same/Similar project from other schemes of DoT/ GOI." class="form-control" name="details_of_funding">{{ $application->details_of_funding ?? ''  }}</textarea>
                                                  <input type="file" class="form-control mrgn-5" name="details_of_funding_attachment" />

                                                  <input type="hidden" name="details_of_funding_attachment_hidden" id="details_of_funding_attachment_hidden" value="{{ $application->details_of_funding_attachment ?? ''}}" />

                                                    @if(isset($application->details_of_funding_attachment))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->details_of_funding_attachment) }}">{{ $application->details_of_funding_attachment }}</a></p>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="details_self_funding">Details of self-funding / other sources for the Proposed modules/system </label>
                                                  <textarea autocomplete="off" placeholder="Details of self-funding / other sources for the Proposed modules/system" class="form-control" name="details_self_funding">{{ $application->details_self_funding ?? ''  }}</textarea>
                                                  <input type="file" class="form-control mrgn-5" name="details_self_funding_attachment" />

                                                  <input type="hidden" name="details_self_funding_attachment_hidden" id="details_self_funding_attachment_hidden" value="{{ $application->details_self_funding_attachment  ?? '' }}" />

                                                    @if(isset($application->details_self_funding_attachment))
                                                        <p><a target="_blank" href="{{ url('storage/uploads/' . $application->details_self_funding_attachment) }}">{{ $application->details_self_funding_attachment }}</a></p>
                                                    @endif
                                                </div>
                                            </div>
                                        

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <button onclick="$('.nav-tabs button#nav-project-plan-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                  &nbsp;

                                                  <button type="submit" id="funding_submit" class="btn btn-primary">Save & Next &raquo;</button>
                                                  &nbsp;
                                                  <button onclick="$('.nav-tabs button#nav-regulatory-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                </div>
                                            </div>

                                            </form>

                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-regulatory" role="tabpanel" aria-labelledby="nav-regulatory-tab">

                                             <form action="#" name="6g_user_form_regulatory" id="6g_user_form_regulatory" accept-charset="utf-8" method="post" enctype='multipart/form-data' novalidate>
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="any_regulatory_approval">Any regulatory approvals required from Govt for the product/ solution being proposed.</label>
                                                      <input type="text" class="form-control mrgn-5" placeholder="Any regulatory approvals required from Govt for the product/ solution being proposed" name="any_regulatory_approval" autocomplete="off" value="{{ $application->any_regulatory_approval  ?? '' }}" />
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="any_other_remarks">Any other Remarks(Potential outcome/IPR) </label>
                                                      <textarea autocomplete="off" placeholder="Any other Remarks(Potential outcome/IPR)" name="any_other_remarks" class="form-control">{{ $application->any_other_remarks  ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                      <p><input type="checkbox" name="terms" id="terms" value="1" /> I declare that all the information given by me in this application and documents attached hereto are true to the best of my knowledge and that I have not willfully suppressed any material fact. I accept that if any of the information given by me in this application is in any way false or incorrect, my application may be rejected, any offer of the grant may be withdrawn or my candidature may be rejected at any time. I agree to adhere and comply to terms and condition given above</p>
                                                </div>


                                                <div class="row d-none" id="network_msg">
                                                    <p class="internet">Slow or no internet connection. please check you internet settings.!</p>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <button onclick="$('.nav-tabs button#nav-funding-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                    </div>

                                                    <div class="row">
                                                       <button type="submit" id="sbmitbtn" class="btn btn-primary">Submit</button>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>                  

                                 </form>

                                 <!-- close -->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                    
                </div> <!-- container -->
            </div> <!-- content -->
        </div>

@else
<div class="content-page">
     <div class="content mt-3">
         <h4>Timeline for submission of proposals on accelerated research on 6G technology has been closed on  07.04.2024.</h4>
         <h5>Thank you for your interest and submitting the innovative 6G proposals.</h5>
     </div>
</div>
@endif

@endsection

@push('scripts')
 <script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
 <script src="{{ asset('assets/js/jquery.validate.min.js?v=1.0') }}"></script>
 <script src="{{ asset('assets/js/sixgform-validation.js?v=' . rand(111111111111, 999999999999)) }}"></script>
 <script>
    let city_id = {{ $application->city ?? 0 }};
    let state_id = {{ $application->state ?? 0 }};

    $(document).ready(function() {
        $("#country").trigger('change');
    });

    $(document).on('click', '.col_del', function() {
        $(this).parent().remove();
    });

    function add_more() {
        let htm = `<div class="collaborator">
                        <div style="text-align:right" class="text-right mb-2 col_del"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button></div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="collaborator_name">Name </label>
                              <input autocomplete="off" name="collaborator_name[]" type="text" class="form-control" id="collaborator_name" placeholder="Name" />
                            </div>
                            <div class="form-group col-md-6">
                              <label for="collaborator_designation">Designation </label>
                              <input autocomplete="off" type="text" class="form-control" id="collaborator_designation" placeholder="Designation" name="collaborator_designation[]" />
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="collaborator_contact_no">Contact No </label>
                              <input autocomplete="off" type="text" class="form-control" id="collaborator_contact_no" placeholder="Contact No" maxlength="10" name="collaborator_contact_no[]" />
                            </div>
                            <div class="form-group col-md-6">
                              <label for="collaborator_email_id">Email id </label>
                              <input autocomplete="off" type="text" class="form-control" id="collaborator_email_id" placeholder="Email id" name="collaborator_email_id[]" />
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="collaborator_industry_cateogory">Industry Category </label>
                              <select name="collaborator_industry_cateogory[]" class="form-control">
                                 <option value="Startup">Startup</option>
                                 <option value="SME">SME</option>
                                 <option value="MNC/DPSU">MNC/DPSU</option>
                                 <option value="Institute">Institute</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="collaborator_address">Address </label>
                              <textarea autocomplete="off" placeholder="Address" class="form-control" name="collaborator_address[]"></textarea>
                            </div>
                        </div>



                        <div class="row">
                           <div class="form-group col-md-6">
                              <label for="collaborator_biodata">Bio-data/ Professional Credentials </label>
                              <input type="file" class="form-control" id="collaborator_biodata" placeholder="Bio-data/ Professional Credentials" accept="application/pdf" name="collaborator_biodata[]" />
                           </div>
                           <div class="form-group col-md-6">
                              <label for="collaborator_area_of_work">Area of work/ Domain Expertise</label>
                              <input autocomplete="off" type="text" name="collaborator_area_of_work[]" class="form-control" id="collaborator_area_of_work" placeholder="Area of work/ Domain Expertise" />
                           </div>
                        </div>


                        <div class="row">
                           <div class="form-group col-md-6">
                              <label for="collaborator_size_company">Size of company (In case of LLP) </label>
                              <input autocomplete="off" name="collaborator_size_company[]" type="text" class="form-control" id="collaborator_size_company" placeholder="Size of company (In case of LLP)" />
                           </div>
                           <div class="form-group col-md-6">
                              <label for="collaborator_location_of_head_office_branch">Location of Head office and branches if any</label>
                              <input autocomplete="off" type="text" class="form-control" name="collaborator_location_of_head_office_branch" id="collaborator_location_of_head_office_branch" placeholder="Location of Head office and branches if any" />
                           </div>
                        </div>

                        <div class="row">
                           <div class="form-group col-md-6">
                              <label for="collaborator_company_turnover">Company Turnover - last three years </label>
                              <input autocomplete="off" type="text" class="form-control" id="collaborator_company_turnover" placeholder="Company Turnover - last three years" name="collaborator_company_turnover[]" />
                              <input type="file" name="collaborator_company_turnover_attachment[]" autocomplete="off" placeholder="Company Turnover - last three years" class="form-control mrgn-5" />
                           </div>
                        </div>
                    </div>`;
        $('#collaborator_box').append(htm);
        $("html, body").animate({ scrollTop: $(document).height() }, 500);
    }
</script>
@endpush