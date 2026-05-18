<!-- Tombol Pemanggil Modal -->
<button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1" style="font-size: 0.76rem; font-weight: 700;" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $kontak->id }}">
    <i class="fas fa-trash-alt me-1.5"></i> Hapus Pesan
</button>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal{{ $kontak->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $kontak->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="confirmDeleteLabel{{ $kontak->id }}">Konfirmasi Hapus Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3 text-start" style="color: #475569; font-size: 0.88rem;">
                Apakah Anda yakin ingin menghapus pesan masuk dari <strong>{{ $kontak->nama }}</strong> secara permanen? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" style="font-size: 0.85rem; font-weight: 600;" data-bs-dismiss="modal">Batal</button>
                <form method="post" action="{{ route('kontaks.destroy', $kontak) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4" style="font-size: 0.85rem; font-weight: 600;">Hapus Permanen</button>
                </form>
            </div>
        </div>
    </div>
</div>
