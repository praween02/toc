/* validation js */
//let base_url = `${window.location.origin}/`; //local
let base_url = `${window.location.origin}/portal/public/`; //server

$(document).ready(function() {

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

                                if (state_id) {
                      $(`#state option[value=${state_id}]`).attr('selected','selected');
                      $("#state").trigger('change');
                    }
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

                                if (city_id) {
                      $(`#city option[value=${city_id}]`).attr('selected','selected');
                    }

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


    $('#sbmitbtn').on('click', function (e) {
        $("#6g_user_form").valid();
        let ele = $("#6g_user_form :input.error:first");
        if (ele.is(':hidden')) {
            let tabToShow = ele.closest('.tab-pane');
            $('#6g_user_form .nav-tabs button#' + tabToShow.attr('id') + '-tab').tab('show');
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

    $("#organization_name, #nodal_contact_person, #designation, #collaborator_name, #collaborator_designation, #collaborator_location_of_head_office_branch, #primary_objective_of_module_sub_system_product_solution_proposed, #any_regulatory_approval").keydown(function(event){
          let inputValue = event.which;
          if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 8 && inputValue != 9)) { 
              event.preventDefault(); 
          }
      });

      $("#contact_no, #pin_no, #collaborator_contact_no, #collaborator_size_company, #collaborator_company_turnover, #fund_expected").keydown(function(event){
          let inputValue = event.which;
          if ( ! ((inputValue >= 48 && inputValue <= 57) || inputValue == 8 || (inputValue >= 96 && inputValue <= 105))) {
              event.preventDefault();
          }
      });

    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z ]+$/i.test(value);
    }, "Please enter only letters and space"); 

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

    // expert tab 1
    $("#6g_user_form_organization").validate({
      ignore: [],  // ignore NOTHING
      rules: {
        organization_name: {
          required: true,
          lettersonly: true
        },
        nodal_contact_person: {
          required: true,
          lettersonly: true
        },
        designation: {
          required: true,
          lettersonly: true
        },

        authorization_letter: {
                          required: {
                              depends: function(element) {
                                  return $("#authorization_letter_hidden").is(":blank");
                              }
                          },
                          validatePdf: true,
                          filesize: 2,
                    },

            bio_data_professional_credentials: {
                  required: {
                          depends: function(element) {
                              return $("#bio_data_professional_credentials_hidden").is(":blank");
                          }
                      },
                  validatePdf: true,
                  filesize: 2,
            },

        contact_no: {
          required: true,
          digits: true,
          minlength: 10
        },
        email_id: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        },
        country: {
          required: true
        },
        state: {
          required: true
        },
        city: {
          required: true
        },

        address: {
          required: true,
        },

        pin_no: {
          required: true,
          digits: true,
          maxlength: 10
        }
      },
      messages: {
      },

      submitHandler: function(form) {

        $('#validation_block').html('').addClass('d-none');

        //setTimeout(() => { $("#network_msg").removeClass('d-none').fadeIn(10000);}, "1000"); // 10 sec

        let _token = $('meta[name="csrf-token"]').attr('content');

        let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#org_submit").attr('disabled', true).html('just a moment...');

            $.ajax({
                    url: `${base_url}application-form-expert-user-organization`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                  if (response.status == 'success') {
                                    $('.nav-tabs button#nav-collaborator-tab').tab('show');
                                  } else {
                                    alert('Something went wrong. Try again');
                                    
                                  }
            $("#org_submit").removeAttr('disabled').html('Save & Next &raquo;');
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
                                $("#org_submit").removeAttr('disabled').html('Save & Next &raquo;');
                                alert('Something went wrong!');
                            }
                });
        }
    });


    // expert tab 2
    $("#6g_user_form_collaborator").validate({
      ignore: [],  // ignore NOTHING
      rules: {
      },
      messages: {
      },

      submitHandler: function(form) {


        $('#validation_block').html('').addClass('d-none');

        let _token = $('meta[name="csrf-token"]').attr('content');

        let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#colaborator_submit").attr('disabled', true).html('just a moment...');

            $.ajax({
                    url: `${base_url}application-form-expert-user-collaborator`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                  if (response.status == 'success') {
                                    $('.nav-tabs button#nav-project-details-tab').tab('show');
                                  } 
                                  if (response.status == 'error') {
                                    alert('Something went wrong!');
                                  } 
                                  if (response.status == "validation") {
                                    $('#validation_block').html(response.msg).removeClass('d-none');
                                    $("html, body").animate({ scrollTop: 0 }, "slow");
                                  }
                                    $("#colaborator_submit").removeAttr('disabled').html('Save & Next &raquo;');
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
                                $("#colaborator_submit").removeAttr('disabled').html('Save & Next &raquo;');
                                alert('Something went wrong!');
                            }
                });
        }
    });

    // expert tab 3

    $("#6g_user_form_project_details").validate({
      ignore: [],  // ignore NOTHING
      rules: {

        /* Project Details */
        proposed_project_title: {
          required: true
        },

        collaboration_customers_clients: {
          maxlength: 2000
        },

        list_of_ipr_awards_paper_published: {
          maxlength: 2000
        },

        relevant_standards_standard_body_membership: {
          maxlength: 2000
        },
      },
      messages: {
      },

      submitHandler: function(form) {

        $('#validation_block').html('').addClass('d-none');

        let _token = $('meta[name="csrf-token"]').attr('content');

        let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#proj_details_submit").attr('disabled', true).html('just a moment...');

            $.ajax({
                    url: `${base_url}application-form-expert-user-project-details`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                  if (response.status == 'success') {
                                    $('.nav-tabs button#nav-product-desc-tab').tab('show');
                                  } 
                                  if (response.status == 'error') {
                                    alert('Something went wrong!');
                                  } 
                                  if (response.status == "validation") {
                                    $('#validation_block').html(response.msg).removeClass('d-none');
                                    $("html, body").animate({ scrollTop: 0 }, "slow");
                                  }
                                  $("#proj_details_submit").removeAttr('disabled').html('Save & Next &raquo;');
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
                                $("#proj_details_submit").removeAttr('disabled').html('Save & Next &raquo;');
                                alert('Something went wrong!');
                            }
                });
        }
    });


    // expert tab 4

    $("#6g_user_form_product_desc").validate({
      ignore: [],  // ignore NOTHING
      rules: {

        brief_product_solution_idea_description: {
          required: true,
          maxlength: 2000
        },

        brief_product_solution_idea_description_attachment: {
              required: {
                        depends: function(element) {
                            return $("#brief_product_solution_idea_description_attachment_hidden").is(":blank");
                        }
                    },
              validatePdf: true,
              filesize: 1,
                },

        primary_objective_of_module_sub_system_product_solution_proposed: {
          required: true
        },

        key_deliverables: {
          required: true,
          maxlength: 2000
        },

        type_of_solution_product: {
          required: true
        },

        details_prior_experience: {
          maxlength: 2000
        },

        if_the_proposed_solution_product: {
          maxlength: 2000
        },
        is_product_tech_related_to_present_activities: {
          maxlength: 2000
        },
        is_it_new_concept_design_sol_product: {
          maxlength: 2000
        },
        are_there_any_alternate_competive_tech_product: {
          maxlength: 2000
        },

        provide_the_specification_doc_relavant_to_product: {
          required: {
                          depends: function(element) {
                              return $("#provide_the_specification_doc_relavant_to_product_hidden").is(":blank");
                          }
                  },
          validatePdf: true,
          filesize: 1,
        },
      },
      messages: {
      },

      submitHandler: function(form) {

        $('#validation_block').html('').addClass('d-none');

        let _token = $('meta[name="csrf-token"]').attr('content');

        let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#proj_desc_submit").attr('disabled', true).html('just a moment...');

            $.ajax({
                    url: `${base_url}application-form-expert-user-product-desc`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                  if (response.status == 'success') {
                                    $('.nav-tabs button#nav-project-plan-tab').tab('show');
                                  } 
                                  if (response.status == 'error') {
                                    alert('Something went wrong!');
                                  } 
                                  if (response.status == "validation") {
                                    $('#validation_block').html(response.msg).removeClass('d-none');
                                    $("html, body").animate({ scrollTop: 0 }, "slow");
                                  }
                                  $("#proj_desc_submit").removeAttr('disabled').html('Save & Next &raquo;');
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
                                $("#proj_desc_submit").removeAttr('disabled').html('Save & Next &raquo;');
                                alert('Something went wrong!');
                            }
                });
        }
    });



    // expert tab 5

    $("#6g_user_form_project_plan").validate({
      ignore: [],  // ignore NOTHING
      rules: {

        provide_dev_plan_indicate_major_milestone: {
          required: true,
          maxlength: 2000
        },

        provide_dev_plan_indicate_major_milestone_attachment: {
          required: {
                          depends: function(element) {
                              return $("#provide_dev_plan_indicate_major_milestone_attachment_hidden").is(":blank");
                          }
                  },
          validatePdf: true,
          filesize: 1,
        },

        manpower_support_requirements: {
          required: true,
          maxlength: 2000
        },

        infrastructure_support_requirements: {
          required: true,
          maxlength: 2000
        },

        details_of_existing_tools_testers_platform: {
          required: true,
          maxlength: 2000
        },

        any_additional_dev_tools_software_requirements: {
          maxlength: 2000
        },
      },
      messages: {
      },

      submitHandler: function(form) {

        $('#validation_block').html('').addClass('d-none');

        let _token = $('meta[name="csrf-token"]').attr('content');

        let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#proj_plan_submit").attr('disabled', true).html('just a moment...');

            $.ajax({
                    url: `${base_url}application-form-expert-user-project-plan`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                  if (response.status == 'success') {
                                    $('.nav-tabs button#nav-funding-tab').tab('show');
                                  } 
                                  if (response.status == 'error') {
                                    alert('Something went wrong!');
                                  } 
                                  if (response.status == "validation") {
                                    $('#validation_block').html(response.msg).removeClass('d-none');
                                    $("html, body").animate({ scrollTop: 0 }, "slow");
                                  }
                                  $("#proj_plan_submit").removeAttr('disabled').html('Save & Next &raquo;');
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
                                $("#proj_plan_submit").removeAttr('disabled').html('Save & Next &raquo;');
                                alert('Something went wrong!');
                            }
                });
        }
    });


    // expert tab 6

    $("#6g_user_form_funding").validate({
      ignore: [],  // ignore NOTHING
      rules: {

        estimated_development_cost: {
          required: true,
          maxlength: 2000
        },

        estimated_development_cost_attachment: {
          required: {
                          depends: function(element) {
                              return $("#estimated_development_cost_attachment_hidden").is(":blank");
                          }
                  },
          validatePdf: true,
          filesize: 1,
        },

        fund_expected: {
          required: true,
          digits: true
        },

        any_regulatory_approval: {
          lettersonly: true
        },

        details_of_funding: {
          maxlength: 2000
        },

        details_self_funding: {
          maxlength: 2000
        },

        any_other_remarks: {
          maxlength: 2000
        },
      },
      messages: {
      },

      submitHandler: function(form) {

        $('#validation_block').html('').addClass('d-none');

        let _token = $('meta[name="csrf-token"]').attr('content');

        let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#funding_submit").attr('disabled', true).html('just a moment...');

            $.ajax({
                    url: `${base_url}application-form-expert-user-funding`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                  if (response.status == 'success') {
                                    $('.nav-tabs button#nav-regulatory-tab').tab('show');
                                  } 
                                  if (response.status == 'error') {
                                    alert('Something went wrong!');
                                  } 
                                  if (response.status == "validation") {
                                    $('#validation_block').html(response.msg).removeClass('d-none');
                                    $("html, body").animate({ scrollTop: 0 }, "slow");
                                  }
                                  $("#funding_submit").removeAttr('disabled').html('Save & Next &raquo;');
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
                                $("#funding_submit").removeAttr('disabled').html('Save & Next &raquo;');
                                alert('Something went wrong!');
                            }
                });
        }
    });



    // expert tab 6

    $("#6g_user_form_regulatory").validate({
      ignore: [],  // ignore NOTHING
      rules: {

        terms: {
          required: true,
        },
      },
      messages: {
      },

      submitHandler: function(form) {

        $('#validation_block').html('').addClass('d-none');

        let _token = $('meta[name="csrf-token"]').attr('content');

        let formData =  new FormData(form);

                formData.append("_token", _token);

                $("#sbmitbtn").attr('disabled', true).html('just a moment...');

            $.ajax({
                    url: `${base_url}application-form-expert-user-regulatory`,
                            type: "POST",    
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                  if (response.status == 'success') {
                                    location.href = `${base_url}applied-6g-application`;
                                  } 
                                  if (response.status == 'error') {
                                    alert('Something went wrong!');
                                  } 
                                  if (response.status == "validation") {
                                    $('#validation_block').html(response.msg).removeClass('d-none');
                                    $("html, body").animate({ scrollTop: 0 }, "slow");
                                  }
                                  $("#sbmitbtn").removeAttr('disabled').html('Submit');
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