<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class HomeRepository
{
    protected $kecamatanRepository;
    protected $desaRepository;
    protected $peternakanRepository;
    protected $perikananRepository;
    protected $rekomendasiNkvRepository;
    
    public function __construct(KecamatanRepository $kecamatanRepository, DesaRepository $desaRepository, PeternakanRepository $peternakanRepository, PerikananRepository $perikananRepository, RekomendasiNkvRepository $rekomendasiNkvRepository)
    {
        $this->kecamatanRepository  = $kecamatanRepository;
        $this->desaRepository       = $desaRepository;
        $this->peternakanRepository = $peternakanRepository;
        $this->perikananRepository  = $perikananRepository;
        $this->rekomendasiNkvRepository = $rekomendasiNkvRepository;
    }

    public function customIndex($data)
    {
        $getPeternakanByKecamatan = $this->getPeternakanByKecamatan(request()->all());

        $listKecamatan = $this->kecamatanRepository->getAll([]);
        $data += [
            "countPeternakan"          => $this->peternakanRepository->getAll([], false, true),
            "countPerikanan"           => $this->perikananRepository->getAll([], false, true),
            "countKecamatan"           => $this->kecamatanRepository->getAll([], false, true),
            "countDesa"                => $this->desaRepository->getAll([], false, true),

            "getPeternakanByKecamatan" => $getPeternakanByKecamatan,

            "listKecamatan"            => $listKecamatan->pluck("nama", "id")->toArray(),

            "request"                  => request()->all(),
            "getKecamatan"             => $listKecamatan->where("id", request()->input("id_kecamatan"))->first(),

            'getRuang'                 => $this->getRuang(),
            'ruangJson'                => json_encode($this->getRuang()),
            'listRekomendasiNkv'       => \App\Models\RekomendasiNkv::orderBy('created_at', 'desc')->limit(10)->get(),
        ];
        if (request()->input("id_kecamatan") != null) {
            $data['listKelurahan'] = @$data['getKecamatan']->desa ? $data['getKecamatan']->desa->pluck("nama", "id")->toArray() : [];
        }
        return $data;
    }

    public function getDataMap($request=[]) {
        return $this->getPeternakanByKecamatan($request);
    }

    public function getDataSubMap($request=[]) {
        return $this->getPeternakanByKelurahan($request);
    }

    public function getPeternakanByKecamatan($request=[]) {
        $this->kecamatanRepository->withCount = ["peternakan", "perikanan"];
        $data = $this->kecamatanRepository->getAll($request);
        return $data;
    }

    public function getPeternakanByKelurahan($request=[]) {
        $this->desaRepository->withCount = ["peternakan", "perikanan"];
        $data = $this->desaRepository->getAll($request);
        return $data;
    }
    
    public function getDataMapSpecific($request = []) {
        // Cek panjang karakter dari input "q"
        if (strlen(@$request['q']) <= 3) {
            // Jika kurang dari atau sama dengan 3 karakter, set $listUmkm dan $listKoperasi menjadi array kosong
            return collect();
        }
    
        $listUmkm = collect();
        $listKoperasi = collect();
    
        if ($request['jenis'] == 'peternakan' || !$request['jenis']) {
            $listUmkm = $this->getDataByJenis($request, 'peternakan');
        }
    
        if ($request['jenis'] == 'perikanan' || !$request['jenis']) {
            $listKoperasi = $this->getDataByJenis($request, 'perikanan');
        }
    
        // Menggabungkan kedua list jika jenis null atau tidak ada jenis
        return $listUmkm->merge($listKoperasi);
    }
    
    private function getDataByJenis($request, $jenis) {
        $data = [];
    
        if ($jenis == 'peternakan') {
            $this->peternakanRepository->with = ["kecamatan", "kelurahan"];
            $this->peternakanRepository->selectColumn = ["nama", "lat as latitude", "long as longitude", "id_kecamatan", "id_kelurahan"];
            $data = collect($this->peternakanRepository->getAll(["nama" => $request["q"], "id_kecamatan" => $request["id_kecamatan"], "id_kelurahan" => $request["id_kelurahan"], "is_lokasi_maps_terisi" => 1]));
        } elseif ($jenis == 'perikanan') {
            $this->perikananRepository->with = ["kecamatan", "kelurahan"];
            $this->perikananRepository->selectColumn = ["nama", "lat as latitude", "long as longitude", "id_kecamatan", "id_kelurahan"];
            $data = collect($this->perikananRepository->getAll(["nama" => $request["q"], "id_kecamatan" => $request["id_kecamatan"], "id_kelurahan" => $request["id_kelurahan"], "is_lokasi_maps_terisi" => 1]));
        }
    
        // Menambahkan kolom 'jenis' untuk data yang diambil
        return $data->map(function($item) use ($jenis) {
            $item->jenis = $jenis;
            return $item;
        });
    }

    public function getRuang() {
        return [
            [
                'name' => 'HK',
                'label' => 'Hutan Konservasi',
                'color' => '#FF5733'
            ],
            [
                'name' => 'HL',
                'label' => 'Hutan Lindung',
                'color' => '#28B463'
            ],
            [
                'name' => 'EH',
                'label' => 'Ekosistem Hutan',
                'color' => '#3498DB'
            ],
            [
                'name' => 'KPI',
                'label' => 'Kawasan Perairan Indonesia',
                'color' => '#8E44AD'
            ],
            [
                'name' => 'LB',
                'label' => 'Lahan Budidaya',
                'color' => '#F4D03F'
            ],
            [
                'name' => 'LK',
                'label' => 'Lahan Konservasi',
                'color' => '#D35400'
            ],
            [
                'name' => 'Pp2',
                'label' => 'Peruntukan Penggunaan 2',
                'color' => '#1ABC9C'
            ],
            [
                'name' => 'Pp3',
                'label' => 'Peruntukan Penggunaan 3',
                'color' => '#C0392B'
            ],
            [
                'name' => 'Pp1',
                'label' => 'Peruntukan Penggunaan 1',
                'color' => '#5D6D7E'
            ],
            [
                'name' => 'Undef',
                'label' => 'Undefined',
                'color' => '#AAB7B8'
            ],
            [
                'name' => 'HPT',
                'label' => 'Hutan Produksi Terbatas',
                'color' => '#2ECC71'
            ],
            [
                'name' => 'PD',
                'label' => 'Perairan Darat',
                'color' => '#7D3C98'
            ],
            [
                'name' => 'KH',
                'label' => 'Kawasan Hutan',
                'color' => '#AF7AC5'
            ],
            [
                'name' => 'PB',
                'label' => 'Perairan Bebas',
                'color' => '#E74C3C'
            ],
            [
                'name' => 'HP',
                'label' => 'Hutan Produksi',
                'color' => '#3498DB'
            ]
        ];
    }

    public function getProduksiPopulasiData($data)
    {
        $data += [
            'listProduksiTernak' => \App\Models\ProduksiTernak::with(['jenis_ternak_produksi'])
                ->orderBy('tahun', 'desc')
                ->orderBy('id', 'asc')
                ->get(),
            'listPopulasiTernak' => \App\Models\PopulasiTernak::with(['jenis_ternak_populasi'])
                ->orderBy('tahun', 'desc')
                ->get(),
        ];
        return $data;
    }

    public function getDokterUptData($data)
    {
        $data += [
            'listPraktekDokterHewan' => \App\Models\PraktekDokterHewan::with(['kecamatan', 'kelurahan'])
                ->orderBy('nama', 'asc')
                ->get(),
            'listUptPuskeswan' => \App\Models\UptPuskeswan::with(['kecamatan', 'kelurahan'])
                ->orderBy('nama', 'asc')
                ->get(),
        ];
        return $data;
    }

    public function getPriceComparison($request = [])
    {
        try {
            $marketId = $request['market_id'] ?? '';
            $startDate = $request['start_date'] ?? date('Y-m-d', strtotime('-7 days'));
            $endDate = $request['end_date'] ?? date('Y-m-d');
            
            $url = 'https://dirga.bogorkab.go.id/api/v1/price/comparison?' . http_build_query([
                'market_id' => $marketId,
                'start_date' => $startDate,
                'end_date' => $endDate
            ]);
            
            $response = Http::timeout(10)->get($url);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            return ['data' => [], 'error' => 'Failed to fetch data'];
        } catch (\Exception $e) {
            return ['data' => [], 'error' => $e->getMessage()];
        }
    }

    public function getPriceStats($request = [])
    {
        try {
            $commodityId = $request['commodity_id'] ?? 1;
            $date = $request['date'] ?? date('Y-m-d');
            
            $url = 'https://dirga.bogorkab.go.id/api/v1/price/stats?' . http_build_query([
                'commodity_id' => $commodityId,
                'date' => $date
            ]);
            
            $response = Http::timeout(10)->get($url);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            return ['data' => [], 'error' => 'Failed to fetch data'];
        } catch (\Exception $e) {
            return ['data' => [], 'error' => $e->getMessage()];
        }
    }

    public function getMarkets($request = [])
    {
        try {
            // Try multiple possible endpoints for markets
            $endpoints = [
                'https://dirga.bogorkab.go.id/api/v1/markets',
                'https://dirga.bogorkab.go.id/api/v1/market',
                'https://dirga.bogorkab.go.id/api/v1/pasar'
            ];
            
            foreach ($endpoints as $url) {
                try {
                    $response = Http::timeout(5)->get($url);
                    if ($response->successful()) {
                        $data = $response->json();
                        // Handle different response structures
                        if (isset($data['data'])) {
                            return $data;
                        } elseif (is_array($data) && count($data) > 0) {
                            return ['data' => $data];
                        }
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
            
            // If no endpoint works, return empty
            return ['data' => []];
        } catch (\Exception $e) {
            return ['data' => []];
        }
    }

}
