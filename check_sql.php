<?php
echo "=== Check reference tables ===\n";
$tables = ['mst_kbli', 'mst_jenis_peternakan', 'mst_kecamatan', 'mst_desa', 'status_verifikasi', 'mst_tingkat_resiko', 'mst_skala_usaha', 'mst_status_permodalan', 'mst_pengesahan_badan_hukum', 'mst_satuan'];
foreach ($tables as $t) {
    try {
        $count = DB::table($t)->count();
        echo "$t: $count\n";
    } catch (\Exception $e) {
        echo "$t: NOT EXISTS\n";
    }
}

echo "\n=== Sample IDs from peternakan SQL ===\n";
$content = file_get_contents(database_path('sql/peternakan_.sql'));
preg_match_all('/INSERT INTO.*VALUES\s*\n(.*?);/s', $content, $matches);
if (!empty($matches[1])) {
    $values = $matches[1][0];
    // Extract id_kbli values
    preg_match_all('/,\s*(\d+),(\d+),(\d+),(\d+),(\d+),/', $values, $m);
    echo "Sample id_kbli: " . implode(', ', array_unique($m[1])) . "\n";
    echo "Sample id_kecamatan: " . implode(', ', array_unique($m[4])) . "\n";
    echo "Sample id_status_verifikasi: " . implode(', ', array_unique($m[5])) . "\n";
}
