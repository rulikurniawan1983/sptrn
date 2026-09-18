<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model implements HasMedia
{
    use HasFactory, Blameable, LogsActivity, InteractsWithMedia;
    
    protected $guarded = [];
    protected $table = "galeri";

    protected $fillable = [
        "nama",
        "id_jenis_galeri",
        "model_id",
        "model_type",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Galeri");
    }

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('images')
			->useDisk('media')
			->singleFile();
	}

    public function registerMediaConversions(Media $media = null): void
    {
        // Skip webp conversion to avoid palette image issues with GD driver
        // Webp conversion can be re-enabled if needed by using ImageMagick driver
    }


    // Todo: Relation
    public function modelable()
    {
        return $this->morphTo();
    }

    public function jenis_galeri()
    {
        return $this->belongsTo(MstJenisGaleri::class, 'id_jenis_galeri')->withDefault(['nama' => null]);
    }
    // Todo: End Relation

    
    // Todo: Attribute
	public function getFileFotoAttribute()
	{
		$result = asset('assets/img/no-image.jpeg');
		$media = $this->getFirstMedia('images');
		if ($media) {
			$result = $media->getUrl();
		}
		return $result;
	}
    // Todo: End Attribute


    // Todo: Scope
    public function scopeFilter($query, $data) {

        // Todo: Field Where
        $fields = [
            'model_id',
            'model_type',
        ];

        // Handle simple where conditions
        foreach ($fields as $field) {
            if (!empty($data[$field])) {
                $query->where($field, $data[$field]);
            }
        }
        // Todo: End Field Where
    }
    // Todo: End Scope
}
