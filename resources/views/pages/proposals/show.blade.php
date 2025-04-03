@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>{{ $proposal->title }}</h4>
                            <div>
                                @if(auth()->user()->id == $proposal->user_id && $proposal->status == 'draft')
                                <a href="{{ route('proposals.edit', $proposal->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Proposal
                                </a>
                                @endif
                                {{-- <a href="{{ route('proposal-reviews.institutes', $proposal->institute_id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5>Proposal Information</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Title</th>
                                            <td>{{ $proposal->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Socio-Economic Vertical</th>
                                            <td>{{ $proposal->socio_economic_vertical ?? 'Not specified' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Stakeholders</th>
                                            <td>{{ $proposal->stack_holder ?? 'Not specified' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Submitted By</th>
                                            <td>{{ $proposal->user->name ?? 'Unknown User' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Institute</th>
                                            <td>{{ $proposal->institute->institute ?? $proposal->institute->name ?? 'Unknown Institute' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Expected Completion Date</th>
                                            <td>{{ $proposal->expected_completion_date->format('d M, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Days Required for Lab Access</th>
                                            <td>{{ $proposal->days_required ?? 'Not specified' }} days</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @php
                                                    $statusColors = [
                                                        'draft' => 'secondary',
                                                        'submitted' => 'info',
                                                        'under_review' => 'warning',
                                                        'approved' => 'success',
                                                        'rejected' => 'danger'
                                                    ];
                                                    $status = $proposal->status ?? 'unknown';
                                                    $color = $statusColors[$status] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $color }} text-white" style="background-color: var(--{{ $color }}); padding: 5px 10px; border-radius: 4px; font-size: 85%;">
                                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $proposal->created_at->format('d M, Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $proposal->updated_at->format('d M, Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <h5>Team Members</h5>
                                    @if($proposal->teamMembers && $proposal->teamMembers->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($proposal->teamMembers as $member)
                                                        <tr>
                                                            <td>{{ $member->name }}</td>
                                                            <td>{{ $member->email }}</td>
                                                            <td>{{ $member->pivot->role ?? 'Member' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-info">No team members added to this proposal.</div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Proposal Brief</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="proposal-brief">
                                                {!! nl2br(e($proposal->proposal_brief ?? 'No brief provided.')) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Description</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="proposal-description">
                                                {!! nl2br(e($proposal->description)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Expected Output</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="proposal-output">
                                                {!! nl2br(e($proposal->expected_output)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($proposal->attachment)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Attachments</h5>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ asset('storage/' . $proposal->attachment) }}" target="_blank" class="btn btn-info">
                                                <i class="fas fa-download"></i> Download Attachment
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($proposal->review)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Review Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="20%">Reviewer</th>
                                                    <td>{{ $proposal->review->reviewer->name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Review Date</th>
                                                    <td>{{ $proposal->review->created_at->format('d M, Y H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        @php
                                                            $reviewStatus = $proposal->review->status ?? 'unknown';
                                                            $reviewColor = $statusColors[$reviewStatus] ?? 'secondary';
                                                        @endphp
                                                        <span class="badge bg-{{ $reviewColor }} text-white" style="background-color: var(--{{ $reviewColor }}); padding: 5px 10px; border-radius: 4px; font-size: 85%;">
                                                            {{ ucfirst(str_replace('_', ' ', $reviewStatus)) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Comments</th>
                                                    <td>
                                                        {!! nl2br(e($proposal->review->comments ?? 'No comments provided.')) !!}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            @if(auth()->user()->id == $proposal->user_id && $proposal->status == 'draft')
                                                <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this proposal?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i> Delete Proposal
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        
                                        <div>
                                            @if(auth()->user()->id == $proposal->user_id && $proposal->status == 'draft')
                                                <form action="{{ route('proposals.update', $proposal->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="submitted">
                                                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to submit this proposal for review? You won\'t be able to edit it after submission.');">
                                                        <i class="fas fa-paper-plane"></i> Submit Proposal
                                                    </button>
                                                </form>
                                            @endif

                                            @if(\App\Helpers\Custom::current_institute_id() == $proposal->institute_id && ($proposal->status == 'submitted' || $proposal->status == 'draft'))
                                                <div class="btn-group">
                                                    <form action="{{ route('proposal-reviews.approve', $proposal->id) }}" method="POST" class="d-inline mr-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this proposal?');">
                                                            <i class="fas fa-check"></i> Approve Proposal
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('proposal-reviews.reject', $proposal->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this proposal?');">
                                                            <i class="fas fa-times"></i> Reject Proposal
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif

                                            @if($proposal->status == 'approved')
                                                <span class="badge bg-success text-white" style="font-size: 100%; padding: 8px 15px;">
                                                    <i class="fas fa-check-circle"></i> This proposal has been approved
                                                </span>
                                            @endif

                                            @if($proposal->status == 'rejected')
                                                <span class="badge bg-danger text-white" style="font-size: 100%; padding: 8px 15px;">
                                                    <i class="fas fa-times-circle"></i> This proposal has been rejected
                                                </span>
                                            @endif
                                        </div>
                                    </div>
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

@push('styles')
<style>
    .proposal-description, .proposal-output, .proposal-brief {
        min-height: 100px;
        white-space: pre-line;
    }
</style>
@endpush 