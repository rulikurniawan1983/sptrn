@extends('layouts.app')
@section('title', $titlePage)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-3">Edit Dokumen Legalitas</h3>
                <p class="text-muted">Perbarui dokumen legalitas dan sertifikasi usaha Anda.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('umkm-legalitas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="jenis_legalitas" class="form-label fw-semibold">Jenis Legalitas <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_legalitas') is-invalid @enderror" id="jenis_legalitas" name="jenis_legalitas" required>
                            <option value="">-- Pilih Jenis Legalitas --</option>
                            <option value="NIB (Nomor Induk Berusaha)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'NIB (Nomor Induk Berusaha)' ? 'selected' : '' }}>NIB (Nomor Induk Berusaha)</option>
                            <option value="KUSUKA (Kartu Pelaku Usaha Kelautan & Perikanan)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'KUSUKA (Kartu Pelaku Usaha Kelautan & Perikanan)' ? 'selected' : '' }}>KUSUKA (Kartu Pelaku Usaha Kelautan & Perikanan)</option>
                            <option value="SKP (Sertifikat Kelayakan Pengolahan)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'SKP (Sertifikat Kelayakan Pengolahan)' ? 'selected' : '' }}>SKP (Sertifikat Kelayakan Pengolahan)</option>
                            <option value="NKV (Nomor Kontrol Veteriner)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'NKV (Nomor Kontrol Veteriner)' ? 'selected' : '' }}>NKV (Nomor Kontrol Veteriner)</option>
                            <option value="Sertifikat Halal (BPJPH / MUI)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'Sertifikat Halal (BPJPH / MUI)' ? 'selected' : '' }}>Sertifikat Halal (BPJPH / MUI)</option>
                            <option value="SPP-PIRT (Pangan Industri Rumah Tangga)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'SPP-PIRT (Pangan Industri Rumah Tangga)' ? 'selected' : '' }}>SPP-PIRT (Pangan Industri Rumah Tangga)</option>
                            <option value="BPOM (Izin Edar BPOM MD/ML)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'BPOM (Izin Edar BPOM MD/ML)' ? 'selected' : '' }}>BPOM (Izin Edar BPOM MD/ML)</option>
                            <option value="HAKI (Hak Kekayaan Intelektual / Merek Dagang)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'HAKI (Hak Kekayaan Intelektual / Merek Dagang)' ? 'selected' : '' }}>HAKI (Hak Kekayaan Intelektual / Merek Dagang)</option>
                            <option value="SNI (Standar Nasional Indonesia)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'SNI (Standar Nasional Indonesia)' ? 'selected' : '' }}>SNI (Standar Nasional Indonesia)</option>
                            <option value="HACCP (Hazard Analysis Critical Control Point)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'HACCP (Hazard Analysis Critical Control Point)' ? 'selected' : '' }}>HACCP (Hazard Analysis Critical Control Point)</option>
                            <option value="ISO (ISO 9001 / ISO 22000 / Lainnya)" {{ old('jenis_legalitas', $item->jenis_legalitas) == 'ISO (ISO 9001 / ISO 22000 / Lainnya)' ? 'selected' : '' }}>ISO (ISO 9001 / ISO 22000 / Lainnya)</option>
                        </select>
                        @error('jenis_legalitas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nomor_dokumen" class="form-label fw-semibold">Nomor Dokumen</label>
                        <input type="text" class="form-control @error('nomor_dokumen') is-invalid @enderror" id="nomor_dokumen" name="nomor_dokumen" value="{{ old('nomor_dokumen', $item->nomor_dokumen) }}" placeholder="Contoh: 1234567890">
                        @error('nomor_dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="file_legalitas" class="form-label fw-semibold">File Dokumen</label>
                        <input type="file" class="form-control @error('file_legalitas') is-invalid @enderror" id="file_legalitas" name="file_legalitas" accept=".pdf,.jpg,.jpeg,.png">
                        @if($item->file_legalitas)
                            <div class="mt-2">
                                <small class="text-muted">File saat ini:</small><br>
                                <a href="{{ asset('storage/umkm-legalitas/' . $item->file_legalitas) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-1">
                                    <i class="ti ti-file-download me-1"></i> {{ $item->file_legalitas }}
                                </a>
                            </div>
                        @endif
                        <small class="text-muted">Format yang diizinkan: PDF, JPG, JPEG, PNG. Maksimal 5MB. Kosongkan jika tidak ingin mengubah file.</small>
                        @error('file_legalitas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-1"></i> Update
                        </button>
                        <a href="{{ route('umkm-legalitas.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
