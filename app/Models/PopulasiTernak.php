<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PopulasiTernak extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "populasi_ternak";

    protected $fillable = [
        'jenis_ternak_populasi_id',
        'id_kecamatan',
        'tahun',
        'jumlah',
        'rtp',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "PopulasiTernak");
    }

    public function jenis_ternak_populasi()
    {
        return $this->belongsTo(JenisTernakPopulasi::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan');
    }
}
