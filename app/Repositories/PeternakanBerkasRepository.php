<?php

namespace App\Repositories;

use App\Models\PeternakanBerkas;
use App\Traits\RepositoryTrait;

class PeternakanBerkasRepository
{
    use RepositoryTrait;

    protected $model;
    protected $peternakanRepository;
    protected $berkasPeternakanRepository;

    public function __construct(PeternakanBerkas $model, PeternakanRepository $peternakanRepository, BerkasPeternakanRepository $berkasPeternakanRepository)
    {
        $this->model                      = $model;
        $this->peternakanRepository       = $peternakanRepository;
        $this->berkasPeternakanRepository = $berkasPeternakanRepository;
        
        $this->with = ["berkas_peternakan"];
    }

    public function customIndex($data)
    {
        $data += [
            "getParent" => $this->peternakanRepository->getById(request()->input("id_peternakan")),
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "getParent"            => $this->peternakanRepository->getById(($item) ? $item->id_peternakan: request()->input("id_peternakan")),
            "listBerkasPeternakan" => $this->berkasPeternakanRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        if (@$data['file_berkas']) {
            $model->addMedia($data['file_berkas'])->usingName($data['nama'])->toMediaCollection('documents');
        }
        return redirect()->route('peternakan-berkas.index', ['id_peternakan' => $model->id_peternakan])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('peternakan-berkas.index', ['id_peternakan' => $model->id_peternakan])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('peternakan-berkas.index', ['id_peternakan' => $model->id_peternakan])->with('success', trans('message.success_delete'));
    }

    public function customDataDatatable($data)
    {
        return $data + request()->all();
    }

    public function customTable($table, $data, $request)
    {
        return $table->editColumn('nama', function ($d) {
            return $d->nama;
        })->editColumn('file_berkas_url', function ($d) {
            return ($d->file_berkas_url != null) ? "<a href='" . $d->file_berkas_url . "' class='btn btn-sm btn-info' target='_blank'>Lihat File</a>" : null;
        });
    }
}
