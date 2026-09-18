<?php

namespace Database\Seeders;

use App\Models\MstJenisUsaha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 1,
                "nama" => "Perorangan",
            ],
            [
                "id" => 2,
                "nama" => "PT",
            ],
            [
                "id" => 3,
                "nama" => "CV",
            ],
            [
                "id" => 4,
                "nama" => "Koperasi",
            ],
            [
                "id" => 5,
                "nama" => "Kelompok",
            ]
        ];
        foreach ($listData as $data) {
            MstJenisUsaha::create($data);
        }
        $this->command->info('Jenis Usaha table seeded!');
    }
}
