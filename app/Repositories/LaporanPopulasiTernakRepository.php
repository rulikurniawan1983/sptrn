<?php

namespace App\Repositories;

use App\Models\JenisTernakPopulasi;
use App\Models\PopulasiTernak;
use App\Traits\RepositoryTrait;

class LaporanPopulasiTernakRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(PopulasiTernak $model)
    {
        $this->model = $model;
    }

    public function customIndex($data)
    {
        $listJenisTernakPopulasi = JenisTernakPopulasi::orderBy('nama')->get();
        $listTahun = PopulasiTernak::select('tahun')->distinct()->orderBy('tahun')->pluck('tahun')->toArray();
        if (empty($listTahun)) {
            $listTahun = [date('Y')];
        }
        $dataPopulasi = PopulasiTernak::query();
        if (!empty($data['jenis_ternak_populasi_id'])) {
            $dataPopulasi = $dataPopulasi->where('jenis_ternak_populasi_id', $data['jenis_ternak_populasi_id']);
            $listJenisTernakPopulasi = $listJenisTernakPopulasi->where('id', $data['jenis_ternak_populasi_id']);
        }
        $dataPopulasi = $dataPopulasi->get();
        $data += [
            'listJenisTernakPopulasi' => $listJenisTernakPopulasi,
            'listTahun' => $listTahun,
            'dataPopulasi' => $dataPopulasi,
        ];
        return $data;
    }

    public function customDataDatatable($data)
    {
        return $this->getReportData($data);
    }

    public function export($data)
    {
        return $this->getReportData($data);
    }

    private function getReportData($filters = [], $listTahun = null)
    {
        if ($listTahun === null) {
            $listTahun = PopulasiTernak::select('tahun')->distinct()->orderBy('tahun')->pluck('tahun')->toArray();
            if (empty($listTahun)) {
                $listTahun = [date('Y')];
            }
        }
        $query = $this->model->with('jenis_ternak_populasi')->whereIn('tahun', $listTahun);

        if (!empty($filters['jenis_ternak_populasi_id'])) {
            $query->where('jenis_ternak_populasi_id', $filters['jenis_ternak_populasi_id']);
        }

        if (!empty($filters['q'])) {
            $query->whereHas('jenis_ternak_populasi', function ($q) use ($filters) {
                $q->where('nama', 'like', '%' . $filters['q'] . '%');
            });
        }

        $allData = $query->get();
        $allJenisTernak = JenisTernakPopulasi::get();

        $result = [];
        $no = 1;

        foreach ($allJenisTernak as $jenis) {
            $row = [$no++, $jenis->nama];
            $jumlahTahun = [];
            foreach ($listTahun as $tahun) {
                $dataTahun = $allData->where('jenis_ternak_populasi_id', $jenis->id)->where('tahun', $tahun)->first();
                $jumlah = $dataTahun ? $dataTahun->jumlah : 0;
                $row[] = number_format($jumlah);
                $jumlahTahun[$tahun] = $jumlah;
            }
            // Hitung pertumbuhan r(%) dari tahun pertama ke terakhir
            $tahunAwal = $listTahun[0];
            $tahunAkhir = end($listTahun);
            $jumlahAwal = $jumlahTahun[$tahunAwal] ?? 0;
            $jumlahAkhir = $jumlahTahun[$tahunAkhir] ?? 0;
            $pertumbuhan = $jumlahAwal > 0 ? round((($jumlahAkhir - $jumlahAwal) / $jumlahAwal) * 100, 2) : 0;
            $row[] = number_format($pertumbuhan, 2, ',', '.');
            if (array_sum($jumlahTahun) == 0 && empty($filters['q']))
                continue;
            $result[] = $row;
        }

        // Calculate Totals
        $totalRow = ['<strong>Total</strong>', ''];
        $totalTahun = [];
        foreach ($listTahun as $tahun) {
            $total = $allData->where('tahun', $tahun)->sum('jumlah');
            $totalRow[] = '<strong>' . number_format($total) . '</strong>';
            $totalTahun[$tahun] = $total;
        }
        $tahunAwal = $listTahun[0];
        $tahunAkhir = end($listTahun);
        $totalAwal = $totalTahun[$tahunAwal] ?? 0;
        $totalAkhir = $totalTahun[$tahunAkhir] ?? 0;
        $pertumbuhanTotal = $totalAwal > 0 ? round((($totalAkhir - $totalAwal) / $totalAwal) * 100, 2) : 0;
        $totalRow[] = '<strong>' . number_format($pertumbuhanTotal, 2, ',', '.') . '</strong>';
        $result[] = $totalRow;

        return $result;
    }
}