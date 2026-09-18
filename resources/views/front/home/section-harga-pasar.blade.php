<section id="section-harga-pasar" class="harga-pasar-section py-5">
    <div class="container">
        <div class="section-header-center mb-5">
            <div class="section-badge-center">
                <i class="ti ti-currency-dollar me-2"></i>
                Informasi Harga
            </div>
            <h2 class="section-title-center">Harga Pasar</h2>
            <p class="section-subtitle">Data perbandingan harga komoditas di berbagai pasar</p>
        </div>

        <!-- Filter Section -->
        <div class="price-filter-card mb-5">
            <div class="filter-header">
                <h4 class="filter-title">
                    <i class="ti ti-filter me-2"></i>
                    Filter Data
                </h4>
            </div>
            <div class="filter-body">
                <form id="form-price-filter" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-d', strtotime('-7 days')) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ti ti-search me-2"></i>
                            Cari Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="price-stats-section mb-5">
            <div class="row g-4" id="price-stats-container">
                <!-- Stats will be loaded here -->
            </div>
        </div>

        <!-- Comparison Table -->
        <div class="price-comparison-section">
            <div class="comparison-card">
                <div class="comparison-header">
                    <h4 class="comparison-title">
                        <i class="ti ti-table me-2"></i>
                        Perbandingan Harga
                    </h4>
                </div>
                <div class="comparison-body">
                    <div id="price-comparison-container">
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-3 text-muted">Memuat data harga pasar...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Harga Pasar Section */
.harga-pasar-section {
    background: linear-gradient(180deg, #f8f9fa 0%, #5a52c7 100%);
    position: relative;
}

.section-header-center {
    text-align: center;
    margin-bottom: 2rem;
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
    font-size: 2rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.section-subtitle {
    font-size: 1rem;
    color: #718096;
    margin: 0;
}

/* Filter Card */
.price-filter-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
}

.filter-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid rgba(var(--bs-primary-rgb), 0.1);
}

.filter-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
    display: flex;
    align-items: center;
}

.filter-body .form-label {
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 0.5rem;
}

/* Stats Cards */
.price-stats-section {
    min-height: 100px;
}

.stat-card-price {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    transition: all 0.3s ease;
}

.stat-card-price:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.stat-price-label {
    font-size: 0.875rem;
    color: #718096;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-price-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--bs-primary);
    margin-bottom: 0.25rem;
}

.stat-price-change {
    font-size: 0.875rem;
    font-weight: 600;
}

.stat-price-change.positive {
    color: #28c76f;
}

.stat-price-change.negative {
    color: #ea5455;
}

/* Comparison Card */
.comparison-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
}

.comparison-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid rgba(var(--bs-primary-rgb), 0.1);
}

.comparison-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
    display: flex;
    align-items: center;
}

/* Table Styling */
.price-table {
    width: 100%;
    border-collapse: collapse;
}

.price-table thead {
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
}

.price-table thead th {
    padding: 1rem;
    font-weight: 700;
    text-align: left;
    font-size: 0.9375rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #ffffff !important; 
}

.price-table tbody tr {
    border-bottom: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.2);
    transition: all 0.3s ease;
}

.price-table tbody tr:hover {
    background: rgba(var(--bs-primary-rgb), 0.03);
}

.price-table tbody td {
    padding: 1rem;
    font-size: 0.9375rem;
    color:rgb(14, 12, 12);
}

.price-table tbody td:first-child {
    font-weight: 700;
    color: #2d3748;
}

.price-value {
    font-weight: 700;
    color: var(--bs-primary);
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: #718096;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 767.98px) {
    .price-filter-card,
    .comparison-card {
        padding: 1.5rem;
    }
    
    .section-title-center {
        font-size: 1.5rem;
    }
    
    .price-table {
        font-size: 0.875rem;
    }
    
    .price-table thead th,
    .price-table tbody td {
        padding: 0.75rem;
    }
}
</style>
@endpush

