<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UsersKecamatan;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersRepository
{
    use RepositoryTrait;
    protected $model;
    protected $usersRoleRepository;
    protected $roleRepository;
    protected $kecamatanRepository;
    
    public function __construct(User $model, RoleRepository $roleRepository, UsersRoleRepository $usersRoleRepository, KecamatanRepository $kecamatanRepository)
    {
        $this->model               = $model;
        $this->with                = ["users_role"];
        $this->roleRepository      = $roleRepository;
        $this->usersRoleRepository = $usersRoleRepository;
        $this->kecamatanRepository = $kecamatanRepository;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $data = $this->customDataCreateUpdate($data);
            $role_id_array = $data['role_id'];
            $id_kecamatan_array = @$data['id_kecamatan'] ?? [];
            $data['current_role_id'] = $role_id_array[0];
            unset($data['role_id']);
            unset($data['id_kecamatan']);
            $record = $this->model::create($data);
            if (@$data['file']) {
                $record->addMedia($data['file'])->usingName($data['name'])->toMediaCollection('images');
            }
            if (@$data['file_nib']) {
                $record->addMedia($data['file_nib'])->usingName('NIB - ' . $record->name)->toMediaCollection('nib_file');
            }
            $record->assignRole((int) $record->current_role_id);
            $this->usersRoleRepository->setRole($record->id, $role_id_array);
            $this->createBatchRoleKecamatan($record->id, ['id_kecamatan' => $id_kecamatan_array], "create");
            DB::commit();
            return $record;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($id, $data)
    {
        try {
            DB::beginTransaction();
            $record = $this->getById($id);
            $data = $this->customDataCreateUpdate($data, $record);
            $role_id_array = $data['role_id'];
            $id_kecamatan_array = @$data['id_kecamatan'] ?? [];
            if (!in_array($record->current_role_id, $role_id_array)) {
                $data['current_role_id'] = $role_id_array[0];
            }
            unset($data['role_id']);
            unset($data['id_kecamatan']);
            $record->update($data);
            if (@$data['file']) {
                $record->addMedia($data['file'])->usingName($data['name'])->toMediaCollection('images');
            }
            if (@$data['file_nib']) {
                $record->addMedia($data['file_nib'])->usingName('NIB - ' . $record->name)->toMediaCollection('nib_file');
            }
            $record->syncRoles([(int) $record->current_role_id]);
            $this->usersRoleRepository->setRole($record->id, $role_id_array);
            $this->createBatchRoleKecamatan($record->id, ['id_kecamatan' => $id_kecamatan_array], "update");
            DB::commit();
            return $record;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function customCreateEdit($data, $item=null)
    {
        $data += [
			'get_Roles' => $this->roleRepository->getAll()->pluck('name', 'id')->toArray(),
            'listKecamatan' => $this->kecamatanRepository->getAll([])->pluck('nama', 'id')->toArray(),
        ];
        return $data;
    }

    public function customDataCreateUpdate($data, $record=null)
    {
        if (@$data['password'] != "" and @$data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $data;
    }

    public function customTable($table, $data, $request){
        return $table->editColumn('email', function ($d) {
            return $d->email." <br> <small class='text-muted'>".$d->no_hp."</small>";
        })->editColumn('file', function ($d) {
            return $d->file_url_image;
        })->editColumn('list_role_name_str', function ($d) {
            return $d->list_role_name_str;
        })->editColumn('is_active', function ($d) {
            return $d->is_active_badge;
        });
    }

    public function getByEmail($email)
    {
        $record = $this->model::where("email", $email)->first();
        return $record;
    }

    public function getByUsersRole($role_id)
    {
        $record = $this->model::filterUsersRole($role_id)->get();
        return $record;
    }
    
    public function getByFile($data){
        $record = $this->model::where("file", $data['file_name']);
        if (array_key_exists("is_my_file", $data) && $data["is_my_file"] != "") {
            $record = $record->where("id", auth()->user()->id);
        }
        $record = $record->first();
        $record['file_path'] = $record["file_path"];
        return $record;
    }

    public function loginAs($userId)
    {
        $record = $this->getById($userId);
        $users_id_lama = auth()->user()->id;
        if (Auth::loginUsingId($record->id, false)) {
            request()->session()->put('is_login_as', 1);
            request()->session()->put('users_id_lama', $users_id_lama);
            activity()->event('Login As')->performedOn($record)->log("User");
        }
        return auth()->user();
    }

    public function createBatchRoleKecamatan($users_id, $data, $method = "create")
    {
        if ($method != "create") {
            if (isset($data['id_kecamatan'])) {
                UsersKecamatan::where("users_id", $users_id)->whereNotIn("id_kecamatan", $data['id_kecamatan'])->delete();
            } else {
                UsersKecamatan::where("users_id", $users_id)->delete();
            }
        }
        if (isset($data['id_kecamatan'])) {
            foreach ($data['id_kecamatan'] as $key => $value) {
                if ($method != "create") {
                    $check = UsersKecamatan::where("users_id", $users_id)->where("id_kecamatan", $value)->first();
                }else{
                    $check = null;
                }
                if ($check == null) {
                    UsersKecamatan::create(["users_id" => $users_id, "id_kecamatan" => $value]);
                }
            }
        }
    }
}
