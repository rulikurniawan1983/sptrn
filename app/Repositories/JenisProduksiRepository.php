<?php

namespace App\Repositories;

use App\Models\JenisProduksi;
use App\Traits\RepositoryTrait;

class JenisProduksiRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(JenisProduksi $model)
    {
        $this->model = $model;
    }
}