@push('script')
<script>
$(document).ready(function() {
    // Load initial data after a short delay
    setTimeout(function() {
        loadPriceData();
        // Stats will be calculated from comparison data
    }, 500);
    
    // Form submit handler
    $('#form-price-filter').on('submit', function(e) {
        e.preventDefault();
        loadPriceData();
        // Stats will be calculated from comparison data in loadPriceData
    });
    
    function loadPriceData() {
        var formData = {
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val()
        };
        
        $('#price-comparison-container').html(`
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat data harga pasar...</p>
            </div>
        `);
        
        $.ajax({
            url: "{{ route('home.get-price-comparison') }}",
            type: 'GET',
            data: formData,
            success: function(response) {
                console.log('Price comparison response:', response);
                
                // Handle different response structures
                var commodities = [];
                if (response.data && response.data.commodities) {
                    commodities = response.data.commodities;
                } else if (response.data && Array.isArray(response.data)) {
                    commodities = response.data;
                } else if (Array.isArray(response)) {
                    commodities = response;
                }
                
                console.log('Extracted commodities:', commodities);
                
                if (commodities && commodities.length > 0) {
                    // Filter only peternakan and perikanan commodities
                    var filteredCommodities = filterPeternakanPerikanan(commodities);
                    renderComparisonTable(filteredCommodities);
                    // Calculate and render stats from filtered commodities
                    renderPriceStatsFromComparison(filteredCommodities);
                } else {
                    $('#price-comparison-container').html(`
                        <div class="empty-state">
                            <i class="ti ti-inbox"></i>
                            <p>Tidak ada data harga untuk periode yang dipilih</p>
                        </div>
                    `);
                    $('#price-stats-container').html('<div class="col-12"><p class="text-center text-muted">Tidak ada statistik tersedia</p></div>');
                }
            },
            error: function(xhr) {
                console.error('Error loading price data:', xhr);
                $('#price-comparison-container').html(`
                    <div class="empty-state">
                        <i class="ti ti-alert-circle"></i>
                        <p>Gagal memuat data harga pasar</p>
                        <small class="text-muted">Silakan coba lagi atau hubungi administrator</small>
                    </div>
                `);
                $('#price-stats-container').html('<div class="col-12"><p class="text-center text-muted">Tidak ada statistik tersedia</p></div>');
            }
        });
    }
    
    function loadPriceStats() {
        var formData = {
            commodity_id: 1,
            date: $('#end_date').val() || '{{ date('Y-m-d') }}'
        };
        
        $.ajax({
            url: "{{ route('home.get-price-stats') }}",
            type: 'GET',
            data: formData,
            success: function(response) {
                var statsData = response.data || response;
                if (statsData && (statsData.average_price || statsData.harga_rata_rata || statsData.avg_price)) {
                    renderPriceStats(statsData);
                }
            },
            error: function() {
                // Stats will be calculated from comparison data if available
            }
        });
    }
    
    function renderPriceStatsFromComparison(commodities) {
        if (!commodities || commodities.length === 0) {
            $('#price-stats-container').html('<div class="col-12"><p class="text-center text-muted">Tidak ada statistik tersedia</p></div>');
            return;
        }
        
        // Calculate stats from commodities
        var prices = [];
        var totalPrice = 0;
        var naikCount = 0;
        var turunCount = 0;
        var totalChange = 0;
        var changeCount = 0;
        
        commodities.forEach(function(item) {
            var endPrice = item.end_price || 0;
            if (endPrice > 0) {
                prices.push(endPrice);
                totalPrice += endPrice;
            }
            if (item.change_status === 'naik') {
                naikCount++;
            } else if (item.change_status === 'turun') {
                turunCount++;
            }
            if (item.change_percentage !== undefined && item.change_percentage !== null) {
                totalChange += Math.abs(item.change_percentage);
                changeCount++;
            }
        });
        
        if (prices.length === 0) {
            $('#price-stats-container').html('<div class="col-12"><p class="text-center text-muted">Tidak ada statistik tersedia</p></div>');
            return;
        }
        
        var avgPrice = totalPrice / prices.length;
        var minPrice = Math.min.apply(Math, prices);
        var maxPrice = Math.max.apply(Math, prices);
        var avgChange = changeCount > 0 ? (totalChange / changeCount).toFixed(2) : 0;
        
        var statsHtml = `
            <div class="col-md-3">
                <div class="stat-card-price">
                    <div class="stat-price-label">Harga Rata-rata</div>
                    <div class="stat-price-value">Rp ${formatNumber(Math.round(avgPrice))}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card-price">
                    <div class="stat-price-label">Harga Terendah</div>
                    <div class="stat-price-value">Rp ${formatNumber(minPrice)}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card-price">
                    <div class="stat-price-label">Harga Tertinggi</div>
                    <div class="stat-price-value">Rp ${formatNumber(maxPrice)}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card-price">
                    <div class="stat-price-label">Total Komoditas</div>
                    <div class="stat-price-value" style="font-size: 1.5rem;">${commodities.length}</div>
                    <div class="stat-price-change mt-2">
                        <small class="text-success d-block mb-1"><i class="ti ti-arrow-up me-1"></i>Naik: ${naikCount}</small>
                        <small class="text-danger d-block"><i class="ti ti-arrow-down me-1"></i>Turun: ${turunCount}</small>
                    </div>
                </div>
            </div>
        `;
        
        $('#price-stats-container').html(statsHtml);
    }
    
    function filterPeternakanPerikanan(commodities) {
        if (!commodities || commodities.length === 0) {
            return [];
        }
        
        // Keywords for peternakan (livestock) and perikanan (fisheries)
        var peternakanKeywords = ['Daging', 'Telur'];
        var perikananKeywords = ['Ikan', 'Udang'];
        var allKeywords = peternakanKeywords.concat(perikananKeywords);
        
        return commodities.filter(function(item) {
            var commodityName = (item.comodity_name || item.commodity_name || item.commodity || item.nama_komoditas || item.komoditas || '').toLowerCase();
            
            // Check if commodity name contains any of the keywords
            return allKeywords.some(function(keyword) {
                return commodityName.includes(keyword.toLowerCase());
            });
        });
    }
    
    function renderComparisonTable(data) {
        if (!data || data.length === 0) {
            $('#price-comparison-container').html(`
                <div class="empty-state">
                    <i class="ti ti-inbox"></i>
                    <p>Tidak ada data untuk ditampilkan</p>
                </div>
            `);
            return;
        }
        
        var table = `
            <div class="table-responsive">
                <table class="table price-table">
                    <thead>
                        <tr>
                            <th>Komoditas</th>
                            <th>Satuan</th>
                            <th>Harga Awal</th>
                            <th>Harga Akhir</th>
                            <th>Perubahan</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        data.forEach(function(item) {
            var commodity = item.comodity_name || item.commodity_name || item.commodity || item.nama_komoditas || item.komoditas || '-';
            var unit = item.unit || item.satuan || item.unit_name || '-';
            var startPrice = item.start_price_format || 'Rp ' + formatNumber(item.start_price || 0);
            var endPrice = item.end_price_format || 'Rp ' + formatNumber(item.end_price || 0);
            var changePercent = item.change_percentage_format || (item.change_percentage !== undefined && item.change_percentage !== null ? (item.change_percentage > 0 ? '+' : '') + item.change_percentage.toFixed(2) + '%' : '-');
            var changeStatus = item.change_status || (item.change_percentage >= 0 ? 'naik' : 'turun');
            var changeClass = changeStatus === 'naik' ? 'text-success' : 'text-danger';
            var changeIcon = changeStatus === 'naik' ? 'ti-arrow-up' : 'ti-arrow-down';
            
            table += `
                <tr>
                    <td><strong>${commodity}</strong></td>
                    <td>${unit}</td>
                    <td class="price-value">${startPrice}</td>
                    <td class="price-value">${endPrice}</td>
                    <td>
                        <span class="${changeClass}">
                            <i class="ti ${changeIcon} me-1"></i>
                            ${changePercent}
                        </span>
                    </td>
                </tr>
            `;
        });
        
        table += `
                    </tbody>
                </table>
            </div>
        `;
        
        $('#price-comparison-container').html(table);
    }
    
    function renderPriceStats(data) {
        var statsHtml = '';
        
        // Handle different possible response structures
        var stats = data.data || data;
        
        if (stats.average_price || stats.harga_rata_rata || stats.avg_price) {
            var avgPrice = stats.average_price || stats.harga_rata_rata || stats.avg_price;
            statsHtml += `
                <div class="col-md-4">
                    <div class="stat-card-price">
                        <div class="stat-price-label">Harga Rata-rata</div>
                        <div class="stat-price-value">Rp ${formatNumber(avgPrice)}</div>
                    </div>
                </div>
            `;
        }
        
        if (stats.min_price || stats.harga_terendah || stats.minimum_price) {
            var minPrice = stats.min_price || stats.harga_terendah || stats.minimum_price;
            statsHtml += `
                <div class="col-md-4">
                    <div class="stat-card-price">
                        <div class="stat-price-label">Harga Terendah</div>
                        <div class="stat-price-value">Rp ${formatNumber(minPrice)}</div>
                    </div>
                </div>
            `;
        }
        
        if (stats.max_price || stats.harga_tertinggi || stats.maximum_price) {
            var maxPrice = stats.max_price || stats.harga_tertinggi || stats.maximum_price;
            statsHtml += `
                <div class="col-md-4">
                    <div class="stat-card-price">
                        <div class="stat-price-label">Harga Tertinggi</div>
                        <div class="stat-price-value">Rp ${formatNumber(maxPrice)}</div>
                    </div>
                </div>
            `;
        }
        
        $('#price-stats-container').html(statsHtml || '<div class="col-12"><p class="text-center text-muted">Tidak ada statistik tersedia</p></div>');
    }
    
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
});
</script>
@endpush
