<div>
    <a href="{{ route('admin.users.edit', $query->id) }}" class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white">
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
                <h5 class="modal-title" id="deleteModalLabel{{ $query->id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus user <strong>{{ $query->name }}</strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.users.destroy', $query->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
