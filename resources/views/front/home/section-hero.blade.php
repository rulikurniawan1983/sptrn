<section class="section-py hero-section">
    <div class="hero-background">
        <img src="{{ asset('assets/img/kambing.jpeg') }}"
             alt="Spartan - Sistem Perizinan Agrobisnis dan Peternakan"
             class="hero-background-image">
        <div class="hero-overlay"></div>
    </div>

    <div class="container h-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-lg-8 col-md-10">
                <div class="hero-content text-center wow fadeInLeft" data-wow-delay="0.2s">


                    <h1 class="hero-title mb-3">
                        Spartan
                    </h1>

                    <p class="hero-subtitle mb-4">
                        Menuju <strong>Pilar Ketahanan Pangan Nasional</strong>
                    </p>

                    <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 mb-3">
                        <button class="btn btn-primary btn-lg shadow-sm"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#aboutSpartanCollapse"
                                aria-expanded="false"
                                aria-controls="aboutSpartanCollapse">
                            <i class="ti ti-info-circle me-2"></i>
                            Tentang Spartan
                        </button>
                    </div>

                    <div class="collapse" id="aboutSpartanCollapse">
                        <div class="hero-description">
                            <strong>Spartan</strong> adalah <strong>Sistem Perizinan Agrobisnis dan Peternakan</strong> yang dirancang
                            untuk memudahkan akses informasi dan pengelolaan data peternakan serta perikanan terverifikasi
                            di wilayah Anda.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Hero Section Styles */
.hero-section {
    position: relative;
    overflow: hidden;
    min-height: calc(100vh - 80px);
    display: flex;
    align-items: center;
    padding-top: 80px;
    padding-bottom: 80px;
}

.hero-background {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.hero-background-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, rgba(15, 23, 42, 0.75) 0%, rgba(15, 23, 42, 0.3) 45%, rgba(15, 23, 42, 0.1) 100%);
}

.hero-section .container {
    position: relative;
    z-index: 1;
}

.hero-content {
    text-align: center;
}

.hero-badge .badge {
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    backdrop-filter: blur(6px);
}

.hero-title {
    font-size: 2.8rem;
    font-weight: 700;
    line-height: 1.2;
    color: #f9fafb;
    text-shadow: 0 10px 35px rgba(15, 23, 42, 0.8);
    animation: fadeInUp 0.8s ease-out;
}

.hero-subtitle {
    font-size: 1.25rem;
    color: #e5e7eb;
    font-weight: 500;
    text-shadow: 0 8px 30px rgba(15, 23, 42, 0.8);
}

.hero-description {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #e5e7eb;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) scale(1);
    }
    50% {
        transform: translateY(-20px) scale(1.05);
    }
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .hero-title {
        font-size: 2.1rem !important;
    }
    
    .hero-description,
    .hero-subtitle {
        font-size: 1rem !important;
    }
    
    .hero-section {
        min-height: 70vh;
        padding-top: 70px !important;
        padding-bottom: 70px !important;
    }
}

@media (max-width: 767.98px) {
    .hero-section {
        padding-top: 60px !important;
        padding-bottom: 60px !important;
    }
    
    .hero-title {
        font-size: 1.75rem !important;
    }
}

/* Smooth scroll target */
#section-hero {
    scroll-margin-top: 80px;
}
</style>
@endpush
