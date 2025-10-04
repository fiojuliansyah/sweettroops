<div>
    <a href="{{ route('admin.galleries.edit', $query->id) }}" class="btn btn-warning rounded-pill">
        Edit
    </a>
    <button type="button" class="btn btn-danger rounded-pill" 
            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $query->id }}">
        Hapus
    </button>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $query->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $query->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $query->id }}">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the Hands-On Class <strong>{{ $query->name }}</strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.galleries.destroy', $query->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>