<?php

namespace Database\Seeders;

use App\Models\JenisTernakProduksi;
use App\Models\JenisProduksi;
use App\Models\ProduksiTernak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisTernakProduksiSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }
        ProduksiTernak::truncate();
        JenisTernakProduksi::truncate();
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
        $data = [
            // Daging
            ['kategori' => 'Daging', 'nama' => 'Sapi Lokal'],
            ['kategori' => 'Daging', 'nama' => 'Sapi Impor'],
            ['kategori' => 'Daging', 'nama' => 'Kerbau'],
            ['kategori' => 'Daging', 'nama' => 'Kambing'],
            ['kategori' => 'Daging', 'nama' => 'Domba'],
            ['kategori' => 'Daging', 'nama' => 'Ayam Ras Pedaging'],
            ['kategori' => 'Daging', 'nama' => 'Ayam Ras Petelur'],
            ['kategori' => 'Daging', 'nama' => 'Ayam Buras'],
            ['kategori' => 'Daging', 'nama' => 'Itik'],
            ['kategori' => 'Daging', 'nama' => 'Itik Manila'],
            ['kategori' => 'Daging', 'nama' => 'Puyuh'],
            // Telur
            ['kategori' => 'Telur', 'nama' => 'Ayam Ras Petelur'],
            ['kategori' => 'Telur', 'nama' => 'Ayam Buras'],
            ['kategori' => 'Telur', 'nama' => 'Itik'],
            ['kategori' => 'Telur', 'nama' => 'Itik Manila'],
            ['kategori' => 'Telur', 'nama' => 'Burung Puyuh'],
            // Susu
            ['kategori' => 'Susu', 'nama' => 'Sapi'],
        ];

        foreach ($data as $row) {
            $jenisProduksi = JenisProduksi::where('nama', $row['kategori'])->first();
            if ($jenisProduksi) {
                JenisTernakProduksi::updateOrCreate(
                    [
                        'nama' => $row['nama'],
                        'jenis_produksi_id' => $jenisProduksi->id,
                    ],
                    [
                        'nama' => $row['nama'],
                        'jenis_produksi_id' => $jenisProduksi->id,
                    ]
                );
            }
        }
    }
}
