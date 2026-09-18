<?php

namespace Database\Seeders;

use App\Models\ProduksiTernak;
use App\Models\JenisTernakProduksi;
use Illuminate\Database\Seeder;

class ProduksiTernakSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Daging 2022 & 2023
            ['kategori' => 'Daging', 'jenis' => 'Sapi Lokal', 'tahun' => 2022, 'jumlah' => 1462287],
            ['kategori' => 'Daging', 'jenis' => 'Sapi Lokal', 'tahun' => 2023, 'jumlah' => 1559949],
            ['kategori' => 'Daging', 'jenis' => 'Sapi Impor', 'tahun' => 2022, 'jumlah' => 5894922],
            ['kategori' => 'Daging', 'jenis' => 'Sapi Impor', 'tahun' => 2023, 'jumlah' => 7223413],
            ['kategori' => 'Daging', 'jenis' => 'Kerbau', 'tahun' => 2022, 'jumlah' => 88137],
            ['kategori' => 'Daging', 'jenis' => 'Kerbau', 'tahun' => 2023, 'jumlah' => 62686],
            ['kategori' => 'Daging', 'jenis' => 'Kambing', 'tahun' => 2022, 'jumlah' => 252617],
            ['kategori' => 'Daging', 'jenis' => 'Kambing', 'tahun' => 2023, 'jumlah' => 339864],
            ['kategori' => 'Daging', 'jenis' => 'Domba', 'tahun' => 2022, 'jumlah' => 524758],
            ['kategori' => 'Daging', 'jenis' => 'Domba', 'tahun' => 2023, 'jumlah' => 469254],
            ['kategori' => 'Daging', 'jenis' => 'Ayam Ras Pedaging', 'tahun' => 2022, 'jumlah' => 195249074],
            ['kategori' => 'Daging', 'jenis' => 'Ayam Ras Pedaging', 'tahun' => 2023, 'jumlah' => 202648308],
            ['kategori' => 'Daging', 'jenis' => 'Ayam Ras Petelur', 'tahun' => 2022, 'jumlah' => 8568324],
            ['kategori' => 'Daging', 'jenis' => 'Ayam Ras Petelur', 'tahun' => 2023, 'jumlah' => 8707388],
            ['kategori' => 'Daging', 'jenis' => 'Ayam Buras', 'tahun' => 2022, 'jumlah' => 2099160],
            ['kategori' => 'Daging', 'jenis' => 'Ayam Buras', 'tahun' => 2023, 'jumlah' => 1868869],
            ['kategori' => 'Daging', 'jenis' => 'Itik', 'tahun' => 2022, 'jumlah' => 102760],
            ['kategori' => 'Daging', 'jenis' => 'Itik', 'tahun' => 2023, 'jumlah' => 91900],
            ['kategori' => 'Daging', 'jenis' => 'Itik Manila', 'tahun' => 2022, 'jumlah' => 100849],
            ['kategori' => 'Daging', 'jenis' => 'Itik Manila', 'tahun' => 2023, 'jumlah' => 101384],
            ['kategori' => 'Daging', 'jenis' => 'Puyuh', 'tahun' => 2022, 'jumlah' => 14153],
            ['kategori' => 'Daging', 'jenis' => 'Puyuh', 'tahun' => 2023, 'jumlah' => 14406],
            // Telur
            ['kategori' => 'Telur', 'jenis' => 'Ayam Ras Petelur', 'tahun' => 2022, 'jumlah' => 105216454],
            ['kategori' => 'Telur', 'jenis' => 'Ayam Ras Petelur', 'tahun' => 2023, 'jumlah' => 106924109],
            ['kategori' => 'Telur', 'jenis' => 'Ayam Buras', 'tahun' => 2022, 'jumlah' => 4384499],
            ['kategori' => 'Telur', 'jenis' => 'Ayam Buras', 'tahun' => 2023, 'jumlah' => 3903491],
            ['kategori' => 'Telur', 'jenis' => 'Itik', 'tahun' => 2022, 'jumlah' => 827413],
            ['kategori' => 'Telur', 'jenis' => 'Itik', 'tahun' => 2023, 'jumlah' => 739970],
            ['kategori' => 'Telur', 'jenis' => 'Itik Manila', 'tahun' => 2022, 'jumlah' => 924764],
            ['kategori' => 'Telur', 'jenis' => 'Itik Manila', 'tahun' => 2023, 'jumlah' => 929677],
            ['kategori' => 'Telur', 'jenis' => 'Burung Puyuh', 'tahun' => 2022, 'jumlah' => 130195],
            ['kategori' => 'Telur', 'jenis' => 'Burung Puyuh', 'tahun' => 2023, 'jumlah' => 132515],
            // Susu
            ['kategori' => 'Susu', 'jenis' => 'Sapi', 'tahun' => 2022, 'jumlah' => 14027463],
            ['kategori' => 'Susu', 'jenis' => 'Sapi', 'tahun' => 2023, 'jumlah' => 14770977],
        ];

        foreach ($data as $row) {
            $jenisTernak = JenisTernakProduksi::where('nama', $row['jenis'])
                ->whereHas('jenis_produksi', function ($query) use ($row) {
                    $query->where('nama', $row['kategori']);
                })->first();

            if ($jenisTernak) {
                ProduksiTernak::updateOrCreate(
                    [
                        'jenis_ternak_produksi_id' => $jenisTernak->id,
                        'tahun' => $row['tahun'],
                    ],
                    [
                        'jumlah' => $row['jumlah'],
                    ]
                );
            }
        }
    }
} 