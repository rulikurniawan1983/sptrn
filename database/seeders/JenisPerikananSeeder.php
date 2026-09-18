<?php

namespace Database\Seeders;

use App\Models\MstJenisPerikanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPerikananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => '1',
                'nama' => 'Budidaaya Bibit',
            ],
            [
                'id' => '2',
                'nama' => 'Budidaya Ikan',
            ],
        ];
        foreach ($listData as $data) {
            MstJenisPerikanan::create($data);
        }
        $this->command->info('Jenis Perikanan table seeded!');
    }
}
