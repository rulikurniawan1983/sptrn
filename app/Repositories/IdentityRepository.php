<?php

namespace App\Repositories;

use App\Models\Identity;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\Cache;

class IdentityRepository
{
    use RepositoryTrait;
    private $cacheKeyApi = "Identity_cache";
    protected $model;
    protected $categoryIdentityRepository;

    public function __construct(Identity $model, CategoryIdentityRepository $categoryIdentityRepository)
    {
        $this->model = $model;
        $this->categoryIdentityRepository = $categoryIdentityRepository;
    }

    public function listType()
    {
        return $this->model->listType();
    }

    public function getByKode($kode)
    {
        $record = $this->model::where("kode", $kode)->first();
        return $record;
    }

    public function save($data)
    {
        foreach ($data['kode'] as $key => $value) {
            $get = $this->getByKode($value);
            if ($get) {
                if ($get->type == $this->model::TYPE_FILE) {
                    if (@$data[$value]) {
                        $file_lama = $get->file;
                        $uploadFile = $this->uploadFileCustom($data[$value], "identity/photo");
                        $filename = @$uploadFile['filename'];
                        $type_file = $uploadFile['type_file'];
                        $this->update($get->id, ["value" => $filename, "type_file" => $type_file]);
                        if ($get->file != "") {
                            $this->deleteFileCustom($file_lama, "identity/photo");
                        }
                    }
                } else {
                    $this->update($get->id, ["value" => $data[$value]]);
                }
            }
        }
        $this->updateCache();
        return true;
    }

    public function getCache()
    {
        $data = Cache::remember($this->cacheKeyApi, 60, function () {
            $getAll = $this->getAll();
            $getData = collect($getAll);
            return $getData;
        });
        return $data;
    }

    public function getCacheByKode($kode)
    {
        $getCache = $this->getCache();
        $getCache = $getCache->where("kode", $kode)->first();
        return $getCache;
    }

    public function forgetCache()
    {
        Cache::forget($this->cacheKeyApi);
    }

    public function updateCache()
    {
        $this->forgetCache();
        $this->getCache();
    }

    public function customIndex($data)
    {
        $data += [
            'listType' => $this->listType(),
            'data'     => $this->categoryIdentityRepository->getAll(),
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            "category_identity_id" => request()->input('category_identity_id'),
            'listType'    => $this->listType(),
        ];
        return $data;
    }
}
