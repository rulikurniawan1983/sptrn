<?php

namespace App\Repositories;

use App\Models\UsersKecamatan;
use App\Traits\RepositoryTrait;

class UsersKecamatanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(UsersKecamatan $model)
    {
        $this->model            = $model;
    }
}
