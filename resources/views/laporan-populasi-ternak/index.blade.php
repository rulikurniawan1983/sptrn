@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    {{ html()->form('GET', route('laporan-populasi-ternak.index'))->attribute('enctype', 'multipart/form-data')->id('form-filter')->class('form-custom')->open() }}
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
                        @endforeach
                        <th width="1%">r (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($listJenisTernakPopulasi as $jenis)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $jenis->nama }}</td>
                            @php
                                $jumlahTahun = [];
                                foreach ($listTahun as $tahun) {
                                    $jumlah = $dataPopulasi->where('jenis_ternak_populasi_id', $jenis->id)->where('tahun', $tahun)->sum('jumlah');
                                    $jumlahTahun[$tahun] = $jumlah;
                                }
                            @endphp
                            @foreach ($listTahun as $tahun)
                                <td>{{ $jumlahTahun[$tahun] ? number_format($jumlahTahun[$tahun]) : '-' }}</td>
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
                        <td colspan="2"><strong>Total</strong></td>
                        @php
                            $totalTahunArr = [];
                            foreach ($listTahun as $tahun) {
                                $totalTahunArr[$tahun] = $dataPopulasi->where('tahun', $tahun)->sum('jumlah');
                            }
                        @endphp
                        @foreach ($listTahun as $tahun)
                            <td><strong>{{ $totalTahunArr[$tahun] ? number_format($totalTahunArr[$tahun]) : '-' }}</strong></td>
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
                </tbody>
            </table>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection
@push('styles')
@endpush
