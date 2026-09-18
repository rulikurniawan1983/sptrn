<?php

namespace App\Repositories;

use App\Models\PraktekDokterHewanBerkas;
use App\Traits\RepositoryTrait;

class PraktekDokterHewanBerkasRepository
{
    use RepositoryTrait;

    protected $model;
    protected $praktekDokterHewanRepository;
    protected $berkasKeswanRepository;

    public function __construct(PraktekDokterHewanBerkas $model, PraktekDokterHewanRepository $praktekDokterHewanRepository, BerkasKeswanRepository $berkasKeswanRepository)
    {
        $this->model                        = $model;
        $this->praktekDokterHewanRepository = $praktekDokterHewanRepository;
        $this->berkasKeswanRepository       = $berkasKeswanRepository;
        
        $this->with = ["berkas_keswan"];
    }

    public function customIndex($data)
    {
        $data += [
            "getParent" => $this->praktekDokterHewanRepository->getById(request()->input("id_praktek_dokter_hewan")),
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "getParent"        => $this->praktekDokterHewanRepository->getById(($item) ? $item->id_praktek_dokter_hewan: request()->input("id_praktek_dokter_hewan")),
            "listBerkasKeswan" => $this->berkasKeswanRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        if (@$data['file_berkas']) {
            $model->addMedia($data['file_berkas'])->usingName($data['nama'])->toMediaCollection('documents');
        }
        return redirect()->route('praktek-dokter-hewan-berkas.index', ['id_praktek_dokter_hewan' => $model->id_praktek_dokter_hewan])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('praktek-dokter-hewan-berkas.index', ['id_praktek_dokter_hewan' => $model->id_praktek_dokter_hewan])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('praktek-dokter-hewan-berkas.index', ['id_praktek_dokter_hewan' => $model->id_praktek_dokter_hewan])->with('success', trans('message.success_delete'));
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
