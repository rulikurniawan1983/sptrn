<?php

namespace App\Repositories;

use App\Models\JenisTernakProduksi;
use App\Traits\RepositoryTrait;

class JenisTernakProduksiRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(JenisTernakProduksi $model)
    {
        $this->model = $model;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data['listJenisProduksi'] = app(\App\Models\JenisProduksi::class)::pluck('nama', 'id')->toArray();
        return $data;
    }

    public function customDataDatatable($data)
    {
        $this->with = ['jenis_produksi'];
        return $data + request()->all();
    }

}
