<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UsersKecamatan extends Model
{
    use HasFactory, Blameable, LogsActivity;
    
    protected $guarded = [];
    protected $table = "users_kecamatan";

    protected $fillable = [
        "users_id",
        "id_kecamatan",
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Users Kecamatan");
    }

    // Todo: Relation
    public function users() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function kecamatan() {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan');
    }
    // Todo: End Relation
}
