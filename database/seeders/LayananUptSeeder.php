<?php

namespace Database\Seeders;

use App\Models\MstLayananUpt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananUptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => '1',
                'nama' => 'Pemeriksaan Hewan',
            ],
            [
                'id' => '2',
                'nama' => 'Vaksinasi',
            ],
            [
                'id' => '3',
                'nama' => 'Steril',
            ],
            [
                'id' => '4',
                'nama' => 'Konsultasi Kesehatan Hewan',
            ],
        ];
        foreach ($listData as $data) {
            MstLayananUpt::create($data);
        }
        $this->command->info('Layanan UPT table seeded!');
    }
}
