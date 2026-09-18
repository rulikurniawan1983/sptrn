<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;use Illuminate\Support\Facades\DB;
use Exception;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        $this->call(KecamatanKelurahanSeeder::class);
        try {
			DB::beginTransaction();
            $this->call(CategoryIdentitySeeder::class);
            $this->call(IdentitySeeder::class);

            // $this->call(DesaSeeder::class);

            $this->call(CategoryPermissionSeeder::class);
            // $this->call(PermissionSeeder::class);
            $this->call(UsersMenuSeeder::class);
            $this->call(RoleSeeder::class);
            $this->call(UsersSeeder::class);
            $this->call(SetRolePermissionSeeder::class);

            $this->call(MedsosSeeder::class);

            $this->call(JenisPeternakanSeeder::class);
            $this->call(BerkasPeternakanSeeder::class);
            
            $this->call(JenisPerikananSeeder::class);
            $this->call(BerkasPerikananSeeder::class);

            $this->call(JenisKeswanSeeder::class);
            $this->call(BerkasKeswanSeeder::class);
            $this->call(FasilitasUptSeeder::class);
            $this->call(LayananUptSeeder::class);
            
            $this->call(JenisUsahaSeeder::class);
            $this->call(TingkatResikoSeeder::class);
            $this->call(SkalaUsahaSeeder::class);
            $this->call(StatusVerifikasiSeeder::class);
            $this->call(StatusPermodalanSeeder::class);
            $this->call(PengesahanBadanHukumSeeder::class);
            $this->call(JenisGaleriSeeder::class);

            $this->call(UmkmDummySeeder::class);
            $this->call(TernakDataSeeder::class);

            DB::commit();
		} catch (Exception $e) {
			DB::rollback();
            throw $e;
		}   
        $this->call(ImportSqlSeeder::class);

    }
}
