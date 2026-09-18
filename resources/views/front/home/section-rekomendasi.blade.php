<section class="rekomendasi-section py-5" style="background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);">
    <div class="container">
        <!-- Info Cards -->
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="info-card-modern info-card-primary">
                    <div class="info-card-icon">
                        <i class="ti ti-file-check"></i>
                    </div>
                    <div class="info-card-content">
                        <h5 class="info-card-title">Rekomendasi Nomor Kontrol Veteriner</h5>
                        <p class="info-card-description">Akses layanan rekomendasi nomor kontrol veteriner dengan mudah dan cepat</p>
                        <a href="{{ url('nkv') }}" 
                           class="btn-info-card">
                            <span>Selengkapnya</span>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-card-modern info-card-success">
                    <div class="info-card-icon">
                        <i class="ti ti-building-store"></i>
                    </div>
                    <div class="info-card-content">
                        <h5 class="info-card-title">Data UMKM Pengolahan Hasil Perikanan</h5>
                        <p class="info-card-description">Informasi lengkap tentang UMKM pengolahan hasil perikanan di wilayah Anda</p>
                        <a href="https://www.appsheet.com/start/e206f84f-5c8c-4d92-9fd4-9c2c9c3cea17" 
                           class="btn-info-card" 
                           target="_blank">
                            <span>Selengkapnya</span>
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ============================================
   REKOMENDASI SECTION STYLING
   ============================================ */

.rekomendasi-section {
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

/* Rekomendasi Card */
.rekomendasi-card {
    background: white;
    border-radius: 20px;
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}

.rekomendasi-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, var(--bs-primary) 0%, #5a52c7 100%);
    transition: width 0.4s ease;
}

.rekomendasi-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.rekomendasi-card:hover::before {
    width: 100%;
    opacity: 0.05;
}

.rekomendasi-card-header {
    padding: 1.5rem 1.5rem 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 2;
}

.rekomendasi-number {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
    box-shadow: 0 4px 15px rgba(var(--bs-primary-rgb), 0.3);
    transition: transform 0.3s ease;
}

.rekomendasi-card:hover .rekomendasi-number {
    transform: scale(1.1) rotate(5deg);
}

.rekomendasi-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background: rgba(var(--bs-primary-rgb), 0.1);
    border-radius: 8px;
    color: var(--bs-primary);
    font-size: 0.8125rem;
    font-weight: 600;
}

.rekomendasi-card-body {
    padding: 0 1.5rem 1.5rem;
    flex: 1;
    position: relative;
    z-index: 2;
}

.rekomendasi-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 1.25rem;
    line-height: 1.4;
    display: flex;
    align-items: center;
}

.rekomendasi-info-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.rekomendasi-info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 0.75rem;
    background: rgba(var(--bs-primary-rgb), 0.03);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.rekomendasi-info-item:hover {
    background: rgba(var(--bs-primary-rgb), 0.08);
    transform: translateX(5px);
}

.info-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--bs-primary);
    font-size: 1rem;
}

.info-content {
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

.rekomendasi-card-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    background: rgba(var(--bs-primary-rgb), 0.02);
    position: relative;
    z-index: 2;
}

.rekomendasi-status {
    display: flex;
    justify-content: flex-end;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8125rem;
    font-weight: 600;
}

.status-active {
    background: linear-gradient(135deg, rgba(40, 199, 111, 0.1) 0%, rgba(40, 199, 111, 0.05) 100%);
    color: #28c76f;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
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
@media (max-width: 1199.98px) {
    .section-title-center {
        font-size: 2rem;
    }
}

@media (max-width: 991.98px) {
    .rekomendasi-card {
        margin-bottom: 1.5rem;
    }
    
    .section-title-center {
        font-size: 1.75rem;
    }
    
    .rekomendasi-title {
        font-size: 1.125rem;
    }
}

@media (max-width: 767.98px) {
    .section-header-center {
        margin-bottom: 2rem;
    }
    
    .section-title-center {
        font-size: 1.5rem;
    }
    
    .rekomendasi-card-header {
        padding: 1.25rem 1.25rem 0.75rem;
    }
    
    .rekomendasi-card-body {
        padding: 0 1.25rem 1.25rem;
    }
    
    .rekomendasi-card-footer {
        padding: 0.75rem 1.25rem;
    }
    
    .rekomendasi-number {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .info-icon {
        width: 32px;
        height: 32px;
        min-width: 32px;
        font-size: 0.875rem;
    }
}

/* Smooth scroll target */
.rekomendasi-section {
    scroll-margin-top: 80px;
}
</style>
@endpush
