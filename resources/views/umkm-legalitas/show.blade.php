@extends('layouts.app')
@section('title', $titlePage)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-1">Detail Dokumen Legalitas</h3>
                        <p class="text-muted mb-0">Informasi lengkap dokumen legalitas dan sertifikasi usaha.</p>
                    </div>
                    <div>
                        <a href="{{ route('umkm-legalitas.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Jenis Legalitas</label>
                            <p class="fw-bold mb-0">{{ $item->jenis_legalitas }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Nomor Dokumen</label>
                            <p class="fw-bold mb-0">{{ $item->nomor_dokumen ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Status</label>
                            <p class="mb-0">
                                @if($item->is_verified)
                                    <span class="badge bg-label-success"><i class="ti ti-check me-1"></i>Terverifikasi</span>
                                @else
                                    <span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i>Menunggu Verifikasi</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">Tanggal Upload</label>
                            <p class="fw-bold mb-0">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') : '-' }}</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="text-muted small text-uppercase fw-semibold">File Dokumen</label>
                            <div class="mt-2">
                                @if($item->file_legalitas)
                                    <a href="{{ asset('storage/umkm-legalitas/' . $item->file_legalitas) }}" target="_blank" class="btn btn-primary">
                                        <i class="ti ti-download me-1"></i> Download / Lihat File
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($item->is_verified && $item->verified_at)
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small text-uppercase fw-semibold">Diverifikasi Pada</label>
                                <p class="fw-bold mb-0">{{ \Carbon\Carbon::parse($item->verified_at)->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                    @if($item->verifier)
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small text-uppercase fw-semibold">Diverifikasi Oleh</label>
                                <p class="fw-bold mb-0">{{ $item->verifier->name }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Aksi</h5>
                <div class="d-grid gap-2">
                    @can('Umkm Legalitas Edit')
                        <a href="{{ route('umkm-legalitas.edit', $item->id) }}" class="btn btn-warning d-flex align-items-center justify-content-center gap-2">
                            <i class="ti ti-edit"></i> Edit Dokumen
                        </a>
                    @endcan
                    @can('Umkm Legalitas Delete')
                        <form action="{{ route('umkm-legalitas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-trash"></i> Hapus Dokumen
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
