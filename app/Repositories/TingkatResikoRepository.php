<?php

namespace App\Repositories;

use App\Models\MstTingkatResiko;
use App\Models\TingkatResiko;
use App\Traits\RepositoryTrait;

class TingkatResikoRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstTingkatResiko $model)
    {
        $this->model            = $model;
    }
}
