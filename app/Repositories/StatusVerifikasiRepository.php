<?php

namespace App\Repositories;

use App\Models\StatusVerifikasi;
use App\Traits\RepositoryTrait;

class StatusVerifikasiRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(StatusVerifikasi $model)
    {
        $this->model            = $model;
    }
}
