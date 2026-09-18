@extends('layouts.front-new.app')
@section('title', @$meta_title)
@section('meta_description', @$meta_description)
@section('body_class', 'page-nkv')
@section('data_page', 'nkv')

@section('content')
<style>
    .page-hero.info {
        min-height: 480px; /* Samakan kurang lebih dengan Peternakan */
    }
    .page-hero.info::before {
        display: none;
    }
    .page-hero.info::after {
        background: linear-gradient(90deg, rgba(4, 40, 16, .45), transparent 65%);
    }
    @media (min-width: 641px) {
        .page-hero.info .hero-video {
            object-position: 50% 60%; /* Menampilkan bagian bawah video */
        }
    }
    @media (max-width: 640px) {
        .page-hero.info .hero-video {
            object-position: 15% 50%;
        }
    }
</style>
<section class="page-hero info">
    <video class="hero-video" autoplay loop muted playsinline>
        <source src="{{ asset('assets-front-new/images/nkv.webm') }}?v={{ filemtime(public_path('assets-front-new/images/nkv.webm')) }}" type="video/webm">
    </video>
    <div class="container page-hero-inner">
        <div class="breadcrumbs"><a href="{{ route('front.home.index') }}">Beranda</a><span>›</span><span>Rekomendasi NKV</span></div>
        <span class="page-kicker">Nomor Kontrol Veteriner</span>
        <h1>REKOMENDASI NKV</h1>
        <p>Jaminan keamanan higiene dan sanitasi pada unit usaha produk hewan Kabupaten Bogor.</p>
    </div>
</section>

<!-- NKV Information Page -->

