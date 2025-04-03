@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Review Proposal: {{ $proposal->title }}</h4>
                            <a href="{{ route('proposal-reviews.institutes') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Back to Proposals
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5>Proposal Details</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $proposal->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Submitted By</th>
                                            <td>{{ $proposal->user->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Institute</th>
                                            <td>{{ $proposal->institute->institute ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Expected Completion Date</th>
                                            <td>{{ $proposal->expected_completion_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge badge-{{ 
                                                    $proposal->status == 'approved' ? 'success' : 
                                                    ($proposal->status == 'rejected' ? 'danger' : 
                                                    ($proposal->status == 'under_review' ? 'warning' : 'info')) 
                                                }}">
                                                    {{ ucfirst(str_replace('_', ' ', $proposal->status)) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h5>Description</h5>
                                    <div class="border p-3 bg-light">
                                        {!! nl2br(e($proposal->description)) !!}
                                    </div>
                                    
                                    <h5 class="mt-3">Expected Output</h5>
                                    <div class="border p-3 bg-light">
                                        {!! nl2br(e($proposal->expected_output)) !!}
                                    </div>
                                    
                                    @if ($proposal->attachment)
                                    <h5 class="mt-3">Attachment</h5>
                                    <div class="border p-3 bg-light">
                                        <a href="{{ asset('storage/' . $proposal->attachment) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-download"></i> Download Attachment
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Review Form</h5>
                                    <form action="{{ route('proposals.review.store', $proposal->id) }}" method="POST">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="comments">Review Comments</label>
                                            <textarea name="comments" id="comments" rows="5" class="form-control @error('comments') is-invalid @enderror">{{ old('comments', $review->comments ?? '') }}</textarea>
                                            @error('comments')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="status_under_review" name="status" value="under_review" class="custom-control-input" {{ old('status', $review->status ?? '') == 'under_review' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status_under_review">Under Review</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="status_approved" name="status" value="approved" class="custom-control-input" {{ old('status', $review->status ?? '') == 'approved' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status_approved">Approve</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="status_rejected" name="status" value="rejected" class="custom-control-input" {{ old('status', $review->status ?? '') == 'rejected' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status_rejected">Reject</label>
                                            </div>
                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit Review</button>
                                            <a href="{{ route('proposal-reviews.institutes') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 