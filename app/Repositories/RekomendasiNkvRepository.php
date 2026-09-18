<?php

namespace App\Repositories;

use App\Models\RekomendasiNkv;
use App\Traits\RepositoryTrait;

class RekomendasiNkvRepository
{
    use RepositoryTrait;

    protected $model;

    public function __construct(RekomendasiNkv $model)
    {
        $this->model = $model;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        unset($data['nib'], $data['surat_permohonan'], $data['data_umum'], $data['surat_pernyataan'], $data['sop_sanitasi']);
        return $data;
    }

    public function customShow($data, $item)
    {
        if ($item && $item->is_read == 0) {
            $item->update(['is_read' => 1]);
        }
        return $data;
    }

    public function customCreateEdit($data, $item = null)
    {
        if ($item && $item->is_read == 0) {
            $item->update(['is_read' => 1]);
        }
        return $data;
    }

    public function callbackAfterStoreOrUpdate($model, $data, $method = "store", $record_sebelumnya = null)
    {
        foreach (['nib', 'surat_permohonan', 'data_umum', 'surat_pernyataan', 'sop_sanitasi'] as $field) {
            if (request()->hasFile($field)) {
                $model->clearMediaCollection($field);
                $model->addMediaFromRequest($field)->toMediaCollection($field);
            }
        }
        return redirect()->route('rekomendasi-nkv.index')->with('success', trans('message.success_save'));
    }
}

