<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //
            [
                'id' => 130,
                'name' => 'Kecamatan Show',
                'category_permission_id' => 34
            ],
            [
                'id' => 131,
                'name' => 'Kecamatan Add',
                'category_permission_id' => 34
            ],
            [
                'id' => 132,
                'name' => 'Kecamatan Detail',
                'category_permission_id' => 34
            ],
            [
                'id' => 133,
                'name' => 'Kecamatan Edit',
                'category_permission_id' => 34
            ],
            [
                'id' => 134,
                'name' => 'Kecamatan Delete',
                'category_permission_id' => 34
            ],
            //
            [
                'id' => 135,
                'name' => 'Desa Show',
                'category_permission_id' => 35
            ],
            [
                'id' => 136,
                'name' => 'Desa Add',
                'category_permission_id' => 35
            ],
            [
                'id' => 137,
                'name' => 'Desa Detail',
                'category_permission_id' => 35
            ],
            [
                'id' => 138,
                'name' => 'Desa Edit',
                'category_permission_id' => 35
            ],
            [
                'id' => 139,
                'name' => 'Desa Delete',
                'category_permission_id' => 35
            ],
            //
            [
                'id' => 140,
                'name' => 'UMKM Show',
                'category_permission_id' => 36
            ],
            [
                'id' => 141,
                'name' => 'UMKM Add',
                'category_permission_id' => 36
            ],
            [
                'id' => 142,
                'name' => 'UMKM Detail',
                'category_permission_id' => 36
            ],
            [
                'id' => 143,
                'name' => 'UMKM Edit',
                'category_permission_id' => 36
            ],
            [
                'id' => 144,
                'name' => 'UMKM Delete',
                'category_permission_id' => 36
            ],
            //
            [
                'id' => 145,
                'name' => 'Master UMKM',
                'category_permission_id' => 37
            ],
            //
            [
                'id' => 146,
                'name' => 'Bentuk Usaha Show',
                'category_permission_id' => 38
            ],
            [
                'id' => 147,
                'name' => 'Bentuk Usaha Add',
                'category_permission_id' => 38
            ],
            [
                'id' => 148,
                'name' => 'Bentuk Usaha Detail',
                'category_permission_id' => 38
            ],
            [
                'id' => 149,
                'name' => 'Bentuk Usaha Edit',
                'category_permission_id' => 38
            ],
            [
                'id' => 150,
                'name' => 'Bentuk Usaha Delete',
                'category_permission_id' => 38
            ],
            //
            [
                'id' => 151,
                'name' => 'Lembaga Pembina Show',
                'category_permission_id' => 39
            ],
            [
                'id' => 152,
                'name' => 'Lembaga Pembina Add',
                'category_permission_id' => 39
            ],
            [
                'id' => 153,
                'name' => 'Lembaga Pembina Detail',
                'category_permission_id' => 39
            ],
            [
                'id' => 154,
                'name' => 'Lembaga Pembina Edit',
                'category_permission_id' => 39
            ],
            [
                'id' => 155,
                'name' => 'Lembaga Pembina Delete',
                'category_permission_id' => 39
            ],
            //
            [
                'id' => 156,
                'name' => 'Pendidikan Show',
                'category_permission_id' => 40
            ],
            [
                'id' => 157,
                'name' => 'Pendidikan Add',
                'category_permission_id' => 40
            ],
            [
                'id' => 158,
                'name' => 'Pendidikan Detail',
                'category_permission_id' => 40
            ],
            [
                'id' => 159,
                'name' => 'Pendidikan Edit',
                'category_permission_id' => 40
            ],
            [
                'id' => 160,
                'name' => 'Pendidikan Delete',
                'category_permission_id' => 40
            ],
            //
            [
                'id' => 161,
                'name' => 'Perizinan Show',
                'category_permission_id' => 41
            ],
            [
                'id' => 162,
                'name' => 'Perizinan Add',
                'category_permission_id' => 41
            ],
            [
                'id' => 163,
                'name' => 'Perizinan Detail',
                'category_permission_id' => 41
            ],
            [
                'id' => 164,
                'name' => 'Perizinan Edit',
                'category_permission_id' => 41
            ],
            [
                'id' => 165,
                'name' => 'Perizinan Delete',
                'category_permission_id' => 41
            ],
            [
                'id' => 223,
                'name' => 'Kelola Perizinan Sidebar Show',
                'category_permission_id' => 41
            ],
            //
            [
                'id' => 167,
                'name' => 'Perkembangan Usaha Show',
                'category_permission_id' => 42
            ],
            [
                'id' => 168,
                'name' => 'Perkembangan Usaha Add',
                'category_permission_id' => 42
            ],
            [
                'id' => 169,
                'name' => 'Perkembangan Usaha Detail',
                'category_permission_id' => 42
            ],
            [
                'id' => 170,
                'name' => 'Perkembangan Usaha Edit',
                'category_permission_id' => 42
            ],
            [
                'id' => 171,
                'name' => 'Perkembangan Usaha Delete',
                'category_permission_id' => 42
            ],
            //
            [
                'id' => 172,
                'name' => 'Status Tempat Usaha Show',
                'category_permission_id' => 43
            ],
            [
                'id' => 172,
                'name' => 'Status Tempat Usaha Add',
                'category_permission_id' => 43
            ],
            [
                'id' => 173,
                'name' => 'Status Tempat Usaha Detail',
                'category_permission_id' => 43
            ],
            [
                'id' => 174,
                'name' => 'Status Tempat Usaha Edit',
                'category_permission_id' => 43
            ],
            [
                'id' => 175,
                'name' => 'Status Tempat Usaha Delete',
                'category_permission_id' => 43
            ],
            //
            [
                'id' => 176,
                'name' => 'Tipe Usaha Show',
                'category_permission_id' => 44
            ],
            [
                'id' => 177,
                'name' => 'Tipe Usaha Add',
                'category_permission_id' => 44
            ],
            [
                'id' => 178,
                'name' => 'Tipe Usaha Detail',
                'category_permission_id' => 44
            ],
            [
                'id' => 179,
                'name' => 'Tipe Usaha Edit',
                'category_permission_id' => 44
            ],
            [
                'id' => 180,
                'name' => 'Tipe Usaha Delete',
                'category_permission_id' => 44
            ],
            //
            [
                'id' => 181,
                'name' => 'Koperasi Show',
                'category_permission_id' => 45
            ],
            [
                'id' => 182,
                'name' => 'Koperasi Add',
                'category_permission_id' => 45
            ],
            [
                'id' => 183,
                'name' => 'Koperasi Detail',
                'category_permission_id' => 45
            ],
            [
                'id' => 184,
                'name' => 'Koperasi Edit',
                'category_permission_id' => 45
            ],
            [
                'id' => 185,
                'name' => 'Koperasi Delete',
                'category_permission_id' => 45
            ],
            //
            [
                'id' => 186,
                'name' => 'Master Koperasi Show',
                'category_permission_id' => 46
            ],
            //
            [
                'id' => 187,
                'name' => 'Bentuk Koperasi Show',
                'category_permission_id' => 45
            ],
            [
                'id' => 188,
                'name' => 'Bentuk Koperasi Add',
                'category_permission_id' => 45
            ],
            [
                'id' => 189,
                'name' => 'Bentuk Koperasi Detail',
                'category_permission_id' => 45
            ],
            [
                'id' => 190,
                'name' => 'Bentuk Koperasi Edit',
                'category_permission_id' => 45
            ],
            [
                'id' => 191,
                'name' => 'Bentuk Koperasi Delete',
                'category_permission_id' => 45
            ],
            //
            [
                'id' => 192,
                'name' => 'Jenis Koperasi Show',
                'category_permission_id' => 45
            ],
            [
                'id' => 193,
                'name' => 'Jenis Koperasi Add',
                'category_permission_id' => 45
            ],
            [
                'id' => 194,
                'name' => 'Jenis Koperasi Detail',
                'category_permission_id' => 45
            ],
            [
                'id' => 195,
                'name' => 'Jenis Koperasi Edit',
                'category_permission_id' => 45
            ],
            [
                'id' => 196,
                'name' => 'Jenis Koperasi Delete',
                'category_permission_id' => 45
            ],
            //
            [
                'id' => 197,
                'name' => 'Kelompok Koperasi Show',
                'category_permission_id' => 46
            ],
            [
                'id' => 198,
                'name' => 'Kelompok Koperasi Add',
                'category_permission_id' => 46
            ],
            [
                'id' => 199,
                'name' => 'Kelompok Koperasi Detail',
                'category_permission_id' => 46
            ],
            [
                'id' => 200,
                'name' => 'Kelompok Koperasi Edit',
                'category_permission_id' => 46
            ],
            [
                'id' => 201,
                'name' => 'Kelompok Koperasi Delete',
                'category_permission_id' => 46
            ],
            //
            [
                'id' => 202,
                'name' => 'Sektor Usaha Show',
                'category_permission_id' => 46
            ],
            [
                'id' => 203,
                'name' => 'Sektor Usaha Add',
                'category_permission_id' => 46
            ],
            [
                'id' => 204,
                'name' => 'Sektor Usaha Detail',
                'category_permission_id' => 46
            ],
            [
                'id' => 206,
                'name' => 'Sektor Usaha Edit',
                'category_permission_id' => 46
            ],
            [
                'id' => 207,
                'name' => 'Sektor Usaha Delete',
                'category_permission_id' => 46
            ],
            //
            [
                'id' => 208,
                'name' => 'Unit Usaha Show',
                'category_permission_id' => 47
            ],
            [
                'id' => 209,
                'name' => 'Unit Usaha Add',
                'category_permission_id' => 47
            ],
            [
                'id' => 210,
                'name' => 'Unit Usaha Detail',
                'category_permission_id' => 47
            ],
            [
                'id' => 211,
                'name' => 'Unit Usaha Edit',
                'category_permission_id' => 47
            ],
            [
                'id' => 212,
                'name' => 'Unit Usaha Delete',
                'category_permission_id' => 47
            ],
            //
            [
                'id' => 213,
                'name' => 'Klasifikasi Koperasi Show',
                'category_permission_id' => 48
            ],
            [
                'id' => 214,
                'name' => 'Klasifikasi Koperasi Add',
                'category_permission_id' => 48
            ],
            [
                'id' => 215,
                'name' => 'Klasifikasi Koperasi Detail',
                'category_permission_id' => 48
            ],
            [
                'id' => 216,
                'name' => 'Klasifikasi Koperasi Edit',
                'category_permission_id' => 48
            ],
            [
                'id' => 217,
                'name' => 'Klasifikasi Koperasi Delete',
                'category_permission_id' => 48
            ],
            //
            [
                'id' => 218,
                'name' => 'Kesehatan Koperasi Show',
                'category_permission_id' => 48
            ],
            [
                'id' => 219,
                'name' => 'Kesehatan Koperasi Add',
                'category_permission_id' => 48
            ],
            [
                'id' => 220,
                'name' => 'Kesehatan Koperasi Detail',
                'category_permission_id' => 48
            ],
            [
                'id' => 221,
                'name' => 'Kesehatan Koperasi Edit',
                'category_permission_id' => 48
            ],
            [
                'id' => 222,
                'name' => 'Kesehatan Koperasi Delete',
                'category_permission_id' => 48
            ],
            //
        ];
        foreach ($permissions as $permissionData) {
            $existingPermission = Permission::where('name', $permissionData['name'])->first();

            if (!$existingPermission) {
                $createData = $permissionData;
                unset($createData['id']);
                Permission::create($createData);
            }
        }
        $this->command->info('Permission Seeder table seeded!');
    }
}
