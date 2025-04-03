@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Review</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('proposal-reviews.update', $review) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <h5>Proposal Information</h5>
                            <p><strong>Title:</strong> {{ $review->proposal->title }}</p>
                            <p><strong>Submitted By:</strong> {{ $review->proposal->user->name }}</p>
                            <p><strong>Institute:</strong> {{ $review->proposal->institute->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ $review->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $review->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $review->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comments" class="form-label">Review Comments</label>
                            <textarea class="form-control @error('comments') is-invalid @enderror" 
                                id="comments" name="comments" rows="4" required>{{ old('comments', $review->comments) }}</textarea>
                            @error('comments')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('proposal-reviews.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Review</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 