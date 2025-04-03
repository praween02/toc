<div class="btn-group">
    <a href="{{ route('lab.grading.show', $grading) }}" class="btn btn-info btn-sm">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route('lab.grading.edit', $grading) }}" class="btn btn-primary btn-sm">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('lab.grading.destroy', $grading) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this grading?')">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div> 