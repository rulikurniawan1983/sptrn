@extends('layouts.app')
@section('title', $titlePage . ' - ' . $item->name)
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0 fw-bold">Detail Profil UMKM</h5>
            <small class="text-muted">Informasi pendaftaran dan berkas legalitas pelaku usaha</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route($route . '.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="ti ti-arrow-left me-1"></i> Kembali ke Monitoring
            </a>
            @can('User Umkm Edit')
                <a href="{{ route($route . '.edit', $item->id) }}" class="btn btn-sm btn-warning">
                    <i class="ti ti-edit me-1"></i> Edit Data
                </a>
            @endcan
            @can('User Umkm Verify')
                <form action="{{ route($route . '.verify', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @if($item->is_active == 0)
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="ti ti-check me-1"></i> Verifikasi & Aktifkan Akun
                        </button>
                    @else
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="ti ti-ban me-1"></i> Nonaktifkan Akun
                        </button>
                    @endif
                </form>
            @endcan
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Profile Info -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                    <span class="fw-semibold text-uppercase small text-muted"><i class="ti ti-id me-1"></i>Data Legalitas & Usaha</span>
                    <div>
                        {!! $item->is_active_badge !!}
                    </div>
                </div>
                <div class="card-body pt-3">
                    <x-detail-item label="Nama UMKM" :value="$item->name"></x-detail-item>
                    <x-detail-item label="Nama Pemilik" :value="$item->nama_pemilik"></x-detail-item>
                    <x-detail-item label="Email">
                        <code class="fs-6 fw-bold">{{ $item->email }}</code>
                    </x-detail-item>
                    <x-detail-item label="NIK Pemilik (KTP)">
                        <span class="text-muted small">Tersimpan terenkripsi</span>
                    </x-detail-item>
                    <x-detail-item label="Kontak WhatsApp">
                        @if($item->no_hp)
                            @php
                                $cleanWa = preg_replace('/[^0-9]/', '', $item->no_hp);
                                if (str_starts_with($cleanWa, '0')) { $cleanWa = '62' . substr($cleanWa, 1); }
                            @endphp
                            <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="btn btn-xs btn-success d-inline-flex align-items-center gap-1">
                                <i class="ti ti-brand-whatsapp"></i> Hubungi {{ $item->no_hp }}
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </x-detail-item>
                    <x-detail-item label="Sektor Usaha">
                        @foreach ($item->users_role as $value)
                            <span class="badge {{ $value->role_id == 101 ? 'bg-warning' : 'bg-info' }} me-1">
                                <i class="ti {{ $value->role_id == 101 ? 'ti-building-cottage' : 'ti-fish' }} me-1"></i>
                                {{ $value->role->name }}
                            </span>
                        @endforeach
                    </x-detail-item>
                    <x-detail-item label="Deskripsi Profil" :value="$item->deskripsi ?? 'Belum ada deskripsi profil.'"></x-detail-item>
                    <x-detail-item label="Tanggal Mendaftar">
                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') . ' WIB (' . \Carbon\Carbon::parse($item->created_at)->diffForHumans() . ')' : '-' }}
                    </x-detail-item>
                </div>
            </div>

            <!-- Berkas NIB Document Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                    <span class="fw-semibold text-uppercase small text-muted"><i class="ti ti-file-text me-1"></i>Dokumen Berkas NIB</span>
                    @if($item->nib_file_url)
                        <a href="{{ route('user-umkm.download-nib', $item->id) }}" target="_blank" class="btn btn-xs btn-primary">
                            <i class="ti ti-download me-1"></i> Unduh Berkas NIB
                        </a>
                    @endif
                </div>
                <div class="card-body pt-3">
                    @if($item->nib_file_url)
                        @php
                            $extension = strtolower(pathinfo($item->nib_file_url, PATHINFO_EXTENSION));
                        @endphp
                        <div class="alert alert-primary d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="ti ti-file-check ti-md text-primary"></i>
                                <div>
                                    <strong class="d-block">Dokumen Berkas NIB Terlampir</strong>
                                    <small class="text-muted">{{ $item->nib_file_name ?? 'Berkas NIB' }}</small>
                                </div>
                            </div>
                            <a href="{{ $item->nib_file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="ti ti-external-link me-1"></i> Buka Berkas
                            </a>
                        </div>

                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                            <div class="text-center p-3 bg-light rounded border">
                                <img src="{{ $item->nib_file_url }}" alt="Berkas NIB" class="img-fluid rounded shadow-sm" style="max-height: 500px;">
                            </div>
                        @elseif($extension === 'pdf')
                            <div class="ratio ratio-16x9 rounded overflow-hidden border">
                                <iframe src="{{ $item->nib_file_url }}" title="Pratinjau Berkas NIB" allowfullscreen></iframe>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="ti ti-file-x ti-xl mb-2 d-block text-secondary"></i>
                            <p class="mb-0">Tidak ada berkas NIB yang diunggah untuk akun ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light py-3">
                    <span class="fw-semibold text-uppercase small text-muted"><i class="ti ti-photo me-1"></i>Foto / Logo UMKM</span>
                </div>
                <div class="card-body text-center pt-3">
                    <div class="avatar avatar-xl mx-auto mb-3" style="width: 100px; height: 100px;">
                        @if($item->file_url)
                            <img src="{{ $item->file_url }}" alt="{{ $item->name }}" class="rounded-circle w-100 h-100" style="object-fit: cover;">
                        @else
                            <span class="avatar-initial rounded-circle bg-label-primary fs-3 d-flex align-items-center justify-content-center">
                                {{ strtoupper(substr($item->name, 0, 2)) }}
                            </span>
                        @endif
                    </div>
                    <h5 class="mb-1 fw-bold">{{ $item->name }}</h5>
                    <p class="text-muted small mb-3">{{ $item->email }}</p>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-3">
                    <span class="fw-semibold text-uppercase small text-muted"><i class="ti ti-history me-1"></i>Riwayat Sistem</span>
                </div>
                <div class="card-body pt-3">
                    <x-detail-list-action-time :item="$item" />
                </div>
                </div>
            </div>

            @if($item->umkmLegalitas->count() > 0)
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                    <span class="fw-semibold text-uppercase small text-muted"><i class="ti ti-certificate me-1"></i>Dokumen Legalitas</span>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Jenis Legalitas</th>
                                    <th>Nomor Dokumen</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($item->umkmLegalitas as $legalitas)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar avatar-sm bg-label-info rounded-3">
                                                    <i class="ti ti-certificate"></i>
                                                </div>
                                                <strong>{{ $legalitas->jenis_legalitas }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ $legalitas->nomor_dokumen ?? '-' }}</td>
                                        <td>
                                            @if($legalitas->file_legalitas)
                                                <a href="{{ asset('storage/umkm-legalitas/' . $legalitas->file_legalitas) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="ti ti-download"></i> Download
                                                </a>
                                            @else
                                                <span class="text-muted">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($legalitas->is_verified)
                                                <span class="badge bg-label-success"><i class="ti ti-check me-1"></i> Terverifikasi</span>
                                            @else
                                                <span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i> Menunggu</span>
                                            @endif
                                        </td>
                                        <td>{{ $legalitas->created_at ? \Carbon\Carbon::parse($legalitas->created_at)->format('d M Y') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="ti ti-file-off fs-1 mb-3 d-block"></i>
                                                <p>Belum ada dokumen legalitas.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($item->perizinans->count() > 0)
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                    <span class="fw-semibold text-uppercase small text-muted"><i class="ti ti-file-text me-1"></i>Dokumen Perizinan</span>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Nama Perizinan</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($item->perizinans as $perizinan)
                                    <tr>
                                        <td class="ps-4"><strong>{{ $perizinan->nama ?? '-' }}</strong></td>
                                        <td>
                                            @if($perizinan->file)
                                                <div class="d-flex gap-1">
                                                    <a href="{{ asset('storage/perizinan/' . $perizinan->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="ti ti-eye"></i> Lihat
                                                    </a>
                                                    <a href="{{ asset('storage/perizinan/' . $perizinan->file) }}" download class="btn btn-sm btn-outline-secondary">
                                                        <i class="ti ti-download"></i> Download
                                                    </a>
                                                </div>
                                            @else
                                                <span class="text-muted">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ ($perizinan->status ?? '') == 'Sudah Diunggah' ? 'bg-label-success' : 'bg-label-danger' }}">
                                                {{ $perizinan->status ?? 'Tidak Diketahui' }}
                                            </span>
                                        </td>
                                        <td>{{ $perizinan->created_at ? \Carbon\Carbon::parse($perizinan->created_at)->format('d M Y') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="ti ti-file-off fs-1 mb-3 d-block"></i>
                                                <p>Belum ada dokumen perizinan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endsection

