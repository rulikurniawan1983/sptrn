<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MstDesa extends Model
{
    use HasFactory, Blameable, LogsActivity;

    protected $table = 'mst_desa';
    protected $fillable = [
        'nama',
        'id_kecamatan',
        'latitude',
        'longitude',
    ];
    protected $guarded = [];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty()->setDescriptionForEvent(fn(string $eventName) => "Master Desa");
    }

    public function kecamatan()
    {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan')->select("id", "nama");
    }

    public function peternakan()
    {
        return $this->hasMany(Peternakan::class, 'id_kelurahan');
    }

    public function perikanan()
    {
        return $this->hasMany(Perikanan::class, 'id_kelurahan');
    }

    // Todo: Scope
    public function scopeFilter($query, $data) {
        if (@$data['id_kecamatan'] != null) {
            $query->where("id_kecamatan", $data['id_kecamatan']);
        }
        if (@$data['id_kelurahan'] != null) {
            $query->where("id", $data['id_kelurahan']);
        }
    }
    // Todo: End Scope
}
