<!-- Modal -->
<div class="modal fade" id="tambahSkemaModal" tabindex="-1" aria-labelledby="tambahSkemaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-primary-color">
            <form action="{{ route('biro.manajemen-akademik-tambah-skema') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5 secondary-color fw-bold" id="tambahSkemaModalLabel">Tambah Skema</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label secondary-color fw-semibold">Nama Skema</label>
                        <input class="form-control" type="text" name="nama_skema" placeholder="Contoh: PKM-AI"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-secondary-color">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
