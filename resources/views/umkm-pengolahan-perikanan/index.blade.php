@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-index')
        <div class="card-datatable">
            <table class="datatables-users table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%" class="text-center">Opsi</th>
                        <th>Nama Pelaku Usaha</th>
                        <th>Alamat</th>
                        <th>Desa/Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Produk Utama</th>
                        <th>Jumlah Produksi/Bulan (Kg)</th>
                        <th>Wilayah Pemasaran</th>
                        <th>Legalitas</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('script')
<script>
    var table;
    $(document).ready(function() {
        table = $('#DataTable').DataTable({
            'lengthMenu': [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
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
                data: function(d) {},
                "error": function(jqXHR) {
                    toastr.error("Error Load Data on Table: " + jqXHR.responseJSON.message);
                }
            },
            "columns": [
                { "data": null, render: function(data, type, row, meta) { return +meta.row + meta.settings._iDisplayStart + 1; } },
                { "data": "options", "className": "text-center" },
                { "data": "nama_pelaku_usaha" },
                { "data": "alamat" },
                { "data": "desa" },
                { "data": "kecamatan" },
                { "data": "produk_utama" },
                { "data": "jumlah_produksi_bulan" },
                { "data": "wilayah_pemasaran" },
                { "data": "legalitas" },
            ],
            "columnDefs": [
                { "searchable": false, "orderable": false, "targets": [0, 1] },
                { "className": "text-center", "targets": [0, 1] }
            ],
        });
    });
</script>
@endpush 