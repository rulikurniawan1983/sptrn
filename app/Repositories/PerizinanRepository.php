<?php

namespace App\Repositories;

use App\Models\Perizinans;
use App\Traits\RepositoryTrait;

class PerizinanRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(Perizinans $model)
    {
        $this->model = $model;
    }

    public function customIndex($data)
    {
        $user = auth()->user();
        $data['perizinans'] = Perizinans::where('user_id', $user->id)->get();
        return $data;
    }
}
