@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Review for {{ $proposal->title }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('proposal-reviews.store') }}">
                        @csrf
                        <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">
                        <div class="mb-3">
                            <h5>Proposal Information</h5>
                            <p><strong>Title:</strong> {{ $proposal->title ?? '' }}</p>
                            <p><strong>Submitted By:</strong> {{ $proposal->user->name ?? '' }}</p>
                            <p><strong>Institute:</strong> {{ $proposal->institute->institute ?? '' }}</p>
                            <p><strong>Submission Date:</strong> {{ $proposal->created_at ?? '' }}</p>
                        </div>

                        <div class="mb-3">
                            <h5>Proposal Details</h5>
                            <p><strong>Description:</strong></p>
                            <div class="border p-3 mb-3 bg-light">
                                {{ $proposal->description ?? '' }}
                            </div>
                            
                            <p><strong>Expected Completion:</strong> {{ $proposal->expected_completion_date ?? '' }}</p>
                            <p><strong>Expected Output:</strong></p>
                            <div class="border p-3 mb-3 bg-light">
                                {{ $proposal->expected_output ?? '' }}
                            </div>
                            
                            @if($proposal->attachment)
                                <p>
                                    <strong>Attachment:</strong> 
                                    <a href="{{ Storage::url($proposal->attachment) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-download"></i> Download Attachment
                                    </a>
                                </p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Review Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending (More Information Required)</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comments" class="form-label">Review Comments</label>
                            <textarea class="form-control @error('comments') is-invalid @enderror" 
                                id="comments" name="comments" rows="5" required>{{ old('comments') }}</textarea>
                            <small class="form-text text-muted">
                                Please provide detailed feedback about the proposal. If rejected or pending, explain what improvements are needed.
                            </small>
                            @error('comments')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Overall Rating (1-5)</label>
                            <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                                <option value="">Select Rating</option>
                                <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 - Poor</option>
                                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 - Below Average</option>
                                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 - Average</option>
                                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 - Good</option>
                                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 - Excellent</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            {{-- <a href="{{ route('proposals.show', $proposal) }}" class="btn btn-secondary">Cancel</a> --}}
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 