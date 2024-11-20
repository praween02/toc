@extends('layouts.app')
@section('title', ' - Update Equipment Specifications')
@section('content')
<style>
    .ck-editor__editable {
    min-height:150px;
}
.pd5{padding:5px;font-size:11px !important;letter-spacing:0.5px}
.fle{border:1px dashed #ced4da;padding:5px;border-radius:5px}
</style>
		<div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ __('app.update_equipment_specifications') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Form row -->
                    <div class="row">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-body">

                                    <form enctype="multipart/form-data" method="POST" id="vendor-update-specification" action="{{ route('vendor-update-specification', $encrypted_equipment_id) }}">
                                        @csrf

                           				<div class="mb-3">
                                            <p><span class="req">*</span> = required fields</p>
                                        </div>

                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('Equipment') }} </label>
                                            <p><span class='badge btn-success pd5'>{{ $record->equipment }}</span></p>

                                            @if($errors->has('equipment'))
                                                <p class="req">{{ $errors->first('equipment') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="specification" class="form-label">{{ __('Specification') }} <span class="req">*</span></label>
                                            <textarea style="height:200px" name="specification" autocomplete="off" class="form-control" id="specification" placeholder="{{ __('placeholder.specification') }}">{{ $record->specification }}</textarea>

                                            @if($errors->has('specification'))
                                                <p class="req">{{ $errors->first('specification') }}</p>
                                            @endif

                                        </div>

                                        <div class="mb-3">
                                            <label for="file" class="form-label">{{ __('Upload Image') }} </label>
                                            <p><input type="file" name="upload_image" accept="image/*" autocomplete="off" class="fle" /></p>

                                            @if($record->image)
                                                <img style="border:1px dashed #ddd;padding:10px" src="{{ url('storage/uploads/' . $record->image) }}" alt="" width="160" /> 
                                            @endif

                                            @if($errors->has('file'))
                                                <p class="req">{{ $errors->first('file') }}</p>
                                            @endif

                                        </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send feather-sm fill-white me-2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Update</button>

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
     ClassicEditor
        .create(document.querySelector('#specification'))
        .catch( error => {
            console.error(error);
        });

    function check_all(ths, cls) {
        $(`.${cls}`).prop('checked', ths.checked);
    }
</script>
@endpush
