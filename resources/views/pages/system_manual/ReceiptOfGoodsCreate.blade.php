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
@if(in_array('institute', get_roles()) || in_array('super_admin', get_roles()))
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
                                <div class="tab-content" id="nav-tabContent">
                                <!-- <button onclick="history.back()">Go Back</button> -->
                                    <!-- Upload Document Tab -->
                                   
                                        <div class="row">
                                            <div class="col-lg-12 co-sm-12 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('system_manual.store') }}" enctype="multipart/form-data" id="form-uat">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <p><span class="req">*</span> = required fields</p>
                                                            </div>

                                                            <input type="hidden" name="type" value="5">
                                                            <div class="mb-3">
                                                                <label for="document_title_3" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                <input name="document_title" autocomplete="off" class="form-control" id="document_title_3" placeholder="{{ __('Document Title') }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="date_3" class="form-label">{{ __('Receipt Of Goods Date') }} <span class="req">*</span></label>
                                                                <input type="date" name="date" autocomplete="off" class="form-control" id="date_3"  required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_description_3" class="form-label">{{ __('Document Description') }} </label>
                                                                <textarea name="document_description" autocomplete="off" class="form-control" id="document_description_3" placeholder="{{ __('Document Description') }}"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="document_file_3" class="form-label">{{ __('Document Of Receipt Of Goods') }} <span class="req">*</span></label>
                                                                <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file_3" placeholder="{{ __('Document File') }}" required>
                                                                <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                                            </div>
                                                            <div class="mb-3" style="display:none;">
                                                                <label for="no_of_page_3" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page_3" placeholder="{{ __('No of Document') }}" required min="1">
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
    @endif
</div>
@endsection
