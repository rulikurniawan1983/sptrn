<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PerikananProduksi extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "perikanan_produksi";

    protected $fillable = [
        "id_perikanan",
        "tanggal_produksi_dari",
        "tanggal_produksi_sampai",
        "jumlah_kolam",
        "jumlah_kolam_id_satuan",
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
            ->setDescriptionForEvent(fn (string $eventName) => "Perikanan Produksi");
    }

    // Todo: Relation
    public function perikanan() {
        return $this->belongsTo(Perikanan::class, 'id_perikanan');
    }

    public function satuan_kolam() {
        return $this->belongsTo(MstSatuan::class, 'jumlah_kolam_id_satuan')->withDefault(["nama" => null]);
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
        if (@$data['id_perikanan'] != null) {
            $query->where("id_perikanan", $data['id_perikanan']);
        }
    }
    // Todo: End Scope
}
