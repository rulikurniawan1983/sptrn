@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    {{ html()->form('GET', route('laporan-perikanan.index'))->attribute('enctype', 'multipart/form-data')->id('form-filter')->class('form-custom')->open() }}
    <div class="card shadow-sm">
        <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $titlePage }}</h5>
            <div class="mt-2 mt-md-0 d-flex flex-column flex-sm-row gap-2">
                <a type="button" class="btn bg-dark text-nowrap d-inline-block" data-bs-toggle="modal"
                    data-bs-target="#modal-filter">
                    <span class="ti-filter ti-sm ti text-light"></span>
                    <span class="badge badge-dot bg-danger badge-notifications" style="display: none;"></span>
                </a>
                <button class="btn btn-success" type="submit" formaction="{{ route($route . '.export') }}">
                    <i class="ti ti-file-spreadsheet"></i> Export
                </button>
            </div>
        </div>
        <div class="card-datatable">
            <table class="datatables-users table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%" class="text-center">Opsi</th>
                        <th>Nama</th>
                        <th>Jenis Perikanan</th>
                        <th>Jenis Badan Usaha</th>
                        <th>Kecamatan</th>
                        <th>Status Verifikasi</th>
                    </tr>
                </thead>
            </table>
        </div>
        @include($route . '.modal-filter')
    </div>
    {{ html()->form()->close() }}
@endsection
@push('styles')
@endpush
@push('script')
    <script>
        var table;
        $(document).ready(function() {
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
                        var formData = $('#form-filter').serializeArray();
                        formData.forEach(function(item) {
                            d[item.name] = item.value;
                        });
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
                        "data": "options",
                        "className": "text-center"
                    },
                    {
                        "data": "nama",
                    },
                    {
                        "data": "jenis_perikanan.nama",
                    },
                    {
                        "data": "jenis_usaha.nama",
                    },
                    {
                        "data": "kecamatan.nama",
                    },
                    {
                        "data": "status_verifikasi.nama",
                    },
                ],
                "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": [0, 1],
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
                $('.dataTables_filter input').attr('placeholder', 'Nama UKM, Pengusaha, NIK');
                $('.dataTables_filter input').unbind().on('input', debounce(function() {
                    table.search(this.value).draw();
                }, 500)); // 500ms delay
            }, 0);
        });

        function CheckTotalCheckedData() {
            CheckTotalChecked(['#DeleteSelected']);
        }

        $(document).on('click', '.btn-filter', function() {
            $("#modal-filter").modal('hide');
            table.ajax.reload(null, false);
            checkInputs();
        });

        function checkInputs() {
            let isFilled = $('#modal-filter').find(
                'input[type="text"], input[type="radio"]:checked, input[type="checkbox"]:checked, select').filter(
                function() {
                    return $(this).val() && $(this).val().length > 0;
                }).length > 0;
            $('.badge-notifications').toggle(isFilled);
        }

        $(document).on('change', '#modal-filter [name=id_kecamatan]', function() {
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
    </script>
@endpush
