<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
        $listData = [
            [
                'id' => 1,
                'name' => 'Pimpinan',
                'bg' => 'bg-info',
                'init_page_login' => 'dashboard',
                'is_allow_login' => 1,
                'is_vertical_menu' => true,
            ],[
                'id' => 2,
                'name' => 'UPT',
                'bg' => 'bg-warning',
                'init_page_login' => 'dashboard',
                'is_allow_login' => 1,
                'is_vertical_menu' => true,
            ], [
                'id' => 11,
                'name' => 'Super Admin',
                'bg' => 'bg-danger',
                'init_page_login' => 'dashboard',
                'is_allow_login' => 1,
                'is_vertical_menu' => true,
            ], [
                'id' => 34,
                'name' => 'User API',
                'bg' => 'bg-secondary',
                'init_page_login' => 'dashboard',
                'is_allow_login' => 1,
                'is_vertical_menu' => true,
            ], [
                'id' => 100,
                'name' => 'User',
                'bg' => 'bg-dark',
                'init_page_login' => 'dashboard',
                'is_allow_login' => 1,
                'is_vertical_menu' => true,
            ], [
                'id' => 101,
                'name' => 'Peternakan',
                'bg' => 'bg-primary',
                'init_page_login' => 'dashboard',
                'is_allow_login' => 1,
                'is_vertical_menu' => true,
            ], [
                'id' => 102,
                'name' => 'Perikanan',
                'bg' => 'bg-success',
                'init_page_login' => 'dashboard',
                'is_allow_login' => 1,
                'is_vertical_menu' => true,
            ],
        ];
        foreach ($listData as $data) {
            $this->repository->create($data);
        }
        $this->command->info('Role table seeded!');
    }
}
