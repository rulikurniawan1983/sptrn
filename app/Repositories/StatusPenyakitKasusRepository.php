<?php

namespace App\Repositories;

use App\Models\StatusPenyakitKasus;
use App\Traits\RepositoryTrait;

class StatusPenyakitKasusRepository
{
    use RepositoryTrait;

    protected $model;
    protected $statusPenyakitRepository;
    protected $statusPenyakitHewanRepository;

    public function __construct(StatusPenyakitKasus $model, StatusPenyakitRepository $statusPenyakitRepository, StatusPenyakitHewanRepository $statusPenyakitHewanRepository)
    {
        $this->model                         = $model;
        $this->statusPenyakitRepository      = $statusPenyakitRepository;
        $this->statusPenyakitHewanRepository = $statusPenyakitHewanRepository;
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
        $getParent = $this->statusPenyakitRepository->getById(($item) ? $item->id_status_penyakit: request()->input("id_status_penyakit"));


        $listTahun = [];
        $currentYear = date('Y');
        for ($i = 0; $i < 10; $i++) {
            $listTahun[$currentYear - $i] = $currentYear - $i;
        }

        $data += [
            "getParent"  => $getParent,
            "listStatusPenyakitHewan" => $this->statusPenyakitHewanRepository->getAll(["id_status_penyakit" => $getParent->id])->pluck("nama_hewan", "id")->toArray(),
            "listTahun" => $listTahun,
        ];
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        return redirect()->route('status-penyakit-kasus.index', ['id_status_penyakit' => $model->id_status_penyakit])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('status-penyakit-kasus.index', ['id_status_penyakit' => $model->id_status_penyakit])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('status-penyakit-kasus.index', ['id_status_penyakit' => $model->id_status_penyakit])->with('success', trans('message.success_delete'));
    }

    public function customDataDatatable($data)
    {
        $this->with = [
            "status_penyakit_hewan",
        ];
        return $data + request()->all();
    }
}
