<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Exception;

class ImportSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            $this->command->info('Skipping ImportSqlSeeder on SQLite (MySQL-only SQL dumps).');
            return;
        }

        try {

            $path = database_path('sql/mst_kbli.sql');
            $sql = File::get($path);
            DB::unprepared($sql);  // Menjalankan perintah SQL

            $path = database_path('sql/mst_satuan.sql');
            $sql = File::get($path);
            DB::unprepared($sql);  // Menjalankan perintah SQL

            $path = database_path('sql/peternakan_.sql');
            $sql = File::get($path);
            DB::unprepared($sql);  // Menjalankan perintah SQL

            $path = database_path('sql/perikanan_.sql');
            $sql = File::get($path);
            DB::unprepared($sql);  // Menjalankan perintah SQL

            // Pesan sukses
            $this->command->info('Data berhasil di import dari file SQL.');
        } catch (Exception $e) {
            // Menangkap kesalahan dan menampilkan pesan
            $this->command->error('Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());

            // Opsional: mencatat kesalahan ke dalam log
            Log::error('Error importing SQL file: ' . $e->getMessage());
        }
    }
}
