<?php

use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BerkasKeswanController;
use App\Http\Controllers\BerkasPerikananController;
use App\Http\Controllers\BerkasPeternakanController;
use App\Http\Controllers\CategoryIdentityController;
use App\Http\Controllers\CategoryPermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\FasilitasUptController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\JenisGaleriController;
use App\Http\Controllers\JenisKeswanController;
use App\Http\Controllers\JenisPenyakitController;
use App\Http\Controllers\JenisPerikananController;
use App\Http\Controllers\JenisPeternakanController;
use App\Http\Controllers\JenisUsahaController;
use App\Http\Controllers\KbliController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\LandmarkController;
use App\Http\Controllers\LaporanPerikananController;
use App\Http\Controllers\LaporanPeternakanController;
use App\Http\Controllers\LaporanPopulasiTernakController;
use App\Http\Controllers\LayananUptController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedsosController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengesahanBadanHukumController;
use App\Http\Controllers\PerikananBerkasController;
use App\Http\Controllers\PerikananController;
use App\Http\Controllers\PerikananGaleriController;
use App\Http\Controllers\PerikananProduksiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PeternakanBerkasController;
use App\Http\Controllers\PeternakanController;
use App\Http\Controllers\PeternakanGaleriController;
use App\Http\Controllers\PeternakanProduksiController;
use App\Http\Controllers\PraktekDokterHewanBerkasController;
use App\Http\Controllers\PraktekDokterHewanController;
use App\Http\Controllers\PraktekDokterHewanGaleriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SkalaUsahaController;
use App\Http\Controllers\StatusPenyakitController;
use App\Http\Controllers\StatusPenyakitHewanController;
use App\Http\Controllers\StatusPenyakitKasusController;
use App\Http\Controllers\StatusPermodalanController;
use App\Http\Controllers\StatusVerifikasiController;
use App\Http\Controllers\TingkatResikoController;
use App\Http\Controllers\UptPuskeswanController;
use App\Http\Controllers\UptPuskeswanGaleriController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserUmkmController;
use App\Http\Controllers\UsersMenuController;
use App\Http\Controllers\VerificationController;
use App\Models\UptPuskeswan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduksiTernakController;
use App\Http\Controllers\UmkmPengolahanPerikananController;
use App\Http\Controllers\PerizinanController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontHomeController::class, 'index'])->name('front.home.index');
Route::get('peternakan-info', [FrontHomeController::class, 'peternakanFront'])->name('front.peternakan-info');
Route::get('perikanan-info', [FrontHomeController::class, 'perikananFront'])->name('front.perikanan-info');
Route::get('umkm-info', [FrontHomeController::class, 'umkmFront'])->name('front.umkm-info');
Route::get('umkm-profil/{id}', [FrontHomeController::class, 'umkmProfile'])->name('front.umkm-profile');
Route::get('umkm-produk/{id}', [FrontHomeController::class, 'productDetail'])->name('front.umkm-product-detail');
Route::get('informasi-info', [FrontHomeController::class, 'informasiFront'])->name('front.informasi-info');
Route::get('home/get-data-map', [FrontHomeController::class, 'getDataMap'])->name('home.get-data-map');
Route::get('home/get-data-sub-map', [FrontHomeController::class, 'getDataSubMap'])->name('home.get-data-sub-map');
Route::get('home/get-data-map-specific', [FrontHomeController::class, 'getDataMapSpecific'])->name('home.get-data-map-specific');
Route::get('home/get-price-comparison', [FrontHomeController::class, 'getPriceComparison'])->name('home.get-price-comparison');
Route::get('home/get-price-stats', [FrontHomeController::class, 'getPriceStats'])->name('home.get-price-stats');
Route::get('home/get-markets', [FrontHomeController::class, 'getMarkets'])->name('home.get-markets');
Route::get('home', [FrontHomeController::class, 'index'])->name('home.index');
Route::get('produksi-populasi-ternak', [FrontHomeController::class, 'produksiPopulasi'])->name('front.produksi-populasi.index');
Route::get('dokter-hewan-upt', [FrontHomeController::class, 'dokterUpt'])->name('front.dokter-upt.index');
Route::get('nkv', [FrontHomeController::class, 'nkv'])->name('front.nkv.index');
Route::get('nkv/ajukan', [FrontHomeController::class, 'nkvAjukan'])->name('front.nkv.ajukan');
Route::post('nkv/ajukan', [FrontHomeController::class, 'nkvSubmit'])->name('front.nkv.submit');
Route::get('bukudata-peternakan', [FrontHomeController::class, 'bukudataPeternakan'])->name('front.bukudata.peternakan');
Route::get('bukudata-perikanan', [FrontHomeController::class, 'bukudataPerikanan'])->name('front.bukudata.perikanan');

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'action'])->name('login.action');
Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::get('register', [SignupController::class, 'index'])->name('register');
Route::post('daftar', [SignupController::class, 'action'])->name('register.action');

