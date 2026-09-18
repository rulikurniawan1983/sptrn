<?php

namespace App\Repositories;

use App\Models\UmkmProduct;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\Auth;

class UmkmProductRepository
{
    use RepositoryTrait;

    public function __construct(UmkmProduct $model)
    {
        $this->model = $model;
        $this->with = ['user'];
    }

    public function customIndex($data)
    {
        $user = Auth::user();
        $baseQuery = UmkmProduct::query();
        if ($user && in_array($user->current_role_id, [101, 102])) {
            $baseQuery->where('user_id', $user->id);
        }

        $data['stats'] = [
            'total'   => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('is_active', 0)->count(),
            'active'  => (clone $baseQuery)->where('is_active', 1)->count(),
        ];

        return $data;
    }

    public function customDataDatatable($data)
    {
        $user = Auth::user();
        if ($user && in_array($user->current_role_id, [101, 102])) {
            $data['user_id'] = $user->id;
        }
        if (isset($data['is_active']) && $data['is_active'] !== '' && $data['is_active'] !== null) {
            $data['is_active'] = $data['is_active'];
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
            // UMKM baru input produk default menunggu verifikasi
            if (!$record) {
                $data['is_active'] = 0;
            }
        }

        if (request()->hasFile('file_foto_produk')) {
            $upload = $this->uploadFileCustom(request()->file('file_foto_produk'), 'umkm-products');
            if (isset($upload['filename'])) {
                if ($record && $record->foto_produk) {
                    $this->deleteFileCustom($record->foto_produk, 'umkm-products');
                }
                $data['foto_produk'] = $upload['filename'];
            }
        }

        return $data;
    }

    public function customTable($table, $data, $request)
    {
        return $table
            ->editColumn('foto_produk', function ($d) {
                return '<a href="' . $d->foto_produk_url . '" target="_blank"><img src="' . $d->foto_produk_url . '" width="48" height="48" class="rounded object-fit-cover shadow-sm"></a>';
            })
            ->editColumn('nama_produk', function ($d) {
                $unit = $d->satuan ? '<span class="text-muted small d-block">Satuan: ' . e($d->satuan) . '</span>' : '';
                return '<div><strong>' . e($d->nama_produk) . '</strong>' . $unit . '</div>';
            })
            ->editColumn('harga', function ($d) {
                return '<span class="badge bg-label-primary fs-7">Rp ' . number_format($d->harga, 0, ',', '.') . '</span>';
            })
            ->editColumn('user_id', function ($d) {
                if (!$d->user) return '-';
                return '<div><i class="ti ti-building-store text-warning me-1"></i>' . e($d->user->name) . '</div>';
            })
            ->editColumn('is_active', function ($d) {
                if ($d->is_active == 1) {
                    return '<span class="badge bg-label-success"><i class="ti ti-check me-1"></i>Aktif / Tayang</span>';
                }
                return '<span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i>Menunggu Verifikasi</span>';
            })
            ->editColumn('created_at', function ($d) {
                return '<span class="small text-muted">' . ($d->created_at ? \Carbon\Carbon::parse($d->created_at)->format('d M Y H:i') : '-') . '</span>';
            })
            ->rawColumns(['options', 'foto_produk', 'nama_produk', 'harga', 'user_id', 'is_active', 'created_at']);
    }

    public function toggleVerify($id)
    {
        $product = $this->getById($id);
        $newStatus = $product->is_active == 1 ? 0 : 1;
        $product->update(['is_active' => $newStatus]);
        return $product;
    }
}