@if(session('success'))
<div class="container mt-4">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="ti ti-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
<section class="nkv-section py-5" style="background: white;">
    <div class="container">
        <!-- Download Templates Section - At The Top -->
        <div class="download-templates-section mb-5">
            <div class="section-header-center mb-4">
                <div class="section-badge-center">
                    <i class="ti ti-download me-2"></i>
                    Template Surat
                </div>
                <h2 class="section-title-center">Download Template Surat</h2>
                <p class="section-subtitle">Unduh template surat yang diperlukan untuk pengajuan NKV</p>
            </div>
            <style>
                .nkv-download-grid {
                    display: grid;
                    grid-template-columns: 1fr; /* Mobile: 1 kolom */
                    gap: 1rem;
                }
                @media (min-width: 768px) {
                    .nkv-download-grid {
                        grid-template-columns: repeat(2, 1fr); /* Tablet: 2 kolom */
                    }
                }
                @media (min-width: 1024px) {
                    .nkv-download-grid {
                        grid-template-columns: repeat(4, 1fr); /* Desktop: 4 kolom (1 baris) */
                    }
                }
            </style>
            
            <div class="nkv-download-grid">
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ asset('assets-front-new/file/suratpermohonan.pdf') }}"
                       download="Surat_Permohonan.pdf"
                       class="download-card" style="padding: 1.1rem; border-radius: 12px;">
                        <div class="download-icon" style="width: 40px; height: 40px; font-size: 1.2rem; margin-bottom: 0.75rem;">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h5 class="download-title" style="font-size: 0.95rem; font-weight: 700;">Surat Permohonan</h5>
                        <p class="download-description" style="font-size: 0.78rem; min-height: 36px;">Template surat permohonan pembinaan sertifikasi NKV</p>
                        <div class="download-btn">
                            <i class="ti ti-download me-2"></i>
                            Unduh
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ asset('assets-front-new/file/dataumumkusus.pdf') }}"
                       download="Data_Umum_Khusus.pdf"
                       class="download-card" style="padding: 1.1rem; border-radius: 12px;">
                        <div class="download-icon" style="width: 40px; height: 40px; font-size: 1.2rem; margin-bottom: 0.75rem;">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h5 class="download-title" style="font-size: 0.95rem; font-weight: 700;">Data Umum &amp; Khusus</h5>
                        <p class="download-description" style="font-size: 0.78rem; min-height: 36px;">Formulir data umum dan data khusus unit usaha</p>
                        <div class="download-btn">
                            <i class="ti ti-download me-2"></i>
                            Unduh
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ asset('assets-front-new/file/sopsanitasi.pdf') }}"
                       download="SOP_Sanitasi.pdf"
                       class="download-card" style="padding: 1.1rem; border-radius: 12px;">
                        <div class="download-icon" style="width: 40px; height: 40px; font-size: 1.2rem; margin-bottom: 0.75rem;">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h5 class="download-title" style="font-size: 0.95rem; font-weight: 700;">SOP Sanitasi</h5>
                        <p class="download-description" style="font-size: 0.78rem; min-height: 36px;">Standar operasi prosedur kebersihan dan sanitasi</p>
                        <div class="download-btn">
                            <i class="ti ti-download me-2"></i>
                            Unduh
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <a href="{{ asset('assets-front-new/file/kebenarandocument.pdf') }}"
                       download="Pernyataan_Kebenaran_Dokumen.pdf"
                       class="download-card" style="padding: 1.1rem; border-radius: 12px;">
                        <div class="download-icon" style="width: 40px; height: 40px; font-size: 1.2rem; margin-bottom: 0.75rem;">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h5 class="download-title" style="font-size: 0.95rem; font-weight: 700;">Kebenaran Dokumen</h5>
                        <p class="download-description" style="font-size: 0.78rem; min-height: 36px;">Template surat pernyataan kebenaran dokumen</p>
                        <div class="download-btn">
                            <i class="ti ti-download me-2"></i>
                            Unduh
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Button Ajukan Rekomendasi -->

        <!-- NKV Definition Section -->
        <div class="nkv-content-section mb-5">
            <div class="nkv-header-card">
                <div class="nkv-logo-wrapper">
                    <div class="nkv-logo">
                        <span class="nkv-text">NKV</span>
                    </div>
                </div>
                <div class="nkv-title-wrapper">
                    <h1 class="nkv-main-title">
                        <span class="nkv-title-red">NOMOR KONTROL VETERINER</span>
                    </h1>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show text-start mb-4" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="text-center mb-5">
            <a href="{{ route('front.nkv.ajukan') }}" class="btn-ajukan-nkv">
                Ajukan Rekomendasi NKV
            </a>
        </div>
                </div>
            </div>
            
            <div class="nkv-info-card">
                <p class="nkv-intro-text">
                    Berdasarkan <strong>Peraturan Menteri Pertanian Nomor 11 Tahun 2020</strong> tentang Sertifikasi Nomor Kontrol Veteriner (NKV), NKV adalah sertifikat sebagai bukti tertulis yang sah telah dipenuhinya persyaratan higiene dan sanitasi sebagai jaminan keamanan produk hewan pada unit usaha produk hewan.
                </p>
                
                <div class="nkv-objectives">
                    <h3 class="nkv-section-title">
                        <i class="ti ti-target me-2 text-primary"></i>
                        Tujuan Sertifikasi NKV
                    </h3>
                    <ol class="nkv-list">
                        <li>Terlaksananya tertib hukum dan tertib administrasi dalam pengelolaan usaha produk pangan asal hewan;</li>
                        <li>Memastikan bahwa unit usaha telah memenuhi persyaratan higiene-sanitasi dan menerapkan cara produksi yang baik; dan</li>
                        <li>Mempermudah penelusuran kembali apabila terjadi kasus keracunan pangan asal hewan.</li>
                    </ol>
                </div>
                
                <div class="nkv-benefits">
                    <h3 class="nkv-section-title">
                        <i class="ti ti-check-circle me-2 text-success"></i>
                        Manfaat Sertifikasi NKV
                    </h3>
                    <ol class="nkv-list">
                        <li><strong>Bagi pelaku unit usaha</strong>, dapat memperoleh nilai tambah jaminan keamanan produk sehingga meningkatkan daya saing produk di pasaran;</li>
                        <li><strong>Bagi masyarakat</strong>, mendapatkan jaminan keamanan pangan asal hewan yang ASUH atau aman, sehat, utuh, dan halal (perlindungan kesehatan); dan</li>
                        <li><strong>Bagi pemerintah</strong>, merupakan sarana penelusuran sumber produk yang efektif dalam rantai keamanan pangan.</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Unit Usaha Wajib NKV Section -->
        <div class="unit-usaha-section mb-5">
            <div class="section-header-center mb-4">
                <h2 class="section-title-center">Jenis Unit Usaha Wajib NKV</h2>
                <p class="section-subtitle">Setiap orang yang mempunyai unit usaha produk hewan wajib mengajukan permohonan untuk memperoleh NKV. jenis usaha produk hewan yang harus mengajukan permohonan NKV adalah sebagai meliputi:</p>
            </div>
            
            <div class="nkv-grid">
                <div class="unit-card">
                    <div class="unit-image-wrapper">
                        <img src="{{ asset('assets/img/rumah-potong-hewan.png') }}" alt="Rumah Potong Hewan" class="unit-image">
                    </div>
                    <h4 class="unit-title">Rumah Potong Hewan</h4>
                    <p class="unit-desc">(Ruminansia, dan Unggas)</p>
                </div>
                
                <div class="unit-card">
                    <div class="unit-image-wrapper">
                        <img src="{{ asset('assets/img/Budidaya.jpg') }}" alt="Budidaya" class="unit-image">
                    </div>
                    <h4 class="unit-title">Budidaya</h4>
                    <p class="unit-desc">(Unggas Petelur dan Sapi Perah)</p>
                </div>
                
                <div class="unit-card">
                    <div class="unit-image-wrapper">
                        <img src="{{ asset('assets/img/distribusi.jpg') }}" alt="Distribusi" class="unit-image">
                    </div>
                    <h4 class="unit-title">Distribusi</h4>
                    <p class="unit-desc">(Cold Storage; Kos daging; Ritel; Gudang kering; Pengumpulan, Pengemasan, dan Pelabelan Telur Konsumsi, Penampung Susu, Penanganan Madu)</p>
                </div>
                
                <div class="unit-card">
                    <div class="unit-image-wrapper">
                        <img src="{{ asset('assets/img/sarang-burung-walet.jpg') }}" alt="Sarang Burung Walet" class="unit-image">
                    </div>
                    <h4 class="unit-title">Sarang Burung Walet</h4>
                    <p class="unit-desc">(Rumah, Pencucian, Pengumpulan dan Pengolahan)</p>
                </div>
                
                <div class="unit-card">
                    <div class="unit-image-wrapper">
                        <img src="{{ asset('assets/img/pengolahan-produk-pangan-asal-hewan.jpg') }}" alt="Pengolahan Produk Pangan Asal Hewan" class="unit-image">
                    </div>
                    <h4 class="unit-title">Pengolahan Produk Pangan Asal Hewan</h4>
                    <p class="unit-desc">(Daging, Susu, Telur, Madu dan produk pangan lain)</p>
                </div>
                
                <div class="unit-card">
                    <div class="unit-image-wrapper">
                        <img src="{{ asset('assets/img/pengolahan-hewan-non-pangan.jpg') }}" alt="Pengolahan Hewan Non Pangan" class="unit-image">
                    </div>
                    <h4 class="unit-title">Pengolahan Hewan Non Pangan</h4>
                    <p class="unit-desc">Pengolahan produk hewan untuk keperluan non pangan</p>
                </div>
            </div>
        </div>

        <!-- Proses Sertifikasi Section -->
        <div class="proses-section mb-5">
            <div class="section-header-center mb-4">
                <h2 class="section-title-center">Proses Sertifikasi NKV</h2>
                <p class="section-subtitle">Sertifikat NKV diberikan oleh Pejabat Otoritas Veteriner (POV) Provinsi dan berlaku selama 5 (lima) tahun</p>
            </div>
            
            <div class="proses-info-card mb-4">
                <p>
                    Pelaku unit usaha mengajukan permohonan untuk memperoleh NKV kepada Gubernur melalui Dinas Daerah Provinsi yang membidangi fungsi Peternakan dan Kesehatan Hewan. Pengajuan permohonan sertifikasi NKV dilakukan secara online melalui sistem yang terintegrasi antara <strong>Online Single Submission (OSS)</strong> dan aplikasi <strong>Sistem Informasi Nasional Sertifikasi NKV (SISNAS NKV)</strong>.
                </p>
            </div>
            
            <div class="proses-flowchart">
                <div class="flowchart-container">
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-user"></i>
                        </div>
                        <div class="flow-label">PEMOHON</div>
                        <div class="flow-actions text-start">
                            <small>● Kirim Permohonan</small>
                            <small>● Pantau Status</small>
                        </div>
                    </div>
                    
                    <div class="flow-arrow">→</div>
                    
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-user-star"></i>
                        </div>
                        <div class="flow-label">KEPALA DINAS</div>
                        <div class="flow-actions text-start">
                            <small>● Disposisi</small>
                        </div>
                    </div>
                    
                    <div class="flow-arrow">→</div>
                    
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-building"></i>
                        </div>
                        <div class="flow-label">ADMIN DINAS</div>
                        <div class="flow-actions text-start">
                            <small>● Verifikasi Administrasi</small>
                        </div>
                    </div>
                    
                    <div class="flow-arrow">→</div>
                    
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-user-check"></i>
                        </div>
                        <div class="flow-label">POV</div>
                        <div class="flow-actions text-start">
                            <small>● Verifikasi Teknis</small>
                        </div>
                    </div>
                    
                    <div class="flow-arrow">→</div>
                    
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-user-star"></i>
                        </div>
                        <div class="flow-label">KEPALA DINAS</div>
                        <div class="flow-actions text-start">
                            <small>● Penugasan Tim Auditor</small>
                        </div>
                    </div>
                    
                    <div class="flow-arrow">→</div>
                    
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-users"></i>
                        </div>
                        <div class="flow-label">TIM AUDITOR</div>
                        <div class="flow-actions text-start">
                            <small>● Input Jadwal Audit (1)</small>
                            <small>● Pelaksanaan Audit (1)</small>
                            <small>● Upload Hasil Audit (1)</small>
                            <small>● Input Jadwal Audit (2)</small>
                            <small>● Pelaksanaan Audit (2)</small>
                            <small>● Isi Lembaran Periksa</small>
                            <small>● Upload Hasil Audit (2)</small>
                            <small>● Kirim Hasil Audit</small>
                        </div>
                    </div>
                    
                    <div class="flow-arrow">→</div>
                    
                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-user-check"></i>
                        </div>
                        <div class="flow-label">POV</div>
                        <div class="flow-actions text-start">
                            <small>● Pengesahan Audit</small>
                            <small>● Penerbitan NKV</small>
                        </div>
                    </div>

                    <div class="flow-step">
                        <div class="flow-icon">
                            <i class="ti ti-user-check"></i>
                        </div>
                        <div class="flow-label">KEPALA DINAS</div>
                        <div class="flow-actions text-start">
                            <small>● Persetujan Penerbitan NKV</small>
                        </div>
                    </div>
                    
                    <div class="flow-arrow">→</div>
                    
                    <div class="flow-step flow-success">
                        <div class="flow-icon">
                            <i class="ti ti-check"></i>
                        </div>
                        <div class="flow-label">NKV TERBIT</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Persyaratan Section -->
        <div class="persyaratan-section mb-5">
            <div class="row g-4">
                <!-- Persyaratan Administrasi -->
                <div class="col-lg-6">
                    <div class="persyaratan-card">
                        <div class="persyaratan-header">
                            <div class="persyaratan-icon">
                                <i class="ti ti-file-text"></i>
                            </div>
                            <h3 class="persyaratan-title">Persyaratan Administrasi</h3>
                        </div>
                        <div class="persyaratan-body">
                            <ol class="persyaratan-list">
                                <li>Fotokopi Kartu Tanda Penduduk (KTP) pemilik unit usaha produk hewan;</li>
                                <li>Surat kuasa bermeterai apabila diwakilkan oleh orang lain;</li>
                                <li>Surat keterangan domisili yang dikeluarkan oleh pejabat berwenang;</li>
                                <li>Fotokopi Nomor Pokok Wajib Pajak (NPWP) unit usaha produk hewan;</li>
                                <li>Fotokopi izin usaha atau surat tanda daftar usaha;</li>
                                <li>Surat rekomendasi dari Dinas Daerah Kabupaten/Kota setempat;</li>
                                <li>Perjanjian pengelolaan usaha jika kegiatan di tempat usaha milik orang lain; dan</li>
                                <li>Surat pernyataan bermeterai yang menerangkan bahwa dokumen yang disampaikan benar dan sah.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                
                <!-- Persyaratan Teknis -->
                <div class="col-lg-6">
                    <div class="persyaratan-card">
                        <div class="persyaratan-header">
                            <div class="persyaratan-icon">
                                <i class="ti ti-tools"></i>
                            </div>
                            <h3 class="persyaratan-title">Persyaratan Teknis</h3>
                        </div>
                        <div class="persyaratan-body">
                            <ol class="persyaratan-list">
                                <li>Prasarana dan sarana memenuhi persyaratan higiene dan sanitasi, biosekuriti, dan kesejahteraan hewan;</li>
                                <li>Mempunyai dokter hewan yang tidak berstatus aparatur sipil negara sebagai penanggung jawab teknis bagi unit usaha yang dipersyaratkan; dan</li>
                                <li>Memiliki pekerja teknis dengan kompetensi di bidang higiene dan sanitasi atau kesejahteraan hewan bagi yang dipersyaratkan.</li>
                            </ol>
                            <div class="persyaratan-note">
                                <p class="mb-0">
                                    <strong>Catatan:</strong> Dinas Daerah Kabupaten/Kota melakukan pembinaan terhadap unit usaha produk hewan yang belum memiliki NKV. Pembinaan dilakukan dalam rangka pemenuhan persyaratan higiene dan sanitasi dengan menerapkan cara yang baik pada rantai produksi produk hewan secara terus menerus, serta perbaikan terhadap temuan hasil audit.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Nomor Sertifikat Section -->
        <div class="nomor-sertifikat-section mb-5">
            <div class="two-col-grid">
                <div class="nomor-info-card">
                    <h3 class="nomor-title">Informasi Nomor Sertifikat NKV</h3>
                    <p class="nomor-desc">
                        Nomor urut pemberian Nomor Kontrol Veteriner dinyatakan dengan angka yang menunjukkan urutan angka pemberian nomor kontrol veteriner.
                    </p>
                    
                    <div class="nomor-example">
                        <div class="nomor-display">RPHU-327601-005</div>
                        <div class="nomor-breakdown">
                            <div class="breakdown-item">
                                <span class="breakdown-code">RPHU</span>
                                <span class="breakdown-label">Kode Jenis Unit Usaha</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-code">32</span>
                                <span class="breakdown-label">Kode Statistik Provinsi Jawa Barat</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-code">76</span>
                                <span class="breakdown-label">Kode Statistik Kota Depok</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-code">01</span>
                                <span class="breakdown-label">Kode Statistik Kecamatan Sawangan</span>
                            </div>
                            <div class="breakdown-item">
                                <span class="breakdown-code">005</span>
                                <span class="breakdown-label">Nomor Urut Registrasi</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="qr-code-card text-center">
                    <h4 class="qr-title">SCAN QR CODE BERIKUT UNTUK INFORMASI</h4>
                    <p class="qr-subtitle">JENIS UNIT USAHA WAJIB ber-NKV dan PERSYARATAN TEKNIS</p>
                    <div class="qr-code-wrapper">
                        <div class="qr-code-placeholder">
                            <i class="ti ti-qrcode"></i>
                            <p class="mt-3">QR Code</p>
                            <small>Scan untuk informasi lebih lanjut</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
