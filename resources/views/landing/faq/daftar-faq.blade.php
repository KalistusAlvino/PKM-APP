@extends('assets.main')
@section('title', 'PKM UKDW | Daftar FAQ')
@section('content')
    <div class="min-vh-100" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
        <div class="container py-5">
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center border-bottom border-3 pb-3">
                    <h3 class="primary-color fw-bold d-flex align-items-center">
                        <i class="fa-regular fa-circle-question me-3 fs-2"></i>
                        Daftar FAQ
                    </h3>
                </div>
            </div>
            @forelse ($faq as $item)
                <div class="accordion accordion-flush shadow-lg mb-3" id="accordionFlushExample{{ $item->id }}"
                    style="width: 100%;">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{ $item->id }}" aria-expanded="false"
                                aria-controls="flush-collapse{{ $item->id }}">
                                {{ $item->pertanyaan }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $item->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample{{ $item->id }}">
                            <div class="accordion-body text-secondary">{{ $item->jawaban }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center" role="alert">
                    <h5 class="alert-heading">Tidak Ada FAQ</h5>
                    <p>Belum ada pertanyaan yang tersedia saat ini. Silakan cek kembali nanti.</p>
                    <hr>
                    <p class="mb-0">Anda juga dapat menghubungi kami untuk informasi lebih lanjut.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
