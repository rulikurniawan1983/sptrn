<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Storage;

class Identity extends Model
{
	use HasFactory, Blameable, SoftDeletes, LogsActivity;
	protected $table   = "identity";
	protected $guarded = [];

	const TYPE_TEXT     = "Text";
	const TYPE_TEXTAREA = "Textarea";
	const TYPE_FILE     = "File";

	public function listType(): array
	{
		return [
			self::TYPE_TEXT     => self::TYPE_TEXT,
			self::TYPE_TEXTAREA => self::TYPE_TEXTAREA,
			self::TYPE_FILE     => self::TYPE_FILE,
		];
	}

	public function getActivitylogOptions(): LogOptions
	{
		return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty()->setDescriptionForEvent(fn(string $eventName) => "Identity");
	}

	public function getFileFotoAttribute()
	{
		$file_path = "identity/photo/" . $this->value;
		$result = asset('assets/img/no-image.jpeg');
		if ($this->type == self::TYPE_FILE) {
			if ($this->value != "" and Storage::disk('public')->exists($file_path)) {
				$result = url(Storage::url($file_path));
			}
		}
		return $result;
	}
}