:root {
    --bs-primary: #8b5cf6;
    --bs-primary-rgb: 139, 92, 246;
}

/* NKV Page Styles */
.nkv-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
}
@media (min-width: 768px) {
    .nkv-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.two-col-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
    align-items: center;
}
@media (min-width: 992px) {
    .two-col-grid {
        grid-template-columns: 1fr 1fr;
    }
}

.nkv-section {
    position: relative;
}

/* Redesign to match Spartan Fix Theme */
.download-templates-section,
.nkv-info-card,
.unit-card,
.proses-info-card,
.proses-flowchart,
.persyaratan-card,
.nomor-info-card,
.qr-code-card {
    border: 1px solid #eef2f5 !important;
    box-shadow: 0 10px 30px rgba(10, 52, 80, 0.05) !important;
    border-radius: 16px !important;
    background: #ffffff !important;
}

.section-badge-center {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1.25rem;
    background: rgba(139, 92, 246, 0.1) !important;
    border-radius: 50px;
    color: #8b5cf6 !important;
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 1rem;
    letter-spacing: 0.5px;
}

.section-title-center {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.2;
    letter-spacing: -0.03em;
}

.download-card {
    background: #fbf9ff !important;
    border: 2px dashed rgba(139, 92, 246, 0.2) !important;
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    display: block;
    height: 100%;
}

