<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Perikanan extends Model
{
    use HasFactory, Blameable, SoftDeletes, LogsActivity;
    
    protected $guarded = [];
    protected $table = "perikanan";

    protected $fillable = [
        // Todo: Umum
        "nama",
        "id_kbli",
        "id_jenis_usaha",
        "id_jenis_perikanan",
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


        // Todo: Lainnya
        "jenis_kelamin",
        "id_tingkat_resiko",
        "id_skala_usaha",
        "komoditas",
        // Todo: End Lainnya


        // Todo: Legalitas
        "nik",

        "no_badan_hukum",
        "tanggal_badan_hukum",
        "id_pengesahan_badan_hukum",
        "tahun_ind_usaha",
        "nama_notaris",
        "npwp",

        "nib",
        "nib_tanggal_terbit",
        "nib_dikeluarkan_oleh",
        "nib_penanggungjawab",

        "surat_izin_tempat_usaha",
        "surat_izin_tempat_usaha_tanggal_terbit",
        "surat_izin_tempat_usaha_dikeluarkan_oleh",
        "surat_izin_tempat_usaha_masa_berlaku",
        "surat_izin_tempat_usaha_penanggungjawab",
        // Todo: End Legalitas


        // Todo: Rinci
        "nilai_investasi",
        "id_status_permodalan",
        "luas_tanah",
        "luas_bangunan",
        // Todo: End Rinci


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
            ->setDescriptionForEvent(fn (string $eventName) => "Perikanan");
    }

    // Todo: Relation
    public function kbli() {
        return $this->belongsTo(MstKbli::class, 'id_kbli')->withDefault(['kode' => null, 'uraian' => null]);
    }
    
    public function jenis_usaha() {
        return $this->belongsTo(MstJenisUsaha::class, 'id_jenis_usaha')->withDefault(['nama' => null]);
    }

    public function jenis_perikanan() {
        return $this->belongsTo(MstJenisPerikanan::class, 'id_jenis_perikanan')->withDefault(['nama' => null]);
    }

    public function kecamatan()
    {
        return $this->belongsTo(MstKecamatan::class, 'id_kecamatan')->withDefault(['nama' => null]);
    }

    public function kelurahan()
    {
        return $this->belongsTo(MstDesa::class, 'id_kelurahan')->withDefault(['nama' => null]);
    }

    public function tingkat_resiko()
    {
        return $this->belongsTo(MstTingkatResiko::class, 'id_tingkat_resiko')->withDefault(['nama' => null]);
    }

    public function skala_usaha()
    {
        return $this->belongsTo(MstSkalaUsaha::class, 'id_skala_usaha')->withDefault(['nama' => null]);
    }

    public function pengesahan_badan_hukum()
    {
        return $this->belongsTo(MstPengesahanBadanHukum::class, 'id_pengesahan_badan_hukum')->withDefault(['nama' => null]);
    }

    public function status_permodalan()
    {
        return $this->belongsTo(MstStatusPermodalan::class, 'id_status_permodalan')->withDefault(['nama' => null]);
    }

    public function status_verifikasi() {
        return $this->belongsTo(StatusVerifikasi::class, 'id_status_verifikasi')->withDefault(['nama' => null]);
    }
    // Todo: End Relation


    // Todo: Attribute
    public function getJenisKelaminKodeAttribute() {
        if ($this->jenis_kelamin != null) {
            return $this->jenis_kelamin == "Laki-laki" ? "L" : "P";
        }
        return null;
    }
    // Todo: End Attribute


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
    // Todo: End Scope
}
