@extends('layouts.app')
@section('title', ' - Add Telecom Project')
@section('content')
<style type="text/css">
.fnt12{font-size:12px;letter-spacing:1.0px;font-weight:normal;}    
</style>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('Project Management') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="update-telecom-project-form" action="{{ route('telecom.update', $telecom->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="department" class="form-label">{{ __('Department') }} </label>
                                            <p><badge class="badge btn-success fnt12">{{ get_user_telecom_department() }}</badge></p>

                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('Project Description') }} <span class="req">*</span></label>
                                            <textarea name="project_description" class="form-control" placeholder="Project Description">{{ $telecom->project }}</textarea>

                                            @if($errors->has('project_description'))
                                                <p class="req">{{ $errors->first('project_description') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="implementing_agency" class="form-label">{{ __('Implementing Agency') }} <span class="req">*</span></label>
                                            <input type="text" name="implementing_agency" autocomplete="off" class="form-control" id="implementing_agency" placeholder="{{ __('Implementing Agency') }}" value="{{ $telecom->implement_agency }}" />

                                            @if($errors->has('implementing_agency'))
                                                <p class="req">{{ $errors->first('implementing_agency') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="core_technology" class="form-label">{{ __('Core Technology') }} </label>
                                            <input type="text" name="core_technology" autocomplete="off" class="form-control" id="core_technology" placeholder="{{ __('Core Technology') }}" value="{{ $telecom->core_technology }}" />

                                            @if($errors->has('core_technology'))
                                                <p class="req">{{ $errors->first('core_technology') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="cost" class="form-label">{{ __('Cost') }} </label>

                                            <input type="number" name="cost" autocomplete="off" class="form-control" id="cost" placeholder="{{ __('Cost') }}" value="{{ $telecom->cost }}" />

                                            @if($errors->has('cost'))
                                                <p class="req">{{ $errors->first('cost') }}</p>
                                            @endif

                                        </div>


                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

                                    </form>


                                </div> <!-- end card-body -->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->
        </div>
@endsection