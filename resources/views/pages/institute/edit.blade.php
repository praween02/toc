@extends('layouts.app')
@section('title', ' - Institute')
@section('content')		
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.update_institute') }}</h4>
                            </div>
                        </div>
                    </div>     
                    <!-- end page title --> 

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-institute-data-form" action="{{ route('institutes.update', $institute->id) }}">
                                        @csrf
                                        @method('PUT')

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>
    
                                        <div class="mb-3">
                                            <label for="institute" class="form-label">{{ __('institute') }} <span class="req">*</span></label>
                                            <input value="{{ $institute->institute }}" type="text" name="institute" autocomplete="off" class="form-control" id="institute" placeholder="{{ __('placeholder.institute') }}" value="{{ old('institute') }}" />

                                            @if($errors->has('institute'))
                                                <p class="req">{{ $errors->first('institute') }}</p>
                                            @endif

                                        </div>

                                         <div class="mb-3">
                                            <label for="address" class="form-label">{{ __('labels.address') }} <span class="req">*</span></label>
                                            <textarea name="address" autocomplete="off" class="form-control" id="address" placeholder="{{ __('placeholder.address') }}">{{ $institute->address }}</textarea>

                                            @if($errors->has('address'))
                                                <p class="req">{{ $errors->first('address') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('labels.email') }} <span class="req">*</span></label>
                                            <input type="text" name="email" autocomplete="off" class="form-control" id="email" placeholder="{{ __('placeholder.email') }}" value="{{ $institute->email }}" />

                                            @if($errors->has('email'))
                                                <p class="req">{{ $errors->first('email') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_person" class="form-label">{{ __('labels.contact_person') }} <span class="req">*</span></label>
                                            <input type="text" name="contact_person" autocomplete="off" class="form-control" id="contact_person" placeholder="{{ __('placeholder.contact_person') }}" value="{{ $institute->contact_person }}" />

                                            @if($errors->has('contact_person'))
                                                <p class="req">{{ $errors->first('contact_person') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="contact_number" class="form-label">{{ __('labels.contact_number') }} <span class="req">*</span></label>
                                            <input type="text" name="contact_number" autocomplete="off" class="form-control" id="contact_number" placeholder="{{ __('placeholder.contact_number') }}" value="{{ $institute->contact_number }}" />

                                            @if($errors->has('contact_number'))
                                                <p class="req">{{ $errors->first('contact_number') }}</p>
                                            @endif

                                        </div>


                                        <div class="mb-3">
                                            <label for="status" class="form-label">{{ __('Status') }} <span class="req">*</span></label>
                                            <select name="status" id="" class="form-control">
                                                <option value="1" {{ $institute->status  === 1 ? "selected" : "" }}>{{ __('Active') }}</option>
                                                <option value="0" {{ $institute->status  === 0 ? "selected" : "" }}>{{ __('Inactive') }}</option>
                                            </select>
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