.download-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(139, 92, 246, 0.12) !important;
    border-color: #8b5cf6 !important;
    background: #ffffff !important;
}

.download-icon {
    width: 68px;
    height: 68px;
    margin: 0 auto 1.25rem;
    background: rgba(139, 92, 246, 0.1) !important;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #8b5cf6 !important;
}

.download-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.6rem 1.25rem;
    background: #8b5cf6 !important;
    color: white !important;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.24);
}

.btn-ajukan-nkv {
    display: inline-flex;
    align-items: center;
    padding: 1.1rem 2.8rem;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%) !important;
    color: white !important;
    border-radius: 30px;
    font-weight: 700;
    font-size: 1.1rem;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(139, 92, 246, 0.3) !important;
    transition: all 0.3s ease;
}

.btn-ajukan-nkv:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(139, 92, 246, 0.45) !important;
    color: white !important;
}

/* NKV Logo Header */
.nkv-header-card {
    background: linear-gradient(135deg, #fdfaff 0%, #f9f5ff 100%) !important;
    border: 1px solid #f3ebff !important;
    border-radius: 20px;
    padding: 3rem;
    text-align: center;
    margin-bottom: 2rem;
}

.nkv-logo {
    width: 110px;
    height: 110px;
    margin: 0 auto;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%) !important;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid white;
    box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
}

