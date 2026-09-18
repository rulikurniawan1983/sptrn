<?php

namespace Database\Seeders;

use App\Models\StatusVerifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusVerifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 4,
                "nama" => "Draft",
                "is_default" => true,
            ],
            [
                "id" => 1,
                "nama" => "Sudah Verifikasi",
                "is_default" => false,
            ],
            [
                "id" => 2,
                "nama" => "Belum Verifikasi",
                "is_default" => false,
            ],
            [
                "id" => 3,
                "nama" => "Perbaikan Data",
                "is_default" => false,
            ],
        ];
        foreach ($listData as $data) {
            StatusVerifikasi::create($data);
        }
        $this->command->info('Status Verifikasi table seeded!');
    }
}
