@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    {{ html()->form('GET', route('laporan-produksi-ternak.index'))->attribute('enctype', 'multipart/form-data')->id('form-filter')->class('form-custom')->open() }}
    <div class="card shadow-sm">
        <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $titlePage }}</h5>
            <div class="mt-2 mt-md-0 d-flex flex-column flex-sm-row gap-2">
                <button class="btn btn-success" type="submit" formaction="{{ route($route . '.export') }}">
                    <i class="ti ti-file-spreadsheet"></i> Export
                </button>
            </div>
        </div>
        <div class="card-datatable pb-0">
            <table class="datatables-users table table-hover" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">No</th>
                        <th>Jenis Ternak</th>
                        @foreach ($listTahun as $tahun)
                            <th width="1%">Tahun {{ $tahun }}</th>
                            <th width="1%">Kontribusi {{ $tahun }} %</th>
                        @endforeach
                        <th width="1%">r (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($listJenisProduksi as $idJenisProduksi => $namaJenisProduksi)
                        <tr>
                            <td colspan="{{ 2 * count($listTahun) + 3 }}"><strong>{{ $namaJenisProduksi }}</strong></td>
                        </tr>
                        @foreach ($listJenisTernakProduksi->where('jenis_produksi_id', $idJenisProduksi) as $jenisTernak)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $jenisTernak->nama }}</td>
                                @php
                                    $jumlahTahun = [];
                                    $totalPerTahun = [];
                                    foreach ($listTahun as $tahun) {
                                        $jumlah = $dataProduksi->where('jenis_ternak_produksi_id', $jenisTernak->id)->where('tahun', $tahun)->sum('jumlah');
                                        $jumlahTahun[$tahun] = $jumlah;
                                    }
                                    // Hitung total per tahun untuk kategori ini
                                    foreach ($listTahun as $tahun) {
                                        $totalPerTahun[$tahun] = $dataProduksi->whereIn('jenis_ternak_produksi_id', $listJenisTernakProduksi->where('jenis_produksi_id', $idJenisProduksi)->pluck('id'))
                                            ->where('tahun', $tahun)->sum('jumlah');
                                    }
                                @endphp
                                @foreach ($listTahun as $tahun)
                                    <td>{{ $jumlahTahun[$tahun] ? number_format($jumlahTahun[$tahun]) : '-' }}</td>
                                    <td>
                                        @php
                                            $kontribusi = ($totalPerTahun[$tahun] > 0) ? round(($jumlahTahun[$tahun] ?? 0) / $totalPerTahun[$tahun] * 100, 2) : 0;
                                        @endphp
                                        {{ $jumlahTahun[$tahun] ? number_format($kontribusi, 2, ',', '.') : '-' }}
                                    </td>
                                @endforeach
                                <td>
                                    @php
                                        $tahunData = array_keys(array_filter($jumlahTahun, function($v) { return $v !== 0 && $v !== null; }));
                                        if (count($tahunData) > 1) {
                                            $tahunAwal = $tahunData[0];
                                            $tahunAkhir = $tahunData[count($tahunData)-1];
                                            $jumlahAwal = $jumlahTahun[$tahunAwal] ?? 0;
                                            $jumlahAkhir = $jumlahTahun[$tahunAkhir] ?? 0;
                                            $pertumbuhan = $jumlahAwal > 0 ? round((($jumlahAkhir - $jumlahAwal) / $jumlahAwal) * 100, 2) : 0;
                                        } else {
                                            $pertumbuhan = 0;
                                        }
                                    @endphp
                                    {{ count($tahunData) > 1 ? number_format($pertumbuhan, 2, ',', '.') : '-' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>Jumlah</strong></td>
                            @php
                                $totalTahunArr = [];
                                foreach ($listTahun as $tahun) {
                                    $totalTahunArr[$tahun] = $dataProduksi->whereIn('jenis_ternak_produksi_id', $listJenisTernakProduksi->where('jenis_produksi_id', $idJenisProduksi)->pluck('id'))
                                        ->where('tahun', $tahun)->sum('jumlah');
                                }
                            @endphp
                            @foreach ($listTahun as $tahun)
                                <td><strong>{{ $totalTahunArr[$tahun] ? number_format($totalTahunArr[$tahun]) : '-' }}</strong></td>
                                <td><strong>{{ $totalTahunArr[$tahun] ? number_format(100, 2, ',', '.') : '-' }}</strong></td>
                            @endforeach
                            <td>
                                @php
                                    $tahunDataTotal = array_keys(array_filter($totalTahunArr, function($v) { return $v !== 0 && $v !== null; }));
                                    if (count($tahunDataTotal) > 1) {
                                        $tahunAwal = $tahunDataTotal[0];
                                        $tahunAkhir = $tahunDataTotal[count($tahunDataTotal)-1];
                                        $totalAwal = $totalTahunArr[$tahunAwal] ?? 0;
                                        $totalAkhir = $totalTahunArr[$tahunAkhir] ?? 0;
                                        $pertumbuhanTotal = $totalAwal > 0 ? round((($totalAkhir - $totalAwal) / $totalAwal) * 100, 2) : 0;
                                    } else {
                                        $pertumbuhanTotal = 0;
                                    }
                                @endphp
                                <strong>{{ count($tahunDataTotal) > 1 ? number_format($pertumbuhanTotal, 2, ',', '.') : '-' }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection
@push('script')
<script>
    $(document).ready(function() {
        // Ketika tombol filter diklik
        $(document).on('click', '.btn-filter', function() {
            // Ambil data dari form filter
            var params = $('#form-filter').serialize();
            // Redirect ke halaman index dengan parameter filter (GET)
            window.location.href = "{{ route($route . '.index') }}?" + params;
        });
    });
</script>
@endpush 