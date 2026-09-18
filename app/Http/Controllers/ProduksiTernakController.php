<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProduksiTernakRequest;
use App\Repositories\ProduksiTernakRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProduksiTernakController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $request;

    public function __construct(ProduksiTernakRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request    = ProduksiTernakRequest::createFromBase($request);
        $this->initialize();
        $this->commonData['kode_first_menu']  = "DATA-PRODUKSI-TERNAK";
        $this->commonData['kode_second_menu'] = null;
    }

    public function initialize()
    {
        $usersMenuRepository   = app(\App\Repositories\UsersMenuRepository::class);
        $this->controllerName  = $this->getControllerName();
        $this->route           = 'data-produksi-ternak'; // Override route
        $this->kode_menu       = strtoupper($this->convertToDashSeparated($this->controllerName));
        $this->permission_main = 'Data Produksi Ternak'; // Override permission main
        $this->titlePage       = @$usersMenuRepository->getCacheByKode($this->kode_menu)->nama ?? $this->convertToTitle($this->controllerName);
        $this->commonData = [
            'titlePage'        => $this->titlePage,
            'route'            => $this->route,
            'kode_first_menu'  => $this->kode_menu,
            'kode_second_menu' => $this->kode_second_menu,
            'permission_main'  => $this->permission_main,
        ];
    }

    public static function middleware(): array
    {
        $permission = 'Data Produksi Ternak'; // Override permission untuk middleware
        return [
            new Middleware("can:$permission Add", only: ['create', 'store']),
            new Middleware("can:$permission Detail", only: ['show']),
            new Middleware("can:$permission Edit", only: ['edit', 'update']),
            new Middleware("can:$permission Delete", only: ['destroy', 'destroy_selected']),
        ];
    }
}
