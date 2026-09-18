<?php
echo "Tables:\n";
$tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
foreach ($tables as $t) {
    echo "  {$t->name}\n";
}

echo "\npeternakan count: " . DB::table('peternakan')->count() . "\n";
echo "mst_jenis_peternakan count: " . DB::table('mst_jenis_peternakan')->count() . "\n";
echo "kecamatan count: " . DB::table('kecamatan')->count() . "\n";
