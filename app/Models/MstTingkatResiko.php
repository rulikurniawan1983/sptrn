<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MstTingkatResiko extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "mst_tingkat_resiko";

    protected $fillable = [
        "nama",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Tingkat Resiko");
    }
}
