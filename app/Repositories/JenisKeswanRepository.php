<?php

namespace App\Repositories;

use App\Models\MstJenisKeswan;
use App\Traits\RepositoryTrait;

class JenisKeswanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstJenisKeswan $model)
    {
        $this->model            = $model;
    }
}
