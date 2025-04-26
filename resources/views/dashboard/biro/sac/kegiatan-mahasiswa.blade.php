@extends('dashboard.assets.main')
@section('title', 'Biro - Kegiatan Mahasiswa')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">SAC - Kegiatan</li>
        </ol>
    </nav>
    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
        <div class="card bg-primary-color h-100 w-100 rounded-4">
            <span class="mx-4 my-3 fw-bold secondary-color fs-3">Student Activity Credit</span>
            <div class="row">
                <div class="col-4">
                    <div class="input-group d-flex px-4 py-3">
                        <span class="input-group-text" id="addon-wrapping"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari berdasarkan nama kegiatan"
                            aria-describedby="addon-wrapping" name="nama_ketua" required>
                    </div>
                </div>
            </div>
            <div class="table-responsive mx-4 my-3">
                <table class="table bg-table-transparent table-borderless">
                    <thead>
                        <tr>
                            <th scope="col" class="secondary-color">NO.</th>
                            <th scope="col" class="secondary-color">MAHASISWA</th>
                            <th scope="col" class="secondary-color">KEGIATAN</th>
                            <th scope="col" class="secondary-color">TANGGAL</th>
                            <th scope="col" class="secondary-color">KATEGORI</th>
                            <th scope="col" class="secondary-color">TINGKAT</th>
                            <th scope="col" class="secondary-color">JENIS</th>
                            <th scope="col" class="secondary-color">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan as $idx => $kg)
                            <tr>
                                <td class="secondary-color">{{ $idx + 1 }}</td>
                                <td class="secondary-color">{{ $kg->mahasiswa->name }}</td>
                                <td class="secondary-color">{{ $kg->nama_kegiatan }}</td>
                                <td class="secondary-color">{{ $kg->tanggal }}</td>
                                <td class="secondary-color">{{ $kg->jenis->tingkat->kategori->nama_kategori }}</td>
                                <td class="secondary-color">{{ $kg->jenis->tingkat->nama_tingkat }}</td>
                                <td class="secondary-color">{{ $kg->jenis->nama_jenis }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{route('downloadProposal',[$kg->id_kelompok, $kg->proposal->nama_file])}}" type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i></a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="confirmUpdateKegiatan('{{ $kg->mahasiswa->name }}','{{ route('biro.update-status-kegiatan', $kg->id) }}')"><i class="fa-regular fa-square-check"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="secondary-color">Belum ada kegiatan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form id="update-kegiatan-form" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>
    <script>
        function confirmUpdateKegiatan(nama, url) {
            Swal.fire({
                title: `Anda Yakin akan melakukan acc untuk kegiatan ${nama}?`,
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b564d',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, ACC!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form dinamis
                    let form = document.getElementById("update-kegiatan-form");
                    form.action = url;
                    form.submit(); // Kirim form dengan method PATCH
                }
            });
        }
    </script>
@endsection
