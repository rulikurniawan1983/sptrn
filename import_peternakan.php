<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

$sql = File::get(database_path('sql/peternakan_.sql'));

// Find column list in INSERT
$insertPos = strpos($sql, 'INSERT INTO `peternakan`');
$colEnd = strpos($sql, ')', $insertPos);
$colPart = substr($sql, $insertPos, $colEnd - $insertPos + 1);
preg_match_all('/`([^`]+)`/', $colPart, $colMatches);
$columns = $colMatches[1];

// Find VALUES
$afterValues = substr($sql, strpos($sql, 'VALUES', $insertPos) + 6);
$endPos = strpos($afterValues, ');');
$valuesData = substr($afterValues, 1, $endPos);

$rows = explode("),\n\t(", $valuesData);
$rows[0] = ltrim($rows[0], "\t(");
$rows[0] = rtrim($rows[0], ",");
$lastKey = count($rows) - 1;
$rows[$lastKey] = ltrim($rows[$lastKey], "\t(");
$rows[$lastKey] = rtrim($rows[$lastKey], ",");

echo "Columns: " . count($columns) . " | Rows: " . count($rows) . "\n";

DB::statement("PRAGMA foreign_keys = OFF;");
$count = 0;
$errors = 0;

foreach ($rows as $row) {
    $values = [];
    $i = 0;
    $len = strlen($row);
    while ($i < $len) {
        while ($i < $len && ($row[$i] === ' ' || $row[$i] === "\t" || $row[$i] === "\n")) $i++;
        if ($i >= $len) break;
        if ($row[$i] === "'") {
            $i++;
            $val = '';
            while ($i < $len) {
                if ($row[$i] === '\\' && $i + 1 < $len) { $val .= $row[$i+1]; $i += 2; }
                elseif ($row[$i] === "'" && $i + 1 < $len && $row[$i+1] === "'") { $val .= "'"; $i += 2; }
                elseif ($row[$i] === "'") { $i++; break; }
                else { $val .= $row[$i]; $i++; }
            }
            $values[] = $val;
            if ($i < $len && $row[$i] === ',') $i++;
        } elseif ($row[$i] === ',') {
            $values[] = null;
            $i++;
        } else {
            $val = '';
            while ($i < $len && $row[$i] !== ',' && $row[$i] !== ' ' && $row[$i] !== "\t" && $row[$i] !== "\n") {
                $val .= $row[$i]; $i++;
            }
            $val = trim($val);
            $values[] = $val === 'NULL' ? null : ($val === '' ? null : (is_numeric($val) ? (int)$val : $val));
            if ($i < $len && $row[$i] === ',') $i++;
        }
    }

    // Match columns to values
    $data = [];
    $valCount = count($values);
    for ($j = 0; $j < min(count($columns), $valCount); $j++) {
        $data[$columns[$j]] = $values[$j];
    }

    try {
        DB::table('peternakan')->insert($data);
        $count++;
    } catch (\Exception $e) {
        $errors++;
    }
}

DB::statement("PRAGMA foreign_keys = ON;");
echo "Inserted: $count, Errors: $errors\n";
echo "Total peternakan: " . DB::table('peternakan')->count() . "\n";
