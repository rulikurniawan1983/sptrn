<?php

namespace Database\Seeders;

use App\Models\MstJenisPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => '1',
                'nama' => 'Infeksius',
            ],
            [
                'id' => '2',
                'nama' => 'Non-infeksius',
            ],
            [
                'id' => '3',
                'nama' => 'Zoonosis',
            ],
        ];
        foreach ($listData as $data) {
            MstJenisPenyakit::create($data);
        }
        $this->command->info('Jenis Penyakit table seeded!');
    }
}
