<!-- Modal -->
<div class="modal fade" id="ganti-password-dosen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content bg-third-color">
            <form action="{{route('biro.ganti-password')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <input class="form-control" type="text" name="username" id="usernameInput"
                       hidden>
                    <div data-mdb-input-init class="form-outline mb-3">
                        <label class="form-label primary-color fw-semibold">Password Baru</label>
                        <input class="form-control" type="password" name="new_password"
                            placeholder="Masukkan password baru" minlength="8" required>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color fw-semibold">Konfirmasi Password
                            Baru</label>
                        <input class="form-control" type="password" name="confirm_password"
                            placeholder="Konfirmasi password baru" minlength="8" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-primary-color"><span class="secondary-color">Ganti
                            password</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const passwordModal = document.getElementById('ganti-password-dosen');

    passwordModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang diklik
        const username = button.getAttribute('data-id'); // Ambil data-id
        const name = button.getAttribute('data-name'); // Ambil data-id

        // Masukkan ke input hidden di modal
        const input = passwordModal.querySelector('#usernameInput');
        const label = passwordModal.querySelector('#exampleModalLabel');
        input.value = username;
        label.textContent = `Ganti password ${name}`;
    });
</script>
