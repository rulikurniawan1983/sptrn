<?php

namespace App\Repositories;

use App\Models\MstSkalaUsaha;
use App\Traits\RepositoryTrait;

class SkalaUsahaRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstSkalaUsaha $model)
    {
        $this->model            = $model;
    }
}
