<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Medsos extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    protected $guarded = [];
    protected $table = "medsos";

    protected $fillable = [
        'nama',
        'icon',
        'url',
        'is_active',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty()->setDescriptionForEvent(fn(string $eventName) => "Medsos");
    }
}
