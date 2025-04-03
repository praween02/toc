@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lab Grading Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Institute Information</h5>
                            <p><strong>Institute:</strong> {{ $labGrading?$labGrading->institute->institute:'' }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Grading Parameters</h5>
                            <div class="mb-3">
                                <strong>5G Innovation Project Check:</strong>
                                @if($labGrading->innovation_project_check)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>5G & Beyond Contribution:</strong>
                                @if($labGrading->beyond_contribution)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>POC Readiness Check:</strong>
                                @if($labGrading->poc_readiness_check)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>Commercial Product Validation:</strong>
                                @if($labGrading->commercial_product_validation)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-danger">No</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Use Case Definition</h5>
                            <div class="card">
                                <div class="card-body">
                                    {!! nl2br(e($labGrading->use_case_definition)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Intellectual Property (IP) Identification</h5>
                            <div class="card">
                                <div class="card-body">
                                    {!! nl2br(e($labGrading->ip_identification)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('lab.grading.edit', $labGrading) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('lab.grading.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 