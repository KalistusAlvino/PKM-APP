@extends('dashboard.assets.main')
@section('title', 'Account Dosen Management')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('biro.dosen-account-page') }}"><span
                        class="primary-color">Dosen</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Dosen {{ $dosen->name }}</li>
        </ol>
    </nav>

    <div class="card p-4 bg-primary-color">
        <form action="{{ route('biro.update-dosen', $dosen->id) }}" method="post">
            @csrf
            @method('PATCH')
            <h1 class="modal-title fs-5 secondary-color fw-bold" id="exampleModalLabel">Edit Dosen</h1>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label secondary-color" for="edit-username-dosen">Username</label>
                <input type="text" id="edit-username-dosen" name="username" class="form-control custom-input"
                    value="{{ old('username', $dosen->user->username) }}" required />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label secondary-color" for="edit-nip-dosen">NIP</label>
                <input type="text" id="edit-nip-dosen" name="nip" class="form-control custom-input"
                    value="{{ old('nip', $dosen->nip) }}" inputmode="numeric"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label secondary-color" for="edit-name-dosen">Name</label>
                <input type="text" id="edit-name-dosen" name="name" class="form-control custom-input"
                    value="{{ old('name', $dosen->name) }}" required />
            </div>

            <div class="row">
                <div class="col-6">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="edit-fakultas-dosen">Fakultas</label>
                        <select class="form-select" id="edit-fakultas-dosen" name="fakultas" required>
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $f)
                                <option value="{{ $f->nama_fakultas }}" data-id="{{ $f->id }}"
                                    {{ old('fakultas', $dosen->fakultas) == $f->nama_fakultas ? 'selected' : '' }}>
                                    {{ $f->nama_fakultas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="edit-program-studi">Program Studi</label>
                        <select class="form-select" id="edit-program-studi" name="program_studi" required>
                            @if ($dosen->program_studi)
                                <option value="{{ $dosen->program_studi }}" selected>{{ $dosen->program_studi }}</option>
                            @else
                                <option value="" selected>Pilih Prodi</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label secondary-color" for="edit-nowa-dosen">No. Whatsapp</label>
                <input type="text" id="edit-nowa-dosen" name="no_wa" class="form-control custom-input"
                    inputmode="numeric" value="{{ old('no_wa', $dosen->no_wa) }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label secondary-color" for="no_wa">Minat/Ketertarikan</label><br>
                @forelse ($skema as $item)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="ketertarikan[]"
                            value="{{ $item->nama_skema }}"
                            {{ in_array($item->nama_skema,old('ketertarikan',collect(explode(',', $dosen->ketertarikan))->map('trim')->toArray()))? 'checked': '' }}>
                        <label class="form-check-label secondary-color">
                            {{ $item->nama_skema }}
                        </label>
                    </div>
                @empty
                    <span class="fst-italic">Belum ada skema <em>*silakan tambahkan skema terlebih dahulu</em></span>
                @endforelse
            </div>

            <button type="submit" class="btn bg-secondary-color">
                <span class="primary-color">Update Dosen</span>
            </button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize select elements
            const $fakultasSelect = $('#edit-fakultas-dosen');
            const $prodiSelect = $('#edit-program-studi');

            // Load prodi based on selected fakultas
            function loadProdi(fakultasId, selectedProdi = null) {
                if (!fakultasId) {
                    $prodiSelect.html('<option value="">Pilih Prodi</option>').prop('disabled', true);
                    return;
                }

                $prodiSelect.html('<option disabled selected>⏳ Memuat...</option>').prop('disabled', false);

                $.get('/get-program-studi/' + fakultasId, function(data) {
                    let options = '<option value="">Pilih Prodi</option>';

                    $.each(data, function(_, prodi) {
                        const selected = selectedProdi && prodi.nama_prodi === selectedProdi ?
                            'selected' : '';
                        options +=
                            `<option value="${prodi.nama_prodi}" ${selected}>${prodi.nama_prodi}</option>`;
                    });

                    $prodiSelect.html(options);

                    // If no selection found, select first option
                    if (selectedProdi && !$prodiSelect.val()) {
                        $prodiSelect.val(selectedProdi);
                    }
                }).fail(function() {
                    $prodiSelect.html('<option value="">Gagal memuat data</option>');
                });
            }

            // Handle fakultas change
            $fakultasSelect.change(function() {
                const fakultasId = $(this).find(':selected').data('id');
                loadProdi(fakultasId);
            });

            // Initial load if fakultas is selected
            const initialFakultasId = $fakultasSelect.find(':selected').data('id');
            const initialProdi = "{{ old('program_studi', $dosen->program_studi) }}";

            if (initialFakultasId) {
                loadProdi(initialFakultasId, initialProdi);
            } else {
                $prodiSelect.prop('disabled', true);
            }
        });
    </script>

@endsection
