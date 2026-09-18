<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UptPuskeswanFasilitasUpt extends Model
{
    use HasFactory, Blameable, LogsActivity;
    
    protected $guarded = [];
    protected $table = "upt_puskeswan_fasilitas_upt";

    protected $fillable = [
        "id_upt_puskeswan",
        "id_fasilitas_upt",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Upt Puskeswan Fasilitas Upt");
    }


    // Todo: Relation
    public function upt_puskeswan() {
        return $this->belongsTo(UptPuskeswan::class, 'id_upt_puskeswan');
    }
    public function fasilitas_upt() {
        return $this->belongsTo(MstFasilitasUpt::class, 'id_fasilitas_upt');
    }
    // Todo: End Relation


    // Todo: Scope
    public function scopeFilter($query, $data)
    {
        if (@$data['id_upt_puskeswan'] != null) {
            $query->where("id_upt_puskeswan", $data['id_upt_puskeswan']);
        }
    }
    // Todo: End Scope
}
