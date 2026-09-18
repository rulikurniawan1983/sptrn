<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Traits\RepositoryTrait;

class PermissionRepository
{
    use RepositoryTrait;
    protected $model;
    protected $categoryPermissionRepository;

    public function __construct(Permission $model, CategoryPermissionRepository $categoryPermissionRepository)
    {
        $this->model = $model;
        $this->categoryPermissionRepository = $categoryPermissionRepository;
    }

    public function customIndex($data)
    {
        $data += [
            'get_CategoryPermission' => $this->categoryPermissionRepository->getAll_OrderSequence(),
        ];
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            'category_permission_id' => request()->input('category_permission_id'),
            'get_CategoryPermission' => $this->categoryPermissionRepository->getAll_OrderSequence()->pluck("name", "id"),
        ];
        return $data;
    }
}
