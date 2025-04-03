@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Lab Grading</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('lab.grading.update', $labGrading) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="institute_id">Institute</label>
                            <select name="institute_id" id="institute_id" class="form-control @error('institute_id') is-invalid @enderror">
                                <option value="">Select Institute</option>
                                @foreach($institutes as $institute)
                                    <option value="{{ $institute->id }}" {{ $labGrading->institute_id == $institute->id ? 'selected' : '' }}>
                                        {{ $institute->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('institute_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="innovation_project_check" name="innovation_project_check" value="1" {{ $labGrading->innovation_project_check ? 'checked' : '' }}>
                                <label class="custom-control-label" for="innovation_project_check">5G Innovation Project Check</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="beyond_contribution" name="beyond_contribution" value="1" {{ $labGrading->beyond_contribution ? 'checked' : '' }}>
                                <label class="custom-control-label" for="beyond_contribution">5G & Beyond Contribution</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="use_case_definition">Use Case Definition</label>
                            <textarea name="use_case_definition" id="use_case_definition" class="form-control @error('use_case_definition') is-invalid @enderror" rows="3">{{ $labGrading->use_case_definition }}</textarea>
                            @error('use_case_definition')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="poc_readiness_check" name="poc_readiness_check" value="1" {{ $labGrading->poc_readiness_check ? 'checked' : '' }}>
                                <label class="custom-control-label" for="poc_readiness_check">POC Readiness Check</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="commercial_product_validation" name="commercial_product_validation" value="1" {{ $labGrading->commercial_product_validation ? 'checked' : '' }}>
                                <label class="custom-control-label" for="commercial_product_validation">Commercial Product Validation</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ip_identification">Intellectual Property (IP) Identification</label>
                            <textarea name="ip_identification" id="ip_identification" class="form-control @error('ip_identification') is-invalid @enderror" rows="3">{{ $labGrading->ip_identification }}</textarea>
                            @error('ip_identification')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Lab Grading</button>
                            <a href="{{ route('lab.grading.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 