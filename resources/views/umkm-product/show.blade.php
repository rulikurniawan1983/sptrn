@extends('layouts.app')
@section('title', $titlePage)

@section('content')
    <div class="card shadow-sm border-0 mb-4">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row g-4">
                <!-- Sisi Kiri: Foto Produk & Link Publik -->
                <div class="col-lg-4 text-center">
                    <div class="p-3 border rounded bg-light mb-3 position-relative">
                        <img src="{{ $item->foto_produk_url }}" alt="{{ $item->nama_produk }}" class="img-fluid rounded shadow-sm" style="max-height: 280px; width: 100%; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            @if($item->is_active == 1)
                                <span class="badge bg-success shadow"><i class="ti ti-check me-1"></i>Aktif / Tayang</span>
                            @else
                                <span class="badge bg-danger shadow"><i class="ti ti-clock me-1"></i>Menunggu Verifikasi</span>
                            @endif
                        </div>
                    </div>

                    @can('Umkm Product Verify')
                        <form action="{{ route('umkm-product.verify', $item->id) }}" method="POST" class="mb-2">
                            @csrf
                            @if($item->is_active == 1)
                                <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="ti ti-ban"></i>
                                    <span>Nonaktifkan Tayangan Produk</span>
                                </button>
                            @else
                                <button type="submit" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="ti ti-check"></i>
                                    <span>Verifikasi & Tayangkan Produk</span>
                                </button>
                            @endif
                        </form>
                    @endcan

                    @if($item->is_active == 1)
                        <a href="{{ route('front.umkm-product-detail', $item->id) }}" target="_blank" class="btn btn-primary w-100 mb-2 d-flex align-items-center justify-content-center gap-2">
                            <i class="ti ti-external-link"></i>
                            <span>Lihat di Halaman Publik</span>
                        </a>
                    @endif

                    @if($item->user && $item->user->no_hp)
                        @php
                            $cleanPhone = preg_replace('/[^0-9]/', '', $item->user->no_hp);
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            }
                        @endphp
                        <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Halo '.$item->user->name.', saya dari Admin SPARTAN terkait produk '.$item->nama_produk.'.') }}" target="_blank" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2">
                            <i class="ti ti-brand-whatsapp"></i>
                            <span>Hubungi Pelaku UMKM</span>
                        </a>
                    @endif
                </div>

                <!-- Sisi Kanan: Rincian Produk & Pelaku UMKM -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-primary mb-0">Informasi Produk UMKM</h5>
                        @if($item->is_active == 1)
                            <span class="badge bg-label-success fs-7"><i class="ti ti-circle-check me-1"></i>Sudah Diverifikasi &amp; Tayang</span>
                        @else
                            <span class="badge bg-label-danger fs-7"><i class="ti ti-alert-triangle me-1"></i>Menunggu Verifikasi Admin</span>
                        @endif
                    </div>

                    <x-detail-item label="Nama Produk">
                        <span class="fs-6 fw-bold text-dark">{{ $item->nama_produk }}</span>
                    </x-detail-item>

                    <x-detail-item label="Status Verifikasi">
                        @if($item->is_active == 1)
                            <span class="badge bg-success"><i class="ti ti-check me-1"></i>Disetujui &amp; Tayang di Portal Publik</span>
                        @else
                            <span class="badge bg-danger"><i class="ti ti-clock me-1"></i>Belum Diverifikasi (Tidak Tampil di Publik)</span>
                        @endif
                    </x-detail-item>

                    <x-detail-item label="Harga Satuan">
                        <span class="badge bg-label-danger fs-6 fw-bold">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                        <span class="text-muted ms-1">/ {{ $item->satuan ?? 'Satuan' }}</span>
                    </x-detail-item>

                    <x-detail-item label="Satuan">
                        <span>{{ $item->satuan ?? '-' }}</span>
                    </x-detail-item>

                    <x-detail-item label="Pelaku Usaha UMKM">
                        <div class="d-flex align-items-center gap-2">
                            <i class="ti ti-building-store text-warning fs-5"></i>
                            <strong>{{ $item->user->name ?? '-' }}</strong>
                            @if($item->user)
                                <a href="{{ route('user-umkm.show', $item->user->id) }}" class="btn btn-xs btn-outline-primary ms-2">
                                    <i class="ti ti-user me-1"></i>Detail Profil UMKM
                                </a>
                            @endif
                        </div>
                    </x-detail-item>

                    <x-detail-item label="Nomor Induk Berusaha (NIB)">
                        <code>{{ $item->user->email ?? '-' }}</code>
                    </x-detail-item>

                    <x-detail-item label="Kontak WhatsApp">
                        @if($item->user && $item->user->no_hp)
                            <span class="text-success fw-semibold"><i class="ti ti-brand-whatsapp me-1"></i>{{ $item->user->no_hp }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </x-detail-item>

                    <x-detail-item label="Deskripsi Produk">
                        <div class="p-3 bg-light rounded text-muted" style="white-space: pre-line; line-height: 1.6;">
                            {{ $item->deskripsi ?? 'Belum ada deskripsi.' }}
                        </div>
                    </x-detail-item>

                    <div class="mt-4 pt-3 border-top">
                        <p class="small text-uppercase text-muted fw-semibold">Informasi Log Sistem</p>
                        <x-detail-list-action-time :item="$item" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
