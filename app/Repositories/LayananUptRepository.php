<?php

namespace App\Repositories;

use App\Models\MstLayananUpt;
use App\Traits\RepositoryTrait;

class LayananUptRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstLayananUpt $model)
    {
        $this->model            = $model;
    }
}
