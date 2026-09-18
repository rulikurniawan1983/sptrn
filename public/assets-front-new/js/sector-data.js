(() => {
    'use strict';

    const sector = document.body.dataset.sector;
    if (!['peternakan', 'perikanan'].includes(sector)) return;

    const isLivestock = sector === 'peternakan';
    const sectorLabel = isLivestock ? 'Peternakan' : 'Perikanan';
    const sectorIcon = isLivestock ? '🐄' : '🐟';
    const accent = isLivestock ? '#15963a' : '#0878bd';
    const accentDark = isLivestock ? '#0c742b' : '#075a98';
    const mapField = isLivestock ? 'peternakan' : 'perikanan';

    const CONFIG = Object.freeze({
        apiBase: '',
        endpoints: {
            kecamatan: '/home/get-data-map',
            desa: '/home/get-data-sub-map',
            priceComparison: '/home/get-price-comparison'
        },
        fallback: {
            kecamatan: '/assets-front-new/backup-kecamatan.json',
            desa: '/assets-front-new/data-desa.json',
            priceComparison: '/assets-front-new/data-perbandingan.json'
        },
        expectedVillages: 435
    });

    const $id = (id) => document.getElementById(id);
    const setText = (id, value) => {
        const element = $id(id);
        if (element) element.textContent = value;
    };
    const formatNumber = (value) => Number.isFinite(Number(value))
        ? Number(value).toLocaleString('id-ID')
        : '—';
    const formatRupiah = (value) => Number.isFinite(Number(value))
        ? new Intl.NumberFormat('id-ID', {
            style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0
        }).format(Number(value))
        : 'Rp —';
    const escapeHtml = (value) => String(value ?? '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

    function unwrapList(payload) {
        if (Array.isArray(payload)) return payload;
        if (Array.isArray(payload?.data)) return payload.data;
        if (Array.isArray(payload?.result)) return payload.result;
        if (Array.isArray(payload?.kecamatan)) return payload.kecamatan;
        if (Array.isArray(payload?.desa)) return payload.desa;
        if (Array.isArray(payload?.data?.data)) return payload.data.data;
        if (Array.isArray(payload?.data?.kecamatan)) return payload.data.kecamatan;
        if (Array.isArray(payload?.data?.desa)) return payload.data.desa;
        return [];
    }

    function unwrapObject(payload) {
        if (!payload || typeof payload !== 'object' || Array.isArray(payload)) return {};
        if (payload.data && typeof payload.data === 'object' && !Array.isArray(payload.data)) return payload.data;
        return payload;
    }

    async function fetchJson(url, timeout = 15000) {
        const controller = new AbortController();
        const timer = window.setTimeout(() => controller.abort(), timeout);
        try {
            const response = await fetch(url, {
                headers: { Accept: 'application/json' },
                cache: 'no-store',
                signal: controller.signal
            });
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            return await response.json();
        } finally {
            window.clearTimeout(timer);
        }
    }

    async function fetchWithFallback(endpoint, fallbackFile) {
        try {
            return await fetchJson(`${CONFIG.apiBase}${endpoint}`);
        } catch (liveError) {
            console.warn(`Endpoint ${endpoint} gagal, mencoba data lokal.`, liveError);
            if (!fallbackFile) throw liveError;
            return fetchJson(fallbackFile, 8000);
        }
    }

    function normalizeMapItem(item) {
        const district = item?.kecamatan && typeof item.kecamatan === 'object' ? item.kecamatan : {};
        return {
            id: item?.id,
            districtId: item?.id_kecamatan ?? item?.idKecamatan ?? district.id,
            name: item?.nama ?? item?.name ?? 'Tanpa nama',
            districtName: district.nama ?? item?.nama_kecamatan ?? item?.namaKecamatan ?? '',
            latitude: Number(item?.latitude ?? item?.lat),
            longitude: Number(item?.longitude ?? item?.lng ?? item?.lon),
            peternakan: Number(item?.peternakan_count ?? item?.jumlah_peternakan ?? item?.peternakan ?? 0),
            perikanan: Number(item?.perikanan_count ?? item?.jumlah_perikanan ?? item?.perikanan ?? 0),
            villages: Number(
                item?.desa_kelurahan_count ?? item?.jumlah_desa_kelurahan ?? item?.kelurahan_count ??
                item?.desa_count ?? item?.sub_map_count ?? item?.village_count ?? 0
            )
        };
    }

    function classifyCommodity(item) {
        const explicit = String(
            item?.sector ?? item?.sektor ?? item?.category ?? item?.kategori ??
            item?.commodity_category ?? item?.comodity_category ?? item?.jenis ?? ''
        ).toLowerCase();
        if (explicit.includes('peternak') || explicit.includes('ternak') || explicit.includes('livestock')) return 'peternakan';
        if (explicit.includes('perikan') || explicit.includes('ikan') || explicit.includes('fish')) return 'perikanan';

        const name = String(item?.comodity_name ?? item?.commodity_name ?? item?.nama ?? '')
            .toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        const livestock = [
            /\bdaging\s+(sapi|ayam|kambing|domba|kerbau|bebek|itik)\b/,
            /\b(sapi|ayam|kambing|domba|kerbau|bebek|itik|unggas|puyuh)\b/,
            /\b(telur|susu|jeroan|hati\s+ampela)\b/
        ];
        const fishery = [
            /\bikan\b/,
            /\b(udang|cumi(?:-cumi)?|kepiting|rajungan|kerang|lobster|belut)\b/,
            /\b(bandeng|tongkol|kembung|lele|nila|gurame|gurami|patin|bawal|mujair|tuna|teri|sarden|salmon|kakap)\b/
        ];
        if (livestock.some((pattern) => pattern.test(name))) return 'peternakan';
        if (fishery.some((pattern) => pattern.test(name))) return 'perikanan';
        return null;
    }

    function commodityName(item) {
        return item?.comodity_name || item?.commodity_name || item?.nama || 'Komoditas';
    }

    function normalizeComparison(payload) {
        const data = unwrapObject(payload);
        const raw = Array.isArray(data.commodities) ? data.commodities
            : Array.isArray(data.comodities) ? data.comodities
                : [];
        const commodities = raw
            .map((item) => ({ ...item, spartanSector: classifyCommodity(item) }))
            .filter((item) => item.spartanSector === sector);
        return { ...data, commodities };
    }

    function renderPriceSummary(comparison) {
        const priced = comparison.commodities
            .map((item) => ({ ...item, currentPrice: Number(item.end_price ?? item.price) }))
            .filter((item) => Number.isFinite(item.currentPrice) && item.currentPrice > 0);

        setText('stat-count', formatNumber(comparison.commodities.length));
        setText('stat-count-label', `komoditas ${sectorLabel.toLowerCase()}`);

        if (!priced.length) {
            ['stat-avg', 'stat-low', 'stat-high'].forEach((id) => setText(id, '—'));
            setText('card-lowest-name', 'Data belum tersedia');
            setText('card-highest-name', 'Data belum tersedia');
            setText('card-avg-name', `Komoditas ${sectorLabel}`);
            return;
        }

        const lowest = priced.reduce((a, b) => a.currentPrice <= b.currentPrice ? a : b);
        const highest = priced.reduce((a, b) => a.currentPrice >= b.currentPrice ? a : b);
        const average = priced.reduce((sum, item) => sum + item.currentPrice, 0) / priced.length;

        const avgFormatted = formatRupiah(average);
        const lowFormatted = formatRupiah(lowest.currentPrice);
        const highFormatted = formatRupiah(highest.currentPrice);

        setText('stat-avg', avgFormatted.replace(/^Rp\s?/, ''));
        setText('stat-low', lowFormatted.replace(/^Rp\s?/, ''));
        setText('stat-high', highFormatted.replace(/^Rp\s?/, ''));
        setText('stat-avg-market', 'Rata-rata harga');
        setText('stat-low-market', commodityName(lowest));
        setText('stat-high-market', commodityName(highest));

        setText('card-lowest-val', lowFormatted);
        setText('card-lowest-name', commodityName(lowest));
        setText('card-lowest-market', lowest.market_name || 'Data terbaru');
        setText('card-highest-val', highFormatted);
        setText('card-highest-name', commodityName(highest));
        setText('card-highest-market', highest.market_name || 'Data terbaru');
        setText('card-avg-val', avgFormatted);
        setText('card-avg-name', `${formatNumber(priced.length)} komoditas ${sectorLabel.toLowerCase()}`);
    }

    function renderPriceChart(comparison) {
        const container = $id('price-chart-container');
        if (!container) return;
        const commodities = comparison.commodities.slice(0, 10);
        if (!commodities.length || typeof Highcharts === 'undefined') {
            container.innerHTML = '<div class="chart-empty-state">Data grafik sektor ini belum tersedia.</div>';
            return;
        }

        Highcharts.chart(container, {
            chart: { type: 'column', backgroundColor: 'transparent', spacing: [18, 16, 12, 10] },
            title: { text: null },
            subtitle: {
                text: comparison.start_date && comparison.end_date
                    ? `${sectorLabel} · ${comparison.start_date} sampai ${comparison.end_date}`
                    : `Perbandingan harga ${sectorLabel.toLowerCase()}`
            },
            xAxis: {
                categories: commodities.map(commodityName),
                crosshair: true,
                lineColor: '#dfe7ec',
                labels: { style: { color: '#64748b', fontSize: '10px' } }
            },
            yAxis: {
                min: 0,
                gridLineColor: '#edf1f4',
                title: { text: 'Harga (Rp)', style: { color: '#64748b' } },
                labels: { style: { color: '#64748b', fontSize: '10px' } }
            },
            tooltip: {
                shared: true,
                formatter() {
                    let output = `<b>${escapeHtml(this.x)}</b>`;
                    this.points.forEach((point) => {
                        output += `<br>${escapeHtml(point.series.name)}: ${formatRupiah(point.y)}`;
                    });
                    return output;
                }
            },
            legend: { itemStyle: { color: '#314238', fontSize: '11px', fontWeight: '600' } },
            plotOptions: { column: { pointPadding: 0.16, groupPadding: 0.12, borderWidth: 0, borderRadius: 4 } },
            series: [
                { name: 'Harga Awal', data: commodities.map((item) => Number(item.start_price) || 0), color: '#e07a69' },
                { name: 'Harga Akhir', data: commodities.map((item) => Number(item.end_price) || 0), color: accent }
            ],
            credits: { enabled: false }
        });
    }

    function renderPriceTable(comparison) {
        const body = $id('commodity-table-body');
        if (!body) return;
        if (!comparison.commodities.length) {
            body.innerHTML = '<tr><td colspan="6" class="table-empty-state">Data harga sektor ini belum tersedia.</td></tr>';
            return;
        }

        body.innerHTML = comparison.commodities.map((item, index) => {
            const start = Number(item.start_price) || 0;
            const end = Number(item.end_price) || 0;
            const supplied = Number(item.change_percentage);
            const change = Number.isFinite(supplied) ? supplied : start ? ((end - start) / start) * 100 : 0;
            const state = change > 0 ? 'naik' : change < 0 ? 'turun' : 'tetap';
            const icon = change > 0 ? '↑' : change < 0 ? '↓' : '–';
            const sign = change > 0 ? '+' : '';
            return `<tr>
                <td>${index + 1}</td>
                <td>${escapeHtml(commodityName(item))}</td>
                <td>${escapeHtml(item.unit || '—')}</td>
                <td>${formatRupiah(start)}</td>
                <td><strong>${formatRupiah(end)}</strong></td>
                <td><span class="commodity-change ${state}">${icon} ${sign}${change.toFixed(2)}%</span></td>
            </tr>`;
        }).join('');
        setText('commodity-sector-status', `${formatNumber(comparison.commodities.length)} Komoditas ${sectorLabel}`);
    }

    let map = null;
    let mapLayers = [];
    let districtCache = [];
    let geojsonLayer = null;

    function loadShapefile() {
        if (!map || typeof L.esri === 'undefined') return;
        
        var esriLayer = L.esri.dynamicMapLayer({
            url: 'https://geoportal.bogorkab.go.id/server/rest/services/RTRW_2024/RTRW_Perda_1/MapServer',
            opacity: 0.6
        }).addTo(map);

        map.on('click', function(e) {
            esriLayer.identify().on(map).at(e.latlng).run(function(error, featureCollection) {
                if (error || !featureCollection.features || featureCollection.features.length === 0) return;
                
                let popupContent = "<div style='max-height: 250px; overflow-y: auto; padding-right: 10px;'><strong>Informasi Tata Ruang:</strong><br>";
                let feature = featureCollection.features[0];
                if (feature.properties) {
                    for (let key in feature.properties) {
                        if (key !== 'OBJECTID' && key !== 'Shape' && key !== 'Shape.STArea()' && key !== 'Shape.STLength()' && feature.properties[key] !== 'Null') {
                            popupContent += `${key}: ${feature.properties[key]}<br>`;
                        }
                    }
                }
                popupContent += "</div>";
                L.popup().setLatLng(e.latlng).setContent(popupContent).openOn(map);
            });
        });
    }

    function clearMapLayers() {
        if (!map) return;
        mapLayers.forEach((layer) => map.removeLayer(layer));
        mapLayers = [];
    }

    function renderMap(items, type = 'kecamatan') {
        if (!map || typeof L === 'undefined') return;
        clearMapLayers();
        const bounds = [];
        items.map(normalizeMapItem).forEach((item) => {
            if (!Number.isFinite(item.latitude) || !Number.isFinite(item.longitude)) return;
            const count = Number(item[mapField]) || 0;
            bounds.push([item.latitude, item.longitude]);
            const parent = type === 'desa' && item.districtName
                ? `<br>Kecamatan: ${escapeHtml(item.districtName)}` : '';
            const popup = `<b>${escapeHtml(item.name)}</b><br>${type === 'desa' ? 'Desa/Kelurahan' : 'Kecamatan'}${parent}` +
                `<br>${sectorLabel}: ${formatNumber(count)}`;
            const radius = Math.max(6, Math.min(16, 6 + Math.sqrt(count || 0)));
            const marker = L.circleMarker([item.latitude, item.longitude], {
                radius,
                color: accentDark,
                weight: 2,
                fillColor: accent,
                fillOpacity: 0.78
            }).addTo(map).bindPopup(popup);
            mapLayers.push(marker);
        });
        if (bounds.length === 1) map.setView(bounds[0], type === 'desa' ? 14 : 11);
        else if (bounds.length > 1) map.fitBounds(bounds, { padding: [24, 24], maxZoom: type === 'desa' ? 14 : 11 });
    }

    function populateDistrictSelect(items) {
        const select = $id('kecamatan-select');
        if (!select) return;
        select.querySelectorAll('option:not(:first-child)').forEach((option) => option.remove());
        items.slice().sort((a, b) => a.name.localeCompare(b.name, 'id')).forEach((item) => {
            const option = new Option(item.name, item.id, false, false);
            select.add(option);
        });

        if (window.jQuery && window.jQuery.fn?.select2) {
            const jq = window.jQuery(select);
            if (jq.hasClass('select2-hidden-accessible')) jq.select2('destroy');
            jq.select2({ placeholder: 'Pilih Kecamatan', allowClear: true, width: '100%' });
            jq.off('change.sectorData').on('change.sectorData', () => loadVillages(jq.val()));
        } else {
            select.addEventListener('change', () => loadVillages(select.value));
        }
    }

    function renderDistribution(items) {
        const normalized = items.map(normalizeMapItem);
        const total = normalized.reduce((sum, item) => sum + (Number(item[mapField]) || 0), 0);
        const active = normalized.filter((item) => Number(item[mapField]) > 0).length;
        const villageTotal = normalized.reduce((sum, item) => sum + (Number(item.villages) || 0), 0) || CONFIG.expectedVillages;

        setText('distribution-total-sector', formatNumber(total));
        setText('distribution-total-districts', formatNumber(normalized.length));
        setText('distribution-total-villages', formatNumber(villageTotal));
        setText('distribution-total-active', formatNumber(active));
        setText('distribution-data-status', `${formatNumber(normalized.length)} Kecamatan`);

        const target = $id('district-sector-chart');
        if (!target) return;
        const chartData = normalized
            .filter((item) => Number(item[mapField]) > 0)
            .sort((a, b) => Number(b[mapField]) - Number(a[mapField]))
            .map((item) => ({ name: item.name, y: Number(item[mapField]) || 0 }));

        const chartCard = target.closest('.district-chart-card');
        if (!chartData.length || typeof Highcharts === 'undefined') {
            target.innerHTML = '<div class="table-empty-state">Data distribusi kecamatan belum tersedia.</div>';
            if (chartCard) chartCard.classList.add('is-chart-ready');
            return;
        }

        Highcharts.chart(target, {
            chart: { type: 'pie', backgroundColor: 'transparent', height: 440, spacing: [12, 12, 10, 12] },
            title: { text: null },
            accessibility: { enabled: false },
            tooltip: {
                useHTML: true,
                formatter() {
                    return `<b>${escapeHtml(this.key)}</b><br>${formatNumber(this.y)} data (${Number(this.percentage).toFixed(1)}%)`;
                }
            },
            legend: {
                enabled: true,
                align: 'center', verticalAlign: 'bottom', layout: 'horizontal', maxHeight: 105,
                itemWidth: 135, itemStyle: { color: '#344054', fontSize: '10px', fontWeight: '500' }
            },
            plotOptions: {
                pie: {
                    size: '59%', innerSize: '50%', center: ['50%', '39%'],
                    borderColor: '#fff', borderWidth: 3, showInLegend: true,
                    dataLabels: {
                        enabled: true, distance: 14, allowOverlap: false,
                        style: { color: '#111827', fontSize: '10px', fontWeight: '600', textOutline: '2px #fff' },
                        formatter() { return `${this.point.name}<br>${formatNumber(this.y)}`; }
                    }
                }
            },
            series: [{
                name: sectorLabel,
                colorByPoint: true,
                colors: isLivestock
                    ? ['#28c76f', '#22b863', '#1ea850', '#18903d', '#11782a', '#0a6017', '#034804']
                    : ['#08c4d8', '#08b5cf', '#079fbd', '#0787aa', '#086f98', '#075a86', '#064773'],
                data: chartData
            }],
            credits: { enabled: false },
            exporting: { enabled: false }
        });
        if (chartCard) chartCard.classList.add('is-chart-ready');
    }

    async function loadVillages(districtId) {
        if (!districtId) {
            renderMap(districtCache, 'kecamatan');
            return;
        }
        if (typeof showToast === 'function') showToast('Memuat data desa/kelurahan…');
        const endpoint = `${CONFIG.endpoints.desa}?id_kecamatan=${encodeURIComponent(districtId)}`;
        try {
            const payload = await fetchWithFallback(endpoint, null);
            const items = unwrapList(payload);
            if (!items.length) throw new Error('Data desa kosong.');
            renderMap(items, 'desa');
            if (geojsonLayer && map) geojsonLayer.bringToBack();
        } catch (error) {
            console.warn('Data desa live gagal, mencoba fallback.', error);
            try {
                const local = unwrapList(await fetchJson(CONFIG.fallback.desa, 8000));
                const filtered = local.filter((item) => Number(item.id_kecamatan) === Number(districtId));
                if (!filtered.length) throw new Error('Data fallback desa kosong.');
                renderMap(filtered, 'desa');
                if (geojsonLayer && map) geojsonLayer.bringToBack();
            } catch (fallbackError) {
                console.error(fallbackError);
                if (typeof showToast === 'function') showToast('Data desa/kelurahan belum dapat dimuat.');
            }
        }
    }

    async function initMapAndDistribution() {
        const mapElement = $id('spartan-map');
        if (!mapElement || typeof L === 'undefined') return;
        map = L.map(mapElement).setView([-6.5594, 106.7925], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors', maxZoom: 19
        }).addTo(map);

        try {
            const payload = await fetchWithFallback(CONFIG.endpoints.kecamatan, CONFIG.fallback.kecamatan);
            const raw = unwrapList(payload);
            districtCache = raw.map(normalizeMapItem);
            renderMap(raw, 'kecamatan');
            loadShapefile();
            renderDistribution(raw);
            populateDistrictSelect(districtCache);
            if (!raw.length && typeof showToast === 'function') showToast(`Data wilayah ${sectorLabel.toLowerCase()} belum tersedia.`);
        } catch (error) {
            console.error('Data peta gagal dimuat.', error);
            if (typeof showToast === 'function') showToast('Data peta SPARTAN belum dapat dimuat.');
        }
    }

    async function initPrices() {
        try {
            const payload = await fetchWithFallback(CONFIG.endpoints.priceComparison, CONFIG.fallback.priceComparison);
            const comparison = normalizeComparison(payload);
            renderPriceSummary(comparison);
            renderPriceChart(comparison);
            renderPriceTable(comparison);
        } catch (error) {
            console.error('Data harga sektoral gagal dimuat.', error);
            renderPriceSummary({ commodities: [] });
            renderPriceChart({ commodities: [] });
            renderPriceTable({ commodities: [] });
            if (typeof showToast === 'function') showToast(`Statistik ${sectorLabel.toLowerCase()} belum dapat dimuat.`);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        initMapAndDistribution();
        initPrices();
    });
})();
