<section class="produksi-populasi-section py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
    <div class="container">
        <div class="row g-4">
            <!-- Produksi Ternak Card -->
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="produksi-card">
                    <div class="produksi-card-header">
                        <div class="produksi-icon-wrapper">
                            <i class="ti ti-box"></i>
                        </div>
                        <div class="produksi-content">
                            <h3 class="produksi-title">Produksi Ternak</h3>
                            <p class="produksi-description">Data produksi ternak berdasarkan jenis dan wilayah</p>
                        </div>
                    </div>
                    <div class="produksi-card-body">
                        <div class="produksi-stats">
                            <div class="stat-item">
                                <i class="ti ti-calendar text-primary"></i>
                                <span>Data per Tahun</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-map-pin text-success"></i>
                                <span>Per Kecamatan</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-tag text-info"></i>
                                <span>Berbagai Jenis Ternak</span>
                            </div>
                        </div>
                    </div>
                    <div class="produksi-card-footer">
                        <a href="{{ route('front.produksi-populasi.index') }}" class="btn-produksi">
                            <span>Lihat Selengkapnya</span>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                    <div class="produksi-card-decoration"></div>
                </div>
            </div>
            
            <!-- Populasi Ternak Card -->
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="populasi-card">
                    <div class="populasi-card-header">
                        <div class="populasi-icon-wrapper">
                            <i class="ti ti-users"></i>
                        </div>
                        <div class="populasi-content">
                            <h3 class="populasi-title">Populasi Ternak</h3>
                            <p class="populasi-description">Data populasi ternak berdasarkan jenis dan wilayah</p>
                        </div>
                    </div>
                    <div class="populasi-card-body">
                        <div class="populasi-stats">
                            <div class="stat-item">
                                <i class="ti ti-calendar text-primary"></i>
                                <span>Data per Tahun</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-map-pin text-success"></i>
                                <span>Per Kecamatan</span>
                            </div>
                            <div class="stat-item">
                                <i class="ti ti-chart-line text-warning"></i>
                                <span>Tracking Populasi</span>
                            </div>
                        </div>
                    </div>
                    <div class="populasi-card-footer">
                        <a href="{{ route('front.produksi-populasi.index') }}" class="btn-populasi">
                            <span>Lihat Selengkapnya</span>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                    <div class="populasi-card-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ============================================
   PRODUKSI & POPULASI SECTION STYLING
   ============================================ */

.produksi-populasi-section {
    position: relative;
}

/* Produksi Card */
.produksi-card,
.populasi-card {
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

.produksi-card::before,
.populasi-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    transition: width 0.4s ease;
}

.produksi-card::before {
    background: linear-gradient(180deg, #28c76f 0%, #22b863 100%);
}

.populasi-card::before {
    background: linear-gradient(180deg, #00cfe8 0%, #00b8d4 100%);
}

.produksi-card:hover,
.populasi-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.produksi-card:hover::before,
.populasi-card:hover::before {
    width: 100%;
    opacity: 0.05;
}

.produksi-card-header,
.populasi-card-header {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.produksi-icon-wrapper,
.populasi-icon-wrapper {
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

.produksi-icon-wrapper {
    background: linear-gradient(135deg, rgba(40, 199, 111, 0.15) 0%, rgba(40, 199, 111, 0.1) 100%);
    color: #28c76f;
}

.populasi-icon-wrapper {
    background: linear-gradient(135deg, rgba(0, 207, 232, 0.15) 0%, rgba(0, 207, 232, 0.1) 100%);
    color: #00cfe8;
}

.produksi-card:hover .produksi-icon-wrapper,
.populasi-card:hover .populasi-icon-wrapper {
    transform: scale(1.1) rotate(-5deg);
}

.produksi-content,
.populasi-content {
    flex: 1;
}

.produksi-title,
.populasi-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.produksi-description,
.populasi-description {
    font-size: 0.9375rem;
    color: #718096;
    margin: 0;
    line-height: 1.6;
}

.produksi-card-body,
.populasi-card-body {
    flex: 1;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.produksi-stats,
.populasi-stats {
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

.produksi-card .stat-item {
    background: rgba(40, 199, 111, 0.05);
}

.populasi-card .stat-item {
    background: rgba(0, 207, 232, 0.05);
}

.stat-item:hover {
    background: rgba(var(--bs-primary-rgb), 0.08);
    transform: translateX(5px);
}

.produksi-card .stat-item:hover {
    background: rgba(40, 199, 111, 0.1);
}

.populasi-card .stat-item:hover {
    background: rgba(0, 207, 232, 0.1);
}

.stat-item i {
    font-size: 1.25rem;
}

.stat-item span {
    font-size: 0.9375rem;
    font-weight: 600;
    color: #4a5568;
}

.produksi-card-footer,
.populasi-card-footer {
    position: relative;
    z-index: 2;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
}

.btn-produksi,
.btn-populasi {
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

.btn-produksi {
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(40, 199, 111, 0.3);
}

.btn-populasi {
    background: linear-gradient(135deg, #00cfe8 0%, #00b8d4 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 207, 232, 0.3);
}

.btn-produksi:hover,
.btn-populasi:hover {
    transform: translateX(5px);
    color: white;
}

.btn-produksi:hover {
    box-shadow: 0 6px 20px rgba(40, 199, 111, 0.4);
}

.btn-populasi:hover {
    box-shadow: 0 6px 20px rgba(0, 207, 232, 0.4);
}

.btn-produksi i,
.btn-populasi i {
    transition: transform 0.3s ease;
}

.btn-produksi:hover i,
.btn-populasi:hover i {
    transform: translateX(5px);
}

.produksi-card-decoration,
.populasi-card-decoration {
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    opacity: 0.05;
    transition: all 0.4s ease;
}

.produksi-card-decoration {
    background: #28c76f;
}

.populasi-card-decoration {
    background: #00cfe8;
}

.produksi-card:hover .produksi-card-decoration,
.populasi-card:hover .populasi-card-decoration {
    transform: scale(1.3);
    opacity: 0.08;
}

/* Responsive */
@media (max-width: 991.98px) {
    .produksi-card,
    .populasi-card {
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .produksi-title,
    .populasi-title {
        font-size: 1.5rem;
    }
    
    .produksi-icon-wrapper,
    .populasi-icon-wrapper {
        width: 70px;
        height: 70px;
        font-size: 2rem;
    }
}

@media (max-width: 767.98px) {
    .produksi-card,
    .populasi-card {
        padding: 1.5rem;
    }
    
    .produksi-card-header,
    .populasi-card-header {
        flex-direction: column;
        text-align: center;
    }
    
    .produksi-icon-wrapper,
    .populasi-icon-wrapper {
        margin: 0 auto;
    }
    
    .produksi-title,
    .populasi-title {
        font-size: 1.25rem;
    }
}

/* Smooth scroll target */
.produksi-populasi-section {
    scroll-margin-top: 80px;
}
</style>
@endpush
