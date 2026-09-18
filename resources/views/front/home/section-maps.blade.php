<section class="maps-section py-1">
    <div class="container">
        <div class="section-header-center mb-4">
            <div class="section-badge-center">
                <i class="ti ti-map me-2"></i>
                Peta Interaktif
            </div>
            <h2 class="section-title-center">Peta Lokasi Peternakan & Perikanan</h2>
            <p class="section-subtitle">Eksplorasi data geografis dengan peta interaktif</p>
        </div>
        
        <div class="row g-4">
            <div class="col-xl-9">
                <div class="map-wrapper">
                    <div id="map"></div>
                    <div class="map-overlay-info">
                        <div class="map-info-card">
                            <i class="ti ti-info-circle me-2"></i>
                            <span>Gunakan zoom dan pan untuk menjelajahi peta</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="map-filter-card">
                    <div class="filter-card-header-small">
                        <i class="ti ti-filter me-2"></i>
                        <strong>Filter Ruang</strong>
                    </div>
                    <div class="filter-checkbox-list">
                        @foreach ($getRuang as $item)
                            <label class="filter-checkbox-item">
                                <input type="checkbox" 
                                       value="{{ $item['name'] }}" 
                                       checked 
                                       class="filter-checkbox-input">
                                <span class="filter-checkbox-custom">
                                    <i class="ti ti-check filter-checkbox-icon"></i>
                                </span>
                                <span class="filter-color-indicator" 
                                      style="background-color: {{ $item['color'] }};"></span>
                                <span class="filter-checkbox-label">{{ $item['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="map" class=" rounded"></div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* ============================================
   MODERN MAPS SECTION STYLING
   ============================================ */

.maps-section {
    background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
    position: relative;
}

.map-wrapper {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    background: white;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    height: 600px;
}

#map {
    height: 100%;
    width: 100%;
    border-radius: 24px;
    z-index: 1;
}

.map-overlay-info {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 1000;
    pointer-events: none;
}

.map-info-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 0.75rem 1rem;
    border-radius: 12px;
    font-size: 0.875rem;
    color: var(--bs-body-color);
    display: flex;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.2);
}

.map-info-card i {
    color: var(--bs-primary);
    font-size: 1rem;
}

/* Map Filter Card */
.map-filter-card {
    background: white;
    border-radius: 16px;
    padding: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.filter-card-header-small {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--bs-body-color);
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid rgba(var(--bs-primary-rgb), 0.1);
    display: flex;
    align-items: center;
}

.filter-card-header-small i {
    color: var(--bs-primary);
    font-size: 0.9375rem;
}

.filter-checkbox-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.filter-checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    user-select: none;
    position: relative;
}

.filter-checkbox-item:hover {
    background: rgba(var(--bs-primary-rgb), 0.05);
    transform: translateX(5px);
}

.filter-checkbox-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.filter-checkbox-custom {
    width: 18px;
    height: 18px;
    min-width: 18px;
    min-height: 18px;
    border: 2px solid rgba(var(--bs-primary-rgb), 0.3);
    border-radius: 4px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
}

