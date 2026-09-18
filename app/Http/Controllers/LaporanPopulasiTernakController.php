<?php

namespace App\Http\Controllers;

use App\Exports\LaporanPopulasiTernakExport;
use App\Repositories\LaporanPopulasiTernakRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class LaporanPopulasiTernakController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $request;
    private $export;

    public function __construct(LaporanPopulasiTernakRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request    = Request::createFromBase($request);
        $this->initialize();
        $this->commonData['kode_first_menu']  = $this->kode_menu;
        $this->commonData['kode_second_menu'] = null;
    }

    public static function middleware(): array
    {
        $className  = class_basename(__CLASS__);
        $permission = str_replace('Controller', '', $className);
        $permission = trim(implode(' ', preg_split('/(?=[A-Z])/', $permission)));
        return [
            new Middleware("can:$permission Add", only: ['create', 'store']),
            new Middleware("can:$permission Detail", only: ['show']),
            new Middleware("can:$permission Edit", only: ['edit', 'update']),
            new Middleware("can:$permission Delete", only: ['destroy', 'destroy_selected']),
        ];
    }
    
    public function table(Request $request)
    {
        $data = $this->repository->customDataDatatable($request->all());
        return DataTables::of($data)
            ->rawColumns([0, 1, 2, 3, 4])
            ->make(true);
    }

    public function export()
    {
        $repo = app(LaporanPopulasiTernakRepository::class);
        $data = $repo->customIndex(request()->all());
        return Excel::download(
            new LaporanPopulasiTernakExport(
                $data['listTahun'],
                $data['listJenisTernakPopulasi'],
                $data['dataPopulasi']
            ),
            'laporan-populasi-ternak.xlsx'
        );
    }

    public function index(Request $request)
    {
        $data = $this->commonData + $request->all();
        $data = $this->repository->customIndex($data);
        return view($this->route . '.index', $data);
    }
} 