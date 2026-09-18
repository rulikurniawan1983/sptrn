<section class="chart-section py-5">
    <div class="container">
        <div class="section-header-center mb-5">
            <div class="section-badge-center">
                <i class="ti ti-chart-pie me-2"></i>
                Statistik & Grafik
            </div>
            <h2 class="section-title-center">Distribusi Data Per Kecamatan</h2>
            <p class="section-subtitle">Visualisasi data peternakan dan perikanan berdasarkan wilayah kecamatan</p>
        </div>

                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card-modern stat-card-success">
                    <div class="stat-card-icon">
                        <i class="ti ti-list"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-number">{{ saparator($countPeternakan) }}</h3>
                        <p class="stat-label">Total Peternakan</p>
                    </div>
                    <div class="stat-card-decoration"></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card-modern stat-card-info">
                    <div class="stat-card-icon">
                        <i class="ti ti-fish"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-number">{{ saparator($countPerikanan) }}</h3>
                        <p class="stat-label">Total Perikanan</p>
                    </div>
                    <div class="stat-card-decoration"></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card-modern stat-card-warning">
                    <div class="stat-card-icon">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-number">{{ saparator($countKecamatan) }}</h3>
                        <p class="stat-label">Kecamatan</p>
                    </div>
                    <div class="stat-card-decoration"></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="stat-card-modern stat-card-danger">
                    <div class="stat-card-icon">
                        <i class="ti ti-map-pins"></i>
                    </div>
                    <div class="stat-card-content">
                        <h3 class="stat-number">{{ saparator($countDesa) }}</h3>
                        <p class="stat-label">Desa - Kelurahan</p>
                    </div>
                    <div class="stat-card-decoration"></div>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="chart-card chart-card-primary">
                    <div class="chart-card-header">
                        <div class="chart-header-content">
                            <div class="chart-icon">
                                <i class="ti ti-list"></i>
                            </div>
                            <div>
                                <h5 class="chart-title">Total Peternakan Per Kecamatan</h5>
                                <p class="chart-subtitle">Distribusi data peternakan</p>
                            </div>
                        </div>
                    </div>
                    <div class="chart-card-body">
                        <div id="myChartKecamatanPeternakan"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="chart-card chart-card-info">
                    <div class="chart-card-header">
                        <div class="chart-header-content">
                            <div class="chart-icon">
                                <i class="ti ti-fish"></i>
                            </div>
                            <div>
                                <h5 class="chart-title">Total Perikanan Per Kecamatan</h5>
                                <p class="chart-subtitle">Distribusi data perikanan</p>
                            </div>
                        </div>
                    </div>
                    <div class="chart-card-body">
                        <div id="myChartKecamatanPerikanan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ============================================
   MODERN CHART SECTION STYLING
   ============================================ */

.chart-section {
    background: linear-gradient(180deg, #f8f9fa 0%, #5a52c7 100%);
    position: relative;
}

.section-header-center {
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
}

.section-badge-center {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1.25rem;
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--bs-primary);
    margin-bottom: 1rem;
}

.section-title-center {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0 0 1rem 0;
    line-height: 1.2;
}

.section-subtitle {
    font-size: 1.125rem;
    color: var(--bs-text-muted);
    margin: 0;
    line-height: 1.6;
}

.chart-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.chart-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12);
}

.chart-card-header {
    padding: 2rem;
    border-bottom: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.2);
    background: linear-gradient(180deg, rgba(var(--bs-primary-rgb), 0.03) 0%, transparent 100%);
}

.chart-card-primary .chart-card-header {
    background: linear-gradient(180deg, rgba(40, 199, 111, 0.05) 0%, transparent 100%);
}

.chart-card-info .chart-card-header {
    background: linear-gradient(180deg, rgba(0, 207, 232, 0.05) 0%, transparent 100%);
}

.chart-header-content {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.chart-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    transition: all 0.3s ease;
}

.chart-card-primary .chart-icon {
    background: linear-gradient(135deg, rgba(40, 199, 111, 0.1) 0%, rgba(40, 199, 111, 0.05) 100%);
    color: #28c76f;
    border: 2px solid rgba(40, 199, 111, 0.2);
}

.chart-card-info .chart-icon {
    background: linear-gradient(135deg, rgba(0, 207, 232, 0.1) 0%, rgba(0, 207, 232, 0.05) 100%);
    color: #00cfe8;
    border: 2px solid rgba(0, 207, 232, 0.2);
}

.chart-card:hover .chart-icon {
    transform: scale(1.1) rotate(5deg);
}

.chart-card-primary:hover .chart-icon {
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
    color: white;
    box-shadow: 0 8px 20px rgba(40, 199, 111, 0.3);
}

.chart-card-info:hover .chart-icon {
    background: linear-gradient(135deg, #00cfe8 0%, #00b8d4 100%);
    color: white;
    box-shadow: 0 8px 20px rgba(0, 207, 232, 0.3);
}

.chart-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--bs-body-color);
    margin: 0 0 0.25rem 0;
    line-height: 1.3;
}

