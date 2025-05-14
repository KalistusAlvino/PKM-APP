@extends('dashboard.assets.main')
@section('title', 'Biro - Manajemen Pengumuman')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Manajemen Pengumuman</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content Manajemen Berita -->
            <div class="col-12 px-md-4 content-wrapper">
                <!-- Header -->
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manajemen Pengumuman</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('biro.tambah-pengumuman') }}" type="button" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Pengumuman
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form class="row g-3">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Cari judul pengumuman...">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Table -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="50">#</th>
                                        <th scope="col" width="100">Gambar</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col" width="150">Tanggal</th>
                                        <th scope="col" width="150">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengumuman as $idx => $item)
                                        <tr>
                                            <td>{{ $pengumuman->firstItem() + $idx }}</td>
                                            <td>
                                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://place-hold.it/700x600' }}"
                                                    class="table-img rounded" alt="Berita"
                                                    style="height: 50px; object-fit: cover;">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{route('biro.update-pengumuman',$item->id)}}" class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                 <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{route('biro.delete-pengumuman',$item->id)}}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <a href="{{ route('detail-pengumuman', $item->id) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-secondary">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="fst-italic" colspan="5">
                                                Belum ada pengumuman
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $pengumuman->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Anda Yakin ingin menghapus data ini?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form dinamis
                    let form = document.getElementById("delete-form");
                    form.action = url;
                    form.submit(); // Kirim form dengan method DELETE
                }
            });
        }
    </script>
@endsection
