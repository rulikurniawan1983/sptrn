<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\RoleKecamatan;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleRepository
{
    use RepositoryTrait;

    protected $model;
    protected $roleKecamatanRepository;
    protected $kecamatanRepository;

    public function __construct(Role $model, KecamatanRepository $kecamatanRepository, RoleKecamatanRepository $roleKecamatanRepository)
    {
        $this->model                   = $model;
        $this->kecamatanRepository     = $kecamatanRepository;
        $this->roleKecamatanRepository = $roleKecamatanRepository;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            'listBg'        => $this->model->listBg(),
            'listInitPage'  => $this->model->listInitPage(),
            'listKecamatan' => $this->kecamatanRepository->getAll([])->pluck('nama', 'id')->toArray(),
        ];
        return $data;
    }

    public function customTable($table, $data, $request)
    {
        return $table->editColumn('is_allow_login', function ($d) {
            return $d->is_allow_login_badge;
        })->editColumn('is_vertical_menu', function ($d) {
            return $d->is_vertical_menu_badge;
        })->editColumn('bg', function ($d) {
            return $d->bg_badge;
        });
    }

    public function setPermission($id, $permission_id_array = [])
    {
        $record = $this->getById($id);
        try {
            DB::beginTransaction();
            $properties['old'] = $record->permissions()->pluck('name')->toArray();
            $permission_id_array = array_map('intval', $permission_id_array);
            $record->syncPermissions($permission_id_array);
            $properties['attributes'] = $record->permissions()->pluck('name')->toArray();
            activity()->event('Set Permission')->performedOn($record)->withProperties($properties)->log("User");
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        $this->createBatchRoleKecamatan($model->id, $data, $method);
        return $model;
    }

    public function createBatchRoleKecamatan($role_id, $data, $method = "create")
    {
        if ($method != "create") {
            if (isset($data['id_kecamatan'])) {
                RoleKecamatan::where("role_id", $role_id)->whereNotIn("id_kecamatan", $data['id_kecamatan'])->delete();
            } else {
                RoleKecamatan::where("role_id", $role_id)->delete();
            }
        }
        if (isset($data['id_kecamatan'])) {
            foreach ($data['id_kecamatan'] as $key => $value) {
                if ($method != "create") {
                    $check = RoleKecamatan::where("role_id", $role_id)->where("id_kecamatan", $value)->first();
                }else{
                    $check = null;
                }
                if ($check == null) {
                    RoleKecamatan::create(["role_id" => $role_id, "id_kecamatan" => $value]);
                }
            }
        }
    }
}
