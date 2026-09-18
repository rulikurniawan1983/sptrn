<?php

namespace App\Repositories;

use App\Models\JenisPenyakit;
use App\Models\MstJenisPenyakit;
use App\Traits\RepositoryTrait;

class JenisPenyakitRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstJenisPenyakit $model)
    {
        $this->model            = $model;
    }
}
