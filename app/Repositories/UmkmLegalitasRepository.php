<?php

namespace App\Repositories;

use App\Models\UmkmLegalitas;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\Auth;

class UmkmLegalitasRepository
{
    use RepositoryTrait;

    public function __construct(UmkmLegalitas $model)
    {
        $this->model = $model;
        $this->with = ['user', 'verifier'];
    }

    public function customIndex($data)
    {
        $user = Auth::user();
        $baseQuery = UmkmLegalitas::query();
        if ($user && in_array($user->current_role_id, [101, 102])) {
            $baseQuery->where('user_id', $user->id);
        }

        $data['stats'] = [
            'total'   => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('is_verified', 0)->count(),
            'verified'  => (clone $baseQuery)->where('is_verified', 1)->count(),
        ];

        $data['items'] = (clone $baseQuery)->orderBy('created_at', 'desc')->get();

        return $data;
    }

    public function customDataDatatable($data)
    {
        $user = Auth::user();
        if ($user && in_array($user->current_role_id, [101, 102])) {
            $data['user_id'] = $user->id;
        }
        if (isset($data['is_verified']) && $data['is_verified'] !== '' && $data['is_verified'] !== null) {
            $data['is_verified'] = $data['is_verified'];
        }
        return $data;
    }

    public function customCreateEdit($data, $record = null)
    {
        $user = Auth::user();
        if ($user && !in_array($user->current_role_id, [101, 102])) {
            $data['listUmkm'] = \App\Models\User::whereIn('current_role_id', [101, 102])->pluck('name', 'id')->toArray();
        }
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        $user = Auth::user();
        if ($user && in_array($user->current_role_id, [101, 102])) {
            $data['user_id'] = $user->id;
        }

        if (request()->hasFile('file_legalitas')) {
            $upload = $this->uploadFileCustom(request()->file('file_legalitas'), 'umkm-legalitas');
            if (isset($upload['filename'])) {
                if ($record && $record->file_legalitas) {
                    $this->deleteFileCustom($record->file_legalitas, 'umkm-legalitas');
                }
                $data['file_legalitas'] = $upload['filename'];
            }
        }

        return $data;
    }

    public function customTable($table, $data, $request)
    {
        return $table
            ->editColumn('file_legalitas', function ($d) {
                if ($d->file_legalitas) {
                    return '<a href="' . asset('storage/umkm-legalitas/' . $d->file_legalitas) . '" target="_blank" class="btn btn-sm btn-outline-primary"><i class="ti ti-file-download"></i> Download</a>';
                }
                return '<span class="text-muted">Tidak ada file</span>';
            })
            ->editColumn('jenis_legalitas', function ($d) {
                return '<strong>' . e($d->jenis_legalitas) . '</strong>';
            })
            ->editColumn('nomor_dokumen', function ($d) {
                return $d->nomor_dokumen ? e($d->nomor_dokumen) : '<span class="text-muted">-</span>';
            })
            ->editColumn('user_id', function ($d) {
                if (!$d->user) return '-';
                return '<div><i class="ti ti-building-store text-warning me-1"></i>' . e($d->user->name) . '</div>';
            })
            ->editColumn('is_verified', function ($d) {
                if ($d->is_verified == 1) {
                    return '<span class="badge bg-label-success"><i class="ti ti-check me-1"></i>Terverifikasi</span>';
                }
                return '<span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i>Menunggu Verifikasi</span>';
            })
            ->editColumn('created_at', function ($d) {
                return '<span class="small text-muted">' . ($d->created_at ? \Carbon\Carbon::parse($d->created_at)->format('d M Y H:i') : '-') . '</span>';
            })
            ->rawColumns(['options', 'file_legalitas', 'jenis_legalitas', 'nomor_dokumen', 'user_id', 'is_verified', 'created_at']);
    }

    public function toggleVerify($id)
    {
        $legalitas = $this->getById($id);
        $newStatus = $legalitas->is_verified == 1 ? 0 : 1;
        $legalitas->update([
            'is_verified' => $newStatus,
            'verified_at' => $newStatus ? now() : null,
            'verified_by' => $newStatus ? Auth::id() : null,
        ]);
        return $legalitas;
    }
}
