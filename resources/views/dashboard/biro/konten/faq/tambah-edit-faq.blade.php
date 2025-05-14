@extends('dashboard.assets.main')
@section('title', 'Biro - Tambah atau Edit FAQ')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('biro.manajemen-faq') }}"><span class="primary-color">Manajemen
                        FAQ</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah atau Edit FAQ</li>
        </ol>
    </nav>
    <div class="container-fluid my-4">
        <h2 class="mb-4">Form FAQ</h2>
        <form action="{{ isset($faq) ? route('biro.store-update-faq', $faq->id) : route('biro.store-faq') }}" method="POST">
            @csrf
            @if (isset($faq))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" rows="5"
                    required>{{ old('pertanyaan', $faq->pertanyaan ?? '') }}</textarea>
                @error('pertanyaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jawaban" class="form-label">Jawaban</label>
                <textarea class="form-control @error('jawaban') is-invalid @enderror" id="jawaban" name="jawaban" rows="5"
                    required>{{ old('jawaban', $faq->jawaban ?? '') }}</textarea>
                @error('jawaban')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($faq) ? 'Update' : 'Submit' }}</button>
        </form>
    </div>
@endsection
