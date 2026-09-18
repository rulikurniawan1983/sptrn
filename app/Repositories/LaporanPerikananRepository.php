<?php

namespace App\Repositories;

use App\Models\Perikanan;
use App\Traits\RepositoryTrait;

class LaporanPerikananRepository
{
    use RepositoryTrait;

    protected $model;
    protected $kecamatanRepository;

    public function __construct(Perikanan $model, KecamatanRepository $kecamatanRepository)
    {
        $this->model               = $model;
        $this->kecamatanRepository = $kecamatanRepository;
    }

    public function customIndex($data)
    {
        $data += [
            "listKecamatan" => $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray(),
        ];
        return $data;
    }

    public function customDataDatatable($data)
    {
        $this->with = [
            "jenis_usaha",
            "jenis_perikanan",
            "kecamatan",
            "status_verifikasi",
        ];
        return $data + request()->all();
    }


    public function export($data)
    {
        $this->with = [
            "jenis_usaha",
            "jenis_perikanan",
            "kecamatan",
            "kelurahan",
            "tingkat_resiko",
            "skala_usaha",
            "pengesahan_badan_hukum",
            "status_permodalan",
            "status_verifikasi",
        ];
        $this->withCount = [];
        return $this->getAll($data);
    }
}
