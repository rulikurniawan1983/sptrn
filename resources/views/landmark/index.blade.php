@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="card-title mb-0"><i class="ti ti-map"></i> Peta Persebaran Landmark</h5>
        </div>
        <div class="card-body p-0">
            <div id="main-landmark-map" style="width: 100%; height: 500px;"></div>
        </div>
    </div>

    <div class="card shadow-sm">
        @include('base-page.header-index')
        <div class="card-datatable">
            <table class="datatables-users table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">
                            <input type="checkbox" id="CheckAll" style="position: relative;left: 0px;opacity: 1;">
                        </th>
                        <th width="1%" class="text-center">Opsi</th>
                        <th width="1%">ID</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th width="1%">Latitude</th>
                        <th width="1%">Longitude</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/leaflet/leaflet.css') }}" />
@endpush
@push('script')
<script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
<script src="{{ asset('assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script>
        var table;
        $(document).ready(function() {
            // Initialize Map
            var map = L.map('main-landmark-map').setView([-6.5594, 106.7925], 11);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            var landmarksData = @json($all_landmarks ?? []);
            var bounds = [];

            // Add markers
            landmarksData.forEach(function(item) {
                if (item.latitude && item.longitude) {
                    var lat = parseFloat(item.latitude);
                    var lng = parseFloat(item.longitude);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        var marker = L.marker([lat, lng]).addTo(map);
                        marker.bindPopup(`<b>${item.nama}</b><br>Kategori: ${item.kategori}<br>Alamat: ${item.alamat ?? '-'}`);
                        bounds.push([lat, lng]);
                    }
                }
            });

            if (bounds.length > 0) {
                map.fitBounds(bounds, { padding: [50, 50] });
            }

            // Esri MapServer Overlay
            var esriLayer = L.esri.dynamicMapLayer({
                url: 'https://geoportal.bogorkab.go.id/server/rest/services/RTRW_2024/RTRW_Perda_1/MapServer',
                opacity: 0.6
            }).addTo(map);

            // Add Identify (Click) event for MapServer
            map.on('click', function(e) {
                esriLayer.identify().on(map).at(e.latlng).run(function(error, featureCollection) {
                    if (error) return;
                    
                    if (featureCollection.features.length > 0) {
                        let popupContent = "<div style='max-height: 250px; overflow-y: auto; padding-right: 10px;'><strong>Informasi Tata Ruang:</strong><br>";
                        // Get the first feature found
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
                    }
                });
            });

            setTimeout(function() {
                map.invalidateSize();
            }, 500);

            table = $('#DataTable').DataTable({
                'lengthMenu': [
                    [10, 25, 50, 100, 200, 350, -1],
                    [10, 25, 50, 100, 200, 350, "All"]
                ],
                'scrollY': '400px',
                'scrollX': true,
                'searching': true,
                'processing': true,
                'serverSide': true,
                'order': [],
                'ajax': {
                    url: "{{ route($route . '.table') }}",
                    type: "POST",
                    data: function(d) {
                        // d.name_level = "";
                    },
                    "error": function(jqXHR) {
                        toastr.error("Error Load Data on Table: " + jqXHR.responseJSON.message);
                    }
                },
                "fnDrawCallback": function(oSettings) {
                    $('#DataTable').find('input:checkbox').prop('checked', false);
                    CheckTotalCheckedData();
                },
                "createdRow": function(row, data, index) {},
                "columns": [{
                        "data": null,
                        render: function(data, type, row, meta) {
                            return +meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return "<input type='checkbox' class='CheckboxRow' onclick='CheckTotalCheckedData()' data-id='" +
                                row.id + "' style='position: relative;left: 0px;opacity: 1;'/>";
                        },
                    },
                    {
                        "data": "options",
                        "className": "text-center"
                    },
                    {
                        "data": "id",
                    },
                    {
                        "data": "kategori",
                    },
                    {
                        "data": "nama",
                    },
                    {
                        "data": "latitude",
                    },
                    {
                        "data": "longitude",
                    },
                ],
                "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": [0, 1, 2],
                    },
                    {
                        "className": "text-center",
                        "targets": [0, 1]
                    }
                ],
            });
            // $("#DataTable_filter").find('.form-control').removeClass('form-control-sm');
            $("#CheckAll").click(function() {
                $('#DataTable').find('.CheckboxRow').not(this).prop('checked', this.checked);
                CheckTotalCheckedData();
            });

            setTimeout(() => {
                $('.dataTables_filter input').attr('name', 'q');
                $('.dataTables_filter input').unbind().on('input', debounce(function() {
                    table.search(this.value).draw();
                }, 500)); // 500ms delay
            }, 0);
        });

        function CheckTotalCheckedData() {
            CheckTotalChecked(['#DeleteSelected']);
        }
    </script>
@endpush
