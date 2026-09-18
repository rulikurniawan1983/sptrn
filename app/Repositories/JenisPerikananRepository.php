<?php

namespace App\Repositories;

use App\Models\MstJenisPerikanan;
use App\Traits\RepositoryTrait;

class JenisPerikananRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstJenisPerikanan $model)
    {
        $this->model            = $model;
    }
}
