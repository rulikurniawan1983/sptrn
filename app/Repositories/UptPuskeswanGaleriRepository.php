<?php

namespace App\Repositories;

use App\Models\Galeri;
use App\Models\UptPuskeswanGaleri;
use App\Traits\RepositoryTrait;

class UptPuskeswanGaleriRepository
{
    use RepositoryTrait;

    protected $model;
    protected $uptPuskeswanRepository;
    protected $jenisGaleriRepository;

    public function __construct(Galeri $model, UptPuskeswanRepository $uptPuskeswanRepository, JenisGaleriRepository $jenisGaleriRepository)
    {
        $this->model                  = $model;
        $this->uptPuskeswanRepository = $uptPuskeswanRepository;
        $this->jenisGaleriRepository  = $jenisGaleriRepository;
    }

    public function customIndex($data)
    {
		$request_get = [
            'per_page' => request()->input('per_page') ?? 12,
            'q'        => request()->input('q'),
            'model_id' => request()->input('id_upt_puskeswan'),
        ];
        $data += [
            "getParent" => $this->uptPuskeswanRepository->getById(request()->input("id_upt_puskeswan")),
            "data" => $this->getAll($request_get+["model_type" => $this->uptPuskeswanRepository->getInstanceModel()::class], true),
            "request_get" => $request_get,
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "getParent"       => $this->uptPuskeswanRepository->getById(($item) ? $item->model_id: request()->input("id_upt_puskeswan")),
            "listJenisGaleri" => $this->jenisGaleriRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        $getParent = $this->uptPuskeswanRepository->getById($data['id_upt_puskeswan']);
        $data['model_id']   = $getParent->id;
        $data['model_type'] = $getParent::class;
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        if (@$data['file']) {
            $model->addMedia($data['file'])->usingName($data['nama'])->toMediaCollection('images');
        }
        return redirect()->route('upt-puskeswan-galeri.index', ['id_upt_puskeswan' => $model->model_id])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('upt-puskeswan-galeri.index', ['id_upt_puskeswan' => $model->model_id])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('upt-puskeswan-galeri.index', ['id_upt_puskeswan' => $model->model_id])->with('success', trans('message.success_delete'));
    }

    public function customCreateMultipleData($data)
    {
        $data += [
            "listJenisGaleri" => $this->jenisGaleriRepository->getAll([])->pluck("nama", "id")->toArray(),
            "getParent"       => $this->uptPuskeswanRepository->getById(request()->input("id_upt_puskeswan")),
        ];
        return $data;
    }
}
