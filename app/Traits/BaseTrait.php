<?php

namespace App\Traits;

use App\Exports\GeneralExport;
use App\Repositories\UsersMenuRepository;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Maatwebsite\Excel\Facades\Excel;

trait BaseTrait
{
    use SupportBaseTrait;
    private $controllerName;
    private $titlePage;
    private $route;
    private $kode_menu;
    private $kode_second_menu = "";
    private $permission_main;
    private $commonData = [];

    public function initialize()
    {
        $usersMenuRepository   = app(UsersMenuRepository::class);
        $this->controllerName  = $this->getControllerName();
        $this->route           = $this->convertToDashSeparated($this->controllerName);
        $this->kode_menu       = strtoupper($this->convertToDashSeparated($this->controllerName));
        $this->permission_main = $this->convertToTitle($this->controllerName);
        $this->titlePage       = @$usersMenuRepository->getCacheByKode($this->kode_menu)->nama ?? $this->convertToTitle($this->controllerName);
        $this->commonData = [
            'titlePage'        => $this->titlePage,
            'route'            => $this->route,
            'kode_first_menu'  => $this->kode_menu,
            'kode_second_menu' => $this->kode_second_menu,
            'permission_main'  => $this->permission_main,
        ];
    }

    public function index()
    {
        $data = $this->commonData + [];
        $data = $this->repository->customIndex($data);
        return view($this->route . '.index', $data);
    }

    public function create()
    {
        $data = $this->commonData + [];
        $data = $this->repository->customCreateEdit($data);
        if (!is_array($data)) {
            return $data;
        }
        return view("$this->route.create", $data);
    }

    public function edit($id = "")
    {
        $item = $this->repository->getById($id);
        $data = $this->commonData + [
            'item' => $item,
        ];
        $data = $this->repository->customCreateEdit($data, $item);
        if (!is_array($data)) {
            return $data;
        }
        return view("$this->route.edit", $data);
    }

    public function show($id = "")
    {
        $item = $this->repository->getById($id);
        $data = $this->commonData + [
            'item' => $item,
        ];
        $data = $this->repository->customShow($data, $item);
        return view("$this->route.show", $data);
    }

    public function store()
    {
        $data     = $this->request->validate($this->request->rules());
        $data     = $this->request->all();
        $before   = $this->repository->callbackBeforeStoreOrUpdate($data, "store");
        if ($before['error'] != 0) {
            return redirect()->back()->with('error', $before['message'])->withInput();
        } else {
            $data = $before['data'];
        }
        $model    = $this->repository->create($data);
        if (!($model instanceof \Illuminate\Database\Eloquent\Model)) {
            return $model;
        }
        return redirect()->route($this->route . '.index')->with('success', trans('message.success_add'));
    }

    public function update()
    {
        $data     = $this->request->validate($this->request->rules());
        $data     = $this->request->all();
        $before   = $this->repository->callbackBeforeStoreOrUpdate($data, "update");
        if ($before['error'] != 0) {
            return redirect()->back()->with('error', $before['message'])->withInput();
        } else {
            $data = $before['data'];
        }
        $model    = $this->repository->update($this->request->id, $data);
        if (!($model instanceof \Illuminate\Database\Eloquent\Model)) {
            return $model;
        }
        return redirect()->route($this->route . '.index')->with('success', trans('message.success_update'));
    }

    public function destroy($id)
    {
        $model    = $this->repository->delete($id);
        $callback = $this->repository->callbackAfterDelete($model, $id);
        if (!($callback instanceof \Illuminate\Database\Eloquent\Model)) {
            return $callback;
        }
        return redirect()->route($this->route . '.index')->with('success', trans('message.success_delete'));
    }

    public function destroy_selected()
    {
        $model    = $this->repository->delete_selected(request()->id);
        $callback = $this->repository->callbackAfterDeleteSelected($model, request()->id);
        if (!($callback instanceof \Illuminate\Database\Eloquent\Model)) {
            return $callback;
        }
        return redirect()->route($this->route . '.index')->with('success', trans('message.success_delete'));
    }

    public function table()
    {
        $request = [
            "orderDefault" => request()->input('order') ?? null,
        ];
        $route   = $this->route;
        $role    = getRole(auth()->user()->current_role_id);
        try {
            $permission_detail = $role->hasPermissionTo($this->permission_main . " Detail");
        } catch (PermissionDoesNotExist $e) {
            $permission_detail = false;
        }
        try {
            $permission_edit = $role->hasPermissionTo($this->permission_main . " Edit");
        } catch (PermissionDoesNotExist $e) {
            $permission_edit = false;
        }
        try {
            $permission_delete = $role->hasPermissionTo($this->permission_main . " Delete");
        } catch (PermissionDoesNotExist $e) {
            $permission_delete = false;
        }
        $param = [
            'route' => $route,
        ]; // ini untuk parameter
        $data  = $this->repository->getDataTable($request);
        $table = DataTables::of($data)
            ->addColumn('options', function ($d) use ($route, $permission_detail, $permission_edit, $permission_delete) {
                return view($route . ".buttons", compact("d", "route", "permission_detail", "permission_edit", "permission_delete"));
            });
        $table = $this->repository->customTable($table, $param, $request);
        $table = $table->escapeColumns([])->make(true);
        return $table;
    }

    public function export()
    {
        return Excel::download(new GeneralExport($this->repository->getInstanceModel(), request()->all()), $this->titlePage . '.xlsx');
    }
}
