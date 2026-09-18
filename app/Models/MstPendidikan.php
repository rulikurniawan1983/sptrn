<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MstPendidikan extends Model
{
    use HasFactory, SoftDeletes, Blameable, LogsActivity;
    protected $table = 'mst_pendidikan';
    protected $fillable = [
        'nama'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty()->setDescriptionForEvent(fn(string $eventName) => "Pendidikan");
    }
}
