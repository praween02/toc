/* validation js */
//let base_url = `${window.location.origin}/`; //local
let base_url = `${window.location.origin}/portal/public/`; //server

$(document).ready(function() {

		$('#activity').change(function() {
			let activity = $(this).val();
			if(activity == "") {
			    $("#remarks").removeClass('d-none');
			    $("#other").val('').addClass('d-none');
			}
			else if (activity == 16){
				$("#other").removeClass('d-none');
				$("#remarks").addClass('d-none').val('');
			} else {
				$("#other").val('').addClass('d-none');
				$("#remarks").addClass('d-none').val('');
			}
		});

		$('#sbmitbtn').on('click', function (e) {
		    $("#expert-form").valid();
		    let ele = $("#expert-form :input.error:first");
		    if (ele.is(':hidden')) {
		        let tabToShow = ele.closest('.tab-pane');
		        $('#expert-form .nav-tabs button#' + tabToShow.attr('id') + '-tab').tab('show');
		    }
		});

		$('#country').change(function (e) {
		    let country_id = $(this).val();
		    let url = `${base_url}states/${country_id}`;
		    get_states(url);
		});

		$('#state').change(function (e) {
		    let state_id = $(this).val();
		    let url = `${base_url}cities/${state_id}`;
		    get_cities(url);
		});

		function get_states(url) 
			{
				$(`#state`).html(`<option value="">loading...</option>`);
				$.ajax({
				            url,
	                        type: "GET",    
	                        success: function(response) {

	                        	if (response.states.length > 0) 
	                        		 {
	                        		 	let option = `<option value="">-- Select --</option>`;
	                        		 	$.each(response.states, function (a, b) {
	                        		 			option += `<option value=${b.id}>${b.name}</option>`;
	                        		 	});

	                        		 	$(`#state`).html(option);
	                        		 	$('#city').html('');
	                        		 }
	                        	else {
	                        		$(`#state`).html(`<option value="">-- Select --</option>`);
	                        	}
	                        },
	                        error: function (jqXHR, exception) {
	                        	$(`#state`).html(`<option value="">-- Select --</option>`);
	                        }
		       		  });

			}

		function get_cities(url) 
			{
				$(`#city`).html(`<option value="">loading...</option>`);
				$.ajax({
				            url,
	                        type: "GET",    
	                        success: function(response) {
	                        	if (response.cities.length > 0) 
	                        		 {
	                        		 	let option = `<option value="">-- Select --</option>`;
	                        		 	$.each(response.cities, function (a, b) {
	                        		 			option += `<option value=${b.id}>${b.name}</option>`;
	                        		 	});
	                        		 	$(`#city`).html(option);
	                        		 }
	                        	else {
	                        		$(`#city`).html(`<option value="">-- Select --</option>`);
	                        	}
	                        },
	                        error: function (jqXHR, exception) {
	                        	$(`#city`).html(`<option value="">-- Select --</option>`);
	                        }
		       		  });
			}


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

	     $("#family_name, #first_name, #position").keydown(function(event){
	        let inputValue = event.which;
	        if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 8 && inputValue != 9)) { 
	            event.preventDefault(); 
	        }
	     });

	    $("#contact_no, #post_code").keydown(function(event){
	        let inputValue = event.which;
	        if ( ! ((inputValue >= 48 && inputValue <= 57) || inputValue == 8 || (inputValue >= 96 && inputValue <= 105))) {
	            event.preventDefault();
	        }
	    });

	    $.validator.addMethod("regex", function(value, element, regexp)  {
		        /* Check if the value is truthy (avoid null.constructor) & if it's not a RegEx. (Edited: regex --> regexp)*/
		        if (regexp && regexp.constructor != RegExp) {
		           /* Create a new regular expression using the regex argument. */
		           regexp = new RegExp(regexp);
		        }
		        /* Check whether the argument is global and, if so set its last index to 0. */
		        else if (regexp.global) regexp.lastIndex = 0;
		        /* Return whether the element is optional or the result of the validation. */
		        return this.optional(element) || regexp.test(value);
		    }, "Please enter a valid email address."
		);


	    // $("#post_code").keydown(function(event){
	    //     let inputValue = event.which;
	    //     if ( ! (/^[a-zA-Z0-9]+$/.test(event.key) || inputValue == 8 )) {
	    //         event.preventDefault();
	    //     }
	    // });

	    $.validator.addMethod("alphanumeric", function(value, element) {
        	return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
		  }, "Please enter only alphanumeric"); 

			$.validator.addMethod("lettersonly", function(value, element) {
			  	return this.optional(element) || /^[a-z ]+$/i.test(value);
			}, "Please enter only letters and space"); 

		// validate signup form on keyup and submit
		$("#expert-form").validate({
			ignore: [],  // ignore NOTHING
			rules: {
				family_name: {
					required: true,
					minlength:2,
					maxlength:96,
				},
				first_name: {
					required: true,
					minlength:2,
					maxlength:96,
				},

				position: {
					required: true,
					minlength:2,
					maxlength:96,
				},

				current_organization: {
					required: true,
					minlength:2,
					maxlength: 2048
				},

				affiliations_certifications: {
			            required: true,
			            minlength:8,
			            maxlength: 2048
			       },

				graduation_date: {
					required: true
				},
				
				official_email: {
					required: true,
					email: true,
					regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
				},

				personal_email: {
					required: true,
					email: true
				},

				country: {
					required: true,
					digits: true
				},

				state: {
					required: true,
					digits: true
				},

				city: {
					required: true,
					digits: true
				},

				address: {
					required: true,
					minlength:12,
          				maxlength: 2048
				},

				post_code: {
					required: true,
					digits: true,
					minlength:5,
					maxlength:6
				},

				whether_have_oci: {
					required: true,
				},

				telephone: {
					 required: true,
					 digits: true,
					 minlength: 10,
					 maxlength: 10
				},

				tel_mobile: {
					 required: true,
					 digits: true,
					 minlength: 10,
					 maxlength: 10
				},

				fax_prof: {
					 digits: true,
					 minlength: 10,
					 maxlength: 10
				},

				/* close */

				/* activity: {
					required: true
				},*/
				
				other: {
					maxlength: 255,
					required: function () {
			            		return ($('#activity').val() == 16)
			        	},
				},

				remarks: {
					required: function () {
			            		return ($('#activity').val() == "")
			        	},
				},


				level: {
					 required: true,
					 maxlength: 16
				},

				cv: {
					required: true,
					validatePdf: true
				},

				id_number: {
					required: true,
					alphanumeric: true,
					minlength: 3,
					maxlength: 16
				},

				id_proof_document: {
					required: true,
					validatePdf: true,
				},

				photograph: {
					required: true,
					jpg_jpeg_png: true
				},

				web_page: {
					required: true,
					url: true,
					maxlength: 255
				},
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
				            url: `${base_url}application-form-expert-user`,
		                        type: "POST",    
		                        data: formData,
		                        processData: false,
		                        contentType: false,
		                        success: function(response) {
		                              if (response.status == 'success') {
		                              	location.href = `${base_url}list-expert-user`;
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