<?php

namespace App\Repositories;

use App\Models\Kbli;
use App\Models\MstKbli;
use App\Traits\RepositoryTrait;

class KbliRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(MstKbli $model)
    {
        $this->model            = $model;
        $this->orderByColumnsArray = ["kode" => "asc"];
    }

    public function getDropdown() {
        $result = [];
        $getAll = $this->getAll();
        foreach ($getAll as $key => $value) {
            $result[$value->id] = $value->kode.' - '.$value->uraian;
        }
        return $result;
    }
}
