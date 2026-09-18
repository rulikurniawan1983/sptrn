<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UmkmPengolahanPerikanan extends Model implements HasMedia
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity, InteractsWithMedia;
    protected $table = 'umkm_pengolahan_perikanan';
    protected $guarded = [];
    protected $fillable = [
        'nama_pelaku_usaha',
        'alamat',
        'id_desa',
        'id_kecamatan',
        'jenis_kegiatan',
        'produk_utama',
        'jumlah_produksi_bulan',
        'harga_beli_bahan_baku',
        'harga_jual_produk',
        'wilayah_pemasaran',
        'legalitas',
        'kendala',
        'berkelompok',
        'nama_kelompok',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('foto_produk')
            ->singleFile();
    }

    public function getFotoProdukUrlAttribute()
    {
        if ($this->hasMedia('foto_produk')) {
            return $this->getFirstMediaUrl('foto_produk');
        }
        return null;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty()->setDescriptionForEvent(fn(string $eventName) => "UMKM Pengolahan Perikanan");
    }

    public function kecamatan()
    {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan');
    }
    public function desa()
    {
        return $this->belongsTo(MstDesa::class, 'id_desa');
    }
} 