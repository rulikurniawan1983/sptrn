<?php

namespace App\Repositories;

use App\Models\PerikananProduksi;
use App\Traits\RepositoryTrait;

class PerikananProduksiRepository
{
    use RepositoryTrait;

    protected $model;
    protected $perikananRepository;
    protected $satuanRepository;

    public function __construct(PerikananProduksi $model, PerikananRepository $perikananRepository, SatuanRepository $satuanRepository)
    {
        $this->model                = $model;
        $this->perikananRepository = $perikananRepository;
        $this->satuanRepository     = $satuanRepository;
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
            "getParent"  => $this->perikananRepository->getById(($item) ? $item->id_perikanan: request()->input("id_perikanan")),
            "listSatuan" => $this->satuanRepository->getAll([])->pluck("nama", "id")->toArray(),
        ];
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        $data['jumlah_kolam']    = removeSaparator($data['jumlah_kolam']);
        $data['jumlah_populasi'] = removeSaparator($data['jumlah_populasi']);
        $data['jumlah_produksi'] = removeSaparator($data['jumlah_produksi']);
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        return redirect()->route('perikanan-produksi.index', ['id_perikanan' => $model->id_perikanan])->with('success', ($method == "store") ? trans('message.success_add') : trans('message.success_update'));
    }

    public function callbackAfterDelete($model, $request)
    {
        return redirect()->route('perikanan-produksi.index', ['id_perikanan' => $model->id_perikanan])->with('success', trans('message.success_delete'));
    }

    public function callbackAfterDeleteSelected($model, $request)
    {
        return redirect()->route('perikanan-produksi.index', ['id_perikanan' => $model->id_perikanan])->with('success', trans('message.success_delete'));
    }

    public function customDataDatatable($data)
    {
        return $data + request()->all();
    }

    public function customTable($table, $data, $request){
        return $table->editColumn('tanggal_produksi_dari', function ($d) {
            return periodeTanggal($d->tanggal_produksi_dari, $d->tanggal_produksi_sampai);
        })->editColumn('jumlah_kolam', function ($d) {
            return $d->jumlah_kolam." ".$d->satuan_kolam->nama;
        })->editColumn('jumlah_populasi', function ($d) {
            return $d->jumlah_populasi." ".$d->satuan_populasi->nama;
        })->editColumn('jumlah_produksi', function ($d) {
            return $d->jumlah_produksi." ".$d->satuan_produksi->nama;
        });
    }
}
