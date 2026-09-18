<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Landmark extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $table = 'landmarks';

    protected $fillable = [
        "nama",
        "kategori",
        "latitude",
        "longitude",
        "alamat",
        "keterangan"
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Landmark");
    }
}
