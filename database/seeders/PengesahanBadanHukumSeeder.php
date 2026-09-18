<?php

namespace Database\Seeders;

use App\Models\MstPengesahanBadanHukum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengesahanBadanHukumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 1,
                "nama" => "Deputi Bidang Kelembagaan KUKM atas Nama Menteri",
            ],
            [
                "id" => 2,
                "nama" => "Gubernur atas Nama Menteri",
            ],
            [
                "id" => 3,
                "nama" => "Bupati/Walikota atas Nama Menteri",
            ],
        ];
        foreach ($listData as $data) {
            MstPengesahanBadanHukum::create($data);
        }
        $this->command->info('Pengesahan Badan Hukum table seeded!');
    }
}
