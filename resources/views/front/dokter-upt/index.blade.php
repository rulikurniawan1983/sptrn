@extends('layouts.front-new.app')
@section('title', @$meta_title)
@section('meta_description', @$meta_description)
@section('body_class', 'page-livestock')
@section('data_page', 'livestock')

@section('content')
<section class="page-hero livestock">
    <video class="hero-video" autoplay loop muted playsinline>
        <source src="{{ asset('assets-front-new/images/livestock.webm') }}" type="video/webm">
    </video>
    <div class="container page-hero-inner">
        <div class="breadcrumbs"><a href="{{ route('front.home.index') }}">Beranda</a><span>›</span><span>Dokter Hewan & UPT</span></div>
        <span class="page-kicker">Layanan Kesehatan Hewan</span>
        <h1>Dokter Hewan & UPT</h1>
        <p>Daftar praktek dokter hewan terverifikasi dan Unit Pelaksana Teknis Pusat Kesehatan Hewan di Kabupaten Bogor.</p>
    </div>
</section>

<!-- Praktek Dokter Hewan Section -->
<section class="dokter-section py-5" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);">
    <div class="container">
        <div class="section-header-center mb-5">
            <div class="section-badge-center">
                <i class="ti ti-stethoscope me-2"></i>
                Informasi Dokter Hewan
            </div>
            <h2 class="section-title-center">Praktek Dokter Hewan</h2>
            <p class="section-subtitle">Daftar praktek dokter hewan terverifikasi di wilayah Anda</p>
        </div>

        @if(isset($listPraktekDokterHewan) && $listPraktekDokterHewan->count() > 0)
            <div class="row g-4">
                @foreach($listPraktekDokterHewan as $index => $dokter)
                    <div class="col-lg-6 col-xl-4">
                        <div class="info-card-modern">
                            <div class="info-card-header-custom">
                                <div class="info-icon-custom">
                                    <i class="ti ti-stethoscope"></i>
                                </div>
                                <h4 class="info-title-custom">{{ $dokter->nama ?? '-' }}</h4>
                            </div>
                            <div class="info-card-body-custom">
                                <div class="info-item">
                                    <i class="ti ti-map-pin text-primary"></i>
                                    <div class="info-content-item">
                                        <span class="info-label">Alamat</span>
                                        <span class="info-value">{{ $dokter->alamat ?? '-' }}</span>
                                    </div>
                                </div>
                                
                                @if($dokter->kecamatan || $dokter->kelurahan)
                                    <div class="info-item">
                                        <i class="ti ti-location text-success"></i>
                                        <div class="info-content-item">
                                            <span class="info-label">Lokasi</span>
                                            <span class="info-value">
                                                {{ ($dokter->kelurahan->nama ?? '') ? $dokter->kelurahan->nama . ', ' : '' }}
                                                {{ $dokter->kecamatan->nama ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($dokter->no_tlp_1 || $dokter->no_tlp_2)
                                    <div class="info-item">
                                        <i class="ti ti-phone text-info"></i>
                                        <div class="info-content-item">
                                            <span class="info-label">Telepon</span>
                                            <span class="info-value">
                                                @if($dokter->no_tlp_1)
                                                    {{ $dokter->no_tlp_1 }}
                                                    @if($dokter->no_tlp_2) / {{ $dokter->no_tlp_2 }}@endif
                                                @elseif($dokter->no_tlp_2)
                                                    {{ $dokter->no_tlp_2 }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($dokter->email)
                                    <div class="info-item">
                                        <i class="ti ti-mail text-warning"></i>
                                        <div class="info-content-item">
                                            <span class="info-label">Email</span>
                                            <span class="info-value">{{ $dokter->email }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="ti ti-inbox"></i>
                </div>
                <h4 class="empty-state-title">Belum Ada Data</h4>
                <p class="empty-state-description">Belum ada data praktek dokter hewan yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

<!-- UPT Puskeswan Section -->
<section class="upt-section py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container">
        <div class="section-header-center mb-5">
            <div class="section-badge-center">
                <i class="ti ti-building-hospital me-2"></i>
                Informasi UPT
            </div>
            <h2 class="section-title-center">UPT Puskeswan</h2>
            <p class="section-subtitle">Unit Pelaksana Teknis Pusat Kesehatan Hewan</p>
        </div>

        @if(isset($listUptPuskeswan) && $listUptPuskeswan->count() > 0)
            <div class="row g-4">
                @foreach($listUptPuskeswan as $index => $upt)
                    <div class="col-lg-6 col-xl-4">
                        <div class="info-card-modern info-card-upt">
                            <div class="info-card-header-custom">
                                <div class="info-icon-custom info-icon-upt">
                                    <i class="ti ti-building-hospital"></i>
                                </div>
                                <h4 class="info-title-custom">{{ $upt->nama ?? '-' }}</h4>
                            </div>
                            <div class="info-card-body-custom">
                                <div class="info-item">
                                    <i class="ti ti-map-pin text-primary"></i>
                                    <div class="info-content-item">
                                        <span class="info-label">Alamat</span>
                                        <span class="info-value">{{ $upt->alamat ?? '-' }}</span>
                                    </div>
                                </div>
                                
                                @if($upt->kecamatan || $upt->kelurahan)
                                    <div class="info-item">
                                        <i class="ti ti-location text-success"></i>
                                        <div class="info-content-item">
                                            <span class="info-label">Lokasi</span>
                                            <span class="info-value">
                                                {{ ($upt->kelurahan->nama ?? '') ? $upt->kelurahan->nama . ', ' : '' }}
                                                {{ $upt->kecamatan->nama ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($upt->no_tlp_1 || $upt->no_tlp_2)
                                    <div class="info-item">
                                        <i class="ti ti-phone text-info"></i>
                                        <div class="info-content-item">
                                            <span class="info-label">Telepon</span>
                                            <span class="info-value">
                                                @if($upt->no_tlp_1)
                                                    {{ $upt->no_tlp_1 }}
                                                    @if($upt->no_tlp_2) / {{ $upt->no_tlp_2 }}@endif
                                                @elseif($upt->no_tlp_2)
                                                    {{ $upt->no_tlp_2 }}
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($upt->email)
                                    <div class="info-item">
                                        <i class="ti ti-mail text-warning"></i>
                                        <div class="info-content-item">
                                            <span class="info-label">Email</span>
                                            <span class="info-value">{{ $upt->email }}</span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($upt->fax)
                                    <div class="info-item">
                                        <i class="ti ti-printer text-danger"></i>
                                        <div class="info-content-item">
                                            <span class="info-label">Fax</span>
                                            <span class="info-value">{{ $upt->fax }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="ti ti-inbox"></i>
                </div>
                <h4 class="empty-state-title">Belum Ada Data</h4>
                <p class="empty-state-description">Belum ada data UPT Puskeswan yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
.dokter-section,
.upt-section {
    position: relative;
}

.section-header-center {
    text-align: center;
    margin-bottom: 3rem;
}

.section-badge-center {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1.25rem;
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    border-radius: 50px;
    color: var(--bs-primary);
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 1rem;
    letter-spacing: 0.5px;
}

.section-title-center {
    font-size: 2.25rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.section-subtitle {
    font-size: 1.0625rem;
    color: #718096;
    margin: 0;
}

/* Info Card Modern */
.info-card-modern {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
}

.info-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #ff9f43 0%, #ff8c28 100%);
    transition: width 0.4s ease;
}

.info-card-upt::before {
    background: linear-gradient(180deg, #ea5455 0%, #e63946 100%);
}

.info-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.info-card-modern:hover::before {
    width: 100%;
    opacity: 0.05;
}

.info-card-header-custom {
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 2;
}

.info-icon-custom {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, rgba(255, 159, 67, 0.15) 0%, rgba(255, 159, 67, 0.1) 100%);
    color: #ff9f43;
    transition: all 0.4s ease;
}

.info-icon-upt {
    background: linear-gradient(135deg, rgba(234, 84, 85, 0.15) 0%, rgba(234, 84, 85, 0.1) 100%);
    color: #ea5455;
}

.info-card-modern:hover .info-icon-custom {
    transform: scale(1.1) rotate(-5deg);
}

.info-title-custom {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
    line-height: 1.4;
}

.info-card-body-custom {
    flex: 1;
    position: relative;
    z-index: 2;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: rgba(var(--bs-primary-rgb), 0.03);
    border-radius: 12px;
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
}

.info-card-modern:hover .info-item {
    background: rgba(var(--bs-primary-rgb), 0.06);
}

.info-item i {
    font-size: 1.25rem;
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.info-content-item {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #2d3748;
    line-height: 1.5;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.empty-state-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--bs-primary);
}

.empty-state-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.empty-state-description {
    font-size: 1rem;
    color: #718096;
    margin: 0;
}

/* Responsive */
@media (max-width: 991.98px) {
    .section-title-center {
        font-size: 2rem;
    }
    
    .info-card-modern {
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 767.98px) {
    .section-title-center {
        font-size: 1.5rem;
    }
    
    .info-card-modern {
        padding: 1.5rem;
    }
}
</style>
@endpush

@endsection
