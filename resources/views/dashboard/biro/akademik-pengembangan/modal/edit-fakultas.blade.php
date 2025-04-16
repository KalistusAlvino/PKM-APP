<!-- Modal -->
<div class="modal fade" id="editFakultasModal" tabindex="-1" aria-labelledby="editFakultasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-primary-color">
            <form action="" method="POST" id="form-edit-fakultas">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 secondary-color fw-bold" id="editFakultasModalLabel">Edit Fakultas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label secondary-color fw-semibold">Nama Fakultas</label>
                        <input class="form-control" type="text" name="nama_fakultas" id="edit-nama-fakultas"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-secondary-color">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#editFakultas", function () {
        var id_fakultas = $(this).data("id");
        $("#form-edit-fakultas").attr("action", "/biro-manajemen-akademik/update-fakultas/" + id_fakultas);
        //Ambil data fakultas
        $.ajax({
            url: "/biro-manajemen-akademik/detail-fakultas/" + id_fakultas,
            method: "GET",
            dataType: "json",
            success: function (response) {
                $('#edit-nama-fakultas').val(response.data.nama_fakultas);
            },
            error: function (){
                alert('Gagal mengambil data fakultas');
            }
        });
    });
</script>
