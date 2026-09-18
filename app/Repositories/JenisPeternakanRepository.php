<?php

namespace App\Repositories;

use App\Models\MstJenisPeternakan;
use App\Traits\RepositoryTrait;

class JenisPeternakanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstJenisPeternakan $model)
    {
        $this->model            = $model;
    }
}
