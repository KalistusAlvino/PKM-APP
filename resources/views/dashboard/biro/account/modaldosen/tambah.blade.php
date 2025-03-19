<!-- Modal -->
<div class="modal fade" id="tambahDosenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content bg-third-color">
            <form action="{{ route('biro.dosen-post') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel">Tambah Dosen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="usernameForm">Username</label>
                        <input type="text" id="usernameForm" name="username" class="form-control custom-input"
                            placeholder="example: dosen1" required />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="nipForm">NIP</label>
                        <input type="text" id="nipForm" name="nip" class="form-control custom-input"
                            placeholder="example: 51244**" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                        <input type="text" id="role" name="role" value="mahasiswa" hidden />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="nameForm">Name</label>
                        <input type="text" id="nameForm" name="name" class="form-control custom-input"
                            placeholder="example: Chris Jhon" required />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="no_wa">No. Whatsapp</label>
                        <input type="text" id="no_wa" name="no_wa" class="form-control custom-input"
                            placeholder="example: 0812********" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                        <input type="text" id="role" name="role" value="mahasiswa" hidden />
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
