<?php

namespace Database\Seeders;

use App\Models\MstTingkatResiko;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TingkatResikoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 1,
                "nama" => "Rendah",
            ],
            [
                "id" => 2,
                "nama" => "Menengah Rendah",
            ],
            [
                "id" => 3,
                "nama" => "Menengah Tinggi",
            ],
            [
                "id" => 4,
                "nama" => "Menengah",
            ],
            [
                "id" => 5,
                "nama" => "Tinggi",
            ]
        ];
        foreach ($listData as $data) {
            MstTingkatResiko::create($data);
        }
        $this->command->info('Tingkat Resiko table seeded!');
    }
}
