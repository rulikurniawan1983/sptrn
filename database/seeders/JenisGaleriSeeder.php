<?php

namespace Database\Seeders;

use App\Models\MstJenisGaleri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisGaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => '1',
                'nama' => 'Tempat/Lokasi',
            ],
            [
                'id' => '2',
                'nama' => 'Produk',
            ],
            [
                'id' => '3',
                'nama' => 'Kegiatan',
            ],
        ];
        foreach ($listData as $data) {
            MstJenisGaleri::create($data);
        }
        $this->command->info('Jenis Galeri table seeded!');
    }
}