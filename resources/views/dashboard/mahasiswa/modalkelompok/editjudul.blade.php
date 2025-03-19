<!-- Modal -->
<div class="modal fade" id="editJudulModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content bg-third-color">
            <form action="" id="form-edit-judul" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel">Edit Judul atau Ide</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div data-mdb-input-init class="form-outline mb-2">
                        <label class="form-label primary-color" for="judulForm">Judul / Ide</label>
                        <textarea type="text" id="edit-judul-form" name="detail_judul" class="form-control custom-input"
                            required style="height: 100px"></textarea>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-2">
                        <label class="form-label primary-color" for="skemaPKM">Skema PKM</label>
                        <select class="form-select" aria-label="Default select example" id="edit-skema-pkm"
                            name="id_skema" required>
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


<script>
    $(document).on("click", ".editJudul", function () {
        var id_judul = $(this).data("id");
        var id_kelompok = "{{ $informasiKelompok['id_kelompok'] }}";
        $("#form-edit-judul").attr("action", "/update-judul/" + id_kelompok + "/" + id_judul);
        $.ajax({
            url: "/detail-judul/" + id_kelompok + "/" + id_judul,
            method: "GET",
            dataType: "json",
            success: function (response) {
                $('#edit-judul-form').val(response.detail_judul);
                $('#edit-skema-pkm').val(response.id_skema);
            },
        });
    });
</script>
