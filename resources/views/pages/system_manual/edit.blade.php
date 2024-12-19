@extends('layouts.app')

@section('title', ' - Edit System Document')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('system_manual.store', $systemManual->id) }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="type" value="{{ $systemManual->type }}">

                                <div class="mb-3" id="equipment_select" style="{{ $systemManual->type == 1 ? '' : 'display: none;' }}">
                                    <label for="equipment_id" class="form-label">Products <span class="req">*</span></label>
                                    <select name="equipment_id" class="form-control" id="equipment_id">
                                        <option value="">-- Select --</option>
                                        @foreach($equipmentsList as $equipment)
                                            <option value="{{ $equipment->id }}" {{ $systemManual->equipment_id == $equipment->id ? 'selected' : '' }}>
                                                {{ $equipment->equipment }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="document_title" class="form-label">Document Title <span class="req">*</span></label>
                                    <input type="text" name="document_title" class="form-control" id="document_title"
                                        value="{{ old('document_title', $systemManual->document_title) }}" required>
                                </div>

                                <!-- <div class="mb-3">
                                    <label for="date" class="form-label">Date<span class="req">*</span></label> -->
                                    <input type="hidden" name="date" class="form-control" id="date"
                                        value="{{ old('date', $systemManual->date) }}" required>
                                <!-- </div> -->

                                <div class="mb-3">
                                    <label for="document_description" class="form-label">Document Description</label>
                                    <textarea name="document_description" class="form-control" id="document_description">{{ old('document_description', $systemManual->document_description) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="document_file" class="form-label">Document File <span class="req">only PDF</span></label>
                                    <input type="file" name="document_file" class="form-control" id="document_file">
                                    @if($systemManual->document_file)
                                        <p>Current file: <a href="{{ asset('storage/' . $systemManual->document_file) }}" target="_blank">View</a></p>
                                    @endif
                                    <div class="text-danger mt-2">Only PDF files are allowed for upload.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="no_of_page" class="form-label">No of Pages <span class="req">*</span></label>
                                    <input type="number" name="no_of_page" class="form-control" id="no_of_page"
                                        value="{{ old('no_of_page', $systemManual->no_of_page) }}" required min="1">
                                        <div class="text-danger mt-2" id="no_of_page_error" style="display:none;">The number of pages must be greater than 0.</div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
