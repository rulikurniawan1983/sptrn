<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Services\UsersLevelService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetRolePermissionSeeder extends Seeder
{


    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission_wajib_ada = ["Profile Show", "Profile Change Role"];
        $role_id_array = Role::get()->pluck("id")->toArray();
        $permission_id_all = Permission::get()->pluck("id")->toArray();
        $permission_user_api_default = Permission::whereIn("name", ["API Menu Show"])->get()->pluck("id")->toArray();


        $list_permission_pimpinan = ["Profile Show", "Profile Change Role ", "Dashboard Show", "Menu Sidebar Show", "Laporan Sidebar Show", "Laporan Peternakan Show", "Laporan Peternakan Detail", "Laporan Perikanan Show", "Laporan Perikanan Detail"];
        $permission_pimpinan = Permission::whereIn("name",
        $list_permission_pimpinan)->get()->pluck("id")->toArray();

        $list_permission_upt = ["Dashboard Show", "Profile Show", "Profile Change Role", "Menu Sidebar Show", "Kelola Peternakan Sidebar Show", "Kelola Perikanan Sidebar Show", "Laporan Sidebar Show", "Peternakan Show", "Peternakan Add", "Peternakan Edit", "Peternakan Detail", "Peternakan Delete", "Peternakan Set Verifikasi", "Peternakan Berkas Show", "Peternakan Berkas Add", "Peternakan Berkas Edit", "Peternakan Berkas Detail", "Peternakan Berkas Delete", "Peternakan Produksi Show", "Peternakan Produksi Add", "Peternakan Produksi Edit", "Peternakan Produksi Detail", "Peternakan Produksi Delete", "Perikanan Show", "Perikanan Add", "Perikanan Edit", "Perikanan Detail", "Perikanan Delete", "Perikanan Set Verifikasi", "Perikanan Berkas Show", "Perikanan Berkas Add", "Perikanan Berkas Edit", "Perikanan Berkas Detail", "Perikanan Berkas Delete", "Perikanan Produksi Show", "Perikanan Produksi Add", "Perikanan Produksi Edit", "Perikanan Produksi Detail", "Perikanan Produksi Delete", "Laporan Peternakan Show", "Laporan Peternakan Detail", "Laporan Perikanan Show", "Laporan Perikanan Detail"];
        $permission_upt = Permission::whereIn("name",
        $list_permission_upt)->get()->pluck("id")->toArray();

        $list_permission_umkm = ["Profile Show", "Profile Change Role", "Dashboard Show", "Menu Sidebar Show", "Kelola Peternakan Sidebar Show", "Umkm Product Show", "Umkm Product Add", "Umkm Product Edit", "Umkm Product Detail", "Umkm Product Delete", "Umkm Legalitas Show", "Umkm Legalitas Add", "Umkm Legalitas Edit", "Umkm Legalitas Detail", "Umkm Legalitas Delete", "Kelola Perizinan Sidebar Show", "Perizinan Show", "Perizinan Add", "Perizinan Delete"];
        $permission_umkm = Permission::whereIn("name", $list_permission_umkm)->get()->pluck("id")->toArray();

        $list_permission_koperasi = ["Profile Show", "Profile Change Role", "Dashboard Show", "Menu Sidebar Show", "Kelola Perikanan Sidebar Show", "Umkm Product Show", "Umkm Product Add", "Umkm Product Edit", "Umkm Product Detail", "Umkm Product Delete", "Umkm Legalitas Show", "Umkm Legalitas Add", "Umkm Legalitas Edit", "Umkm Legalitas Detail", "Umkm Legalitas Delete", "Kelola Perizinan Sidebar Show", "Perizinan Show", "Perizinan Add", "Perizinan Delete"];
        $permission_koperasi = Permission::whereIn("name", $list_permission_koperasi)->get()->pluck("id")->toArray();

        foreach ($role_id_array as $key => $value) {
            if ($value == 34) { // User API
                $this->repository->setPermission($value, $permission_user_api_default);
            } else if ($value == 11) { // Super Admin
                $this->repository->setPermission($value, $permission_id_all);
            } else if ($value == 1) { // Pimpinan
                $this->repository->setPermission($value, $permission_pimpinan);
            } else if ($value == 2) { // UPT
                $this->repository->setPermission($value, $permission_upt);
            } else if ($value == 101) { // UMKM (Peternakan)
                $this->repository->setPermission($value, $permission_umkm);
            } else if ($value == 102) { // Koperasi (Perikanan)
                $this->repository->setPermission($value, $permission_koperasi);
            }
        }
        $this->command->info('Set Role Permission table seeded!');
        //
    }
}
