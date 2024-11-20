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
</style>
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
                                <h4 class="page-title">6G RESEARCH PROPOSALS</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

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
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="organization_name">Organization Name</label>
                                                  <p>{{ $record->organization_name }}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="nodal_contact_person">Nodal Contact Person</label>
                                                  <p>{{ $record->nodal_contact_person }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="designation">Designation</label>
                                                  <p>{{ $record->designation }}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="authorization_letter">Authorization Letter</label>&nbsp;
                                                  <p><a target="_blank" href="{{ url('storage/uploads/' . $record->authorization_letter) }}">{{ $record->authorization_letter }}</a></p>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="bio_data_professional_credentials">Bio-data/ Professional Credentials</label>
                                                  <p><a target="_blank" href="{{ url('storage/uploads/' . $record->bio_data_professional_credentials) }}">{{ $record->bio_data_professional_credentials }}</a></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="contact_no">Contact No</label>
                                                  <p>{{ $record->contact_no }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="email_id">Email Id</label>
                                                  <p>{{ $record->email_id }}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="country">Country</label>
                                                  <p>{{ $record->country_name->name }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="state">State</label>
                                                  <p>{{ $record->state_name->name }}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="ciy">City</label>
                                                  <p>{{ $record->city_name->name }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="address">Address</label>
                                                  <p>{{ $record->address }}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="pin_no">Pin No</label>
                                                  <p>{{ $record->pin_no }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="applying_as">Applying as</label>
                                                  <p>{{ $record->applying_as }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <button onclick="$('.nav-tabs button#nav-collaborator-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                </div>

                                            </div>


                                        </div>

                                        <div class="mpm-10 tab-pane fade" id="nav-collaborator" role="tabpanel" aria-labelledby="nav-collaborator-tab">

                                            @if($record->collaborators->count())
                                                @foreach($record->collaborators as $col_obj)
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_name">Name</label>
                                                              <p>{{ $col_obj->collaborator_name }}</p>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_designation">Designation</label>
                                                              <p>{{ $col_obj->collaborator_designation }}</p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_contact_no">Contact No</label>
                                                              <p>{{ $col_obj->collaborator_contact_no }}</p>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_email_id">Email id</label>
                                                              <p>{{ $col_obj->collaborator_email_id }}</p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_industry_cateogory">Industry Category</label>
                                                              <p>{{ $col_obj->collaborator_industry_cateogory }}</p>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_address">Address</label>
                                                              <p>{{ $col_obj->collaborator_address }}</p>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_biodata">Bio-data/ Professional Credentials</label>
                                                              @if($col_obj->collaborator_biodata )
                                                                <p><a target="_blank" href="{{ url('storage/uploads/' . $col_obj->collaborator_biodata) }}">{{ $col_obj->collaborator_biodata }}</a></p>
                                                              @else
                                                                <p>N/A</p>
                                                              @endif
                                                           </div>
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_area_of_work">Area of work/ Domain Expertise</label>
                                                              <p>{{ $col_obj->collaborator_area_of_work }}</p>
                                                           </div>
                                                        </div>


                                                        <div class="row">
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_size_company">Size of company (In case of LLP)</label>
                                                              <p>{{ $col_obj->collaborator_size_company }}</p>
                                                           </div>
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_location_of_head_office_branch">Location of Head office and branches if any</label>
                                                              <p>{{ $col_obj->collaborator_location_of_head_office_branch }}</p>
                                                           </div>
                                                        </div>

                                                        <div class="row">
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_company_turnover">Company Turnover - last three years</label>
                                                              <p>{{ $col_obj->collaborator_company_turnover }}</p>
                                                              @if($col_obj->collaborator_company_turnover_attachment )
                                                                <p><a target="_blank" href="{{ url('storage/uploads/' . $col_obj->collaborator_company_turnover_attachment) }}">{{ $col_obj->collaborator_company_turnover_attachment }}</a></p>
                                                              @endif
                                                           </div>
                                                        </div>
							<hr />
							


                                                    @endforeach
                                                @else

                                                <div class="row">
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_name">Name</label>
                                                              <p>{{ $record->collaborator_name }}</p>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_designation">Designation</label>
                                                              <p>{{ $record->collaborator_designation }}</p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_contact_no">Contact No</label>
                                                              <p>{{ $record->collaborator_contact_no }}</p>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_email_id">Email id</label>
                                                              <p>{{ $record->collaborator_email_id }}</p>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_industry_cateogory">Industry Category</label>
                                                              <p>{{ $record->collaborator_industry_cateogory }}</p>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                              <label for="collaborator_address">Address</label>
                                                              <p>{{ $record->collaborator_address }}</p>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_biodata">Bio-data/ Professional Credentials</label>
                                                              @if($record->collaborator_biodata )
                                                                <p><a target="_blank" href="{{ url('storage/uploads/' . $record->collaborator_biodata) }}">{{ $record->collaborator_biodata }}</a></p>
                                                              @else
                                                                <p>N/A</p>
                                                              @endif
                                                           </div>
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_area_of_work">Area of work/ Domain Expertise</label>
                                                              <p>{{ $record->collaborator_area_of_work }}</p>
                                                           </div>
                                                        </div>


                                                        <div class="row">
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_size_company">Size of company (In case of LLP)</label>
                                                              <p>{{ $record->collaborator_size_company }}</p>
                                                           </div>
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_location_of_head_office_branch">Location of Head office and branches if any</label>
                                                              <p>{{ $record->collaborator_location_of_head_office_branch }}</p>
                                                           </div>
                                                        </div>

                                                        <div class="row">
                                                           <div class="form-group col-md-6">
                                                              <label for="collaborator_company_turnover">Company Turnover - last three years</label>
                                                              <p>{{ $record->collaborator_company_turnover }}</p>
                                                              @if($record->collaborator_company_turnover_attachment )
                                                                <p><a target="_blank" href="{{ url('storage/uploads/' . $record->collaborator_company_turnover_attachment) }}">{{ $record->collaborator_company_turnover_attachment }}</a></p>
                                                              @endif
                                                           </div>
                                                        </div>

                                                        

                                                @endif

						<div class="row">
                                                            <div class="form-group col-md-6">
                                                              <button onclick="$('.nav-tabs button#nav-organization-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                              &nbsp;
                                                              <button onclick="$('.nav-tabs button#nav-project-details-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                            </div>
                                                        </div>


                                        </div>

                                        <div class="mpm-10 tab-pane fade" id="nav-project-details" role="tabpanel" aria-labelledby="nav-project-details-tab">

<!--                                                 <h4>Proposal Details</h4>
                                                <h5>Project Details</h5><br /> -->
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="proposed_project_title">Proposed Project Title</label>
                                                      <p>{{ $record->proposed_project_title }}</p>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="proposed_product_area_category">Proposed Product area category</label>
                                                      <p>{{ $record->proposed_product_area_category }}</p>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="technology_area">Technology Area</label>
                                                      <p>{{ $record->technology_area }}</p>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="stage_of_product_based_on_minimum_technology_readiness_level">Stage of Product based on minimum Technology Readiness Level (TRL) </label>
                                                      <p>{{ $record->stage_of_product_based_on_minimum_technology_readiness_level }}</p>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="collaboration_customers_clients">Collaboration/ Customers/ Clients if any</label>
                                                      <p>{{ $record->collaboration_customers_clients }}</p>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                      <label for="list_of_ipr_awards_paper_published">List of IPR/ Awards/ Paper Published if any </label>
                                                      <p>{{ $record->list_of_ipr_awards_paper_published }}</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                      <label for="relevant_standards_standard_body_membership">Relevant Standards/Standard Body membership/ contributions/Certification Testing (TEC/ Security) if any</label>
                                                      <p>{{ $record->relevant_standards_standard_body_membership }}</p>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="form-group col-md-6">

                                                     <button onclick="$('.nav-tabs button#nav-collaborator-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                  &nbsp;

                                                      <button onclick="$('.nav-tabs button#nav-product-desc-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                    </div>
                                                </div>


                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-product-desc" role="tabpanel" aria-labelledby="nav-product-desc-tab">
                                            <!-- <h5>Product Description</h5><br /> -->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="brief_product_solution_idea_description">Brief product/ solution/ idea description</label>
                                                  <p>{{ $record->brief_product_solution_idea_description }}</p>
                                                  @if($record->brief_product_solution_idea_description_attachment )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->brief_product_solution_idea_description_attachment) }}">{{ $record->brief_product_solution_idea_description_attachment }}</a></p>
                                                  @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="primary_objective_of_module_sub_system_product_solution_proposed">Primary Objective of the module/ sub-system/system/product/Solution proposed</label>
                                                  <p>{{ $record->primary_objective_of_module_sub_system_product_solution_proposed }}</p>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="key_deliverables">Key deliverables</label>
                                                  <p>{{ $record->key_deliverables }}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="type_of_solution_product">Type of solution/product-Stand-alone/ Sub-system/ Application/Complete system/product</label>
                                                  <p>{{ $record->type_of_solution_product }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="details_prior_experience">Details of prior experience, expertise and components/ sub-systems/product developed in selected area of interest.</label>
                                                  <p>{{ $record->details_prior_experience }}</p>
                                                </div>

                                                <div class="form-group col-md-6">
                                                  <label for="if_the_proposed_solution_product">(If the proposed solution/product is not stand-along and/or a module, please provide details of the larger solution it caters to/ required to integrate to arrive at full solution)</label>
                                                  <p>{{ $record->if_the_proposed_solution_product }}</p>
                                                </div>

                                            </div>



                                            <div class="row">
                                                
                                                <div class="form-group col-md-6">
                                                  <label for="is_product_tech_related_to_present_activities">Is the product/ technology related to present activities/products being developed by DOT? If so, how does the product tie in with present activities/ products, being developed by DOT?</label>
                                                  <p>{{ $record->is_product_tech_related_to_present_activities }}</p>
                                                </div>

                                                <div class="form-group col-md-6">
                                                  <label for="is_it_new_concept_design_sol_product">Is it a new concept/design/ solution/ product? If so, What are relevant standards being adopted?</label>
                                                  <p>{{ $record->is_it_new_concept_design_sol_product }}</p>
                                                </div>

                                            </div>


                                            <div class="row">
                                                
                                                <div class="form-group col-md-6">
                                                  <label for="are_there_any_alternate_competive_tech_product">Are there any alternate competitive technology/product? available/ under development locally / outside India? Please provide the information available with you. What is the comparison of performance/ specification/ features?</label>
                                                  <p>{{ $record->are_there_any_alternate_competive_tech_product }}</p>
                                                </div>

                                                <div class="form-group col-md-6">
                                                  <label for="provide_the_specification_doc_relavant_to_product">Provide the specification document relevant to your product?</label>
                                                  @if($record->provide_the_specification_doc_relavant_to_product )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->provide_the_specification_doc_relavant_to_product) }}">{{ $record->provide_the_specification_doc_relavant_to_product }}</a></p>
                                                  @endif

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">

                                                  <button onclick="$('.nav-tabs button#nav-project-details-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                  &nbsp;

                                                  <button onclick="$('.nav-tabs button#nav-project-plan-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-project-plan" role="tabpanel" aria-labelledby="nav-project-plan-tab">
                                            <!-- <h5>Project Plan</h5><br /> -->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="provide_dev_plan_indicate_major_milestone">Provide development Plan indicating the major milestone and respective cost break up of each milestone Provide bar chart/ project plan</label>
                                                  <p>{{ $record->provide_dev_plan_indicate_major_milestone }}</p>

                                                  @if($record->provide_dev_plan_indicate_major_milestone_attachment )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->provide_dev_plan_indicate_major_milestone_attachment) }}">{{ $record->provide_dev_plan_indicate_major_milestone_attachment }}</a></p>
                                                  @endif

                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="inputPassword4">Manpower support requirements </label>
                                                  <p>{{ $record->manpower_support_requirements }}</p>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="infrastructure_support_requirements">Infrastructure support requirements</label>
                                                  
                                                  <p>{{ $record->infrastructure_support_requirements }}</p>
                                                  @if($record->infrastructure_support_requirements_attachment )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->infrastructure_support_requirements_attachment) }}">{{ $record->infrastructure_support_requirements_attachment }}</a></p>
                                                  @endif


                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="details_of_existing_tools_testers_platform">Details of Existing Tools, Testers and platform </label>

                                                  <p>{{ $record->details_of_existing_tools_testers_platform }}</p>
                                                  

                                                  @if($record->details_of_existing_tools_testers_platform_attachment )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->details_of_existing_tools_testers_platform_attachment) }}">{{ $record->details_of_existing_tools_testers_platform_attachment }}</a></p>
                                                  @endif


                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="any_additional_dev_tools_software_requirements">Any additional development tools and software requirements if any</label>

                                                  <p>{{ $record->any_additional_dev_tools_software_requirements }}</p>
                                                  
                                                </div>
                                                
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <button onclick="$('.nav-tabs button#nav-product-desc-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                  &nbsp;

                                                  <button onclick="$('.nav-tabs button#nav-funding-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-funding" role="tabpanel" aria-labelledby="nav-funding-tab">


                                            <!-- <h5>Funding</h5><br /> -->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="estimated_development_cost">Estimated development cost of the proposed modules/system. (Separately module wise, in case multiple modules are proposed)</label>

                                                  <p>{{ $record->estimated_development_cost }}</p>

                                                  @if($record->estimated_development_cost_attachment )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->estimated_development_cost_attachment) }}">{{ $record->estimated_development_cost_attachment }}</a></p>
                                                  @endif


                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="fund_expected">Fund expected from this program (Separately module wise, in case multiple modules are proposed)</label>
                                                  <p>{{ $record->fund_expected }}</p>
                                                </div>
                                            </div>

                                             <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="details_of_funding">Details of funding received for the Same/Similar project from other schemes of DoT/ GOI.</label>

                                                  <p>{{ $record->details_of_funding }}</p>

                                                  @if($record->details_of_funding_attachment )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->details_of_funding_attachment) }}">{{ $record->details_of_funding_attachment }}</a></p>
                                                  @endif

                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="details_self_funding">Details of self-funding / other sources for the Proposed modules/system</label>
                                                  <p>{{ $record->details_self_funding }}</p>

                                                  @if($record->details_self_funding_attachment )
                                                    <p><a target="_blank" href="{{ url('storage/uploads/' . $record->details_self_funding_attachment) }}">{{ $record->details_self_funding_attachment }}</a></p>
                                                  @endif

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <button onclick="$('.nav-tabs button#nav-project-plan-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                  &nbsp;

                                                  <button onclick="$('.nav-tabs button#nav-regulatory-tab').tab('show');" type="button" class="btn btn-secondary">Next &raquo;</button>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="mpm-10 tab-pane fade" id="nav-regulatory" role="tabpanel" aria-labelledby="nav-regulatory-tab">

                                            <!-- <h5>Regulatory approvals Requirements</h5><br /> -->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <label for="any_regulatory_approval">Any regulatory approvals required from Govt for the product/ solution being proposed.</label>

                                                  <p>{{ $record->any_regulatory_approval }}</p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                  <label for="any_other_remarks">Any other Remarks(Potential outcome/IPR)</label>
                                                  <p>{{ $record->any_other_remarks }}</p>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                  <button onclick="$('.nav-tabs button#nav-funding-tab').tab('show');" type="button" class="btn btn-secondary">&laquo; Previous</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>                  

                                 <!-- close -->
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
 <script src="{{ asset('assets/js/sixgform-validation.js?v=' . rand(111, 222)) }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/additional-methods.min.js"></script>


@endpush