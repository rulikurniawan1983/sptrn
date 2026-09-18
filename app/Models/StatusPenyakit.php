<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StatusPenyakit extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "status_penyakit";

    protected $fillable = [
        "nama",
        "id_jenis_penyakit",
        "status_penyelesaian",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Status Penyakit");
    }

    // Todo: Relation
    public function jenis_penyakit()
    {
        return $this->belongsTo(MstJenisPenyakit::class, 'id_jenis_penyakit');
    }

	public function status_penyakit_kecamatan() {
		return $this->hasMany(StatusPenyakitKecamatan::class, "id_status_penyakit");
	}
    // Todo: End Relation


    // Todo: Attribute
	public function getIdKecamatanArrayAttribute()
	{
		return $this->status_penyakit_kecamatan()->pluck("id_kecamatan")->toArray();
	}

	public function getListKecamatanNamaAttribute()
    {
        $list = $this->status_penyakit_kecamatan->pluck('kecamatan.nama')->toArray();
        return implode(", ", $list);
    }
    // Todo: End Attribute


    // Todo: Enum
    const STATUS_PENYELESAIAN_AKTIF          = 'Aktif';
    const STATUS_PENYELESAIAN_SELESAI        = 'Selesai';
    const STATUS_PENYELESAIAN_AKTIF_BERULANG = 'Aktif Berulang';

    public function listStatusPenyelesaian() {
        return [
            self::STATUS_PENYELESAIAN_AKTIF          => self::STATUS_PENYELESAIAN_AKTIF,
            self::STATUS_PENYELESAIAN_SELESAI        => self::STATUS_PENYELESAIAN_SELESAI,
            self::STATUS_PENYELESAIAN_AKTIF_BERULANG => self::STATUS_PENYELESAIAN_AKTIF_BERULANG,
        ];
    }
    // Todo: End Enum
}
