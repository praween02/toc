@extends('layouts.app')
@section('title', ' - Update Equipment Supplier')
@section('content')
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.update_equipment_supplier') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-supplier-user-form" action="{{ route('equipment_suppliers.update', $equipmentSupplier->id) }}">
                                        @csrf
                                        @METHOD('PUT')

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="institute" class="form-label">{{ __('labels.company_name') }} <span class="req">*</span></label>
                                            <input type="text" name="company_name" autocomplete="off" class="form-control" id="company_name" placeholder="{{ __('placeholder.company_name') }}" value="{{ $equipmentSupplier->company_name }}" />

                                            @if($errors->has('company_name'))
                                                <p class="req">{{ $errors->first('company_name') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="address" class="form-label">{{ __('labels.address') }} <span class="req">*</span></label>
                                            <textarea name="address" autocomplete="off" class="form-control" id="address" placeholder="{{ __('placeholder.address') }}">{{ $equipmentSupplier->address }}</textarea>

                                            @if($errors->has('address'))
                                                <p class="req">{{ $errors->first('address') }}</p>
                                            @endif

                                        </div>



                                        <div class="mb-3">
                                            <label for="phone_no" class="form-label">{{ __('labels.email') }} <span class="req">*</span></label>
                                            <input type="text" name="email" autocomplete="off" class="form-control" id="email" placeholder="{{ __('placeholder.email') }}" value="{{ $equipmentSupplier->email }}" />

                                            @if($errors->has('email'))
                                                <p class="req">{{ $errors->first('email') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">{{ __('labels.contact_person') }} <span class="req">*</span></label>
                                            <input type="text" name="contact_person" autocomplete="off" class="form-control" id="contact_person" placeholder="{{ __('placeholder.contact_person') }}" value="{{ $equipmentSupplier->contact_person }}" />
                                            @if($errors->has('contact_person'))
                                                <p class="req">{{ $errors->first('contact_person') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">{{ __('labels.contact_number') }} <span class="req">*</span></label>
                                            <input type="text" name="contact_number" autocomplete="off" class="form-control" id="contact_number" placeholder="{{ __('placeholder.contact_number') }}" value="{{ $equipmentSupplier->contact_number }}" />
                                            @if($errors->has('contact_number'))
                                                <p class="req">{{ $errors->first('contact_number') }}</p>
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