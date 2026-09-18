@extends('layouts.app')
@section('title', $titlePage)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-3">Legalitas & Sertifikasi Usaha</h3>
                <p class="text-muted">Kelola dokumen legalitas dan sertifikasi usaha Anda.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Total Dokumen</h6>
                        <h3 class="fw-bold text-primary mb-0">{{ $stats['total'] ?? 0 }}</h3>
                    </div>
                    <div class="avatar avatar-lg bg-label-primary rounded-3">
                        <i class="ti ti-file-text fs-2"></i>
                    </div>
                </div>
                <small class="text-muted">Semua dokumen legalitas</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Menunggu Verifikasi</h6>
                        <h3 class="fw-bold text-danger mb-0">{{ $stats['pending'] ?? 0 }}</h3>
                    </div>
                    <div class="avatar avatar-lg bg-label-danger rounded-3">
                        <i class="ti ti-clock fs-2"></i>
                    </div>
                </div>
                <small class="text-danger fw-semibold">Perlu persetujuan admin</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Terverifikasi</h6>
                        <h3 class="fw-bold text-success mb-0">{{ $stats['verified'] ?? 0 }}</h3>
                    </div>
                    <div class="avatar avatar-lg bg-label-success rounded-3">
                        <i class="ti ti-check fs-2"></i>
                    </div>
                </div>
                <small class="text-success fw-semibold">Dokumen sudah disetujui</small>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center justify-content-center">
                @can('Umkm Legalitas Add')
                <a href="{{ route('umkm-legalitas.create') }}" class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2">
                    <i class="ti ti-plus"></i> Tambah Dokumen
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom p-4">
                <h5 class="mb-0 fw-bold">Daftar Dokumen Legalitas</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="legalitasTable">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Jenis Legalitas</th>
                                <th>Nomor Dokumen</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Tanggal Upload</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar avatar-sm bg-label-info rounded-3">
                                                <i class="ti ti-certificate"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $item->jenis_legalitas }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->nomor_dokumen ?? '-' }}</td>
                                    <td>
                                        @if($item->file_legalitas)
                                            <a href="{{ asset('storage/umkm-legalitas/' . $item->file_legalitas) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-download"></i> Download
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->is_verified)
                                            <span class="badge bg-label-success"><i class="ti ti-check me-1"></i>Terverifikasi</span>
                                        @else
                                            <span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i>Menunggu Verifikasi</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex gap-2 justify-content-end">
                                            @can('Umkm Legalitas Detail')
                                                <a href="{{ route('umkm-legalitas.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            @endcan
                                            @can('Umkm Legalitas Edit')
                                                <a href="{{ route('umkm-legalitas.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                            @endcan
                                            @can('Umkm Legalitas Delete')
                                                <form action="{{ route('umkm-legalitas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="ti ti-file-off fs-1 mb-3 d-block"></i>
                                            <p>Belum ada dokumen legalitas yang diupload.</p>
                                            @can('Umkm Legalitas Add')
                                                <a href="{{ route('umkm-legalitas.create') }}" class="btn btn-primary">
                                                    <i class="ti ti-plus me-1"></i> Tambah Dokumen Pertama
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#legalitasTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[4, 'desc']],
        columnDefs: [
            { orderable: false, targets: [5] }
        ]
    });
});
</script>
@endpush