.chart-subtitle {
    font-size: 0.875rem;
    color: var(--bs-text-muted);
    margin: 0;
}

.chart-card-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 450px;
}

.chart-card-body > div {
    width: 100%;
    height: 100%;
}

/* Highcharts Customization */
.highcharts-container {
    border-radius: 12px;
}

/* Responsive */
@media (max-width: 991.98px) {
    .section-title-center {
        font-size: 2rem;
    }
    
    .chart-card-header {
        padding: 1.5rem;
    }
    
    .chart-card-body {
        padding: 1.5rem;
        min-height: 350px;
    }
}

@media (max-width: 767.98px) {
    .section-title-center {
        font-size: 1.75rem;
    }
    
    .section-subtitle {
        font-size: 1rem;
    }
    
    .chart-card-header {
        padding: 1.25rem;
    }
    
    .chart-header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .chart-icon {
        margin: 0 auto;
    }
    
    .chart-card-body {
        padding: 1rem;
        min-height: 300px;
    }
}

/* ============================================
   MODERN COUNTER SECTION STYLING
   ============================================ */

   .counter-section {
    background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
    position: relative;
}

.counter-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(var(--bs-primary-rgb), 0.2), transparent);
}

/* Stat Cards */
.stat-card-modern {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.stat-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}

.stat-card-icon {
    width: 70px;
    height: 70px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    font-size: 2rem;
    transition: all 0.4s ease;
    position: relative;
    z-index: 2;
}

.stat-card-success .stat-card-icon {
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
    color: white;
    box-shadow: 0 8px 20px rgba(40, 199, 111, 0.3);
}

