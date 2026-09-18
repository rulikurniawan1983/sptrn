<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PeternakanBerkas extends Model implements HasMedia
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity, InteractsWithMedia;
    
    protected $guarded = [];
    protected $table = "peternakan_berkas";

    protected $fillable = [
        "id_peternakan",
        "id_berkas_peternakan",
        "nama",
        "tanggal_berkas",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Peternakan Berkas");
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documents')
            ->useDisk('media')
            ->singleFile();
    }

    // Todo: Relation
    public function peternakan() {
        return $this->belongsTo(Peternakan::class, "id_peternakan");
    }

    public function berkas_peternakan() {
        return $this->belongsTo(MstBerkasPeternakan::class, "id_berkas_peternakan");
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
        if (@$data['id_peternakan'] != null) {
            $query->where("id_peternakan", $data['id_peternakan']);
        }
        if (@$data['id_berkas_peternakan'] != null) {
            $query->where("id_berkas_peternakan", $data['id_berkas_peternakan']);
        }
    }
    // Todo: End Scope
}
