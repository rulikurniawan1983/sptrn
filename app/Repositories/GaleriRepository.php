<?php

namespace App\Repositories;

use App\Models\Galeri;
use App\Traits\RepositoryTrait;

class GaleriRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(Galeri $model)
    {
        $this->model            = $model;
    }
}
