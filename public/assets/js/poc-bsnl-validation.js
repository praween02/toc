/* validation js */
//let base_url = `${window.location.origin}/`; //local
let base_url = `${window.location.origin}/portal/public/`; //server


const pay_mode = (v) => {
  if (v == 'dd') {
  		$(".payment_box").removeClass('d-none');
  		$(".online_box").addClass('d-none');
  } else if(v == 'online') {
  		$(".payment_box").addClass('d-none');
  		$(".online_box").removeClass('d-none');
  } else {
  		$(".payment_box").addClass('d-none');
  		$(".online_box").addClass('d-none');
  }
}

$(document).ready(function() {

		$('#sbmitbtn').on('click', function (e) {
		    $("#poc_bsnl").valid();
		    let ele = $("#poc_bsnl :input.error:first");
		    if (ele.is(':hidden')) {
		        let tabToShow = ele.closest('.tab-pane');
		        $('#poc_bsnl .nav-tabs button#' + tabToShow.attr('id') + '-tab').tab('show');
		    }
		});


		$.validator.addMethod('filesize', function (value, element, param) {
		    return this.optional(element) || (element.files[0].size <= param * 1000000)
		}, 'File size must be less than {0} MB');


		$.validator.addMethod("validatePdf", function(value, element) {
			if (value) {
                let fileExtension = ['pdf'];
                return ($.inArray(value.split('.').pop().toLowerCase(), fileExtension) != -1)
            } else {
            	return true;
            }
        }, "Please select a valid file (PDF are allowed)");

        $.validator.addMethod("pdf_doc_docx", function(value, element) {
			if (value) {
                let fileExtension = ['pdf', 'doc', 'docx'];
                return ($.inArray(value.split('.').pop().toLowerCase(), fileExtension) != -1)
            } else {
            	return true;
            }
        }, "Please select a valid file (pdf, doc, docx)");

        $.validator.addMethod("jpg_jpeg_png", function(value, element) {
			if (value) {
                let fileExtension = ['jpg', 'jpeg', 'png'];
                return ($.inArray(value.split('.').pop().toLowerCase(), fileExtension) != -1)
            } else {
            	return true;
            }
        }, "Please select a valid file (jpg, jpeg, png)");


		$("#designation").keydown(function(event){
	        let inputValue = event.which;
	        if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 8 && inputValue != 9)) { 
	            event.preventDefault(); 
	        }
	    });


	    $("#contact_no").keydown(function(event){
	        let inputValue = event.which;
	        if ( ! ((inputValue >= 48 && inputValue <= 57) || inputValue == 8 || (inputValue >= 96 && inputValue <= 105))) {
	            event.preventDefault();
	        }
	    });

	    $("#amount").keydown(function(event){
	        let inputValue = event.which;
	        if ( ! ((inputValue >= 48 && inputValue <= 57) || inputValue == 8 || inputValue == 190 || inputValue == 110 ||(inputValue >= 96 && inputValue <= 105))) {
	            event.preventDefault();
	        }
	    });


	    $("#cin_number").keydown(function(event){
	        let inputValue = event.which;
	        if ( ! (/^[a-zA-Z0-9]+$/.test(event.key) || inputValue == 8 )) {
	            event.preventDefault();
	        }
	    });

	    $.validator.addMethod("alphanumeric", function(value, element) {
        	return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
		}, "Please enter only alphanumeric"); 

		$.validator.addMethod("lettersonly", function(value, element) {
		  	return this.optional(element) || /^[a-z ]+$/i.test(value);
		}, "Please enter only letters and space"); 

		// validate signup form on keyup and submit
		$("#poc_bsnl").validate({
			ignore: [],  // ignore NOTHING
			rules: {
				company_name: {
					required: true,
					minlength:6,
					maxlength:96,
				},
				cin_number: {
					alphanumeric: true,
					maxlength: 32
				},

				regd_office_address: {
					required: true,
					minlength:8,
					maxlength: 2048
				},

				corp_office_address: {
                    required: true,
                    minlength:8,
                    maxlength: 2048
                },

                company_website: {
                    required: true,
                    url: true,
                },

				mse_type: {
					required: true,
					maxlength:96
				},

				mse_certificate: {
					required: true,
					pdf_doc_docx: true
				},

				/* close */


				name: {
					required: true,
					maxlength: 96
				},

				designation: {
					required: true,
					maxlength: 96
				},

				contact_no: {
					required: true,
					digits: true,
					maxlength: 12
				},

				email_id: {
					required: true,
					email: true,
					maxlength: 96
				},

				/* close */

				payment_mode: {
					required: true,
					maxlength: 96
				},

				cheque_no: {
                	required: {
	                    depends: function () { return $('#payment_mode option:selected').val() == 'dd' } 
	                },
	                digits: 6,
	                minlength: 6,
	                maxlength: 6
	      },

				// cheque_no: {
				// 	required: true,
				// 	digits: true,
				// 	minlength: 6,
				// 	maxlength: 6
				// },

				amount: {
					required: {
	                    depends: function () { return $('#payment_mode option:selected').val() === 'dd' } 
	                },
					digits: true,
					maxlength: 16
				},

				issue_date: {
					required: {
	                    depends: function () { return $('#payment_mode option:selected').val() === 'dd' } 
	                },
					date: true
				},

				issue_branch: {
					required: {
	                    depends: function () { return $('#payment_mode option:selected').val() === 'dd' } 
	                },
					maxlength: 96
				},

				transaction_receipt: {
					required: {
	                    depends: function () { return $('#payment_mode option:selected').val() !== 'dd' } 
	                },
				},
				
				/* close */

				solution_name: {
					required: true,
					maxlength: 500
				},

				solution_designed_for: {
					required: true,
					maxlength: 500
				},

				solution_compiles_to: {
					required: true,
					maxlength: 500
				},

				solution_source: {
					required: true,
					maxlength: 500
				},

				solution_telecom: {
					required: true,
					maxlength: 500
				},

				solution_testing: {
					required: true,
					maxlength: 500
				},

				solution_mse_type: {
					required: true,
					maxlength: 500
				},

				solution_mse_certificate: {
					required: true,
					maxlength: 500,
					pdf_doc_docx: true
				},

				/* close */


				bsnl_voltage: {
					required: true,
					maxlength: 32
				},


				bsnl_current: {
					required: true,
					maxlength: 32
				},

				bsnl_space: {
					required: true,
					maxlength: 500
				},

				bsnl_port: {
					required: true,
					maxlength: 32
				},

				bsnl_bandwidth: {
					required: true,
					maxlength: 32
				},

				bsnl_testing_location: {
					required: true,
					maxlength: 96
				},

				requirements: {
					minlength: 16
				},

				/* close */

				signature: {
					required: true,
					filesize: 2,
					jpg_jpeg_png: true
				},

				cert_incorporation: {
					required: true,
					validatePdf: true,
					filesize: 2,
				},

				cert_self_declaration: {
					required: true,
					validatePdf: true,
					filesize: 2,
				},

				cert_self_declaration_lab: {
					required: true,
					filesize: 2,
					validatePdf: true
				},

				cert_draft: {
					required: true,
					filesize: 2,
					validatePdf: true
				},

				cert_ownership: {
					required: true,
					filesize: 2,
					validatePdf: true
				},

				/* close */

				terms: "required"
			},
			messages: {

			},

			submitHandler: function(form) {

				$("#errors").html('');

				let _token = $('meta[name="csrf-token"]').attr('content');

				let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#sbmitbtn").attr('disabled', true).html('just a moment...');

		        $.ajax({
				            url: `${base_url}application-form-poc-bsnl`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {

	                                if (response.status == 'success') {
	                                	location.href = `${base_url}list-poc-bsnl`;
	                                } else {
	                                	alert('Something went wrong. Try again');
	                                	$("#sbmitbtn").removeAttr('disabled').html('Submit');
	                                }
                            },
                            error: function (jqXHR, exception) {

                            	if (jqXHR?.responseJSON?.errors)
	                        			{
	                        			 	let validation = '<ul class=\'err\'>';

	                        			 	for (const [key, value] of Object.entries(jqXHR?.responseJSON?.errors)) 
	                        			 		{
												  							validation += `<li>${value}</li>`;
																		}
	                        			 		validation += `</ul>`;
	                        			 		$("#errors").html(validation);
	                        			 		$("html, body").animate({ scrollTop: 0 }, "slow");
	                        			}
                                		$("#sbmitbtn").removeAttr('disabled').html('Submit');
                                		alert('Something went wrong!');
                            }
		       		  });
		    }

		});
});