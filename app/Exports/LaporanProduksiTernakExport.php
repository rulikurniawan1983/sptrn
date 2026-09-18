<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanProduksiTernakExport implements FromCollection, WithHeadings, WithEvents
{
    protected $listTahun;
    protected $listJenisProduksi;
    protected $listJenisTernakProduksi;
    protected $dataProduksi;
    protected $rows;

    function __construct($listTahun, $listJenisProduksi, $listJenisTernakProduksi, $dataProduksi) {
        $this->listTahun = $listTahun;
        $this->listJenisProduksi = $listJenisProduksi;
        $this->listJenisTernakProduksi = $listJenisTernakProduksi;
        $this->dataProduksi = $dataProduksi;
        $this->rows = $this->generateRows();
    }

    public function collection()
    {
        return collect($this->rows);
    }

    public function headings(): array
    {
        $header = ['No', 'Jenis Ternak'];
        foreach ($this->listTahun as $tahun) {
            $header[] = 'Tahun ' . $tahun;
            $header[] = 'Kontribusi ' . $tahun . ' %';
        }
        $header[] = 'r (%)';
        return $header;
    }

    private function generateRows()
    {
        $rows = [];
        $no = 1;
        foreach ($this->listJenisProduksi as $idJenisProduksi => $namaJenisProduksi) {
            $rows[] = [null, $namaJenisProduksi];
            foreach ($this->listJenisTernakProduksi->where('jenis_produksi_id', $idJenisProduksi) as $jenisTernak) {
                $row = [$no++, $jenisTernak->nama];
                $jumlahTahun = [];
                $totalPerTahun = [];
                foreach ($this->listTahun as $tahun) {
                    $jumlah = $this->dataProduksi->where('jenis_ternak_produksi_id', $jenisTernak->id)->where('tahun', $tahun)->sum('jumlah');
                    $jumlahTahun[$tahun] = $jumlah;
                }
                foreach ($this->listTahun as $tahun) {
                    $totalPerTahun[$tahun] = $this->dataProduksi->whereIn('jenis_ternak_produksi_id', $this->listJenisTernakProduksi->where('jenis_produksi_id', $idJenisProduksi)->pluck('id'))
                        ->where('tahun', $tahun)->sum('jumlah');
                }
                foreach ($this->listTahun as $tahun) {
                    $row[] = $jumlahTahun[$tahun] ? $jumlahTahun[$tahun] : '-';
                    $kontribusi = ($totalPerTahun[$tahun] > 0) ? round(($jumlahTahun[$tahun] ?? 0) / $totalPerTahun[$tahun] * 100, 2) : 0;
                    $row[] = $jumlahTahun[$tahun] ? number_format($kontribusi, 2, ',', '.') : '-';
                }
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
                $row[] = count($tahunData) > 1 ? number_format($pertumbuhan, 2, ',', '.') : '-';
                $rows[] = $row;
            }
            // Subtotal
            $subtotalRow = [null, 'Jumlah'];
            $totalTahunArr = [];
            foreach ($this->listTahun as $tahun) {
                $totalTahunArr[$tahun] = $this->dataProduksi->whereIn('jenis_ternak_produksi_id', $this->listJenisTernakProduksi->where('jenis_produksi_id', $idJenisProduksi)->pluck('id'))
                    ->where('tahun', $tahun)->sum('jumlah');
            }
            foreach ($this->listTahun as $tahun) {
                $subtotalRow[] = $totalTahunArr[$tahun] ? $totalTahunArr[$tahun] : '-';
                $subtotalRow[] = $totalTahunArr[$tahun] ? number_format(100, 2, ',', '.') : '-';
            }
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
            $subtotalRow[] = count($tahunDataTotal) > 1 ? number_format($pertumbuhanTotal, 2, ',', '.') : '-';
            $rows[] = $subtotalRow;
        }
        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
            }
        ];
    }
} 