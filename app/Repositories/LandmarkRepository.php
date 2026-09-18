<?php

namespace App\Repositories;

use App\Models\Landmark;
use App\Traits\RepositoryTrait;

class LandmarkRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(Landmark $model, \App\Repositories\HomeRepository $homeRepository)
    {
        $this->model = $model;
        $this->homeRepository = $homeRepository;
    }

    public function customIndex($data)
    {
        $data['all_landmarks'] = $this->model->all();
        $data['getRuang'] = collect($this->homeRepository->getRuang())->map(function($item) {
            return (object)$item;
        })->toArray();
        return $data;
    }
}
