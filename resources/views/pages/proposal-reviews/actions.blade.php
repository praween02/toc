<div class="btn-group">
    <a href="{{ route('proposals.show', $proposal->id) }}" class="btn btn-info btn-sm" title="View Proposal">
        <i class="fas fa-eye"></i>
    </a>
    @if($proposal->status != 'approved' && $proposal->status != 'rejected')
    <a href="{{ route('proposals.review', $proposal->id) }}" class="btn btn-primary btn-sm" title="Review Proposal">
        <i class="fas fa-check-square"></i>
    </a>
    @endif
    @if($proposal->status == 'under_review')
    <div class="btn-group">
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
    </div>
    @endif
</div> 