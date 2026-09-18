<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UptPuskeswan extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "upt_puskeswan";

    protected $fillable = [
        // Todo: Umum
        "nama",
        "id_kecamatan",
        "id_kelurahan",
        // Todo: End Umum

        // Todo: Kontak & Alamat
        "alamat",
        "kode_pos",
        "no_tlp_1",
        "no_tlp_2",
        "fax",
        "email",
        "website",
        "lat",
        "long",
        "radius",
        // Todo: End Kontak & Alamat


        // Todo: Tenaga Kerja
        "tki_pria",
        "tki_wanita",
        "tka_pria",
        "tka_wanita",
        // Todo: End Tenaga Kerja


        // Todo: Verifikasi
        "id_status_verifikasi",
        "catatan_verifikasi_petugas",
        // Todo: End Verifikasi
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Upt Puskeswan");
    }

    // Todo: Relation
    public function kecamatan()
    {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan')->withDefault(['nama' => null]);
    }

    public function kelurahan()
    {
        return $this->belongsTo(MstDesa::class, 'id_kelurahan')->withDefault(['nama' => null]);
    }

    public function status_verifikasi() {
        return $this->belongsTo(StatusVerifikasi::class, 'id_status_verifikasi')->withDefault(['nama' => null]);
    }

	public function upt_puskeswan_kecamatan() {
		return $this->hasMany(UptPuskeswanKecamatan::class, "id_upt_puskeswan");
	}

	public function upt_puskeswan_fasilitas_upt() {
		return $this->hasMany(UptPuskeswanFasilitasUpt::class, "id_upt_puskeswan");
	}

	public function upt_puskeswan_layanan_upt() {
		return $this->hasMany(UptPuskeswanLayananUpt::class, "id_upt_puskeswan");
	}
    // Todo: End Relation

    
    // Todo: Attribute
	public function getIdKecamatanArrayAttribute()
	{
		return $this->upt_puskeswan_kecamatan()->pluck("id_kecamatan")->toArray();
	}

	public function getListKecamatanNamaAttribute()
    {
        $list = $this->upt_puskeswan_kecamatan->pluck('kecamatan.nama')->toArray();
        return implode(", ", $list);
    }

	public function getIdFasilitasUptArrayAttribute()
	{
		return $this->upt_puskeswan_fasilitas_upt()->pluck("id_fasilitas_upt")->toArray();
	}

	public function getListFasilitasUptNamaAttribute()
    {
        $list = $this->upt_puskeswan_fasilitas_upt()->pluck('fasilitas_upt.nama')->toArray();
        return implode(", ", $list);
    }

	public function getIdLayananUptArrayAttribute()
	{
		return $this->upt_puskeswan_layanan_upt()->pluck("id_layanan_upt")->toArray();
	}

	public function getListLayananUptNamaAttribute()
    {
        $list = $this->upt_puskeswan_layanan_upt()->pluck('layanan_upt.nama')->toArray();
        return implode(", ", $list);
    }
    // Todo: End Attirbute


    // Todo: Scope
    public function scopeFilter($query, $data) {

        // Todo: Field Where
        $fields = [
            'id_kecamatan',
            'id_kelurahan',
        ];

        // Handle simple where conditions
        foreach ($fields as $field) {
            if (!empty($data[$field])) {
                $query->where($field, $data[$field]);
            }
        }
        // Todo: End Field Where


        // Todo: Field Like
        $fieldsLike = [
            'nama',
        ];

        foreach ($fieldsLike as $field) {
            if (!empty($data[$field])) {
                $query->where($field, "like", "%" . $data[$field] . "%");
            }
        }
        // Todo: End Field Like

        // Handle whereHas conditions with multiple filters
        $relationFilters = [
        ];

        foreach ($relationFilters as $relation => $attributes) {
            // Cek apakah salah satu attribute memiliki nilai dalam $data
            $hasFilter = false;
            foreach ($attributes as $attribute) {
                if (!empty($data[$attribute])) {
                    $hasFilter = true;
                    break;
                }
            }
        
            // Hanya jika $hasFilter true, maka jalankan whereHas
            if ($hasFilter) {
                $query->whereHas($relation, function ($query) use ($attributes, $data) {
                    foreach ($attributes as $attribute) {
                        if (!empty($data[$attribute])) {
                            $query->where($attribute, $data[$attribute]);
                        }
                    }
                });
            }
        }


        // Todo: Lainnya
        if (!empty($data['is_lokasi_maps_terisi'])) {
            $query->whereNotNull('lat');
            $query->whereNotNull('long');
        }

        if (@$data['is_my_area'] == 1) {
            $auth_user = auth()->user();
            $id_kecamatan_array = $auth_user->id_kecamatan_array;
            if (count($id_kecamatan_array) > 0) {
                $query->whereIn("id_kecamatan", $id_kecamatan_array);
            }
        }
        // Todo: End Lainnya

    }
    // Todo: Scope
}
