<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanPeternakanExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
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
            'NAMA',
            'KODE KBLI',
            'KODE JENIS BADAN USAHA',
            'KODE JENIS PETERNAKAN',
            'KODE KECAMATAN',
            'KODE KELURAHAN',

            "ALAMAT",
            "KODE POS",
            "NO TELP 1",
            "NO TELP 2",
            "FAX",
            "EMAIL",
            "WEBSITE",

            "KODE TINGKAT RESIKO",
            "KODE SKALA USAHA",

            "NO BADAN HUKUM",
            "TANGGAL BADAN HUKUM",
            "KODE PENGESAHAN BADAN HUKUM",
            "TAHUN USAHA",
            "NAMA NOTARIS",
            "NPWP",

            "NIB NOMOR",
            "NIB TANGGAL TERBIT",
            "NIB DIKELUARKAN OLEH",
            "NIB PENANGGUNGJAWAB",

            "SITU NOMOR",
            "SITU TANGGAL TERBIT",
            "SITU MASA BERLAKU",
            "SITU DIKELUARKAN OLEH",
            "SITU PENANGGUNGJAWAB",

            "NILAI INVESTASI",
            "KODE STATUS PERMODALAN",
            "LUAS TANAH",
            "LUAS BANGUNAN",

            "TKI PRIA",
            "TKI WANITA",
            "TKA PRIA",
            "TKA WANITA",
        ];
        return $data_header;
    }

    public function map($transaction): array
    {
        $data = [
            $transaction->nama,
            $transaction->kbli->uraian,
            $transaction->jenis_usaha->nama,
            $transaction->jenis_peternakan->nama,
            $transaction->kecamatan->nama,
            $transaction->kelurahan->nama,

            $transaction->alamat,
            $transaction->kode_pos,
            $transaction->no_telp_1,
            $transaction->no_telp_2,
            $transaction->fax,
            $transaction->email,
            $transaction->website,

            $transaction->tingkat_resiko->nama,
            $transaction->skala_usaha->nama,

            $transaction->no_badan_hukum,
            $transaction->tanggal_badan_hukum,
            $transaction->pengesahan_badan_hukum->nama,
            $transaction->tahun_ind_usaha,
            $transaction->nama_notaris,
            $transaction->npwp,

            $transaction->nib,
            $transaction->nib_tanggal_terbit,
            $transaction->nib_dikeluarkan_oleh,
            $transaction->nib_penanggungjawab,

            $transaction->surat_izin_tempat_usaha,
            $transaction->surat_izin_tempat_usaha_tanggal_terbit,
            $transaction->surat_izin_tempat_usaha_masa_berlaku,
            $transaction->surat_izin_tempat_usaha_dikeluarkan_oleh,
            $transaction->surat_izin_tempat_usaha_penanggungjawab,

            $transaction->nilai_investasi,
            $transaction->status_permodalan->nama,
            $transaction->luas_tanah,
            $transaction->luas_bangunan,

            $transaction->tki_pria,
            $transaction->tki_wanita,
            $transaction->tka_pria,
            $transaction->tka_wanita,
        ];
        return $data;
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
            }
        ];
    }
}