.nkv-title-red {
    color: #8b5cf6 !important;
}

.nkv-section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.25rem;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 8px;
}

.nkv-list {
    list-style: none;
    padding-left: 0;
}

.nkv-list li {
    position: relative;
    padding-left: 28px;
    margin-bottom: 10px;
}

.nkv-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    top: 2px;
    width: 18px;
    height: 18px;
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: bold;
}

/* Flowchart styling matching theme */
.flow-step {
    background: #fbf9ff !important;
    border: 1px solid rgba(139, 92, 246, 0.15) !important;
    border-radius: 12px;
    padding: 1.25rem;
}

.flow-icon {
    width: 52px;
    height: 52px;
    background: #8b5cf6 !important;
    border-radius: 10px;
    font-size: 1.5rem;
}

.flow-arrow {
    color: #8b5cf6 !important;
}

.flow-success {
    background: #f2fbf4 !important;
    border-color: #28c76f !important;
}

.flow-success .flow-icon {
    background: #28c76f !important;
}

/* Persyaratan Card Styling */
.persyaratan-header {
    border-bottom: 2px solid rgba(139, 92, 246, 0.1) !important;
}

.persyaratan-icon {
    background: rgba(139, 92, 246, 0.1) !important;
    color: #8b5cf6 !important;
}

