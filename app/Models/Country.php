<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "country";
}
