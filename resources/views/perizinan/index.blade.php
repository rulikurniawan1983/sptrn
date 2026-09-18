@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light py-3">
                    <span class="fw-semibold text-uppercase small text-muted">
                        <i class="ti ti-file-text me-1"></i> Dokumen Perizinan
                    </span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @php
                            $perizinanList = [
                                ['nama' => 'NIB (Nomor Induk Berusaha)', 'icon' => 'ti-check', 'kode' => 'NIB'],
                                ['nama' => 'KUSUKA (Kartu Pelaku Usaha Kelautan)', 'icon' => 'ti-id', 'kode' => 'KUSUKA'],
                                ['nama' => 'SKP (Sertifikat Kelayakan Pengolahan)', 'icon' => 'ti-certificate', 'kode' => 'SKP'],
                                ['nama' => 'NKV (Nomor Kontrol Veteriner)', 'icon' => 'ti-heartbeat', 'kode' => 'NKV'],
                                ['nama' => 'Sertifikat Halal (BPJPH / MUI)', 'icon' => 'ti-file-text', 'kode' => 'HALAL'],
                                ['nama' => 'SPP-PIRT (Pangan Industri Rumah Tangga)', 'icon' => 'ti-home', 'kode' => 'PIRT'],
                                ['nama' => 'BPOM (Izin Edar BPOM MD/ML)', 'icon' => 'ti-shield', 'kode' => 'BPOM'],
                                ['nama' => 'HAKI (Hak Kekayaan Intelektual / Merek)', 'icon' => 'ti-lightbulb', 'kode' => 'HAKI'],
                                ['nama' => 'SNI (Standar Nasional Indonesia)', 'icon' => 'ti-award', 'kode' => 'SNI'],
                                ['nama' => 'HACCP (Hazard Analysis Critical Control Point)', 'icon' => 'ti-shield-check', 'kode' => 'HACCP'],
                                ['nama' => 'ISO (ISO 9001 / ISO 22000 / Lainnya)', 'icon' => 'ti-world', 'kode' => 'ISO'],
                            ];
                        @endphp

                        @foreach($perizinanList as $item)
                            @php
                                $record = $perizinans->where('nama', $item['nama'])->first();
                                $isUploaded = $record && $record->file;
                                $statusText = $isUploaded ? 'Sudah Diunggah' : 'Belum Diunggah';
                                $statusClass = $isUploaded ? 'bg-label-success' : 'bg-label-warning';
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="avatar avatar-md bg-light rounded-circle d-flex align-items-center justify-content-center shrink-0">
                                            <i class="ti {{ $item['icon'] }} ti-md text-primary"></i>
                                        </div>
                                        <div class="grow">
                                            <strong class="d-block">{{ $item['nama'] }}</strong>
                                            <span class="badge {{ $statusClass }} mt-1">{{ $statusText }}</span>
                                        </div>
                                        <div>
                                            @if($isUploaded)
                                                <a href="{{ asset('storage/' . $record->file) }}" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-eye me-1"></i> Lihat
                                                </a>
                                                <form action="{{ route('perizinan.destroy', $record->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="ti ti-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal" data-perizinan="{{ $item['nama'] }}">
                                                    <i class="ti ti-upload me-1"></i> Upload
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Berkas Perizinan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('perizinan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Jenis Perizinan</label>
                            <input type="text" name="perizinan_nama" id="perizinan_nama" class="form-control" readonly required>
                            <div class="form-text">Jenis perizinan tidak dapat diubah.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih File Berkas</label>
                            <input type="file" name="perizinan_file" class="form-control" accept=".pdf,.jpg,.jpeg" required>
                            <div class="form-text">
                                Format yang diterima: <strong>PDF, JPG, JPEG</strong>. Maksimal ukuran: <strong>5 MB</strong>.
                            </div>
                            @error('perizinan_file')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-upload me-1"></i> Upload Berkas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection

@push('script')
<script>
    var uploadModal = document.getElementById('uploadModal');
    uploadModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var perizinanName = button.getAttribute('data-perizinan');
        var modalBodyInput = uploadModal.querySelector('#perizinan_nama');
        modalBodyInput.value = perizinanName;
    });
</script>
@endpush
