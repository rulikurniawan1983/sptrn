<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanKoperasiExport implements FromCollection, WithHeadings, WithMapping
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
            "ID",
            'NAMA KOPERASI',
            'KECAMATAN',
            'KELURAHAN',
            'BENTUK USAHA',
            'KELOMPOK',
            'SEKTOR USAHA',
            'UNIT USAHA',
            'KLASIFIKASI',
            'KESEHATAN',
            'RAT',
            'BERKAS',

            'ALAMAT',
            'KODE POS',
            'NO.TELP 1',
            'NO.TELP 2',
            'FAX',
            'EMAIL',
            'WEBSITE',

            'NAMA KETUA',
            'NO. TELP KETUA',
            'NAMA SEKRETARIS',
            'NO. TELP SEKRETARIS',
            'NAMA BENDAHARA',
            'NO. TELP BENDAHARA',
            'JUMLAH ANGGOTA PRIA',
            'JUMLAH ANGGOTA WANITA',
            'MANAGER PRIA',
            'MANAGER WANITA',
            'KARYAWAN PRIA',
            'KARYAWAN WANITA',
        ];
        return $data_header;
    }

    public function map($transaction): array
    {
        $data = [
            "'".$transaction->kode,
            $transaction->nama,
            $transaction->kecamatan->nama,
            $transaction->kelurahan->nama,
            $transaction->bentuk_koperasi->nama,
            $transaction->kelompok_koperasi->nama,
            $transaction->sektor_usaha->nama,
            $transaction->unit_usaha->nama,
            $transaction->klasifikasi_koperasi->nama,
            $transaction->kesehatan_koperasi->nama,
            $transaction->koperasi_rat_count,
            $transaction->koperasi_berkas_count,

            $transaction->alamat,
            $transaction->kode_pos,
            $transaction->no_tlp_1,
            $transaction->no_tlp_2,
            $transaction->fax,
            $transaction->email,
            $transaction->website,

            $transaction->nama_ketua,
            $transaction->no_tlp_ketua,
            $transaction->nama_sekretaris,
            $transaction->no_tlp_sekretaris,
            $transaction->nama_bendahara,
            $transaction->no_tlp_bendahara,
            $transaction->anggota_pria,
            $transaction->anggota_wanita,
            $transaction->manager_pria,
            $transaction->manager_wanita,
            $transaction->karyawan_pria,
            $transaction->karyawan_wanita,
        ];
        return $data;
    }
}
