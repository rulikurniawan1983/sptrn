<?php

namespace App\Repositories;

use App\Models\PerikananBerkas;
use App\Traits\RepositoryTrait;

class PerikananBerkasRepository
{
    use RepositoryTrait;

    protected $model;
    protected $perikananRepository;
    protected $berkasPerikananRepository;

    public function __construct(PerikananBerkas $model, PerikananRepository $perikananRepository, BerkasPerikananRepository $berkasPerikananRepository)
    {
        $this->model                     = $model;
        $this->perikananRepository       = $perikananRepository;
        $this->berkasPerikananRepository = $berkasPerikananRepository;

        $this->with = ["berkas_perikanan"];
    }

    public function customIndex($data)
    {
        $data += [
            "getParent" => $this->perikananRepository->getById(request()->input("id_perikanan")),
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "getParent"           => $this->perikananRepository->getById(($item) ? $item->id_perikanan: request()->input("id_perikanan")),
            "listBerkasPerikanan" => $this->berkasPerikananRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        if (@$data['file_berkas']) {
            $model->addMedia($data['file_berkas'])->usingName($data['nama'])->toMediaCollection('documents');
        }
        return redirect()->route('perikanan-berkas.index', ['id_perikanan' => $model->id_perikanan])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('perikanan-berkas.index', ['id_perikanan' => $model->id_perikanan])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('perikanan-berkas.index', ['id_perikanan' => $model->id_perikanan])->with('success', trans('message.success_delete'));
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
