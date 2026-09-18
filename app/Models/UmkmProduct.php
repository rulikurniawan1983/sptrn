<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UmkmProduct extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;

    protected $guarded = [];
    protected $table = 'umkm_products';

    protected $fillable = [
        'user_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'satuan',
        'foto_produk',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "UmkmProduct");
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFotoProdukUrlAttribute()
    {
        if ($this->foto_produk) {
            return asset('storage/umkm-products/' . $this->foto_produk);
        }
        return asset('assets/img/no-image.jpeg');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeFilter($query, $data)
    {
        if (!empty($data['nama_produk'])) {
            $query->where('nama_produk', 'like', '%' . $data['nama_produk'] . '%');
        }
        if (!empty($data['user_id'])) {
            $query->where('user_id', $data['user_id']);
        }
        if (isset($data['is_active']) && $data['is_active'] !== '' && $data['is_active'] !== null) {
            $query->where('is_active', $data['is_active']);
        }
    }
}
