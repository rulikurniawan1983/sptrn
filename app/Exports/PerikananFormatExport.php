<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PerikananFormatExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            [
                "nama" => "Lele Jumbo Berkah",
                "kode_kbli" => "01411",
                "kode_jenis_usaha" => "1",
                "kode_jenis_perikanan" => "1",
                "kode_kecamatan" => "1",
                "kode_kelurahan" => "79",

                "alamat" => "Jln. SBJ Cifor Kp. Semplak",
                "kode_pos" => "16115",
                "no_telp_1" => "0851231232",
                "no_telp_2" => "0851231233",
                "fax" => "021-12345678",
                "email" => "perikanan@example.com",
                "website" => "www.perikananberkahmandiri.com",

                "jenis_kelamin" => "L",
                "kode_tingkat_resiko" => "1",
                "kode_skala_usaha" => "1",
                "komoditas" => "Lele",

                "nik" => "327xxxxxxxx01",
                "no_badan_hukum" => "1234567890",
                "tanggal_badan_hukum" => "2022-01-01",
                "kode_pengesahan_badan_hukum" => "1",
                "tahun_ind_usaha" => "2022",
                "nama_notaris" => "Cecep",
                "npwp" => "123123123123123",

                "nib" => "9876543210",
                "nib_tanggal_terbit" => "2021-12-31",
                "nib_dikeluarkan_oleh" => "Kantor Pertanahan",
                "nib_penanggungjawab" => "Joko Wijaya",

                "situ" => "123456",
                "situ_tanggal_terbit" => "2022-01-01",
                "situ_masa_berlaku" => "2023-12-31",
                "situ_dikeluarkan_oleh" => "Kantor Pertahanan",
                "situ_penanggungjawab" => "Joko Wijaya",

                "nilai_investasi" => 100000000,
                "kode_status_permodalan" => 1,
                "luas_tanah" => 100,
                "luas_bangunan" => 50,

                "tki_pria" => 100,
                "tki_wanita" => 50,
                "tka_pria" => 50,
                "tka_wanita" => 50,
            ],
        ]);
    }

    /**
     * Mendefinisikan header kolom untuk ekspor.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'NAMA',
            'KODE KBLI',
            'KODE JENIS BADAN USAHA',
            'KODE JENIS PERIKANAN',
            'KODE KECAMATAN',
            'KODE KELURAHAN',

            "ALAMAT",
            "KODE POS",
            "NO TELP 1",
            "NO TELP 2",
            "FAX",
            "EMAIL",
            "WEBSITE",

            "L/P",
            "KODE TINGKAT RESIKO",
            "KODE SKALA USAHA",
            "KOMODITAS",

            "NIK",
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
    }

    /**
     * Memetakan data ke dalam format yang diinginkan.
     *
     * @param mixed $transaction
     * @return array
     */
    public function map($transaction): array
    {
        return [
            $transaction['nama'],
            $transaction['kode_kbli'],
            $transaction['kode_jenis_usaha'],
            $transaction['kode_jenis_perikanan'],
            $transaction['kode_kecamatan'],
            $transaction['kode_kelurahan'],

            $transaction['alamat'],
            $transaction['kode_pos'],
            $transaction['no_telp_1'],
            $transaction['no_telp_2'],
            $transaction['fax'],
            $transaction['email'],
            $transaction['website'],

            $transaction['jenis_kelamin'],
            $transaction['kode_tingkat_resiko'],
            $transaction['kode_skala_usaha'],
            $transaction['komoditas'],

            $transaction['nik'],
            $transaction['no_badan_hukum'],
            $transaction['tanggal_badan_hukum'],
            $transaction['kode_pengesahan_badan_hukum'],
            $transaction['tahun_ind_usaha'],
            $transaction['nama_notaris'],
            $transaction['npwp'],

            $transaction['nib'],
            $transaction['nib_tanggal_terbit'],
            $transaction['nib_dikeluarkan_oleh'],
            $transaction['nib_penanggungjawab'],

            $transaction['situ'],
            $transaction['situ_tanggal_terbit'],
            $transaction['situ_masa_berlaku'],
            $transaction['situ_dikeluarkan_oleh'],
            $transaction['situ_penanggungjawab'],

            $transaction['nilai_investasi'],
            $transaction['kode_status_permodalan'],
            $transaction['luas_tanah'],
            $transaction['luas_bangunan'],

            $transaction['tki_pria'],
            $transaction['tki_wanita'],
            $transaction['tka_pria'],
            $transaction['tka_wanita'],
        ];
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();

                // $event->sheet->getDelegate()->getStyle('H:H')->getNumberFormat()
                // ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);

                // $event->sheet->getDelegate()->getStyle('I:I')->getNumberFormat()
                //     ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);

                // $event->sheet->getDelegate()->getStyle('L:L')->getNumberFormat()
                //     ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
            }
        ];
    }

    public function columnFormats(): array
    {
        return [
            // 'H' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            // 'I' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
            // 'L' => NumberFormat::FORMAT_DATE_DDMMYYYY, 
        ];
    }
}
