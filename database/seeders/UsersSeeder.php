<?php

namespace Database\Seeders;

use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listData = [
            [
                'id' => 27,
                'name' => 'Imran',
                'nama_pemilik' => 'Imran Admin',
                'email' => 'superadmin@diskanak.go.id',
                'email_verified_at' => NULL,
                'tanggal_lahir' => NULL,
                'no_hp' => '08512312311',
                'password' => "Diskanak@123",
                'is_active' => 1,
                'remember_token' => NULL,
                'verification_token' => NULL,
                'reset_password_token' => NULL,
                'deskripsi' => 'Super Admin SPARTAN Kabupaten Bogor.',
                'is_verifikasi' => 1,
                'role_id' => [11],
                'profile_photo' => 'assets/img/elements/1.jpg',
            ],
            [
                'name' => 'Handoko',
                'nama_pemilik' => 'Handoko Admin',
                'email' => 'handoko@gmail.com',
                'email_verified_at' => NULL,
                'tanggal_lahir' => NULL,
                'no_hp' => '0814123123',
                'password' => "Sewdaq123",
                'is_active' => 1,
                'remember_token' => NULL,
                'verification_token' => NULL,
                'reset_password_token' => NULL,
                'deskripsi' => 'Super Admin SPARTAN Kabupaten Bogor.',
                'is_verifikasi' => 1,
                'role_id' => [1],
                'profile_photo' => 'assets/img/elements/2.jpg',
            ],
            [
                'name' => 'Fajar',
                'nama_pemilik' => 'Fajar Muhamad',
                'email' => 'fajarmuhamad997@gmail.com',
                'email_verified_at' => NULL,
                'tanggal_lahir' => NULL,
                'no_hp' => '0852812930123',
                'password' => 'Sewdaq123',
                'is_active' => 1,
                'remember_token' => NULL,
                'verification_token' => NULL,
                'reset_password_token' => NULL,
                'deskripsi' => 'User SPARTAN Kabupaten Bogor.',
                'is_verifikasi' => 1,
                'role_id' => [100],
                'profile_photo' => 'assets/img/elements/3.jpg',
            ],
            [
                'id' => 23396,
                'name' => 'Front Page',
                'nama_pemilik' => 'Front Page Admin',
                'email' => 'frontpage@gmail.com',
                'email_verified_at' => NULL,
                'tanggal_lahir' => NULL,
                'no_hp' => '085123123',
                'password' => 'Frontpage123',
                'is_active' => 1,
                'remember_token' => NULL,
                'verification_token' => NULL,
                'reset_password_token' => NULL,
                'deskripsi' => 'Front Page SPARTAN Kabupaten Bogor.',
                'is_verifikasi' => 1,
                'role_id' => [34],
                'profile_photo' => 'assets/img/elements/4.jpg',
            ],
        ];

        $isSqlite = DB::getDriverName() === 'sqlite';
        $kecamatanExists = !$isSqlite || \App\Models\MstKecamatan::count() > 0;

        if (!$isSqlite) {
            $idKecamatanStart = 1;
            for ($i = 1; $i <= 10; $i++) {
                $listData[] = [
                    'name' => 'User UPT ' . $i,
                    'email' => 'upt' . $i . '@gmail.com',
                    'email_verified_at' => null,
                    'tanggal_lahir' => null,
                    'no_hp' => '-',
                    'password' => '123123',
                    'is_active' => 1,
                    'remember_token' => null,
                    'verification_token' => null,
                    'reset_password_token' => null,
                    'deskripsi' => null,
                    'is_verifikasi' => 1,
                    'role_id' => [2],
                    'id_kecamatan' => $kecamatanExists ? range($idKecamatanStart, $idKecamatanStart + 3) : []
                ];
                $idKecamatanStart += 4;
            }
        }

        foreach ($listData as $data) {
            $existingUser = User::where('email', $data['email'])->first();
            if ($existingUser) {
                $record = $this->repository->update($existingUser->id, $data);
            } else {
                $record = $this->repository->create($data);
            }

            if ($record && !empty($data['profile_photo'])) {
                $sourcePath = public_path($data['profile_photo']);
                if (file_exists($sourcePath)) {
                    $record->addMedia($sourcePath)->usingName($record->name)->toMediaCollection('images');
                }
            }
        }

        $this->command->info('Users table seeded/updated!');
    }
}
