<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PeternakanProduksi extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "peternakan_produksi";

    protected $fillable = [
        "id_peternakan",
        "tanggal_produksi_dari",
        "tanggal_produksi_sampai",
        "jumlah_kandang",
        "jumlah_kandang_id_satuan",
        "jumlah_populasi",
        "jumlah_populasi_id_satuan",
        "jumlah_produksi",
        "jumlah_produksi_id_satuan",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Peternakan Produksi");
    }

    // Todo: Relation
    public function peternakan() {
        return $this->belongsTo(Peternakan::class, 'id_peternakan');
    }

    public function satuan_kandang() {
        return $this->belongsTo(MstSatuan::class, 'jumlah_kandang_id_satuan')->withDefault(["nama" => null]);
    }

    public function satuan_populasi() {
        return $this->belongsTo(MstSatuan::class, 'jumlah_populasi_id_satuan')->withDefault(["nama" => null]);
    }

    public function satuan_produksi() {
        return $this->belongsTo(MstSatuan::class, 'jumlah_produksi_id_satuan')->withDefault(["nama" => null]);
    }
    // Todo: End Relation


    // Todo: Scope
    public function scopeFilter($query, $data)
    {
        if (@$data['id_peternakan'] != null) {
            $query->where("id_peternakan", $data['id_peternakan']);
        }
    }
    // Todo: End Scope
}
