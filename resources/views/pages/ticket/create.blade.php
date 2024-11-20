@extends('layouts.app')
@section('title', ' - Add Equipment')
@section('content')
<style>
    .ck-editor__editable {
    min-height:150px;
}
</style>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.ticket') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" id="save-ticket-data-form" action="{{ route('tickets.store') }}">
                                        @csrf

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        @php
                                            $onchange = '';
                                            if(in_array('vendor', get_roles()))
                                            $onchange = "onchange=sel_subject(this.value)";
                                        @endphp

                                        <div class="mb-3">
                                            <label for="subject" class="form-label">{{ __('Subject') }} <span class="req">*</span></label>
                                            <select name="subject" autocomplete="off" class="form-control" id="subject" placeholder="{{ __('placeholder.subject') }}" {{ $onchange }}>
                                                 <option value="">-- Select --</option>
                                                 <option value="equipment_related" {{ old('subject') == "equipment_related" ? "selected" : "" }}>Equipment related</option>
                                                 <option value="others" {{ old('subject') == "others" ? "selected" : "" }}>Others</option>
                                            </select>

                                            @if($errors->has('subject'))
                                                <p class="req">{{ $errors->first('subject') }}</p>
                                            @endif

                                        </div>

                                        @if(in_array('vendor', get_roles()))
                                        <div class="mb-3" id="equipment_box">
                                            <label for="institute" class="form-label">{{ __('Institute') }} <span class="req">*</span></label>
                                            <select name="institute" autocomplete="off" class="form-control" id="institute" placeholder="{{ __('placeholder.institute') }}">
                                                @foreach($institutes as $institute)
                                                <option {{ (old('institute') == $institute->id ? 'selected' : '') }} value="{{ $institute->id }}">{{ $institute->institute }}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('institute'))
                                                <p class="req">{{ $errors->first('institute') }}</p>
                                            @endif

                                        </div>
                                        @endif


                                        <div class="mb-3">
                                            <label for="description" class="form-label">{{ __('Description') }} <span class="req">*</span></label>
                                            <textarea style="height:200px" name="description" autocomplete="off" class="form-control" id="description" placeholder="{{ __('placeholder.description') }}"></textarea>

                                            @if($errors->has('description'))
                                                <p class="req">{{ $errors->first('description') }}</p>
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
<script src="{{ asset('assets/js/ckeditor.js?v=40.2.0') }}"></script>
<script>
    function check_all(ths, cls) {
        $(`.${cls}`).prop('checked', ths.checked);
    }

    ClassicEditor
        .create(document.querySelector('#description'))
        .catch( error => {
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
