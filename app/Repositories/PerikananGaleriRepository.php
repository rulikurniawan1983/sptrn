<?php

namespace App\Repositories;

use App\Models\Galeri;
use App\Traits\RepositoryTrait;

class PerikananGaleriRepository
{
    use RepositoryTrait;

    protected $model;
    protected $perikananGaleri;
    protected $jenisGaleriRepository;

    public function __construct(Galeri $model, PerikananRepository $perikananGaleri, JenisGaleriRepository $jenisGaleriRepository)
    {
        $this->model                 = $model;
        $this->perikananGaleri       = $perikananGaleri;
        $this->jenisGaleriRepository = $jenisGaleriRepository;
    }

    public function customIndex($data)
    {
		$request_get = [
            'per_page' => request()->input('per_page') ?? 12,
            'q'        => request()->input('q'),
            'model_id' => request()->input('id_perikanan'),
        ];
        $data += [
            "getParent" => $this->perikananGaleri->getById(request()->input("id_perikanan")),
            "data" => $this->getAll($request_get+["model_type" => $this->perikananGaleri->getInstanceModel()::class], true),
            "request_get" => $request_get,
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "getParent"       => $this->perikananGaleri->getById(($item) ? $item->model_id: request()->input("id_perikanan")),
            "listJenisGaleri" => $this->jenisGaleriRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        $getParent = $this->perikananGaleri->getById($data['id_perikanan']);
        $data['model_id']   = $getParent->id;
        $data['model_type'] = $getParent::class;
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        if (@$data['file']) {
            $model->addMedia($data['file'])->usingName($data['nama'])->toMediaCollection('images');
        }
        return redirect()->route('perikanan-galeri.index', ['id_perikanan' => $model->model_id])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('perikanan-galeri.index', ['id_perikanan' => $model->model_id])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('perikanan-galeri.index', ['id_perikanan' => $model->model_id])->with('success', trans('message.success_delete'));
    }

    public function customCreateMultipleData($data)
    {
        $data += [
            "listJenisGaleri" => $this->jenisGaleriRepository->getAll([])->pluck("nama", "id")->toArray(),
            "getParent"       => $this->perikananGaleri->getById(request()->input("id_perikanan")),
        ];
        return $data;
    }
}
