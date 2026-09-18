<?php

namespace App\Http\Controllers;

use App\Repositories\UmkmProductRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UmkmProductController extends Controller implements HasMiddleware
{
    use BaseTrait;
    private $repository;
    private $request;

    public function __construct(UmkmProductRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = \App\Http\Requests\UmkmProductRequest::createFromBase($request);
        $this->initialize();
        $this->commonData['kode_first_menu']  = "UMKM-PRODUCT";
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
            new Middleware("can:$permission Verify", only: ['verify']),
        ];
    }

    public function table()
    {
        $request = request()->all();
        $route   = $this->route;
        $role    = getRole(auth()->user()->current_role_id);

        $permission_detail = $role->hasPermissionTo($this->permission_main . " Detail");
        $permission_edit   = $role->hasPermissionTo($this->permission_main . " Edit");
        $permission_delete = $role->hasPermissionTo($this->permission_main . " Delete");
        $permission_verify = $role->hasPermissionTo($this->permission_main . " Verify") || $role->hasPermissionTo($this->permission_main . " Edit");

        $data  = $this->repository->getDataTable($request);
        $table = \Yajra\DataTables\DataTables::of($data)
            ->addColumn('options', function ($d) use ($route, $permission_detail, $permission_edit, $permission_delete, $permission_verify) {
                return view($route . ".buttons", compact("d", "route", "permission_detail", "permission_edit", "permission_delete", "permission_verify"));
            });
        $table = $this->repository->customTable($table, [], $request);
        return $table->escapeColumns([])->make(true);
    }

    public function verify($id)
    {
        $product = $this->repository->toggleVerify($id);
        $statusMsg = $product->is_active == 1 ? "berhasil diverifikasi dan ditayangkan." : "berhasil dinonaktifkan.";

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status'    => 'success',
                'is_active' => $product->is_active,
                'message'   => "Produk '{$product->nama_produk}' {$statusMsg}",
            ]);
        }

        return redirect()->back()->with('success', "Produk '{$product->nama_produk}' {$statusMsg}");
    }
}
