@extends('layouts.app')

@section('title', ' - Add System Document')

@section('content')

@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<style>
    .ck-editor__editable {
        min-height: 150px;
    }
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="errors"></div>

                            <!-- Upload Document Form -->
                            <div class="row jumbotron box8">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @if(in_array('institute', get_roles()))
                                        <!-- <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">System Manual</button>
                                        <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Lab Implemention</button>
                                        <button class="nav-link" id="nav-project-solution-tab" data-bs-toggle="tab" data-bs-target="#nav-project-solution" type="button" role="tab" aria-controls="nav-project-solution" aria-selected="false">UAT Procedure</button> -->
                                        <button class="nav-link active" id="nav-infrastructure-tab" data-bs-toggle="tab" data-bs-target="#nav-infrastructure" type="button" role="tab" aria-controls="nav-infrastructure" aria-selected="false">UAT Sign</button>
                                        <button class="nav-link" id="nav-payment-tab" data-bs-toggle="tab" data-bs-target="#nav-payment-plan" type="button" role="tab" aria-controls="nav-payment-plan" aria-selected="false">Receipt of goods</button>
                                    @endif
                                    @if(in_array('vendor', get_roles()))
                                        <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">System Manual</button>
                                        <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Lab Implemention</button>
                                        <button class="nav-link" id="nav-project-solution-tab" data-bs-toggle="tab" data-bs-target="#nav-project-solution" type="button" role="tab" aria-controls="nav-project-solution" aria-selected="false">UAT Procedure</button>
                                        <button class="nav-link" id="nav-training-document-tab" data-bs-toggle="tab" data-bs-target="#nav-training-document" type="button" role="tab" aria-controls="nav-training-document" aria-selected="false">Training Document</button>
                                        <!-- <button class="nav-link" id="nav-infrastructure-tab" data-bs-toggle="tab" data-bs-target="#nav-infrastructure" type="button" role="tab" aria-controls="nav-infrastructure" aria-selected="false">UAT Sign / Receipt of goods</button> -->
                                    @endif
                                    @if(in_array('super_admin', haystack: get_roles()))
                                        <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">System Manual</button>
                                        <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Lab Implemention</button>
                                        <button class="nav-link" id="nav-project-solution-tab" data-bs-toggle="tab" data-bs-target="#nav-project-solution" type="button" role="tab" aria-controls="nav-project-solution" aria-selected="false">UAT Procedure</button>
                                        <button class="nav-link" id="nav-infrastructure-tab" data-bs-toggle="tab" data-bs-target="#nav-infrastructure" type="button" role="tab" aria-controls="nav-infrastructure" aria-selected="false">UAT Sign</button>
                                        <button class="nav-link" id="nav-payment-tab" data-bs-toggle="tab" data-bs-target="#nav-payment-plan" type="button" role="tab" aria-controls="nav-payment-plan" aria-selected="false">Receipt of goods</button>
                                    @endif
                                    </div>
                                </nav>

                                <div class="tab-content" id="nav-tabContent">
                                @if(!in_array('institute', get_roles()))
                                    <!-- Upload Document Tab -->
                                    <div class="mpm-10 tab-pane fade show active" id="nav-application" role="tabpanel" aria-labelledby="nav-application-tab">
                                        <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('system_manual.store') }}" enctype="multipart/form-data" id="form-application">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <input type="hidden" name="type" value="1">
                                                            <div class="mb-3">
                                                                <label for="equipment_id_1" class="form-label">{{ __('Products') }} <span class="req">*</span></label>
                                                                <select name="equipment_id" autocomplete="off" class="form-control" id="equipment_id_1" required>
                                                                    <option value="">-- Select --</option>
                                                                    @foreach($equipmentsList as $equipmentValue)
                                                                    <option value="{{ $equipmentValue->id }}" {{ old('equipment_id') == $equipmentValue->id ? 'selected' : '' }}>
                                                                        {{ $equipmentValue->equipment }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_title_1" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_1" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            <!-- <div class="mb-3">
                                                                <label for="date" class="form-label">Signature Date<span class="req">*</span></label>
                                                                <input type="date" name="date" class="form-control" id="date1" required>
                                                            </div> -->
                                                            
                                                            <div class="mb-3">
                                                                <label for="document_description_1" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_1" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="document_file_1" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_1" placeholder="{{ __('Document File') }}" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>

                                                            <div class="mb-3" style="display:none;">
                                                                <label for="no_of_page_1" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_1" placeholder="{{ __('No of Document') }}" required min="1" value="1">
                                                                <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-application">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Implement Of Documents Tab -->
                                    <div class="mpm-10 tab-pane fade" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
                                        <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('system_manual.store') }}" enctype="multipart/form-data" id="form-documents">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <input type="hidden" name="type" value="2">
                                                            <div class="mb-3">
                                                                <label for="document_title_2" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_2" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            <!-- <div class="mb-3">
                                                                <label for="date" class="form-label">Signature Date<span class="req">*</span></label>
                                                                <input type="date" name="date" class="form-control" id="date2" required>
                                                            </div> -->
                                                            
                                                            <div class="mb-3">
                                                                <label for="document_description_2" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_2" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_2" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_2" placeholder="{{ __('Document File') }}" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>

                                                            <div class="mb-3" style="display:none;">
                                                                <label for="no_of_page_2" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_2" placeholder="{{ __('No of Document') }}" required min="1" value="1">
                                                                <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-documents">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- UAT Tab -->
                                    <div class="mpm-10 tab-pane fade" id="nav-project-solution" role="tabpanel" aria-labelledby="nav-project-solution-tab">
                                        <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('system_manual.store') }}" enctype="multipart/form-data" id="form-uat">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <input type="hidden" name="type" value="3">
                                                            <div class="mb-3">
                                                                <label for="document_title_3" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_3" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            <!-- <div class="mb-3">
                                                                <label for="date" class="form-label">Signature Date<span class="req">*</span></label>
                                                                <input type="date" name="date" class="form-control" id="date3" required>
                                                            </div> -->

                                                            <div class="mb-3">
                                                                <label for="document_description_3" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_3" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_3" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_3" placeholder="{{ __('Document File') }}" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>

                                                            <div class="mb-3" style="display:none;">
                                                                <label for="no_of_page_3" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_3" placeholder="{{ __('No of Document') }}" required min="1" value="1">
                                                                <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-uat">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(in_array('institute', get_roles()))
                                    <div class="mpm-10 tab-pane fade show active" id="nav-infrastructure" role="tabpanel" aria-labelledby="nav-infrastructure-tab">    
                                    @endif
                                    @if(!in_array('institute', get_roles()))
                                    <div class="mpm-10 tab-pane fade show " id="nav-infrastructure" role="tabpanel" aria-labelledby="nav-infrastructure-tab">    
                                    @endif
                                        <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('system_manual.store') }}" enctype="multipart/form-data" id="form-uat">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <!-- <div class="mb-3">
                                                                <label for="equipment_id_4" class="form-label">{{ __('Type') }} <span class="req">*</span></label>
                                                                <select name="type" autocomplete="off" class="form-control" id="equipment_id_4" required>
                                                                    <option value="4">UAT Sign Document</option>
                                                                    <option value="5">Receipt of goods Document</option>
                                                                </select>
                                                            </div> -->
                                                            <input type="hidden" name="type" value="4">
                                                            <div class="mb-3">
                                                                <label for="document_title_4" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_4" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="date_4" class="form-label">{{ __('Sign Date') }} <span class="req">*</span></label>
                                                                <input type="date" name="date" autocomplete="off" class="form-control" id="date_4"  required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_description_4" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_4" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_4" class="form-label">{{ __('UAT Sign Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_4" placeholder="{{ __('Document File') }}" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>
                                                            <div class="mb-3" style="display:none;">
                                                                <label for="no_of_page_4" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_4" placeholder="{{ __('No of Document') }}" required min="1" value="1">
                                                                <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-uat">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mpm-10 tab-pane fade" id="nav-payment-plan" role="tabpanel" aria-labelledby="nav-payment-plan-tab">    
                                    <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('system_manual.store') }}" enctype="multipart/form-data" id="form-uat">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <!-- <div class="mb-3">
                                                                <label for="equipment_id_4" class="form-label">{{ __('Type') }} <span class="req">*</span></label>
                                                                <select name="type" autocomplete="off" class="form-control" id="equipment_id_4" required>
                                                                    <option value="4">UAT Sign Document</option>
                                                                    <option value="5">Receipt of goods Document</option>
                                                                </select>
                                                            </div> -->
                                                            <input type="hidden" name="type" value="5">
                                                            <div class="mb-3">
                                                                <label for="document_title_4" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_4" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="date_4" class="form-label">{{ __('Receipt of goods Date') }} <span class="req">*</span></label>
                                                                <input type="date" name="date" autocomplete="off" class="form-control" id="date_4"  required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_description_4" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_4" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_4" class="form-label">{{ __('Receipt of goods Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_4" placeholder="{{ __('Document File') }}" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>
                                                            <div class="mb-3" style="display:none;">
                                                                <label for="no_of_page_4" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_4" placeholder="{{ __('No of Document') }}" required min="1" value="1">
                                                                <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-uat">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="mpm-10 tab-pane fade show " id="nav-training-document" role="tabpanel" aria-labelledby="nav-training-document-tab"> 
                                    <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('system_manual.store') }}" enctype="multipart/form-data" id="form-uat">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <!-- <div class="mb-3">
                                                                <label for="equipment_id_4" class="form-label">{{ __('Type') }} <span class="req">*</span></label>
                                                                <select name="type" autocomplete="off" class="form-control" id="equipment_id_4" required>
                                                                    <option value="4">UAT Sign Document</option>
                                                                    <option value="5">Receipt of goods Document</option>
                                                                </select>
                                                            </div> -->
                                                            <input type="hidden" name="type" value="6">
                                                            <div class="mb-3">
                                                                <label for="document_title_4" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_4" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            

                                                            <div class="mb-3">
                                                                <label for="document_description_4" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_4" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_4" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_4" placeholder="{{ __('Document File') }}" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>
                                                            <div class="mb-3" style="display:none;">
                                                                <label for="no_of_page_4" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_4" placeholder="{{ __('No of Document') }}" required min="1" value="1">
                                                                <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-uat">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection
