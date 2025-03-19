<!-- Modal -->
<div class="modal fade" id="judulModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content bg-third-color">
            <form action="{{route('storeJudul', $informasiKelompok['id_kelompok'])}}" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel">Tambah Judul atau Ide</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    @csrf
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label class="form-label primary-color" for="judulForm">Judul / Ide</label>
                        <textarea type="text" id="judulForm" name="detail_judul" class="form-control custom-input"
                            required style="height: 100px"></textarea>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label class="form-label primary-color" for="skemaPKM">Skema PKM</label>
                        <select class="form-select" aria-label="Default select example" id="skemaPKM" name="id_skema"
                            required>
                            <option selected value="">Pilih Skema</option>
                            @foreach ($skema as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->nama_skema }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary-color"><span
                            class="secondary-color">Tambah</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
