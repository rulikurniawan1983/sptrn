<?php

namespace App\Repositories;

use App\Models\UsersMenu;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\Cache;

class UsersMenuRepository
{
    use RepositoryTrait;
    private $cacheKey = "UsersMenu_cache";
    protected $model;
    protected $permissionRepository;

    public function __construct(UsersMenu $model, PermissionRepository $permissionRepository)
    {
        $this->model = $model;
        $this->with = [
            "children",
            "rel_users_menu",
            "permission"
        ];

        $this->permissionRepository = $permissionRepository;
    }

    public function getByRel($rel)
    {
        return $this->model::with($this->with)->where("rel", $rel)->orderBy("urutan", "asc")->get();
    }

    public function listDropdown()
    {
        $list = [];
        $data = $this->getByRel(0);
        $list[0] = "Tidak ada";
        foreach ($data as $key => $value) {
            $list[$value->id] = $value->nama;
            foreach ($value->children as $k => $v) {
                $list[$v->id] = "===" . $v->nama;
                foreach ($v->children as $s => $d) {
                    $list[$d->id] = "======" . $d->nama;
                }
            }
        }
        return $list;
    }


    public function updateCache()
    {
        $usersMenu = $this->model::get();

        // Ubah array menjadi Collection sebelum menyimpan di cache
        $usersMenu = collect($usersMenu);

        Cache::put($this->cacheKey, $usersMenu, now()->addDay());
        $usersMenu = Cache::get($this->cacheKey);
        return $usersMenu;
    }

    public function getCache()
    {
        if (Cache::has($this->cacheKey)) {
            $usersMenu = Cache::get($this->cacheKey);
            $usersMenu = collect($usersMenu);
            return $usersMenu;
        } else {
            return $this->updateCache();
        }
    }

    public function getCacheByKode($kode)
    {
        $getCache = $this->getCache();
        $getCache = $getCache->where("kode", $kode)->first();
        return $getCache;
    }

    public function forgetCache()
    {
        Cache::forget($this->cacheKey);
    }


    public function customIndex($data)
    {
        $data += [
            'listUsersMenu' => $this->getByRel(0),
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            'listUsersMenu' => $this->listDropdown(),
            'get_Permission' => $this->permissionRepository->getAll()->pluck("name", "id"),
        ];
        return $data;
    }
}
