<?php

namespace Database\Seeders;

use App\Models\MstSkalaUsaha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkalaUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 1,
                "nama" => "Non-Kecil",
            ],
            [
                "id" => 2,
                "nama" => "Kecil",
            ],
            [
                "id" => 3,
                "nama" => "Mikro",
            ],
            [
                "id" => 4,
                "nama" => "Menengah",
            ]
        ];
        foreach ($listData as $data) {
            MstSkalaUsaha::create($data);
        }
        $this->command->info('Skala Usaha table seeded!');
    }
}
