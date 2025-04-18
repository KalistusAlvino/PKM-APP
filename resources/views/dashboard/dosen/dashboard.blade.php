@extends('dashboard.assets.main')
@section('title', 'Dashboard Dosen')
@section('content')
    <span style="display: inline-block; border-bottom: 2px solid #3b564d; width: 100%;"
        class="mx-2 fw-bold fs-2 primary-color">Dashboard Dosen</span>
    <div class="row my-2 ">
        <div class="col-12 col-lg-6 mb-2">
            <div class="card bg-secondary-color">
                <div class="d-flex flex-inline justify-content-between align-items-center">
                    <span class="mx-4 my-2 primary-color fw-bold fs-4">
                        Total Kelompok Bimbingan
                    </span>
                    <div class="card mx-4 my-2 border border-0 bg-primary-color">
                        <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                            <i class="fa-solid fa-people-group"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                        {{ $kelompokBimbingan }}
                    </span>
                    <span class="mx-4 mb-2 primary-color">
                        Kelompok bimbingan terdaftar dalam sistem
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-2">
            <div class="card bg-secondary-color">
                <div class="d-flex flex-inline justify-content-between align-items-center">
                    <span class="mx-4 my-2 primary-color fw-bold fs-4">
                        Undangan
                    </span>
                    <div class="card mx-4 my-2 border border-0 bg-primary-color">
                        <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                            <i class="fa-solid fa-scroll"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                        {{ $invite }}
                    </span>
                    <span class="mx-4 mb-2 primary-color">
                        Undangan menunggu untuk di respon
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card bg-secondary-color shadow-lg py-2 px-2">
                {!! $barChart->container() !!}
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card bg-secondary-color shadow-lg">
                <span class="mx-3 my-3 fw-bold primary-color fs-5">Judul Terbaru</span>
                <ul class="list-group list-group-flush">
                    @forelse ($judul as $j)
                        <li class="list-group-item bg-transparent">
                            <div class="row mt-2">
                                <div class="col d-flex flex-column">
                                    <div class="content">
                                        <span class="fw-bold primary-color">({{ $j->skema->nama_skema }})
                                            {{ $j->user->getNamaUserAttribute() }}</span>
                                        <span>-
                                            menambahkan judul baru</span>
                                    </div>
                                    <div class="time d-flex justify-content-between align-items-center">
                                        <span class="text-secondary my-2">{{ $j->created_at->diffForHumans() }}</span>
                                        <a href="{{ route('dosen.detail-kelompok', $j->id_kelompok) }}"
                                            class="d-flex justify-content-end">Lihat judul</a>
                                    </div>

                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item bg-transparent">
                            Belum ada judul yang terupload
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <script src="{{ $barChart->cdn() }}"></script>

    {{ $barChart->script() }}
@endsection
