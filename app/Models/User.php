<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Blameable;
use App\Notifications\RegisterNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\HasSlug;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity, HasSlug, InteractsWithMedia;
    use Blameable, SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'id',
        'name',
        'nama_pemilik',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'tanggal_lahir',
        'no_hp',
        'is_active',
        'file',
        'profile_photo',
        'slug',
        'deskripsi',
        'verification_token',
        'is_verifikasi',
        'reset_password_token',
        'current_role_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty()->setDescriptionForEvent(fn(string $eventName) => "User");
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'id'])
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('media')
            ->singleFile();

        $this->addMediaCollection('nib_file')
            ->useDisk('media')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        // Skip webp conversion to avoid palette image issues with GD driver
        // Webp conversion can be re-enabled if needed by using ImageMagick driver
    }

    // relation
    public function role()
    {
        return $this->belongsTo(Role::class, 'current_role_id')->select(['id', 'name', 'init_page_login', 'is_allow_login', 'bg', 'is_vertical_menu'])->withDefault(["name" => null]);
    }

    public function users_role()
    {
        return $this->hasMany(UsersRole::class, "users_id");
    }

	public function users_kecamatan() {
		return $this->hasMany(UsersKecamatan::class, "users_id");
	}

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by')->select(['id', 'name', 'file']);
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by')->select(['id', 'name']);
    }

    public function umkm_products()
    {
        return $this->hasMany(UmkmProduct::class, 'user_id');
    }

    public function umkmLegalitas()
    {
        return $this->hasMany(UmkmLegalitas::class, 'user_id');
    }

    public function perizinans()
    {
        return $this->hasMany(Perizinans::class, 'user_id');
    }
    //

    // attribute

	public function getIdKecamatanArrayAttribute()
	{
		return $this->users_kecamatan()->pluck("id_kecamatan")->toArray();
	}

    public function getCreatedAtDiffAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');
    }

    public function getFileUrlImageAttribute()
    {
        $media = $this->getFirstMedia('images');
        if ($media) {
            $file_url = $media->getUrl();
            return '<img src="' . $file_url . '" alt="user-avatar" class="d-block flex-shrink-0 rounded-circle me-sm-3 me-2" height="32" width="32" loading="lazy">';
        } else {
            return '<div class="avatar avatar-sm d-block flex-shrink-0 me-sm-3 me-2">
			<span class="avatar-initial rounded-circle bg-label-success">' . InitialName($this->name) . '</span>
		  </div>';
        }
    }

    public function getFileUrlAttribute()
    {
        $media = $this->getFirstMedia('images');
        if ($media) {
            $file_url = $media->getUrl();
        } else {
            $file_url = asset('assets/img/no-image.jpeg');
        }
        return $file_url;
    }

    public function getFilePathAttribute()
    {
        return getFileUrlAndPath($this->file, 'users')['path'];
    }

    public function getNibFileUrlAttribute()
    {
        $media = $this->getFirstMedia('nib_file');
        return $media ? $media->getUrl() : null;
    }

    public function getNibFileNameAttribute()
    {
        $media = $this->getFirstMedia('nib_file');
        return $media ? $media->file_name : null;
    }

    public function getIsActiveBadgeAttribute()
    {
        $text = ($this->is_active == 1) ? "Aktif" : "Nonaktif";
        $badge_bg = ($this->is_active == 0) ? "bg-label-danger" : "bg-label-primary";
        return "<span class='badge $badge_bg'>$text</span>";
    }

    public function getIsVerifikasiBadgeAttribute()
    {
        return ($this->is_verifikasi == 1) ? "<span class='badge bg-label-primary'>Sudah</span>" : "<span class='badge bg-label-danger'>Belum</span>";
    }

    public function getUsersRoleIdArrayAttribute()
    {
        return $this->users_role()->pluck("role_id")->toArray();
    }

    public function getListRoleNameStrAttribute()
    {
        $role_name_array = [];
        foreach ($this->users_role as $key => $value) {
            $role_name_array[] = $value->role->name;
        }
        return implode(', ', $role_name_array);
    }

    public function scopeFilterUsersRole($query, $role_id)
    {
        $query->whereHas("users_role", function ($query) use ($role_id) {
            $query->where("role_id", $role_id);
        });
    }

    public function scopeFilter($query, $data)
    {
        return $query;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new RegisterNotification); // Ini akan mengirim email verifikasi
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

	public function scopeIdInNotIn($query, $data)
	{
		if (isset($data["id_not_in"])) {
			$query->whereNotIn("id", $data["id_not_in"]);
		}
		if (isset($data["id_in"])) {
			$query->whereIn("id", $data["id_in"]);
		}
	}
}