Route::get('verify-email/{token}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('resend-verification-email', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name("password.request");
Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');


Route::get('kelurahan', [GeneralController::class, 'kelurahan'])->name('general.kelurahan');

Route::group(['middleware' => 'auth'], function () {
    Route::middleware(['can:Dashboard Show'])->group(function () {
        Route::resource('dashboard', DashboardController::class)->middleware('disable.methods:create,edit,store,update,delete');
        Route::get('faq', [DashboardController::class, 'faq'])->name('faq.index');
    });

    Route::middleware(['can:Kecamatan Show'])->group(function () {
        Route::get('kecamatan/export', [KecamatanController::class, 'export'])->name('kecamatan.export');
        Route::resource('kecamatan', KecamatanController::class);
        Route::post('kecamatan/table', [KecamatanController::class, 'table'])->name('kecamatan.table');
        Route::post('kecamatan/destroy-selected', [KecamatanController::class, 'destroy_selected'])->name("kecamatan.destroy-selected");

        Route::get('landmark/export', [LandmarkController::class, 'export'])->name('landmark.export');
        Route::resource('landmark', LandmarkController::class);
        Route::post('landmark/table', [LandmarkController::class, 'table'])->name('landmark.table');
        Route::post('landmark/destroy-selected', [LandmarkController::class, 'destroy_selected'])->name("landmark.destroy-selected");
    });

    Route::middleware(['can:Desa Show'])->group(function () {
        Route::get('desa/export', [DesaController::class, 'export'])->name('desa.export');
        Route::resource('desa', DesaController::class);
        Route::post('desa/table', [DesaController::class, 'table'])->name('desa.table');
        Route::post('desa/destroy-selected', [DesaController::class, 'destroy_selected'])->name("desa.destroy-selected");
    });

    Route::middleware(['can:Pendidikan Show'])->group(function () {
        Route::get('pendidikan/export', [PendidikanController::class, 'export'])->name('pendidikan.export');
        Route::resource('pendidikan', PendidikanController::class);
        Route::post('pendidikan/table', [PendidikanController::class, 'table'])->name('pendidikan.table');
        Route::post('pendidikan/destroy-selected', [PendidikanController::class, 'destroy_selected'])->name("pendidikan.destroy-selected");
    });

    Route::middleware(['can:Kbli Show'])->group(function () {
        Route::resource('kbli', KbliController::class)->middleware('disable.methods:create,store,edit,update');
        Route::post('kbli/table', [KbliController::class, 'table'])->name("kbli.table");
        Route::post('kbli/destroy-selected', [KbliController::class, 'destroy_selected'])->name("kbli.destroy-selected");
    });

    Route::middleware(['can:Jenis Usaha Show'])->group(function () {
        Route::resource('jenis-usaha', JenisUsahaController::class);
        Route::post('jenis-usaha/table', [JenisUsahaController::class, 'table'])->name("jenis-usaha.table");
        Route::post('jenis-usaha/destroy-selected', [JenisUsahaController::class, 'destroy_selected'])->name("jenis-usaha.destroy-selected");
    });

    Route::middleware(['can:Tingkat Resiko Show'])->group(function () {
        Route::resource('tingkat-resiko', TingkatResikoController::class);
        Route::post('tingkat-resiko/table', [TingkatResikoController::class, 'table'])->name("tingkat-resiko.table");
        Route::post('tingkat-resiko/destroy-selected', [TingkatResikoController::class, 'destroy_selected'])->name("tingkat-resiko.destroy-selected");
    });

    Route::middleware(['can:Skala Usaha Show'])->group(function () {
        Route::resource('skala-usaha', SkalaUsahaController::class);
        Route::post('skala-usaha/table', [SkalaUsahaController::class, 'table'])->name("skala-usaha.table");
        Route::post('skala-usaha/destroy-selected', [SkalaUsahaController::class, 'destroy_selected'])->name("skala-usaha.destroy-selected");
    });

    Route::middleware(['can:Status Verifikasi Show'])->group(function () {
        Route::resource('status-verifikasi', StatusVerifikasiController::class);
        Route::post('status-verifikasi/table', [StatusVerifikasiController::class, 'table'])->name("status-verifikasi.table");
        Route::post('status-verifikasi/destroy-selected', [StatusVerifikasiController::class, 'destroy_selected'])->name("status-verifikasi.destroy-selected");
    });

    Route::middleware(['can:Status Permodalan Show'])->group(function () {
        Route::resource('status-permodalan', StatusPermodalanController::class);
        Route::post('status-permodalan/table', [StatusPermodalanController::class, 'table'])->name("status-permodalan.table");
        Route::post('status-permodalan/destroy-selected', [StatusPermodalanController::class, 'destroy_selected'])->name("status-permodalan.destroy-selected");
    });

    Route::middleware(['can:Satuan Show'])->group(function () {
        Route::resource('satuan', SatuanController::class);
        Route::post('satuan/table', [SatuanController::class, 'table'])->name("satuan.table");
        Route::post('satuan/destroy-selected', [SatuanController::class, 'destroy_selected'])->name("satuan.destroy-selected");
    });

    Route::middleware(['can:Pengesahan Badan Hukum Show'])->group(function () {
        Route::resource('pengesahan-badan-hukum', PengesahanBadanHukumController::class);
        Route::post('pengesahan-badan-hukum/table', [PengesahanBadanHukumController::class, 'table'])->name("pengesahan-badan-hukum.table");
        Route::post('pengesahan-badan-hukum/destroy-selected', [PengesahanBadanHukumController::class, 'destroy_selected'])->name("pengesahan-badan-hukum.destroy-selected");
    });

    Route::middleware(['can:Jenis Galeri Show'])->group(function () {
        Route::resource('jenis-galeri', JenisGaleriController::class);
        Route::post('jenis-galeri/table', [JenisGaleriController::class, 'table'])->name("jenis-galeri.table");
        Route::post('jenis-galeri/destroy-selected', [JenisGaleriController::class, 'destroy_selected'])->name("jenis-galeri.destroy-selected");
    });

    Route::middleware(['can:Peternakan Show'])->group(function () {
        Route::get('peternakan/format-export', [PeternakanController::class, 'format_export'])->name("peternakan.format-export");
        Route::get('peternakan/referensi-export', [PeternakanController::class, 'referensi_export'])->name("peternakan.referensi-export");
        Route::post('peternakan/import', [PeternakanController::class, 'import'])->name("peternakan.import");
        Route::resource('peternakan', PeternakanController::class);
        Route::post('peternakan/table', [PeternakanController::class, 'table'])->name("peternakan.table");
        Route::post('peternakan/destroy-selected', [PeternakanController::class, 'destroy_selected'])->name("peternakan.destroy-selected");

        Route::middleware(['can:Peternakan Berkas Show'])->group(function () {
            Route::resource('peternakan-berkas', PeternakanBerkasController::class);
            Route::post('peternakan-berkas/table', [PeternakanBerkasController::class, 'table'])->name('peternakan-berkas.table');
            Route::post('peternakan-berkas/destroy-selected', [PeternakanBerkasController::class, 'destroy_selected'])->name("peternakan-berkas.destroy-selected");
        });

        Route::middleware(['can:Peternakan Produksi Show'])->group(function () {
            Route::resource('peternakan-produksi', PeternakanProduksiController::class);
            Route::post('peternakan-produksi/table', [PeternakanProduksiController::class, 'table'])->name('peternakan-produksi.table');
            Route::post('peternakan-produksi/destroy-selected', [PeternakanProduksiController::class, 'destroy_selected'])->name("peternakan-produksi.destroy-selected");
        });

        Route::middleware(['can:Peternakan Galeri Show'])->group(function () {
            Route::get('peternakan-galeri/create-multiple', [PeternakanGaleriController::class, 'create_multiple'])->name('peternakan-galeri.create-multiple');
            Route::resource('peternakan-galeri', PeternakanGaleriController::class);
            Route::post('peternakan-galeri/destroy-selected', [PeternakanGaleriController::class, 'destroy_selected'])->name("peternakan-galeri.destroy-selected");
        });

        Route::middleware(['can:Jenis Produksi Show'])->group(function () {
            Route::resource('jenis-produksi', \App\Http\Controllers\JenisProduksiController::class);
            Route::post('jenis-produksi/table', [\App\Http\Controllers\JenisProduksiController::class, 'table'])->name('jenis-produksi.table');
            Route::post('jenis-produksi/destroy-selected', [\App\Http\Controllers\JenisProduksiController::class, 'destroy_selected'])->name('jenis-produksi.destroy-selected');
        });

        Route::middleware(['can:Jenis Ternak Produksi Show'])->group(function () {
            Route::resource('jenis-ternak-produksi', \App\Http\Controllers\JenisTernakProduksiController::class);
            Route::post('jenis-ternak-produksi/table', [\App\Http\Controllers\JenisTernakProduksiController::class, 'table'])->name('jenis-ternak-produksi.table');
            Route::post('jenis-ternak-produksi/destroy-selected', [\App\Http\Controllers\JenisTernakProduksiController::class, 'destroy_selected'])->name('jenis-ternak-produksi.destroy-selected');
        });

        Route::middleware(['can:Jenis Ternak Populasi Show'])->group(function () {
            Route::resource('jenis-ternak-populasi', \App\Http\Controllers\JenisTernakPopulasiController::class);
            Route::post('jenis-ternak-populasi/table', [\App\Http\Controllers\JenisTernakPopulasiController::class, 'table'])->name('jenis-ternak-populasi.table');
            Route::post('jenis-ternak-populasi/destroy-selected', [\App\Http\Controllers\JenisTernakPopulasiController::class, 'destroy_selected'])->name('jenis-ternak-populasi.destroy-selected');
        });

        Route::middleware(['can:Populasi Ternak Show'])->group(function () {
            Route::resource('populasi-ternak', \App\Http\Controllers\PopulasiTernakController::class);
            Route::post('populasi-ternak/table', [\App\Http\Controllers\PopulasiTernakController::class, 'table'])->name('populasi-ternak.table');
            Route::post('populasi-ternak/destroy-selected', [\App\Http\Controllers\PopulasiTernakController::class, 'destroy_selected'])->name('populasi-ternak.destroy-selected');
        });

        Route::middleware(['can:Data Produksi Ternak Show'])->group(function () {
            Route::resource('data-produksi-ternak', ProduksiTernakController::class);
            Route::post('data-produksi-ternak/table', [ProduksiTernakController::class, 'table'])->name('data-produksi-ternak.table');
            Route::post('data-produksi-ternak/destroy-selected', [ProduksiTernakController::class, 'destroy_selected'])->name('data-produksi-ternak.destroy-selected');
        });
    });

    Route::middleware(['can:Jenis Peternakan Show'])->group(function () {
        Route::resource('jenis-peternakan', JenisPeternakanController::class);
        Route::post('jenis-peternakan/table', [JenisPeternakanController::class, 'table'])->name('jenis-peternakan.table');
        Route::post('jenis-peternakan/destroy-selected', [JenisPeternakanController::class, 'destroy_selected'])->name("jenis-peternakan.destroy-selected");
    });

    Route::middleware(['can:Berkas Peternakan Show'])->group(function () {
        Route::resource('berkas-peternakan', BerkasPeternakanController::class);
        Route::post('berkas-peternakan/table', [BerkasPeternakanController::class, 'table'])->name('berkas-peternakan.table');
        Route::post('berkas-peternakan/destroy-selected', [BerkasPeternakanController::class, 'destroy_selected'])->name("berkas-peternakan.destroy-selected");
    });

    Route::middleware(['can:Perikanan Show'])->group(function () {
        Route::get('perikanan/format-export', [PerikananController::class, 'format_export'])->name("perikanan.format-export");
        Route::get('perikanan/referensi-export', [PerikananController::class, 'referensi_export'])->name("perikanan.referensi-export");
        Route::post('perikanan/import', [PerikananController::class, 'import'])->name("perikanan.import");
        Route::resource('perikanan', PerikananController::class);
        Route::post('perikanan/table', [PerikananController::class, 'table'])->name("perikanan.table");
        Route::post('perikanan/destroy-selected', [PerikananController::class, 'destroy_selected'])->name("perikanan.destroy-selected");

        Route::middleware(['can:Perikanan Berkas Show'])->group(function () {
            Route::resource('perikanan-berkas', PerikananBerkasController::class);
            Route::post('perikanan-berkas/table', [PerikananBerkasController::class, 'table'])->name('perikanan-berkas.table');
            Route::post('perikanan-berkas/destroy-selected', [PerikananBerkasController::class, 'destroy_selected'])->name("perikanan-berkas.destroy-selected");
        });

        Route::middleware(['can:Perikanan Produksi Show'])->group(function () {
            Route::resource('perikanan-produksi', PerikananProduksiController::class);
            Route::post('perikanan-produksi/table', [PerikananProduksiController::class, 'table'])->name('perikanan-produksi.table');
            Route::post('perikanan-produksi/destroy-selected', [PerikananProduksiController::class, 'destroy_selected'])->name("perikanan-produksi.destroy-selected");
        });

        Route::middleware(['can:Perikanan Galeri Show'])->group(function () {
            Route::get('perikanan-galeri/create-multiple', [PerikananGaleriController::class, 'create_multiple'])->name('perikanan-galeri.create-multiple');
            Route::resource('perikanan-galeri', PerikananGaleriController::class);
            Route::post('perikanan-galeri/destroy-selected', [PerikananGaleriController::class, 'destroy_selected'])->name("perikanan-galeri.destroy-selected");
        });
    });

    Route::middleware(['can:Jenis Perikanan Show'])->group(function () {
        Route::resource('jenis-perikanan', JenisPerikananController::class);
        Route::post('jenis-perikanan/table', [JenisPerikananController::class, 'table'])->name('jenis-perikanan.table');
        Route::post('jenis-perikanan/destroy-selected', [JenisPerikananController::class, 'destroy_selected'])->name("jenis-perikanan.destroy-selected");
    });

    Route::middleware(['can:Berkas Perikanan Show'])->group(function () {
        Route::resource('berkas-perikanan', BerkasPerikananController::class);
        Route::post('berkas-perikanan/table', [BerkasPerikananController::class, 'table'])->name('berkas-perikanan.table');
        Route::post('berkas-perikanan/destroy-selected', [BerkasPerikananController::class, 'destroy_selected'])->name("berkas-perikanan.destroy-selected");
    });

    Route::middleware(['can:Fasilitas Upt Show'])->group(function () {
        Route::resource('fasilitas-upt', FasilitasUptController::class);
        Route::post('fasilitas-upt/table', [FasilitasUptController::class, 'table'])->name('fasilitas-upt.table');
        Route::post('fasilitas-upt/destroy-selected', [FasilitasUptController::class, 'destroy_selected'])->name("fasilitas-upt.destroy-selected");
    });

    Route::middleware(['can:Layanan Upt Show'])->group(function () {
        Route::resource('layanan-upt', LayananUptController::class);
        Route::post('layanan-upt/table', [LayananUptController::class, 'table'])->name('layanan-upt.table');
        Route::post('layanan-upt/destroy-selected', [LayananUptController::class, 'destroy_selected'])->name("layanan-upt.destroy-selected");
    });

    Route::middleware(['can:Jenis Penyakit Show'])->group(function () {
        Route::resource('jenis-penyakit', JenisPenyakitController::class);
        Route::post('jenis-penyakit/table', [JenisPenyakitController::class, 'table'])->name('jenis-penyakit.table');
        Route::post('jenis-penyakit/destroy-selected', [JenisPenyakitController::class, 'destroy_selected'])->name("jenis-penyakit.destroy-selected");
    });

    Route::middleware(['can:Status Penyakit Show'])->group(function () {
        Route::get('status-penyakit/format-export', [StatusPenyakitController::class, 'format_export'])->name("status-penyakit.format-export");
        Route::get('status-penyakit/referensi-export', [StatusPenyakitController::class, 'referensi_export'])->name("status-penyakit.referensi-export");
        Route::post('status-penyakit/import', [StatusPenyakitController::class, 'import'])->name("status-penyakit.import");
        Route::resource('status-penyakit', StatusPenyakitController::class);
        Route::post('status-penyakit/table', [StatusPenyakitController::class, 'table'])->name("status-penyakit.table");
        Route::post('status-penyakit/destroy-selected', [StatusPenyakitController::class, 'destroy_selected'])->name("status-penyakit.destroy-selected");

        Route::middleware(['can:Status Penyakit Hewan Show'])->group(function () {
            Route::resource('status-penyakit-hewan', StatusPenyakitHewanController::class);
            Route::post('status-penyakit-hewan/table', [StatusPenyakitHewanController::class, 'table'])->name('status-penyakit-hewan.table');
            Route::post('status-penyakit-hewan/destroy-selected', [StatusPenyakitHewanController::class, 'destroy_selected'])->name("status-penyakit-hewan.destroy-selected");
        });

        Route::middleware(['can:Status Penyakit Kasus Show'])->group(function () {
            Route::resource('status-penyakit-kasus', StatusPenyakitKasusController::class);
            Route::post('status-penyakit-kasus/table', [StatusPenyakitKasusController::class, 'table'])->name('status-penyakit-kasus.table');
            Route::post('status-penyakit-kasus/destroy-selected', [StatusPenyakitKasusController::class, 'destroy_selected'])->name("status-penyakit-kasus.destroy-selected");
        });
    });

    Route::middleware(['can:Jenis Keswan Show'])->group(function () {
        Route::resource('jenis-keswan', JenisKeswanController::class);
        Route::post('jenis-keswan/table', [JenisKeswanController::class, 'table'])->name('jenis-keswan.table');
        Route::post('jenis-keswan/destroy-selected', [JenisKeswanController::class, 'destroy_selected'])->name("jenis-keswan.destroy-selected");
    });

    Route::middleware(['can:Rekomendasi Nkv Show'])->group(function () {
        Route::resource('rekomendasi-nkv', \App\Http\Controllers\RekomendasiNkvController::class);
        Route::post('rekomendasi-nkv/table', [\App\Http\Controllers\RekomendasiNkvController::class, 'table'])->name('rekomendasi-nkv.table');
        Route::post('rekomendasi-nkv/destroy-selected', [\App\Http\Controllers\RekomendasiNkvController::class, 'destroy_selected'])->name('rekomendasi-nkv.destroy-selected');
    });

    Route::middleware(['can:Praktek Dokter Hewan Show'])->group(function () {
        Route::get('praktek-dokter-hewan/format-export', [PraktekDokterHewanController::class, 'format_export'])->name("praktek-dokter-hewan.format-export");
        Route::get('praktek-dokter-hewan/referensi-export', [PraktekDokterHewanController::class, 'referensi_export'])->name("praktek-dokter-hewan.referensi-export");
        Route::post('praktek-dokter-hewan/import', [PraktekDokterHewanController::class, 'import'])->name("praktek-dokter-hewan.import");
        Route::resource('praktek-dokter-hewan', PraktekDokterHewanController::class);
        Route::post('praktek-dokter-hewan/table', [PraktekDokterHewanController::class, 'table'])->name("praktek-dokter-hewan.table");
        Route::post('praktek-dokter-hewan/destroy-selected', [PraktekDokterHewanController::class, 'destroy_selected'])->name("praktek-dokter-hewan.destroy-selected");

        Route::middleware(['can:Praktek Dokter Hewan Berkas Show'])->group(function () {
            Route::resource('praktek-dokter-hewan-berkas', PraktekDokterHewanBerkasController::class);
            Route::post('praktek-dokter-hewan-berkas/table', [PraktekDokterHewanBerkasController::class, 'table'])->name('praktek-dokter-hewan-berkas.table');
            Route::post('praktek-dokter-hewan-berkas/destroy-selected', [PraktekDokterHewanBerkasController::class, 'destroy_selected'])->name("praktek-dokter-hewan-berkas.destroy-selected");
        });

        Route::middleware(['can:Praktek Dokter Hewan Galeri Show'])->group(function () {
            Route::get('praktek-dokter-hewan-galeri/create-multiple', [PraktekDokterHewanGaleriController::class, 'create_multiple'])->name('praktek-dokter-hewan-galeri.create-multiple');
            Route::resource('praktek-dokter-hewan-galeri', PraktekDokterHewanGaleriController::class);
            Route::post('praktek-dokter-hewan-galeri/destroy-selected', [PraktekDokterHewanGaleriController::class, 'destroy_selected'])->name("praktek-dokter-hewan-galeri.destroy-selected");
        });
    });


    Route::middleware(['can:Upt Puskeswan Show'])->group(function () {
        Route::get('upt-puskeswan/format-export', [UptPuskeswanController::class, 'format_export'])->name("upt-puskeswan.format-export");
        Route::get('upt-puskeswan/referensi-export', [UptPuskeswanController::class, 'referensi_export'])->name("upt-puskeswan.referensi-export");
        Route::post('upt-puskeswan/import', [UptPuskeswanController::class, 'import'])->name("upt-puskeswan.import");
        Route::resource('upt-puskeswan', UptPuskeswanController::class);
        Route::post('upt-puskeswan/table', [UptPuskeswanController::class, 'table'])->name("upt-puskeswan.table");
        Route::post('upt-puskeswan/destroy-selected', [UptPuskeswanController::class, 'destroy_selected'])->name("upt-puskeswan.destroy-selected");

        Route::middleware(['can:Upt Puskeswan Galeri Show'])->group(function () {
            Route::get('upt-puskeswan-galeri/create-multiple', [UptPuskeswanGaleriController::class, 'create_multiple'])->name('upt-puskeswan-galeri.create-multiple');
            Route::resource('upt-puskeswan-galeri', UptPuskeswanGaleriController::class);
            Route::post('upt-puskeswan-galeri/destroy-selected', [UptPuskeswanGaleriController::class, 'destroy_selected'])->name("upt-puskeswan-galeri.destroy-selected");
        });
    });

    Route::middleware(['can:Berkas Keswan Show'])->group(function () {
        Route::resource('berkas-keswan', BerkasKeswanController::class);
        Route::post('berkas-keswan/table', [BerkasKeswanController::class, 'table'])->name('berkas-keswan.table');
        Route::post('berkas-keswan/destroy-selected', [BerkasKeswanController::class, 'destroy_selected'])->name("berkas-keswan.destroy-selected");
    });

    Route::middleware(['can:Laporan Peternakan Show'])->group(function () {
        Route::get('laporan-peternakan/export', [LaporanPeternakanController::class, 'export'])->name('laporan-peternakan.export');
        Route::resource('laporan-peternakan', LaporanPeternakanController::class);
        Route::post('laporan-peternakan/table', [LaporanPeternakanController::class, 'table'])->name('laporan-peternakan.table');
    });

    Route::middleware(['can:Laporan Perikanan Show'])->group(function () {
        Route::get('laporan-perikanan/export', [LaporanPerikananController::class, 'export'])->name('laporan-perikanan.export');
        Route::resource('laporan-perikanan', LaporanPerikananController::class);
        Route::post('laporan-perikanan/table', [LaporanPerikananController::class, 'table'])->name('laporan-perikanan.table');
    });

    Route::middleware(['can:Laporan Produksi Ternak Show'])->group(function () {
        Route::get('laporan-produksi-ternak/export', [\App\Http\Controllers\LaporanProduksiTernakController::class, 'export'])->name('laporan-produksi-ternak.export');
        Route::resource('laporan-produksi-ternak', \App\Http\Controllers\LaporanProduksiTernakController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::post('laporan-produksi-ternak/table', [\App\Http\Controllers\LaporanProduksiTernakController::class, 'table'])->name('laporan-produksi-ternak.table');
    });

    Route::middleware(['can:Laporan Populasi Ternak Show'])->group(function () {
        Route::get('laporan-populasi-ternak/export', [LaporanPopulasiTernakController::class, 'export'])->name('laporan-populasi-ternak.export');
        Route::resource('laporan-populasi-ternak', LaporanPopulasiTernakController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
        Route::post('laporan-populasi-ternak/table', [LaporanPopulasiTernakController::class, 'table'])->name('laporan-populasi-ternak.table');
    });

    Route::middleware(['can:Identity Show'])->group(function () {
        Route::resource('category-identity', CategoryIdentityController::class)->middleware('disable.methods:index');

        Route::post('identity/save', [IdentityController::class, 'save'])->name("identity.save");
        Route::resource('identity', IdentityController::class);
    });

    Route::middleware(['can:Medsos Show'])->group(function () {
        Route::resource('medsos', MedsosController::class);
        Route::post('medsos/table', [MedsosController::class, 'table'])->name('medsos.table');
        Route::post('medsos/destroy-selected', [MedsosController::class, 'destroy_selected'])->name("medsos.destroy-selected");
    });

    Route::middleware(['can:Users Show'])->group(function () {
        Route::resource('users', UsersController::class);
        Route::post('users/table', [UsersController::class, 'table'])->name('users.table');
        Route::post('users/destroy-selected', [UsersController::class, 'destroy_selected'])->name("users.destroy-selected");
        Route::post('users/login-as/{id}', [UsersController::class, 'login_as'])->name("users.login-as")->middleware('can:Users Login As');
    });

    Route::middleware(['can:User Umkm Show'])->group(function () {
        Route::get('user-umkm/download-nib/{id}', [UserUmkmController::class, 'downloadNib'])->name('user-umkm.download-nib');
        Route::resource('user-umkm', UserUmkmController::class);
        Route::post('user-umkm/table', [UserUmkmController::class, 'table'])->name('user-umkm.table');
        Route::post('user-umkm/verify/{id}', [UserUmkmController::class, 'verify'])->name('user-umkm.verify');
        Route::post('user-umkm/destroy-selected', [UserUmkmController::class, 'destroy_selected'])->name("user-umkm.destroy-selected");
    });

    Route::middleware(['can:Role Show'])->group(function () {
        Route::resource('role', RoleController::class);
        Route::post('role/table', [RoleController::class, 'table'])->name('role.table');
        Route::post('role/destroy-selected', [RoleController::class, 'destroy_selected'])->name("role.destroy-selected");
        Route::get('role/set-permission/{id}', [RoleController::class, 'set_permission'])->name('role.set-permission');
        Route::post('role/set-permission', [RoleController::class, 'set_permission_action'])->name('role.set-permission-action');
    });

    Route::middleware(['can:Users Menu Show'])->group(function () {
        Route::resource('users-menu', UsersMenuController::class);
        Route::post('users-menu/destroy-selected', [UsersMenuController::class, 'destroy_selected'])->name("users-menu.destroy-selected");
    });

    Route::middleware(['can:Permission Show'])->group(function () {
        Route::resource('category-permission', CategoryPermissionController::class)->middleware('disable.methods:index');
        Route::resource('permission', PermissionController::class);
        Route::post('permission/table', [PermissionController::class, 'table'])->name("permission.table");
    });

    Route::middleware(['can:Activity Log Show'])->group(function () {
        Route::resource('activity-log', ActivityLogController::class)->middleware('disable.methods:create,store,edit,update');
        Route::post('activity-log/table', [ActivityLogController::class, 'table'])->name("activity-log.table");
        Route::post('activity-log/destroy-selected', [ActivityLogController::class, 'destroy_selected'])->name("activity-log.destroy-selected");
    });

    Route::get('akses-file/{direktori}/{file_name}', [GeneralController::class, 'access_file'])->name('general.akses-file');

    Route::middleware(['can:Profile Show'])->group(function () {
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/ganti-password', [ProfileController::class, 'ganti_password'])->name('profile.ganti-password');
        Route::post('profile/ganti-password', [ProfileController::class, 'ganti_password_action'])->name('profile.ganti-password-action');
    });

    Route::post('profile/change-role', [ProfileController::class, 'change_role'])->name("change-role.action")->middleware('can:Profile Change Role');

    Route::middleware(['can:Umkm Pengolahan Perikanan Show'])->group(function () {
        Route::resource('umkm-pengolahan-perikanan', \App\Http\Controllers\UmkmPengolahanPerikananController::class);
        Route::post('umkm-pengolahan-perikanan/table', [\App\Http\Controllers\UmkmPengolahanPerikananController::class, 'table'])->name('umkm-pengolahan-perikanan.table');
        Route::post('umkm-pengolahan-perikanan/destroy-selected', [\App\Http\Controllers\UmkmPengolahanPerikananController::class, 'destroy_selected'])->name('umkm-pengolahan-perikanan.destroy-selected');
    });

    Route::middleware(['can:Umkm Product Show'])->group(function () {
        Route::resource('umkm-product', \App\Http\Controllers\UmkmProductController::class);
        Route::post('umkm-product/table', [\App\Http\Controllers\UmkmProductController::class, 'table'])->name('umkm-product.table');
        Route::post('umkm-product/verify/{id}', [\App\Http\Controllers\UmkmProductController::class, 'verify'])->name('umkm-product.verify');
        Route::post('umkm-product/destroy-selected', [\App\Http\Controllers\UmkmProductController::class, 'destroy_selected'])->name('umkm-product.destroy-selected');
    });

    Route::middleware(['can:Umkm Legalitas Show'])->group(function () {
        Route::resource('umkm-legalitas', \App\Http\Controllers\UmkmLegalitasController::class);
        Route::post('umkm-legalitas/table', [\App\Http\Controllers\UmkmLegalitasController::class, 'table'])->name('umkm-legalitas.table');
        Route::post('umkm-legalitas/verify/{id}', [\App\Http\Controllers\UmkmLegalitasController::class, 'verify'])->name('umkm-legalitas.verify');
        Route::post('umkm-legalitas/destroy-selected', [\App\Http\Controllers\UmkmLegalitasController::class, 'destroy_selected'])->name('umkm-legalitas.destroy-selected');
    });

    Route::middleware(['can:Perizinan Show'])->group(function () {
        Route::get('perizinan', [PerizinanController::class, 'index'])->name('perizinan.index');
        Route::post('perizinan', [PerizinanController::class, 'store'])->name('perizinan.store');
        Route::delete('perizinan/{id}', [PerizinanController::class, 'destroy'])->name('perizinan.destroy');
    });
});



Route::group(['prefix' => 'migrasi'], function () {
    Route::get("permission-seeder", function () {
        if (auth()->check()) {
            Artisan::call('db:seed', ['--class' => 'CategoryPermissionSeeder', '--force' => true]);
            // Artisan::call('db:seed', ['--class' => 'PermissionSeeder', '--force' => true]);
            dd("selesai");
        }
        dd("fail");
    });

    Route::get("users-menu-seeder", function () {
        if (auth()->check()) {
            Artisan::call('db:seed', ['--class' => 'UsersMenuSeeder', '--force' => true]);
            dd("selesai");
        }
        dd("fail");
    });
});
