<?php

namespace App\Exports;

use App\Models\MstDesa;
use App\Models\MstJenisPerikanan;
use App\Models\MstJenisUsaha;
use App\Models\MstKbli;
use App\Models\MstKecamatan;
use App\Models\MstPengesahanBadanHukum;
use App\Models\MstSkalaUsaha;
use App\Models\MstStatusPermodalan;
use App\Models\MstTingkatResiko;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PerikananReferensiExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new GeneralExport(new MstKbli(), [], ["kode", "uraian"], ["kode", "nama"], "KBLI"),
            new GeneralExport(new MstJenisUsaha(), [], ["id", "nama"], ["kode", "nama"], "Jenis Badan Usaha"),
            new GeneralExport(new MstJenisPerikanan(), [], ["id", "nama"], ["kode", "nama"], "Jenis Perikanan"),
            new GeneralExport(new MstKecamatan(), [], ["id", "nama"], ["kode", "nama"], "Kecamatan"),
            new GeneralExport(new MstDesa(), [], ["id", "nama"], ["kode", "nama"], "Kelurahan"),
            new GeneralExport(new MstTingkatResiko(), [], ["id", "nama"], ["kode", "nama"], "Tingkat Resiko"),
            new GeneralExport(new MstSkalaUsaha(), [], ["id", "nama"], ["kode", "nama"], "Skala Usaha"),
            new GeneralExport(new MstPengesahanBadanHukum(), [], ["id", "nama"], ["kode", "nama"], "Pengesahan Badan Hukum"),
            new GeneralExport(new MstStatusPermodalan(), [], ["id", "nama"], ["kode", "nama"], "Status Permodalan"),
        ];
    }
}
