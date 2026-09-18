<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\UsersMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        UsersMenu::truncate();
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        $usersMenus = [
            [
                'nama' => 'Menu',
                'kode' => 'MENU-SIDEBAR',
                'url' => '#',
                'icon' => null,
                'rel' => 0,
                'urutan' => 1,
                'permission_id' => 'Menu Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Dashboard',
                        'icon' => '<i class="ti ti-dashboard"></i>',
                        'urutan' => 1,
                    ],
                ],
            ],
            [
                'nama' => 'Settings',
                'kode' => 'SETTING-SIDEBAR',
                'url' => '#',
                'icon' => null,
                'rel' => 0,
                'urutan' => 1000,
                'permission_id' => 'Setting Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Menu & Permissions',
                        'kode' => 'USERS-MANAGEMENT',
                        'url' => '#',
                        'icon' => '<i class="ti ti-users-group"></i>',
                        'urutan' => 999,
                        'permission_id' => 'Users Management Show',
                        'children' => [
                            [
                                'nama' => 'Menu',
                                'kode' => 'USERS-MENU',
                                'url' => 'users-menu',
                                'urutan' => 1,
                                'permission_id' => 'Users Menu Show',
                            ],
                            [
                                'nama' => 'Role',
                                'urutan' => 2,
                            ],
                            [
                                'nama' => 'Permission',
                                'urutan' => 3,
                            ],
                            [
                                'nama' => 'Activity Log',
                                'urutan' => 4,
                            ],
                        ],
                    ],
                    [
                        'nama' => 'User UMKM',
                        'kode' => 'USER-UMKM',
                        'url' => 'user-umkm',
                        'icon' => '<i class="ti ti-building-store"></i>',
                        'urutan' => 997,
                        'permission_id' => 'User Umkm Show',
                    ],
                    [
                        'nama' => 'Users',
                        'icon' => '<i class="ti ti-users"></i>',
                        'urutan' => 998,
                    ],
                ],
            ],
            [
                'nama' => 'Master Umum',
                'kode' => 'MASTER-UMUM-SIDEBAR',
                'url' => '#',
                'icon' => null,
                'rel' => 0,
                'urutan' => 11,
                'permission_id' => 'Master Umum Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Kecamatan',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 1,
                    ],
                    [
                        'nama' => 'Desa',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 2,
                    ],
                    [
                        'nama' => 'Kbli',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 3,
                    ],
                    [
                        'nama' => 'Jenis Usaha',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 4,
                    ],
                    [
                        'nama' => 'Tingkat Resiko',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 5,
                    ],
                    [
                        'nama' => 'Skala Usaha',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 6,
                    ],
                    [
                        'nama' => 'Status Verifikasi',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 7,
                    ],
                    [
                        'nama' => 'Status Permodalan',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 8,
                    ],
                    [
                        'nama' => 'Satuan',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 9,
                    ],
                    [
                        'nama' => 'Pengesahan Badan Hukum',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 10,
                    ],
                    [
                        'nama' => 'Jenis Galeri',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 11,
                    ],
                ],
            ],
            [
                'nama' => 'Kelola Peternakan',
                'kode' => 'KELOLA-PETERNAKAN-SIDEBAR',
                'url' => '#',
                'icon' => null,
                'rel' => 0,
                'urutan' => 2,
                'permission_id' => 'Kelola Peternakan Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Peternakan',
                        'icon' => '<i class="ti ti-building-cottage"></i>',
                        'urutan' => 1,
                    ],
                    [
                        'nama' => 'Data Produksi Ternak',
                        'icon' => '<i class="ti ti-chart-bar"></i>',
                        'urutan' => 2,
                        'permission_id' => 'Data Produksi Ternak Show',
                    ],
                    [
                        'nama' => 'Data Populasi Ternak',
                        'url' => 'populasi-ternak',
                        'icon' => '<i class="ti ti-paw"></i>',
                        'urutan' => 3,
                        'permission_id' => 'Populasi Ternak Show',
                    ],
                    [
                        'nama' => 'Produk UMKM',
                        'kode' => 'UMKM-PRODUCT-PETERNAKAN',
                        'url' => 'umkm-product',
                        'icon' => '<i class="ti ti-shopping-cart"></i>',
                        'urutan' => 4,
                        'permission_id' => 'Umkm Product Show',
                    ],
                    [
                        'nama' => 'Master Peternakan',
                        'url' => '#',
                        'icon' => '<i class="ti ti-list"></i>',
                        'urutan' => 5,
                        'children' => [
                            [
                                'nama' => 'Jenis Peternakan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 1,
                            ],
                            [
                                'nama' => 'Berkas Peternakan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 2,
                            ],
                            [
                                'nama' => 'Jenis Produksi',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 6,
                                'permission_id' => 'Jenis Produksi Show',
                            ],
                            [
                                'nama' => 'Jenis Ternak Produksi',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 7,
                                'permission_id' => 'Jenis Ternak Produksi Show',
                            ],
                            [
                                'nama' => 'Jenis Ternak Populasi',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 8,
                                'permission_id' => 'Jenis Ternak Populasi Show',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'nama' => 'Kelola Perikanan',
                'kode' => 'KELOLA-PERIKANAN-SIDEBAR',
                'url' => '#',
                'icon' => null,
                'rel' => 0,
                'urutan' => 3,
                'permission_id' => 'Kelola Perikanan Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Perikanan',
                        'icon' => '<i class="ti ti-fish"></i>',
                        'urutan' => 1,
                    ],
                    [
                        'nama' => 'Umkm Pengolahan Perikanan',
                        'kode' => 'UMKM-PENGOLAHAN-PERIKANAN',
                        'url' => 'umkm-pengolahan-perikanan',
                        'icon' => '<i class="ti ti-building-store"></i>',
                        'urutan' => 2,
                        'permission_id' => 'Umkm Pengolahan Perikanan Show',
                    ],
                    [
                        'nama' => 'Produk UMKM',
                        'kode' => 'UMKM-PRODUCT-PERIKANAN',
                        'url' => 'umkm-product',
                        'icon' => '<i class="ti ti-shopping-cart"></i>',
                        'urutan' => 3,
                        'permission_id' => 'Umkm Product Show',
                    ],
                    [
                        'nama' => 'Master Perikanan',
                        'url' => '#',
                        'icon' => '<i class="ti ti-list"></i>',
                        'urutan' => 3,
                        'children' => [
                            [
                                'nama' => 'Jenis Perikanan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 1,
                            ],
                            [
                                'nama' => 'Berkas Perikanan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 2,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'nama' => 'Kelola Keswan',
                'kode' => 'KELOLA-KESWAN-SIDEBAR',
                'url' => '#',
                'icon' => null,
                'rel' => 0,
                'urutan' => 4,
                'permission_id' => 'Kelola Keswan Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Praktek Dokter Hewan',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 1,
                    ],
                    [
                        'nama' => 'UPT Puskeswan',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 2,
                        'children' => [
                            [
                                'nama' => 'Jenis Keswan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 1,
                            ],
                            [
                                'nama' => 'Berkas Keswan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 2,
                            ],
                            [
                                'nama' => 'Fasilitas Upt',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 3,
                            ],
                            [
                                'nama' => 'Layanan Upt',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 4,
                            ],
                            [
                                'nama' => 'Jenis Penyakit',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 5,
                            ],
                        ],
                    ],
                    [
                        'nama' => 'Status Penyakit',
                        'icon' => '<i class="ti ti-point"></i>',
                        'urutan' => 3,
                    ],
                    [
                        'nama' => 'Master Keswan',
                        'url' => '#',
                        'icon' => '<i class="ti ti-list"></i>',
                        'urutan' => 5,
                        'children' => [
                            [
                                'nama' => 'Jenis Keswan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 1,
                            ],
                            [
                                'nama' => 'Berkas Keswan',
                                'icon' => '<i class="ti ti-point"></i>',
                                'urutan' => 2,
                            ],
                        ],
                    ],
                    [
                        'nama' => 'Rekomendasi NKV',
                        'icon' => '<i class="ti ti-certificate"></i>',
                        'urutan' => 4,
                        'permission_id' => 'Rekomendasi Nkv Show',
                    ],
                ],
            ],
            [
                'nama' => 'Laporan',
                'kode' => 'LAPORAN-SIDEBAR',
                'url' => '#',
                'icon' => '<i class="ti ti-list"></i>',
                'rel' => 0,
                'urutan' => 10,
                'permission_id' => 'Laporan Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Peternakan',
                        'kode' => 'LAPORAN-PETERNAKAN',
                        'url' => 'laporan-peternakan',
                        'icon' => '<i class="ti ti-list"></i>',
                        'urutan' => 1,
                        'permission_id' => 'Laporan Peternakan Show',
                    ],
                    [
                        'nama' => 'Perikanan',
                        'kode' => 'LAPORAN-PERIKANAN',
                        'url' => 'laporan-perikanan',
                        'icon' => '<i class="ti ti-list"></i>',
                        'urutan' => 2,
                        'permission_id' => 'Laporan Perikanan Show',
                    ],
                    [
                        'nama' => 'Produksi Ternak',
                        'kode' => 'LAPORAN-PRODUKSI-TERNAK',
                        'url' => 'laporan-produksi-ternak',
                        'icon' => '<i class="ti ti-list"></i>',
                        'urutan' => 3,
                        'permission_id' => 'Laporan Produksi Ternak Show',
                    ],
                    [
                        'nama' => 'Populasi Ternak',
                        'kode' => 'LAPORAN-POPULASI-TERNAK',
                        'url' => 'laporan-populasi-ternak',
                        'icon' => '<i class="ti ti-list"></i>',
                        'urutan' => 4,
                        'permission_id' => 'Laporan Populasi Ternak Show',
                    ],
                ],
            ],
            [
                'nama' => 'Kelola Perizinan',
                'kode' => 'KELOLA-PERIZINAN-SIDEBAR',
                'url' => '#',
                'icon' => null,
                'rel' => 0,
                'urutan' => 8,
                'permission_id' => 'Kelola Perizinan Sidebar Show',
                'children' => [
                    [
                        'nama' => 'Perizinan',
                        'kode' => 'PERIZINAN',
                        'url' => 'perizinan',
                        'icon' => '<i class="ti ti-file-text"></i>',
                        'urutan' => 1,
                        'permission_id' => 'Perizinan Show',
                    ],
                ]
            ],
        ];

        $this->insertMenus($usersMenus);
    }

    // Recursive untuk insert menu & child-nya
    private function insertMenus(array $menus, $parentId = 0)
    {
        foreach ($menus as $menuData) {
            $children = $menuData['children'] ?? null;
            unset($menuData['children']);

            // Generate kode kalau belum ada
            if (!isset($menuData['kode'])) {
                $menuData['kode'] = str_replace(' ', '-', strtoupper($menuData['nama']));
            }

            // Generate URL kalau belum ada
            if (!isset($menuData['url'])) {
                $menuData['url'] = str_replace(' ', '-', strtolower($menuData['nama']));
            }

            $menuData['rel'] = $parentId;

            // Cek permission_id
            if (isset($menuData['permission_id'])) {
                if (is_string($menuData['permission_id'])) {
                    $permission = Permission::where("name", $menuData['permission_id'])->first();
                    $menuData['permission_id'] = $permission?->id;
                }
            } else {
                $permission = Permission::where("name", $menuData['nama'] . " Show")->first();
                $menuData['permission_id'] = $permission?->id;
            }

            // Cek apakah sudah ada, kalau ada update, kalau belum insert
            $existingMenu = UsersMenu::where('kode', $menuData['kode'])->first();

            if ($existingMenu) {
                $existingMenu->update($menuData);
                $menuId = $existingMenu->id;
            } else {
                $newMenu = UsersMenu::create($menuData);
                $menuId = $newMenu->id;
            }

            // Recursive ke children kalau ada
            if ($children) {
                $this->insertMenus($children, $menuId);
            }
        }
    }
}