<?php

namespace App\Repositories;

use App\Models\PopulasiTernak;
use App\Traits\RepositoryTrait;
use App\Repositories\JenisTernakPopulasiRepository;
use App\Repositories\KecamatanRepository;

class PopulasiTernakRepository
{
    use RepositoryTrait;

    protected $model;
    protected $jenisTernakPopulasiRepository;
    protected $kecamatanRepository;

    public function __construct(PopulasiTernak $model, JenisTernakPopulasiRepository $jenisTernakPopulasiRepository, KecamatanRepository $kecamatanRepository)
    {
        $this->model = $model;
        $this->jenisTernakPopulasiRepository = $jenisTernakPopulasiRepository;
        $this->kecamatanRepository = $kecamatanRepository;
        $this->with = ['jenis_ternak_populasi'];
    }

    public function customCreateEdit($data, $item = null)
    {
        $currentYear = date('Y');
        $listTahun = [];
        for ($year = 2020; $year <= $currentYear; $year++) {
            $listTahun[$year] = $year;
        }
        $data += [
            'listJenisTernakPopulasi' => $this->jenisTernakPopulasiRepository->getAll()->pluck('nama', 'id')->toArray(),
            'listKecamatan' => $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray(),
            'listTahun' => $listTahun,
        ];
        return $data;
    }

    public function customTable($table, $data, $request)
    {
        return $table->editColumn('jumlah', function ($d) {
            return number_format($d->jumlah, 0, ',', '.');
        })
        ->addColumn('kecamatan', function ($d) {
            return $d->kecamatan->nama ?? '-';
        });
    }
}
