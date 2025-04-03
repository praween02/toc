<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Registration</title>
    <style>
        /* Resetting default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('https://eservices.dot.gov.in/5ghackathon/public/assets/media/auth/bg4.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background-attachment: fixed;
        }

        .outerdiv {
            max-width: 900px;
            margin-top: 100px;
            margin-bottom: 100px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .logo-brands {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo-left {
            max-height: 80px;
            width: auto;
        }

        .logo-right {
            max-height: 60px;
            width: auto;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            margin: 20px 0 15px;
        }

        .page-heading {
            font-size: 1.5rem;
            color: #333;
        }

        hr {
            margin: 0 0 20px 0;
            border-color: #eee;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        .required {
            color: #dc3545;
        }

        .form-control,
        .form-select {
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-light-primary {
            color: #1b84ff;
            background-color: #e9f3ff;
            border: 1px solid #d0e3ff;
        }

        .btn-light-primary:hover {
            background-color: #d0e3ff;
        }

        .btn-light-success {
            color: #28a745;
            background-color: #e8f5e9;
            border: 1px solid #c8e6c9;
        }

        .btn-light-success:hover {
            background-color: #d4edda;
        }

        .btn-light-danger {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .btn-light-danger:hover {
            background-color: #f5c6cb;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .captcha img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        .reload {
            font-size: 1.5rem;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        #timer,
        #email-timer {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .outerdiv {
                margin-top: 50px;
                margin-bottom: 50px;
                padding: 20px;
            }

            .logo-brands {
                justify-content: center;
            }

            .logo-right {
                max-width: 250px;
            }

            .col-md-6 {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .outerdiv {
                margin-top: 20px;
                margin-bottom: 20px;
                padding: 15px;
            }

            .page-heading {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    <div class="outerdiv">
        <div class="logo-brands">
            <img alt="Logo" class="logo-left" src="<?php echo e(asset('assets/images/dot-logo.jpg')); ?>">
        </div>

        <form class="form w-100" method="POST" id="registration_form">
            <div class="card-header">
                <h1 class="page-heading">User Registration Details</h1>
            </div>
            <hr>

            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <label for="applicant_category" class="form-label">Applicant Category <span
                            class="required">*</span></label>
                    <select name="applicant_category" id="applicant_category" class="form-select" required>
                        <option value="">Choose Applicant Category</option>
                        <option value="Academia">Academia</option>
                        <option value="Industry">Industry</option>
                        <option value="R&D">R & D</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4" id="subcategory_container" style="display: none;">
                    <label for="subcategory" class="form-label">SubCategory <span class="required">*</span></label>
                    <select name="subcategory" id="subcategory" class="form-select" required>
                        <option value="">Choose SubCategory</option>
                    </select>
                </div>
            </div>

            <div class="card-header">
                <h1 class="page-heading">Basic Details</h1>
            </div>
            <hr>

            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <label for="person_name" class="form-label">Person Name<span class="required">*</span></label>
                    <input type="text" class="form-control" name="person_name" id="person_name"
                        placeholder="Enter Person Name" required>
                </div>
                <div class="col-12 col-md-4 mb-4" id="qualification-div">
                    <label for="qualification" class="form-label">Qualification<span class="required">*</span></label>
                    <select name="qualification" class="form-select" id="qualification" required>
                        <option value="">Choose Qualification</option>
                        <option value="UG">UG</option>
                        <option value="PG">PG</option>
                        <option value="B.Tech">B.Tech</option>
                        <option value="M.Tech">M.Tech</option>
                        <option value="Ph.D">Ph.D</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 mb-4" id="designation-div" style="display: none;">
                    <label for="designation" class="form-label">Designation<span class="required">*</span></label>
                    <input type="text" class="form-control" name="designation" id="designation"
                        placeholder="Enter your Designation">
                </div>

                <div class="col-12 col-md-4 mb-4" id="institute-div" >
                    <label for="institute_id" class="form-label">Institute / Company<span class="required">*</span></label>
                    <input type="text" class="form-control" name="institute_input" id="institute_input" placeholder="Enter Institute/Company name">
                </div>
                <div class="col-12 col-md-4 mb-4" id="other_institute_div" style="display:none;">
                    <label for="institute_company" class="form-label">Specify Institute / Company<span
                            class="required">*</span></label>
                    <input type="text" class="form-control" name="institute_company" id="institute_company"
                        placeholder="Enter Institute/Company name">
                </div>
                <div class="col-12 col-md-4 mb-4" id="pan-card-div" style="display:none;">
                    <label for="pan_number" class="form-label">Pan Number / Other Govt Id</label>
                    <input type="text" class="form-control" maxlength="18" name="pan_number" id="pan_number"
                        placeholder="Enter PAN Number / Other Govt Id">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="address" class="form-label">Address<span class="required">*</span></label>
                    <textarea class="form-control" name="address" id="address" rows="2" placeholder="Enter Address"
                        required></textarea>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="reason_to_join" class="form-label">Reason to Join<span
                            class="required">*</span></label>
                    <textarea class="form-control" name="reason_to_join" id="reason_to_join" rows="3"
                        placeholder="Enter your reason for joining" required></textarea>
                </div>
            </div>

            <div class="card-header">
                <h1 class="page-heading">5G Use Case Lab</h1>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <label for="zone" class="form-label">Zone<span class="required">*</span></label>
                    <select name="zone" id="zone" class="form-select" required>
                        <option value="">Select Zone</option>
                        <option value="east">East</option>
                        <option value="west">West</option>
                        <option value="north">North</option>
                        <option value="south">South</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <label for="institute_selection" class="form-label">Select Institute<span
                            class="required">*</span></label>
                    <select name="institute_selection" id="institute_selection" class="form-select" required>
                        <option value="">Select Institute</option>
                    </select>
                </div>
            </div>

            <div class="card-header">
                <h1 class="page-heading">Authorization Details</h1>
            </div>
            <hr>

            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <label for="mobile_no" class="form-label">Mobile No.<span class="required">*</span></label>
                    <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                        placeholder="Enter Mobile no." maxlength="10" required>
                    <span id="verifyStatus"></span>
                </div>
                <div class="col-md-2 mb-4 sendMobOTPDiv">
                    <button type="button" class="btn btn-light-primary mt-0 mt-md-4" id="send_mobile_otp">Get OTP</button>
                </div>
                <div class="col-md-2 mb-4 verifyMobOTPDiv" style="display:none;">
                    <label class="form-label">Mobile OTP</label>
                    <input type="text" class="form-control" id="mobile_otp" placeholder="Enter OTP" name="mobile_otp"
                        maxlength="6">
                </div>
                <div class="col-12 col-md-4 mb-4 resendMobBtnDiv" style="display:none;">
                    <button type="button" class="btn btn-light-success verifyMobOTPBtn">Verify</button>
                    <button type="button" class="btn btn-light-danger resendMobOTPBtn">Resend</button>
                    <div id="timer" style="display:none;"> Time left: <span id="time-left"></span> seconds</div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <label for="email_id" class="form-label">Email Id <span class="required">*</span></label>
                    <input type="email" name="email_id" id="email_id" class="form-control"
                        placeholder="Enter Email Id" required>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <label for="password" class="form-label">Password <span class="required">*</span></label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter Password" required>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password <span
                            class="required">*</span></label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                        placeholder="Confirm Password" required>
                </div>
                <div class="col-md-2 mb-4 sendEmailOTPDiv">
                    <button type="button" class="btn btn-light-primary mt-0 mt-md-4" id="send_email_otp">Get OTP</button>
                </div>
                <div class="col-md-2 mb-4 verifyEmailOTPDiv" style="display:none;">
                    <label class="form-label">Email OTP</label>
                    <input type="text" class="form-control" id="email_otp" placeholder="Enter OTP" name="email_otp"
                        maxlength="6">
                </div>
                <div class="col-12 col-md-4 mb-4 resendEmailBtnDiv" style="display:none;">
                    <button type="button" class="btn btn-light-success verifyEmailOTPBtn">Verify</button>
                    <button type="button" class="btn btn-light-danger resendEmailOTPBtn">Resend</button>
                    <div id="email-timer" style="display:none;"> Time left: <span id="email-time-left"></span> seconds
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="form-label">Captcha</label>
                        <span><img src="https://via.placeholder.com/150x50?text=CAPTCHA" alt="Captcha Image"></span>
                    </div>
                </div>
                <div class="col-sm-6 col-md-1">
                    <div class="form-group cpt_div2">
                        <div class="captchareload btn-refresh mt-4">
                            <a href="javascript:void(0);" class="reload" id="reloadCaptcha">🔄</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <input type="text" name="captcha" id="captcha" class="form-control"
                            placeholder="Enter captcha" required>
                        <span id="captchaError" style="color: red; display: none;">Please enter the correct CAPTCHA</span>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Show/hide other institute field
            $('#institute_id').change(function () {
                if ($(this).val() === 'other') {
                    $('#other_institute_div').show();
                    $('#institute_company').attr('required', true);
                } else {
                    $('#other_institute_div').hide();
                    $('#institute_company').removeAttr('required');
                }
            });

            // Function to update subcategories based on applicant category
            function updateSubcategories(category) {
                var subcategoryDropdown = $('#subcategory');
                var subcategoryContainer = $('#subcategory_container');
                subcategoryDropdown.empty().append('<option value="">Choose SubCategory</option>');

                if (category === 'Academia') {
                    subcategoryContainer.show();
                    $.each(['Student', 'Faculty', 'Other'], function (index, subcategory) {
                        subcategoryDropdown.append('<option value="' + subcategory + '">' + subcategory + '</option>');
                    });
                    subcategoryDropdown.prop('required', true);
                } else if (category === 'Industry') {
                    subcategoryContainer.show();
                    $.each(['MSME', 'Startup'], function (index, subcategory) {
                        subcategoryDropdown.append('<option value="' + subcategory + '">' + subcategory + '</option>');
                    });
                    subcategoryDropdown.prop('required', true);
                } else {
                    subcategoryContainer.hide();
                    subcategoryDropdown.prop('required', false);
                }
            }

            // Function to toggle visibility of Designation and PAN Card fields
            function toggleAdditionalFields(category, subcategory) {
                var designationDiv = $('#designation-div');
                var designationInput = $('#designation');
                var panCardDiv = $('#pan-card-div');
                var panCardInput = $('#pan_number');
                var qualificationDiv = $('#qualification-div');
                var instituteDiv = $('#institute-div');

                // Hide all fields initially
                designationDiv.hide();
                designationInput.removeAttr('required');
                panCardDiv.hide();
                panCardInput.removeAttr('required');
                qualificationDiv.show();
                instituteDiv.show();

                if (category === 'Academia' && subcategory === 'Faculty') {
                    designationDiv.show();
                    designationInput.prop('required', true);
                } else if (category === 'Industry' && (subcategory === 'Startup' || subcategory === 'MSME')) {
                    designationDiv.show();
                    designationInput.prop('required', true);
                    qualificationDiv.hide(); // Hide qualification for MSME and Startup
                } else if (category === 'R&D') {
                    // Show designation field for R&D category
                    designationDiv.show();
                    designationInput.prop('required', true);
                    panCardDiv.hide();
                    panCardInput.removeAttr('required');
                } else if (subcategory === 'Other') {
                    panCardDiv.show();
                    panCardInput.prop('required', true);
                    qualificationDiv.hide();
                    instituteDiv.hide();
                }
            }

            // Event listener for Applicant Category change
            $('#applicant_category').on('change', function () {
                var category = $(this).val();
                updateSubcategories(category);
                // Reset SubCategory on Category change
                $('#subcategory').val('');
                // Initially hide additional fields until subcategory is selected (if applicable)
                toggleAdditionalFields(category, '');
            });

            // Event listener for SubCategory change
            $('#subcategory').on('change', function () {
                var category = $('#applicant_category').val();
                var subcategory = $(this).val();
                toggleAdditionalFields(category, subcategory);
            });

            // Function to update institute dropdown based on zone
            function updateInstituteDropdown(zone) {
                var instituteDropdown = $('#institute_selection');
                instituteDropdown.empty().append('<option value="">Select Institute</option>');

                var institutesByZone = {
                    'east': ['IIT Kharagpur', 'IIT Patna', 'IIT Guwahati'],
                    'west': ['IIT Bombay', 'IIT Gandhinagar', 'IIT Indore'],
                    'north': ['IIT Delhi', 'IIT Kanpur', 'IIT Roorkee'],
                    'south': ['IIT Madras', 'IIT Hyderabad', 'IIT Tirupati']
                };

                if (zone && institutesByZone[zone]) {
                    $.each(institutesByZone[zone], function (index, institute) {
                        instituteDropdown.append('<option value="' + institute + '">' + institute + '</option>');
                    });
                }
            }

            // Event listener for Zone change
            $('#zone').on('change', function () {
                var zone = $(this).val();
                updateInstituteDropdown(zone);
            });

            // Event listener for qualification change
            $('#qualification').on('change', function () {
                if ($(this).val() === 'Other') {
                    $('#pan-card-div').hide();
                    $('#pan_number').removeAttr('required');
                } else {
                    $('#pan-card-div').hide();
                    $('#pan_number').removeAttr('required');
                }
            });

            // Initial state on page load
            if ($('#applicant_category').val()) {
                updateSubcategories($('#applicant_category').val());
                toggleAdditionalFields($('#applicant_category').val(), $('#subcategory').val());
            } else {
                $('#subcategory_container').hide();
                $('#designation-div').hide();
                $('#pan-card-div').hide();
            }
            $('#zone').trigger('change');

            // Mobile OTP buttons
            $('#send_mobile_otp').click(function () {
                $('.sendMobOTPDiv').hide();
                $('.verifyMobOTPDiv').show();
                $('.resendMobBtnDiv').show();
                $('#timer').show();
                startTimer(120, 'time-left');
            });

            // Email OTP buttons
            $('#send_email_otp').click(function () {
                $('.sendEmailOTPDiv').hide();
                $('.verifyEmailOTPDiv').show();
                $('.resendEmailBtnDiv').show();
                $('#email-timer').show();
                startTimer(120, 'email-time-left');
            });

            // Captcha reload
            $('#reloadCaptcha').click(function (e) {
                e.preventDefault();
                alert('Captcha would be refreshed in a real application');
            });

            // Form submission
            $('#registration_form').submit(function (e) {
                e.preventDefault();
                let captchaValue = $('#captcha').val().trim();
                if (captchaValue === "") {
                    $('#captchaError').show();
                } else {
                    $('#captchaError').hide();
                    alert('Form would be submitted in a real application');
                    // Here you would typically submit the form via AJAX
                }
            });

            // Timer function
            function startTimer(duration, displayId) {
                var timer = duration,
                    minutes, seconds;
                var interval = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    $('#' + displayId).text(minutes + ":" + seconds);

                    if (--timer < 0) {
                        clearInterval(interval);
                        $('#' + displayId).text("Expired");
                    }
                }, 1000);
            }

            // Allow only numbers in mobile field
            function allowNumbersOnly(e) {
                var code = (e.which) ? e.which : e.keyCode;
                if (code > 31 && (code < 48 || code > 57)) {
                    e.preventDefault();
                }
            }
            $('#mobile_no').keypress(allowNumbersOnly);
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\Deepak\Desktop\Bharat-5G-Labs\resources\views/pages/lab-registration/form.blade.php ENDPATH**/ ?>