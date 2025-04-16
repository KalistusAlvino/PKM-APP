<!-- Modal -->
<div class="modal fade" id="tambahProdiModal" tabindex="-1" aria-labelledby="tambahProdiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-primary-color">
            <form action="{{ route('biro.manajemen-akademik-tambah-prodi') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5 secondary-color fw-bold" id="tambahProdiModalLabel">Tambah Program
                        Studi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label" for="fakultas">Nama Fakultas</label>
                        <select class="form-select" aria-label="Default select example" name="fakultas_id"
                            required>
                            <option selected value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $f)
                                <option value="{{ $f->id }}">
                                    {{ $f->nama_fakultas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label secondary-color fw-semibold">Nama Prodi</label>
                        <input class="form-control" type="text" name="nama_prodi"
                            placeholder="Contoh: Sistem Informasi" required>
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
