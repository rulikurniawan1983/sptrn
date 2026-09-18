<?php

namespace Database\Seeders;

use App\Models\MstStatusPermodalan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPermodalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 1,
                "nama" => "PMDN",
            ],
            [
                "id" => 2,
                "nama" => "PMA",
            ],
        ];
        foreach ($listData as $data) {
            MstStatusPermodalan::create($data);
        }
        $this->command->info('Status Permodalan table seeded!');
    }
}
