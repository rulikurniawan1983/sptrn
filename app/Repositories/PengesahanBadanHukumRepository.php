<?php

namespace App\Repositories;

use App\Models\MstPengesahanBadanHukum;
use App\Traits\RepositoryTrait;

class PengesahanBadanHukumRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstPengesahanBadanHukum $model)
    {
        $this->model            = $model;
    }
}
