<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StatusVerifikasi extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "status_verifikasi";

    protected $fillable = [
        "nama",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Status Verifikasi");
    }

    // Todo: Scope
    public function scopeFilter($query, $data) {
        if (@$data['is_default'] != null) {
            $query->where('is_default', $data['is_default']);
        }
    }
    // Todo: End Scope
}
