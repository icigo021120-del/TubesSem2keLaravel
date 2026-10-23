<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sensor extends Model
{
    public const JENIS = ['asap', 'api', 'gempa', 'banjir'];
    public const STATUS = ['aktif', 'rusak', 'maintenance'];

    public $timestamps = false;

    protected static function booted(): void
    {
        // "Terakhir dicek" ikut diperbarui setiap data sensor disimpan
        static::saving(fn (self $sensor) => $sensor->last_checked = now());
    }

    protected $fillable = ['kode_sensor', 'jenis_sensor', 'lokasi_gedung', 'status'];

    protected $casts = ['last_checked' => 'datetime'];

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class);
    }
}
