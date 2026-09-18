<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StatusPenyakitKasus extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "status_penyakit_kasus";

    protected $fillable = [
        "id_status_penyakit",
        "id_status_penyakit_hewan",
        "tahun",
        "jumlah_terinfeksi",
        "jumlah_sembuh",
        "jumlah_mati",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Status Penyakit Kasus");
    }

    // Todo: Relation
    public function status_penyakit() {
        return $this->belongsTo(StatusPenyakit::class, 'id_status_penyakit');
    }

    public function status_penyakit_hewan() {
        return $this->belongsTo(StatusPenyakitHewan::class, 'id_status_penyakit_hewan');
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
