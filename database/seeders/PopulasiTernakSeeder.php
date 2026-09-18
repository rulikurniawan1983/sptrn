<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PopulasiTernak;
use App\Models\JenisTernakPopulasi;

class PopulasiTernakSeeder extends Seeder
{
    public function run(): void
    {
        PopulasiTernak::truncate();
        $data = [
            // Tahun 2022
            ['nama' => 'SAPI POTONG', 'tahun' => 2022, 'jumlah' => 20618],
            ['nama' => 'SAPI PERAH', 'tahun' => 2022, 'jumlah' => 5792],
            ['nama' => 'KERBAU', 'tahun' => 2022, 'jumlah' => 2190],
            ['nama' => 'KUDA', 'tahun' => 2022, 'jumlah' => 455],
            ['nama' => 'KAMBING', 'tahun' => 2022, 'jumlah' => 88129],
            ['nama' => 'KAMBING PERAH', 'tahun' => 2022, 'jumlah' => 5742],
            ['nama' => 'DOMBA', 'tahun' => 2022, 'jumlah' => 278781],
            ['nama' => 'BABI', 'tahun' => 2022, 'jumlah' => 835],
            ['nama' => 'AYAM BURAS', 'tahun' => 2022, 'jumlah' => 2044254],
            ['nama' => 'AYAM RAS PETELUR', 'tahun' => 2022, 'jumlah' => 9200787],
            ['nama' => 'AYAM RAS PEDAGING', 'tahun' => 2022, 'jumlah' => 27163199],
            ['nama' => 'ITIK', 'tahun' => 2022, 'jumlah' => 131612],
            ['nama' => 'ITIK MANILA', 'tahun' => 2022, 'jumlah' => 167913],
            ['nama' => 'MERPATI', 'tahun' => 2022, 'jumlah' => 28521],
            ['nama' => 'PUYUH', 'tahun' => 2022, 'jumlah' => 76918],
            ['nama' => 'KELINCI', 'tahun' => 2022, 'jumlah' => 14535],
            ['nama' => 'ANGSA', 'tahun' => 2022, 'jumlah' => 8540],
            ['nama' => 'ANJING', 'tahun' => 2022, 'jumlah' => 7554],
            ['nama' => 'KUCING', 'tahun' => 2022, 'jumlah' => 35184],
            ['nama' => 'KERA', 'tahun' => 2022, 'jumlah' => 5500],
            ['nama' => 'RUSA', 'tahun' => 2022, 'jumlah' => 474],
            // Tahun 2023
            ['nama' => 'SAPI POTONG', 'tahun' => 2023, 'jumlah' => 21168],
            ['nama' => 'SAPI PERAH', 'tahun' => 2023, 'jumlah' => 6099],
            ['nama' => 'KERBAU', 'tahun' => 2023, 'jumlah' => 2320],
            ['nama' => 'KUDA', 'tahun' => 2023, 'jumlah' => 465],
            ['nama' => 'KAMBING', 'tahun' => 2023, 'jumlah' => 90298],
            ['nama' => 'KAMBING PERAH', 'tahun' => 2023, 'jumlah' => 5899],
            ['nama' => 'DOMBA', 'tahun' => 2023, 'jumlah' => 286781],
            ['nama' => 'BABI', 'tahun' => 2023, 'jumlah' => 333],
            ['nama' => 'AYAM BURAS', 'tahun' => 2023, 'jumlah' => 1819986],
            ['nama' => 'AYAM RAS PETELUR', 'tahun' => 2023, 'jumlah' => 9350115],
            ['nama' => 'AYAM RAS PEDAGING', 'tahun' => 2023, 'jumlah' => 28192586],
            ['nama' => 'ITIK', 'tahun' => 2023, 'jumlah' => 117703],
            ['nama' => 'ITIK MANILA', 'tahun' => 2023, 'jumlah' => 168805],
            ['nama' => 'MERPATI', 'tahun' => 2023, 'jumlah' => 29144],
            ['nama' => 'PUYUH', 'tahun' => 2023, 'jumlah' => 78291],
            ['nama' => 'KELINCI', 'tahun' => 2023, 'jumlah' => 14908],
            ['nama' => 'ANGSA', 'tahun' => 2023, 'jumlah' => 9024],
            ['nama' => 'ANJING', 'tahun' => 2023, 'jumlah' => 7628],
            ['nama' => 'KUCING', 'tahun' => 2023, 'jumlah' => 36203],
            ['nama' => 'KERA', 'tahun' => 2023, 'jumlah' => 5550],
            ['nama' => 'RUSA', 'tahun' => 2023, 'jumlah' => 492],
        ];

        foreach ($data as $item) {
            $jenisTernak = JenisTernakPopulasi::where('nama', $item['nama'])->first();
            if ($jenisTernak) {
                PopulasiTernak::updateOrCreate([
                    'jenis_ternak_populasi_id' => $jenisTernak->id,
                    'tahun' => $item['tahun'],
                ], [
                    'jumlah' => $item['jumlah'],
                ]);
            } else {
                echo "Tidak ketemu: {$item['nama']}\n";
            }
        }
    }
} 