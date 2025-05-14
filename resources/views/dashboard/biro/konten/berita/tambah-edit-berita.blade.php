@extends('dashboard.assets.main')
@section('title', 'Biro - Tambah atau Edit Berita')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('biro.manajemen-berita') }}"><span class="primary-color">Manajemen
                        Berita</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah atau Edit Berita</li>
        </ol>
    </nav>
    <div class="container-fluid my-4">
        <h2 class="mb-4">Form Berita</h2>
        <form action="{{ isset($berita) ? route('biro.store-update-berita', $berita->id) : route('biro.store-berita') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($berita))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                    name="gambar" {{ isset($berita) ? '' : 'required' }}>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if (isset($berita) && $berita->gambar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" style="max-width: 200px;">
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title', $berita->title ?? '') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi</label>
                <input id="isi" type="hidden" name="isi" value="{{ old('isi', $berita->isi ?? '') }}">
                <trix-editor input="isi" style="min-height: 400px;"></trix-editor>
                @error('isi')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                    name="tanggal" value="{{ old('tanggal', isset($berita) ? $berita->tanggal : '') }}"
                    required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($berita) ? 'Update' : 'Submit' }}</button>
        </form>
    </div>
@endsection
