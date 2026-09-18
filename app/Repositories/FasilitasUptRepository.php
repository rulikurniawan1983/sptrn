<?php

namespace App\Repositories;

use App\Models\MstFasilitasUpt;
use App\Traits\RepositoryTrait;

class FasilitasUptRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstFasilitasUpt $model)
    {
        $this->model            = $model;
    }
}
