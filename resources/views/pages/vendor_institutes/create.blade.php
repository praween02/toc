@extends('layouts.app')
@section('title', ' - Assign Vendor Institutes')
@section('content')
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.assign_vendor_institutes') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-assign-inst-vendor-form" action="{{ route('vendor_institutes.store') }}">
                                        @csrf

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>
                                    

                                        <div class="mb-3">
                                            <label for="zone" class="form-label">{{ __('labels.zone') }} <span class="req">*</span></label>
                                            <select name="zone" class="form-control">
                                                <option value="">-- Select --</option>
                                                @foreach($zones as $key => $zone)
                                                    <option {{ old('zone') == $zone->id ? "selected" : "" }} value="{{ $zone->id }}">{{ ucfirst(strtolower($zone->zone)) }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('zone'))
                                                <p class="req">{{ $errors->first('zone') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="vendor" class="form-label">{{ __('labels.vendor') }} <span class="req">*</span></label>
                                            <select name="vendor" class="form-control">
                                                <option value="">-- Select --</option>
                                                @foreach($vendors as $key => $vendor)
                                                    <option {{ old('vendor') == $vendor->id ? "selected" : "" }} value="{{ $vendor->id }}">{{ ucfirst(strtolower($vendor->name)) }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('vendor'))
                                                <p class="req">{{ $errors->first('vendor') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="institute" class="form-label">{{ __('labels.institute') }} <span class="req">*</span></label>
                                            <select id="inst" name="institute_id[]" class="form-control select2" multiple>
                                                @foreach($institutes as $key => $institute)
                                                    <option {{ in_array($institute->id, $assigned_institutes) ? "disabled" : "" }} value="{{ $institute->id }}">{{ ucwords($institute->institute) }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('institute_id'))
                                                <p class="req">{{ $errors->first('institute_id') }}</p>
                                            @endif

                                        </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Submit</button>

                                        <button type="button" class="btn btn-primary waves-effect waves-light"><svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>Cancel</button>


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

@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/bootstrap-multiselect.min.js?v=1.0') }}"></script>
<script>
    $(document).ready(function() {
        $('#inst').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
@endpush
