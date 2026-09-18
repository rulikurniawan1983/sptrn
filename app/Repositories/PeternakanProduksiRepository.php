<?php

namespace App\Repositories;

use App\Models\PeternakanProduksi;
use App\Traits\RepositoryTrait;

class PeternakanProduksiRepository
{
    use RepositoryTrait;

    protected $model;
    protected $peternakanRepository;
    protected $satuanRepository;

    public function __construct(PeternakanProduksi $model, PeternakanRepository $peternakanRepository, SatuanRepository $satuanRepository)
    {
        $this->model                = $model;
        $this->peternakanRepository = $peternakanRepository;
        $this->satuanRepository     = $satuanRepository;
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
            "getParent"  => $this->peternakanRepository->getById(($item) ? $item->id_peternakan: request()->input("id_peternakan")),
            "listSatuan" => $this->satuanRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        $data['jumlah_kandang']  = removeSaparator($data['jumlah_kandang']);
        $data['jumlah_populasi'] = removeSaparator($data['jumlah_populasi']);
        $data['jumlah_produksi'] = removeSaparator($data['jumlah_produksi']);
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        return redirect()->route('peternakan-produksi.index', ['id_peternakan' => $model->id_peternakan])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('peternakan-produksi.index', ['id_peternakan' => $model->id_peternakan])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('peternakan-produksi.index', ['id_peternakan' => $model->id_peternakan])->with('success', trans('message.success_delete'));
    }

    public function customDataDatatable($data)
    {
        return $data + request()->all();
    }

    public function customTable($table, $data, $request){
        return $table->editColumn('tanggal_produksi_dari', function ($d) {
            return periodeTanggal($d->tanggal_produksi_dari, $d->tanggal_produksi_sampai);
        })->editColumn('jumlah_kandang', function ($d) {
            return $d->jumlah_kandang." ".$d->satuan_kandang->nama;
        })->editColumn('jumlah_populasi', function ($d) {
            return $d->jumlah_populasi." ".$d->satuan_populasi->nama;
        })->editColumn('jumlah_produksi', function ($d) {
            return $d->jumlah_produksi." ".$d->satuan_produksi->nama;
        });
    }
}
