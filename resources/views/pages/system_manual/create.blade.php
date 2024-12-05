@extends('layouts.app')

@section('title', ' - Add System Document')


@section('content')
<style>
    .ck-editor__editable {
        min-height: 150px;
    }
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container">

            <!-- start page title -->

            <!-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{ __('app.Document') }}</h4>
                    </div>
                </div>
            </div> -->
            <!-- end page title -->
            <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="errors"></div>
                                    <!-- <form id="poc_bsnl" action="{{ route('poc_bsnl.store') }}" method="POST" enctype="multipart/form-data">
                                       @csrf      -->
                                       <div class="row jumbotron box8">

                                          <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                              <button class="nav-link active" id="nav-application-tab" data-bs-toggle="tab" data-bs-target="#nav-application" type="button" role="tab" aria-controls="nav-application" aria-selected="true">Upload Document</button>

                                              <button class="nav-link" id="nav-documents-tab" data-bs-toggle="tab" data-bs-target="#nav-documents" type="button" role="tab" aria-controls="nav-documents" aria-selected="true">Implement Of Documents</button>

                                              <button class="nav-link" id="nav-project-solution-tab" data-bs-toggle="tab" data-bs-target="#nav-project-solution" type="button" role="tab" aria-controls="nav-project-solution" aria-selected="false">UAT</button>

                                            </div>
                                          </nav>


                                          <div class="tab-content" id="nav-tabContent">

                                             <div class="mpm-10 tab-pane fade show active" id="nav-application" role="tabpanel" aria-labelledby="nav-application-tab">

                                                <div class="row">
                                                    <div class="col-lg-12 co-sm-12 col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">

                                                                <form method="POST" id="save-ticket-data-form" action="{{ route('system_manual.store') }}" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="mb-3">
                                                                        <p><span class="req">*</span> = required fields</p>
                                                                    </div>

                                                                    @php
                                                                    $onchange = '';
                                                                    if(in_array('vendor', get_roles()))
                                                                    $onchange = "onchange=sel_subject(this.value)";
                                                                    @endphp
                                                                    <input type="hidden" name="type" value="1">
                                                                    <div class="mb-3">
                                                                        <label for="equipment_id" class="form-label">{{ __('Products') }} <span class="req">*</span></label>
                                                                        <select name="equipment_id" autocomplete="off" class="form-control" id="equipment_id" placeholder="{{ __('placeholder.subject') }}" {{ $onchange }} required>
                                                                            <option value="">-- Select --</option>
                                                                            @foreach($equipmentsList as $equipmentValue)
                                                                            <option value="{{ $equipmentValue->id }}" {{ old('equipment_id') == $equipmentValue->id ? 'selected' : '' }}>
                                                                                {{ $equipmentValue->equipment }}
                                                                            </option>
                                                                            @endforeach

                                                                        </select>



                                                                    </div>




                                                                    <div class="mb-3">
                                                                        <label for="document_title" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                        <input name="document_title" autocomplete="off" class="form-control" id="document_title" placeholder="{{ __('Document Title') }}" required>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="document_description" class="form-label">{{ __('Document Description') }} </label>
                                                                        <textarea name="document_description" autocomplete="off" class="form-control" id="document_description" placeholder="{{ __('Document Description') }}"></textarea>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="document_file" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                        <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file" placeholder="{{ __('Document File') }}" required>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="no_of_page" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                        <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page" placeholder="{{ __('No of Document') }}" required>



                                                                    </div>


                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2">
                                                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                                        </svg>Submit</button>

                                                                </form>


                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card-->
                                                    </div> <!-- end col -->
                                                </div>

                                             </div>

                                             <div class="mpm-10 tab-pane fade" id="nav-documents" role="tabpanel" aria-labelledby="nav-documents-tab">
                                                <div class="row">
                                                    <div class="col-lg-12 co-sm-12 col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">

                                                                <form method="POST" id="save-ticket-data-form" action="{{ route('system_manual.store') }}" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="mb-3">
                                                                        <p><span class="req">*</span> = required fields</p>
                                                                    </div>

                                                                    @php
                                                                    $onchange = '';
                                                                    if(in_array('vendor', get_roles()))
                                                                    $onchange = "onchange=sel_subject(this.value)";
                                                                    @endphp
                                                                    <input type="hidden" name="type" value="2">
                                                                    <div class="mb-3">
                                                                        <label for="document_title" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                        <input name="document_title" autocomplete="off" class="form-control" id="document_title" placeholder="{{ __('Document Title') }}" required>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="document_description" class="form-label">{{ __('Document Description') }} </label>
                                                                        <textarea name="document_description" autocomplete="off" class="form-control" id="document_description" placeholder="{{ __('Document Description') }}"></textarea>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="document_file" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                        <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file" placeholder="{{ __('Document File') }}" required>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="no_of_page" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                        <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page" placeholder="{{ __('No of Document') }}" required>



                                                                    </div>


                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2">
                                                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                                        </svg>Submit</button>

                                                                </form>


                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card-->
                                                    </div> <!-- end col -->
                                                </div>
                                                
                                             </div>

                                             
                                             <div class="mpm-10 tab-pane fade" id="nav-project-solution" role="tabpanel" aria-labelledby="nav-project-solution-tab">    

                                                <div class="row">
                                                    <div class="col-lg-12 co-sm-12 col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">

                                                                <form method="POST" id="save-ticket-data-form" action="{{ route('system_manual.store') }}" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="mb-3">
                                                                        <p><span class="req">*</span> = required fields</p>
                                                                    </div>

                                                                    @php
                                                                    $onchange = '';
                                                                    if(in_array('vendor', get_roles()))
                                                                    $onchange = "onchange=sel_subject(this.value)";
                                                                    @endphp
                                                                    <input type="hidden" name="type" value="3">
                                                                    <div class="mb-3">
                                                                        <label for="document_title" class="form-label">{{ __('Document Title') }} <span class="req">*</span></label>
                                                                        <input name="document_title" autocomplete="off" class="form-control" id="document_title" placeholder="{{ __('Document Title') }}" required>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="document_description" class="form-label">{{ __('Document Description') }} </label>
                                                                        <textarea name="document_description" autocomplete="off" class="form-control" id="document_description" placeholder="{{ __('Document Description') }}"></textarea>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="document_file" class="form-label">{{ __('Document File') }} <span class="req">*</span></label>
                                                                        <input type="file" accept=".pdf" name="document_file" autocomplete="off" class="form-control" id="document_file" placeholder="{{ __('Document File') }}" required>



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="no_of_page" class="form-label">{{ __('No of page') }} <span class="req">*</span></label>
                                                                        <input type="number" name="no_of_page" autocomplete="off" class="form-control" id="no_of_page" placeholder="{{ __('No of Document') }}" required>



                                                                    </div>


                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2">
                                                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                                        </svg>Submit</button>

                                                                </form>


                                                            </div> <!-- end card-body -->
                                                        </div> <!-- end card-->
                                                    </div> <!-- end col -->
                                                </div>

                                             </div>

                                             
                                       </div>  
                                    <!-- </form> -->
                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
            <!-- Form row -->
            

            <!-- end row -->

        </div> <!-- container -->
    </div> <!-- content -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ckeditor.js?v=40.2.0') }}"></script>
<script>
    function check_all(ths, cls) {
        $(`.${cls}`).prop('checked', ths.checked);
    }

    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

    function sel_subject(val) {

        // if (val == "equipment_related") {
        //     $("#equipment_box").removeClass('d-none');
        // } else {
        //     $("#equipment_box").addClass('d-none');
        // }
    }
</script>
@endpush