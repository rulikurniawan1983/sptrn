<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\HomeRepository;
use App\Models\UmkmProduct;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $repository;

    public function __construct(HomeRepository $repository, Request $request)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = [
            "meta_title" => "Sistem Perizinan Agrobisnis dan Peternakan",
            "meta_description" => "Sistem Perizinan Agrobisnis dan Peternakan"
        ];
        $data = $this->repository->customIndex($data);
        $data['umkmList'] = User::with(['roles', 'users_kecamatan.kecamatan'])
            ->withCount(['umkm_products' => function($q) {
                $q->where('is_active', 1);
            }])
            ->whereHas('roles', function($q) {
                $q->whereIn('name', ['Peternakan', 'Perikanan', 'User']);
            })
            ->where('is_active', 1)
            ->latest()
            ->get();
        return view('front.home-new', $data);
    }

    public function peternakanFront()
    {
        $products = UmkmProduct::with('user')->where('is_active', 1)->whereHas('user', function($q) {
            $q->where('current_role_id', 101);
        })->latest()->take(4)->get();

        $data = [
            "meta_title" => "Peternakan - Spartan",
            "meta_description" => "Portal informasi peternakan Kabupaten Bogor.",
            "getRuang" => collect($this->repository->getRuang())->map(function($item) {
                return (object)$item;
            })->toArray(),
            "products" => $products
        ];
        return view('front.peternakan-new', $data);
    }

    public function perikananFront()
    {
        $products = UmkmProduct::with('user')->where('is_active', 1)->whereHas('user', function($q) {
            $q->where('current_role_id', 102);
        })->latest()->take(4)->get();

        $data = [
            "meta_title" => "Perikanan - Spartan",
            "meta_description" => "Portal informasi perikanan Kabupaten Bogor.",
            "getRuang" => collect($this->repository->getRuang())->map(function($item) {
                return (object)$item;
            })->toArray(),
            "products" => $products
        ];
        return view('front.perikanan-new', $data);
    }

    public function umkmFront(Request $request)
    {
        $query = UmkmProduct::with(['user.users_kecamatan.kecamatan', 'user.roles'])
            ->where('is_active', 1)
            ->when($request->filled('sektor'), function ($q) use ($request) {
                $q->whereHas('user.roles', function ($q2) use ($request) {
                    $q2->where('name', $request->sektor);
                });
            })
            ->when($request->filled('lokasi'), function ($q) use ($request) {
                $q->whereHas('user.users_kecamatan.kecamatan', function ($q2) use ($request) {
                    $q2->where('nama', $request->lokasi);
                });
            })
            ->latest();

        if ($request->filled('sort') && in_array($request->sort, ['harga_asc', 'harga_desc'])) {
            $query->orderBy('harga', $request->sort === 'harga_asc' ? 'asc' : 'desc');
        }

        $products = $query->paginate(12)->withQueryString();
        
        $umkmList = User::with(['roles', 'users_kecamatan.kecamatan'])
            ->withCount(['umkm_products' => function($q) {
                $q->where('is_active', 1);
            }])
            ->whereHas('roles', function($q) {
                $q->whereIn('name', ['Peternakan', 'Perikanan', 'User']);
            })
            ->where('is_active', 1)
            ->latest()
            ->get();

        $data = [
            "meta_title" => "UMKM - Spartan",
            "meta_description" => "Portal UMKM Kabupaten Bogor.",
            "products" => $products,
            "umkmList" => $umkmList,
            "sektorList" => \App\Models\Role::whereIn('name', ['Peternakan', 'Perikanan', 'User'])->pluck('name', 'name'),
            "lokasiList" => \App\Models\MstKecamatan::orderBy('nama')->pluck('nama', 'nama'),
        ];
        return view('front.umkm-new', $data);
    }

    public function umkmProfile($id)
    {
        $umkm = User::with(['roles', 'users_kecamatan.kecamatan'])
            ->whereHas('roles', function($q) {
                $q->whereIn('name', ['Peternakan', 'Perikanan', 'User']);
            })
            ->findOrFail($id);

        $products = UmkmProduct::where('user_id', $umkm->id)
            ->where('is_active', 1)
            ->latest()
            ->get();

        $data = [
            "meta_title" => "Profil UMKM " . $umkm->name . " — SPARTAN",
            "meta_description" => "Profil resmi dan etalase produk UMKM " . $umkm->name . " terdaftar di Kabupaten Bogor.",
            "umkm" => $umkm,
            "products" => $products,
        ];
        return view('front.umkm-profile', $data);
    }

    public function productDetail($id)
    {
        $productQuery = UmkmProduct::with(['user.roles']);
        if (!auth()->check() || (!auth()->user()->hasRole('Super Admin') && auth()->user()->id !== $productQuery->find($id)?->user_id)) {
            $productQuery->where('is_active', 1);
        }
        $product = $productQuery->findOrFail($id);

        $relatedProducts = UmkmProduct::with('user')
            ->where('is_active', 1)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        $data = [
            "meta_title" => $product->nama_produk . " — Etalase UMKM SPARTAN",
            "meta_description" => substr(strip_tags($product->deskripsi ?? 'Beli ' . $product->nama_produk . ' langsung dari produsen UMKM Kabupaten Bogor.'), 0, 160),
            "product" => $product,
            "relatedProducts" => $relatedProducts,
        ];
        return view('front.umkm-product-detail', $data);
    }

    public function informasiFront()
    {
        $products = UmkmProduct::with('user')->where('is_active', 1)->latest()->take(4)->get();
        $data = [
            "meta_title" => "Informasi - Spartan",
            "meta_description" => "Informasi dan berita Kabupaten Bogor.",
            "products" => $products,
        ];
        return view('front.informasi-new', $data);
    }
    
    public function getDataMap(Request $request)
    {
        $data = $this->repository->getDataMap($request->all());
        return response()->json($data);
    }

    public function getDataSubMap(Request $request)
    {
        $data = $this->repository->getDataSubMap($request->all());
        return response()->json($data);
    }
    
    public function getDataMapSpecific(Request $request)
    {
        $data = $this->repository->getDataMapSpecific($request->all());
        return response()->json($data);
    }

    public function getPriceComparison(Request $request)
    {
        $data = $this->repository->getPriceComparison($request->all());
        return response()->json($data);
    }

    public function getPriceStats(Request $request)
    {
        $data = $this->repository->getPriceStats($request->all());
        return response()->json($data);
    }

    public function getMarkets(Request $request)
    {
        $data = $this->repository->getMarkets($request->all());
        return response()->json($data);
    }

    public function produksiPopulasi()
    {
        $data = [
            "meta_title" => "Produksi & Populasi Ternak - Spartan",
            "meta_description" => "Data produksi dan populasi ternak berdasarkan jenis dan wilayah"
        ];
        $data = $this->repository->getProduksiPopulasiData($data);
        return view('front.produksi-populasi.index', $data);
    }

    public function dokterUpt()
    {
        $data = [
            "meta_title" => "Dokter Hewan & UPT Puskeswan - Spartan",
            "meta_description" => "Informasi praktek dokter hewan dan UPT Puskeswan terverifikasi"
        ];
        $data = $this->repository->getDokterUptData($data);
        return view('front.dokter-upt.index', $data);
    }

    public function nkv()
    {
        $data = [
            "meta_title" => "Rekomendasi Nomor Kontrol Veteriner (NKV) - Spartan",
            "meta_description" => "Informasi lengkap tentang Rekomendasi Nomor Kontrol Veteriner (NKV)"
        ];
        return view('front.nkv.index', $data);
    }

    public function nkvAjukan()
    {
        $data = [
            "meta_title" => "Ajukan Rekomendasi NKV - Spartan",
            "meta_description" => "Form pengajuan Rekomendasi Nomor Kontrol Veteriner (NKV)"
        ];
        return view('front.nkv.ajukan', $data);
    }

    public function nkvSubmit(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nama_tempat_usaha' => 'required|string|max:255',
            'alamat_usaha' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'nib' => 'required|file|max:10240',
            'surat_permohonan' => 'required|file|max:10240',
            'data_umum' => 'required|file|max:10240',
            'sop_sanitasi' => 'required|file|max:10240',
            'surat_pernyataan' => 'required|file|max:10240',
        ]);

        $nkv = \App\Models\RekomendasiNkv::create($request->only([
            'nama_pemohon', 'nama_tempat_usaha', 'alamat_usaha', 'email', 'no_hp'
        ]));

        $fields = ['nib', 'surat_permohonan', 'data_umum', 'sop_sanitasi', 'surat_pernyataan'];
        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $nkv->addMediaFromRequest($field)->toMediaCollection($field);
            }
        }

        return redirect()->route('front.nkv.index')->with('success', 'Pengajuan Rekomendasi NKV berhasil dikirim!');
    }

    public function bukudataPeternakan()
    {
        $data = [
            "title" => "Buku Data Peternakan 2025",
            "pdf_url" => "assets-front-new/bukudata/buku-data-peternakan.pdf"
        ];
        return view('front.bukudata.flipbook', $data);
    }

    public function bukudataPerikanan()
    {
        $data = [
            "title" => "Buku Data Perikanan Kabupaten Bogor Tahun 2025",
            "pdf_url" => "assets-front-new/bukudata/buku-data-perikanan.pdf"
        ];
        return view('front.bukudata.flipbook', $data);
    }
}
