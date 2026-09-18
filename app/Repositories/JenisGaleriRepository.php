<?php

namespace App\Repositories;

use App\Models\MstJenisGaleri;
use App\Traits\RepositoryTrait;

class JenisGaleriRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstJenisGaleri $model)
    {
        $this->model            = $model;
    }
}
