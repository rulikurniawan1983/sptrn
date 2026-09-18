<?php

namespace App\Repositories;

use App\Models\UmkmPengolahanPerikanan;
use App\Traits\RepositoryTrait;

class UmkmPengolahanPerikananRepository
{
    use RepositoryTrait;

    protected $model;
    protected $kecamatanRepository;
    protected $desaRepository;

    public function __construct(UmkmPengolahanPerikanan $model, KecamatanRepository $kecamatanRepository, DesaRepository $desaRepository)
    {
        $this->model = $model;
        $this->kecamatanRepository = $kecamatanRepository;
        $this->desaRepository = $desaRepository;
        $this->with = ['kecamatan', 'desa'];
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            'listKecamatan' => $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray(),
            'listDesa' => $this->desaRepository->getAll()->pluck('nama', 'id')->toArray(),
        ];
        return $data;
    }

    public function customTable($table, $data, $request)
    {
        return $table
            ->addColumn('kecamatan', function ($d) {
                return $d->kecamatan->nama ?? '-';
            })
            ->addColumn('desa', function ($d) {
                return $d->desa->nama ?? '-';
            });
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        if (@$data['file']) {
            $model->addMedia($data['file'])->toMediaCollection('foto_produk');
        }
        return redirect()->route('umkm-pengolahan-perikanan.index')->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }
} 