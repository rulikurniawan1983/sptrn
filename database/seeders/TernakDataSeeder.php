<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\JenisTernakProduksi;
use App\Models\JenisTernakPopulasi;
use App\Models\ProduksiTernak;
use App\Models\PopulasiTernak;

class TernakDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedJenisTernakProduksi();
        $this->seedJenisTernakPopulasi();
        $this->seedProduksiTernak();
        $this->seedPopulasiTernak();

        $this->command->info('Ternak data seeding completed.');
    }

    private function seedJenisTernakProduksi(): void
    {
        $data = [
            ['nama' => 'Ayam Broiler (Daging)'],
            ['nama' => 'Telur Ayam Ras'],
            ['nama' => 'Susu Sapi Segar'],
            ['nama' => 'Ayam Layer (Daging Afkir)'],
            ['nama' => 'Sapi Impor (Daging)'],
            ['nama' => 'Telur Buras & Lainnya'],
            ['nama' => 'Sapi Lokal & Ruminansia Lain'],
        ];

        foreach ($data as $item) {
            JenisTernakProduksi::updateOrCreate(['nama' => $item['nama']], $item);
        }

        $this->command->info('Jenis Ternak Produksi: ' . count($data) . ' records');
    }

    private function seedJenisTernakPopulasi(): void
    {
        $data = [
            ['nama' => 'Sapi Potong'],
            ['nama' => 'Sapi Perah'],
            ['nama' => 'Kerbau'],
            ['nama' => 'Domba'],
            ['nama' => 'Kambing'],
            ['nama' => 'Ayam Broiler'],
            ['nama' => 'Ayam Layer'],
            ['nama' => 'Ayam Buras'],
            ['nama' => 'Itik & Manila'],
        ];

        foreach ($data as $item) {
            JenisTernakPopulasi::updateOrCreate(['nama' => $item['nama']], $item);
        }

        $this->command->info('Jenis Ternak Populasi: ' . count($data) . ' records');
    }

    private function seedProduksiTernak(): void
    {
        $tahuns = [2022, 2023];

        $produksiData = [
            'Ayam Broiler (Daging)' => [2022 => 180000000, 2023 => 195000000],
            'Telur Ayam Ras' => [2022 => 95000000, 2023 => 98000000],
            'Susu Sapi Segar' => [2022 => 13000000, 2023 => 13500000],
            'Ayam Layer (Daging Afkir)' => [2022 => 7500000, 2023 => 8000000],
            'Sapi Impor (Daging)' => [2022 => 6000000, 2023 => 6500000],
            'Telur Buras & Lainnya' => [2022 => 4500000, 2023 => 4900000],
            'Sapi Lokal & Ruminansia Lain' => [2022 => 1800000, 2023 => 2100000],
        ];

        $inserted = 0;
        $jenisNames = array_keys($produksiData);

        foreach ($tahuns as $tahun) {
            foreach ($jenisNames as $jenisNama) {
                $jenisId = DB::table('jenis_ternak_produksi')->where('nama', $jenisNama)->value('id');
                if (!$jenisId) continue;

                $jumlah = $produksiData[$jenisNama][$tahun] ?? 0;

                ProduksiTernak::updateOrCreate(
                    [
                        'jenis_ternak_produksi_id' => $jenisId,
                        'tahun' => $tahun,
                    ],
                    ['jumlah' => $jumlah]
                );
                $inserted++;
            }
        }

        $this->command->info('Produksi Ternak: ' . $inserted . ' records');
    }

    private function seedPopulasiTernak(): void
    {
        $kecamatanIds = [1, 2, 3, 4];
        $tahuns = [2022, 2023];

        $populasiData = [
            'Sapi Potong' => [2022 => 20618, 2023 => 21168],
            'Sapi Perah' => [2022 => 5792, 2023 => 6099],
            'Kerbau' => [2022 => 2190, 2023 => 2320],
            'Domba' => [2022 => 278781, 2023 => 286781],
            'Kambing' => [2022 => 88129, 2023 => 90298],
            'Ayam Broiler' => [2022 => 27.16, 2023 => 28.19],
            'Ayam Layer' => [2022 => 9.20, 2023 => 9.35],
            'Ayam Buras' => [2022 => 2.04, 2023 => 1.82],
            'Itik & Manila' => [2022 => 299.5, 2023 => 305.0],
        ];

        $inserted = 0;
        $jenisNames = array_keys($populasiData);

        foreach ($kecamatanIds as $kecId) {
            foreach ($tahuns as $tahun) {
                foreach ($jenisNames as $jenisNama) {
                    $jenisId = DB::table('jenis_ternak_populasi')->where('nama', $jenisNama)->value('id');
                    if (!$jenisId) continue;

                    $jumlah = $populasiData[$jenisNama][$tahun] ?? 0;
                    $rtp = round($jumlah / 1000, 2);

                    PopulasiTernak::updateOrCreate(
                        [
                            'jenis_ternak_populasi_id' => $jenisId,
                            'id_kecamatan' => $kecId,
                            'tahun' => $tahun,
                        ],
                        ['jumlah' => $jumlah, 'rtp' => $rtp]
                    );
                    $inserted++;
                }
            }
        }

        $this->command->info('Populasi Ternak: ' . $inserted . ' records');
    }
}