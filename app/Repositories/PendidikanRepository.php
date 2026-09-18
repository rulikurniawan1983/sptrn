<?php

namespace App\Repositories;

use App\Models\MstPendidikan;
use App\Traits\RepositoryTrait;

class PendidikanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstPendidikan $model)
    {
        $this->model            = $model;
    }
}
