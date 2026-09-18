<div class="row">
    <div class="col-md-6">
        <x-form-input name="nama" label="Nama" autofocus required />
        <div class="form-group mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="UMKM" {{ (isset($data) && $data->kategori == 'UMKM') ? 'selected' : '' }}>UMKM</option>
                <option value="Fasilitas" {{ (isset($data) && $data->kategori == 'Fasilitas') ? 'selected' : '' }}>Fasilitas Umum</option>
                <option value="User" {{ (isset($data) && $data->kategori == 'User') ? 'selected' : '' }}>User</option>
                <option value="Lainnya" {{ (isset($data) && $data->kategori == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>
        <x-form-input type="textarea" name="alamat" label="Alamat" />
        <x-form-input type="textarea" name="keterangan" label="Keterangan" />
        
        <div class="row">
            <div class="col-md-6">
                <x-form-input name="latitude" label="Latitude" required />
            </div>
            <div class="col-md-6">
                <x-form-input name="longitude" label="Longitude" required />
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <label class="form-label">Pilih Lokasi di Peta</label>
        <div id="landmark-map" style="width: 100%; height: 450px; border-radius: 8px; border: 1px solid #d9dee3;"></div>
        <small class="text-muted">Klik pada peta atau geser marker untuk menentukan koordinat.</small>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" />
@endpush

@push('script')
<script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
<script>
    $(document).ready(function() {
        var latInput = $('input[name="latitude"]');
        var lngInput = $('input[name="longitude"]');
        
        // Default to Bogor
        var startLat = latInput.val() ? parseFloat(latInput.val()) : -6.5594;
        var startLng = lngInput.val() ? parseFloat(lngInput.val()) : 106.7925;
        
        var map = L.map('landmark-map').setView([startLat, startLng], 12);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);
        
        var marker = L.marker([startLat, startLng], {
            draggable: true
        }).addTo(map);

        setTimeout(function() {
            map.invalidateSize();
        }, 500);
        
        // Update inputs on drag end
        marker.on('dragend', function (e) {
            var position = marker.getLatLng();
            latInput.val(position.lat);
            lngInput.val(position.lng);
        });
        
        // Update marker and inputs on map click
        map.on('click', function(e) {
            var position = e.latlng;
            marker.setLatLng(position);
            latInput.val(position.lat);
            lngInput.val(position.lng);
        });
        
        // Sync map when inputs are manually changed
        latInput.on('input', function() {
            var lat = parseFloat($(this).val());
            var lng = parseFloat(lngInput.val());
            if(!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.panTo([lat, lng]);
            }
        });
        
        lngInput.on('input', function() {
            var lat = parseFloat(latInput.val());
            var lng = parseFloat($(this).val());
            if(!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.panTo([lat, lng]);
            }
        });
    });
</script>
@endpush