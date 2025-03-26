<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-container img {
            max-height: 80px;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Header with logos -->
                <div class="logo-container">
                    <img src="{{ asset('images/dot-logo.png') }}" alt="DoT Logo">
                    <img src="{{ asset('images/5g-hackathon-logo.png') }}" alt="5G Hackathon Logo">
                </div>
                
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Lab Registration</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('lab.registration.store') }}" method="POST">
                            @csrf
                            
                            <h5 class="border-bottom pb-2">Applicant Details</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="applicant_category" class="form-label">Applicant Category <span class="required">*</span></label>
                                    <select name="applicant_category" id="applicant_category" class="form-select @error('applicant_category') is-invalid @enderror" required>
                                        <option value="">Choose Applicant Category</option>
                                        <option value="Student" {{ old('applicant_category') == 'Student' ? 'selected' : '' }}>Student</option>
                                        <option value="Faculty" {{ old('applicant_category') == 'Faculty' ? 'selected' : '' }}>Faculty</option>
                                        <option value="Industry" {{ old('applicant_category') == 'Industry' ? 'selected' : '' }}>Industry</option>
                                        <option value="Startup" {{ old('applicant_category') == 'Startup' ? 'selected' : '' }}>Startup</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="subcategory" class="form-label">SubCategory <span class="required">*</span></label>
                                    <select name="subcategory" id="subcategory" class="form-select @error('subcategory') is-invalid @enderror" required>
                                        <option value="">Choose SubCategory</option>
                                        <option value="UG" {{ old('subcategory') == 'UG' ? 'selected' : '' }}>UG</option>
                                        <option value="PG" {{ old('subcategory') == 'PG' ? 'selected' : '' }}>PG</option>
                                        <option value="Ph.D" {{ old('subcategory') == 'Ph.D' ? 'selected' : '' }}>Ph.D</option>
                                        <option value="Professor" {{ old('subcategory') == 'Professor' ? 'selected' : '' }}>Professor</option>
                                    </select>
                                </div>
                            </div>

                            <h5 class="border-bottom pb-2 mt-4">Basic Details</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="person_name" class="form-label">Person Name <span class="required">*</span></label>
                                    <input type="text" name="person_name" id="person_name" class="form-control" value="{{ old('person_name') }}" placeholder="Enter Person Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="qualification" class="form-label">Qualification <span class="required">*</span></label>
                                    <select name="qualification" id="qualification" class="form-select" required>
                                        <option value="">Choose Qualification</option>
                                        <option value="B.Tech" {{ old('qualification') == 'B.Tech' ? 'selected' : '' }}>B.Tech</option>
                                        <option value="M.Tech" {{ old('qualification') == 'M.Tech' ? 'selected' : '' }}>M.Tech</option>
                                        <option value="Ph.D" {{ old('qualification') == 'Ph.D' ? 'selected' : '' }}>Ph.D</option>
                                        <option value="Other" {{ old('qualification') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="designation" class="form-label">Designation <span class="required">*</span></label>
                                    <input type="text" name="designation" id="designation" class="form-control" value="{{ old('designation') }}" placeholder="Enter your Designation" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="institute_id" class="form-label">Institute <span class="required">*</span></label>
                                    <select name="institute_id" id="institute_id" class="form-select @error('institute_id') is-invalid @enderror" required>
                                        <option value="">Select Institute</option>
                                        @foreach($institutes as $institute)
                                            <option value="{{ $institute->id }}" {{ old('institute_id') == $institute->id ? 'selected' : '' }}>
                                                {{ $institute->institute }}
                                            </option>
                                        @endforeach
                                        <option value="other">Other (Specify below)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3" id="other_institute_div" style="display: none;">
                                <label for="institute_company" class="form-label">Specify Institute / Company <span class="required">*</span></label>
                                <input type="text" name="institute_company" id="institute_company" class="form-control" value="{{ old('institute_company') }}" placeholder="Enter Institute/Company name">
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address <span class="required">*</span></label>
                                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter Address" required>{{ old('address') }}</textarea>
                            </div>

                            <h5 class="border-bottom pb-2 mt-4">Contact Details</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="mobile_no" class="form-label">Mobile No. <span class="required">*</span></label>
                                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="{{ old('mobile_no') }}" placeholder="Enter Mobile no." required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email_id" class="form-label">Email Id <span class="required">*</span></label>
                                    <input type="email" name="email_id" id="email_id" class="form-control" value="{{ old('email_id') }}" placeholder="Enter Email Id" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="reason" class="form-label">Reason for Registration</label>
                                <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Please explain why you want to register">{{ old('reason') }}</textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <p>Department of Telecommunications | Government of India © 2023</p>
                </div>
            </div>
        </div>
    </div>

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
    </script>
</body>
</html>