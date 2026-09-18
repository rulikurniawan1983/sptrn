<?php

namespace Database\Seeders;

use App\Models\MstBerkasPerikanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerkasPerikananSeeder extends Seeder
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
            MstBerkasPerikanan::create($data);
        }
        $this->command->info('Berkas Perikanan table seeded!');
    }
}
