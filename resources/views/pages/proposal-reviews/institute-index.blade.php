@extends('layouts.app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Proposals Pending Review - {{ $institute->institute ?? 'All Institutes' }}</h4>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                        <div class="card-body">
                            @if($proposals->isEmpty())
                                <div class="alert alert-info">
                                    No proposals found for review.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Proposal</th>
                                                <th>Submitted By</th>
                                                <th>Institute</th>
                                                <th>Expected Completion</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($proposals as $proposal)
                                                <tr>
                                                    <td>{{ $proposal->id }}</td>
                                                    <td>{{ $proposal->title }}</td>
                                                    <td>{{ $proposal->user->name ?? 'Unknown User' }}</td>
                                                    <td>{{ $proposal->institute->institute ?? $proposal->institute->name ?? 'Unknown Institute' }}</td>
                                                    <td>{{ $proposal->expected_completion_date ?? 'Not set' }}</td>
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
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('proposals.show', $proposal->id) }}" class="btn btn-info btn-sm" title="View Proposal">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            {{-- @if($proposal->status != 'approved' && $proposal->status != 'rejected')
                                                            <a href="{{ route('proposal-reviews.approve', $proposal->id) }}" class="btn btn-primary btn-sm" title="Review Proposal">
                                                                <i class="fas fa-check-square"></i>
                                                            </a>
                                                            @endif
                                                            @if($proposal->status == 'under_review')
                                                            <form action="{{ route('proposal-reviews.approve', $proposal->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success btn-sm" title="Approve" onclick="return confirm('Are you sure you want to approve this proposal?')">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('proposal-reviews.reject', $proposal->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Reject" onclick="return confirm('Are you sure you want to reject this proposal?')">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </form>
                                                            @endif --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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