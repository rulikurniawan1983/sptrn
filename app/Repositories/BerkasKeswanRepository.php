<?php

namespace App\Repositories;

use App\Models\BerkasKeswan;
use App\Models\MstBerkasKeswan;
use App\Traits\RepositoryTrait;

class BerkasKeswanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstBerkasKeswan $model)
    {
        $this->model            = $model;
    }
}
