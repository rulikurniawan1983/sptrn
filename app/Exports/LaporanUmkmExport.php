<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanUmkmExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    function __construct($data=[]) {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        $data_header = [
            'NAMA UKM',
            'KECAMATAN',
            'KELURAHAN',
            'ALAMAT',
            'BENTUK',
            'TIPE',
            'PERKEMBANGAN',
            'PERIZINAN',
            'PEMERAN',
            'PRODUK',
            'TAHUN BERDIRI',
            'TOTAL KARYAWAN',
            'TOTAL KARYAWAN DISABILITAS',
            'OMSET PER TAHUN',
            'NAMA PENGUSAHA',
            'NIK',
            'JENIS KELAMIN',
            'PENYANDANG DISABILITAS',
            'ALAMAT PENGUSAHA',
            'PENDIDIKAN',
        ];
        return $data_header;
    }

    public function map($transaction): array
    {
        $data = [
            $transaction->nama_ukm,
            $transaction->kecamatan->nama,
            $transaction->kelurahan->nama,
            $transaction->alamat_usaha,
            $transaction->bentuk_usaha->nama,
            $transaction->type_usaha->nama,
            $transaction->perkembangan_usaha->nama,
            $transaction->umkm_perizinan_count,
            $transaction->umkm_pameran_count,
            $transaction->umkm_produk_count,
            $transaction->tahun_berdiri,
            $transaction->total_jumlah_karyawan,
            $transaction->total_jumlah_karyawan_disabilitas,
            $transaction->omset_per_tahun,
            $transaction->nama_pengusaha,
            $transaction->nik ? "'".$transaction->nik : null,
            $transaction->jenis_kelamin,
            $transaction->is_disabilitas,
            $transaction->alamat_ktp,
            $transaction->pendidikan->nama,
        ];
        return $data;
    }
}
