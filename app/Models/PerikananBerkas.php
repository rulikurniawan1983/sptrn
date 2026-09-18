<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PerikananBerkas extends Model implements HasMedia
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity, InteractsWithMedia;
    
    protected $guarded = [];
    protected $table = "perikanan_berkas";

    protected $fillable = [
        "id_perikanan",
        "id_berkas_perikanan",
        "nama",
        "tanggal_berkas",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Perikanan Berkas");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documents')
            ->useDisk('media')
            ->singleFile();
    }

    // Todo: Relation
    public function perikanan() {
        return $this->belongsTo(Perikanan::class, "id_perikanan");
    }

    public function berkas_perikanan() {
        return $this->belongsTo(MstBerkasPerikanan::class, "id_berkas_perikanan");
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
        if (@$data['id_perikanan'] != null) {
            $query->where("id_perikanan", $data['id_perikanan']);
        }
        if (@$data['id_berkas_perikanan'] != null) {
            $query->where("id_berkas_perikanan", $data['id_berkas_perikanan']);
        }
    }
    // Todo: End Scope
}
