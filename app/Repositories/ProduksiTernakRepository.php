<?php

namespace App\Repositories;

use App\Models\ProduksiTernak;
use App\Traits\RepositoryTrait;

class ProduksiTernakRepository
{
    use RepositoryTrait;

    protected $model;
    protected $jenisTernakProduksiRepository;
    protected $kecamatanRepository;

    public function __construct(ProduksiTernak $model, JenisTernakProduksiRepository $jenisTernakProduksiRepository, KecamatanRepository $kecamatanRepository)
    {
        $this->model = $model;
        $this->jenisTernakProduksiRepository = $jenisTernakProduksiRepository;
        $this->kecamatanRepository = $kecamatanRepository;
        $this->with = ['jenis_ternak_produksi', 'kecamatan'];
    }

    public function customCreateEdit($data, $item = null)
    {
        // Generate tahun dari 2020 sampai tahun sekarang
        $currentYear = date('Y');
        $listTahun = [];
        for ($year = 2020; $year <= $currentYear; $year++) {
            $listTahun[$year] = $year;
        }

        $data += [
            'listJenisTernakProduksi' => $this->jenisTernakProduksiRepository->getAll()->pluck('nama', 'id')->toArray(),
            'listKecamatan' => $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray(),
            'listTahun' => $listTahun,
        ];
        return $data;
    }

    public function customDataDatatable($data)
    {
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
