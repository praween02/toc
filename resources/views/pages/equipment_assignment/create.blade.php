@extends('layouts.app')
@section('title', ' - Add Equipment Assignment')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css?v=1.0') }}" />   
@endpush

@section('content')
<style>
label{margin-bottom:5px }
.multiselect-container,.btn-group{width:100% !important}
ul.multiselect-container{padding-bottom:5px}
</style>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.equipment_assignment') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-supplier-user-form" action="{{ route('assignment.store') }}">
                                        @csrf

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        @php
                                            $equipments_val = (! empty(old('equipments')) ? old('equipments') : []);
                                            $inst_val = (! empty(old('institute')) ? old('institute') : []);
                                        @endphp

                                        <div class="form-group">
                                            <label for="institutes">{{ __('labels.institutes') }}</label>
                                            <p>
                                                <select name="institute" class="form-control" id="institute">
                                                    <option value="">-- Select --</option>
                                                    @foreach($institutes as $institute)
                                                        <option {{ in_array($institute->id, $inst_val) ? "selected" : "" }} value="{{ $institute->id }}">{{ $institute->institute }}</option>
                                                    @endforeach
                                                </select>
                                            </p>

                                            @if($errors->has('institute'))
                                                <p class="req">{{ $errors->first('institute') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="type">{{ __('labels.type') }} <span class="req">*</span></label>
                                            <p>
                                                <select name="type" id="type" class="form-control" onchange="sel_type(this.value)">
                                                    <option value="">-- Select Type --</option>
                                                    <option value="Delivery_Date">Delivery</option>
                                                    <option value="Installation_Date">Installation</option>
                                                    <option value="Commission_Date">Commission</option>
                                                    <option value="Dispatch_Invoice">Dispatch</option>
                                                </select>
                                            </p>

                                            @if($errors->has('equipments'))
                                                <p class="req">{{ $errors->first('equipments') }}</p>
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <label for="equipments">{{ __('labels.equipments') }} <span class="req">*</span></label>
                                            <p>
                                                <select name="equipments[]" class="form-control" id="equipments" multiple>
                                                    @foreach($equipments as $equipment)
                                                        <option {{ in_array($equipment->id, $equipments_val) ? "selected" : "" }} value="{{ $equipment->id }}">{{ $equipment->equipment }}</option>
                                                    @endforeach
                                                </select>
                                            </p>

                                            @if($errors->has('equipments'))
                                                <p class="req">{{ $errors->first('equipments') }}</p>
                                            @endif
                                        </div>


                                        <div class="mb-3">
                                            <label for="date" class="form-label">{{ __('labels.date') }} <span class="req">*</span></label>
                                            <input type="text" name="date" autocomplete="off" class="form-control datepicker" id="date" placeholder="{{ __('placeholder.date') }}" value="{{ date('Y-m-d') }}" />

                                            @if($errors->has('date'))
                                                <p class="req">{{ $errors->first('date') }}</p>
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


@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js?v=1.0') }}"></script>
<script src="{{ asset('assets/js/bootstrap-multiselect.min.js?v=1.0') }}"></script>
<script>
    $(document).ready(function() {
        $(`.datepicker`).datepicker({ autoclose: true, format: 'yyyy-mm-dd'});

        $('#equipments').multiselect({
          includeSelectAllOption: true,
        });
    });
</script>
@endpush
