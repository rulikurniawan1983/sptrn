<?php

namespace App\Repositories;

use App\Models\StatusPenyakit;
use App\Models\StatusPenyakitKecamatan;
use App\Traits\RepositoryTrait;

class StatusPenyakitRepository
{
    use RepositoryTrait;

    protected $model;
    protected $kecamatanRepository;
    protected $jenisPenyakitRepository;

    public function __construct(StatusPenyakit $model, KecamatanRepository $kecamatanRepository, JenisPenyakitRepository $jenisPenyakitRepository)
    {
        $this->model                   = $model;
        $this->kecamatanRepository     = $kecamatanRepository;
        $this->jenisPenyakitRepository = $jenisPenyakitRepository;
    }

    public function customCreateEdit($data, $item = null)
    {
        // pengkondisian form yang muncul
        $section = request()->input('section', 'form');
        $validSections = ["form", "wilayah"];
        if (!in_array($section, $validSections) || ($section !== "form" && $item === null)) {
            return abort(404);
        }
        $section = $section !== "form" ? "form-$section" : $section;
        //

        $data += [
            'section' => $section,
        ];
        if ($section == "form") {
            $data += [
                'listJenisPenyakit' => $this->jenisPenyakitRepository->getAll([])->pluck('nama', 'id')->toArray(),
                'listStatusPenyelesaian' => $this->model->listStatusPenyelesaian(),
            ];
        } else if ($section == "form-wilayah") {
            $data['listKecamatan'] = $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray();
        }
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        unset($data['id_kecamatan']);
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        $data = request()->all();
        $this->createBatchStatusPenyakitKecamatan($model->id, $data, $method);
        if ($method == "store") {
            return redirect()->route('status-penyakit.edit', $model->id)->with('success', trans('message.success_save'));
        } else {
            return redirect()->back()->with('success', trans('message.success_save'));
        }
    }

    public function customDataDatatable($data)
    {
        $this->with = [
            "jenis_penyakit",
        ];
        $data['is_my_area'] = 1;
        return $data + request()->all();
    }

    public function createBatchStatusPenyakitKecamatan($id_status_penyakit, $data, $method = "create")
    {
        if ($method != "create") {
            if (isset($data['id_kecamatan'])) {
                StatusPenyakitKecamatan::where("id_status_penyakit", $id_status_penyakit)->whereNotIn("id_kecamatan", $data['id_kecamatan'])->delete();
            } else {
                StatusPenyakitKecamatan::where("id_status_penyakit", $id_status_penyakit)->delete();
            }
        }
        if (isset($data['id_kecamatan'])) {
            foreach ($data['id_kecamatan'] as $key => $value) {
                if ($method != "create") {
                    $check = StatusPenyakitKecamatan::where("id_status_penyakit", $id_status_penyakit)->where("id_kecamatan", $value)->first();
                }else{
                    $check = null;
                }
                if ($check == null) {
                    StatusPenyakitKecamatan::create(["id_status_penyakit" => $id_status_penyakit, "id_kecamatan" => $value]);
                }
            }
        }
    }
}