.persyaratan-list {
    list-style: none;
    padding-left: 0;
}

.persyaratan-list li {
    position: relative;
    padding-left: 28px;
    margin-bottom: 12px;
}

.persyaratan-list li::before {
    content: "●";
    position: absolute;
    left: 4px;
    color: #8b5cf6;
    font-size: 12px;
}

.persyaratan-note {
    background: #fbf9ff !important;
    border-left: 4px solid #8b5cf6 !important;
}

/* Nomor display */
.nomor-display {
    color: #7c3aed !important;
    background: #fbf9ff !important;
    border: 1px dashed rgba(139, 92, 246, 0.3);
}

.breakdown-code {
    color: #8b5cf6 !important;
    border: 2px solid rgba(139, 92, 246, 0.2) !important;
}

.qr-code-wrapper {
    border: 4px solid #8b5cf6 !important;
}

.section-header-center {
    text-align: center;
    margin-bottom: 2rem;
}

.section-subtitle {
    font-size: 1rem;
    color: #718096;
    margin: 0;
}

/* Download Templates */
.download-templates-section {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.download-card {
    background: white;
    border: 2px solid rgba(var(--bs-primary-rgb), 0.1);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    display: block;
    height: 100%;
}

.download-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(var(--bs-primary-rgb), 0.15);
    border-color: var(--bs-primary);
    color: inherit;
}

