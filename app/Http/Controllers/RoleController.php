<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Repositories\CategoryPermissionRepository;
use App\Repositories\RoleRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $categoryPermissionRepository;
    private $request;

    public function __construct(RoleRepository $repository, CategoryPermissionRepository $categoryPermissionRepository, Request $request)
    {
        $this->repository                   = $repository;
        $this->categoryPermissionRepository = $categoryPermissionRepository;
        $this->request                      = RoleRequest::createFromBase($request);
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

    public function table()
    {
        $request = [];
        $route                     = $this->route;
        $role                      = getRole(auth()->user()->current_role_id);
        $permission_detail         = $role->hasPermissionTo($this->permission_main . " Detail");
        $permission_edit           = $role->hasPermissionTo($this->permission_main . " Edit");
        $permission_delete         = $role->hasPermissionTo($this->permission_main . " Delete");
        $permission_set_permission = $role->hasPermissionTo($this->permission_main . " Set Permission");
        $param = [];
        $data = $this->repository->getDataTable([]);
        $table = DataTables::of($data)
            ->addColumn('options', function ($d) use ($route, $permission_detail, $permission_edit, $permission_delete, $permission_set_permission) {
                return view($route . ".buttons", compact("d", "route", "permission_detail", "permission_edit", "permission_delete", "permission_set_permission"));
            });
        $table = $this->repository->customTable($table, $param, $request);
        $table = $table->escapeColumns([])->make(true);
        return $table;
    }

    public function set_permission($id)
    {
        $item = $this->repository->getById($id);
        $this->commonData['titlePage'] .= " Set Permission";
        $data = $this->commonData + [
            'item'                   => $item,
            'get_CategoryPermission' => $this->categoryPermissionRepository->getAll_OrderSequence(),
        ];
        return view("$this->route.permission", $data);
    }

    public function set_permission_action(Request $request)
    {
        $request->validate([
            'id' => 'required|digits_between:1,20|numeric',
        ]);
        $this->repository->setPermission($request->id, $request->permission_id);
        return redirect()->route($this->route . '.set-permission', $request->id)->with('success', trans('message.success_save'));
    }
}
