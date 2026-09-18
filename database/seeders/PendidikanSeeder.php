<?php

namespace Database\Seeders;

use App\Models\MstPendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                "id" => 1,
                "nama" => "SD",
            ],
            [
                "id" => 2,
                "nama" => "SMP",
            ],
            [
                "id" => 3,
                "nama" => "SMA",
            ],
            [
                "id" => 4,
                "nama" => "Perguruan Tinggi",
            ],
        ];
        foreach ($listData as $data) {
            MstPendidikan::create($data);
        }
        $this->command->info('Pendidikan table seeded!');
    }
}
