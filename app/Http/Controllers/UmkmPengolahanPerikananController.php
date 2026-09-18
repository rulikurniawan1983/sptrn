<?php

namespace App\Http\Controllers;

use App\Http\Requests\UmkmPengolahanPerikananRequest;
use App\Repositories\UmkmPengolahanPerikananRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UmkmPengolahanPerikananController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $request;

    public function __construct(UmkmPengolahanPerikananRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request    = UmkmPengolahanPerikananRequest::createFromBase($request);
        $this->initialize();
        $this->commonData['kode_first_menu']  = 'UMKM-PENGOLAHAN-PERIKANAN';
        $this->commonData['kode_second_menu'] = null;
    }

    public static function middleware(): array
    {
        $permission = 'Umkm Pengolahan Perikanan';
        return [
            new Middleware("can:$permission Add", only: ['create', 'store']),
            new Middleware("can:$permission Detail", only: ['show']),
            new Middleware("can:$permission Edit", only: ['edit', 'update']),
            new Middleware("can:$permission Delete", only: ['destroy', 'destroy_selected']),
        ];
    }
} 