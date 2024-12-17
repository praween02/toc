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
                                    @if(in_array('vendor', get_roles()))
                                        <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">System Manual</button>
                                        <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Lab Implemention Document</button>
                                        <button class="nav-link" id="nav-project-solution-tab" data-bs-toggle="tab" data-bs-target="#nav-project-solution" type="button" role="tab" aria-controls="nav-project-solution" aria-selected="false">UAT Document</button>
                                    @endif
                                    </div>
                                </nav>

                                <div class="tab-content" id="nav-tabContent">
                                    
                                    <!-- Upload Document Tab -->
                                    @if(in_array('vendor', get_roles()))
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
                                                            
                                                            <div class="mb-3">
                                                                <label for="document_description_1" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_1" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="document_file_1" class="form-label">{{ __('Document File') }} <span class="req">* Only PDF</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_1" placeholder="{{ __('Document File') }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="no_of_page_1" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_1" placeholder="{{ __('No of Document') }}" required>
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
                                                            
                                                            <div class="mb-3">
                                                                <label for="document_description_2" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_2" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_2" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_2" placeholder="{{ __('Document File') }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="no_of_page_2" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_2" placeholder="{{ __('No of Document') }}" required>
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

                                                            <input type="hidden" name="type" value="3">
                                                            <div class="mb-3">
                                                                <label for="document_title_3" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_3" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_description_3" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_3" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_3" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_3" placeholder="{{ __('Document File') }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="no_of_page_3" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_3" placeholder="{{ __('No of Document') }}" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit-uat">
                                                                Submit
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(in_array('vendor', get_roles()))
                                    </div>
                                    @endif

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
