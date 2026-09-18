<?php

namespace App\Repositories;

use App\Models\MstJenisUsaha;
use App\Traits\RepositoryTrait;

class JenisUsahaRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstJenisUsaha $model)
    {
        $this->model            = $model;
    }

}
