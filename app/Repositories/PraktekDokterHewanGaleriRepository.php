<?php

namespace App\Repositories;

use App\Models\Galeri;
use App\Traits\RepositoryTrait;

class PraktekDokterHewanGaleriRepository
{
    use RepositoryTrait;

    protected $model;
    protected $praktekDokterHewanRepository;
    protected $jenisGaleriRepository;

    public function __construct(Galeri $model, PraktekDokterHewanRepository $praktekDokterHewanRepository, JenisGaleriRepository $jenisGaleriRepository)
    {
        $this->model                        = $model;
        $this->praktekDokterHewanRepository = $praktekDokterHewanRepository;
        $this->jenisGaleriRepository        = $jenisGaleriRepository;
    }

    public function customIndex($data)
    {
		$request_get = [
            'per_page' => request()->input('per_page') ?? 12,
            'q'        => request()->input('q'),
            'model_id' => request()->input('id_praktek_dokter_hewan'),
        ];
        $data += [
            "getParent" => $this->praktekDokterHewanRepository->getById(request()->input("id_praktek_dokter_hewan")),
            "data" => $this->getAll($request_get+["model_type" => $this->praktekDokterHewanRepository->getInstanceModel()::class], true),
            "request_get" => $request_get,
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "getParent"       => $this->praktekDokterHewanRepository->getById(($item) ? $item->model_id: request()->input("id_praktek_dokter_hewan")),
            "listJenisGaleri" => $this->jenisGaleriRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        $getParent = $this->praktekDokterHewanRepository->getById($data['id_praktek_dokter_hewan']);
        $data['model_id']   = $getParent->id;
        $data['model_type'] = $getParent::class;
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        if (@$data['file']) {
            $model->addMedia($data['file'])->usingName($data['nama'])->toMediaCollection('images');
        }
        return redirect()->route('praktek-dokter-hewan-galeri.index', ['id_praktek_dokter_hewan' => $model->model_id])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('praktek-dokter-hewan-galeri.index', ['id_praktek_dokter_hewan' => $model->model_id])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('praktek-dokter-hewan-galeri.index', ['id_praktek_dokter_hewan' => $model->model_id])->with('success', trans('message.success_delete'));
    }

    public function customCreateMultipleData($data)
    {
        $data += [
            "listJenisGaleri" => $this->jenisGaleriRepository->getAll([])->pluck("nama", "id")->toArray(),
            "getParent"       => $this->praktekDokterHewanRepository->getById(request()->input("id_praktek_dokter_hewan")),
        ];
        return $data;
    }
}
