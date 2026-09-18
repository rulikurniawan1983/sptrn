<?php

namespace App\Http\Controllers;

use App\Exports\PerikananFormatExport;
use App\Exports\PerikananReferensiExport;
use App\Http\Requests\PerikananRequest;
use App\Imports\PerikananImport;
use App\Repositories\PerikananRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Maatwebsite\Excel\Facades\Excel;

class PerikananController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $request;

    public function __construct(PerikananRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request    = PerikananRequest::createFromBase($request);
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

    public function format_export(Request $request)
    {
        return Excel::download(new PerikananFormatExport(), "format-import-perikanan.xlsx");
    }

    public function referensi_export(Request $request)
    {
        return Excel::download(new PerikananReferensiExport(), "referensi-import-perikanan.xlsx");
    }

    public function import(Request $request) {
		Excel::import(new PerikananImport($request->all()), $request->file_import);
        return redirect()->back()->with('success', trans('message.success_add'));
    }
}
