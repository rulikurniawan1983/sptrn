<?php

namespace App\Repositories;

use App\Models\MstStatusPermodalan;
use App\Traits\RepositoryTrait;

class StatusPermodalanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstStatusPermodalan $model)
    {
        $this->model            = $model;
    }
}
