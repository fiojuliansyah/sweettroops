{{-- resources/views/admin/courses/action.blade.php --}}
<div>
    <a href="{{ route('admin.videos.index', $query->id) }}" class="bg-info-50 text-info-600 py-2 px-14 rounded-pill hover-bg-info-600 hover-text-white">
        Tambah Video
    </a>
    <a href="{{ route('admin.courses.edit', $query->id) }}" class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white">
        Edit
    </a>
    <button type="button" class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white" 
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
                <p>Are you sure you want to delete the course <strong>{{ $query->title }}</strong>?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.courses.destroy', $query->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>