<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Repositories\CategoryPermissionRepository;
use App\Repositories\PermissionRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $categoryPermissionRepository;
    private $request;

    public function __construct(PermissionRepository $repository, CategoryPermissionRepository $categoryPermissionRepository, Request $request)
    {
        $this->repository                     = $repository;
        $this->categoryPermissionRepository   = $categoryPermissionRepository;
        $this->request                        = PermissionRequest::createFromBase($request);
        $this->initialize();
        $this->commonData['kode_first_menu']  = "USERS-MANAGEMENT";
        $this->commonData['kode_second_menu'] = $this->kode_menu;
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
}
