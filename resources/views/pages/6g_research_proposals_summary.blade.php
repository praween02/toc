@extends('layouts.app')
@section('title', ' - 6G Research Proposals')
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
		            		<div class="col-md-6 float-left"><h3>{{ __('6G Research Proposals') }}</h3><br /></div>
		            	</div>

		            		<div class="row expert">

		            			<!-- -->

		            			<div class="row tab11">
								   <!-- I.  Proposal details -->
								   <div class="col-sm-12 form-group">
								      <label for="Proposal-details">Proposal details </label>
								      <input type="text" readonly class="form-control" value="{{ $user->proposalDetails }}" />
								   </div>
								   <!-- I.  Proposal details -->
								   <!-- II. Technology domain -->
								   <div class="col-sm-12 form-group">
								      <label for="technology-domain">Technology domain </label>
								      <input type="text"  readonly class="form-control" value="{{ $user->technologyDomain }}" />
								   </div>
								   <!-- II. Technology domain -->
								   <!-- III.    Area -->
								   <div class="col-sm-12 form-group">
								      <label for="Area">Area </label>
								      <input type="text" readonly class="form-control" value="{{ $user->Area }}" />
								   </div>
								   <!-- III.    Area -->
								   <!-- IV. Project title: -->
								   <div class="col-sm-12 form-group">
								      <label for="project-title">Project Title </label>
								      <input type="text" readonly class="form-control" value="{{ $user->projectTitle }}" />
								   </div>
								   <!-- IV. Project title: -->
								   <!-- 1. Name of the Organization -->
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Name of the Organization:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="organization-name">Organization Name </label>
								      <input type="text" readonly class="form-control" value="{{ $user->organizationName }}" />
								   </div>
								   <!-- 2. Address and Contact Details -->
								   <div class="col-sm-12 form-group">
								      <label for="address">Address </label>
								      <input type="text" readonly class="form-control" value="{{ $user->address }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="contact-details">Contact Details </label>
								      <input type="text" readonly class="form-control" value="{{ $user->contactDetails }}" />
								   </div>
								   <!-- 3. Type of participant -->
								   <div class="col-sm-12 form-group">
								      <label for="participant-type">Type of participant </label>
								      <input type="text" readonly class="form-control" value="{{ $user->participantType }}" />
								   </div>
								   <!-- 4. Area of work / Domain expertise -->
								   <!-- <div class="col-sm-12 mx-t3 mb-2 mt-2"> -->
								   <div class="col-sm-12 form-group">
								      <label for="domain-expertise">Domain Expertise </label>
								      <input type="text" readonly class="form-control" value="{{ $user->domainExpertise }}" />
								   </div>
								   <!-- </div> -->
								   <!-- 5. Size of company (In case of LLP) -->
								   <div class="col-sm-12 form-group">
								      <label for="company-size">Size of company (In case of LLP) </label>
								      <input type="text" readonly class="form-control" value="{{ $user->companySize }}" />
								   </div>
								   <!-- 6. Location of Head office and branches if any -->
								   <div class="col-sm-12 form-group">
								      <label for="office-location">Location of Head office and branches if any </label>
								      <input type="text" readonly class="form-control" value="{{ $user->officeLocation }}" />
								   </div>
								   <!-- 7. Company turnover – last three years -->
								   <div class="col-sm-12 form-group">
								      <label for="company-turnover">Company turnover – last three years </label>
								      <input type="text" readonly class="form-control" value="{{ $user->companyTurnover }}" />
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>System/module Readiness:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="readiness-level">Readiness Level </label>
								      <input type="text" readonly class="form-control" value="{{ $user->readinessLevel }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="product-category">Proposed Product Area Category </label>
								      <input type="text" readonly class="form-control" value="{{ $user->productCategory }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="product-phase">Product Phase </label>
								      <input type="text" readonly class="form-control" value="{{ $user->productPhase }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="compliance-standards">Compliance to any standards </label>
								      <input type="text" readonly class="form-control" value="{{ $user->complianceStandards }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="clients-collaboration">Customers / Clients / Collaboration if any </label>
								      <input type="text" readonly class="form-control" value="{{ $user->clientsCollaboration }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="ipr-awards-papers">List of IPR / Awards / Paper Published if any &gt;</label>
								      <input type="text" readonly class="form-control" value="{{ $user->iprAwardsPapers }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="standard-body-membership">Standard Body Membership/Contributions if any </label>
								      <input type="text" readonly class="form-control" value="{{ $user->standardBodyMembership }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="certification-testing">Certification Testing (TEC/Security etc.) </label>
								      <input type="text" readonly class="form-control" value="{{ $user->certificationTesting }}" />
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Manpower:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="skilled-manpower">Size of Skilled Manpower in the Proposed Area </label>
								      <input type="text" readonly class="form-control" value="{{ $user->skilledManpower }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="num-architects">Number of Architects </label>
								      <input type="text" readonly class="form-control" value="{{ $user->numArchitects }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="num-developers">Number of Developers in the Proposed Area </label>
								      <input type="text" readonly class="form-control" value="{{ $user->numDevelopers }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="num-test-engineers">Number of Test and Integration Engineers </label>
								      <input type="text" readonly class="form-control" value="{{ $user->numTestEngineers }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="num-field-support">Number of Field Support Engineers </label>
								      <input type="text"  readonly class="form-control" value="{{ $user->numFieldSupport }}" />
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Principal Investigator:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="pi-name-designation">Name &amp; Designation </label>
								      <input type="text" readonly class="form-control" value="{{ $user->piNameDesignation }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="pi-institution-address">Institution/ Department/ Address </label>
								      <input type="text" readonly class="form-control" value="{{ $user->piInstitutionAddress }}" />
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="pi-biodata-credentials">Bio-data/ Professional Credentials </label>
								      <textarea class="form-control" readonly name="piBiodataCredentials">{{ $user->piBiodataCredentials }}</textarea>
								   </div>
								   <div class="col-sm-12 mx-t3 mb-0 mt-3">
								      <h5>Industry Collaborator:</h5>
								   </div>
								   <div class="col-sm-12">
								      <div class="border border-info p-4 rounded row m-3">
								         <!-- 1st Collaborator -->
								         <div class="col-sm-4 form-group">
								            <label class="text-shortners" title="Name &amp; Designation" for="collaborator1-name-designation">Name &amp; Designation </label>
								            <input type="text" readonly class="form-control error" id="collaborator1-name-designation" required="" aria-required="true">
								         </div>
								         <div class="col-sm-4 form-group">
								            <label class="text-shortners" title="Address" for="collaborator1-institution-address"> Address </label>
								            <input type="text" readonly class="form-control" id="collaborator1-institution-address" required="" aria-required="true">
								            
								         </div>
								         <div class="col-sm-4 form-group">
								            <label class="text-shortners" title="Bio-data/ Professional Credentials" for="collaborator1-biodata-credentials">Bio-data/ Professional Credentials </label>
								            <textarea class="form-control" id="collaborator1-biodata-credentials" rows="1" readonly></textarea>
								         </div>
								         <div class="col-sm-3 form-group">
								            <label class="text-shortner" title="Area of work / Domain expertise" for="Area-of-work-Domain-expertise">Area of work / Domain expertise </label>
								            <input type="text" class="form-control" value="" readonly />
								         </div>
								         <div class="col-sm-3 form-group">
								            <label class="text-shortner" title="Size of company(In case of LLP)" for="Size-of-company">Size of company(In case of LLP)</label>
								            <input type="text" readonly  class="form-control" value="" />
								         </div>
								         <div class="col-sm-3 form-group">
								            <label class="text-shortner" title="Location of Head office and branches if any" for="LocationoHeadfice">Location of Head office and branches if any </label>
								            <textarea class="form-control" id="LocationoHeadfice" rows="1" readonly></textarea>
								         </div>
								         <div class="col-sm-3 form-group">
								            <label class="text-shortner" title="Company turnover – last three years" for="Companyturnover–lastthreeyears">Company turnover – last three years </label>
								            <input type="text" class="form-control" id="Companyturnover–lastthreeyears" readonly />
								         </div>
								      </div>
								   </div>

								</div>


								<div class="row tab12">
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Infrastructure:</h5>
								   </div>
								   <!-- 2. Software and development tools used -->
								   <div class="col-sm-12 form-group">
								      <label for="software-tools">Software and Development Tools Used </label>
								      <textarea readonly class="form-control" name="softwareTools" rows="3">{{ $user->softwareTools }}</textarea>
								   </div>
								   <!-- 3. Details of Test equipment available for Proposed Modules/ system -->
								   <div class="col-sm-12 form-group">
								      <label for="test-equipment-details">Details of Test Equipment Available for Proposed Modules/System </label>
								      <textarea readonly class="form-control" name="testEquipmentDetails" id="test-equipment-details" rows="3">{{ $user->testEquipmentDetails }}</textarea>
								   </div>
								   <!-- 4. Deployment and network planning tools used -->
								   <div class="col-sm-12 form-group">
								      <label for="network-planning-tools">Deployment and Network Planning Tools Used </label>
								      <textarea readonly class="form-control" name="networkPlanningTools" id="network-planning-tools" rows="3">{{ $user->networkPlanningTools }}</textarea>
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Process:</h5>
								   </div>
								   <!-- 2. Product Development Lifecycle and Quality practices followed -->
								   <div class="col-sm-12 form-group">
								      <label for="development-lifecycle">Product Development Lifecycle and Quality Practices Followed </label>
								      <textarea readonly class="form-control" name="developmentLifecycle" id="development-lifecycle" rows="3">{{ $user->developmentLifecycle }}</textarea>
								   </div>
								   <!-- 3. Test Automation practices followed if any -->
								   <div class="col-sm-12 form-group">
								      <label for="test-automation-practices">Test Automation Practices Followed (if any) </label>
								      <textarea readonly class="form-control" name="testAutomationPractices" id="test-automation-practices" rows="3">{{ $user->testAutomationPractices }}</textarea>
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Funding:</h5>
								   </div>
								   <!-- 2. Estimated development cost of the proposed modules/system -->
								   <div class="col-sm-12 form-group">
								      <label for="development-cost">Estimated Development Cost of the Proposed Modules/System </label>
								      <textarea readonly class="form-control" name="developmentCost" id="development-cost" rows="3">{{ $user->developmentCost }}</textarea>
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Funding:</h5>
								   </div>
								   <!-- 2. Estimated development cost of the proposed modules/system -->
								   <div class="col-sm-12 form-group">
								      <label for="development-cost">Estimated Development Cost of the Proposed Modules/System (Separately module-wise, in case multiple modules are proposed) </label>
								      <textarea readonly class="form-control" name="developmentCostSeparately" id="development-cost" rows="3">{{ $user->developmentCostSeparately }}</textarea>
								   </div>
								   <!-- 3. Fund expected from this program -->
								   <div class="col-sm-12 form-group">
								      <label for="expected-fund">Fund Expected from this Program (Separately module-wise, in case multiple modules are proposed) </label>
								      <textarea readonly class="form-control" name="expectedFund" rows="3">{{ $user->expectedFund }}</textarea>
								   </div>
								   <!-- 4. Details of funding received for the Same / Similar project from other schemes of DoT / GOI -->
								   <div class="col-sm-12 form-group">
								      <label for="received-funding-details">Details of Funding Received for the Same/Similar Project from Other Schemes of DoT/GOI </label>
								      <textarea readonly class="form-control" name="receivedFundingDetails" id="received-funding-details" rows="3">{{ $user->receivedFundingDetails }}</textarea>
								   </div>
								   <!-- 5. Details of self-funding / other sources for the Proposed modules/system -->
								   <div class="col-sm-12 form-group">
								      <label for="self-funding-details">Details of Self-Funding/Other Sources for the Proposed Modules/System </label>
								      <textarea readonly class="form-control" name="selfFundingDetails" id="self-funding-details" rows="3">{{ $user->selfFundingDetails }}</textarea>
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Product Description:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="product-description">Brief Product/Solution/Idea Description </label>
								      <textarea readonly class="form-control" name="productDescription" id="product-description" rows="3">{{ $user->productDescription }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="primary-objective">Primary Objective of the Module/Sub-system/System/Product/Solution Proposed </label>
								      <textarea readonly class="form-control" name="primaryObjective" id="primary-objective" rows="3">{{ $user->primaryObjective }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="key-deliverables">Key Deliverables </label>
								      <textarea readonly class="form-control" name="keyDeliverables" id="key-deliverables" rows="3">{{ $user->keyDeliverables }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="solution-type">Type of Solution/Product </label>
								      <textarea readonly class="form-control" name="solutionType" id="solution-type" rows="3">{{ $user->solutionType }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="prior-experience">Details of Prior Experience, Expertise, and Components/Sub-systems/Product Developed in the Selected Area of Interest </label>
								      <textarea readonly class="form-control" name="priorExperience" id="prior-experience" rows="3">{{ $user->priorExperience }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="dot-related">Is the Product/Technology Related to Present Activities/Products Being Developed by DOT? If So, How Does the Product Tie in with Present Activities/Products Being Developed by DOT? </label>
								      <textarea readonly class="form-control" name="dotRelated" id="dot-related" rows="3">{{ $user->dotRelated }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="new-concept">Is It a New Concept/Design/Solution/Product? If So, What Are Relevant Standards Being Adopted? </label>
								      <textarea readonly class="form-control" name="newConcept" id="new-concept" rows="3">{{ $user->newConcept }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="competitive-technology">Are There Any Alternate Competitive Technology/Product Available/Under Development Locally/Outside India? Please Provide the Information Available with You. What Is the Comparison of Performance/Specification/Features? </label>
								      <textarea readonly class="form-control" name="competitiveTechnology" id="competitive-technology" rows="3">{{ $user->competitiveTechnology }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="specification-document">Provide the Specification Document Relevant to Your Product <small><em>(Allowed:PDF | Size : 2MB)</em></small> </label>
								      <p><a href="{{ $path}}{{ $user->specificationDocument }}" target="_blank" download>{{ $user->specificationDocument }}</a></p>

								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Project Plan:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="development-plan">Provide Development Plan Indicating the Major Milestone and Respective Cost Breakup of Each Milestone. Also, Provide Bar Chart/Project Plan </label>
								      <textarea readonly class="form-control" name="developmentPlan" id="development-plan" rows="3">{{ $user->developmentPlan }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="project-chart">Bar Chart/Project Plan <small></small></label>
								      <p><a href="{{ $path}}{{ $user->projectChart }}" target="_blank" download>{{ $user->projectChart }}</a></p>
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Additional Resource Requirements:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="manpower-requirements">Manpower Support Requirements </label>
								      <textarea readonly class="form-control" name="manpowerRequirements" id="manpower-requirements" rows="3">{{ $user->manpowerRequirements }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="infrastructure-requirements">Infrastructure Support Requirements </label>
								      <textarea readonly class="form-control" name="infrastructureRequirements" id="infrastructure-requirements" rows="3">{{ $user->infrastructureRequirements }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="tools-platform-requirements">Tools, Testers, and Platform Requirements </label>
								      <textarea readonly class="form-control" name="toolsPlatformRequirements" id="tools-platform-requirements" rows="3">{{ $user->toolsPlatformRequirements }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="development-tools-requirements">Any Development Tools and Software Requirements </label>
								      <textarea readonly class="form-control" name="developmentToolsRequirements" id="development-tools-requirements" rows="3">{{ $user->developmentToolsRequirements }}</textarea>
								   </div>
								   <div class="col-sm-12 mx-t3 mb-2 mt-2">
								      <h5>Risk and Risk Mitigation:</h5>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="risk-areas">Risk Areas and Challenges, as Envisaged </label>
								      <textarea readonly class="form-control" name="riskAreas" id="risk-areas" rows="3">{{ $user->riskAreas }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="mitigation-plan">Mitigation Plan and/or Contingency Plan Suggested, If Any </label>
								      <textarea readonly class="form-control" name="mitigationPlan" id="mitigation-plan" rows="3">{{ $user->mitigationPlan }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="foreground-ipr">Potential Foreground IPR (Intellectual Property) that Can Be Developed by the Participants Individually and Collectively </label>
								      <textarea readonly class="form-control" name="foregroundIPR" id="foreground-ipr" rows="3">{{ $user->foregroundIPR }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="background-ipr-contribution">Background IPR Available for Contribution to the Project and Nature of Ownership of the Background IPR (Exclusively Owned, Jointly Owned, Taken Under License, etc.) </label>
								      <textarea readonly class="form-control" name="backgroundIPRContribution" id="background-ipr-contribution" rows="3">{{ $user->backgroundIPRContribution }}</textarea>
								   </div>
								   <div class="col-sm-12 form-group">
								      <label for="background-ipr-status">Status of Background IPR (e.g., In Planning Stage, On Roadmap, Patented/Copyrighted, Under Development, Under Field Trials, Mass Deployed, etc.). Also, Specify Expected Duration of IPR Availability to This Project </label>
								      <textarea readonly class="form-control" name="backgroundIPRStatus" id="background-ipr-status" rows="3">{{ $user->backgroundIPRStatus }}</textarea>
								   </div>

								</div>

		            			<!-- -->
								   
							</div>
		          
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