<?php

namespace App\Repositories;

use App\Models\UptPuskeswan;
use App\Models\UptPuskeswanFasilitasUpt;
use App\Models\UptPuskeswanKecamatan;
use App\Models\UptPuskeswanLayananUpt;
use App\Traits\RepositoryTrait;

class UptPuskeswanRepository
{
    use RepositoryTrait;

    protected $model;
    protected $kecamatanRepository;
    protected $desaRepository;
    protected $statusVerifikasiRepository;
    protected $fasilitasUptRepository;
    protected $layananUptRepository;

    public function __construct(UptPuskeswan $model, KecamatanRepository $kecamatanRepository, DesaRepository $desaRepository, StatusVerifikasiRepository $statusVerifikasiRepository, FasilitasUptRepository $fasilitasUptRepository, LayananUptRepository $layananUptRepository)
    {
        $this->model                      = $model;
        $this->kecamatanRepository        = $kecamatanRepository;
        $this->desaRepository             = $desaRepository;
        $this->statusVerifikasiRepository = $statusVerifikasiRepository;
        $this->fasilitasUptRepository     = $fasilitasUptRepository;
        $this->layananUptRepository       = $layananUptRepository;
    }

    public function customCreateEdit($data, $item = null)
    {
        // pengkondisian form yang muncul
        $section = request()->input('section', 'form');
        $validSections = ["form", "wilayah", "kontak-alamat", "fasilitas-layanan", "tenaga-kerja", "verifikasi"];
        if (!in_array($section, $validSections) || ($section !== "form" && $item === null)) {
            return abort(404);
        }
        $section = $section !== "form" ? "form-$section" : $section;
        //

        $data += [
            'section' => $section,
        ];
        if ($section == "form") {
        } else if ($section == "form-wilayah") {
            $data['listKecamatan'] = $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray();
        } else if ($section == "form-fasilitas-layanan") {
            $data['listFasilitasUpt'] = $this->fasilitasUptRepository->getAll()->pluck('nama', 'id')->toArray();
            $data['listLayananUpt'] = $this->layananUptRepository->getAll()->pluck('nama', 'id')->toArray();
        } else if ($section == "form-kontak-alamat") {
            $data['listKecamatan'] = $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray();
            if ($item != null) {
                $data['listKelurahan'] = $this->desaRepository->getByIdKecamatan($item->id_kecamatan)->pluck("nama", "id");
            }
        } else if ($section == "form-verifikasi") {
            $data += [
                'listStatusVerifikasi' => $this->statusVerifikasiRepository->getAll()->pluck('nama', 'id')->toArray(),
            ];
        }
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        unset($data['id_kecamatan']);
        if ($record == null) {
            $statusVerifikasiDefault = $this->statusVerifikasiRepository->getInstanceModel()->where("is_default", true)->first();
            if ($statusVerifikasiDefault) {
                $data['id_status_verifikasi'] = $statusVerifikasiDefault->id;
            }
        }
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        $data = request()->all();
        $this->createBatchUptPuskeswanKecamatan($model->id, $data, $method);
        $this->createBatchUptPuskeswanFasilitasUpt($model->id, $data, $method);
        $this->createBatchUptPuskeswanLayananUpt($model->id, $data, $method);
        if ($method == "store") {
            return redirect()->route('upt-puskeswan.edit', $model->id)->with('success', trans('message.success_save'));
        } else {
            return redirect()->back()->with('success', trans('message.success_save'));
        }
    }

    public function customDataDatatable($data)
    {
        $this->with = [
            "kecamatan",
            "status_verifikasi",
        ];
        $data['is_my_area'] = 1;
        return $data + request()->all();
    }

    public function customTable($table, $data, $request){
        return $table->addColumn('list_kecamatan_nama', function ($d) {
            return $d->list_kecamatan_nama;
        });
    }

    public function createBatchUptPuskeswanKecamatan($id_upt_puskeswan, $data, $method = "create")
    {
        if ($method != "create") {
            if (isset($data['id_kecamatan'])) {
                UptPuskeswanKecamatan::where("id_upt_puskeswan", $id_upt_puskeswan)->whereNotIn("id_kecamatan", $data['id_kecamatan'])->delete();
            } else {
                UptPuskeswanKecamatan::where("id_upt_puskeswan", $id_upt_puskeswan)->delete();
            }
        }
        if (isset($data['id_kecamatan'])) {
            foreach ($data['id_kecamatan'] as $key => $value) {
                if ($method != "create") {
                    $check = UptPuskeswanKecamatan::where("id_upt_puskeswan", $id_upt_puskeswan)->where("id_kecamatan", $value)->first();
                }else{
                    $check = null;
                }
                if ($check == null) {
                    UptPuskeswanKecamatan::create(["id_upt_puskeswan" => $id_upt_puskeswan, "id_kecamatan" => $value]);
                }
            }
        }
    }

    public function createBatchUptPuskeswanFasilitasUpt($id_upt_puskeswan, $data, $method = "create")
    {
        if ($method != "create") {
            if (isset($data['id_fasilitas_upt'])) {
                UptPuskeswanFasilitasUpt::where("id_upt_puskeswan", $id_upt_puskeswan)->whereNotIn("id_fasilitas_upt", $data['id_fasilitas_upt'])->delete();
            } else {
                UptPuskeswanFasilitasUpt::where("id_upt_puskeswan", $id_upt_puskeswan)->delete();
            }
        }
        if (isset($data['id_fasilitas_upt'])) {
            foreach ($data['id_fasilitas_upt'] as $key => $value) {
                if ($method != "create") {
                    $check = UptPuskeswanFasilitasUpt::where("id_upt_puskeswan", $id_upt_puskeswan)->where("id_fasilitas_upt", $value)->first();
                }else{
                    $check = null;
                }
                if ($check == null) {
                    UptPuskeswanFasilitasUpt::create(["id_upt_puskeswan" => $id_upt_puskeswan, "id_fasilitas_upt" => $value]);
                }
            }
        }
    }

    public function createBatchUptPuskeswanLayananUpt($id_upt_puskeswan, $data, $method = "create")
    {
        if ($method != "create") {
            if (isset($data['id_layanan_upt'])) {
                UptPuskeswanLayananUpt::where("id_upt_puskeswan", $id_upt_puskeswan)->whereNotIn("id_layanan_upt", $data['id_layanan_upt'])->delete();
            } else {
                UptPuskeswanLayananUpt::where("id_upt_puskeswan", $id_upt_puskeswan)->delete();
            }
        }
        if (isset($data['id_layanan_upt'])) {
            foreach ($data['id_layanan_upt'] as $key => $value) {
                if ($method != "create") {
                    $check = UptPuskeswanLayananUpt::where("id_upt_puskeswan", $id_upt_puskeswan)->where("id_layanan_upt", $value)->first();
                }else{
                    $check = null;
                }
                if ($check == null) {
                    UptPuskeswanLayananUpt::create(["id_upt_puskeswan" => $id_upt_puskeswan, "id_layanan_upt" => $value]);
                }
            }
        }
    }
}
