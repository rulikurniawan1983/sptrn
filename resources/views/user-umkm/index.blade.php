@extends('layouts.app')
@section('title', $titlePage)
@section('content')

    <!-- Summary Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-muted small text-uppercase fw-semibold">Total UMKM</span>
                            <div class="d-flex align-items-center my-1">
                                <h3 class="mb-0 me-2 text-primary fw-bold">{{ @$stats['total'] ?? 0 }}</h3>
                            </div>
                            <small class="text-muted">Pelaku usaha terdaftar</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="ti ti-building-store ti-md"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #ea5455 !important;">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-muted small text-uppercase fw-semibold">Menunggu Verifikasi</span>
                            <div class="d-flex align-items-center my-1">
                                <h3 class="mb-0 me-2 text-danger fw-bold">{{ @$stats['pending'] ?? 0 }}</h3>
                                @if((@$stats['pending'] ?? 0) > 0)
                                    <span class="badge bg-label-danger rounded-pill small">Perlu Tindakan</span>
                                @endif
                            </div>
                            <small class="text-muted">Pendaftar baru belum aktif</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="ti ti-clock-pause ti-md"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-muted small text-uppercase fw-semibold">UMKM Aktif</span>
                            <div class="d-flex align-items-center my-1">
                                <h3 class="mb-0 me-2 text-success fw-bold">{{ @$stats['active'] ?? 0 }}</h3>
                            </div>
                            <small class="text-muted">Dapat login & beroperasi</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="ti ti-user-check ti-md"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-muted small text-uppercase fw-semibold">Sektor Sektoral</span>
                            <div class="d-flex align-items-center my-1 gap-2">
                                <span class="badge bg-label-warning"><i class="ti ti-building-cottage me-1"></i>Ternak: {{ @$stats['peternakan'] ?? 0 }}</span>
                                <span class="badge bg-label-info"><i class="ti ti-fish me-1"></i>Ikan: {{ @$stats['perikanan'] ?? 0 }}</span>
                            </div>
                            <small class="text-muted">Komposisi sektor usaha</small>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class="ti ti-category ti-md"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Data Table Card -->
    <div class="card shadow-sm">
        <div class="card-header pb-0">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="card-title mb-0"><i class="ti ti-users-group me-2 text-primary"></i>Monitoring User UMKM</h5>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-danger d-none" id="BtnDeleteSelected" onclick="DestroySelected()">
                        <i class="ti ti-trash me-1"></i> Hapus Terpilih (<span id="CountSelected">0</span>)
                    </button>
                    @can('User Umkm Add')
                        <a href="{{ route($route . '.create') }}" class="btn btn-sm btn-primary">
                            <i class="ti ti-plus me-1"></i> Tambah UMKM
                        </a>
                    @endcan
                </div>
            </div>

            <!-- Filter Tabs -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 border-top pt-3 pb-2">
                <div class="nav-align-top">
                    <ul class="nav nav-pills nav-fill gap-2" role="tablist" id="statusFilterTabs">
                        <li class="nav-item">
                            <button type="button" class="nav-link active filter-status-btn btn-sm" data-status="">
                                <i class="ti ti-list me-1"></i> Semua ({{ @$stats['total'] ?? 0 }})
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link filter-status-btn btn-sm text-danger" data-status="pending">
                                <i class="ti ti-clock me-1"></i> Menunggu Verifikasi
                                @if((@$stats['pending'] ?? 0) > 0)
                                    <span class="badge bg-danger ms-1">{{ @$stats['pending'] }}</span>
                                @endif
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link filter-status-btn btn-sm text-success" data-status="active">
                                <i class="ti ti-check me-1"></i> Aktif ({{ @$stats['active'] ?? 0 }})
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="small text-muted mb-0">Sektor:</label>
                    <select id="roleFilterSelect" class="form-select form-select-sm" style="width: 170px;">
                        <option value="">Semua Sektor</option>
                        <option value="101">Peternakan</option>
                        <option value="102">Perikanan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-datatable table-responsive">
            <table class="table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top bg-light">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">
                            <input type="checkbox" id="CheckAll" style="position: relative;left: 0px;opacity: 1;">
                        </th>
                        <th width="1%" class="text-center">Aksi</th>
                        <th>Nama UMKM / NIK</th>
                        <th>Nama Pemilik</th>
                        <th>NIB (Username)</th>
                        <th>WhatsApp</th>
                        <th>Sektor</th>
                        <th>Berkas NIB</th>
                        <th class="text-center">Status</th>
                        <th>Tgl Daftar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Hidden Form for CSRF -->
    <form id="verify-form" method="POST" style="display:none;">
        @csrf
    </form>

