<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class LaporanPopulasiTernakExport implements FromCollection, WithHeadings, WithEvents
{
    protected $listTahun;
    protected $listJenisTernakPopulasi;
    protected $dataPopulasi;
    protected $rows;

    function __construct($listTahun, $listJenisTernakPopulasi, $dataPopulasi) {
        $this->listTahun = $listTahun;
        $this->listJenisTernakPopulasi = $listJenisTernakPopulasi;
        $this->dataPopulasi = $dataPopulasi;
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
        }
        $header[] = 'r (%)';
        return $header;
    }

    private function generateRows()
    {
        $rows = [];
        $no = 1;
        foreach ($this->listJenisTernakPopulasi as $jenis) {
            $row = [$no++, $jenis->nama];
            $jumlahTahun = [];
            foreach ($this->listTahun as $tahun) {
                $jumlah = $this->dataPopulasi->where('jenis_ternak_populasi_id', $jenis->id)->where('tahun', $tahun)->sum('jumlah');
                $jumlahTahun[$tahun] = $jumlah;
                $row[] = $jumlah ? $jumlah : '-';
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
        // Total
        $totalRow = [null, 'Total'];
        $totalTahunArr = [];
        foreach ($this->listTahun as $tahun) {
            $totalTahunArr[$tahun] = $this->dataPopulasi->where('tahun', $tahun)->sum('jumlah');
            $totalRow[] = $totalTahunArr[$tahun] ? $totalTahunArr[$tahun] : '-';
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
        $totalRow[] = count($tahunDataTotal) > 1 ? number_format($pertumbuhanTotal, 2, ',', '.') : '-';
        $rows[] = $totalRow;
        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->autoSize();
                $event->sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
} 