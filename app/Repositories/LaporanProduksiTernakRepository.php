<?php

namespace App\Repositories;

use App\Models\ProduksiTernak;
use App\Traits\RepositoryTrait;
use App\Models\JenisProduksi;
use App\Models\JenisTernakProduksi;

class LaporanProduksiTernakRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(ProduksiTernak $model)
    {
        $this->model = $model;
    }

    public function export($data)
    {
        $listTahun = $this->getListTahun();
        $produksi = $this->model->with('jenis_ternak_produksi')->whereIn('tahun', $listTahun)->get();
        return ['data' => $produksi, 'listTahun' => $listTahun];
    }

    public function customIndex($data)
    {
        $listTahun = $this->getListTahun();
        $data += [
            'listJenisProduksi' => JenisProduksi::pluck('nama', 'id')->toArray(),
            'listJenisTernakProduksi' => JenisTernakProduksi::all(),
            'listTahun'      => $listTahun,
            'dataProduksi'   => $this->model->whereIn('tahun', $listTahun)->get(),
        ];
        return $data;
    }

    private function getListTahun() {
        $tahun = ProduksiTernak::select('tahun')->distinct()->orderBy('tahun')->pluck('tahun')->toArray();
        if (empty($tahun)) {
            $tahun = [date('Y')];
        }
        return $tahun;
    }

    public function customDataDatatable($data)
    {
        return $this->getReportData($data);
    }

    public function getReportData($filters = [], $listTahun = null)
    {
        $listTahun = $listTahun ?? $this->getListTahun();
        $query = $this->model->with('jenis_ternak_produksi.jenis_produksi')->whereIn('tahun', $listTahun);
        if (!empty($filters['jenis_ternak_produksi_id'])) {
            $query->where('jenis_ternak_produksi_id', $filters['jenis_ternak_produksi_id']);
        }
        if (!empty($filters['q'])) {
            $query->whereHas('jenis_ternak_produksi', function($q) use ($filters) {
                $q->where('nama', 'like', '%' . $filters['q'] . '%');
            });
        }
        $allData = $query->get();
        $allKategori = JenisProduksi::with('jenis_ternak_produksi')->get();
        $result = [];
        $no = 1;
        foreach ($allKategori as $kategori) {
            $result[] = array_merge(['<strong>' . $kategori->nama . '</strong>', ''], array_fill(0, count($listTahun)*2, ''), ['']);
            // Hitung total per tahun untuk kategori ini
            $totalPerTahun = [];
            foreach ($listTahun as $tahun) {
                $totalPerTahun[$tahun] = $allData->whereIn('jenis_ternak_produksi_id', $kategori->jenis_ternak_produksi->pluck('id'))
                    ->where('tahun', $tahun)->sum('jumlah');
            }
            foreach ($kategori->jenis_ternak_produksi as $jenis) {
                $row = [$no++, $jenis->nama];
                $jumlahTahun = [];
                // Data jumlah & kontribusi per tahun (berpasangan)
                foreach ($listTahun as $tahun) {
                    $dataTahun = $allData->where('jenis_ternak_produksi_id', $jenis->id)->where('tahun', $tahun)->first();
                    $jumlah = $dataTahun ? $dataTahun->jumlah : 0;
                    $jumlahTahun[$tahun] = $jumlah;
                    $row[] = number_format($jumlah);
                    $total = $totalPerTahun[$tahun] ?? 0;
                    $kontribusi = $total > 0 ? round(($jumlahTahun[$tahun] ?? 0) / $total * 100, 2) : 0;
                    $row[] = number_format($kontribusi, 2, ',', '.');
                }
                // r(%)
                $tahunData = array_keys(array_filter($jumlahTahun, function($v) { return $v !== 0 && $v !== null; }));
                if (count($tahunData) > 1) {
                    $tahunAwal = $tahunData[0];
                    $tahunAkhir = $tahunData[count($tahunData)-1];
                    $jumlahAwal = $jumlahTahun[$tahunAwal] ?? 0;
                    $jumlahAkhir = $jumlahTahun[$tahunAkhir] ?? 0;
                    $pertumbuhan = $jumlahAwal > 0 ? round((($jumlahAkhir - $jumlahAwal) / $jumlahAwal) * 100, 2) : 0;
                } else {
                    $pertumbuhan = 0;
                }
                $row[] = number_format($pertumbuhan, 2, ',', '.');
                $result[] = $row;
            }
            // Subtotal per kategori
            $subtotalRow = ['<strong>Jumlah</strong>', ''];
            $totalTahunArr = [];
            foreach ($listTahun as $tahun) {
                $total = $totalPerTahun[$tahun] ?? 0;
                $subtotalRow[] = '<strong>' . number_format($total) . '</strong>';
                $totalTahunArr[$tahun] = $total;
                $subtotalRow[] = '<strong>' . number_format(100, 2, ',', '.') . '</strong>';
            }
            // r(%) subtotal: cari tahun pertama & terakhir yang ADA DATA
            $tahunDataTotal = array_keys(array_filter($totalTahunArr, function($v) { return $v !== 0 && $v !== null; }));
            if (count($tahunDataTotal) > 1) {
                $tahunAwal = $tahunDataTotal[0];
                $tahunAkhir = $tahunDataTotal[count($tahunDataTotal)-1];
                $totalAwal = $totalTahunArr[$tahunAwal] ?? 0;
                $totalAkhir = $totalTahunArr[$tahunAkhir] ?? 0;
                $pertumbuhanTotal = $totalAwal > 0 ? round((($totalAkhir - $totalAwal) / $totalAwal) * 100, 2) : 0;
            } else {
                $pertumbuhanTotal = 0;
            }
            $subtotalRow[] = '<strong>' . number_format($pertumbuhanTotal, 2, ',', '.') . '</strong>';
            $result[] = $subtotalRow;
        }
        return $result;
    }
} 