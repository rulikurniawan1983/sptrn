<?php

namespace App\Repositories;

use App\Models\RoleKecamatan;
use App\Traits\RepositoryTrait;

class RoleKecamatanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(RoleKecamatan $model)
    {
        $this->model            = $model;
    }
}
