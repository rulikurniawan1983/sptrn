<?php

namespace App\Repositories;

use App\Models\MstBerkasPerikanan;
use App\Traits\RepositoryTrait;

class BerkasPerikananRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstBerkasPerikanan $model)
    {
        $this->model            = $model;
    }
}
