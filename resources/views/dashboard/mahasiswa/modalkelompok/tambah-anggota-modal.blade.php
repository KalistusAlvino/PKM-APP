<div class="modal fade" id="tambah-anggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-third-color">
            <form action="{{ route('storeAnggota', $id_kelompok) }}" method="post" class="mx-2">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5 primary-color fw-bold" id="exampleModalLabel">Buat akun anggota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label primary-color" for="nimForm">NIM</label>
                                <input type="text" id="nimForm" name="username" class="form-control custom-input"
                                    placeholder="example: 722104**" inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                                <input type="text" id="role" name="role" value="mahasiswa" hidden />
                            </div>
                        </div>
                        <div class="col-6">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label primary-color" for="waForm">Whatsapp</label>
                                <input type="text" id="waForm" name="no_wa" class="form-control custom-input"
                                    placeholder="example: 0822********" inputmode="numeric"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label primary-color" for="fakultas">Fakultas</label>
                                <select class="form-select" aria-label="Default select example" id="fakultas"
                                    name="fakultas" required>
                                    <option selected value="">Pilih Fakultas</option>
                                    @foreach ($fakultas as $f)
                                        <option value="{{ $f->nama_fakultas }}" data-id="{{ $f->id }}">
                                            {{ $f->nama_fakultas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label primary-color" for="program_studi">Program Studi</label>
                                <select class="form-select" aria-label="Default select example" id="program_studi"
                                    name="prodi" disabled required>
                                    <option selected class="text-secondary">Pilih Prodi</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="form2Example17">Email address</label>
                        <input type="email" id="form2Example17" name="email" class="form-control custom-input"
                            placeholder="example: abcd@students.ukdw.ac.id" required />

                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="nameForm">Name</label>
                        <input type="text" id="nameForm" name="name" class="form-control custom-input"
                            placeholder="example: Chris Jhon" required />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <span class="text-danger fst-italic">*Password default anggota adalah 12345678, harap mengganti password setelah membuat akun untuk kepentingan keamanan</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary-color"><span class="secondary-color"><i
                            class="fa-solid fa-user-plus me-2"></i>Buat akun</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
