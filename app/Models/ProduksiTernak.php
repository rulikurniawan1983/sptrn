<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProduksiTernak extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "produksi_ternak";

    protected $fillable = [
        'jenis_ternak_produksi_id',
        'id_kecamatan',
        'tahun',
        'jumlah',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "ProduksieTernak");
    }

    public function jenis_ternak_produksi()
    {
        return $this->belongsTo(JenisTernakProduksi::class, 'jenis_ternak_produksi_id')->withDefault(['nama' => null]);
    }

    public function kecamatan()
    {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan');
    }

}
