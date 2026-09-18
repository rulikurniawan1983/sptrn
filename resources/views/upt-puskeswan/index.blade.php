@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $titlePage }}</h5>
            <div class="mt-2 mt-md-0 d-flex flex-column flex-sm-row gap-2">
                @if (!@$disabled_add)
                    @can("$permission_main Add")
                        <a href="{{ @$routeAddCustom ? @$routeAddCustom : route("$route.create") }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> {{ __('message.add') }}
                        </a>
                    @endcan
                @endif
                {{-- @if (@$disabled_export == false)
                    <a href="{{ url($route . '/export') }}" class="btn btn-success">
                        <i class="ti ti-file-spreadsheet"></i> Export
                    </a>
                @endif --}}
                @if (!@$disabled_delete)
                    @can("$permission_main Delete")
                        {{ html()->form('POST', route($route . '.destroy-selected'))->style('display: contents')->open() }}
                        <a href="#" class="btn btn-danger disabled" id="DeleteSelected"
                            onclick="SwalDeleteSelected($(this).closest('form'))">
                            <i class="ti ti-trash"></i> {{ __('message.delete_selected') }}
                        </a>
                        {{ html()->form()->close() }}
                    @endcan
                @endif
            </div>
        </div>
        <div class="card-datatable">
            <table class="datatables-users table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">
                            <input type="checkbox" id="CheckAll" style="position: relative;left: 0px;opacity: 1;">
                        </th>
                        <th width="1%" class="text-center">Opsi</th>
                        <th>Nama</th>
                        <th style="max-width: 300px;">Wilayah Kerja</th>
                        <th style="max-width: 300px;">Lokasi UPT</th>
                        <th>Status Verifikasi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @include("$route.modal-import")
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
                        "data": "nama",
                    },
                    {
                        "data": "list_kecamatan_nama", "orderable": false, "searching": false, "className": "white-space-inherit"
                    },
                    {
                        "data": "kecamatan.nama"
                    },
                    {
                        "data": "status_verifikasi.nama",
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
