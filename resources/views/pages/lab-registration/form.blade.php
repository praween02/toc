<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Registration</title>
    <style>
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

        .content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(45, 22, 22, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background: #0056b3;
        }

        .logo-brands {
            display: flex;
            justify-content: space-between;
            /* Push images to opposite sides */
            align-items: flex-start;
            /* Align them at the top */
            width: 100%;
        }

        .logo-left {
            max-width: 100%;
            height: auto;
        }

        .logo-right {
            max-width: 100%;
            height: auto;
        }

        .btn.btn-light-primary {
            color: #1b84ff;
            background-color: #e9f3ff;
        }

        .outerdiv {
            max-width: 900px;
            margin-top: 100px;
            margin-bottom: 100px;

        }

        @media (max-width: 768px) {
            .form-container .d-flex {
                flex-direction: column;
            }
        }

        @media (max-width: 768px) {
            .outerdiv {
                margin-top: 0px;
                margin-bottom: 0px;

            }
        }

        @media (min-width: 768px) {
            .mt-md-8 {
                margin-top: 2.5rem !important;
            }
        }

        .required {
            /* color: red; */
        }
    </style>
</head>

<body>
    <div
        class=" outerdiv d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end form-container ">
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-950px p-20">
            <div class="d-flex justify-content-between align-items-start logo-brands gap-3  px-5 pt-5">
                <img alt="Logo" class="logo-left" src="{{ asset('assets/images/dot-logo.jpg') }}">
                <img alt="Logo" class="logo-right" width="400" src="{{ asset('assets/images/five-g.png') }}">
            </div>
            <div class="flex-center flex-column flex-column-fluid  pb-lg-20 p-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form w-100" method="POST" novalidate="novalidate" id="kt_sign_in_form"
                    action="{{ route('lab.registration.store') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                    <div class="card-header">
                        <h1
                            class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            User Registration Details</h1>
                    </div>
                    <hr>
                    <div class="row">
                                <div class="col-12 col-md-4 mb-4">
                                    <label for="applicant_category" class="form-label">Applicant Category <span class="required">*</span></label>
                                    <select name="applicant_category" id="applicant_category" class="form-select" required>
                                        <option value="">Choose Applicant Category</option>
                                        <option value="Academia" {{ old('applicant_category') == 'Academia' ? 'selected' : '' }}>Academia</option>
                                        <option value="Industry" {{ old('applicant_category') == 'Industry' ? 'selected' : '' }}>Industry</option>
                                        <option value="R&D" {{ old('applicant_category') == 'R&D' ? 'selected' : '' }}>R & D</option>
                                    </select>
                                </div>

                                <div class="col-md-6" id="subcategory_container">
                                    <label for="subcategory" class="form-label">SubCategory <span class="required">*</span></label>
                                    <select name="subcategory" id="subcategory" class="form-select" required>
                                        <option value="">Choose SubCategory</option>
                                    </select>
                                </div>
                            </div>
                    <div class="card-header">
                        <h1
                            class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Basic Details</h1>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-4 mb-4">
                            <label for="person_name" class="form-label required">Person Name<span class="required">*</span></label>
                            <input type="text" class="form-control @error('person_name') is-invalid @enderror"
                                name="person_name" id="person_name" rows="3" placeholder="Enter Person Name"
                                value="{{ old('person_name') }}" required>
                        </div>
                        <div class="col-12 col-md-4 mb-4">
                            <label for="qualification" class="form-label required">Qualification<span class="required">*</span></label>
                            <select name="qualification"
                                class="form-select @error('qualification') is-invalid @enderror" id="qualification"
                                required>
                                <option value="">Choose Qualification<span class="required">*</span></option>
                                <option value="UG" {{ old('qualification') == 'UG' ? 'selected' : '' }}>UG</option>
                                <option value="PG" {{ old('qualification') == 'PG' ? 'selected' : '' }}>PG</option>
                                <option value="B.Tech" {{ old('qualification') == 'B.Tech' ? 'selected' : '' }}>B.Tech
                                </option>
                                <option value="M.Tech" {{ old('qualification') == 'M.Tech' ? 'selected' : '' }}>M.Tech
                                </option>
                                <option value="Ph.D" {{ old('qualification') == 'Ph.D' ? 'selected' : '' }}>Ph.D
                                </option>
                                <option value="Other" {{ old('qualification') == 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-4" id="designation-div">
                            <label for="designation" class="form-label required">Designation<span class="required">*</span></label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                name="designation" id="designation" rows="3" placeholder="Enter your Designation"
                                value="{{ old('designation') }}" required>
                        </div>
                        <div class="col-12 col-md-4 mb-4" id="institute-div">
                            <label for="institute_id" class="form-label required">Institute / Company<span class="required">*</span></label>
                            <select name="institute_id" id="institute_id"
                                class="form-select @error('institute_id') is-invalid @enderror" required>
                                <option value="">Select Institute</option>
                                @foreach ($institutes as $institute)
                                    <option value="{{ $institute->id }}"
                                        {{ old('institute_id') == $institute->id ? 'selected' : '' }}>
                                        {{ $institute->institute }}
                                    </option>
                                @endforeach
                                <option value="other" {{ old('institute_id') == 'other' ? 'selected' : '' }}>Other
                                    (Specify below)</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 mb-4" id="other_institute_div"
                            style="{{ old('institute_id') == 'other' ? '' : 'display:none;' }}">
                            <label for="institute_company" class="form-label required">Specify Institute /
                                Company<span class="required">*</span></label>
                            <input type="text"
                                class="form-control @error('institute_company') is-invalid @enderror"
                                name="institute_company" id="institute_company" rows="3"
                                placeholder="Enter Institute/Company name" value="{{ old('institute_company') }}">
                        </div>
                        <div class="col-12 col-md-4 mb-4" id="pan-card-div" style="display:none;">
                            <label for="pan_number" class="form-label required">Pan Number / Other Govt Id<span class="required">*</span></label>
                            <input type="text" class="form-control @error('pan_number') is-invalid @enderror"
                                maxlength="18" name="pan_number" id="pan_number" rows="3"
                                placeholder="Enter PAN Number / Other Govt Id" value="{{ old('pan_number') }}">
                        </div>
                        <div class="col-md-8 mb-4">
                            <label for="address" class="form-label required">Address<span class="required">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="1"
                                placeholder="Enter Address" required>{{ old('address') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-8 mb-4">
                        <label for="reason_to_join" class="form-label required">Reason to Join<span class="required">*</span></label>
                        <textarea class="form-control @error('reason_to_join') is-invalid @enderror" name="reason_to_join"
                            id="reason_to_join" rows="3" placeholder="Enter your reason for joining" required>{{ old('reason_to_join') }}</textarea>
                    </div>
                    <div class="card-header">
                        <h1
                            class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Authorization Details</h1>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-4 mb-4">
                            <label for="mobile_no" class="form-label required">Mobile No.<span class="required">*</span></label>
                            <input type="text" class="form-control @error('mobile_no') is-invalid @enderror"
                                name="mobile_no" id="mobile_no" rows="3" placeholder="Enter Mobile no."
                                value="{{ old('mobile_no') }}" maxlength="10" onkeypress="allowNumbersOnly(event)"
                                required>
                            <span id="verifyStatus"></span>
                        </div>
                        <div class="col-md-2 mb-2 sendMobOTPDiv">
                            <span class="btn btn-light-primary mt-0 mt-md-8" data-toggle="modal"
                                data-target="#myModal1" id="send_mobile_otp">Get OTP</span>
                        </div>
                        <div class="col-md-2 mb-2 verifyMobOTPDiv" style="display:none;">
                            <label class="form-label required">Mobile OTP</label>
                            <input type="text" class="form-control custom-form-control" id="mobile_otp"
                                placeholder="Enter OTP" name="mobile_otp" maxlength="6">
                        </div>
                        <div class="col-12 col-md-4 mb-4  resendMobBtnDiv" style="display:none;">
                            <span class="btn btn-light-success verifyMobOTPBtn mt-8" data-toggle="modal"
                                data-target="#myModal1">Verify</span>
                            <span class="btn btn-light-danger resendMobOTPBtn mt-8" data-toggle="modal"
                                data-target="#myModal1">Resend</span>
                            <div id="timer" style="display:none;"> Time left : <span id="time-left"></span>
                                seconds</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4 mb-4">
                            <label for="email_id" class="form-label">Email Id <span class="required">*</span></label>
                            <input type="email" name="email_id" id="email_id" class="form-control" value="{{ old('email_id') }}" placeholder="Enter Email Id" required>

                        </div>

                        <div class="col-md-2 mb-2 sendEmailOTPDiv">
                            <span class="btn btn-light-primary mt-0 mt-md-8" data-toggle="modal"
                                data-target="#myModal1" id="send_email_otp">Get OTP</span>
                        </div>

                        <div class="col-md-2 mb-2 verifyEmailOTPDiv" style="display:none;">
                            <label class="form-label required">Email OTP</label>
                            <input type="text" class="form-control custom-form-control" id="email_otp"
                                placeholder="Enter OTP" name="email_otp" maxlength="6">
                        </div>
                        <div class="col-12 col-md-4 mb-4  resendEmailBtnDiv" style="display:none;">
                            <span class="btn btn-light-success verifyEmailOTPBtn mt-8" data-toggle="modal"
                                data-target="#myModal1">Verify</span>
                            <span class="btn btn-light-danger resendEmailOTPBtn mt-8" data-toggle="modal"
                                data-target="#myModal1">Resend</span>
                            <div id="email-timer" style="display:none;"> Time left : <span
                                    id="email-time-left"></span> seconds</div>
                        </div>
                    </div>

                    <div class="fv-row mb-3 captcha">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <div class="form-label"></div>
                                    <span><img src="{{ captcha_src('math') }}"> </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-1">
                                <div class="form-group cpt_div2 m-md-n4">
                                    <div class="captchareload btn-refresh mt-8">
                                        <a href="javascript:void(0);" class="reload" id="reloadCaptcha">🔄</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                    <input type="text" name="captcha" id="captcha"
                                        class="form-control @error('captcha') is-invalid @enderror"
                                        placeholder="Enter captcha" required>
                                    <span id="captchaError" style="color: red; display: none;">Please enter the correct CAPTCHA</span>
                                </div>
                        </div>

                        <div class="col-md-3 mt-8">
                            <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                        </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#applicant_category').on('change', function () {
            var category = $(this).val();

            if (category === 'R&D') {
                $('#subcategory_container').hide(); // Hide subcategory dropdown
            } else {
                $('#subcategory_container').show(); // Show subcategory dropdown
                $.ajax({
                    url: "{{ url('/get-subcategories') }}",
                    type: "GET",
                    data: { category: category },
                    success: function (response) {
                        $('#subcategory').empty().append('<option value="">Choose SubCategory</option>');

                        $.each(response, function (index, subcategory) {
                            $('#subcategory').append('<option value="' + subcategory + '">' + subcategory + '</option>');
                        });
                    }
                });
            }
        });

        // Trigger change event on page load if category was pre-selected
        if ($('#applicant_category').val()) {
            $('#applicant_category').trigger('change');
        }
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show or hide the "Other Institute" field based on the dropdown selection
        document.getElementById('institute_id').addEventListener('change', function() {
            const otherInstituteDiv = document.getElementById('other_institute_div');
            const instituteCompanyField = document.getElementById('institute_company');

            if (this.value === 'other') {
                otherInstituteDiv.style.display = 'block';
                instituteCompanyField.setAttribute('required', 'required');
            } else {
                otherInstituteDiv.style.display = 'none';
                instituteCompanyField.removeAttribute('required');
            }
        });

        // On page load, check if "other" is selected (useful for form validation redirect)
        window.addEventListener('DOMContentLoaded', function() {
            const instituteId = document.getElementById('institute_id').value;
            if (instituteId === 'other') {
                document.getElementById('other_institute_div').style.display = 'block';
                document.getElementById('institute_company').setAttribute('required', 'required');
            }
        });

        // Captcha reload functionality
        document.getElementById('reloadCaptcha').addEventListener('click', function(e) {
            e.preventDefault();
            const captchaImage = document.querySelector('.captcha img');
            captchaImage.src = "{{ captcha_src('math') }}?" + new Date().getTime();
        });

        function allowNumbersOnly(e) {
            var code = (e.which) ? e.which : e.keyCode;
            if (code > 31 && (code < 48 || code > 57)) {
                e.preventDefault();
            }
        }
        document.getElementById("submitBtn").addEventListener("click", function(event) {
        let captchaValue = document.getElementById("captcha").value.trim();
        if (captchaValue === "") {
            event.preventDefault(); // Stop form submission
            document.getElementById("captchaError").style.display = "block";
        } else {
            document.getElementById("captchaError").style.display = "none";
        }
    });
    </script>
    <script>
        function enableSubmit() {
            document.getElementById("submitBtn").disabled = false;
        }
    </script>
</body>

</html>
