<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MstKecamatan extends Model
{
    use HasFactory, Blameable, LogsActivity;
    protected $table = 'mst_kecamatan';
    protected $fillable = [
        'nama',
        'longitude',
        'latitude'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty()->setDescriptionForEvent(fn(string $eventName) => "Master Kecamatan");
    }

    public function desa()
    {
        return $this->hasMany(MstDesa::class, 'id_kecamatan');
    }

    public function peternakan()
    {
        return $this->hasMany(Peternakan::class, 'id_kecamatan');
    }

    public function perikanan()
    {
        return $this->hasMany(Perikanan::class, 'id_kecamatan');
    }
}
