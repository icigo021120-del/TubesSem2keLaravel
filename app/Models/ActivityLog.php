<?php

namespace App\Models;

use App\Models\Concerns\StampsOnCreate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use StampsOnCreate;

    protected string $stampColumn = 'created_at';

    public $timestamps = false;

    protected $fillable = ['user_id', 'aksi', 'detail'];

    protected $casts = ['created_at' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Catat aktivitas admin ke tabel activity_logs. */
    public static function catat(string $aksi, ?string $detail = null): void
    {
        static::create([
            'user_id' => User::admin()?->id,
            'aksi'    => $aksi,
            'detail'  => $detail,
        ]);
    }
}