.filter-checkbox-icon {
    font-size: 0.75rem;
    color: white;
    opacity: 0;
    transform: scale(0);
    transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.filter-checkbox-input:checked ~ .filter-checkbox-custom {
    background: linear-gradient(135deg, var(--bs-primary) 0%, #5a52c7 100%);
    border-color: var(--bs-primary);
    box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.3);
}

.filter-checkbox-input:checked ~ .filter-checkbox-custom .filter-checkbox-icon {
    opacity: 1;
    transform: scale(1);
}

.filter-checkbox-item:hover .filter-checkbox-custom {
    border-color: var(--bs-primary);
    box-shadow: 0 2px 8px rgba(var(--bs-primary-rgb), 0.2);
}

.filter-color-indicator {
    width: 16px;
    height: 16px;
    min-width: 16px;
    min-height: 16px;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
}

.filter-checkbox-label {
    font-size: 0.8125rem;
    font-weight: 500;
    color: var(--bs-body-color);
    flex: 1;
    transition: color 0.2s ease;
    line-height: 1.4;
}

.filter-checkbox-item:hover .filter-checkbox-label {
    color: var(--bs-primary);
}

/* Leaflet Map Customization */
.leaflet-container {
    font-family: 'Inter', sans-serif;
    border-radius: 24px;
}

.leaflet-popup-content-wrapper {
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.leaflet-popup-content {
    margin: 1rem;
    font-size: 0.9375rem;
    line-height: 1.6;
}

/* Responsive */
@media (max-width: 1199.98px) {
    .map-wrapper {
        height: 500px;
    }
}

@media (max-width: 991.98px) {
    .map-filter-card {
        margin-top: 2rem;
        position: static;
    }
    
    .map-wrapper {
        height: 450px;
    }
}

@media (max-width: 767.98px) {
    .map-wrapper {
        height: 400px;
        border-radius: 16px;
    }
    
    .map-filter-card {
        border-radius: 16px;
        padding: 1.25rem;
    }
    
    .map-overlay-info {
        top: 0.5rem;
        right: 0.5rem;
    }
    
    .map-info-card {
        padding: 0.5rem 0.75rem;
        font-size: 0.75rem;
    }
}
</style>
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/shpjs/3.6.2/shp.min.js"></script>
<script>
    var map = L.map('map').setView([-6.5449956, 106.6492887], 13);
    var tileLayer;

    function addTileLayer(maxZoom) {
        if (tileLayer) {
            map.removeLayer(tileLayer);
        }
        tileLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: maxZoom,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    }

    addTileLayer(20);

    setTimeout(function() {
        map.setZoom(10);
    }, 2000);

    function getDataMap() {
        if ($('[name=q]').val() != "") {
            $.ajax({
                url: "{{ route('home.get-data-map-specific') }}",
                type: 'GET',
                data: {
                    q: $("[name=q]").val(),
                    jenis: $("[name=jenis]").val(),
                    id_kecamatan: $("[name=id_kecamatan]").val(),
                    id_kelurahan: $("[name=id_kelurahan]").val(),
                },
                success: function(data) {
                    data.map((data) => {
                        if (data.jenis == "perikanan") {
                            icon_maps = "{{ asset('assets/img/icon-blue-maps.png') }}";
                        } else {
                            icon_maps = "{{ asset('assets/img/icon-green-maps.png') }}";
                        }
                        var jenis_text = data.jenis == "peternakan" ? "Peternakan" : "Perikanan";
                        var kelurahanIcon = L.divIcon({
                            className: 'kecamatan-icon',
                            html: `<div style="text-align:center;">
                                <div style="color: #000; font-weight: bold;font-size:5pt;">${data.nama}</div>
                                <img src="${icon_maps}" style="width:30px; height:30px;"/>
                            </div>`,
                            iconSize: [110, 16]
                        });
                        var marker = L.marker([data.latitude, data.longitude], {
                                icon: kelurahanIcon
                            }).addTo(map)
                            .bindPopup(
                                `${jenis_text}: <strong>${data.nama}</strong> <br />
                            Kecamatan: <strong>${data.kecamatan.nama}</strong> <br />
                            Kelurahan: <strong>${data.kelurahan.nama}</strong> <br />
                        `);
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {
            $.ajax({
                url: "{{ route('home.get-data-map') }}",
                type: 'GET',
                data: {
                    id_kecamatan: $("[name=id_kecamatan]").val(),
                },
                success: function(data) {
                    data.map((data) => {
                        var kelurahanIcon = L.divIcon({
                            className: 'kelurahan-icon',
                            html: `<div style="text-align:center;">
                                <div style="color: #000; font-weight: bold;font-size:7pt;">${data.nama}</div>
                                <img src="{{ asset('assets/img/icon-blue-maps.png') }}" style="width:30px; height:30px;"/>
                            </div>`,
                            iconSize: [11, 16]
                        });
                        var marker = L.marker([data.latitude, data.longitude], {
                                icon: kelurahanIcon
                            }).addTo(map)
                            .bindPopup(
                                `Kecamatan: <strong>${data.nama}</strong> <br />
                            Peternakan: <strong>${data.peternakan_count}</strong> <br /> 
                            Perikanan: <strong>${data.perikanan_count}</strong> <br /> 
                            <div class='mt-2'><button class='btn btn-danger btn-sm' onclick='setView(${data.latitude}, ${data.longitude});getDataSubMap(${data.id})'>Lihat per Kelurahan</button></div>
                        `);
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    }
    
    var kelurahanIcon = L.icon({
        iconUrl: "{{ asset('assets/img/icon-red-maps.png') }}",
        iconSize: [12, 17],
    });

    function getDataSubMap(id_kecamatan) {
        $.ajax({
            url: "{{ route('home.get-data-sub-map') }}",
            type: 'GET',
            data: {
                id_kecamatan: id_kecamatan,
                id_kelurahan: $("[name=id_kelurahan]").val(),
            },
            success: function(data) {
                data.map((data) => {
                    var kelurahanIcon = L.divIcon({
                        className: 'kelurahan-icon',
                        html: `<div style="text-align:center;">
                            <div style="color: #000; font-weight: bold;font-size:6pt;">${data.nama}</div>
                            <img src="{{ asset('assets/img/icon-red-maps.png') }}" style="width:15px; height:20px;"/>
                        </div>`,
                        iconSize: [11, 16]
                    });
                    var marker = L.marker([data.latitude, data.longitude], {
                            icon: kelurahanIcon
                        }).addTo(map)
                        .bindPopup(
                            `Kelurahan: <strong>${data.nama}</strong> <br />
                        Peternakan: <strong>${data.peternakan_count}</strong> <br />
                        Perikanan: <strong>${data.perikanan_count}</strong> <br />
                    `);
                });
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    getDataMap();

    if ($("[name=id_kecamatan]").val() != "") {
        if ($("[name=q]").val() == "") {
            setTimeout(() => {
                setView($("[name=latitude]").val(), $("[name=longitude]").val(), 13);
            }, 1000);
            getDataSubMap($("[name=id_kecamatan]").val());
        }
    }

    function setView(latitude, longitude, maxZoom = 12) {
        addTileLayer(maxZoom);
        setTimeout(() => {
            map.setView([latitude, longitude], maxZoom);
        }, 0);
    }

    $(document).on('change', '[name=id_kecamatan]', function() {
        $('[name=id_kelurahan]').empty();
        $('[name=id_kelurahan]').append('<option value="">Pilih</option>');
        var id_kecamatan = $(this).val();
        if (id_kecamatan) {
            $.ajax({
                url: "{{ route('general.kelurahan') }}",
                type: 'GET',
                data: {
                    id_kecamatan: id_kecamatan
                },
                dataType: 'json',
                success: function(data) {
                    $('[name=id_kelurahan]').empty();
                    $('[name=id_kelurahan]').append('<option value="">Pilih</option>');
                    $.each(data.data, function(key, value) {
                        $('[name=id_kelurahan]').append('<option value="' +
                            value.id + '">' + value.nama + '</option>');
                    });
                }
            });
        }
    });
    
    let geojsonLayer;

    function loadShapefile() {
        const shapefilePath = "{{ asset('assets/lainnya/RTRW_2016.zip') }}";

        shp(shapefilePath).then(function(geojson) {
            console.log(geojson);

            geojsonLayer = L.geoJSON(geojson, {
                style: function(feature) {
                    return {
                        color: getColor(feature.properties),
                        weight: 2
                    };
                },
                onEachFeature: function(feature, layer) {
                    let popupContent = "<strong>Informasi Area:</strong><br>";
                    for (const key in feature.properties) {
                        popupContent += `${key}: ${feature.properties[key]}<br>`;
                    }
                    layer.bindPopup(popupContent);
                }
            }).addTo(map);

            setupCheckboxFilters();
        }).catch(function(error) {
            console.error("Error loading shapefile:", error);
        });
    }

    const ruangColors = @json($getRuang).reduce((acc, item) => {
        acc[item.name] = item.color;
        return acc;
    }, {});

    function getColor(jenisArea) {
        const ruang = jenisArea.Ruang;
        return ruangColors[ruang] || "#FFA500";
    }

    function setupCheckboxFilters() {
        const checkboxes = document.querySelectorAll(".filter-checkbox-input");

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", applyFilters);
        });
    }

    function applyFilters() {
        const checkboxes = document.querySelectorAll(".filter-checkbox-input");
        const activeRuang = [];

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                activeRuang.push(checkbox.value);
            }
        });

        if (geojsonLayer) {
            map.removeLayer(geojsonLayer);
        }

        geojsonLayer = L.geoJSON(geojsonLayer.toGeoJSON(), {
            style: function(feature) {
                if (activeRuang.includes(feature.properties.Ruang)) {
                    return {
                        color: getColor(feature.properties),
                        weight: 2
                    };
                } else {
                    return {
                        opacity: 0,
                        fillOpacity: 0
                    };
                }
            },
            onEachFeature: function(feature, layer) {
                if (activeRuang.includes(feature.properties.Ruang)) {
                    let popupContent = "<strong>Informasi Area:</strong><br>";
                    for (const key in feature.properties) {
                        popupContent += `${key}: ${feature.properties[key]}<br>`;
                    }
                    layer.bindPopup(popupContent);
                }
            }
        }).addTo(map);
    }

    loadShapefile();
</script>
@endpush
