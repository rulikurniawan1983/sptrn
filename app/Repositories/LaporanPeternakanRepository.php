<?php

namespace App\Repositories;

use App\Models\Peternakan;
use App\Traits\RepositoryTrait;

class LaporanPeternakanRepository
{
    use RepositoryTrait;

    protected $model;
    protected $kecamatanRepository;

    public function __construct(Peternakan $model, KecamatanRepository $kecamatanRepository)
    {
        $this->model               = $model;
        $this->kecamatanRepository = $kecamatanRepository;
    }

    public function customIndex($data)
    {
        $data += [
            "listKecamatan"         => $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray(),
        ];
        return $data;
    }

    public function customDataDatatable($data)
    {
        $this->with = [
            "jenis_usaha",
            "jenis_peternakan",
            "kecamatan",
            "tingkat_resiko",
            "skala_usaha",
            "pengesahan_badan_hukum",
            "status_permodalan",
            "status_verifikasi",
        ];
        return $data + request()->all();
    }


    public function export($data)
    {
        $this->withCount = [];
        return $this->getAll($data);
    }
}
