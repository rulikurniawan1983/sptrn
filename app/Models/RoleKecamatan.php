<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class RoleKecamatan extends Model
{
    use HasFactory, Blameable, LogsActivity;
    
    protected $guarded = [];
    protected $table = "role_kecamatan";

    protected $fillable = [
        "role_id",
        "id_kecamatan",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Role Kecamatan");
    }

    // Todo: Relation
    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function kecamatan() {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan');
    }
    // Todo: End Relation
}
