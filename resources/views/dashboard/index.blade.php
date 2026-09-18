@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    @if(@$is_umkm)
        <!-- UMKM E-commerce Style Dashboard -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden welcome-card-gradient">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="avatar avatar-xl" style="width: 64px; height: 64px;">
                                        @if(Auth::user()->file_url)
                                            <img src="{{ Auth::user()->file_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle w-100 h-100" style="object-fit: cover;">
                                        @else
                                            <span class="avatar-initial rounded-circle bg-label-primary fs-3 d-flex align-items-center justify-content-center">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="text-white mb-1 fw-bold">
                                            {{ Auth::user()->name }}
                                        </h3>
                                        <small class="text-white-50">Selamat Datang di Portal UMKM, {{ Auth::user()->name }}! 🏪</small>
                                    </div>
                                </div>
                                <p class="text-white-50 mb-0">
                                    Kelola produk Anda dengan mudah dan hubungkan langsung dengan calon pembeli via WhatsApp.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $pendingProductCount = auth()->user()->umkm_products()->where('is_active', 0)->count();
            $activeProductCount = auth()->user()->umkm_products()->where('is_active', 1)->count();
        @endphp

        @if($pendingProductCount > 0 || $activeProductCount > 0)
        <div class="row mb-4">
            <div class="col-12">
                @if($pendingProductCount > 0)
                <div class="alert alert-warning d-flex align-items-center justify-content-between shadow-sm border-0 mb-2" role="alert" style="background: linear-gradient(135deg, #ff9f43 0%, #ee5a24 100%); color: #fff;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar avatar-md bg-white text-warning rounded-circle d-flex align-items-center justify-content-center shadow-sm">
                            <i class="ti ti-clock-hour-4 fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-0 fw-bold">Produk Menunggu Verifikasi</h6>
                            <small class="text-white-50">Anda memiliki <strong>{{ $pendingProductCount }}</strong> produk yang sedang menunggu verifikasi admin.</small>
                        </div>
                    </div>
                    <a href="{{ route('umkm-product.index') }}" class="btn btn-light btn-sm fw-semibold text-warning d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="ti ti-eye"></i> <span>Lihat Produk</span>
                    </a>
                </div>
                @endif

                @if($activeProductCount > 0)
                <div class="alert alert-success d-flex align-items-center justify-content-between shadow-sm border-0" role="alert" style="background: linear-gradient(135deg, #26de81 0%, #20bf6b 100%); color: #fff;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar avatar-md bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow-sm">
                            <i class="ti ti-check fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-0 fw-bold">Produk Sudah Tayang</h6>
                            <small class="text-white-50"><strong>{{ $activeProductCount }}</strong> produk Anda sudah tayang di Etalase SPARTAN.</small>
                        </div>
                    </div>
                    <a href="{{ route('front.umkm-info') }}" target="_blank" class="btn btn-light btn-sm fw-semibold text-success d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="ti ti-external-link"></i> <span>Lihat di Etalase</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endif

        <div class="row g-4 mb-4">
            <!-- Stat: Total Produk -->
            <div class="col-md-4">
                <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon bg-primary-subtle">
                                    <i class="ti ti-package text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="stat-content">
                            <h2 class="stat-number mb-2 text-primary">
                                {{ $myProductCount }}
                            </h2>
                            <p class="stat-label text-muted mb-1 fw-medium">Total Produk Saya</p>
                            <small class="text-muted">
                                <i class="ti ti-circle-check me-1 text-success"></i>
                                Ditampilkan di Etalase SPARTAN
                            </small>
                        </div>
                    </div>
                    <div class="card-decorative-shape bg-primary"></div>
                </div>
            </div>

            <!-- Stat: Status Akun -->
            <div class="col-md-4">
                <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon bg-success-subtle">
                                    <i class="ti ti-shield-check text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="stat-content">
                            <h2 class="stat-number mb-2 text-success">
                                Aktif
                            </h2>
                            <p class="stat-label text-muted mb-1 fw-medium">Status Toko</p>
                            <small class="text-muted">
                                <i class="ti ti-device-mobile text-primary me-1"></i>
                                WhatsApp Terhubung: {{ Auth::user()->no_hp }}
                            </small>
                        </div>
                    </div>
                    <div class="card-decorative-shape bg-success"></div>
                </div>
            </div>

            <!-- Stat: Kunjungan -->
            <div class="col-md-4">
                <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon bg-warning-subtle">
                                    <i class="ti ti-shopping-cart text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="stat-content">
                            <h2 class="stat-number mb-2 text-warning">
                                E-Commerce
                            </h2>
                            <p class="stat-label text-muted mb-1 fw-medium">Metode Transaksi</p>
                            <small class="text-muted">
                                <i class="ti ti-external-link me-1"></i>
                                Klik Tombol Beli menuju WhatsApp
                            </small>
                        </div>
                    </div>
                    <div class="card-decorative-shape bg-warning"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="mb-3 fw-bold"><i class="ti ti-settings me-1"></i> Menu Cepat Pengelolaan Toko</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('umkm-product.index') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                            <i class="ti ti-list"></i> Lihat Daftar Produk Saya
                        </a>
                        <a href="{{ route('umkm-product.create') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                            <i class="ti ti-plus"></i> Tambah Produk Baru
                        </a>
                        <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                            <i class="ti ti-user"></i> Pengaturan Profil & Nomor WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="mb-3 fw-bold"><i class="ti ti-certificate me-1"></i> Dokumen Legalitas</h5>
                    <p class="text-muted mb-3">Kelola dokumen legalitas dan sertifikasi usaha Anda.</p>

                    @php
                        $pendingLegalitas = $umkmLegalitas->where('is_verified', 0)->count();
                        $verifiedLegalitas = $umkmLegalitas->where('is_verified', 1)->count();
                    @endphp
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-primary-subtle">
                                <div class="avatar avatar-lg bg-primary rounded-circle"><i class="ti ti-file-text text-white"></i></div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-primary">{{ $umkmLegalitas->count() }}</h6>
                                    <small class="text-muted">Total Dokumen</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-danger-subtle">
                                <div class="avatar avatar-lg bg-danger rounded-circle"><i class="ti ti-clock text-white"></i></div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-danger">{{ $pendingLegalitas }}</h6>
                                    <small class="text-muted">Menunggu Verifikasi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-success-subtle">
                                <div class="avatar avatar-lg bg-success rounded-circle"><i class="ti ti-check text-white"></i></div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-success">{{ $verifiedLegalitas }}</h6>
                                    <small class="text-muted">Terverifikasi</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-bold mb-3"><i class="ti ti-upload me-1"></i> Upload Dokumen Baru</h6>
                            <form action="{{ route('umkm-legalitas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="jenis_legalitas" class="form-label fw-semibold">Jenis Legalitas <span class="text-danger">*</span></label>
                                        <select class="form-select @error('jenis_legalitas') is-invalid @enderror" id="jenis_legalitas" name="jenis_legalitas" required>
                                            <option value="">-- Pilih Jenis Legalitas --</option>
                                            <option value="NIB (Nomor Induk Berusaha)">NIB (Nomor Induk Berusaha)</option>
                                            <option value="KUSUKA (Kartu Pelaku Usaha Kelautan & Perikanan)">KUSUKA</option>
                                            <option value="SKP (Sertifikat Kelayakan Pengolahan)">SKP</option>
                                            <option value="NKV (Nomor Kontrol Veteriner)">NKV</option>
                                            <option value="Sertifikat Halal (BPJPH / MUI)">Sertifikat Halal</option>
                                            <option value="SPP-PIRT (Pangan Industri Rumah Tangga)">SPP-PIRT</option>
                                            <option value="BPOM (Izin Edar BPOM MD/ML)">BPOM</option>
                                            <option value="HAKI (Hak Kekayaan Intelektual)">HAKI</option>
                                            <option value="SNI (Standar Nasional Indonesia)">SNI</option>
                                            <option value="HACCP (Hazard Analysis Critical Control Point)">HACCP</option>
                                            <option value="ISO (ISO 9001 / ISO 22000 / Lainnya)">ISO</option>
                                        </select>
                                        @error('jenis_legalitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomor_dokumen" class="form-label fw-semibold">Nomor Dokumen</label>
                                        <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" id="nomor_dokumen" name="nomor_dokumen" value="{{ old('nomor_dokumen') }}" placeholder="Contoh: 1234567890">
                                        @error('nomor_dokumen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="file_legalitas" class="form-label fw-semibold">File Dokumen</label>
                                        <input type="file" class="form-control @error('file_legalitas') is-invalid @enderror" id="file_legalitas" name="file_legalitas" accept=".pdf,.jpg,.jpeg,.png">
                                        <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Maks 5MB.</small>
                                        @error('file_legalitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti ti-device-floppy me-1"></i> Upload
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="legalitasTable">
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
                                @forelse($umkmLegalitas as $item)
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
                                                <span class="badge bg-label-success"><i class="ti ti-check me-1"></i> Terverifikasi</span>
                                            @else
                                                <span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i> Menunggu</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="ti ti-file-off fs-1 mb-3 d-block"></i>
                                                <p>Belum ada dokumen legalitas. Upload dokumen pertama Anda di atas.</p>
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

         @if($umkmLegalitasNib->count() > 0)
         <div class="row mt-2">
             <div class="col-12">
                 <div class="card border-0 shadow-sm p-4">
                     <h5 class="mb-3 fw-bold"><i class="ti ti-id me-1"></i> Dokumen Berkas NIB</h5>
                     <p class="text-muted mb-3">Dokumen NIB (Nomor Induk Berusaha) yang telah diupload.</p>
                     <div class="table-responsive">
                         <table class="table table-hover align-middle mb-0">
                             <thead class="bg-light">
                                 <tr>
                                     <th class="ps-4">Jenis</th>
                                     <th>Nomor Dokumen</th>
                                     <th>File</th>
                                     <th>Status</th>
                                     <th>Tanggal Upload</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @forelse($umkmLegalitasNib as $item)
                                     <tr>
                                         <td class="ps-4"><strong>{{ $item->jenis_legalitas }}</strong></td>
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
                                                 <span class="badge bg-label-success"><i class="ti ti-check me-1"></i> Terverifikasi</span>
                                             @else
                                                 <span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i> Menunggu</span>
                                             @endif
                                         </td>
                                         <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                                     </tr>
                                 @empty
                                     <tr>
                                         <td colspan="5" class="text-center py-4">
                                             <div class="text-muted">
                                                 <i class="ti ti-file-off fs-1 mb-3 d-block"></i>
                                                 <p>Belum ada dokumen NIB.</p>
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
         @endif

     @else
        <!-- Original Admin / UPT Dashboard -->
        @php
            $pendingUmkmDashboardCount = \App\Models\User::where('is_active', 0)
                ->whereHas('users_role', function($q) { $q->whereIn('role_id', [101, 102]); })
                ->count();
        @endphp
        @if($pendingUmkmDashboardCount > 0)
            <div class="alert alert-danger d-flex flex-wrap align-items-center justify-content-between shadow-sm border-0 mb-4 p-3 rounded-3" role="alert" style="background: linear-gradient(135deg, #ea5455 0%, #cc3333 100%); color: #fff;">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar avatar-md bg-white text-danger rounded-circle d-flex align-items-center justify-content-center shadow-sm">
                        <i class="ti ti-bell-ringing fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-0 fw-bold">Pemberitahuan Pendaftaran UMKM Baru</h6>
                        <small class="text-white-50">Terdapat <strong>{{ $pendingUmkmDashboardCount }}</strong> pelaku UMKM baru mendaftar dan menunggu verifikasi berkas NIB.</small>
                    </div>
                </div>
                <a href="{{ route('user-umkm.index') }}" class="btn btn-light btn-sm fw-semibold text-danger d-inline-flex align-items-center gap-1 shadow-sm mt-2 mt-md-0">
                    <i class="ti ti-user-check"></i> <span>Verifikasi Sekarang</span> <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        @endif

        <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden welcome-card-gradient">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-white mb-2 fw-bold">
                                Selamat Datang, {{ Auth::user()->name }}! 👋
                            </h3>
                            <p class="text-white-50 mb-0">
                                Berikut adalah ringkasan data terkini dari sistem Anda
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-4">
            <a href="" class="text-decoration-none">
                <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon bg-primary-subtle">
                                    <i class="ti ti-building-cottage text-primary"></i>
                                </div>
                            </div>
                        </div>
                        <div class="stat-content">
                            <h2 class="stat-number mb-2 text-primary">
                                {{ $infoCard['countPeternakan'] }}
                            </h2>
                            <p class="stat-label text-muted mb-1 fw-medium">Jumlah Peternakan</p>
                            <small class="text-muted">
                                <i class="ti ti-calendar-month me-1"></i>
                                Data per hari ini
                            </small>
                        </div>
                    </div>
                    <div class="card-decorative-shape bg-primary"></div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-4">
            <a href="" class="text-decoration-none">
                <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon-wrapper">
                                <div class="stat-icon bg-warning-subtle">
                                    <i class="ti ti-fish text-warning"></i>
                                </div>
                            </div>
                        </div>
                        <div class="stat-content">
                            <h2 class="stat-number mb-2 text-warning">
                                {{ $infoCard['countPerikanan'] }}
                            </h2>
                            <p class="stat-label text-muted mb-1 fw-medium">Jumlah Perikanan</p>
                            <small class="text-muted">
                                <i class="ti ti-calendar-month me-1"></i>
                                Data per hari ini
                            </small>
                        </div>
                    </div>
                    <div class="card-decorative-shape bg-warning"></div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon bg-success-subtle">
                                <i class="ti ti-database text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h2 class="stat-number mb-2 text-success">
                            {{ $infoCard['countPeternakan'] + $infoCard['countPerikanan'] }}
                        </h2>
                        <p class="stat-label text-muted mb-1 fw-medium">Total Data</p>
                        <small class="text-muted">
                            <i class="ti ti-circle-check me-1"></i>
                            Semua kategori
                        </small>
                    </div>
                </div>
                <div class="card-decorative-shape bg-success"></div>
            </div>
        </div>

        <!-- Start: UMKM Peternakan -->
        <div class="col-sm-6 col-lg-4">
            <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon bg-info-subtle">
                                <i class="ti ti-building-store text-info"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h2 class="stat-number mb-2 text-info">
                            {{ $infoCard['countUmkmPeternakan'] }}
                        </h2>
                        <p class="stat-label text-muted mb-1 fw-medium">UMKM Peternakan</p>
                        <small class="text-muted">
                            <i class="ti ti-circle-check me-1"></i>
                            Khusus Peternakan
                        </small>
                    </div>
                </div>
                <div class="card-decorative-shape bg-info"></div>
            </div>
        </div>

        <!-- Start: UMKM Perikanan -->
        <div class="col-sm-6 col-lg-4">
            <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon bg-info-subtle">
                                <i class="ti ti-building-store text-info"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h2 class="stat-number mb-2 text-info">
                            {{ $infoCard['countUmkmPerikanan'] }}
                        </h2>
                        <p class="stat-label text-muted mb-1 fw-medium">UMKM Perikanan</p>
                        <small class="text-muted">
                            <i class="ti ti-circle-check me-1"></i>
                            Khusus Perikanan
                        </small>
                    </div>
                </div>
                <div class="card-decorative-shape bg-info"></div>
            </div>
        </div>

        <!-- Start: UMKM Keduanya -->
        <div class="col-sm-6 col-lg-4">
            <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon bg-info-subtle">
                                <i class="ti ti-building-store text-info"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h2 class="stat-number mb-2 text-info">
                            {{ $infoCard['countUmkmKeduanya'] }}
                        </h2>
                        <p class="stat-label text-muted mb-1 fw-medium">UMKM Campuran</p>
                        <small class="text-muted">
                            <i class="ti ti-circle-check me-1"></i>
                            Peternakan & Perikanan
                        </small>
                    </div>
                </div>
                <div class="card-decorative-shape bg-info"></div>
            </div>
        </div>
        <!-- End: Total UMKM -->

        <!-- Start: Total Produk -->
        <div class="col-sm-6 col-lg-3">
            <div class="card stat-card border-0 shadow-sm h-100 overflow-hidden position-relative">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="stat-icon-wrapper">
                            <div class="stat-icon bg-danger-subtle">
                                <i class="ti ti-package text-danger"></i>
                            </div>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h2 class="stat-number mb-2 text-danger">
                            {{ $infoCard['countProduct'] }}
                        </h2>
                        <p class="stat-label text-muted mb-1 fw-medium">Total Produk</p>
                        <small class="text-muted">
                            <i class="ti ti-circle-check me-1"></i>
                            Produk Aktif
                        </small>
                    </div>
                </div>
                <div class="card-decorative-shape bg-danger"></div>
            </div>
        </div>
        <!-- End: Total Produk -->

    </div>

    @php
        $isSuperAdmin = auth()->check() && \App\Models\UsersRole::where('users_id', auth()->id())
            ->whereIn('role_id', [11])
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['Super Admin']);
            })
            ->exists();
    @endphp
    @if($isSuperAdmin)
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center gap-2">
                            <i class="ti ti-clock-hour-4 text-primary"></i>
                            Aktivitas Terkini
                        </h5>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="activity-timeline">
                        @forelse($recentActivities as $activity)
                            <div class="activity-item">
                                <div class="activity-icon bg-{{ $activity['color'] }}-subtle">
                                    <i class="ti {{ $activity['icon'] }} text-{{ $activity['color'] }}"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-1 fw-medium">{{ $activity['description'] }}</p>
                                    <small class="text-muted">{{ $activity['time'] }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="activity-item">
                                <div class="activity-icon bg-info-subtle">
                                    <i class="ti ti-info-circle text-info"></i>
                                </div>
                                <div class="activity-content">
                                    <p class="mb-1 fw-medium">Tidak ada aktivitas terkini</p>
                                    <small class="text-muted">Aktivitas akan muncul di sini</small>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom p-4">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i class="ti ti-chart-pie text-primary"></i>
                        Statistik Ringkas
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stats-mini-card p-3 rounded-3 bg-primary-subtle">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="ti ti-users text-primary"></i>
                                    <span class="text-muted small">Pengguna</span>
                                </div>
                                <h4 class="mb-0 text-primary stat-number-small">{{ $statistics['totalUsers'] }}</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stats-mini-card p-3 rounded-3 bg-success-subtle">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="ti ti-check-circle text-success"></i>
                                    <span class="text-muted small">Aktif</span>
                                </div>
                                <h4 class="mb-0 text-success stat-number-small">{{ $statistics['activePercentage'] }}%</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stats-mini-card p-3 rounded-3 bg-warning-subtle">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="ti ti-clock text-warning"></i>
                                    <span class="text-muted small">Pending</span>
                                </div>
                                <h4 class="mb-0 text-warning stat-number-small">{{ $statistics['pending'] }}</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stats-mini-card p-3 rounded-3 bg-info-subtle">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="ti ti-file-text text-info"></i>
                                    <span class="text-muted small">Laporan</span>
                                </div>
                                <h4 class="mb-0 text-info stat-number-small">{{ $statistics['reports'] }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        @if($umkmLegalitasNib->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="mb-3 fw-bold"><i class="ti ti-id me-1"></i> Dokumen Berkas NIB</h5>
                    <p class="text-muted mb-3">Dokumen NIB (Nomor Induk Berusaha) dari seluruh UMKM terdaftar.</p>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">UMKM</th>
                                    <th>Nomor Dokumen</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($umkmLegalitasNib as $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar avatar-sm bg-label-info rounded-3">
                                                    <i class="ti ti-building-store"></i>
                                                </div>
                                                <strong>{{ $item->user->name ?? '-' }}</strong>
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
                                                <span class="badge bg-label-success"><i class="ti ti-check me-1"></i> Terverifikasi</span>
                                            @else
                                                <span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i> Menunggu</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="ti ti-file-off fs-1 mb-3 d-block"></i>
                                                <p>Belum ada dokumen NIB.</p>
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
        @endif

    </div>
    @endif
    @endif
    @endsection

@push('styles')
<style>
.card.border-0.shadow-sm.overflow-hidden.welcome-card-gradient {
    position: relative;
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
}

.card.border-0.shadow-sm.overflow-hidden::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.stat-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.stat-icon-wrapper {
    position: relative;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    transform: scale(1.1) rotate(5deg);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-number {
    transform: scale(1.05);
}

.stat-label {
    font-size: 1rem;
}

.stat-badge .badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
    font-weight: 600;
}

.card-decorative-shape {
    position: absolute;
    bottom: -30px;
    right: -30px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    opacity: 0.1;
    transition: all 0.3s ease;
}

.stat-card:hover .card-decorative-shape {
    transform: scale(1.2);
    opacity: 0.15;
}

.activity-timeline {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.activity-item {
    display: flex;
    align-items-start;
    gap: 1rem;
    position: relative;
}

.activity-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    width: 2px;
    height: calc(100% + 1rem);
    background: linear-gradient(180deg, rgba(var(--bs-primary-rgb), 0.2) 0%, transparent 100%);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.25rem;
}

.activity-content {
    flex: 1;
    padding-top: 0.25rem;
}

/* Stats Mini Cards */
.stats-mini-card {
    transition: all 0.3s ease;
}

.stats-mini-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

@keyframes pulse-time {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

#current-time {
    animation: pulse-time 2s infinite;
}

@media (max-width: 767.98px) {
    .stat-number {
        font-size: 2rem;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
    }
    
    .activity-timeline {
        gap: 1rem;
    }
}
a .stat-card {
    text-decoration: none;
}

.card-header {
    background: transparent !important;
}

@keyframes skeleton-loading {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: calc(200px + 100%) 0;
    }
}
</style>
@endpush

@push('scripts')
<script>
    // Live Clock
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;
    }
    
    updateTime();
    setInterval(updateTime, 1000);
    
    document.addEventListener('DOMContentLoaded', function() {
        const numbers = document.querySelectorAll('.stat-number, .stat-number-small');
        numbers.forEach(num => {
            const text = num.textContent.trim();
            if (text.includes('%')) {
                const finalValue = parseInt(text);
                let currentValue = 0;
                const increment = finalValue / 30;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        num.textContent = finalValue + '%';
                        clearInterval(timer);
                    } else {
                        num.textContent = Math.floor(currentValue) + '%';
                    }
                }, 30);
            } else {
                const finalValue = parseInt(text) || 0;
                let currentValue = 0;
                const increment = finalValue / 30;
                const timer = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        num.textContent = finalValue;
                        clearInterval(timer);
                    } else {
                        num.textContent = Math.floor(currentValue);
                    }
                }, 30);
            }
        });
    });
</script>
@endpush