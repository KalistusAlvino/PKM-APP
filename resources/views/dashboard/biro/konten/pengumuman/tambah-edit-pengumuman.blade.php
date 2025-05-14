@extends('dashboard.assets.main')
@section('title', 'Biro - Tambah atau Edit Berita')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('biro.manajemen-pengumuman') }}"><span
                        class="primary-color">Manajemen
                        Pengumuman</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah atau Edit Pengumuman</li>
        </ol>
    </nav>
    <div class="container-fluid my-4">
        <h2 class="mb-4">Form Pengumuman</h2>
        <form
            action="{{ isset($pengumuman) ? route('biro.store-update-pengumuman', $pengumuman->id) : route('biro.store-pengumuman') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($pengumuman))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                    name="gambar" {{ isset($pengumuman) ? '' : 'required' }}>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (isset($pengumuman) && $pengumuman->gambar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="Gambar Pengumuman"
                            style="max-width: 200px;">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title', $pengumuman->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi</label>
                <input id="isi" type="hidden" name="isi" value="{{ old('isi', $pengumuman->isi ?? '') }}">
                <trix-editor input="isi" style="min-height: 300px;"></trix-editor>
                @error('isi')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                    name="tanggal"
                    value="{{ old('tanggal', isset($pengumuman) ? $pengumuman->tanggal : '') }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($pengumuman) ? 'Update' : 'Submit' }}</button>
        </form>
    </div>
@endsection
