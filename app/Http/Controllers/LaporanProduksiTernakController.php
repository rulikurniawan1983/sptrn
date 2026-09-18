<?php

namespace App\Http\Controllers;

use App\Exports\LaporanProduksiTernakExport;
use App\Repositories\LaporanProduksiTernakRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Maatwebsite\Excel\Facades\Excel;

class LaporanProduksiTernakController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $request;
    private $export;

    public function __construct(LaporanProduksiTernakRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = Request::createFromBase($request);
        $this->initialize();
        $this->commonData['kode_first_menu'] = $this->kode_menu;
        $this->commonData['kode_second_menu'] = null;
    }

    public static function middleware(): array
    {
        $className = class_basename(__CLASS__);
        $permission = str_replace('Controller', '', $className);
        $permission = trim(implode(' ', preg_split('/(?=[A-Z])/', $permission)));
        return [
            new Middleware("can:$permission Add", only: ['create', 'store']),
            new Middleware("can:$permission Detail", only: ['show']),
            new Middleware("can:$permission Edit", only: ['edit', 'update']),
            new Middleware("can:$permission Delete", only: ['destroy', 'destroy_selected']),
        ];
    }

    public function export()
    {
        $repo = app(LaporanProduksiTernakRepository::class);
        $data = $repo->customIndex(request()->all());
        return Excel::download(
            new LaporanProduksiTernakExport(
                $data['listTahun'],
                $data['listJenisProduksi'],
                $data['listJenisTernakProduksi'],
                $data['dataProduksi']
            ),
            'laporan-produksi-ternak.xlsx'
        );
    }

    public function index(Request $request)
    {
        $data = $this->repository->customIndex($this->commonData);
        $data['reportTable'] = $this->repository->customDataDatatable($request->all());
        return view('laporan-produksi-ternak.index', $data);
    }
}