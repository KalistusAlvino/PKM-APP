<!-- Modal -->
<div class="modal fade" id="detailUndanganModal" tabindex="-1" aria-labelledby="detailUndanganModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-primary-color">
            <div class="modal-header">
                <!-- beri id supaya bisa diganti via JS -->
                <h5 id="modalKetuaKelompok" class="secondary-color fw-bold"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="secondary-color fw-bold">Daftar Anggota</span>
                <div class="table-responsive">
                    <table class="table bg-table-transparent align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="secondary-color">NO.</th>
                                <th scope="col" class="secondary-color">NIM</th>
                                <th scope="col" class="secondary-color">Nama</th>
                            </tr>
                        </thead>
                        <tbody id="modalAnggotaBody">
                            <!-- content akan di-generate oleh JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#detail-undangan", function() {
        var id_invite = $(this).data("id");
        $.ajax({
            url: "/dosen-detail-undangan/" + id_invite,
            method: "GET",
            dataType: "json",
            success: function(response) {
                $("#modalKetuaKelompok").text(
                    `Ketua Kelompok : ${response.inviter.name} (${response.inviter.user.username})`
                );

                var anggotaArr = response.kelompok.mahasiswa_kelompok;
                var rowsHtml = '';
                if (anggotaArr.length > 0) {
                    anggotaArr.forEach(function(m, idx) {
                        rowsHtml += `
                            <tr>
                                <td class="secondary-color">${idx + 1}</td>
                                <td class="secondary-color">${m.mahasiswa.user.username}</td>
                                <td class="secondary-color">${m.mahasiswa.name}</td>
                            </tr>`;
                    });
                } else {
                    rowsHtml = `
                        <tr>
                        <td colspan="3" class="text-center secondary-color">
                            Tidak ada anggota
                        </td>
                        </tr>`;
                }

                // 3. Masukkan ke <tbody>
                $("#modalAnggotaBody").html(rowsHtml);
            },
            error: function() {
                alert('Gagal mengambil data invite');
            }
        });
    });
</script>
