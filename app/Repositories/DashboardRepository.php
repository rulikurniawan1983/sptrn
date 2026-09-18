<?php

namespace App\Repositories;

use App\Traits\RepositoryTrait;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Peternakan;
use App\Models\Perikanan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardRepository
{
    use RepositoryTrait;
    protected $peternakanRepository;
    protected $perikananRepository;

    public function __construct(PeternakanRepository $peternakanRepository, PerikananRepository $perikananRepository)
    {
        $this->peternakanRepository = $peternakanRepository;
        $this->perikananRepository  = $perikananRepository;
    }

    public function customIndex($data)
    {
        $user = auth()->user();
        if ($user && in_array($user->current_role_id, [101, 102])) {
            $myProductCount = \App\Models\UmkmProduct::where('user_id', $user->id)->count();
            $umkmLegalitas = \App\Models\UmkmLegalitas::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            $umkmLegalitasNib = $umkmLegalitas->where('jenis_legalitas', 'NIB (Nomor Induk Berusaha)');
            $data += [
                "is_umkm" => true,
                "myProductCount" => $myProductCount,
                "umkmLegalitas" => $umkmLegalitas,
                "umkmLegalitasNib" => $umkmLegalitasNib,
                "infoCard" => [
                    "countPeternakan" => 0,
                    "countPerikanan" => 0,
                ],
                "recentActivities" => collect([]),
                "statistics" => [
                    "totalUsers" => 0,
                    "activeUsers" => 0,
                    "activePercentage" => 0,
                    "pending" => 0,
                    "reports" => 0,
                ],
            ];
        } else {
            $umkmLegalitasNib = \App\Models\UmkmLegalitas::where('jenis_legalitas', 'NIB (Nomor Induk Berusaha)')
                ->whereHas('user', function($q) { $q->whereIn('current_role_id', [101, 102]); })
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->get();
            $data += [
                "is_umkm" => false,
                "umkmLegalitasNib" => $umkmLegalitasNib,
                "infoCard" => $this->infoCard($data),
                "recentActivities" => $this->getRecentActivities(),
                "statistics" => $this->getStatistics(),
            ];
        }
        return $data;
    }

    public function infoCard($param = [])
    {
        $data = [
            "countPeternakan" => $this->peternakanRepository->getAll(["is_my_area" => 1], false, true),
            "countPerikanan" => $this->perikananRepository->getAll(["is_my_area" => 1], false, true),
            "countUmkmPeternakan" => User::whereHas('users_role', function($q) { $q->where('role_id', 101); })
                                         ->whereDoesntHave('users_role', function($q) { $q->where('role_id', 102); })->count(),
            "countUmkmPerikanan"  => User::whereHas('users_role', function($q) { $q->where('role_id', 102); })
                                         ->whereDoesntHave('users_role', function($q) { $q->where('role_id', 101); })->count(),
            "countUmkmKeduanya"   => User::whereHas('users_role', function($q) { $q->where('role_id', 101); })
                                         ->whereHas('users_role', function($q) { $q->where('role_id', 102); })->count(),
            "countProduct" => \App\Models\UmkmProduct::count(),
        ];
        return $data;
    }

    public function getRecentActivities($limit = 5)
    {
        $activities = ActivityLog::with('causer')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($activity) {
                try {
                    $rawCreatedAt = $activity->getRawOriginal('created_at');
                    $createdAt = Carbon::parse($rawCreatedAt);
                } catch (\Exception $e) {
                    $createdAt = Carbon::parse($activity->created_at);
                }
                
                return [
                    'description' => $this->formatActivityDescription($activity),
                    'time' => $createdAt->diffForHumans(),
                    'icon' => $this->getActivityIcon($activity),
                    'color' => $this->getActivityColor($activity),
                ];
            });

        if ($activities->isEmpty()) {
            return $this->getDefaultActivities();
        }

        return $activities;
    }

    private function formatActivityDescription($activity)
    {
        $description = $activity->description ?? '';
        $subjectType = class_basename($activity->subject_type ?? '');
        
        if (str_contains($description, 'created')) {
            return "Data {$subjectType} Ditambahkan";
        } elseif (str_contains($description, 'updated')) {
            return "Data {$subjectType} Diperbarui";
        } elseif (str_contains($description, 'deleted')) {
            return "Data {$subjectType} Dihapus";
        }
        
        return $description ?: 'Aktivitas Sistem';
    }

    private function getActivityIcon($activity)
    {
        $description = $activity->description ?? '';
        if (str_contains($description, 'created')) {
            return 'ti-plus';
        } elseif (str_contains($description, 'updated')) {
            return 'ti-edit';
        } elseif (str_contains($description, 'deleted')) {
            return 'ti-trash';
        }
        return 'ti-check';
    }

    private function getActivityColor($activity)
    {
        $description = $activity->description ?? '';
        if (str_contains($description, 'created')) {
            return 'primary';
        } elseif (str_contains($description, 'updated')) {
            return 'warning';
        } elseif (str_contains($description, 'deleted')) {
            return 'danger';
        }
        return 'success';
    }

    private function getDefaultActivities()
    {
        return collect([
            [
                'description' => 'Sistem Dimulai',
                'time' => 'Baru saja',
                'icon' => 'ti-check',
                'color' => 'success',
            ]
        ]);
    }

    public function getStatistics()
    {
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('email_verified_at')->count();
        $activePercentage = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100) : 0;
        
        $pendingPeternakan = Peternakan::where(function($q) {
            $q->whereNull('id_status_verifikasi')
              ->orWhereHas('status_verifikasi', function($query) {
                  $query->where('nama', 'like', '%pending%')
                        ->orWhere('nama', 'like', '%menunggu%')
                        ->orWhere('nama', 'like', '%belum%');
              });
        })->count();
        
        $pendingPerikanan = Perikanan::where(function($q) {
            $q->whereNull('id_status_verifikasi')
              ->orWhereHas('status_verifikasi', function($query) {
                  $query->where('nama', 'like', '%pending%')
                        ->orWhere('nama', 'like', '%menunggu%')
                        ->orWhere('nama', 'like', '%belum%');
              });
        })->count();
        
        $totalPending = $pendingPeternakan + $pendingPerikanan;
        
        $totalReports = ActivityLog::where(function($q) {
            $q->where('description', 'like', '%laporan%')
              ->orWhere('description', 'like', '%report%');
        })->where('created_at', '>=', now()->subMonth())
          ->count();

        return [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'activePercentage' => $activePercentage,
            'pending' => $totalPending,
            'reports' => $totalReports > 0 ? $totalReports : 0, // Return 0 jika tidak ada data
        ];
    }
}
