<!-- Modal -->
<div class="modal fade" id="editKoordinatorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content bg-third-color">
            <form method="POST" id="form-edit-koordinator">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel">Tambah Koordinator</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="edit-username-koordinator">Username</label>
                        <input type="text" id="edit-username-koordinator" name="username"
                            class="form-control custom-input" required />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="edit-name-koordinator">Name</label>
                        <input type="text" id="edit-name-koordinator" name="name"
                            class="form-control custom-input" required />
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
    $(document).on("click", "#edit-koordinator-btn", function() {
        var id_koordinator = $(this).data("id");
        $("#form-edit-koordinator").attr("action", "/biro/update-koordinator/" + id_koordinator);
        $.ajax({
            url: "/detail-koordinator/" + id_koordinator,
            method: "GET",
            dataType: "json",
            success: function(response) {
                $('#edit-username-koordinator').val(response.user.username);
                $('#edit-name-koordinator').val(response.name);
            },
        });
    });
</script>
