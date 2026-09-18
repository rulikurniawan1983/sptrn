<?php

namespace App\Repositories;

use App\Models\StatusPenyakitHewan;
use App\Traits\RepositoryTrait;

class StatusPenyakitHewanRepository
{
    use RepositoryTrait;

    protected $model;
    protected $statusPenyakitRepository;

    public function __construct(StatusPenyakitHewan $model, StatusPenyakitRepository $statusPenyakitRepository)
    {
        $this->model                    = $model;
        $this->statusPenyakitRepository =  $statusPenyakitRepository;
    }
    
    public function customIndex($data)
    {
        $data += [
            "getParent" => $this->statusPenyakitRepository->getById(request()->input("id_status_penyakit")),
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "getParent"  => $this->statusPenyakitRepository->getById(($item) ? $item->id_status_penyakit: request()->input("id_status_penyakit")),
        ];
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        return redirect()->route('status-penyakit-hewan.index', ['id_status_penyakit' => $model->id_status_penyakit])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('status-penyakit-hewan.index', ['id_status_penyakit' => $model->id_status_penyakit])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('status-penyakit-hewan.index', ['id_status_penyakit' => $model->id_status_penyakit])->with('success', trans('message.success_delete'));
    }

    public function customDataDatatable($data)
    {
        return $data + request()->all();
    }
}
