@extends('layouts.app')
@section('title', 'Review Proposal')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3>Review Proposal</h3>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('proposals.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Back to Proposals
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('proposals.review.store', $proposal) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Proposal Details</h5>
                                        
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                                   id="title" name="title" value="{{ old('title', $proposal->title) }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                      id="description" name="description" rows="5" required>{{ old('description', $proposal->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="expected_completion_date" class="form-label">Expected Completion Date</label>
                                            <input type="date" class="form-control @error('expected_completion_date') is-invalid @enderror" 
                                                   id="expected_completion_date" name="expected_completion_date" 
                                                   value="{{ old('expected_completion_date', $proposal->expected_completion_date->format('Y-m-d')) }}" required>
                                            @error('expected_completion_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="expected_output" class="form-label">Expected Output</label>
                                            <textarea class="form-control @error('expected_output') is-invalid @enderror" 
                                                      id="expected_output" name="expected_output" rows="3" required>{{ old('expected_output', $proposal->expected_output) }}</textarea>
                                            @error('expected_output')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="attachment" class="form-label">Attachment</label>
                                            @if($proposal->attachment)
                                                <div class="mb-2">
                                                    <a href="{{ Storage::url($proposal->attachment) }}" class="btn btn-sm btn-info" target="_blank">
                                                        <i class="fa fa-download"></i> Current Attachment
                                                    </a>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" 
                                                   id="attachment" name="attachment">
                                            <small class="text-muted">Leave empty to keep the current attachment</small>
                                            @error('attachment')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Review Details</h5>
                                        
                                        <div class="mb-3">
                                            <label for="grading" class="form-label">Grading</label>
                                            <select class="form-control @error('grading') is-invalid @enderror" 
                                                    id="grading" name="grading" required>
                                                <option value="">Select Grade</option>
                                                <option value="A" {{ old('grading', $proposal->review->grading ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                                <option value="B" {{ old('grading', $proposal->review->grading ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                                <option value="C" {{ old('grading', $proposal->review->grading ?? '') == 'C' ? 'selected' : '' }}>C</option>
                                                <option value="D" {{ old('grading', $proposal->review->grading ?? '') == 'D' ? 'selected' : '' }}>D</option>
                                                <option value="F" {{ old('grading', $proposal->review->grading ?? '') == 'F' ? 'selected' : '' }}>F</option>
                                            </select>
                                            @error('grading')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="feedback" class="form-label">Feedback</label>
                                            <textarea class="form-control @error('feedback') is-invalid @enderror" 
                                                      id="feedback" name="feedback" rows="3" required>{{ old('feedback', $proposal->review->feedback ?? '') }}</textarea>
                                            @error('feedback')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="has_use_case" 
                                                       name="has_use_case" value="1" 
                                                       {{ old('has_use_case', $proposal->review->has_use_case ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="has_use_case">Has Use Case</label>
                                            </div>
                                        </div>

                                        <div class="mb-3 use-case-field" style="display: none;">
                                            <label for="use_case" class="form-label">Use Case Details</label>
                                            <textarea class="form-control @error('use_case') is-invalid @enderror" 
                                                      id="use_case" name="use_case" rows="3">{{ old('use_case', $proposal->review->use_case ?? '') }}</textarea>
                                            @error('use_case')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="has_ip" 
                                                       name="has_ip" value="1" 
                                                       {{ old('has_ip', $proposal->review->has_ip ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="has_ip">Has IP</label>
                                            </div>
                                        </div>

                                        <div class="mb-3 ip-field" style="display: none;">
                                            <label for="ip_identification" class="form-label">IP Identification</label>
                                            <textarea class="form-control @error('ip_identification') is-invalid @enderror" 
                                                      id="ip_identification" name="ip_identification" rows="3">{{ old('ip_identification', $proposal->review->ip_identification ?? '') }}</textarea>
                                            @error('ip_identification')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control @error('status') is-invalid @enderror" 
                                                    id="status" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="approved" {{ old('status', $proposal->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ old('status', $proposal->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                <option value="revision_required" {{ old('status', $proposal->status) == 'revision_required' ? 'selected' : '' }}>Revision Required</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Save Review
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Show/hide use case field
        function toggleUseCaseField() {
            if ($('#has_use_case').is(':checked')) {
                $('.use-case-field').show();
            } else {
                $('.use-case-field').hide();
            }
        }

        // Show/hide IP field
        function toggleIPField() {
            if ($('#has_ip').is(':checked')) {
                $('.ip-field').show();
            } else {
                $('.ip-field').hide();
            }
        }

        $('#has_use_case').change(toggleUseCaseField);
        $('#has_ip').change(toggleIPField);

        // Initial state
        toggleUseCaseField();
        toggleIPField();
    });
</script>
@endpush
@endsection 