.stat-card-info .stat-card-icon {
    background: linear-gradient(135deg, #00cfe8 0%, #00b8d4 100%);
    color: white;
    box-shadow: 0 8px 20px rgba(0, 207, 232, 0.3);
}

.stat-card-warning .stat-card-icon {
    background: linear-gradient(135deg, #ff9f43 0%, #ff8c28 100%);
    color: white;
    box-shadow: 0 8px 20px rgba(255, 159, 67, 0.3);
}

.stat-card-danger .stat-card-icon {
    background: linear-gradient(135deg, #ea5455 0%, #e63946 100%);
    color: white;
    box-shadow: 0 8px 20px rgba(234, 84, 85, 0.3);
}

.stat-card-modern:hover .stat-card-icon {
    transform: scale(1.1) rotate(5deg);
}

.stat-card-content {
    position: relative;
    z-index: 2;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 0.5rem;
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-card-success .stat-number {
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stat-card-info .stat-number {
    background: linear-gradient(135deg, #00cfe8 0%, #00b8d4 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stat-card-warning .stat-number {
    background: linear-gradient(135deg, #ff9f43 0%, #ff8c28 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stat-card-danger .stat-number {
    background: linear-gradient(135deg, #ea5455 0%, #e63946 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stat-label {
    font-size: 0.9375rem;
    color: var(--bs-text-muted);
    font-weight: 600;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-card-decoration {
    position: absolute;
    bottom: -30px;
    right: -30px;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    opacity: 0.05;
    transition: all 0.4s ease;
}

.stat-card-success .stat-card-decoration {
    background: #28c76f;
}

.stat-card-info .stat-card-decoration {
    background: #00cfe8;
}

.stat-card-warning .stat-card-decoration {
    background: #ff9f43;
}

.stat-card-danger .stat-card-decoration {
    background: #ea5455;
}

.stat-card-modern:hover .stat-card-decoration {
    transform: scale(1.3);
    opacity: 0.1;
}

/* Info Cards */
.info-card-modern {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    display: flex;
    gap: 1.5rem;
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
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
    transition: width 0.4s ease;
}

.info-card-primary::before {
    background: linear-gradient(180deg, var(--bs-primary) 0%, #5a52c7 100%);
}

.info-card-success::before {
    background: linear-gradient(180deg, #28c76f 0%, #22b863 100%);
}

.info-card-modern:hover {
    transform: translateX(5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.info-card-modern:hover::before {
    width: 100%;
    opacity: 0.05;
}

.info-card-icon {
    width: 80px;
    height: 80px;
    min-width: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    position: relative;
    z-index: 2;
    transition: all 0.4s ease;
}

.info-card-primary .info-card-icon {
    background: linear-gradient(135deg, rgba(var(--bs-primary-rgb), 0.1) 0%, rgba(var(--bs-primary-rgb), 0.05) 100%);
    color: var(--bs-primary);
}

.info-card-success .info-card-icon {
    background: linear-gradient(135deg, rgba(40, 199, 111, 0.1) 0%, rgba(40, 199, 111, 0.05) 100%);
    color: #28c76f;
}

.info-card-modern:hover .info-card-icon {
    transform: scale(1.1) rotate(-5deg);
}

.info-card-content {
    flex: 1;
    position: relative;
    z-index: 2;
}

.info-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: var(--bs-body-color);
    line-height: 1.4;
}

.info-card-description {
    font-size: 0.9375rem;
    color: var(--bs-text-muted);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.btn-info-card {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
    color: white;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(var(--bs-primary-rgb), 0.25);
}

.info-card-success .btn-info-card {
    background: linear-gradient(135deg, #28c76f 0%, #22b863 100%);
    box-shadow: 0 4px 15px rgba(40, 199, 111, 0.25);
}

.btn-info-card:hover {
    transform: translateX(5px);
    box-shadow: 0 6px 20px rgba(var(--bs-primary-rgb), 0.35);
    color: white;
}

.info-card-success .btn-info-card:hover {
    box-shadow: 0 6px 20px rgba(40, 199, 111, 0.35);
}

.btn-info-card i {
    transition: transform 0.3s ease;
}

.btn-info-card:hover i {
    transform: translateX(5px);
}

/* Responsive */
@media (max-width: 991.98px) {
    .stat-card-modern {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .stat-card-icon {
        width: 60px;
        height: 60px;
        font-size: 1.75rem;
    }
    
    .info-card-modern {
        padding: 2rem;
        flex-direction: column;
        text-align: center;
    }
    
    .info-card-icon {
        margin: 0 auto;
    }
}

@media (max-width: 767.98px) {
    .stat-card-modern {
        padding: 1.25rem;
    }
    
    .stat-number {
        font-size: 1.75rem;
    }
    
    .info-card-modern {
        padding: 1.5rem;
    }
}

</style>
@endpush

@push('script')
<script src="{{ asset('/') }}assets/vendor/libs/highcharts/highcharts.js"></script>
<script>
    // Modern Chart Configuration
    const chartOptions = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            backgroundColor: 'transparent',
            style: {
                fontFamily: "'Inter', sans-serif"
            }
        },
        credits: {
            enabled: false
        },
        tooltip: {
            backgroundColor: 'rgba(255, 255, 255, 0.95)',
            borderColor: 'rgba(0, 0, 0, 0.1)',
            borderRadius: 12,
            borderWidth: 1,
            shadow: {
                color: 'rgba(0, 0, 0, 0.1)',
                offsetX: 0,
                offsetY: 4,
                opacity: 0.1,
                width: 4
            },
            style: {
                fontSize: '0.875rem',
                fontWeight: '500'
            },
            pointFormat: '{series.name}: <b>{point.y} | {point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                innerSize: '50%',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.y} ({point.percentage:.1f}%)',
                    style: {
                        fontSize: '0.75rem',
                        fontWeight: '600',
                        fontFamily: "'Inter', sans-serif",
                        textOutline: '1px contrast'
                    },
                    distance: 15,
                    connectorWidth: 1,
                    connectorPadding: 5
                },
                showInLegend: true,
                borderWidth: 3,
                borderColor: '#ffffff',
                states: {
                    hover: {
                        brightness: 0.05,
                        borderWidth: 4
                    },
                    select: {
                        borderWidth: 4
                    }
                }
            }
        },
        legend: {
            align: 'center',
            verticalAlign: 'bottom',
            layout: 'horizontal',
            itemStyle: {
                fontSize: '0.75rem',
                fontWeight: '500',
                fontFamily: "'Inter', sans-serif"
            },
            itemMarginBottom: 8,
            itemMarginTop: 4,
            maxHeight: 100,
            navigation: {
                activeColor: '#3b82f6',
                inactiveColor: '#ccc'
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        }
    };

    // Peternakan Chart
    const myChartKecamatanPeternakan = Highcharts.chart('myChartKecamatanPeternakan', {
        ...chartOptions,
        title: {
            text: null
        },
        series: [{
            name: 'Peternakan',
            colorByPoint: true,
            data: [
                @foreach ($getPeternakanByKecamatan->sortByDesc('peternakan_count') as $key => $row)
                    {
                        name: "{{ $row->nama }}",
                        y: {{ $row->peternakan_count }},
                    },
                @endforeach
            ],
            colors: [
                '#28c76f', '#22b863', '#1ea850', '#18903d', '#11782a',
                '#0a6017', '#034804', '#003000'
            ]
        }]
    });

    // Perikanan Chart
    const myChartKecamatanPerikanan = Highcharts.chart('myChartKecamatanPerikanan', {
        ...chartOptions,
        title: {
            text: null
        },
        series: [{
            name: 'Perikanan',
            colorByPoint: true,
            data: [
                @foreach ($getPeternakanByKecamatan->sortByDesc('perikanan_count') as $key => $row)
                    {
                        name: "{{ $row->nama }}",
                        y: {{ $row->perikanan_count }},
                    },
                @endforeach
            ],
            colors: [
                '#00cfe8', '#00b8d4', '#00a1c0', '#008aac', '#007398',
                '#005c84', '#004570', '#002e5c'
            ]
        }]
    });
</script>
@endpush
