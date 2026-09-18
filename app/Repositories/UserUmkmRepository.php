<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserUmkmRepository
{
    use RepositoryTrait;

    protected $model;
    protected $roleRepository;
    protected $kecamatanRepository;

    public function __construct(User $model, RoleRepository $roleRepository, KecamatanRepository $kecamatanRepository)
    {
        $this->model               = $model;
        $this->with                = ["users_role", "media", "umkmLegalitas", "perizinans"];
        $this->roleRepository      = $roleRepository;
        $this->kecamatanRepository = $kecamatanRepository;
    }

    public function getDataTable($data = [])
    {
        $query = $this->model::query()->with($this->with)
            ->whereIn('current_role_id', [101, 102]);

        if (isset($data['status_filter']) && $data['status_filter'] !== '') {
            if ($data['status_filter'] === 'pending') {
                $query->where('is_active', 0);
            } elseif ($data['status_filter'] === 'active') {
                $query->where('is_active', 1);
            }
        }

        if (isset($data['role_filter']) && $data['role_filter'] !== '') {
            $roleId = (int)$data['role_filter'];
            $query->where('current_role_id', $roleId);
        }

        return $query->latest();
    }

    public function getStats()
    {
        $baseQuery = $this->model::whereIn('current_role_id', [101, 102]);

        $total = (clone $baseQuery)->count();
        $pending = (clone $baseQuery)->where('is_active', 0)->count();
        $active = (clone $baseQuery)->where('is_active', 1)->count();
        
        $peternakan = (clone $baseQuery)->where('current_role_id', 101)->count();
        $perikanan = (clone $baseQuery)->where('current_role_id', 102)->count();

        return [
            'total'      => $total,
            'pending'    => $pending,
            'active'     => $active,
            'peternakan' => $peternakan,
            'perikanan'  => $perikanan,
        ];
    }

    public function customIndex($data)
    {
        $data['stats'] = $this->getStats();
        return $data;
    }

    public function customTable($table, $param, $request)
    {
        return $table
            ->editColumn('name', function ($d) {
                $avatar = $d->file_url ? '<img src="' . $d->file_url . '" class="rounded-circle me-2" width="36" height="36" style="object-fit:cover;">' : '<span class="avatar-initial rounded-circle bg-label-primary me-2 d-inline-flex align-items-center justify-content-center" style="width:36px;height:36px;font-size:14px;">' . strtoupper(substr($d->name, 0, 2)) . '</span>';
                return '<div class="d-flex align-items-center">' . $avatar . '<div><strong class="text-body">' . e($d->name) . '</strong></div></div>';
            })
            ->addColumn('nama_pemilik', function ($d) {
                return e($d->nama_pemilik ?? '-');
            })
            ->editColumn('email', function ($d) {
                return '<code>' . e($d->email) . '</code>';
            })
            ->addColumn('no_wa', function ($d) {
                if (!$d->no_hp) return '-';
                $cleanWa = preg_replace('/[^0-9]/', '', $d->no_hp);
                if (str_starts_with($cleanWa, '0')) {
                    $cleanWa = '62' . substr($cleanWa, 1);
                }
                return '<a href="https://wa.me/' . $cleanWa . '" target="_blank" class="badge bg-label-success text-success d-inline-flex align-items-center gap-1"><i class="ti ti-brand-whatsapp"></i> ' . e($d->no_hp) . '</a>';
            })
            ->addColumn('sektor', function ($d) {
                $roles = $d->users_role->pluck('role_id')->toArray();
                $badges = [];
                if (in_array(101, $roles)) {
                    $badges[] = '<span class="badge bg-label-warning"><i class="ti ti-building-cottage me-1"></i>Peternakan</span>';
                }
                if (in_array(102, $roles)) {
                    $badges[] = '<span class="badge bg-label-info"><i class="ti ti-fish me-1"></i>Perikanan</span>';
                }
                return implode(' ', $badges) ?: '<span class="badge bg-label-secondary">UMKM</span>';
            })
            ->addColumn('nib_file', function ($d) {
                if ($d->nib_file_url) {
                    return '<a href="' . route('user-umkm.download-nib', $d->id) . '" target="_blank" class="btn btn-xs btn-outline-primary"><i class="ti ti-file-download me-1"></i>Unduh NIB</a>';
                }
                return '<span class="text-muted small">Tidak Ada</span>';
            })
            ->editColumn('is_active', function ($d) {
                if ($d->is_active == 1) {
                    return '<span class="badge bg-label-success"><i class="ti ti-check me-1"></i>Aktif</span>';
                }
                return '<span class="badge bg-label-danger"><i class="ti ti-clock me-1"></i>Menunggu Verifikasi</span>';
            })
            ->editColumn('created_at', function ($d) {
                return '<span class="small text-muted">' . ($d->created_at ? \Carbon\Carbon::parse($d->created_at)->format('d M Y H:i') : '-') . '</span>';
            });
    }

    public function toggleVerify($id)
    {
        $user = $this->getById($id);
        $newStatus = $user->is_active == 1 ? 0 : 1;
        $user->update(['is_active' => $newStatus]);
        return $user;
    }

    public function customCreateEdit($data, $item = null)
    {
        $data += [
            'get_Roles' => Role::whereIn('id', [101, 102])->pluck('name', 'id')->toArray(),
            'listKecamatan' => $this->kecamatanRepository->getAll([])->pluck('nama', 'id')->toArray(),
        ];
        return $data;
    }

    public function customDataCreateUpdate($data, $record = null)
    {
        if (@$data['password'] != "" && @$data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $data;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $data = $this->customDataCreateUpdate($data);
            $role_id_array = $data['role_id'] ?? [101];
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
            app(UsersRoleRepository::class)->setRole($record->id, $role_id_array);
            app(UsersRepository::class)->createBatchRoleKecamatan($record->id, ['id_kecamatan' => $id_kecamatan_array], "create");
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
            $role_id_array = $data['role_id'] ?? [$record->current_role_id];
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
            app(UsersRoleRepository::class)->setRole($record->id, $role_id_array);
            app(UsersRepository::class)->createBatchRoleKecamatan($record->id, ['id_kecamatan' => $id_kecamatan_array], "update");
            DB::commit();
            return $record;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}

