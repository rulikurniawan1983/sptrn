<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class RekomendasiNkv extends Model implements HasMedia
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity, InteractsWithMedia;
    
    protected $table = 'rekomendasi_nkv';
    protected $guarded = [];

    protected $fillable = [
        'nama_pemohon',
        'nama_tempat_usaha',
        'alamat_usaha',
        'email',
        'no_hp',
        'nib',
        'surat_permohonan',
        'data_umum',
        'surat_pernyataan',
        'sop_sanitasi',
        'is_read',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Rekomendasi Nkv");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('nib')->useDisk('media')->singleFile();
        $this->addMediaCollection('surat_permohonan')->useDisk('media')->singleFile();
        $this->addMediaCollection('data_umum')->useDisk('media')->singleFile();
        $this->addMediaCollection('surat_pernyataan')->useDisk('media')->singleFile();
        $this->addMediaCollection('sop_sanitasi')->useDisk('media')->singleFile();
    }
}
