<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisTernakPopulasi;
use Illuminate\Support\Facades\DB;

class JenisTernakPopulasiSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }
        JenisTernakPopulasi::truncate();
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
        $data = [
            ['nama' => 'SAPI POTONG'],
            ['nama' => 'SAPI PERAH'],
            ['nama' => 'KERBAU'],
            ['nama' => 'KUDA'],
            ['nama' => 'KAMBING'],
            ['nama' => 'KAMBING PERAH'],
            ['nama' => 'DOMBA'],
            ['nama' => 'BABI'],
            ['nama' => 'AYAM BURAS'],
            ['nama' => 'AYAM RAS PETELUR'],
            ['nama' => 'AYAM RAS PEDAGING'],
            ['nama' => 'ITIK'],
            ['nama' => 'ITIK MANILA'],
            ['nama' => 'MERPATI'],
            ['nama' => 'PUYUH'],
            ['nama' => 'KELINCI'],
            ['nama' => 'ANGSA'],
            ['nama' => 'ANJING'],
            ['nama' => 'KUCING'],
            ['nama' => 'KERA'],
            ['nama' => 'RUSA'],
        ];
        foreach ($data as $item) {
            JenisTernakPopulasi::firstOrCreate(['nama' => $item['nama']]);
        }
    }
} 