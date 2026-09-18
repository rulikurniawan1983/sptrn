<?php

namespace Database\Seeders;

use App\Models\JenisProduksi;
use Illuminate\Database\Seeder;

class JenisProduksiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            ['nama' => 'Daging'],
            ['nama' => 'Telur'],
            ['nama' => 'Susu'],
        ];
        foreach ($data as $item) {
            JenisProduksi::updateOrCreate(['nama' => $item['nama']], $item);
        }
    }
} 