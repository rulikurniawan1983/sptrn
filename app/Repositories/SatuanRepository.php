<?php

namespace App\Repositories;

use App\Models\MstSatuan;
use App\Models\Satuan;
use App\Traits\RepositoryTrait;

class SatuanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstSatuan $model)
    {
        $this->model            = $model;
    }
}
