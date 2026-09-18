<?php

namespace Database\Seeders;

use App\Models\MstFasilitasUpt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasUptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => '1',
                'nama' => 'Laboratorium',
            ],
            [
                'id' => '2',
                'nama' => 'Kandang Karantina',
            ],
        ];
        foreach ($listData as $data) {
            MstFasilitasUpt::create($data);
        }
        $this->command->info('Fasilitas UPT table seeded!');
    }
}