.download-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--bs-primary);
}

.download-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.download-description {
    font-size: 0.875rem;
    color: #718096;
    margin-bottom: 1.5rem;
}

.download-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
    color: white;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9375rem;
}

/* Button Ajukan NKV */
.btn-ajukan-nkv {
    display: inline-flex;
    align-items: center;
    padding: 1.25rem 3rem;
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
    color: white;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.125rem;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(40, 199, 111, 0.3);
    transition: all 0.3s ease;
}

.btn-ajukan-nkv:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(40, 199, 111, 0.4);
    color: white;
}

/* NKV Header */
.nkv-header-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 20px;
    padding: 3rem;
    text-align: center;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.nkv-logo-wrapper {
    margin-bottom: 1.5rem;
}

.nkv-logo {
    width: 120px;
    height: 120px;
    margin: 0 auto;
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid white;
    box-shadow: 0 4px 15px rgba(40, 199, 111, 0.3);
}

.nkv-text {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    letter-spacing: 2px;
}

.nkv-main-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0;
}

.nkv-title-red {
    color: #ea5455;
}

/* NKV Info Card */
.nkv-info-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.nkv-intro-text {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #4a5568;
    margin-bottom: 2rem;
}

.nkv-objectives,
.nkv-benefits {
    margin-bottom: 2rem;
}

.nkv-section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.nkv-list {
    padding-left: 1.5rem;
    font-size: 1rem;
    line-height: 1.8;
    color: #4a5568;
}

.nkv-list li {
    margin-bottom: 0.75rem;
}

/* Unit Usaha Cards */
.unit-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    border: 2px solid rgba(var(--bs-primary-rgb), 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.unit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border-color: var(--bs-primary);
}

.unit-image-wrapper {
    width: 100%;
    height: 200px;
    margin: 0 auto 1.5rem;
    border-radius: 16px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.unit-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.unit-card:hover .unit-image {
    transform: scale(1.05);
}

.unit-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.unit-desc {
    font-size: 0.9375rem;
    color: #718096;
    margin: 0;
}

/* Proses Flowchart */
.proses-info-card {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.proses-flowchart {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    overflow-x: auto;
}

.flowchart-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    min-width: max-content;
    padding: 1rem 0;
}

.flow-step {
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    min-width: 150px;
    border: 2px solid rgba(var(--bs-primary-rgb), 0.2);
}

.flow-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
}

.flow-label {
    font-weight: 700;
    font-size: 0.875rem;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.flow-actions {
    font-size: 0.75rem;
    color: #718096;
}

.flow-actions small {
    display: block;
    margin-bottom: 0.25rem;
}

.flow-arrow {
    font-size: 2rem;
    color: var(--bs-primary);
    font-weight: bold;
}

.flow-success {
    background: linear-gradient(135deg, rgba(40, 199, 111, 0.1) 0%, rgba(40, 199, 111, 0.05) 100%);
    border-color: #28c76f;
}

.flow-success .flow-icon {
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
}

/* Persyaratan Cards */
.persyaratan-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    height: 100%;
}

.persyaratan-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid rgba(var(--bs-primary-rgb), 0.1);
}

.persyaratan-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: var(--bs-primary);
}

.persyaratan-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
}

.persyaratan-list {
    padding-left: 1.5rem;
    font-size: 1rem;
    line-height: 1.8;
    color: #4a5568;
}

.persyaratan-list li {
    margin-bottom: 1rem;
}

.persyaratan-note {
    margin-top: 2rem;
    padding: 1.5rem;
    background: rgba(var(--bs-primary-rgb), 0.05);
    border-radius: 12px;
    border-left: 4px solid var(--bs-primary);
}

