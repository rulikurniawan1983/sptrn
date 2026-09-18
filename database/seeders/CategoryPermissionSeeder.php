<?php

namespace Database\Seeders;

use App\Models\CategoryPermission;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        CategoryPermission::truncate();
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $categoryPermissions = [
            [
                'name' => 'Users',
                'permission' => 'CRUD',
                'permission_common' => ["Users Login As"],
            ],
            [
                'name' => 'Role',
                'permission' => 'CRUD',
                'permission_common' => ["Role Set Permission"],
            ],
            [
                'name' => 'Permission',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Users Menu',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Activity Log',
                'permission' => ['Activity Log Show', 'Activity Log Detail', 'Activity Log Delete'],
            ],
            [
                'name' => 'Users Management',
                'permission' => ['Users Management Show'],
            ],
            [
                'name' => 'Dashboard',
                'permission' => ['Dashboard Show'],
            ],
            [
                'name' => 'My Profile',
                'permission' => ['Profile Show', 'Profile Change Role'],
            ],
            [
                'name' => 'Referensi',
                'permission' => ['Referensi Show'],
            ],
            [
                'name' => 'Master',
                'permission' => ['Master Show'],
            ],
            [
                'name' => 'Identity',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Medsos',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'API',
                'permission' => ['API Show'],
            ],
            [
                'name' => 'Sidebar Menu',
                'permission' => [
                    'Menu Sidebar Show',
                    'Master Umum Sidebar Show',
                    'Kelola Peternakan Sidebar Show',
                    'Kelola Perikanan Sidebar Show',
                    'Kelola Keswan Sidebar Show',
                    'Setting Sidebar Show',
                    'Laporan Sidebar Show',
                ]
            ],
            [
                'name' => 'Kecamatan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Desa',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Peternakan',
                'permission' => 'CRUD',
                'permission_common' => ["Peternakan Set Verifikasi"],
            ],
            [
                'name' => 'Peternakan Berkas',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Peternakan Produksi',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Master Peternakan',
                'permission' => ['Master Peternakan Show'],
            ],
            [
                'name' => 'Jenis Peternakan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Berkas Peternakan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Perikanan',
                'permission' => 'CRUD',
                'permission_common' => ["Perikanan Set Verifikasi"],
            ],
            [
                'name' => 'Perikanan Berkas',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Perikanan Produksi',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Master Perikanan',
                'permission' => ['Master Perikanan Show'],
            ],
            [
                'name' => 'Jenis Perikanan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Berkas Perikanan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Laporan Peternakan',
                'permission' => ['Laporan Peternakan Show', 'Laporan Peternakan Detail'],
            ],
            [
                'name' => 'Laporan Perikanan',
                'permission' => ['Laporan Perikanan Show', 'Laporan Perikanan Detail'],
            ],
            [
                'name' => 'Laporan Produksi Ternak',
                'permission' => ['Laporan Produksi Ternak Show', 'Laporan Produksi Ternak Detail'],
            ],
            [
                'name' => 'Laporan Populasi Ternak',
                'permission' => ['Laporan Populasi Ternak Show', 'Laporan Populasi Ternak Detail'],
            ],
            [
                'name' => 'Kbli',
                'permission' => ['Kbli Show', 'Kbli Detail'],
            ],
            [
                'name' => 'Jenis Usaha',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Tingkat Resiko',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Skala Usaha',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Status Verifikasi',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Status Permodalan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Satuan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Pengesahan Badan Hukum',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Praktek Dokter Hewan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Upt Puskeswan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Status Penyakit',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Master Keswan',
                'permission' => ['Master Keswan Show'],
            ],
            [
                'name' => 'Jenis Keswan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Berkas Keswan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Jenis Galeri',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Peternakan Galeri',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Praktek Dokter Hewan Berkas',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Praktek Dokter Hewan Galeri',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Fasilitas Upt',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Layanan Upt',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Upt Puskeswan Galeri',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Jenis Penyakit',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Status Penyakit Hewan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Status Penyakit Kasus',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Perikanan Galeri',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Rekomendasi Nkv',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Jenis Produksi',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Jenis Ternak Produksi',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Jenis Ternak Populasi',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Populasi Ternak',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Data Produksi Ternak',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Umkm Pengolahan Perikanan',
                'permission' => 'CRUD',
            ],
            [
                'name' => 'Umkm Product',
                'permission' => 'CRUD',
                'permission_common' => ["Umkm Product Verify"],
            ],
            [
                'name' => 'Umkm Legalitas',
                'permission' => 'CRUD',
                'permission_common' => ["Umkm Legalitas Verify"],
            ],
            [
                'name' => 'User Umkm',
                'permission' => 'CRUD',
                'permission_common' => ["User Umkm Verify"],
            ],
        ];


        $listCrud = ["Show", "Add", "Edit", "Detail", "Delete"];

        foreach ($categoryPermissions as $category) {

            $existingCategoryPermission = CategoryPermission::where('name', $category['name'])->first();
            if (!$existingCategoryPermission) {
                $data_insert = $category;
                unset($data_insert['permission']);
                unset($data_insert['permission_common']);
                $existingCategoryPermission = CategoryPermission::create($data_insert);
            }
            $listPermission = [];

            // Jika ada Permission CRUD
            if ($category['permission'] == 'CRUD') {
                foreach ($listCrud as $key => $value) {
                    $listPermission[] = $category['name'] . " " . $value;
                }
            } else {
                foreach ($category['permission'] as $key => $value) {
                    $listPermission[] = $value;
                }
            }

            // Jika ada Permission Tambahan
            if (isset($category['permission_common'])) {
                foreach ($category['permission_common'] as $key => $value) {
                    $listPermission[] = $value;
                }
            }


            // Membuat Permission
            foreach ($listPermission as $key => $value) {
                $existingPermission = Permission::where('name', $value)->first();
                $permissionData = [
                    "category_permission_id" => $existingCategoryPermission->id,
                    "name" => $value,
                ];

                if (!$existingPermission) {
                    // Jika tidak ada, buat Permission baru
                    Permission::create($permissionData);
                } else {
                    // Jika sudah ada, Anda dapat memutuskan apakah ingin melakukan sesuatu atau melewatinya
                    // Contoh: Update data yang sudah ada
                    $existingPermission->update($permissionData);
                }
            }
        }
        $this->command->info('Category Permission Seeder table seeded!');
    }
}