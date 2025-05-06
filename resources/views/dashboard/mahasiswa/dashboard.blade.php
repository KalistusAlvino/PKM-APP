@extends('dashboard.assets.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')
    <span style="display: inline-block; border-bottom: 2px solid #3b564d; width: 100%;"
        class="mx-2 fw-bold fs-2 primary-color">Dashboard Mahasiswa</span>
    <div class="row my-2 ">
        <div class="col-12 col-lg-6 mb-2">
            @forelse ($proposal as $p)
                <div class="card bg-secondary-color shadow-lg my-2">
                    <span class="mx-3 mt-3 mb-2 fw-bold primary-color fs-5">Proposal Terbaru</span>
                    <span class="mx-3 my-1 fw-normal primary-color fs-5 text-justify">{{$p->judul->detail_judul ?? 'Belum ada proposal'}}</span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent">
                            <div class="row mx-2 my-2">
                                <div class="col-4 fw-semibold text-secondary">
                                    <span>Dosen Pembimbing</span>

                                </div>
                                <div class="col-8">
                                    <span>{{$p->judul->kelompok->dosen->name ?? 'Belum ada dosen pembimbing'}}</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item bg-transparent">
                            <div class="row mx-2 my-2">
                                <div class="col-4 fw-semibold text-secondary">
                                    <span>Ketua Kelompok</span>

                                </div>
                                <div class="col-8">
                                    <span>{{$p->judul->kelompok->getNamaKetua() ?? 'Belum ada ketua'}}</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item bg-transparent">
                            <div class="row mx-2 my-2">
                                <div class="col-4 fw-semibold text-secondary">
                                    <span>Tanggal upload</span>

                                </div>
                                <div class="col-8">
                                    <span>{{$p->created_at->translatedFormat('d F Y') ?? 'Belum ada tanggal' }}</span>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item bg-transparent">
                            <a href="{{route('downloadProposal',[$p->judul->id_kelompok,$p->nama_file])}}" class="d-flex mx-4 justify-content-end">Download Proposal</a>
                        </li>
                    </ul>
                </div>
            @empty
                <div class="card bg-secondary-color shadow-lg my-2">
                    <span class="mx-3 my-3 fw-bold primary-color fs-5">Proposal Terbaru</span>
                    <span class="mx-3 my-3 fw-bold primary-color fs-5 fst-italic">Belum ada proposal</span>
                </div>
            @endforelse
        </div>
        <div class="col-12 col-lg-6 mb-2">
            <div class="card bg-secondary-color shadow-lg my-2">
                <span class="mx-3 my-3 fw-bold primary-color fs-5">Komentar Terbaru</span>
                <ul class="list-group list-group-flush">
                    @forelse ($komentar as $k)
                        <li class="list-group-item bg-transparent">
                            <div class="row mt-2">
                                <div class="col d-flex flex-column">
                                    <div class="content d-flex justify-content-between">
                                        <span class="fw-bold primary-color">
                                            {{ $k->user->getNamaUserAttribute() ?? 'Belum ada dosen'}}
                                        </span>
                                        <span class="text-secondary">
                                            {{ $k->created_at->translatedFormat('d F Y') ?? 'Belum ada tanggal'}}</span>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-9 text-justify">
                                            <span class="text-secondary my-2">
                                                {{ $k->komentar ?? 'Belum ada komentar'}}</span>
                                        </div>
                                        <div class="col-3 d-flex justify-content-end align-items-center">
                                            <a href="{{ route('mahasiswa.detail-kelompok', $k->judul->id_kelompok) }}">Lihat
                                                Komentar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item bg-transparent">
                            Belum ada komentar
                        </li>
                    @endforelse

                </ul>
            </div>
        </div>
    @endsection
