<?php

namespace App\Repositories;

use App\Models\Country;
use App\Traits\RepositoryTrait;

class CountryRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(Country $model)
    {
        $this->model            = $model;
        $this->orderDefault     = "country_id";
        $this->orderDefaultSort = "asc";
    }
}
