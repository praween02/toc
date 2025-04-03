@extends('layouts.app')
@section('title', 'My Proposals')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h3>My Proposals</h3>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('proposals.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Create New Proposal
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Expected Completion</th>
                                    <th>Team Members</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($proposals as $proposal)
                                    <tr>
                                        <td>{{ $proposal->title }}</td>
                                        <td>
                                            @php
                                                $statusClass = [
                                                    'draft' => 'badge-secondary',
                                                    'submitted' => 'badge-info',
                                                    'under_review' => 'badge-warning',
                                                    'approved' => 'badge-success',
                                                    'rejected' => 'badge-danger'
                                                ][$proposal->status] ?? 'badge-secondary';
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                                {{ ucfirst($proposal->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $proposal->expected_completion_date->format('M d, Y') }}</td>
                                        <td>
                                            @foreach($proposal->teamMembers as $member)
                                                <span class="badge bg-info">{{ $member->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('proposals.show', $proposal) }}" 
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                
                                                @if($proposal->status === 'draft')
                                                    <a href="{{ route('proposals.edit', $proposal) }}" 
                                                       class="btn btn-sm btn-primary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    
                                                    <form action="{{ route('proposals.store', $proposal) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" 
                                                                title="Submit" onclick="return confirm('Are you sure you want to submit this proposal?')">
                                                            <i class="fa fa-paper-plane"></i>
                                                        </button>
                                                    </form>
                                                    
                                                    <form action="{{ route('proposals.destroy', $proposal) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                title="Delete" onclick="return confirm('Are you sure you want to delete this proposal?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No proposals found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 