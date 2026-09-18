<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StatusPenyakitKecamatan extends Model
{
    use HasFactory, Blameable, LogsActivity;
    
    protected $guarded = [];
    protected $table = "status_penyakit_kecamatan";

    protected $fillable = [
        "id_status_penyakit",
        "id_kecamatan",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Status Penyakit Kecamatan");
    }


    // Todo: Relation
    public function status_penyakit() {
        return $this->belongsTo(StatusPenyakit::class, 'id_status_penyakit');
    }

    public function kecamatan() {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan');
    }
    // Todo: End Relation


    // Todo: Scope
    public function scopeFilter($query, $data)
    {
        if (@$data['id_status_penyakit'] != null) {
            $query->where("id_status_penyakit", $data['id_status_penyakit']);
        }
    }
    // Todo: End Scope
}
