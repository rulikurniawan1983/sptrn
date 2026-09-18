<?php

namespace App\Repositories;

use App\Models\MstBerkasPeternakan;
use App\Traits\RepositoryTrait;

class BerkasPeternakanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstBerkasPeternakan $model)
    {
        $this->model            = $model;
    }
}
