<section class="dokter-upt-section py-5" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);">
    <div class="container">
        <div class="row g-4">
            <!-- Praktek Dokter Hewan Card -->
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="dokter-card">
                    <div class="dokter-card-header">
                        <div class="dokter-icon-wrapper">
                            <i class="ti ti-stethoscope"></i>
                        </div>
                        <div class="dokter-content">
                            <h3 class="dokter-title">Praktek Dokter Hewan</h3>
                            <p class="dokter-description">Informasi praktek dokter hewan terverifikasi di wilayah Anda</p>
                        </div>
                    </div>
                    <div class="dokter-card-body">
                        <div class="dokter-stats">
                            <div class="stat-item">
                                <i class="ti ti-user-check text-primary"></i>
                                <span>Dokter Terverifikasi</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-map-pin text-success"></i>
                                <span>Berbagai Lokasi</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-phone text-info"></i>
                                <span>Kontak Tersedia</span>
                            </div>
                        </div>
                    </div>
                    <div class="dokter-card-footer">
                        <a href="{{ route('front.dokter-upt.index') }}" class="btn-dokter">
                            <span>Lihat Selengkapnya</span>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                    <div class="dokter-card-decoration"></div>
                </div>
            </div>
            
            <!-- UPT Puskeswan Card -->
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="upt-card">
                    <div class="upt-card-header">
                        <div class="upt-icon-wrapper">
                            <i class="ti ti-building-hospital"></i>
                        </div>
                        <div class="upt-content">
                            <h3 class="upt-title">UPT Puskeswan</h3>
                            <p class="upt-description">Unit Pelaksana Teknis Pusat Kesehatan Hewan</p>
                        </div>
                    </div>
                    <div class="upt-card-body">
                        <div class="upt-stats">
                            <div class="stat-item">
                                <i class="ti ti-building text-primary"></i>
                                <span>Unit Terverifikasi</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-map-pin text-success"></i>
                                <span>Berbagai Lokasi</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-phone text-info"></i>
                                <span>Kontak Tersedia</span>
                            </div>
                        </div>
                    </div>
                    <div class="upt-card-footer">
                        <a href="{{ route('front.dokter-upt.index') }}" class="btn-upt">
                            <span>Lihat Selengkapnya</span>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                    <div class="upt-card-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ============================================
   DOKTER & UPT SECTION STYLING
   ============================================ */

.dokter-upt-section {
    position: relative;
}

/* Dokter Card */
.dokter-card,
.upt-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.dokter-card::before,
.upt-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    transition: width 0.4s ease;
}

.dokter-card::before {
    background: linear-gradient(180deg, #ff9f43 0%, #ff8c28 100%);
}

.upt-card::before {
    background: linear-gradient(180deg, #ea5455 0%, #e63946 100%);
}

.dokter-card:hover,
.upt-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.dokter-card:hover::before,
.upt-card:hover::before {
    width: 100%;
    opacity: 0.05;
}

.dokter-card-header,
.upt-card-header {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.dokter-icon-wrapper,
.upt-icon-wrapper {
    width: 80px;
    height: 80px;
    min-width: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    transition: all 0.4s ease;
}

.dokter-icon-wrapper {
    background: linear-gradient(135deg, rgba(255, 159, 67, 0.15) 0%, rgba(255, 159, 67, 0.1) 100%);
    color: #ff9f43;
}

.upt-icon-wrapper {
    background: linear-gradient(135deg, rgba(234, 84, 85, 0.15) 0%, rgba(234, 84, 85, 0.1) 100%);
    color: #ea5455;
}

.dokter-card:hover .dokter-icon-wrapper,
.upt-card:hover .upt-icon-wrapper {
    transform: scale(1.1) rotate(-5deg);
}

.dokter-content,
.upt-content {
    flex: 1;
}

.dokter-title,
.upt-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.dokter-description,
.upt-description {
    font-size: 0.9375rem;
    color: #718096;
    margin: 0;
    line-height: 1.6;
}

.dokter-card-body,
.upt-card-body {
    flex: 1;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.dokter-stats,
.upt-stats {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem;
    background: rgba(var(--bs-primary-rgb), 0.03);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.dokter-card .stat-item {
    background: rgba(255, 159, 67, 0.05);
}

.upt-card .stat-item {
    background: rgba(234, 84, 85, 0.05);
}

.stat-item:hover {
    background: rgba(var(--bs-primary-rgb), 0.08);
    transform: translateX(5px);
}

.dokter-card .stat-item:hover {
    background: rgba(255, 159, 67, 0.1);
}

.upt-card .stat-item:hover {
    background: rgba(234, 84, 85, 0.1);
}

.stat-item i {
    font-size: 1.25rem;
}

.stat-item span {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #4a5568;
}

.dokter-card-footer,
.upt-card-footer {
    position: relative;
    z-index: 2;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
}

.btn-dokter,
.btn-upt {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    width: 100%;
    justify-content: center;
}

.btn-dokter {
    background: linear-gradient(135deg, #ff9f43 0%, #ff8c28 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 159, 67, 0.3);
}

.btn-upt {
    background: linear-gradient(135deg, #ea5455 0%, #e63946 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(234, 84, 85, 0.3);
}

.btn-dokter:hover,
.btn-upt:hover {
    transform: translateX(5px);
    color: white;
}

.btn-dokter:hover {
    box-shadow: 0 6px 20px rgba(255, 159, 67, 0.4);
}

.btn-upt:hover {
    box-shadow: 0 6px 20px rgba(234, 84, 85, 0.4);
}

.btn-dokter i,
.btn-upt i {
    transition: transform 0.3s ease;
}

.btn-dokter:hover i,
.btn-upt:hover i {
    transform: translateX(5px);
}

.dokter-card-decoration,
.upt-card-decoration {
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    opacity: 0.05;
    transition: all 0.4s ease;
}

.dokter-card-decoration {
    background: #ff9f43;
}

.upt-card-decoration {
    background: #ea5455;
}

.dokter-card:hover .dokter-card-decoration,
.upt-card:hover .upt-card-decoration {
    transform: scale(1.3);
    opacity: 0.08;
}

/* Responsive */
@media (max-width: 991.98px) {
    .dokter-card,
    .upt-card {
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .dokter-title,
    .upt-title {
        font-size: 1.5rem;
    }
    
    .dokter-icon-wrapper,
    .upt-icon-wrapper {
        width: 70px;
        height: 70px;
        font-size: 2rem;
    }
}

@media (max-width: 767.98px) {
    .dokter-card,
    .upt-card {
        padding: 1.5rem;
    }
    
    .dokter-card-header,
    .upt-card-header {
        flex-direction: column;
        text-align: center;
    }
    
    .dokter-icon-wrapper,
    .upt-icon-wrapper {
        margin: 0 auto;
    }
    
    .dokter-title,
    .upt-title {
        font-size: 1.25rem;
    }
}

/* Smooth scroll target */
.dokter-upt-section {
    scroll-margin-top: 80px;
}
</style>
@endpush
