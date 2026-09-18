<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PraktekDokterHewanBerkas extends Model implements HasMedia
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity, InteractsWithMedia;
    
    protected $guarded = [];
    protected $table = "praktek_dokter_hewan_berkas";

    protected $fillable = [
        "id_praktek_dokter_hewan",
        "id_berkas_keswan",
        "nama",
        "tanggal_berkas",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Praktek Dokter Hewan Berkas");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documents')
            ->useDisk('media')
            ->singleFile();
    }

    
    // Todo: Relation
    public function praktek_dokter_hewan() {
        return $this->belongsTo(PraktekDokterHewan::class, "id_praktek_dokter_hewan");
    }

    public function berkas_keswan() {
        return $this->belongsTo(MstBerkasKeswan::class, "id_berkas_keswan");
    }
    // Todo: End Relation


    // Todo: Attibute
    public function getFileBerkasUrlAttribute()
    {
        $media = $this->getFirstMedia('documents');
        if ($media) {
            $file_url = $media->getUrl();
        } else {
            $file_url = null;
        }
        return $file_url;
    }
    // Todo: End Attibute


    // Todo: Scope
    public function scopeFilter($query, $data)
    {
        if (@$data['id_praktek_dokter_hewan'] != null) {
            $query->where("id_praktek_dokter_hewan", $data['id_praktek_dokter_hewan']);
        }
        if (@$data['id_berkas_keswan'] != null) {
            $query->where("id_berkas_keswan", $data['id_berkas_keswan']);
        }
    }
    // Todo: End Scope
}
