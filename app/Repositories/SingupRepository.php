<?php

namespace App\Repositories;
use App\Notifications\RegisterNotification;

class SingupRepository
{
    protected $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function signUp($data)
    {
        $isUmkm = $data['jenis'] === 'UMKM';
        
        $role_id = [102]; // Default untuk Koperasi
        if ($isUmkm) {
            $kat = $data['kategori_umkm'] ?? '';
            if ($kat === 'peternakan') {
                $role_id = [101];
            } else if ($kat === 'perikanan') {
                $role_id = [102];
            } else if ($kat === 'keduanya') {
                $role_id = [101, 102];
            } else {
                $role_id = [101]; // Fallback
            }
        }
        
        $fileNib = request()->file('file_nib') ?? ($data['file_nib'] ?? null);

        $data = array_merge($data, [
            'role_id'            => $role_id,
            'name'               => $isUmkm ? $data['nama_UMKM'] : $data['nama_koperasi'],
            'nama_pemilik'       => $isUmkm ? ($data['nama_pemilik'] ?? null) : null,
            'email'              => $isUmkm ? $data['nib'] : $data['id_koperasi'],
            'password'           => $isUmkm ? $data['nik'] : $data['id_koperasi'],
            'is_verifikasi'      => 1,
            'is_active'          => $isUmkm ? 0 : 1,
            'file_nib'           => $fileNib,
        ]);
        if ($data['is_verifikasi'] == 0) {
            $data['verification_token'] = sha1(time());
        }
    
        $fieldsToUnset = ['persetujuan', 'jenis', 'password_confirmation', 'kategori_umkm', 'nik', 'nib', 'id_koperasi', 'nama_UMKM', 'nama_koperasi'];
        foreach ($fieldsToUnset as $field) {
            unset($data[$field]);
        }
        $user = $this->usersRepository->create($data);
        if ($data['is_verifikasi'] == 0) {
            $user->notify(new RegisterNotification);
            session(['verificationEmail' => $data['email']]);
        }
        return $user;
    }
    
}
