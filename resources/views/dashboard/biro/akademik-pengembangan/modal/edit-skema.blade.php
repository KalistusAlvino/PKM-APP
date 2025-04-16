<!-- Modal -->
<div class="modal fade" id="editSkemaModal" tabindex="-1" aria-labelledby="editSkemaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-primary-color">
            <form action="" method="POST" id="form-edit-skema">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 secondary-color fw-bold" id="editSkemaModalLabel">Edit Skema</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label secondary-color fw-semibold">Nama Skema</label>
                        <input class="form-control" type="text" name="nama_skema" id="edit-nama-skema"
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
    $(document).on("click", "#editSkema", function () {
        var id_skema = $(this).data("id");
        $("#form-edit-skema").attr("action", "/biro-manajemen-akademik/update-skema/" + id_skema);
        //Ambil data Skema
        $.ajax({
            url: "/biro-manajemen-akademik/detail-skema/" + id_skema,
            method: "GET",
            dataType: "json",
            success: function (response) {
                $('#edit-nama-skema').val(response.data.nama_skema);
            },
            error: function (){
                alert('Gagal mengambil data skema');
            }
        });
    });
</script>
