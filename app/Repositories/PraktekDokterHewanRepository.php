<?php

namespace App\Repositories;

use App\Models\PraktekDokterHewan;
use App\Traits\RepositoryTrait;

class PraktekDokterHewanRepository
{
    use RepositoryTrait;

    protected $model;
    protected $kecamatanRepository;
    protected $desaRepository;
    protected $tingkatResikoRepository;
    protected $skalaUsahaRepository;
    protected $kbliRepository;
    protected $pengesahanBadanHukumRepository;
    protected $jenisUsahaRepository;
    protected $jenisKeswanRepository;
    protected $statusPermodalanRepository;
    protected $statusVerifikasiRepository;

    public function __construct(PraktekDokterHewan $model, KecamatanRepository $kecamatanRepository, DesaRepository $desaRepository, TingkatResikoRepository $tingkatResikoRepository, SkalaUsahaRepository $skalaUsahaRepository, KbliRepository $kbliRepository, PengesahanBadanHukumRepository $pengesahanBadanHukumRepository, JenisUsahaRepository $jenisUsahaRepository, JenisKeswanRepository $jenisKeswanRepository, StatusPermodalanRepository $statusPermodalanRepository, StatusVerifikasiRepository $statusVerifikasiRepository)
    {
        $this->model                          = $model;
        $this->kecamatanRepository            = $kecamatanRepository;
        $this->desaRepository                 = $desaRepository;
        $this->tingkatResikoRepository        = $tingkatResikoRepository;
        $this->skalaUsahaRepository           = $skalaUsahaRepository;
        $this->kbliRepository                 = $kbliRepository;
        $this->pengesahanBadanHukumRepository = $pengesahanBadanHukumRepository;
        $this->jenisUsahaRepository           = $jenisUsahaRepository;
        $this->jenisKeswanRepository          = $jenisKeswanRepository;
        $this->statusPermodalanRepository     = $statusPermodalanRepository;
        $this->statusVerifikasiRepository     = $statusVerifikasiRepository;
    }

    public function customCreateEdit($data, $item = null)
    {
        // pengkondisian form yang muncul
        $section = request()->input('section', 'form');
        $validSections = ["form", "kontak-alamat", "lainnya", "legalitas", "rinci", "tenaga-kerja", "verifikasi"];
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
                'listKbli'        => $this->kbliRepository->getDropdown(),
                'listJenisUsaha'  => $this->jenisUsahaRepository->getAll()->pluck('nama', 'id')->toArray(),
                'listJenisKeswan' => $this->jenisKeswanRepository->getAll()->pluck('nama', 'id')->toArray(),
            ];
            $data['listKecamatan'] = $this->kecamatanRepository->getAll()->pluck('nama', 'id')->toArray();
            if ($item != null) {
                $data['listKelurahan'] = $this->desaRepository->getByIdKecamatan($item->id_kecamatan)->pluck("nama", "id");
            }
        } else if ($section == "form-kontak-alamat") {
        } else if ($section == "form-lainnya") {
            $data += [
                'listTingkatResiko' => $this->tingkatResikoRepository->getAll()->pluck('nama', 'id')->toArray(),
                'listSkalaUsaha'   => $this->skalaUsahaRepository->getAll()->pluck('nama', 'id')->toArray(),
            ];
        } else if ($section == "form-legalitas") {
            $data += [
                'listPengesahanBadanHukum' => $this->pengesahanBadanHukumRepository->getAll()->pluck('nama', 'id')->toArray(),
            ];
        } else if ($section == "form-rinci") {
            $data += [
                'listStatusPermodalan' => $this->statusPermodalanRepository->getAll()->pluck('nama', 'id')->toArray(),
            ];
        } else if ($section == "form-verifikasi") {
            $data += [
                'listStatusVerifikasi' => $this->statusVerifikasiRepository->getAll()->pluck('nama', 'id')->toArray(),
            ];
        }
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        if ($data['section'] == "form-rinci") {
            $data['nilai_investasi'] = removeSaparator($data['nilai_investasi']);
        }
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
        if ($method == "store") {
            return redirect()->route('praktek-dokter-hewan.edit', $model->id)->with('success', trans('message.success_save'));
        } else {
            return redirect()->back()->with('success', trans('message.success_save'));
        }
    }

    public function customDataDatatable($data)
    {
        $this->with = [
            "jenis_usaha",
            "jenis_keswan",
            "kecamatan",
            "status_verifikasi",
        ];
        $data['is_my_area'] = 1;
        return $data + request()->all();
    }
}
