<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUmkmRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserUmkmRepository;
use App\Repositories\UsersRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Yajra\DataTables\Facades\DataTables;

class UserUmkmController extends Controller implements HasMiddleware
{
    use BaseTrait;

    private $request;
    private $repository;
    private $roleRepository;

    public function __construct(Request $request, UserUmkmRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository     = $repository;
        $this->roleRepository = $roleRepository;
        $this->request        = UserUmkmRequest::createFromBase($request);
        $this->initialize();
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
        $route               = $this->route;
        $role                = getRole(auth()->user()->current_role_id);
        $permission_detail   = $role->hasPermissionTo($this->permission_main . " Detail");
        $permission_edit     = $role->hasPermissionTo($this->permission_main . " Edit");
        $permission_delete   = $role->hasPermissionTo($this->permission_main . " Delete");
        $permission_verify   = $role->hasPermissionTo($this->permission_main . " Verify") || $role->hasPermissionTo($this->permission_main . " Edit");
        $permission_login_as = $role->hasPermissionTo("Users Login As");

        $data  = $this->repository->getDataTable(request()->all());
        $table = DataTables::of($data)
            ->addColumn('options', function ($d) use ($route, $permission_detail, $permission_edit, $permission_delete, $permission_verify, $permission_login_as) {
                return view($route . ".buttons", compact("d", "route", "permission_detail", "permission_edit", "permission_delete", "permission_verify", "permission_login_as"));
            });

        $table = $this->repository->customTable($table, [], request()->all());
        return $table->escapeColumns([])->make(true);
    }

    public function verify($id)
    {
        $user = $this->repository->toggleVerify($id);
        $statusMsg = $user->is_active == 1 ? "berhasil diverifikasi dan diaktifkan." : "berhasil dinonaktifkan.";

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status'    => 'success',
                'is_active' => $user->is_active,
                'message'   => "Akun UMKM '{$user->name}' {$statusMsg}",
            ]);
        }

        return redirect()->back()->with('success', "Akun UMKM '{$user->name}' {$statusMsg}");
    }

    public function downloadNib($id)
    {
        $user = $this->repository->getById($id);
        $media = $user->getFirstMedia('nib_file');
        if (!$media || !file_exists($media->getPath())) {
            return redirect()->back()->with('error', 'Berkas NIB tidak ditemukan di server.');
        }
        return response()->download($media->getPath(), $media->file_name);
    }

    public function login_as($users_id = '')
    {
        $user = app(UsersRepository::class)->loginAs($users_id);
        $init_page_login = ($user->role->init_page_login != "") ? $user->role->init_page_login : 'dashboard';
        return redirect($init_page_login)->withSuccess("Login As {$user->name} successfully.");
    }
}

