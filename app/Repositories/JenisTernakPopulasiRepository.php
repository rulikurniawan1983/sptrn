<?php

namespace App\Repositories;

use App\Models\JenisTernakPopulasi;
use App\Traits\RepositoryTrait;

class JenisTernakPopulasiRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(JenisTernakPopulasi $model)
    {
        $this->model = $model;
    }
}
