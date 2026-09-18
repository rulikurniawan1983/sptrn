<?php

namespace App\Repositories;

use App\Models\UsersRole;
use App\Traits\RepositoryTrait;

class UsersRoleRepository
{
    use RepositoryTrait;
    public function __construct(UsersRole $model)
    {
        $this->model = $model;
    }

    public function setRole($userId, $role_id_array = [])
    {
        $this->model::whereNotIn('role_id', $role_id_array)->where("users_id", $userId)->delete();
        foreach ($role_id_array as $key => $value) {
            $data_insert = array(
                'users_id' => $userId,
                'role_id'  => $value,
            );
            $check_UsersRole = $this->model::where("role_id", $value)->where("users_id", $userId)->first();
            if ($check_UsersRole == null) {
                $this->create($data_insert);
            }
        }
    }
}
