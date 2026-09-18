<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class ImportSqlLiteSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            $this->command->info('Skipping ImportSqlLiteSeeder (not SQLite).');
            return;
        }

        $files = [
            'sql/mst_kbli.sql',
            'sql/mst_satuan.sql',
            'sql/kecamatan_kelurahan.sql',
            'sql/peternakan_.sql',
            'sql/perikanan_.sql',
        ];

        Schema::disableForeignKeyConstraints();

        foreach ($files as $path) {
            $fullPath = database_path($path);
            if (!File::exists($fullPath)) {
                $this->command->warn("Skipping $path (not found).");
                continue;
            }

            $sql = File::get($fullPath);
            $inserts = $this->extractInserts($sql);
            $imported = 0;

            foreach ($inserts as $insert) {
                try {
                    DB::insert($insert);
                    $imported++;
                } catch (\Exception $e) {
                    // Skip duplicate or constraint errors
                }
            }

            $this->command->info("Imported $imported records from $path");
        }

        Schema::enableForeignKeyConstraints();

        $this->command->info('SQLite data import completed.');
    }

    private function extractInserts(string $sql): array
    {
        $inserts = [];
        $lines = explode("\n", $sql);
        $currentInsert = '';
        $inInsert = false;

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if (preg_match('/^INSERT INTO/', $trimmed)) {
                $inInsert = true;
                $currentInsert = $trimmed;
                continue;
            }

            if ($inInsert) {
                $currentInsert .= ' ' . $trimmed;

                if (substr(rtrim($currentInsert), -1) === ';') {
                    $inserts[] = $this->cleanInsert($currentInsert);
                    $inInsert = false;
                    $currentInsert = '';
                }
            }
        }

        return $inserts;
    }

    private function cleanInsert(string $sql): string
    {
        $sql = preg_replace('/,\s*\)/', ')', $sql);
        $sql = preg_replace('/,\s*\)/', ')', $sql);
        return $sql;
    }
}