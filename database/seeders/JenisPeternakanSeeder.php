<?php

namespace Database\Seeders;

use App\Models\MstJenisPeternakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPeternakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $listData = [
            [
                'id' => '1',
                'nama' => 'Sapi Perah',
            ],
            [
                'id' => '2',
                'nama' => 'Sapi Pedaging',
            ],
            [
                'id' => '3',
                'nama' => 'Ayam pedaging',
            ],
            [
                'id' => '4',
                'nama' => 'Ayam petelur',
            ],
            [
                'id' => '5',
                'nama' => 'Bebek pedaging',
            ],
            [
                'id' => '6',
                'nama' => 'Bebek petelur',
            ],
            [
                'id' => '7',
                'nama' => 'Itik pedaging',
            ],
            [
                'id' => '8',
                'nama' => 'Itik petelur',
            ]
        ];
        foreach ($listData as $data) {
            MstJenisPeternakan::create($data);
        }
        $this->command->info('Jenis Peternakan table seeded!');
    }
}
