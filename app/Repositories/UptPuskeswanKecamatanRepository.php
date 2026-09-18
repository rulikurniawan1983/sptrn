<?php

namespace App\Repositories;

use App\Models\UptPuskeswanKecamatan;
use App\Traits\RepositoryTrait;

class UptPuskeswanKecamatanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(UptPuskeswanKecamatan $model)
    {
        $this->model            = $model;
    }
}
