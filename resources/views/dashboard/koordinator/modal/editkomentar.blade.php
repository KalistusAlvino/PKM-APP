<!-- Modal -->
<div class="modal fade" id="editKomentarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content bg-third-color">
            <form action="" id="form-edit-komentar" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel">Edit Komentar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div data-mdb-input-init class="form-outline mb-2">
                        <label class="form-label primary-color" for="edit-komentar-text">Komentar</label>
                        <textarea type="text" id="edit-komentar-text" name="komentar" class="form-control custom-input"
                            required style="height: 100px"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary-color"><span
                            class="secondary-color">Edit</span></button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).on("click", ".editKomentar", function () {
        var id_komentar = $(this).data("id");
        var id_kelompok = "{{ $informasiKelompok['id_kelompok'] }}";
        $("#form-edit-komentar").attr("action", "/koordinator-updatekomentar/" + id_kelompok + "/" + id_komentar);
        $.ajax({
            url: "/koordinator-detail-komentar/" + id_komentar,
            method: "GET",
            dataType: "json",
            success: function (response) {
                $('#edit-komentar-text').val(response.komentar);
            },
        });
    });
</script>
