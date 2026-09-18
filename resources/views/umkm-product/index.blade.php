@extends('layouts.app')
@section('title', $titlePage)

@section('content')
    <!-- Summary Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Total Produk UMKM</span>
                        <h3 class="mb-0 mt-1 fw-bold text-primary">{{ $stats['total'] ?? 0 }}</h3>
                        <small class="text-muted">Keseluruhan produk terdaftar</small>
                    </div>
                    <div class="avatar avatar-lg bg-label-primary rounded-3">
                        <i class="ti ti-package fs-2"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Menunggu Verifikasi</span>
                        <h3 class="mb-0 mt-1 fw-bold text-danger">{{ $stats['pending'] ?? 0 }}</h3>
                        <small class="text-danger fw-semibold">Perlu persetujuan admin</small>
                    </div>
                    <div class="avatar avatar-lg bg-label-danger rounded-3">
                        <i class="ti ti-clock fs-2"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small text-uppercase fw-semibold">Produk Aktif / Tayang</span>
                        <h3 class="mb-0 mt-1 fw-bold text-success">{{ $stats['active'] ?? 0 }}</h3>
                        <small class="text-success fw-semibold">Tampil di portal publik</small>
                    </div>
                    <div class="avatar avatar-lg bg-label-success rounded-3">
                        <i class="ti ti-circle-check fs-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card DataTables -->
    <div class="card shadow-sm border-0">
        @include('base-page.header-index', ['disabled_export' => true])

        <!-- Quick Filter Navigation Tabs -->
        <div class="card-header border-bottom py-2 bg-light">
            <ul class="nav nav-pills card-header-pills gap-1" id="filterStatusTabs">
                <li class="nav-item">
                    <button class="nav-link active btn-sm" data-status="">
                        <i class="ti ti-list me-1"></i> Semua Produk ({{ $stats['total'] ?? 0 }})
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn-sm text-danger" data-status="0">
                        <i class="ti ti-clock me-1"></i> Menunggu Verifikasi
                        @if(($stats['pending'] ?? 0) > 0)
                            <span class="badge bg-danger rounded-pill ms-1">{{ $stats['pending'] }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn-sm text-success" data-status="1">
                        <i class="ti ti-circle-check me-1"></i> Aktif / Tayang ({{ $stats['active'] ?? 0 }})
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-datatable">
            <table class="datatables-users table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">
                            <input type="checkbox" id="CheckAll" style="position: relative;left: 0px;opacity: 1;">
                        </th>
                        <th width="1%" class="text-center">Aksi</th>
                        <th width="5%" class="text-center">Foto</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Pemilik UMKM</th>
                        <th class="text-center">Status Tayang</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('styles')
<style>
    #DataTable td {
        vertical-align: middle;
    }
</style>
@endpush

@push('script')
    <script>
        var table;
        var selectedStatus = '';

        $(document).ready(function() {
            table = $('#DataTable').DataTable({
                'lengthMenu': [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "Semua"]
                ],
                scrollY: '450px',
                scrollX: true,
                'searching': true,
                'processing': true,
                'serverSide': true,
                'order': [[8, 'desc']],
                'ajax': {
                    url: "{{ route($route . '.table') }}",
                    type: "POST",
                    data: function(d) {
                        d.is_active = selectedStatus;
                    },
                    "error": function(jqXHR) {
                        toastr.error("Error Load Data on Table: " + (jqXHR.responseJSON ? jqXHR.responseJSON.message : 'Server Error'));
                    }
                },
                "fnDrawCallback": function(oSettings) {
                    $('#DataTable').find('input:checkbox').prop('checked', false);
                    CheckTotalCheckedData();
                },
                "columns": [
                    {
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
                        "data": "foto_produk",
                        "className": "text-center"
                    },
                    {
                        "data": "nama_produk",
                    },
                    {
                        "data": "harga",
                    },
                    {
                        "data": "user_id",
                    },
                    {
                        "data": "is_active",
                        "className": "text-center"
                    },
                    {
                        "data": "created_at",
                    },
                ],
                "columnDefs": [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": [0, 1, 2, 3],
                    },
                    {
                        "className": "text-center",
                        "targets": [0, 1, 2, 3, 7]
                    }
                ],
            });

            // Filter Tabs Click
            $('#filterStatusTabs button').on('click', function() {
                $('#filterStatusTabs button').removeClass('active');
                $(this).addClass('active');
                selectedStatus = $(this).data('status');
                table.draw();
            });

            $("#CheckAll").click(function() {
                $('#DataTable').find('.CheckboxRow').not(this).prop('checked', this.checked);
                CheckTotalCheckedData();
            });

            setTimeout(() => {
                $('.dataTables_filter input').attr('name', 'q');
                $('.dataTables_filter input').unbind().on('input', debounce(function() {
                    table.search(this.value).draw();
                }, 500));
            }, 0);
        });

        function CheckTotalCheckedData() {
            CheckTotalChecked(['#DeleteSelected']);
        }

        function toggleVerifyProduct(id, name, currentStatus) {
            const actionText = currentStatus == 1 ? 'menonaktifkan' : 'memverifikasi & menayangkan';
            const confirmBtnText = currentStatus == 1 ? 'Ya, Nonaktifkan' : 'Ya, Verifikasi & Tayangkan';
            const confirmBtnColor = currentStatus == 1 ? '#d33' : '#28a745';

            Swal.fire({
                title: 'Konfirmasi Verifikasi',
                html: `Apakah Anda yakin ingin <b>${actionText}</b> produk <b>${name}</b>?`,
                icon: currentStatus == 1 ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#6c757d',
                confirmButtonText: confirmBtnText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('umkm-product/verify') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                table.draw(false);
                            } else {
                                toastr.error(response.message || 'Terjadi kesalahan');
                            }
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || 'Gagal mengubah status verifikasi produk');
                        }
                    });
                }
            });
        }
    </script>
@endpush
