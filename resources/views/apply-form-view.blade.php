@extends('layouts.app')
@section('title', ' - Users')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
		    <div class="container">
		        <div class="card" style="margin-top:15px">
		            <div class="card-body" >
		            	
		            	<div class = "container" >
   <table class="table">
      <thead>
         <tr>
            <th scope="col">S.No.</th>
            <th scope="col">Company Name</th>
            <th scope="col">Email id</th>
            <th scope="col">Contact No</th>
            <th scope="col">Designation</th>
            <th scope="col">CIN Number</th>
            <th scope="col">Action</th>
         </tr>
      </thead>
      <tbody>
         
            <?php  $i=1 ?>
            <?php foreach($records as $record){ ?>
		  <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $record['company_name']; ?></td>
            <td><?php echo $record['email_id']; ?></td>
            <td><?php echo $record['contact_no']; ?></td>
            <td><?php echo $record['designation']; ?></td>
            <td><?php echo $record['cin_number']; ?></td>
            <td>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$record['id']}}" data-id="<?php echo $record['id']; ?>">
               View
               </button>
            </td>
			  </tr>
            <?php } ?>

      </tbody>
   </table>
</div>
<?php foreach($records as $record){ ?>
<div class="modal fade" id="exampleModalCenter{{$record['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <p>POC BSNL</p>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="col-sm-12 mx-t3 mb-4 mt-3">
               <h5>Applicant Details:</h5>
            </div>
            <div class="col-sm-6 form-group">
               <label for="name-f">Company/Firm Name:</label>
               <input type="text" class="form-control" value="{{$record['company_name']}}" id="name-f"
                  placeholder="Enter your company/firm name." readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="name-l">CIN Number (if applicable)</label>
               <input type="text" class="form-control" value="{{$record['cin_number']}}" id="name-l"
                  placeholder="Enter CIN number if applicable." readonly >
            </div>
            <div class="col-sm-6 form-group">
               <label for="registered-address">Registered Office Address</label>
               <textarea class="form-control" id="myTextarea"
                  placeholder="Enter registered office address." style="color:black" readonly>{{$record['regd_office_address']}}</textarea>
            </div>
            <div class="col-sm-6 form-group">
               <label for="corporate-address">Corporate Office Address</label>
               <textarea class="form-control" id="corporate-address"
                  placeholder="Enter corporate office address."  style="color:black" readonly>{{$record['corp_office_address']}}</textarea>
            </div>
            <div class="col-sm-12 form-group">
               <label for="website">Company/Firm Website</label>
               <input type="text" class="form-control" value="{{$record['company_website']}}" id="website"
                  placeholder="Enter website URL." readonly>
            </div>
            <div class="col-sm-10 form-group">
               <label for="enterpriseInfo">Whether the applicant is a Startup or Micro or Small
               Enterprise
               (MSE)</label>
               <div class="input-group">
                  <input type="text" class="form-control" name="mse_type" id="enterpriseType"
                     placeholder="Enter enterprise type" readonly>
                  <div class="input-group-append">
                     <label class="input-group-text" for="certificate"> <i
                        class="fa fa-upload pr-1"></i> Attach Certificate</label>
                     <input type="file" class="form-control" name="mse_certificate" id="certificate"
                        accept=".pdf, .doc, .docx" />
                  </div>
               </div>
               <small class="form-text text-muted">Attach a certificate verifying your enterprise
               type.</small>
            </div>
            <!-- 2. -->
            <div class="col-sm-12 mt-3 mb-4">
               <h5>Authorized Contact Person Detail</h5>
            </div>
            <div class="col-sm-6 form-group">
               <label for="name">Name:</label>
               <input type="text" class="form-control"value="{{$record['name']}}" id="name"
                  placeholder="Enter your name." readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="designation">Designation:</label>
               <input type="text" class="form-control"value="{{$record['designation']}}" id="designation"
                  placeholder="Enter your designation." readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="contact-number">Contact Number:</label>
               <input type="tel" class="form-control" value="{{$record['contact_no']}}" id="contact-number"
                  placeholder="Enter your contact number." readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="email">Email ID:</label>
               <input type="email" class="form-control" value="{{$record['email_id']}}" id="email"
                  placeholder="Enter your email ID." readonly>
            </div>
            <!-- 3. -->
            <div class="col-sm-12 mt-3 mb-4">
               <h5>Details of payment of Registration fee</h5>
            </div>
            <!-- Fields for DD/Banker's Cheque Information -->
            <div class="col-sm-6 form-group">
               <label for="dd-number">DD/Banker's Cheque Number:</label>
               <input type="text" class="form-control" value="{{$record['cheque_no']}}" id="dd-number"
                  placeholder="Enter DD/Banker's Cheque Number." readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="amount">Amount:</label>
               <input type="number" class="form-control"  value="{{$record['amount']}}" id="amount"
                  placeholder="Enter the amount." readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="date-of-issue">Date of Issue:</label>
               <input type="date" class="form-control" name="issue_date" value="{{$record['issue_date']}}" id="date-of-issue" readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="issuing-branch">Name of Issuing Branch & Bank:</label>
               <input type="text" class="form-control" name="issue_branch" value="{{$record['issue_branch']}}" id="issuing-branch"
                  placeholder="Enter issuing branch & bank." readonly>
            </div>
            <div class="col-sm-12 form-group">
               <label for="payment-mode">Payment Mode:</label>
               <select class="form-control" name="payment_mode" value="{{$record['payment_mode']}}" id="payment-mode">
                  <option value="dd">DD/Banker's Cheque</option>
                  <option value="online">Online (RTGS/NEFT)</option>
               </select>
            </div>
            <div class="col-sm-12 form-group" id="online-payment-details" style="display: none;">
               <label for="proof-of-payment">Proof of Payment:</label>
               <input type="file" class="form-control" name="proofOfPayment" value="" id="proof-of-payment"
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
                  placeholder="Enter your product/solution name."  style="color:black">{{$record['solution_name']}}</textarea>
            </div>
            <div class="col-sm-12 form-group">
               <label for="product-description">Which part of the telecom network is the
               Product/Solution designed
               for:</label>
               <textarea class="form-control" name="solution_designed_for" id="product-description"
                  placeholder="Enter the part of the telecom network your product/solution is designed for."  style="color:black"
                  >{{$record['solution_designed_for']}}</textarea>
               <small class="form-text text-muted">Please provide a brief description of the
               product/solution and
               its intended use as a separate annexure.</small>
            </div>
            <div class="col-sm-12 form-group">
               <label for="compliance-standard">Name of standard/specification to which the
               product/solution
               complies to:</label>
               <input type="text" class="form-control" value="{{$record['solution_compiles_to']}}"
                  id="compliance-standard" placeholder="Enter the standard/specification name."
                  readonly>
            </div>
            <div class="col-sm-12 form-group">
               <label for="similar-product">Is there any similar product/solution already available in
               the market?
               If yes, information on sources may be provided:</label>
               <textarea class="form-control" name="solution_source" id="similar-product"
                  placeholder="Provide information on similar products/solutions in the market, if any."  style="color:black"
                  >{{$record['solution_source']}}</textarea>
            </div>
            <div class="col-sm-12 form-group">
               <label for="value-addition">If there is no similar product/solution already available in
               the market,
               how will your product/solution add value to the telecom industry:</label>
               <textarea class="form-control" name="solution_telecom" id="value-addition"
                  placeholder="Explain how your product/solution will add value to the telecom industry in the absence of similar products."  style="color:black"
                  >{{$record['solution_telecom']}}</textarea>
            </div>
            <div class="col-sm-12 form-group">
               <label for="poc-testing-duration">Approximate time period required for complete PoC
               testing:</label>
               <input type="text" class="form-control" name="solution_testing" value="{{$record['solution_testing']}}"
                  id="poc-testing-duration"
                  placeholder="Enter the estimated time period for PoC testing." readonly>
            </div>
            <div class="col-sm-10 form-group">
               <label for="enterpriseInfo">Whether the applicant is a Startup or Micro or Small
               Enterprise
               (MSE)</label>
               <div class="input-group">
                  <input type="text" class="form-control" id="enterpriseType" value="{{$record['solution_mse_type']}}"
                     placeholder="Enter enterprise type" readonly>
                  <div class="input-group-append">
                     <label class="input-group-text" for="certificate">Attach Certificate</label>
                     <input type="file" class="form-control" name="solution_mse_certificate" id="certificate" accept=".pdf, .doc, .docx" readonly> 
                  </div>
               </div>
               <small class="form-text text-muted">Attach a certificate verifying your enterprise
               type.</small>
            </div>
            <!-- 5. -->
            <div class="col-sm-12 mt-3 mb-4">
               <h5>Infrastructure Requirements expected to be provided by BSNL:</h5>
            </div>
            <div class="col-sm-6 form-group">
               <label for="power-specification">Power (Specify voltage and current):</label>
               <div class="input-group">
                  <input type="text" class="form-control" id="voltage" value="{{$record['bsnl_voltage']}}"
                     placeholder="Voltage" readonly>
                  <input type="text" class="form-control" id="current" value="{{$record['bsnl_current']}}"
                     placeholder="Current" readonly>
               </div>
            </div>
            <div class="col-sm-6 form-group">
               <label for="space-specification">Space (Specify dimensions and any special
               requirements):</label>
               <textarea class="form-control" id="space-specification"  value="{{$record['bsnl_space']}}"
                  placeholder="Enter dimensions and special requirements..."  style="color:black"></textarea>
            </div>
            <div class="col-sm-6 form-group">
               <label for="transmission-port">Transmission Port:</label>
               <input type="text" class="form-control" name="bsnl_port" id="transmission-port" value="{{$record['bsnl_port']}}"
                  placeholder="Enter Specify the transmission port" readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="bandwidth">Bandwidth:</label>
               <input type="text" class="form-control" name="bsnl_bandwidth" id="bandwidth" value="{{$record['bsnl_bandwidth']}}"
                  placeholder="Enter the bandwidth" readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="poc-testing-location">Preferred PoC Testing Location:</label>
               <input type="text" class="form-control" name="bsnl_testing_location" value="{{$record['bsnl_testing_location']}}"
                  id="poc-testing-location" placeholder="Enter the preferred PoC testing location" readonly
                  >
            </div>
            <div class="col-sm-6 form-group">
               <label for="additional-requirements">Any Other Requirement:</label>
               <textarea class="form-control" name="requirements" value="{{$record['requirements']}}"
                  id="additional-requirements"
                  placeholder="Provide any additional information ..."  style="color:black"
                  ></textarea>
            </div>
            <div class="col-sm-6">
               <input type="checkbox" class="form-check d-inline" id="chb"><label for="chb"
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
                        id="signature-upload" accept=".png, .jpg, .jpeg" readonly>
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
                  id="certificate-of-incorporation" accept=".pdf, .doc, .docx" readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="self-declaration-standards">Self-declaration - Relevant Standards:</label>
               <input type="file" class="form-control" name="cert_self_declaration"
                  id="self-declaration-standards" accept=".pdf, .doc, .docx" readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="self-declaration-lab-tests">Self-declaration - Lab Tests:</label>
               <input type="file" class="form-control" name="cert_self_declaration_lab"
                  id="self-declaration-lab-tests" accept=".pdf, .doc, .docx" readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="draft-test-schedule">Draft Test Schedule:</label>
               <input type="file" class="form-control" name="cert_draft"
                  id="draft-test-schedule" accept=".pdf, .doc, .docx" readonly>
            </div>
            <div class="col-sm-6 form-group">
               <label for="undertaking-ownership">Undertaking - Ownership:</label>
               <input type="file" class="form-control" name="cert_ownership"
                  id="undertaking-ownership" accept=".pdf, .doc, .docx" readonly>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<?php }?>
@endsection

		                
		            </div>
		        </div>
		    </div>
		<!-- End Content-->
	</div>
</div>



