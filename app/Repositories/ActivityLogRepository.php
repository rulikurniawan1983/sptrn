<?php

namespace App\Repositories;

use App\Models\ActivityLog;
use App\Traits\RepositoryTrait;

class ActivityLogRepository
{
    use RepositoryTrait;

    public function __construct(ActivityLog $model)
    {
        $this->model = $model;
    }

    public function customTable($table, $data, $request)
    {
        return $table->editColumn('causer.name', function ($d) {
            $causer_name = @$d->causer->name ?? null;
            $causer_role_name = @$d->causer->role->name ?? null;
            $causer_name = $causer_name . " <br> <small class='text-muted'>" . $causer_role_name . "</small>";
            return $causer_name;
        })->editColumn('causer.role.name', function ($d) {
            return @$d->causer->role->name ?? null;
        });
    }
}
