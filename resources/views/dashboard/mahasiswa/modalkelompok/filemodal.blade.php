<!-- Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-third-color">
            <form action="{{route('storeFile', $informasiKelompok['id_kelompok'])}}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel">Upload Propoasl Final</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    @csrf
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label class="form-label primary-color" for="selectJudul">Judul / Ide</label>
                        <select class="form-select" aria-label="Default select example" name="judulId" required>
                            <option selected value="">Pilih Judul</option>
                            @foreach ($judul as $jd)
                                <option value="{{ $jd->id }}" title="{{ $jd->detail_judul }}">
                                    {{ Str::limit($jd->detail_judul, 30, '...') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label class="form-label primary-color" for="inputFile">File</label>
                        <input class="form-control" type="file" name="nama_file" id="formFile">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary-color"><span
                            class="secondary-color">Upload</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
