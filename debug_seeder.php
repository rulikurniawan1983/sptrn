<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DEBUG SEEDER ===\n";

// Cek permissions
echo "Permissions count: " . \App\Models\Permission::count() . "\n";
echo "UsersMenu count: " . \App\Models\UsersMenu::count() . "\n";

// Cek beberapa permission yang mungkin tidak ada
$permissionsToCheck = [
    'Menu Sidebar Show',
    'Setting Sidebar Show', 
    'Users Management Show',
    'Kelola Peternakan Sidebar Show',
    'Kelola Perikanan Sidebar Show',
    'Kelola Keswan Sidebar Show',
    'Laporan Sidebar Show',
    'Dashboard Show',
    'Users Menu Show',
    'Role Show',
    'Permission Show',
    'Activity Log Show',
    'Users Show',
    'Laporan Peternakan Show',
    'Laporan Perikanan Show',
    'Laporan Produksi Ternak Show',
    'Laporan Populasi Ternak Show',
    'Data Produksi Ternak Show',
    'Populasi Ternak Show',
    'Rekomendasi Nkv Show'
];

echo "\n=== CHECKING PERMISSIONS ===\n";
foreach ($permissionsToCheck as $permName) {
    $permission = \App\Models\Permission::where('name', $permName)->first();
    if ($permission) {
        echo "✓ {$permName} (ID: {$permission->id})\n";
    } else {
        echo "✗ {$permName} - NOT FOUND\n";
    }
}

// Cek beberapa menu
echo "\n=== SAMPLE USERS MENU ===\n";
$menus = \App\Models\UsersMenu::take(10)->get(['id', 'nama', 'kode', 'permission_id']);
foreach ($menus as $m) {
    echo "ID: {$m->id} | Nama: {$m->nama} | Kode: {$m->kode} | Permission ID: {$m->permission_id}\n";
}

echo "\n=== MENU WITH NULL PERMISSION ===\n";
$nullMenus = \App\Models\UsersMenu::whereNull('permission_id')->get(['id', 'nama', 'kode']);
foreach ($nullMenus as $m) {
    echo "ID: {$m->id} | Nama: {$m->nama} | Kode: {$m->kode}\n";
} 