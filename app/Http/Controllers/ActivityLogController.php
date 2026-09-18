<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityLogRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ActivityLogController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $categoryPermissionRepository;
    private $request;

    public function __construct(ActivityLogRepository $repository, Request $request)
    {
        $this->repository                     = $repository;
        $this->request                        = $request;
        $this->with                           = ["causer", "causer.role"];
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
            new Middleware("can:$permission Detail", only: ['show']),
            new Middleware("can:$permission Delete", only: ['destroy', 'destroy_selected']),
        ];
    }
}
