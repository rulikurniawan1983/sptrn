<?php

namespace Database\Seeders;

use App\Models\MstJenisKeswan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisKeswanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => '1',
                'nama' => 'Praktik Hewan Kecil',
            ],
            [
                'id' => '2',
                'nama' => 'Praktik Hewan Besar',
            ],
            [
                'id' => '3',
                'nama' => 'Praktik Campuran',
            ],
            [
                'id' => '4',
                'nama' => 'Praktik Eksotik',
            ],
            [
                'id' => '5',
                'nama' => 'Praktik Kesehatan Hewan Liar',
            ],
            [
                'id' => '6',
                'nama' => 'Praktik Kebun Binatang',
            ],
        ];
        foreach ($listData as $data) {
            MstJenisKeswan::create($data);
        }
        $this->command->info('Jenis Keswan table seeded!');
    }
}
