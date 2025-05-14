@extends('dashboard.assets.main')
@section('title', 'Biro - Manajemen FAQ')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Manajemen Konten</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <div class="col-12 px-md-4 content-wrapper">
                <!-- Header -->
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manajemen FAQ</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('biro.tambah-faq') }}" type="button" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Tambah FAQ
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <form class="row g-3">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Cari pertanyaan...">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Table -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="50">#</th>
                                        <th scope="col">Pertanyaan</th>
                                        <th scope="col">Jawaban</th>
                                        <th scope="col" width="120">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($faq as $index => $item)
                                        <tr>
                                            <td>{{ $faq->firstItem() + $index }}</td>
                                            <td class="faq-question">{{ $item->pertanyaan }}</td>
                                            <td class="faq-answer">{{ $item->jawaban }}</td>
                                            <td>
                                                <a href="{{ route('biro.update-faq', $item->id) }}"
                                                    class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{route('biro.delete-faq',$item->id)}}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4 fst-italic">
                                                Belum ada FAQ
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $faq->links() }}
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
