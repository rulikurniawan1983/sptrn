<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UptPuskeswanLayananUpt extends Model
{
    use HasFactory, Blameable, LogsActivity;
    
    protected $guarded = [];
    protected $table = "upt_puskeswan_layanan_upt";

    protected $fillable = [
        "id_upt_puskeswan",
        "id_layanan_upt",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Upt Puskeswan Layanan Upt");
    }


    // Todo: Relation
    public function upt_puskeswan() {
        return $this->belongsTo(UptPuskeswan::class, 'id_upt_puskeswan');
    }
    public function layanan_upt() {
        return $this->belongsTo(MstLayananUpt::class, 'id_layanan_upt');
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