@endsection

@push('script')
    <script>
        var table;
        var currentStatusFilter = '';
        var currentRoleFilter = '';

        $(document).ready(function() {
            table = $('#DataTable').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                scrollY: '450px',
                scrollX: true,
                searching: true,
                processing: true,
                serverSide: true,
                order: [[9, 'desc']], // Sort by tgl daftar descending
                ajax: {
                    url: "{{ route($route . '.table') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.status_filter = currentStatusFilter;
                        d.role_filter = currentRoleFilter;
                    },
                    error: function(jqXHR) {
                        toastr.error("Gagal memuat data tabel: " + (jqXHR.responseJSON?.message || "Terjadi kesalahan"));
                    }
                },
                fnDrawCallback: function(oSettings) {
                    $('#DataTable').find('input:checkbox').prop('checked', false);
                    CheckTotalCheckedData();
                },
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: "id",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return "<input type='checkbox' class='CheckboxRow' onclick='CheckTotalCheckedData()' data-id='" +
                                row.id + "' style='position: relative;left: 0px;opacity: 1;'/>";
                        },
                    },
                    {
                        data: "options",
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "nama_pemilik",
                        name: "nama_pemilik"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "no_wa",
                        name: "no_hp",
                        orderable: false
                    },
                    {
                        data: "sektor",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nib_file",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "is_active",
                        name: "is_active",
                        className: "text-center"
                    },
                    {
                        data: "created_at",
                        name: "created_at"
                    }
                ]
            });

            // Filter Tabs Click
            $('.filter-status-btn').on('click', function() {
                $('.filter-status-btn').removeClass('active');
                $(this).addClass('active');
                currentStatusFilter = $(this).data('status');
                table.ajax.reload();
            });

            // Role/Sector Dropdown Filter
            $('#roleFilterSelect').on('change', function() {
                currentRoleFilter = $(this).val();
                table.ajax.reload();
            });
        });

        // Quick Verify AJAX Toggle
        function toggleVerifyUser(userId, userName, currentActive) {
            var actionText = currentActive == 1 ? "menonaktifkan" : "memverifikasi & mengaktifkan";
            var btnConfirmColor = currentActive == 1 ? "#d33" : "#28a745";

            Swal.fire({
                title: 'Konfirmasi Verifikasi',
                text: "Apakah Anda yakin ingin " + actionText + " akun UMKM '" + userName + "'?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: btnConfirmColor,
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('user-umkm/verify') }}/" + userId,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            toastr.success(res.message || "Status berhasil diperbarui.");
                            table.ajax.reload(null, false);
                        },
                        error: function(err) {
                            toastr.error("Gagal memperbarui status verifikasi.");
                        }
                    });
                }
            });
        }

        // Delete Selected Batch
        function DestroySelected() {
            var ids = [];
            $('.CheckboxRow:checked').each(function() {
                ids.push($(this).data('id'));
            });

            if (ids.length === 0) return;

            Swal.fire({
                title: 'Hapus Data Terpilih?',
                text: "Sebanyak " + ids.length + " data UMKM akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route($route . '.destroy-selected') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            ids: ids
                        },
                        success: function(res) {
                            toastr.success("Data berhasil dihapus.");
                            table.ajax.reload();
                        },
                        error: function(err) {
                            toastr.error("Gagal menghapus data.");
                        }
                    });
                }
            });
        }

        function CheckTotalCheckedData() {
            var count = $('.CheckboxRow:checked').length;
            $('#CountSelected').text(count);
            if (count > 0) {
                $('#BtnDeleteSelected').removeClass('d-none');
            } else {
                $('#BtnDeleteSelected').addClass('d-none');
            }
        }

        $('#CheckAll').on('change', function() {
            $('.CheckboxRow').prop('checked', $(this).is(':checked'));
            CheckTotalCheckedData();
        });
    </script>
@endpush

