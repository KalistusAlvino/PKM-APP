@extends('dashboard.assets.main')
@section('title', 'Managemen Akun Koordinator')
@section('content')
    <div class="card h-25 bg-third-color mb-4">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Manajemen Akun Koordinator</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Buat, tambah dan edit akun Koordinator</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600'}}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>

    <div class="card h-25 bg-third-color mb-4">
        <div class="title d-flex justify-content-between align-items-center mx-2 my-4">
            <span class="fw-bold fs-5 mx-4 primary-color text-center">DATA KOORDINATOR</span>
            <button type="button" class="btn bg-primary-color mx-4 my-2" data-bs-toggle="modal"
                data-bs-target="#tambahKoordinatorModal">
                <i class="fa-solid fa-user-plus secondary-color"></i> <span
                    class="secondary-color d-none d-md-inline">Tambah Koordinator</span>
            </button>
        </div>
        <div class="table-responsive mx-4 my-1">
            <table class="table bg-table-third-color table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col" class="d-flex justify-content-end me-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($koordinator as $idx => $k)
                        <tr>
                            <th scope="row">{{ $idx + 1 }}</th>
                            <td>{{ $k->user->username }}</td>
                            <td>{{ $k->name }}</td>
                            <td class="d-flex justify-content-end gap-2 me-3">
                                <button type="button" class="btn bg-primary-color" data-bs-toggle="modal"
                                    data-bs-target="#askingModal">
                                    <i class="fa-solid fa-pen-to-square secondary-color"></i>
                                </button><button type="button" class="btn bg-danger" data-bs-toggle="modal"
                                    data-bs-target="#askingModal">
                                    <i class="fa-solid fa-trash-can secondary-color"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td> <em>Belum ada data dosen</em></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('dashboard.biro.account.modalkoordinator.tambah')
@endsection
