@extends('layouts.app')
@section('title', ' - Equipments Delivery Information')
@section('content')
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.equipments_delivery_information') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" enctype="multipart/form-data" id="save-vendor-data-form" action="{{ route('lab_status.store') }}">
                                        @csrf

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>
                                        

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('Equipments') }} <span class="req">*</span></label>
                                            <select name="equipments[]" class="form-control" id="equipments" multiple="multiple">
                                                @foreach($equipments as $equipment)
                                                    <option value="{{ $equipment->id }}">{{ $equipment->equipment }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('equipments'))
                                                <p class="req">{{ $errors->first('equipments') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="supply" class="form-label">{{ __('Supply') }} <span class="req">*</span></label>
                                            <input type="file" name="supply" autocomplete="off" class="form-control" id="supply" accept="pdf/*" />
                                            <p><small><i>allowed extenstion:</i> <strong>pdf</strong></small></p>

                                            @if($errors->has('supply'))
                                                <p class="req">{{ $errors->first('supply') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="installation" class="form-label">{{ __('Installation') }} </label>
                                            <input type="file" name="installation" autocomplete="off" class="form-control" id="installation" accept="pdf/*"/>
                                            <p><small><i>allowed extenstion:</i> <strong>pdf</strong></small></p>

                                            @if($errors->has('installation'))
                                                <p class="req">{{ $errors->first('installation') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="uat_testing" class="form-label">{{ __('UAT/ Testing') }} </label>
                                            <input type="file" name="uat_testing" autocomplete="off" class="form-control" id="uat_testing" accept="pdf/*" placeholder="" />
                                            <p><small><i>allowed extenstion:</i> <strong>pdf</strong></small></p>

                                            @if($errors->has('uat_testing'))
                                                <p class="req">{{ $errors->first('uat_testing') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="training_course" class="form-label">{{ __('Training Course Complete') }} <span class="req">*</span></label>
                                            <select name="training_course" autocomplete="off" class="form-control" id="training_course">
                                                <option value="">select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>

                                            @if($errors->has('training_course'))
                                                <p class="req">{{ $errors->first('training_course') }}</p>
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