/* Nomor Sertifikat */
.nomor-info-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.nomor-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1rem;
}

.nomor-desc {
    font-size: 1rem;
    color: #718096;
    margin-bottom: 2rem;
}

.nomor-display {
    font-size: 2rem;
    font-weight: 800;
    color: var(--bs-primary);
    text-align: center;
    padding: 1.5rem;
    background: rgba(var(--bs-primary-rgb), 0.05);
    border-radius: 12px;
    margin-bottom: 2rem;
    letter-spacing: 2px;
}

.nomor-breakdown {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.breakdown-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(var(--bs-primary-rgb), 0.03);
    border-radius: 10px;
}

.breakdown-code {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--bs-primary);
    min-width: 80px;
    text-align: center;
    padding: 0.5rem;
    background: white;
    border-radius: 8px;
    border: 2px solid rgba(var(--bs-primary-rgb), 0.2);
}

.breakdown-label {
    font-size: 0.9375rem;
    color: #4a5568;
    flex: 1;
}

.qr-code-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.qr-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.qr-subtitle {
    font-size: 1rem;
    color: #718096;
    margin-bottom: 2rem;
}

.qr-code-wrapper {
    display: inline-block;
    padding: 2rem;
    background: white;
    border: 4px solid #ea5455;
    border-radius: 12px;
}

.qr-code-placeholder {
    width: 250px;
    height: 250px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #718096;
}

.qr-code-placeholder i {
    font-size: 5rem;
}

/* Responsive */
@media (max-width: 991.98px) {
    .section-title-center {
        font-size: 1.75rem;
    }
    
    .nkv-main-title {
        font-size: 2rem;
    }
    
    .proses-flowchart {
        padding: 1.5rem 1.25rem;
        overflow: visible;
    }
    
    .flowchart-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        min-width: auto;
        padding: 0;
        counter-reset: step-counter;
    }
    
    .flow-arrow {
        display: none;
    }
    
    .flow-step {
        min-width: auto;
        width: 100%;
        padding: 1rem 0.75rem;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        border-radius: 12px;
    }
    
    .flow-step:not(.flow-success)::before {
        counter-increment: step-counter;
        content: counter(step-counter);
        position: absolute;
        top: 8px;
        left: 8px;
        width: 22px;
        height: 22px;
        background: var(--bs-primary);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }
    
    .flow-icon {
        width: 46px;
        height: 46px;
        font-size: 1.35rem;
        margin: 0 auto 0.6rem;
        border-radius: 10px;
    }
    
    .flow-label {
        font-size: 0.82rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
        line-height: 1.25;
    }
    
    .flow-actions {
        font-size: 0.72rem;
        line-height: 1.35;
    }
    
    .flow-actions small {
        margin-bottom: 0.2rem;
    }
    
    .flow-step.flow-success {
        grid-column: 1 / -1;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 1rem;
    }
    
    .flow-step.flow-success .flow-icon {
        margin: 0;
        width: 44px;
        height: 44px;
        font-size: 1.35rem;
        flex-shrink: 0;
    }
    
    .flow-step.flow-success .flow-label {
        font-size: 0.95rem;
        margin: 0;
        font-weight: 800;
    }
}

@media (max-width: 767.98px) {
    .download-templates-section,
    .nkv-info-card,
    .persyaratan-card {
        padding: 1.5rem;
    }
    
    .nkv-main-title {
        font-size: 1.5rem;
    }
    
    .nomor-display {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .proses-flowchart {
        padding: 1rem 0.75rem;
    }
    
    .flowchart-container {
        gap: 8px;
    }
    
    .flow-step {
        padding: 0.75rem 0.5rem;
    }
    
    .flow-step:not(.flow-success)::before {
        width: 18px;
        height: 18px;
        font-size: 0.65rem;
        top: 6px;
        left: 6px;
    }
    
    .flow-icon {
        width: 38px;
        height: 38px;
        font-size: 1.15rem;
        margin-bottom: 0.4rem;
    }
    
    .flow-label {
        font-size: 0.75rem;
    }
    
    .flow-actions {
        font-size: 0.65rem;
    }
}
</style>
@endpush

@endsection
