@extends('dashboard.assets.main')
@section('title', 'Daftar Ketua')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Ketua</li>
        </ol>
    </nav>
    <div class="card h-25 bg-third-color mb-4 mx-2 my-2">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Daftar Ketua</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Membuat kelompok baru dan daftarkan diri anda
                    sebagai ketua kelompok</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600'}}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    @if (!$alreadyKetua)
        <div class="row d-flex justify-content-center mx-2 my-2">
            <div class="card mx-2 my-2 bg-third-color d-flex justify-content-center">
                <span class="fs-3 primary-color fw-bold mx-2 my-2 text-center">Pendaftaran Ketua</span>
                <span class="text-center mx-2 my-2">Terima kasih atas minat Anda untuk mendaftar sebagai ketua. Dengan menekan
                    tombol di bawah ini,
                    Anda
                    akan terdaftar sebagai ketua dan membentuk kelompok baru</span>
                <div class="d-flex justify-content-center">
                    <button class="mx-3 my-2 mb-4 btn bg-primary-color w-50" onclick="confirmDaftar('{{ route('mahasiswa.post-daftar-ketua') }}')">
                        <span class="secondary-color">Daftar Sekarang</span></button>
                </div>
            </div>
        </div>
    @else
        <div class="card mx-2 my-2 bg-third-color">
            <span class="mx-2 my-2 fst-italic primary-color fw-bold">Anda sudah terdaftar sebagai ketua</span>
        </div>
    @endif

    <script>
        function confirmDaftar(url) {
            Swal.fire({
                title: `Anda yakin ingin mendaftar sebagai ketua ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b564d',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Daftar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement("form");
                    form.method = "POST";
                    form.action = url;

                    // Tambahkan CSRF token (diperlukan di Laravel)
                    let csrfInput = document.createElement("input");
                    csrfInput.type = "hidden";
                    csrfInput.name = "_token";
                    csrfInput.value = "{{ csrf_token() }}";  // Pastikan ini ada di Blade
                    form.appendChild(csrfInput);

                    // Tambahkan form ke body dan submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
