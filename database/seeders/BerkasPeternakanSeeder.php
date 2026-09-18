<?php

namespace Database\Seeders;

use App\Models\MstBerkasPeternakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerkasPeternakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 1,
                "nama" => "Akta Pendirian",
            ],
            [
                "id" => 2,
                "nama" => "NIB",
            ],
            [
                "id" => 3,
                "nama" => "SITU",
            ],
            [
                "id" => 4,
                "nama" => "Izin Lingkungan Setempat",
            ]
        ];
        foreach ($listData as $data) {
            MstBerkasPeternakan::create($data);
        }
        $this->command->info('Berkas Peternakan table seeded!');
    }
}
