@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-index', ['disabled_add' => true, 'disabled_export' => true])
        <div class="card-datatable">
            <table class="datatables-users table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">
                            <input type="checkbox" id="CheckAll" style="position: relative;left: 0px;opacity: 1;">
                        </th>
                        <th width="1%" class="text-center">Opsi</th>
                        <th class="text-center">Module</th>
                        <th>Event</th>
                        <th width="1%">Subject Id</th>
                        <th>User</th>
                        <th>Level</th>
                        <th>Action Date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
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
                scrollY: '400px',
                scrollX: true,
                'searching': true,
                'processing': true,
                'serverSide': true,
                'order': [],
                'ajax': {
                    url: "{{ route($route . '.table') }}",
                    type: "POST",
                    data: function(d) {
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
                        "data": "description"
                    },
                    {
                        "data": "event",
                    },
                    {
                        "data": "subject_id",
                    },
                    {
                        "data": "causer.name",
                    },
                    {
                        "data": "causer.role.name",
                        "visible": false,
                        "searchable": false,
                    },
                    {
                        "data": "created_at",
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
