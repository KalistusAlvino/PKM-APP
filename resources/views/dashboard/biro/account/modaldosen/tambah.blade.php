<!-- Modal -->
<div class="modal fade" id="tambahDosenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                    <div class="row">
                        <div class="col-6">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="fakultas">Fakultas</label>
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
                                <label class="form-label" for="program_studi">Program Studi</label>
                                <select class="form-select" aria-label="Default select example" id="program_studi"
                                    name="program_studi" disabled required>
                                    <option selected class="text-secondary">Pilih Prodi</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="no_wa">No. Whatsapp</label>
                        <input type="text" id="no_wa" name="no_wa" class="form-control custom-input"
                            placeholder="example: 0812********" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                        <input type="text" id="role" name="role" value="mahasiswa" hidden />
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label primary-color" for="no_wa">Minat/Ketertarikan</label><br>
                        @forelse ($skema as $item)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="ketertarikan[]"  value="{{$item->nama_skema}}">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $item->nama_skema }}
                                </label>
                            </div>
                        @empty
                            <span class="fst-italic">Blm ada skema *silahkan tambahkan skema terlebih dahulu</span>
                        @endforelse

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
    $(document).ready(function() {
        $('#fakultas').change(function() {
            var fakultasId = $(this).find(':selected').data('id');
            if (fakultasId) {
                $.ajax({
                    url: '/get-program-studi/' + fakultasId,
                    type: 'GET',
                    success: function(data) {
                        $('#program_studi').empty();
                        $('#program_studi').prop('disabled', false);
                        $('#program_studi').append('<option value="">Pilih Prodi</option>');
                        $.each(data, function(key, value) {
                            $('#program_studi').append('<option value="' + value
                                .nama_prodi + '">' + value.nama_prodi +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#program_studi').empty();
                $('#program_studi').prop('disabled', true);
                $('#program_studi').append('<option value="">Pilih Prodi</option>');
            }
        });
    });
</script>
<script>
    document.getElementById("formDosen").addEventListener("submit", function(event) {
        let checkboxes = document.querySelectorAll('input[name="ketertarikan[]"]:checked');
        if (checkboxes.length === 0) {
            alert("Pilih minimal satu ketertarikan!");
            event.preventDefault(); // Mencegah form submit
        }
    });
</script>


