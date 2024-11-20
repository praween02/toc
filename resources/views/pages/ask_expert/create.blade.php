@extends('layouts.app')
@section('title', ' - Ask Expert')
@section('content')
<style type="text/css">
   small{font-size:10px;color:#958d46;letter-spacing:0.4px}
   .datepicker-days table tr td { text-align:center;cursor:pointer; }
   ul.err li {color:#ff0000;}  
</style>
<div class="content-page">
   <div class="content">
      <!-- Start Content-->
      <div class="container">
         <!-- Form row -->
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-body">

                     <form id="expert-form" enctype="multipart/form-data" class="" action="{{ route('ask_expert.store') }}" accept-charset="utf-8" method="post">
                        @csrf

                        <div id="errors"></div>

                        <div class="row">
                           <div class="col-sm-12 mb-3">
                                 <h3 class="text-center text-info text-uppercase">Expert details form</h3>
                           </div>
                        </div>

                        <nav>
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-general-info-tab" data-bs-toggle="tab" data-bs-target="#nav-general-info" type="button" role="tab" aria-controls="nav-general-info" aria-selected="true">General Information</button>

                                <button class="nav-link" id="nav-other-info-tab" data-bs-toggle="tab" data-bs-target="#nav-other-info" type="button" role="tab" aria-controls="nav-other-info" aria-selected="true">Other Information</button>

                              </div>
                        </nav>
                        
                        <div class="" style="padding-top:10px">
                            <p class="mb-0"><span class="req">* </span>= required fields</p>
                        </div>

                        @if($errors->any())
                              {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif

                        <div class="tab-content" id="nav-tabContent">

                            <div class="mpm-10 tab-pane fade show active" id="nav-general-info" role="tabpanel" aria-labelledby="nav-general-info-tab">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="family_name">Family Name <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" placeholder="Family name" name="family_name" id="family_name" value="{{ old('family_name') }}">
                                      @if($errors->has('family_name'))
                                         <p class="req">{{ $errors->first('family_name') }}</p>
                                      @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="first_name">First Name <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" id="first_name" placeholder="First name" name="first_name" value="{{ old('first_name') }}">
                                      @if($errors->has('first_name'))
                                         <p class="req">{{ $errors->first('first_name') }}</p>
                                      @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="gender">Gender <span class="req">*</span></label>
                                      <select class="form-control" id="gender" name="gender">
                                         <option {{ old('gender') == "M" ? "selected" : "" }} value="M">M</option>
                                         <option {{ old('gender') == "F" ? "selected" : "" }} value="F">F</option>
                                      </select>
                                      @if($errors->has('gender'))
                                         <p class="req">{{ $errors->first('gender') }}</p>
                                      @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="position">Position <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" placeholder="Position" name="position" value="{{ old('position') }}" id="position" />
                                      @if($errors->has('position'))
                                         <p class="req">{{ $errors->first('position') }}</p>
                                      @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="current_organization">Current Organization <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" placeholder="Current Organization" name="current_organization" value="{{ old('current_organization') }}" id="current_organization">
                                      @if($errors->has('current_organization'))
                                         <p class="req">{{ $errors->first('current_organization') }}</p>
                                      @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="affiliations_certifications">Affiliations/Certifications <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" name="affiliations_certifications" class="form-control" placeholder="Affiliations/Certifications" value="{{ old('affiliations_certifications') }}" id="affiliations_certifications">
                                      @if($errors->has('affiliations_certifications'))
                                         <p class="req">{{ $errors->first('affiliations_certifications') }}</p>
                                      @endif
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                      <label for="">Date of Graduation <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="datepicker1 form-control" placeholder="" name="graduation_date" value="{{ old('graduation_date') != '' ? old('graduation_date') : date('Y-m-d') }}" id="graduation_date" />
                                      @if($errors->has('graduation_date'))
                                         <p class="req">{{ $errors->first('graduation_date') }}</p>
                                      @endif
                                    </div>

                                     <div class="col-md-6 mb-3">
                                      <label for="">Email Address Official<span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="official_email" placeholder="Email address official" value="{{ old('official_email') }}" id="official_email" />
                                      @if($errors->has('official_email'))
                                         <p class="req">{{ $errors->first('official_email') }}</p>
                                      @endif
                                    </div>

                                </div>


                                <div class="row">
                                   
                                    <div class="col-md-6 mb-3">
                                      <label for="">Additional Email address(personal) <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="personal_email" placeholder="Additional Email address(personal)" value="{{ old('personal_email') }}" id="personal_email">
                                      @if($errors->has('personal_email'))
                                         <p class="req">{{ $errors->first('personal_email') }}</p>
                                      @endif
                                    </div>

                                     <div class="col-md-6 mb-3">
                                         <label for="">Country <span class="req">*</span></label>
                                         <select class="form-control" name="country" id="country">
                                               <option value="">-- Select --</option>
                                            @foreach($countries as $country)
                                               <option value="{{ $country->id }}">{{ $country->name }}</option>
                                             @endforeach
                                         </select>
                                         @if($errors->has('country'))
                                            <p class="req">{{ $errors->first('country') }}</p>
                                         @endif
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                      <label for="state">State <span class="req">*</span></label>
                                      <select class="form-control" name="state" id="state">
                                         <option>-- Select --</option>
                                      </select>
                                      @if($errors->has('state'))
                                         <p class="req">{{ $errors->first('state') }}</p>
                                      @endif
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                      <label for="city">City <span class="req">*</span></label>
                                      <select class="form-control" name="city" id="city" />
                                        <option>-- Select --</option>
                                      </select>
                                      @if($errors->has('city'))
                                         <p class="req">{{ $errors->first('city') }}</p>
                                      @endif
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                      <label for="">Address <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="address" placeholder="Address" value="{{ old('address') }}" id="address" />
                                      @if($errors->has('address'))
                                         <p class="req">{{ $errors->first('address') }}</p>
                                      @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label for="">Post Code <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="post_code" placeholder="Post Code" value="{{ old('post_code') }}" id="post_code">
                                      @if($errors->has('post_code'))
                                         <p class="req">{{ $errors->first('post_code') }}</p>
                                      @endif
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="">Whether have OCI <span class="req">*</span></label>
                                      <select class="form-control" id="whether_have_oci" name="whether_have_oci" id="whether_have_oci">
                                         <option value="yes" {{ old() == "yes" ? "selected" : "" }}>Yes</option>
                                         <option value="no" {{ old() == "no" ? "selected" : "" }}>No</option>
                                      </select>
                                      @if($errors->has('whether_have_oci'))
                                         <p class="req">{{ $errors->first('whether_have_oci') }}</p>
                                      @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label for="">Telephone <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="telephone" placeholder="Telephone" value="{{ old('telephone') }}" id="telephone">
                                      @if($errors->has('tel_prof'))
                                         <p class="req">{{ $errors->first('tel_prof') }}</p>
                                      @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label for="">Tel. Mobile <span class="req">*</span></label>
                                      <input type="text" autocomplete="off" class="form-control" name="tel_mobile" placeholder="Tel. Mobile" value="{{ old('tel_mobile') }}" id="tel_mobile">
                                      @if($errors->has('tel_mobile'))
                                         <p class="req">{{ $errors->first('tel_mobile') }}</p>
                                      @endif
                                    </div>

                                   <div class="col-md-6 mb-3">
                                      <label for="">Fax Prof </label>
                                      <input type="text" autocomplete="off" class="form-control" name="fax_prof" placeholder="Fax Prof" value="{{ old('fax_prof') }}" id="fax_prof">
                                      @if($errors->has('fax_prof'))
                                         <p class="req">{{ $errors->first('fax_prof') }}</p>
                                      @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                      <button onclick="$('#expert-form .nav-tabs button#nav-other-info-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                    </div>
                                </div>
                        </div>

                        <div class="mpm-10 tab-pane fade" id="nav-other-info" role="tabpanel" aria-labelledby="nav-other-info-tab">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label for="">Area of Expertise </label>
                                  <select class="form-control" name="activity" id="activity">
                                        <option value="">-- Select --</option>
                                    @foreach($expertises as $expertise)
                                        <option value="{{ $expertise->id }}">{{ $expertise->expertise }}</option>
                                    @endforeach
                                  </select>

				  <input type="text" autocomplete="off" placeholder="Other" name="other" id="other" class="d-none mt-1 form-control" /> 

				  <textarea class="form-control mt-1" id="remarks" name="remarks" placeholder="Please add 'Remarks' If expertise is not listed in the dropdown."></textarea>

                                  @if($errors->has('activity'))
                                     <p class="req">{{ $errors->first('activity') }}</p>
                                  @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="">Level <span class="req">*</span></label>
                                  <select class="form-control" name="level" id="level">
                                     <option {{ old('level') == "beginner" ? "selected" : "" }} value="beginner">Beginner</option>
                                     <option {{ old('level') == "medium" ? "selected" : "" }} value="medium">Medium</option>
                                     <option {{ old('level') == "expert" ? "selected" : "" }} value="expert">Expert </option>
                                  </select>
                                  @if($errors->has('level'))
                                     <p class="req">{{ $errors->first('level') }}</p>
                                  @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label for="">Upload your latest Curriculum Vitae <span class="req">*</span></label>
                                  <input type="file" autocomplete="off" class="form-control" name="cv" placeholder="Upload your latest Curriculum Vitae" accept="application/pdf" id="cv" />
                                  <p style="margin:0px;font-style:italic;"><small>Supported file format: PDF</small></p>
                                  @if($errors->has('cv'))
                                     <p class="req">{{ $errors->first('cv') }}</p>
                                  @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="">Any ID details/Passport for foreign Resident <span class="req">*</span></label>
                                  <p style="margin-bottom:3px" class="d-flex">
                                     <input autocomplete="off" style="width:50%;" type="text" class="form-control" name="id_number" placeholder="Enter Id Number" value="{{ old('id_number') }}" id="id_number">&nbsp;<input type="file" style="width:50%;" class="form-control" id="id_proof_document" name="id_proof_document" accept="application/pdf" />
                                  </p>

                                  <p style="margin:0px;text-align:right;font-style:italic;"><small>Supported file format: PDF</small></p>
                                  @if($errors->has('id_proof_document'))
                                     <p class="req">{{ $errors->first('id_proof_document') }}</p>
                                  @endif
                                </div>  

                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label for="">Upload the Photograph <span class="req">*</span></label>
                                  <input autocomplete="off" style="margin-bottom:3px" type="file" class="form-control" name="photograph" placeholder="Upload the Photograph" accept="image/*" id="photograph" />
                                  <p style="margin:0px;font-style:italic;"><small>Supported file formats: JPG, JPEG, PNG, GIF</small></p>
                                  @if($errors->has('photograph'))
                                     <p class="req">{{ $errors->first('photograph') }}</p>
                                  @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label for="">Web page / linked / personal web page <span class="req">*</span></label>
                                  <input autocomplete="off" type="text" class="form-control" name="web_page" placeholder="Full Url (Web page / linked / personal web page)" value="{{ old('web_page') }}" id="web_page" />
                                  @if($errors->has('web_page'))
                                     <p class="req">{{ $errors->first('web_page') }}</p>
                                  @endif
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3 text-left">
                                  <button onclick="$('#expert-form .nav-tabs button#nav-general-info-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous </button>
                                </div>

                                <div class="col-md-6 mb-3 text-right" style="text-align:right;">
                                  <input type="submit" class="btn btn-primary" id="sbmitbtn" name="sbmitbtn" value="Submit" />
                                </div>
                            </div>
                        </div>


                       </div>

                     </form>

                  </div>
                  <!-- end card-body -->
               </div>
               <!-- end card-->
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
      <!-- container -->
   </div>
   <!-- content -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/expert-user-validation.js?v=' . rand(111111,999999)) }}"></script>
<script>
   $(document).ready(function() {
       $(`.datepicker1`).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
   });
 </script>
@endpush