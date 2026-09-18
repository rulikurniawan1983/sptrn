<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UmkmLegalitas extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;

    protected $guarded = [];
    protected $table = 'umkm_legalitas';

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "UmkmLegalitas");
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function scopeFilter($query, $data)
    {
        if (!empty($data['jenis_legalitas'])) {
            $query->where('jenis_legalitas', 'like', '%' . $data['jenis_legalitas'] . '%');
        }
        if (!empty($data['user_id'])) {
            $query->where('user_id', $data['user_id']);
        }
        if (isset($data['is_verified']) && $data['is_verified'] !== '' && $data['is_verified'] !== null) {
            $query->where('is_verified', $data['is_verified']);
        }
    }
}
