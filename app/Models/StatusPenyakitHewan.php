<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StatusPenyakitHewan extends Model
{
    use HasFactory, Blameable, LogsActivity;
    
    protected $guarded = [];
    protected $table = "status_penyakit_hewan";

    protected $fillable = [
        "id_status_penyakit",
        "nama_hewan",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Status Penyakit Hewan");
    }


    // Todo: Relation
    public function status_penyakit() {
        return $this->belongsTo(StatusPenyakit::class, 'id_status_penyakit');
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
