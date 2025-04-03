@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Proposal Review: {{ $proposal->title }}</h4>
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
                            
                            @if ($review)
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Review Information</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="20%">Reviewer</th>
                                            <td>{{ $review->reviewer->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge badge-{{ 
                                                    $review->status == 'approved' ? 'success' : 
                                                    ($review->status == 'rejected' ? 'danger' : 
                                                    ($review->status == 'under_review' ? 'warning' : 'info')) 
                                                }}">
                                                    {{ ucfirst(str_replace('_', ' ', $review->status)) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Review Date</th>
                                            <td>{{ $review->created_at->format('Y-m-d H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Comments</th>
                                            <td>
                                                {!! nl2br(e($review->comments)) !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            @if($proposal->status == 'under_review')
                            <div class="row mt-3">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <form action="{{ route('proposal-reviews.approve', $proposal->id) }}" method="POST" class="mr-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this proposal?')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('proposal-reviews.reject', $proposal->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this proposal?')">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endif
                            @else
                            <div class="alert alert-info">
                                No review has been submitted for this proposal yet.
                                <a href="{{ route('proposals.review', $proposal->id) }}" class="btn btn-sm btn-primary ml-2">
                                    <i class="fas fa-edit"></i> Add Review
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 